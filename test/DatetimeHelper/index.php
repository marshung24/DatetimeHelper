<?php
include_once '../../vendor/autoload.php';

use marshung\helperTest\tools\DevTools;
use marshung\helper\DatetimeHelper;

echo '<pre>';

//=======
$res = \marshung\helper\DatetimeHelper::isDate('2018-01-01');
echo "isDate('2018-01-01'): ".var_export($res, 1)."\n";

//=======
$res = \marshung\helper\DatetimeHelper::isDate('2018-01-00');
echo "isDate('2018-01-00') : ".var_export($res, 1)."\n";

//=======
$res = \marshung\helper\DatetimeHelper::dateAdd('2018-01-01', '1');
echo "dateAdd('2018-01-01', '1') : ".var_export($res, 1)."\n";

//=======
$res = \marshung\helper\DatetimeHelper::dateReduce('2018-01-01', '1');
echo "dateReduce('2018-01-01', '1') : ".var_export($res, 1)."\n";

//=======
$res = \marshung\helper\DatetimeHelper::dateCal('2018-01-01', '1');
echo "dateCal('2018-01-01', '1') : ".var_export($res, 1)."\n";

//=======
$res = \marshung\helper\DatetimeHelper::dateCal('2018-01-01', '-1');
echo "dateCal('2018-01-01', '-1') : ".var_export($res, 1)."\n";












