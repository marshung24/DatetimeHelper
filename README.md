# DatetimeHelper
Time processing library, providing format judgment, time increase and decrease, etc.

> Continuation library marshung/helper, only keep and maintain DatetimeHelper

[![Latest Stable Version](https://poser.pugx.org/marsapp/datetimehelper/v/stable)](https://packagist.org/packages/marsapp/datetimehelper) [![Total Downloads](https://poser.pugx.org/marsapp/datetimehelper/downloads)](https://packagist.org/packages/marsapp/datetimehelper) [![Latest Unstable Version](https://poser.pugx.org/marsapp/datetimehelper/v/unstable)](https://packagist.org/packages/marsapp/datetimehelper) [![License](https://poser.pugx.org/marsapp/datetimehelper/license)](https://packagist.org/packages/marsapp/datetimehelper)

# Outline
- [Installation](#Installation)
- [Usage](#Usage)
  - [DatetimeHelper](#DatetimeHelper)


# [Installation](#Outline)
## Composer Install
```
# composer require marsapp/datetimehelper
```

## Include
Include composer autoloader before use.
```php
require __PATH__ . "vendor/autoload.php";
```

# [Usage](#Outline)

## [DatetimeHelper](#Outline)
Namespace use:
```php
use marsapp\helper\datetime\DatetimeHelper;
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
> $unit: day, month, year, hour, minute, second

Example :
```php
DatetimeHelper::dateAdd('2019-01-31', '1', 'day');
// result: 2019-02-01

DatetimeHelper::dateAdd('2019-01-31', '1', 'month');
// result: 2019-02-28

DatetimeHelper::dateAdd('2019-01-31 12:34:56', '13', 'month', 'Y-m-d H:i:s');
// result: 2020-02-29 12:34:56

DatetimeHelper::dateAdd('2019-01-31 12:34:56', '20', 'hour', 'Y-m-d H:00:00');
// result: 2019-02-01 09:00:00
```

### dateReduce()
Date calculation - reduction

```php
dateReduce(String $date, Int $reduce = '1', String $unit = 'day', String $format = 'Y-m-d') : string
```
> $unit: day, month, year, hour, minute, second

Example :
```php
DatetimeHelper::dateReduce('2019-01-01', '1', 'day');
// result: 2018-12-31

DatetimeHelper::dateReduce('2019-01-31', '2', 'month');
// result: 2018-11-30

DatetimeHelper::dateReduce('2020-02-29 12:34:56', '1', 'year', 'Y-m-d H:i:s');
// result: 2019-02-28 12:34:56
```


### dateCal()
Date calculation
```php
dateCal(String $date, Int $difference = '1', String $unit = 'day', String $format = 'Y-m-d') : string
```
> $difference positive is add, negative is reduce  
> $unit: day, month, year, hour, minute, second  

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
$daterange = DateTimeHelper::dateIterator('2018-01-01', '2018-01-31');
foreach($daterange as $date){
    echo $date->format('Y-m-d') . '<br>';
}
```


