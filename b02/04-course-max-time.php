<?php
$zend = [
    'php'           => 127,
    'zend'          => 20,
    'html'          => 32,
    'type'          => 12,
    'javascript'    => 127
];

// Input: Danh sách khóa học
// Requirement: In ra khóa học có thời lượng video nhiều nhất
// Output: Tên khóa học - thời lượng
//                  php - 127
$maxCourse = max($zend);
foreach($zend as $key => $value){
    if($maxCourse == $value){
        echo $key . ' - ' .$value .'<br/>';
    }
}