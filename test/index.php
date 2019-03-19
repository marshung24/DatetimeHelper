<?php
$file = scandir('.');

$count = 0;
foreach ($file as $f) {
    // 如果是目錄且不是.開頭
    if ((is_dir($f)) && (! preg_match("/^\..*/", $f))) {
        $count++;
        
        echo $count.' => <a href="'.$f.'">'.$f."</a>";
        echo "<br>"; 
    }
}