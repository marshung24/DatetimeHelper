<?php
namespace marshung\helper;

/**
 * Time Period Helper
 *
 * 1. Format: $timePeriods = [[$startDatetime1, $endDatetime1], [$startDatetime2, $endDatetime2], ...];
 * - $Datetime = Y-m-d H:i:s ; Y-m-d H:i:00 ; Y-m-d H:i ; Y-m-d ;
 * 2. If it is hour/minute/second, the end point is usually not included, for example, 8 o'clock to 9 o'clock is 1 hour.
 * 3. If it is a day/month/year, it usually includes an end point, for example, January to March is 3 months.
 * 4. When processing, assume that the data format is correct. If necessary, you need to call the verification function to verify the data.
 *
 * @author Mars Hung <tfaredxj@gmail.com>
 */
class TimePeriodHelper
{

    /**
     * *********************************************
     * ************** Public Function **************
     * *********************************************
     */
    
    /**
     * Sort time periods (Order by ASC)
     * 
     * Sort Priority: Start Time => End Time
     * 
     * @param array $timePeriods
     * @return array
     */
    public static function sort(Array $timePeriods)
    {
        // Closure in PHP 7.0.X loop maybe die
        usort($timePeriods, function ($a, $b) {
            if ($a[0] == $b[0]) {
                // Start time is equal, compare end time
                $r = $a[1] < $b[1] ? -1 : 1;
            } else {
                // Compare Start time
                $r = $a[0] < $b[0] ? -1 : 1;
            }
            
            return $r;
        });
        
        return $timePeriods;
    }
    
    /**
     * Union one or more time periods
     *
     * TimePeriodHelper::union($timePeriods1, $timePeriods2, $timePeriods3, ......);
     * 
     * @param array $timePeriods
     * @return array
     */
    public static function union()
    {
        $opt = [];
        
        // Combine and sort
        $merge = call_user_func_array('array_merge', func_get_args());
        $merge = self::sort($merge);
        
        if (empty($merge)) {
            return $opt;
        }
        
        $tmp = array_shift($merge);
        foreach ($merge as $k => $tp) {
            if ($tp[0] > $tmp[1]) {
                // Got it, and set next.
                $opt[] = $tmp;
                $tmp = $tp;
            } elseif ($tp[1] > $tmp[1]) {
                // Extend end time
                $tmp[1] = $tp[1];
            }
        }
        $opt[] = $tmp;
        
        return $opt;
    }
    
    /**
     * Computes the difference of time periods
     * 
     * Compares $timePeriods1 against $timePeriods2 and returns the values in $timePeriods1 that are not present in $timePeriods2.
     * 
     * TimePeriodHelper::diff($timePeriods1, $timePeriods2);
     * 
     * @param array $timePeriods1
     * @param array $timePeriods2
     * @param bool $sortOut Whether the input needs to be rearranged, default true
     * @return array
     */
    public static function diff(Array $timePeriods1, Array $timePeriods2, $sortOut = true)
    {
        /*** Arguments prepare ***/
        // Subject or pattern is empty, do nothing
        if (empty($timePeriods1) || empty($timePeriods2)) {
            return $timePeriods1;
        }
        
        // Data sorting out
        if ($sortOut) {
            $timePeriods1 = self::union($timePeriods1);
            $timePeriods2 = self::union($timePeriods2);
        }
        
        $opt = [];
        foreach ($timePeriods1 as $k1 => $ori) {
            foreach ($timePeriods2 as $ko => $sub) {
                if ($sub[1] <= $ori[0]) {
                    // No overlap && Passed: --$sub0--$sub1--$ori0--$ori1--
                    unset($timePeriods2[$ko]);
                    continue;
                } elseif ($ori[1] <= $sub[0]) {
                    // No overlap: --$ori0--$ori1--$sub0--$sub1--
                    continue;
                } elseif ($sub[0] <= $ori[0] && $ori[1] <= $sub[1]) {
                    // Subtract all: --sub0--ori0--ori1--sub1--
                    $ori = [];
                    break;
                } elseif ($ori[0] < $sub[0] && $sub[1] < $ori[1]) {
                    // Delete internal: --ori0--sub0--sub1--ori1--
                    $opt[]= [$ori[0], $sub[0]];
                    $ori = [$sub[1], $ori[1]];
              //} elseif ($sub[0] <= $ori[0] && $sub[1] <= $ori[1]) { // Complete condition
                } elseif ($sub[0] <= $ori[0]) { // Equivalent condition
                    // Delete overlap: --sub0--ori0--sub1--ori1--
                    $ori = [$sub[1], $ori[1]];
              //} elseif ($ori[0] <= $sub[0] && $ori[1] <= $sub[1]) { // Complete condition
              //} elseif ($ori[1] <= $sub[1]) { // Equivalent condition
                } else { // Equivalent condition
                    // Delete overlap: --ori0--sub0--ori1--sub1--
                    $ori = [$ori[0], $sub[0]];
                }
            }
            
            // All No overlap
            if (! empty($ori)) {
                $opt[] = $ori;
            }
        }
        
        return $opt;
    }
    
    /**
     * Computes the intersection of time periods
     * 
     * @param array $timePeriods1
     * @param array $timePeriods2
     * @param bool $sortOut Whether the input needs to be rearranged, default true
     * @return array
     */
    public static function intersect(Array $timePeriods1, Array $timePeriods2, $sortOut = true)
    {
        // Subject or pattern is empty, do nothing
        if (empty($timePeriods1) || empty($timePeriods2)) {
            return [];
        }
        
        // Data sorting out
        if ($sortOut) {
            $timePeriods1 = self::union($timePeriods1);
            $timePeriods2 = self::union($timePeriods2);
        }
        
        $opt = [];
        foreach ($timePeriods1 as $k1 => $ori) {
            foreach ($timePeriods2 as $ko => $sub) {
                if ($sub[1] <= $ori[0]) {
                    // No overlap && Passed: --$sub0--$sub1--$ori0--$ori1--
                    unset($timePeriods2[$ko]);
                    continue;
                } elseif ($ori[1] <= $sub[0]) {
                    // No overlap: --$ori0--$ori1--$sub0--$sub1--
                    continue;
                } elseif ($sub[0] <= $ori[0] && $ori[1] <= $sub[1]) {
                    // Subtract all: --sub0--ori0--ori1--sub1--
                    $opt[] = [$ori[0], $ori[1]];
                    break;
                } elseif ($ori[0] < $sub[0] && $sub[1] < $ori[1]) {
                    // Delete internal: --ori0--sub0--sub1--ori1--
                    $opt[] = [$sub[0], $sub[1]];
                    $ori = [$sub[1], $ori[1]];
              //} elseif ($sub[0] <= $ori[0] && $sub[1] <= $ori[1]) { // Complete condition
                } elseif ($sub[0] <= $ori[0]) { // Equivalent condition
                    // Delete overlap: --sub0--ori0--sub1--ori1--
                    $opt[] = [$ori[0], $sub[1]];
                    $ori = [$sub[1], $ori[1]];
              //} elseif ($ori[0] <= $sub[0] && $ori[1] <= $sub[1]) { // Complete condition
              //} elseif ($ori[1] <= $sub[1]) { // Equivalent condition
                } else { // Equivalent condition
                    // Delete overlap: --ori0--sub0--ori1--sub1--
                    $opt[] = [$sub[0], $ori[1]];
                    break;
                }
            }
        }
        
        return $opt;
    }
    
    /**
     * Determine if the time period overlaps
     * 
     * Only when there is no intersection, no data is needed.
     * Logic is similar to intersect
     *  
     * @param array $timePeriods1
     * @param array $timePeriods2
     * @return bool
     */
    public static function isOverlap(Array $timePeriods1, Array $timePeriods2)
    {
        // Subject or pattern is empty, do nothing
        if (empty($timePeriods1) || empty($timePeriods2)) {
            return false;
        }
        
        foreach ($timePeriods1 as $k1 => $ori) {
            foreach ($timePeriods2 as $ko => $sub) {
                if ($sub[1] <= $ori[0]) {
                    // No overlap && Passed: --$sub0--$sub1--$ori0--$ori1--
                    unset($timePeriods2[$ko]);
                    continue;
                } elseif ($ori[1] <= $sub[0]) {
                    // No overlap: --$ori0--$ori1--$sub0--$sub1--
                    continue;
                } elseif ($sub[0] <= $ori[0] && $ori[1] <= $sub[1]) {
                    // Subtract all: --sub0--ori0--ori1--sub1--
                    return true;
                } elseif ($ori[0] < $sub[0] && $sub[1] < $ori[1]) {
                    // Delete internal: --ori0--sub0--sub1--ori1--
                    return true;
              //} elseif ($sub[0] <= $ori[0] && $sub[1] <= $ori[1]) { // Complete condition
                } elseif ($sub[0] <= $ori[0]) { // Equivalent condition
                    // Delete overlap: --sub0--ori0--sub1--ori1--
                    return true;
              //} elseif ($ori[0] <= $sub[0] && $ori[1] <= $sub[1]) { // Complete condition
              //} elseif ($ori[1] <= $sub[1]) { // Equivalent condition
                } else { // Equivalent condition
                    // Delete overlap: --ori0--sub0--ori1--sub1--
                    return true;
                }
            }
        }
        
        return false;
    }
    
    /**
     * Fill time periods
     * 
     * Leaving only the first start time and the last end time
     * 
     * @param array $timePeriods
     * @return array
     */
    public static function fill(Array $timePeriods)
    {
        $opt = [];
        
        if (isset($timePeriods[0][0])) {
            $tmp = array_shift($timePeriods);
            $start = $tmp[0];
            $end = $tmp[1];
            foreach ($timePeriods as $k => $tp) {
                $start = min($start, $tp[0]);
                $end = max($end, $tp[1]);
            }
            $opt = [[$start,$end]];
        }
        
        return $opt;
    }

    /**
     * Get gap time periods of multiple sets of time periods
     * 
     * @param array $timePeriods
     * @return array
     */
    public static function gap(Array $timePeriods)
    {
        $opt = [];
        
        return $opt;
    }

    /**
     * Calculation period total time, Need to specify the minimum unit(from unit())
     * 
     * @param array $timePeriods
     * @return number
     */
    public static function time(Array $timePeriods)
    {
        $opt = 0;
        
        return $opt;
    }

    /**
     * Specify the minimum unit of calculation(day,minute,second)
     */
    public static function unit()
    {}

    /**
     */
    public static function format()
    {}
    
    /**
     */
    public static function validate()
    {}
    
    /**
     */
    public static function filter()
    {}

    /**
     * **********************************************
     * ************** Private Function **************
     * **********************************************
     */
}