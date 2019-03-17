<?php
namespace marshung\helper;

/**
 * Date/Time Helper for PHP code
 * 
 * @author Mars Hung <tfaredxj@gmail.com>
 */
class DatetimeHelper
{
    
    /**
     * *********************************************
     * ************** Public Function **************
     * *********************************************
     */
    
    
    
    
    /**
     * Date calculation - increase
     * 
     * @param string $date Base date
     * @param string $add Add number
     * @param string $unit Add Unit(day,month,year)
     * @param string $format
     * @return string
     */
    public static function dateAdd($date, $add = '1', $unit = 'day', $format = 'Y-m-d')
    {
        return self::dateCal($date, $add, $unit, $format);
    }
    
    /**
     * Date calculation - reduction
     * 
     * @param string $date $date Base date
     * @param string $reduce Reduce number
     * @param string $unit Reduce Unit(day,month,year)
     * @param string $format
     * @return string
     */
    public static function dateReduce($date, $reduce = '1', $unit = 'day', $format = 'Y-m-d')
    {
        return self::dateCal($date, '-'.$reduce, $unit, $format);
    }
    
    /**
     * Date calculation
     * 
     * @param string $date $date Base date
     * @param string $difference number(positive:add, negative:reduce)
     * @param string $unit Unit(day,month,year)
     * @param string $format
     * @return string
     */
    public static function dateCal($date, $difference = '1', $unit = 'day', $format = 'Y-m-d')
    {
        if (in_array($unit, ['month','year','months','years'])) {
            // Origin date timestamp
            $timestamp = strtotime($date);
            // Change the date to the first day
            $rebaseDate = date('Y-m-01 H:i:s', $timestamp);
            // Use $rebaseDate to calculate and get timestamp
            $rbTimestamp = strtotime($rebaseDate . ($difference < 0 ? ' ': ' + ') . $difference . ' ' . $unit);
            // Get the actual date, compare the original date to the last day after the calculation
            $day = date('d', $timestamp);
            $rbLastDay = date('t', $rbTimestamp);
            $realDay = $rbLastDay < $day ? $rbLastDay : $day;
            // Restore to real time
            $renewDate = date('Y-m-'.$realDay.' H:i:s', $rbTimestamp);
            // format
            return date($format, strtotime($renewDate));
        } else {
            // No months and years, happy to do
            return date($format, strtotime($date . ($difference < 0 ? ' ': ' + ') . $difference . ' ' . $unit));
        }
    }
    
    /**
     * 轉換格式
     */
    public static function format()
    {}
    
    /**
     * 西元年轉民國年
     */
    public static function toDateRoc()
    {}
    
    /**
     * 民國年轉西元年
     */
    public static function fromDateRoc()
    {}
    
    /**
     * Get Date Iterator - Iteration Date in Days
     *
     * Usage:
     * $daterange = \app\helpers\DateTimeHelper::dateIterator('2018-01-01', '2018-01-31');
     * foreach($daterange as $date){
     *     echo $date->format('Y-m-d') . '<br>';
     * }
     *
     * @author  Mars Hung
     *
     * @param date $startDate
     *            start date
     * @param date $endDate
     *            end date
     * @return DateTime
     */
    public static function dateIterator($startDate, $endDate)
    {
        $startDate = new \DateTime($startDate);
        $endDate = new \DateTime($endDate);
        $endDate = $endDate->modify('+1 day');
        
        $interval = new \DateInterval('P1D');
        $daterange = new \DatePeriod($startDate, $interval, $endDate);
        
        return $daterange;
    }
    
    
    /**
     * ***********************************************
     * ************** Vaildate Function **************
     * ***********************************************
     */
    
    /**
     * Determine if the date is legal
     *
     * @param string $date
     *            date string(YYYY-MM-DD)
     * @return boolean
     */
    public static function isDate($date)
    {
        // Not legal, but commonly used
        if ($date == '0000-00-00') {
            return true;
        }
        // Check
        if (preg_match('|^([0-9]{4})[\-\/]([0-9]{1,2})[\-\/]([0-9]{1,2})$|', $date, $matches)) {
            // Have Separator Y-m-d, Y/m/d
            return checkdate($matches[2], $matches[3], $matches[1]);
        } elseif (preg_match('|^([0-9]{4})([0-9]{2})([0-9]{2})$|', $date, $matches)) {
            // No Separator Ymd
            return checkdate($matches[2], $matches[3], $matches[1]);
        }
        
        return false;
    }
    
    public static function isTime()
    {}
    
    public static function isDatetime()
    {}
    
    /**
     * **********************************************
     * ************** Private Function **************
     * **********************************************
     */
}