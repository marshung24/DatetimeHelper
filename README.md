Helper
===

> PHP Helpers liberaries


[![Latest Stable Version](https://poser.pugx.org/marshung/helper/v/stable)](https://packagist.org/packages/marshung/helper) [![Total Downloads](https://poser.pugx.org/marshung/helper/downloads)](https://packagist.org/packages/marshung/helper) [![Latest Unstable Version](https://poser.pugx.org/marshung/helper/v/unstable)](https://packagist.org/packages/marshung/helper) [![License](https://poser.pugx.org/marshung/helper/license)](https://packagist.org/packages/marshung/helper)

# Outline
- [Installation](#Installation)
- [Usage](#Usage)
  - [ArrayHelper](#ArrayHelper)
  - [DatetimeHelper](#DatetimeHelper)
  - [EncodeHelper](#EncodeHelper)


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
$ssnList1 = ArrayHelper::gatherData($data, array('manager', 's_manager','c_user'), 1);
```
$ssnList1 reqult:
```php
[1 => '1',506 => '506',61 => '61',0 => '0',118 => '118',71 => '71',75 => '75'];
```

Example 2 :
> The field `manager` is placed in an array, the fields `s_manager`, and the `c_user` values are placed in the same array. Form a 2-dimensional array
```php
$ssnList2 = ArrayHelper::gatherData($data, array('manager' => array('manager'), 'other' => array('s_manager','c_user')), 1);
```
$ssnList2 reqult:
```php
[
	'manager' => [1 => '1',61 => '61',71 => '71',75 => '75'],
    'other' => [1 => '1',506 => '506',0 => '0',118 => '118',61 => '61']
];
```


### arrayDiffRecursive()
Array Deff Recursive
> Compare $srcArray with $contrast and display it if something on $srcArray is not on $contrast.
```php
arrayDiffRecursive(Array $srcArray, $contrast) : array
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

$diff = ArrayHelper::arrayDiffRecursive($data1, $data2);
```
$diff result :
```php
[
    1 => ['u_name' => 'name2'],
    2 => ['u_sn' => NULL,'u_name' => 'name3']
];
```


### arraySortRecursive()
Array Sort Recursive
```php
arraySortRecursive(Array & $srcArray, $type = 'ksort') : void
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

ArrayHelper::arraySortRecursive($data1, 'ksort');
ArrayHelper::arraySortRecursive($data2, 'krsort');
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
