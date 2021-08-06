<?php
$input  = "D:/GoogleDrive/Doing/__psd/luutruonghailan/youtube-luutruonghailan-tamsu.psd";

$output = [
    'name' => pathinfo($input,PATHINFO_FILENAME),
    'extension'=> pathinfo($input,PATHINFO_EXTENSION)
];

echo '<pre>';
print_r($output);
echo '<pre>';