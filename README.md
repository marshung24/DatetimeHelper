Helper
===

> PHP Helpers liberaries

# `Deprecated, will split the library according to the function.`

[![Latest Stable Version](https://poser.pugx.org/marshung/helper/v/stable)](https://packagist.org/packages/marshung/helper) [![Total Downloads](https://poser.pugx.org/marshung/helper/downloads)](https://packagist.org/packages/marshung/helper) [![Latest Unstable Version](https://poser.pugx.org/marshung/helper/v/unstable)](https://packagist.org/packages/marshung/helper) [![License](https://poser.pugx.org/marshung/helper/license)](https://packagist.org/packages/marshung/helper)

# Outline
- [Installation](#Installation)
- [Usage](#Usage)
  - [ArrayHelper](#ArrayHelper)
  - [DatetimeHelper](#DatetimeHelper)
  - [EncodeHelper](#EncodeHelper)
  - [TimePeriodHelper](#TimePeriodHelper)


# [Installation](#Outline)
## Composer Install
```
# composer require marshung/helper
```

## Include
Include composer autoloader before use.
```php
require __PATH__ . "vendor/autoload.php";
```

# [Usage](#Outline)
## [ArrayHelper](#Outline)
Namespace use:
```php
use \marshung\helper\ArrayHelper;
```



### indexBy()
Data re-index by keys
```php
indexBy(Array & $data, Array|String $keys, Bool $obj2array = false) : array
```
> Since $data is a reference, $data will change after indexBy() is executed.  
> Since $data is a reference, the return is useless.  
> If you want to keep $data, you can clone it before using it.  

Example :
```php
$data = [
    ['c_sn' => 'a110', 'u_sn' => 'b1', 'u_no' => 'a001', 'u_name' => 'name1'],
    ['c_sn' => 'a110', 'u_sn' => 'b2', 'u_no' => 'b012', 'u_name' => 'name2'],
];

ArrayHelper::indexBy($data, ['c_sn','u_sn','u_no']);
```

$data reqult:
```php
[
    'a110' => [
        'b1' => ['a001' => ['c_sn' => 'a110', 'u_sn' => 'b1', 'u_no' => 'a001', 'u_name' => 'name1']],
        'b2' => ['b012' => ['c_sn' => 'a110', 'u_sn' => 'b2', 'u_no' => 'b012', 'u_name' => 'name2']],
    ],
];

```


### groupBy()
Data re-index and Group by keys
```php
groupBy(Array & $data, Array|String $keys, Bool $obj2array = false) : array
```
> Since $data is a reference, $data will change after indexBy() is executed.  
> Since $data is a reference, the return is useless.  
> If you want to keep $data, you can clone it before using it.  

Example :
```php
$data = [
    ['c_sn' => 'a110', 'u_sn' => 'b1', 'u_no' => 'a001', 'u_name' => 'name1'],
    ['c_sn' => 'a110', 'u_sn' => 'b2', 'u_no' => 'b012', 'u_name' => 'name2'],
    ['c_sn' => 'a110', 'u_sn' => 'b2', 'u_no' => 'b012', 'u_name' => 'user name 3'],
];

ArrayHelper::groupBy($data, ['c_sn','u_sn','u_no']);
```

$data reqult:
```php
[
    'a110' => [
        'b1' => ['a001' => [
                0 => ['c_sn' => 'a110', 'u_sn' => 'b1', 'u_no' => 'a001', 'u_name' => 'name1']
            ]
        ],
        'b2' => ['b012' => [
                0 => ['c_sn' => 'a110', 'u_sn' => 'b2', 'u_no' => 'b012', 'u_name' => 'name2'],
                1 => ['c_sn' => 'a110', 'u_sn' => 'b2', 'u_no' => 'b012', 'u_name' => 'user name 3']
            ]
        ],
    ],
];
```

### indexOnly()
Data re-index by keys, No Data
```php
indexOnly(Array & $data, Array|String $keys, Bool $obj2array = false) : array
```
> Since $data is a reference, $data will change after indexBy() is executed.  
> Since $data is a reference, the return is useless.  
> If you want to keep $data, you can clone it before using it.  

Example :
```php
$data = [
    ['c_sn' => 'a110', 'u_sn' => 'b1', 'u_no' => 'a001', 'u_name' => 'name1'],
    ['c_sn' => 'a110', 'u_sn' => 'b2', 'u_no' => 'b012', 'u_name' => 'name2'],
];

ArrayHelper::indexOnly($data, ['c_sn','u_sn','u_no']);
```

$data reqult:
```php
[
    'a110' => [
        'b1' => [
            'a001' => ''
        ],
        'b2' => [
            'b012' => ''
        ],
    ],
];
```


### getContent()
Get Data content by index
```php
getContent(Array $data, Array|String $indexTo = [], Bool $exception = false) : array|mixed
```

Example:
```php
$data = ['user' => ['name' => 'Mars', 'birthday' => '2000-01-01']];

$output = ArrayHelper::getContent($data);
// $output: ['user' => ['name' => 'Mars', 'birthday' => '2000-01-01']];

$output = ArrayHelper::getContent($data, 'user');
  // or
$output = ArrayHelper::getContent($data, ['user']);
// $output: ['name' => 'Mars', 'birthday' => '2000-01-01'];

$output = ArrayHelper::getContent($data, ['user', 'name']);
// $outpu: Mars

$output = ArrayHelper::getContent($data, ['user', 'name', 'aaa']);
// $outpu: []
```


### gather()
Data gather by list
> Collect and classify target data according to the list of fields

```php
gather(Array $data, Array $colNameList, Int $objLv = 1) : array
```

Example Data :
```php
$data = [
    0 => ['sn' => '1785','m_sn' => '40','d_sn' => '751','r_type' => 'staff','manager' => '1','s_manager' => '1','c_user' => '506'],
    1 => ['sn' => '1371','m_sn' => '40','d_sn' => '583','r_type' => 'staff','manager' => '61','s_manager' => '0','c_user' => '118'],
    2 => ['sn' => '1373','m_sn' => '40','d_sn' => '584','r_type' => 'staff','manager' => '61','s_manager' => '0','c_user' => '118'],
    3 => ['sn' => '7855','m_sn' => '40','d_sn' => '2303','r_type' => 'staff','manager' => '71','s_manager' => '0','c_user' => '61'],
    4 => ['sn' => '7856','m_sn' => '40','d_sn' => '2304','r_type' => 'staff','manager' => '75','s_manager' => '0','c_user' => '61']
];
```

Example 1 :
> Field `manager`, `s_manager`, `c_user values` are placed in the same one-dimensional array
```php
$ssnList1 = ArrayHelper::gather($data, array('manager', 's_manager','c_user'), 1);
```
$ssnList1 reqult:
```php
[1 => '1',506 => '506',61 => '61',0 => '0',118 => '118',71 => '71',75 => '75'];
```

Example 2 :
> The field `manager` is placed in an array, the fields `s_manager`, and the `c_user` values are placed in the same array. Form a 2-dimensional array
```php
$ssnList2 = ArrayHelper::gather($data, array('manager' => array('manager'), 'other' => array('s_manager','c_user')), 1);
```
$ssnList2 reqult:
```php
[
    'manager' => [1 => '1',61 => '61',71 => '71',75 => '75'],
    'other' => [1 => '1',506 => '506',0 => '0',118 => '118',61 => '61']
];
```


### diffRecursive()
Array Deff Recursive
> Compare $srcArray with $contrast and display it if something on $srcArray is not on $contrast.
```php
diffRecursive(Array $srcArray, $contrast) : array
```

Example :
```php
$data1 = [
    0 => ['c_sn' => 'a110', 'u_sn' => 'b1', 'u_no' => 'a001', 'u_name' => 'name1'],
    1 => ['c_sn' => 'a110', 'u_sn' => 'b2', 'u_no' => 'b012', 'u_name' => 'name2'],
    2 => ['c_sn' => 'a110', 'u_sn' => null, 'u_no' => 'c024', 'u_name' => 'name3'],
];
$data2 = [
    0 => ['c_sn' => 'a110', 'u_sn' => 'b1', 'u_no' => 'a001', 'u_name' => 'name1'],
    1 => ['c_sn' => 'a110', 'u_sn' => 'b2', 'u_no' => 'b012', 'u_name' => 'name2222'],
    2 => ['c_sn' => 'a110', 'u_sn' => 'b2', 'u_no' => 'c024', 'u_name' => 'user name 3'],
];

$diff = ArrayHelper::diffRecursive($data1, $data2);
```
$diff result :
```php
[
    1 => ['u_name' => 'name2'],
    2 => ['u_sn' => NULL,'u_name' => 'name3']
];
```


### sortRecursive()
Array Sort Recursive
```php
sortRecursive(Array & $srcArray, $type = 'ksort') : void
```
> $srcArray is a reference  
> $type : ksort(default), krsort, sort, rsort  

Example :
```php
$data1 = [
    'b1' => [
        0 => ['c_sn' => 'a110', 'u_sn' => 'b1', 'u_no' => 'a001', 'u_name' => 'name1']
    ],
    'b2' => [
        0 => ['c_sn' => 'a110', 'u_sn' => 'b2', 'u_no' => 'b012', 'u_name' => 'name2'],
        1 => ['c_sn' => 'a110', 'u_sn' => 'b2', 'u_no' => 'b012', 'u_name' => 'user name 3']
    ],
];

$data2 = $data1;

ArrayHelper::sortRecursive($data1, 'ksort');
ArrayHelper::sortRecursive($data2, 'krsort');
```

$data1 result:
```php
[
    'b1' => [
        0 => ['c_sn' => 'a110','u_name' => 'name1','u_no' => 'a001','u_sn' => 'b1']
    ],
    'b2' => [
        0 => ['c_sn' => 'a110','u_name' => 'name2','u_no' => 'b012','u_sn' => 'b2'],
        1 => ['c_sn' => 'a110','u_name' => 'user name 3','u_no' => 'b012','u_sn' => 'b2']
    ]
];
```

$data2 result:
```php
[
    'b2' => [
        1 => ['u_sn' => 'b2','u_no' => 'b012','u_name' => 'user name 3','c_sn' => 'a110'],
        0 => ['u_sn' => 'b2','u_no' => 'b012','u_name' => 'name2','c_sn' => 'a110']
    ],
    'b1' => [
        0 => ['u_sn' => 'b1','u_no' => 'a001','u_name' => 'name1','c_sn' => 'a110']
    ]
];
```



## [DatetimeHelper](#Outline)
Namespace use:
```php
use \marshung\helper\DatetimeHelper;
```


### isDate()
Determine if the date is legal
```php
isDate($date) : Bool
```

Example :
```php
if (DatetimeHelper::isDate('2019-01-15)) {
	die('Date format error');
}
```

### dateAdd()
Date calculation - increase

```php
dateAdd(String $date, Int $add = '1', String $unit = 'day', String $format = 'Y-m-d') : string
```
> $unit: day,month,year

Example :
```php
DatetimeHelper::dateAdd('2019-01-31', '1', 'day');
// result: 2019-02-01

DatetimeHelper::dateAdd('2019-01-31', '1', 'month');
// result: 2019-02-28

DatetimeHelper::dateAdd('2019-01-31', '13', 'month');
// result: 2020-02-29
```

### dateReduce()
Date calculation - reduction

```php
dateReduce(String $date, Int $reduce = '1', String $unit = 'day', String $format = 'Y-m-d') : string
```
> $unit: day,month,year

Example :
```php
DatetimeHelper::dateReduce('2019-01-01', '1', 'day');
// result: 2018-12-31

DatetimeHelper::dateReduce('2019-01-31', '2', 'month');
// result: 2018-11-30

DatetimeHelper::dateReduce('2020-02-29', '1', 'year');
// result: 2019-02-28
```


### dateCal()
Date calculation
```php
dateCal(String $date, Int $difference = '1', String $unit = 'day', String $format = 'Y-m-d') : string
```
> $difference positive is add, negative is reduce  
> $unit: day,month,year  

Example :
```php
DatetimeHelper::dateCal('2019-01-31', '1', 'month');
// result: 2019-02-28

DatetimeHelper::dateCal('2020-02-29', '-1', 'year');
// result: 2019-02-28
```


### dateIterator()
Get Date Iterator - Iteration Date in Days
```php
dateIterator($startDate, $endDate)
```

Example :
```php
$daterange = \app\helpers\DateTimeHelper::dateIterator('2018-01-01', '2018-01-31');
foreach($daterange as $date){
    echo $date->format('Y-m-d') . '<br>';
}
```


## [EncodeHelper](#Outline)
Namespace use:
```php
use \marshung\helper\EncodeHelper;
```


### snapshotEncode()
Snapshot encode(zip)
```php
snapshotEncode($data, $forceCompress = false) : String
```

Example :
```php
$data = [
    ['c_sn' => 'a110', 'u_sn' => 'b1', 'u_no' => 'a001', 'u_name' => 'name1'],
];

$result = EncodeHelper::snapshotEncode($data);
```
$result:
```php
// String
$result = '0[{"c_sn":"a110","u_sn":"b1","u_no":"a001","u_name":"name1"}]';
```


### snapshotDecode()
Snapshot decode(unzip)
```php
snapshotDecode(String $data, $assoc = true) : mixed
```

Example :
```php
$data = '0[{"c_sn":"a110","u_sn":"b1","u_no":"a001","u_name":"name1"}]';

$result = EncodeHelper::snapshotDecode($data);
```
$result:
```php
$result = [
    ['c_sn' => 'a110', 'u_sn' => 'b1', 'u_no' => 'a001', 'u_name' => 'name1'],
];
```


## [TimePeriodHelper](#Outline)
> 1. Format: $timePeriods = [[$startDatetime1, $endDatetime1], [$startDatetime2, $endDatetime2], ...];
>   - $Datetime = Y-m-d H:i:s ; Y-m-d H:i:00 ; Y-m-d H:00:00 ;
> 2. If it is hour/minute/second, the end point is usually not included, for example, 8 o'clock to 9 o'clock is 1 hour.
> 3. If it is a day/month/year, it usually includes an end point, for example, January to March is 3 months.
> 4. When processing, assume that the data format is correct. If necessary, you need to call the verification function to verify the data.

### Usage:
```php
// Namespace use
use \marshung\helper\TimePeriodHelper;

// Get time periods
$timeperiods = [.....];

// Filter time periods, ensure that the target data is correct
$timeperiods = TimePeriodHelper::filter($timeperiods);

// Maybe you want change time format
$timeperiods = TimePeriodHelper::setUnit('minute')->format($templete);

// Now you can execute the function you want to execute. Like gap()
$result = TimePeriodHelper::gap($timeperiods);
```

### sort()
Sort time periods (Order by ASC)
> When sorting, sort the start time first, if the start time is the same, then sort the end time  
> Sort Priority: Start Time => End Time

```php
sort(Array $timePeriods) : array
```

Example :
```php
$templete = [
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
$result = TimePeriodHelper::sort($templete);
```

Sort $result:
```php
$result = [
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
```


### union()
Union one or more time periods
> Sort and merge one or more time periods with contacts

```php
TimePeriodHelper::union(Array $timePeriods1, [Array $timePeriods2, [Array $timePeriods3, ......]]) : array
```

Example :
```php

$templete1 = [
    ['2019-01-04 13:00:00','2019-01-04 15:00:00'],
    ['2019-01-04 10:00:00','2019-01-04 12:00:00'],
    ['2019-01-04 19:00:00','2019-01-04 22:00:00'],
    ['2019-01-04 15:00:00','2019-01-04 18:00:00']
];

$templete2 = [
    ['2019-01-04 08:00:00','2019-01-04 09:00:00'],
    ['2019-01-04 14:00:00','2019-01-04 16:00:00'],
    ['2019-01-04 21:00:00','2019-01-04 23:00:00']
];
// Sort and merge one timeperiods
$result1 = TimePeriodHelper::union($templete1);

// Sort and merge two timeperiods
$result2 = TimePeriodHelper::union($templete1, $templete2);
```

$result:
```php
$result1 = [
    ['2019-01-04 10:00:00','2019-01-04 12:00:00'],
    ['2019-01-04 13:00:00','2019-01-04 18:00:00'],
    ['2019-01-04 19:00:00','2019-01-04 22:00:00']
];

$result2 = [
    ['2019-01-04 08:00:00','2019-01-04 09:00:00'],
    ['2019-01-04 10:00:00','2019-01-04 12:00:00'],
    ['2019-01-04 13:00:00','2019-01-04 18:00:00'],
    ['2019-01-04 19:00:00','2019-01-04 23:00:00']
];
```


### diff()
Computes the difference of time periods
> Compares $timePeriods1 against $timePeriods2 and returns the values in $timePeriods1 that are not present in $timePeriods2.

```php
diff(Array $timePeriods1, Array $timePeriods2, $sortOut = true) : array
```
> If you can be sure that the input value is already collated(Executed union()), you can turn off $sortOut to make execution faster.

Example :
```php
$templete1 = [
    ['2019-01-04 07:00:00','2019-01-04 08:00:00']
];
$templete2 = [
    ['2019-01-04 07:30:00','2019-01-04 07:40:00'],
];

$result = TimePeriodHelper::diff($templete1, $templete2);
```

$result:
```php
$result = [
    ['2019-01-04 07:00:00','2019-01-04 07:30:00'],
    ['2019-01-04 07:40:00','2019-01-04 08:00:00'],
];
```


### intersect()
Computes the intersection of time periods
```php
intersect(Array $timePeriods1, Array $timePeriods2, $sortOut = true) : array
```
> If you can be sure that the input value is already collated(Executed union()), you can turn off $sortOut to make execution faster.

Example :
```php
$templete1 = [
    ['2019-01-04 07:00:00','2019-01-04 08:00:00']
];
$templete2 = [
    ['2019-01-04 07:30:00','2019-01-04 07:40:00'],
];

$result = TimePeriodHelper::intersect($templete1, $templete2);
```

$result:
```php
$result = [
    ['2019-01-04 07:30:00','2019-01-04 07:40:00'],
];
```


### isOverlap()
Time period is overlap
> Determine if there is overlap between the two time periods

```php
isOverlap(Array $timePeriods1, Array $timePeriods2) : bool
```

Example :
```php
$templete1 = [
    ['2019-01-04 07:00:00','2019-01-04 08:00:00']
];
$templete2 = [
    ['2019-01-04 07:30:00','2019-01-04 07:40:00'],
];
$result = TimePeriodHelper::isOverlap($templete1, $templete2);
```

$result:
```php
$result = true;
```


### fill()
Fill time periods
> Leaving only the first start time and the last end time

```php
fill(Array $timePeriods) : array
```

Example :
```php
$templete = [
    ['2019-01-04 08:00:00','2019-01-04 12:00:00'],
    ['2019-01-04 10:00:00','2019-01-04 19:00:00'],
    ['2019-01-04 12:00:00','2019-01-04 18:00:00']
];

$result = TimePeriodHelper::fill($templete);
```

$result:
```php
$result = [
    ['2019-01-04 08:00:00','2019-01-04 19:00:00'],
];
```


### gap()
Get gap time periods of multiple sets of time periods

```php
gap(Array $timePeriods, $sortOut = true) : array
```
> If you can be sure that the input value is already collated(Executed union()), you can turn off $sortOut to make execution faster.

Example :
```php
$templete = [
    ['2019-01-04 08:00:00','2019-01-04 12:00:00'],
    ['2019-01-04 04:00:00','2019-01-04 05:00:00'],
    ['2019-01-04 07:00:00','2019-01-04 09:00:00'],
    ['2019-01-04 13:00:00','2019-01-04 18:00:00']
];

$result = TimePeriodHelper::gap($templete, false);
```

$result:
```php
$result = [
    ['2019-01-04 05:00:00','2019-01-04 07:00:00'],
    ['2019-01-04 12:00:00','2019-01-04 13:00:00'],
];
```


### time()
Calculation period total time
> You can specify the smallest unit (from setUnit())

```php
time(Array $timePeriods, $sortOut = true) : array
```
> If you can be sure that the input value is already collated(Executed union()), you can turn off $sortOut to make execution faster.

Example :
```php
$templete = [
    ['2019-01-04 08:00:00','2019-01-04 12:00:00'],
    ['2019-01-04 04:00:00','2019-01-04 05:00:00'],
    ['2019-01-04 07:00:00','2019-01-04 09:00:00'],
    ['2019-01-04 13:00:00','2019-01-04 18:00:00']
];

TimePeriodHelper::setUnit('hour');
$resultH = TimePeriodHelper::time($templete);

$resultM = TimePeriodHelper::setUnit('minutes')->time($templete);

TimePeriodHelper::setUnit('s');
$resultS = TimePeriodHelper::time($templete);
```
> Unit:  
> - hour, hours, h  
> - minute, minutes, m  
> - second, seconds, s

$result:
```php
$resultH = 11;
$resultM = 660;
$resultS = 39600;
```


### format()
Transform format
```php
format(Array $timePeriods, $unit = 'default') : array
```
> $unit: Time unit, if default,use class options setting

Example :
```php
$templete = [
    ['2019-01-04 08:11:11','2019-01-04 12:22:22'],
    ['2019-01-04 04:33:33','2019-01-04 05:44:44'],
];

TimePeriodHelper::setUnit('minute');
$result = TimePeriodHelper::format($templete);
```

$result:
```php
$result = [
    ['2019-01-04 08:11:00','2019-01-04 12:22:00'],
    ['2019-01-04 04:33:00','2019-01-04 05:44:00'],
];
```


### validate()
Validate time period
> Verify format, size, start/end time.  
> Format: Y-m-d H:i:s

```php
validate(Array $timePeriods) : Exception | true
```

Example :
```php
$templete = [
    ['2019-01-04 02:00:00','2019-01-04 03:00:00'],
    ['2019-01-04 08:00:00','2019-01-04 12:00:00','2019-01-04 12:00:00'],
    ['2019-01-04 04:00:00'],
    ['2019-01-04 04:00','2019-01-04 05:00:00'],
    'string',
    ['2019-01-04 08:00:00','2019-01-04 05:00:00'],
    ['2019-01-04 19:00:00','2019-01-04 19:00:00'],
];

try {
    $result = TimePeriodHelper::validate($templete);
} catch (\Exception $e) {
    $result = false;
}
```

$result:
```php
$result = false;
```


### filter()
Remove invalid time period
> Verify format, size, start/end time, and remove invalid.

```php
filter(Array $timePeriods, $exception = false) : array
```
> $exception: Whether an exception is returned when an error occurs.(default false)
> @see setFilterDatetime();

Example :
```php
$templete = [
    ['2019-01-04 02:00:00','2019-01-04 03:00:00'],
    ['2019-01-04 08:00:00','2019-01-04 12:00:00','2019-01-04 12:00:00'],
    ['2019-01-04 04:00:00'],
    ['2019-01-04 04:00','2019-01-04 05:00:00'],
    'string',
    ['2019-01-04 08:00:00','2019-01-04 05:00:00'],
    ['2019-01-04 19:00:00','2019-01-04 19:00:00'],
];

//TimePeriodHelper::setFilterDatetime(false);
$result = TimePeriodHelper::filter($templete);
```
> If you do not want to filter the datetime format, set it to setFilterDatetime(false).  
> Maybe the time format is not Y-m-d H:i:s (such as Y-m-d H:i), you need to close it.

$result:
```php
$result = [
    ['2019-01-04 02:00:00','2019-01-04 03:00:00'],
];
```


### setUnit()
Specify the minimum unit of calculation
> hour,minute,second

```php
setUnit(string $unit, string $target = 'all') : self
```
> $target: Specify function,or all functions

Example :
```php
// Set unit hour for all
TimePeriodHelper::setUnit('hour');
// Set unit hour for format
TimePeriodHelper::setUnit('minute', 'format');

// Get unit
$result1 = TimePeriodHelper::getUnit('time');
$result2 = TimePeriodHelper::getUnit('format');
```

$result:
```php
$result1 = 'hour';
$result2 = 'minute';
```

### getUnit()
Get the unit used by the specified function
```php
getUnit(string $target) : string
```

Example :
```php
// Set unit hour for all
TimePeriodHelper::setUnit('hour');
// Set unit hour for format
TimePeriodHelper::setUnit('minute', 'format');

// Get unit
$result1 = TimePeriodHelper::getUnit('time');
$result2 = TimePeriodHelper::getUnit('format');
```

$result:
```php
$result1 = 'hour';
$result2 = 'minute';
```

### setFilterDatetime()
If neet filter datetime : Set option
> If you do not want to filter the datetime format, set it to false.  
> Maybe the time format is not Y-m-d H:i:s (such as Y-m-d H:i), you need to close it.

```php
setFilterDatetime(Bool $bool) : self
```

Example :
```php
TimePeriodHelper::setFilterDatetime(false);
$result1 = TimePeriodHelper::getFilterDatetime();

TimePeriodHelper::setFilterDatetime(true);
$result2 = TimePeriodHelper::getFilterDatetime();
```

$result:
```php
$result1 = false;

$result1 = true;
```

### getFilterDatetime()
If neet filter datetime : Get option
```php
getFilterDatetime() : bool
```

Example :
```php
TimePeriodHelper::setFilterDatetime(false);
$result1 = TimePeriodHelper::getFilterDatetime();

TimePeriodHelper::setFilterDatetime(true);
$result2 = TimePeriodHelper::getFilterDatetime();
```

$result:
```php
$result1 = false;

$result1 = true;
```

