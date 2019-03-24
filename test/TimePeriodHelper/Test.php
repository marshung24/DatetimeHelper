<?php
namespace marshung\helperTest\TimePeriodHelper;

use marshung\helper\TimePeriodHelper;
use marshung\helperTest\tools\DevTools;

/**
 * Test for TimePeriodHelper
 * 
 * Expect to use phpUnit
 * 
 * @author Mars Hung <tfaredxj@gmail.com>
 *
 */
class Test
{

    /**
     * Construct
     */
    public function __construct()
    {}

    /**
     * *********************************************
     * ************** Public Function **************
     * *********************************************
     */
    
    /**
     * Test Sort
     *
     * @param string $detail
     */
    public static function testSort($detail = false)
    {
        $templete = self::testSortData();
        $expected = self::testSortExpected();
        
        $result = TimePeriodHelper::sort($templete);
        
        $theSame = DevTools::theSame($result, $expected, $detail);
        DevTools::isTheSame($theSame, __FUNCTION__);
    }
    
    /**
     * Test Union
     *
     * @param string $detail
     */
    public static function testUnion($detail = false)
    {
        $templete1 = self::testUnionData1();
        $templete2 = self::testUnionData2();
        $expected = self::testUnionExpected();
        
        $result = TimePeriodHelper::union($templete1, $templete2);
        
        $theSame = DevTools::theSame($result, $expected, $detail);
        DevTools::isTheSame($theSame, __FUNCTION__);
    }
    
    /**
     * Test Diff
     *
     * @param string $detail
     */
    public static function testDiff($detail = false)
    {
        $templete1 = self::testDiffData1();
        $templete2 = self::testDiffData2();
        $expected = self::testDiffExpected();
        
        // The same
        $result = TimePeriodHelper::diff($templete1, $templete2);
        $theSame1 = DevTools::theSame($result, $expected, $detail);
        
        // Need Different
        $result = TimePeriodHelper::diff($templete1, $templete2, false);
        $theSame2 = DevTools::theSame($result, $expected, $detail);
        
        $theSame = $theSame1 && ! $theSame2;
        
        DevTools::isTheSame($theSame, __FUNCTION__);
    }
    
    /**
     * Test Intersect
     *
     * @param string $detail
     */
    public static function testIntersect($detail = false)
    {
        $templete1 = self::testIntersectData1();
        $templete2 = self::testIntersectData2();
        $expected = self::testIntersectExpected();
        
        // The same
        $result = TimePeriodHelper::intersect($templete1, $templete2);
        $theSame1 = DevTools::theSame($result, $expected, $detail);
        
        // Need Different
        $result = TimePeriodHelper::intersect($templete1, $templete2, false);
        $theSame2 = DevTools::theSame($result, $expected, $detail);
        
        $theSame = $theSame1 && ! $theSame2;
        
        DevTools::isTheSame($theSame, __FUNCTION__);
    }
    
    /**
     * Test IsOverlap
     *
     * @param string $detail
     */
    public static function testIsOverlap($detail = false)
    {
        $templete1 = self::testIsOverlapData1();
        $templete2 = self::testIsOverlapData2();
        $expected = self::testIsOverlapExpected();
        
        $theSame = true;
        foreach ($templete1 as $k1 => $v1) {
            $result = TimePeriodHelper::isOverlap($templete1[$k1], $templete2[$k1]);
            $theSame = $theSame && DevTools::theSame($result, $expected[$k1], $detail);
        }
        
        DevTools::isTheSame($theSame, __FUNCTION__);
    }
    
    /**
     * Test Fill
     * 
     * @param string $detail
     */
    public static function testFill($detail = false)
    {
        $templete = self::testFillData();
        $expected = self::testFillExpected();
        
        $result = TimePeriodHelper::fill($templete);
        
        $theSame = DevTools::theSame($result, $expected, $detail);
        DevTools::isTheSame($theSame, __FUNCTION__);
    }
    
    /**
     * Test Gap
     *
     * @param string $detail
     */
    public static function testGap($detail = false)
    {
        $templete = self::testGapData();
        $expected = self::testGapExpected();
        
        // The same
        $result = TimePeriodHelper::gap($templete);
        $theSame1 = DevTools::theSame($result, $expected, $detail);
        
        // Need Different
        $result = TimePeriodHelper::gap($templete, false);
        $theSame2 = DevTools::theSame($result, $expected, $detail);
        
        $theSame = $theSame1 && ! $theSame2;
        
        DevTools::isTheSame($theSame, __FUNCTION__);
    }
    
    /**
     * Test Time
     *
     * @param string $detail
     */
    public static function testTime($detail = false)
    {
        $templete = self::testTimeData();
        $expected = self::testTimeExpected();
        
        // The same
        TimePeriodHelper::setUnit('second');
        $result = TimePeriodHelper::time($templete);
        $theSame1 = DevTools::theSame($result, $expected, $detail);
        
        // Need Different
        $result = TimePeriodHelper::time($templete, false);
        $theSame2 = DevTools::theSame($result, $expected, $detail);
        
        // The same
        TimePeriodHelper::setUnit('minutes');
        $result = TimePeriodHelper::time($templete);
        $theSame3 = DevTools::theSame($result, floor($expected / 60), $detail);
        
        // The same
        TimePeriodHelper::setUnit('h');
        $result = TimePeriodHelper::time($templete);
        $theSame4 = DevTools::theSame($result, floor($expected / 3600), $detail);
        
        $theSame = $theSame1 && ! $theSame2 && $theSame3 && $theSame4;
        
        DevTools::isTheSame($theSame, __FUNCTION__);
    }
    
    /**
     * Test Format
     *
     * @param string $detail
     */
    public static function testFormat($detail = false)
    {
        $templete = self::testFormatData();
        $expectedS = self::testFormatExpectedS();
        $expectedM = self::testFormatExpectedM();
        $expectedH = self::testFormatExpectedH();
        
        // The same
        TimePeriodHelper::setUnit('s');
        $result = TimePeriodHelper::format($templete);
        $theSame1 = DevTools::theSame($result, $expectedS, $detail);
        
        // The same
        TimePeriodHelper::setUnit('minute');
        $result = TimePeriodHelper::format($templete);
        $theSame2 = DevTools::theSame($result, $expectedM, $detail);
        
        // The same
        TimePeriodHelper::setUnit('hours');
        $result = TimePeriodHelper::format($templete);
        $theSame3 = DevTools::theSame($result, $expectedH, $detail);
        
        // The same
        $result = TimePeriodHelper::format($templete);
        $theSame4 = DevTools::theSame($result, $expectedH, $detail);
        
        // The same
        $result = TimePeriodHelper::format($templete, 'second');
        $theSame5 = DevTools::theSame($result, $expectedS, $detail);
        
        // Need Different
        $result = TimePeriodHelper::format($templete);
        $theSame6 = DevTools::theSame($result, $expectedS, $detail);
        
        $theSame = $theSame1 && $theSame2 && $theSame3 && $theSame4 && $theSame5 && ! $theSame6;
        
        DevTools::isTheSame($theSame, __FUNCTION__);
    }
    
    /**
     * Test Validate
     *
     * @param string $detail
     */
    public static function testValidate($detail = false)
    {
        $templete1 = self::testValidateData1();
        $templete2 = self::testValidateData2();
        $expected1 = self::testValidateExpected1();
        $expected2 = self::testValidateExpected2();
        
        // The same
        try {
            $result1 = TimePeriodHelper::validate($templete1);
        } catch (\Exception $e) {
            $result1 = false;
        }
        $theSame1 = DevTools::theSame($result1, $expected1, $detail);
        
        // The same
        try {
            $result2 = TimePeriodHelper::validate($templete2);
        } catch (\Exception $e) {
            $result2 = false;
        }
        $theSame2 = DevTools::theSame($result2, $expected2, $detail);
        
        $theSame = $theSame1 && $theSame2;
        
        DevTools::isTheSame($theSame, __FUNCTION__);
    }
    
    /**
     * Test Filter
     *
     * @param string $detail
     */
    public static function testFilter($detail = false)
    {
        $templete1 = self::testFilterData1();
        $templete2 = self::testFilterData2();
        $expected1 = self::testFilterExpected1();
        $expected2 = self::testFilterExpected2();
        
        // The same
        $result1 = TimePeriodHelper::filter($templete1);
        $theSame1 = DevTools::theSame($result1, $expected1, $detail);
        
        // The same
        $result2 = TimePeriodHelper::filter($templete2);
        $theSame2 = DevTools::theSame($result2, $expected2, $detail);
        
        // Need Different
        $theSame3 = DevTools::theSame($result1, $expected2, $detail);
        
        $theSame = $theSame1 && $theSame2 && ! $theSame3;
        
        DevTools::isTheSame($theSame, __FUNCTION__);
    }
    
    
    /**
     * ****************************************************
     * ************** Data Templete Function **************
     * ****************************************************
     */
    
    /**
     * Test Data - Sort
     * @return array
     */
    public static function testSortData()
    {
        return [
            ['2019-01-04 12:00:00','2019-01-04 18:00:00'],
            ['2019-01-04 08:00:00','2019-01-04 12:00:00'],
            ['2019-01-04 12:00:00','2019-01-04 18:00:00'],
            ['2019-01-04 12:00:00','2019-01-04 17:00:00'],
            ['2019-01-04 12:00:00','2019-01-04 19:00:00'],
            ['2019-01-04 08:00:00','2019-01-04 12:00:00'],
            ['2019-01-04 09:00:00','2019-01-04 12:00:00'],
            ['2019-01-04 07:00:00','2019-01-04 12:00:00'],
            ['2019-01-04 10:00:00','2019-01-04 16:00:00'],
            ['2019-01-04 11:00:00','2019-01-04 18:00:00'],
            ['2019-01-04 10:00:00','2019-01-04 18:00:00'],
            ['2019-01-04 11:00:00','2019-01-04 15:00:00']
        ];
    }
    
    /**
     * Expected Data - Sort
     * @return array
     */
    public static function testSortExpected()
    {
        return [
            ['2019-01-04 07:00:00','2019-01-04 12:00:00'],
            ['2019-01-04 08:00:00','2019-01-04 12:00:00'],
            ['2019-01-04 08:00:00','2019-01-04 12:00:00'],
            ['2019-01-04 09:00:00','2019-01-04 12:00:00'],
            ['2019-01-04 10:00:00','2019-01-04 16:00:00'],
            ['2019-01-04 10:00:00','2019-01-04 18:00:00'],
            ['2019-01-04 11:00:00','2019-01-04 15:00:00'],
            ['2019-01-04 11:00:00','2019-01-04 18:00:00'],
            ['2019-01-04 12:00:00','2019-01-04 17:00:00'],
            ['2019-01-04 12:00:00','2019-01-04 18:00:00'],
            ['2019-01-04 12:00:00','2019-01-04 18:00:00'],
            ['2019-01-04 12:00:00','2019-01-04 19:00:00']
        ];
    }
    
    /**
     * Test Data - Union
     * @return array
     */
    public static function testUnionData1()
    {
        return [
            ['2019-01-04 13:00:00','2019-01-04 15:00:00'],
            ['2019-01-04 10:00:00','2019-01-04 12:00:00'],
            ['2019-01-04 19:00:00','2019-01-04 22:00:00'],
            ['2019-01-04 15:00:00','2019-01-04 18:00:00']
        ];
    }
    
    /**
     * Test Data - Union
     * @return array
     */
    public static function testUnionData2()
    {
        return [
            ['2019-01-04 08:00:00','2019-01-04 09:00:00'],
            ['2019-01-04 14:00:00','2019-01-04 16:00:00'],
            ['2019-01-04 21:00:00','2019-01-04 23:00:00']
        ];
    }
    
    /**
     * Expected Data - Union
     * @return array
     */
    public static function testUnionExpected()
    {
        return [
            ['2019-01-04 08:00:00','2019-01-04 09:00:00'],
            ['2019-01-04 10:00:00','2019-01-04 12:00:00'],
            ['2019-01-04 13:00:00','2019-01-04 18:00:00'],
            ['2019-01-04 19:00:00','2019-01-04 23:00:00']
        ];
    }
    
    /**
     * Test Data - Diff
     * @return array
     */
    public static function testDiffData1()
    {
        return [
            // 1
            ['2019-01-01 01:00:00','2019-01-01 02:00:00'],
            ['2019-01-02 01:00:00','2019-01-02 02:00:00'],
            // 2
            ['2019-01-03 01:00:00','2019-01-03 02:00:00'],
            ['2019-01-04 01:00:00','2019-01-04 02:00:00'],
            // 3
            ['2019-01-04 03:00:00','2019-01-04 04:00:00'],
            ['2019-01-04 05:00:00','2019-01-04 06:00:00'],
            // 4
            ['2019-01-04 07:00:00','2019-01-04 08:00:00'],
            // 5
            ['2019-01-04 09:00:00','2019-01-04 10:00:00'],
            ['2019-01-04 11:00:00','2019-01-04 12:00:00'],
            // 6
            ['2019-01-04 13:00:00','2019-01-04 14:00:00'],
            ['2019-01-04 15:00:00','2019-01-04 16:00:00'],
            // Multiple processing
            ['2019-01-04 17:00:00','2019-01-04 20:00:00'],
            // Multiple processing - cross time
            ['2019-01-04 21:00:00','2019-01-04 21:40:00'],
            ['2019-01-04 21:20:00','2019-01-04 22:00:00'],
            ['2019-01-04 22:30:00','2019-01-04 23:00:00'],
            
        ];
    }
    
    /**
     * Test Data - Diff
     * @return array
     */
    public static function testDiffData2()
    {
        return [
            // 1
            ['2019-01-01 00:30:00','2019-01-01 00:59:59'],
            ['2019-01-02 00:30:00','2019-01-02 01:00:00'],
            // 2
            ['2019-01-03 02:00:00','2019-01-03 02:30:00'],
            ['2019-01-04 02:00:01','2019-01-04 02:30:00'],
            // 3
            ['2019-01-04 03:00:00','2019-01-04 04:00:00'],
            ['2019-01-04 04:50:00','2019-01-04 06:00:01'],
            // 4
            ['2019-01-04 07:30:00','2019-01-04 07:40:00'],
            // 5
            ['2019-01-04 09:30:00','2019-01-04 10:00:00'],
            ['2019-01-04 11:30:00','2019-01-04 12:00:01'],
            // 6
            ['2019-01-04 13:00:00','2019-01-04 13:30:00'],
            ['2019-01-04 14:50:00','2019-01-04 15:30:00'],
            // Multiple processing
            ['2019-01-04 17:30:00','2019-01-04 18:00:00'],
            ['2019-01-04 18:30:00','2019-01-04 19:00:00'],
            ['2019-01-04 19:30:00','2019-01-04 20:30:00'],
            // Multiple processing - cross time
            ['2019-01-04 21:30:00','2019-01-04 22:50:00'],
        ];
    }
    
    /**
     * Expected Data - Diff
     * @return array
     */
    public static function testDiffExpected()
    {
        return [
            // 1
            ['2019-01-01 01:00:00','2019-01-01 02:00:00'],
            ['2019-01-02 01:00:00','2019-01-02 02:00:00'],
            // 2
            ['2019-01-03 01:00:00','2019-01-03 02:00:00'],
            ['2019-01-04 01:00:00','2019-01-04 02:00:00'],
            // 4
            ['2019-01-04 07:00:00','2019-01-04 07:30:00'],
            ['2019-01-04 07:40:00','2019-01-04 08:00:00'],
            // 5
            ['2019-01-04 09:00:00','2019-01-04 09:30:00'],
            ['2019-01-04 11:00:00','2019-01-04 11:30:00'],
            // 6
            ['2019-01-04 13:30:00','2019-01-04 14:00:00'],
            ['2019-01-04 15:30:00','2019-01-04 16:00:00'],
            // Multiple processing
            ['2019-01-04 17:00:00','2019-01-04 17:30:00'],
            ['2019-01-04 18:00:00','2019-01-04 18:30:00'],
            ['2019-01-04 19:00:00','2019-01-04 19:30:00'],
            // Multiple processing - cross time
            ['2019-01-04 21:00:00','2019-01-04 21:30:00'],
            ['2019-01-04 22:50:00','2019-01-04 23:00:00'],
        ];
    }
    
    /**
     * Test Data - Intersect
     * @return array
     */
    public static function testIntersectData1()
    {
        return [
            // 1
            ['2019-01-01 01:00:00','2019-01-01 02:00:00'],
            ['2019-01-02 01:00:00','2019-01-02 02:00:00'],
            // 2
            ['2019-01-03 01:00:00','2019-01-03 02:00:00'],
            ['2019-01-04 01:00:00','2019-01-04 02:00:00'],
            // 3
            ['2019-01-04 03:00:00','2019-01-04 04:00:00'],
            ['2019-01-04 05:00:00','2019-01-04 06:00:00'],
            // 4
            ['2019-01-04 07:00:00','2019-01-04 08:00:00'],
            // 5
            ['2019-01-04 09:00:00','2019-01-04 10:00:00'],
            ['2019-01-04 11:00:00','2019-01-04 12:00:00'],
            // 6
            ['2019-01-04 13:00:00','2019-01-04 14:00:00'],
            ['2019-01-04 15:00:00','2019-01-04 16:00:00'],
            // Multiple processing
            ['2019-01-04 17:00:00','2019-01-04 20:00:00'],
            // Multiple processing - cross time
            ['2019-01-04 21:00:00','2019-01-04 21:40:00'],
            ['2019-01-04 21:20:00','2019-01-04 22:00:00'],
            ['2019-01-04 22:30:00','2019-01-04 23:00:00'],
        ];
    }
    
    /**
     * Test Data - Intersect
     * @return array
     */
    public static function testIntersectData2()
    {
        return [
            // 1
            ['2019-01-01 00:30:00','2019-01-01 00:59:59'],
            ['2019-01-02 00:30:00','2019-01-02 01:00:00'],
            // 2
            ['2019-01-03 02:00:00','2019-01-03 02:30:00'],
            ['2019-01-04 02:00:01','2019-01-04 02:30:00'],
            // 3
            ['2019-01-04 03:00:00','2019-01-04 04:00:00'],
            ['2019-01-04 04:50:00','2019-01-04 06:00:01'],
            // 4
            ['2019-01-04 07:30:00','2019-01-04 07:40:00'],
            // 5
            ['2019-01-04 09:30:00','2019-01-04 10:00:00'],
            ['2019-01-04 11:30:00','2019-01-04 12:00:01'],
            // 6
            ['2019-01-04 13:00:00','2019-01-04 13:30:00'],
            ['2019-01-04 14:50:00','2019-01-04 15:30:00'],
            // Multiple processing
            ['2019-01-04 17:30:00','2019-01-04 18:00:00'],
            ['2019-01-04 18:30:00','2019-01-04 19:00:00'],
            ['2019-01-04 19:30:00','2019-01-04 20:30:00'],
            // Multiple processing - cross time
            ['2019-01-04 21:30:00','2019-01-04 22:50:00'],
        ];
    }
    
    /**
     * Expected Data - Intersect
     * @return array
     */
    public static function testIntersectExpected()
    {
        return [
            // 3
            ['2019-01-04 03:00:00','2019-01-04 04:00:00'],
            ['2019-01-04 05:00:00','2019-01-04 06:00:00'],
            // 4
            ['2019-01-04 07:30:00','2019-01-04 07:40:00'],
            // 5
            ['2019-01-04 09:30:00','2019-01-04 10:00:00'],
            ['2019-01-04 11:30:00','2019-01-04 12:00:00'],
            // 6
            ['2019-01-04 13:00:00','2019-01-04 13:30:00'],
            ['2019-01-04 15:00:00','2019-01-04 15:30:00'],
            // Multiple processing
            ['2019-01-04 17:30:00','2019-01-04 18:00:00'],
            ['2019-01-04 18:30:00','2019-01-04 19:00:00'],
            ['2019-01-04 19:30:00','2019-01-04 20:00:00'],
            // Multiple processing - cross time
            ['2019-01-04 21:30:00','2019-01-04 22:00:00'],
            ['2019-01-04 22:30:00','2019-01-04 22:50:00'],
        ];
    }
    
    /**
     * Test Data - IsOverlap
     * @return array
     */
    public static function testIsOverlapData1()
    {
        return [
            // 1
            [['2019-01-04 08:00:00','2019-01-04 12:00:00']],
            // 2
            [['2019-01-04 08:00:00','2019-01-04 12:00:00']],
            // 3
            [['2019-01-04 08:00:00','2019-01-04 12:00:00']],
            // 4
            [['2019-01-04 08:00:00','2019-01-04 12:00:00']],
            // 5
            [['2019-01-04 08:00:00','2019-01-04 12:00:00']],
            // 6
            [['2019-01-04 08:00:00','2019-01-04 12:00:00']],
            // 7
            [['2019-01-04 08:00:00','2019-01-04 12:00:00']],
            // 8
            [['2019-01-04 08:00:00','2019-01-04 12:00:00']],
            // 9
            [['2019-01-04 08:00:00','2019-01-04 12:00:00']],
            // 10
            [['2019-01-04 08:00:00','2019-01-04 12:00:00']],
            // 11
            [['2019-01-04 08:00:00','2019-01-04 12:00:00']],
        ];
    }
    
    /**
     * Test Data - IsOverlap
     * @return array
     */
    public static function testIsOverlapData2()
    {
        return [
            // 1
            [['2019-01-04 07:00:00','2019-01-04 08:00:00']],
            // 2
            [['2019-01-04 07:00:00','2019-01-04 07:59:59']],
            // 3
            [['2019-01-04 12:00:00','2019-01-04 13:00:00']],
            // 4
            [['2019-01-04 12:00:01','2019-01-04 13:00:00']],
            // 5
            [['2019-01-04 08:00:00','2019-01-04 12:00:00']],
            // 6
            [['2019-01-04 07:00:00','2019-01-04 13:00:00']],
            // 7
            [['2019-01-04 09:00:00','2019-01-04 11:00:00']],
            // 8
            [['2019-01-04 07:00:00','2019-01-04 10:00:00']],
            // 9
            [['2019-01-04 07:00:00','2019-01-04 12:00:00']],
            // 10
            [['2019-01-04 08:00:00','2019-01-04 13:00:00']],
            // 11
            [['2019-01-04 09:00:00','2019-01-04 13:00:00']],
        ];
    }
    
    /**
     * Expected Data - IsOverlap
     * @return array
     */
    public static function testIsOverlapExpected()
    {
        return [false,false,false,false,true,true,true,true,true,true,true];
    }
    
    /**
     * Test Data - Fill
     * @return array
     */
    public static function testFillData()
    {
        return [
            ['2019-01-04 08:00:00','2019-01-04 12:00:00'],
            ['2019-01-04 10:00:00','2019-01-04 19:00:00'],
            ['2019-01-04 12:00:00','2019-01-04 18:00:00']
        ];
    }
    
    /**
     * Expected Data - Fill
     * @return array
     */
    public static function testFillExpected()
    {
        return [
            ['2019-01-04 08:00:00','2019-01-04 19:00:00'],
        ];
    }
    
    /**
     * Test Data - Gap
     * @return array
     */
    public static function testGapData()
    {
        return [
            ['2019-01-04 08:00:00','2019-01-04 12:00:00'],
            ['2019-01-04 04:00:00','2019-01-04 05:00:00'],
            ['2019-01-04 07:00:00','2019-01-04 09:00:00'],
            ['2019-01-04 13:00:00','2019-01-04 18:00:00']
        ];
    }
    
    /**
     * Expected Data - Gap
     * @return array
     */
    public static function testGapExpected()
    {
        return [
            ['2019-01-04 05:00:00','2019-01-04 07:00:00'],
            ['2019-01-04 12:00:00','2019-01-04 13:00:00'],
        ];
    }
    
    /**
     * Test Data - Time
     * @return array
     */
    public static function testTimeData()
    {
        return [
            ['2019-01-04 08:00:00','2019-01-04 12:00:00'],
            ['2019-01-04 04:00:00','2019-01-04 05:00:00'],
            ['2019-01-04 07:00:00','2019-01-04 09:00:00'],
            ['2019-01-04 13:00:00','2019-01-04 18:00:00']
        ];
    }
    
    /**
     * Expected Data - Time
     * @return array
     */
    public static function testTimeExpected()
    {
        return 39600;
    }
    
    /**
     * Test Data - Format
     * @return array
     */
    public static function testFormatData()
    {
        return [
            ['2019-01-04 08:11:11','2019-01-04 12:22:22'],
            ['2019-01-04 04:33:33','2019-01-04 05:44:44'],
        ];
    }
    
    /**
     * Expected Data - Format
     * @return array
     */
    public static function testFormatExpectedS()
    {
        return [
            ['2019-01-04 08:11:11','2019-01-04 12:22:22'],
            ['2019-01-04 04:33:33','2019-01-04 05:44:44'],
        ];
    }
    
    /**
     * Expected Data - Format
     * @return array
     */
    public static function testFormatExpectedM()
    {
        return [
            ['2019-01-04 08:11:00','2019-01-04 12:22:00'],
            ['2019-01-04 04:33:00','2019-01-04 05:44:00'],
        ];
    }
    
    /**
     * Expected Data - Format
     * @return array
     */
    public static function testFormatExpectedH()
    {
        return [
            ['2019-01-04 08:00:00','2019-01-04 12:00:00'],
            ['2019-01-04 04:00:00','2019-01-04 05:00:00'],
        ];
    }
    
    /**
     * Test Data - Validate
     * @return array
     */
    public static function testValidateData1()
    {
        return [
            ['2019-01-04 08:00:00','2019-01-04 12:00:00'],
            ['2019-01-04 04:00:00','2019-01-04 05:00:00'],
        ];
    }
    
    /**
     * Test Data - Validate
     * @return array
     */
    public static function testValidateData2()
    {
        return [
            ['2019-01-04 02:00:00','2019-01-04 03:00:00'],
            ['2019-01-04 08:00:00','2019-01-04 12:00:00','2019-01-04 12:00:00'],
            ['2019-01-04 04:00:00'],
            ['2019-01-04 04:00','2019-01-04 05:00:00'],
            'string',
            ['2019-01-04 08:00:00','2019-01-04 05:00:00'],
            ['2019-01-04 19:00:00','2019-01-04 19:00:00'],
        ];
    }
    
    /**
     * Expected Data - FormValidateat
     * @return array
     */
    public static function testValidateExpected1()
    {
        return true;
    }
    
    /**
     * Expected Data - FormValidateat
     * @return array
     */
    public static function testValidateExpected2()
    {
        return false;
    }
    
    /**
     * Test Data - Filter
     * @return array
     */
    public static function testFilterData1()
    {
        return [
            ['2019-01-04 08:00:00','2019-01-04 12:00:00'],
            ['2019-01-04 04:00:00','2019-01-04 05:00:00'],
        ];
    }
    
    /**
     * Test Data - Filter
     * @return array
     */
    public static function testFilterData2()
    {
        return [
            ['2019-01-04 02:00:00','2019-01-04 03:00:00'],
            ['2019-01-04 08:00:00','2019-01-04 12:00:00','2019-01-04 12:00:00'],
            ['2019-01-04 04:00:00'],
            ['2019-01-04 04:00','2019-01-04 05:00:00'],
            'string',
            ['2019-01-04 08:00:00','2019-01-04 05:00:00'],
            ['2019-01-04 19:00:00','2019-01-04 19:00:00'],
        ];
    }
    
    /**
     * Expected Data - Filter
     * @return array
     */
    public static function testFilterExpected1()
    {
        return [
            ['2019-01-04 08:00:00','2019-01-04 12:00:00'],
            ['2019-01-04 04:00:00','2019-01-04 05:00:00'],
        ];
    }
    
    /**
     * Expected Data - Filter
     * @return array
     */
    public static function testFilterExpected2()
    {
        return [
            ['2019-01-04 02:00:00','2019-01-04 03:00:00'],
        ];
    }

}