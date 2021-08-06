<?php
$arrMenu = [
    'index' => [
        "name"  => "Home",   "link"  => "index.php"
    ],
    'about' => [
        "name"  => "About",
        "link"  => "data/about.php",
        "child" => [
            'service'   => [
                "name"  => "Service",
                "link"  => "service.php",
                "child" => [
                    'sale'      => ["name" => "Sale", "link" => "sale.php"],
                    'training'  => ["name" => "Training", "link" => "training.php"]
                ]
            ],
            'company'   => [
                "name" => "Company",
                "link" => "company.php",
                "child" => [
                    'toyota' => ["name" => "Toyota", "link"   => "toyota.php"]
                ]
            ]
        ]
    ],
    'contact' => ["name" => "Contact", "link" => "contact.php"]
];
$xhtml = '';
foreach($arrMenu as $keyLevelOne => $valueLevelOne){
    $xhtml .= $valueLevelOne['name'] . ' - ';
}
$xhtml = substr($xhtml,0,-3);
echo $xhtml;

    // Yêu cầu: In ra tên của các menu cấp 1, 
    // Output: Home - About - Contact