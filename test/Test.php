<?php
namespace marsapp\helper\test\datetime;

use marsapp\helper\datetime\DatetimeHelper;
use marsapp\dev\tools\DevTools;

/**
 * Test for DatetimeHelper
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
     * Test IsDate
     *
     * @param string $detail
     */
    public static function testIsDate($detail = false)
    {
        $templete1 = self::testIsDateData1();
        $expected1 = self::testIsDateExpected1();
        
        $templete2 = self::testIsDateData2();
        $expected2 = self::testIsDateExpected2();
        
        // The same
        $result1 = DatetimeHelper::isDate($templete1);
        $theSame1 = DevTools::theSame($result1, $expected1, $detail);
        
        // The same
        $result2 = DatetimeHelper::isDate($templete2);
        $theSame2 = DevTools::theSame($result2, $expected2, $detail);
        
        
        $theSame = $theSame1 && $theSame2;
        
        DevTools::isTheSame($theSame, __FUNCTION__);
    }
    
    /**
     * Test DateAdd
     *
     * @param string $detail
     */
    public static function testDateAdd($detail = false)
    {
        $templetes = self::testDateAddData();
        $expecteds = self::testDateAddExpected();
        
        $theSame = true;
        foreach ($templetes as $k => $templete) {
            // The same
            $result = call_user_func_array(['\marsapp\helper\datetime\DatetimeHelper','dateAdd'], $templete);
            $theSame = $theSame && DevTools::theSame($result, $expecteds[$k], $detail);
        }
        
        DevTools::isTheSame($theSame, __FUNCTION__);
    }
    
    /**
     * Test DateReduce
     *
     * @param string $detail
     */
    public static function testDateReduce($detail = false)
    {
        $templetes = self::testDateReduceData();
        $expecteds = self::testDateReduceExpected();
        
        $theSame = true;
        foreach ($templetes as $k => $templete) {
            // The same
            $result = call_user_func_array(['\marsapp\helper\datetime\DatetimeHelper','dateReduce'], $templete);
            $theSame = $theSame && DevTools::theSame($result, $expecteds[$k], $detail);
        }
        
        DevTools::isTheSame($theSame, __FUNCTION__);
    }
    
    /**
     * Test DateCal
     *
     * @param string $detail
     */
    public static function testDateCal($detail = false)
    {
        $templetes = self::testDateCalData();
        $expecteds = self::testDateCalExpected();
        
        $theSame = true;
        foreach ($templetes as $k => $templete) {
            // The same
            $result = call_user_func_array(['\marsapp\helper\datetime\DatetimeHelper','dateCal'], $templete);
            $theSame = $theSame && DevTools::theSame($result, $expecteds[$k], $detail);
        }
        
        DevTools::isTheSame($theSame, __FUNCTION__);
    }
    
    
    /**
     * ****************************************************
     * ************** Data Templete Function **************
     * ****************************************************
     */
    
    /**
     * Test Data - IsDate
     * @return array
     */
    public static function testIsDateData1()
    {
        return '2019-01-01';
    }
    
    /**
     * Expected Data - IsDate
     * @return array
     */
    public static function testIsDateExpected1()
    {
        return true;
    }
    
    /**
     * Test Data - IsDate
     * @return array
     */
    public static function testIsDateData2()
    {
        return '2019-01-00';
    }
    
    /**
     * Expected Data - IsDate
     * @return array
     */
    public static function testIsDateExpected2()
    {
        return false;
    }
    
    /**
     * Test Data - DateAdd
     * @return array
     */
    public static function testDateAddData()
    {
        return [
            ['2019-01-31', '1'],
            ['2019-01-31', '1', 'month'],
            ['2019-01-31', '1', 'months'],
            ['2019-01-31', '1', 'year'],
            ['2019-01-31', '1', 'years'],
            
            ['2019-01-31 12:34:56', '1', 'day', 'Y-m-d H:i:s'],
            ['2019-01-31 12:34:56', '1', 'month', 'Y-m-d H:i:s'],
            ['2019-01-31 12:34:56', '1', 'month', 'Y-m-d H:i'],
            ['2019-01-31 12:34:56', '1', 'year', 'Y-m-d H:i:s'],
            ['2019-01-31 12:34:56', '1', 'year', 'Y-m-d H'],
            
            ['2019-01-31 12:34:56', '1', 'hour', 'Y-m-d H:i:s'],
            ['2019-01-31 12:34:56', '20', 'minute', 'Y-m-d H:i:s'],
            ['2019-01-31 12:34:56', '30', 'second', 'Y-m-d H:i:s'],
        ];
    }
    
    /**
     * Expected Data - DateAdd
     * @return array
     */
    public static function testDateAddExpected()
    {
        return [
            '2019-02-01',
            '2019-02-28',
            '2019-02-28',
            '2020-01-31',
            '2020-01-31',
            
            '2019-02-01 12:34:56',
            '2019-02-28 12:34:56',
            '2019-02-28 12:34',
            '2020-01-31 12:34:56',
            '2020-01-31 12',
            
            '2019-01-31 13:34:56',
            '2019-01-31 12:54:56',
            '2019-01-31 12:35:26',
        ];
    }
    
    /**
     * Test Data - DateReduce
     * @return array
     */
    public static function testDateReduceData()
    {
        return [
            ['2019-02-01', '1'],
            ['2019-03-31', '1', 'month'],
            ['2019-03-31', '1', 'months'],
            ['2020-02-29', '1', 'year'],
            ['2020-02-29', '1', 'years'],
            
            ['2019-02-01 12:34:56', '1', 'day', 'Y-m-d H:i:s'],
            ['2019-03-31 12:34:56', '1', 'month', 'Y-m-d H:i:s'],
            ['2019-03-31 12:34:56', '1', 'months', 'Y-m-d H:i'],
            ['2020-02-29 12:34:56', '1', 'year', 'Y-m-d H:i:s'],
            ['2020-02-29 12:34:56', '1', 'years', 'Y-m-d H'],
            
            ['2019-01-31 12:34:56', '1', 'hour', 'Y-m-d H:i:s'],
            ['2019-01-31 12:34:56', '20', 'minute', 'Y-m-d H:i:s'],
            ['2019-01-31 12:34:56', '30', 'second', 'Y-m-d H:i:s'],
        ];
    }
    
    /**
     * Expected Data - DateReduce
     * @return array
     */
    public static function testDateReduceExpected()
    {
        return [
            '2019-01-31',
            '2019-02-28',
            '2019-02-28',
            '2019-02-28',
            '2019-02-28',
            
            '2019-01-31 12:34:56',
            '2019-02-28 12:34:56',
            '2019-02-28 12:34',
            '2019-02-28 12:34:56',
            '2019-02-28 12',
            
            '2019-01-31 11:34:56',
            '2019-01-31 12:14:56',
            '2019-01-31 12:34:26',
        ];
    }
    
    /**
     * Test Data - DateCal
     * @return array
     */
    public static function testDateCalData()
    {
        return [
            ['2019-01-31', '1'],
            ['2019-01-31', '1', 'month'],
            ['2019-01-31', '1', 'months'],
            ['2019-01-31', '1', 'year'],
            ['2019-01-31', '1', 'years'],
            
            ['2019-01-31 12:34:56', '1', 'day', 'Y-m-d H:i:s'],
            ['2019-01-31 12:34:56', '1', 'month', 'Y-m-d H:i:s'],
            ['2019-01-31 12:34:56', '1', 'month', 'Y-m-d H:i'],
            ['2019-01-31 12:34:56', '1', 'year', 'Y-m-d H:i:s'],
            ['2019-01-31 12:34:56', '1', 'year', 'Y-m-d H'],
            
            ['2019-01-31 12:34:56', '1', 'hour', 'Y-m-d H:i:s'],
            ['2019-01-31 12:34:56', '20', 'minute', 'Y-m-d H:i:s'],
            ['2019-01-31 12:34:56', '30', 'second', 'Y-m-d H:i:s'],
            
            //------ 
            
            ['2019-02-01', '-1'],
            ['2019-03-31', '-1', 'month'],
            ['2019-03-31', '-1', 'months'],
            ['2020-02-29', '-1', 'year'],
            ['2020-02-29', '-1', 'years'],
            
            ['2019-02-01 12:34:56', '-1', 'day', 'Y-m-d H:i:s'],
            ['2019-03-31 12:34:56', '-1', 'month', 'Y-m-d H:i:s'],
            ['2019-03-31 12:34:56', '-1', 'months', 'Y-m-d H:i'],
            ['2020-02-29 12:34:56', '-1', 'year', 'Y-m-d H:i:s'],
            ['2020-02-29 12:34:56', '-1', 'years', 'Y-m-d H'],
            
            ['2019-01-31 12:34:56', '-1', 'hour', 'Y-m-d H:i:s'],
            ['2019-01-31 12:34:56', '-20', 'minute', 'Y-m-d H:i:00'],
            ['2019-01-31 12:34:56', '-30', 'second', 'Y-m-d H:i:s'],
        ];
    }
    
    /**
     * Expected Data - DateCal
     * @return array
     */
    public static function testDateCalExpected()
    {
        return [
            '2019-02-01',
            '2019-02-28',
            '2019-02-28',
            '2020-01-31',
            '2020-01-31',
            
            '2019-02-01 12:34:56',
            '2019-02-28 12:34:56',
            '2019-02-28 12:34',
            '2020-01-31 12:34:56',
            '2020-01-31 12',
            
            '2019-01-31 13:34:56',
            '2019-01-31 12:54:56',
            '2019-01-31 12:35:26',
            
            //------
            
            '2019-01-31',
            '2019-02-28',
            '2019-02-28',
            '2019-02-28',
            '2019-02-28',
            
            '2019-01-31 12:34:56',
            '2019-02-28 12:34:56',
            '2019-02-28 12:34',
            '2019-02-28 12:34:56',
            '2019-02-28 12',
            
            '2019-01-31 11:34:56',
            '2019-01-31 12:14:00',
            '2019-01-31 12:34:26',
        ];
    }

}