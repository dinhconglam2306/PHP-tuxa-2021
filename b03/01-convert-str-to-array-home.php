<?php
$str = "php/127/typescript/12/jquery/120/angular/50";
    /*
     * Array
     *  (
     *      'php'           => 127
     *      'typescript'    => 12
     *      'jquery'        => 120
     *      'angular'       => 50
     *  )
     *  
     */
$arr = explode("/", $str);
$result=[];
foreach($arr as $key => $value){
    if(($key % 2 == 0)){
        $result[$value] = $arr[$key + 1];
    }
}

echo '<pre>';
print_r($result);
echo '<pre>';