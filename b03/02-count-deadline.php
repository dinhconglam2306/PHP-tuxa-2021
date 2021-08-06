<?php
$input = '69';
$strID = "78, 60,62,68,69,68,73,85,66 ,69,65,74,63,67 ,65,64,68,73,75,69,73,169";

// Input: Chuỗi lưu trữ ID của các Developer bị trễ task
// Requirement: Tìm xem Developer có ID 69 bị trễ task bao nhiêu lần
// Output: 3
$arrID = explode(',',$strID);
$count = 0;
foreach($arrID as $key => $value){
    if($input == trim($value)){
        $count++;
    }
}
echo $count;