<?php
include_once '../vendor/autoload.php';

use marsapp\helper\datetime\DatetimeHelper;
use marsapp\helper\test\datetime\Test;
use marsapp\dev\tools\DevTools;


echo '<pre>';

// Test IsDate
Test::testIsDate();

// Test DateAdd
Test::testDateAdd();

// Test DateReduce
Test::testDateReduce();

// Test DateCal
Test::testDateCal();

