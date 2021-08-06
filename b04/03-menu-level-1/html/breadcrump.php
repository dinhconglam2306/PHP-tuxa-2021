<?php $arrMenu = [
    'index' => [
        "name"  => "Home", "link"  => "index.php"
    ],
    'about' => [
        "name"  => "About",
        "link"  => "about.php",
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
                "name"  => "Company",
                "link"  => "company.php",
                "child" => [
                    'toyota' => ["name" => "Toyota", "link"   => "toyota.php"]
                ]
            ]
        ]
    ],
    'contact' => ["name" => "Contact", "link" => "contact.php"]
];

$activePage = basename($_SERVER['PHP_SELF'], ".php");
$breadcrumbArr = [];

foreach ($arrMenu as $keyLevelOne => $valueLevelOne) {
    $breadcrumbArr[$keyLevelOne][] = $valueLevelOne['name'];
    if (isset($valueLevelOne['child'])) {
        foreach ($valueLevelOne['child'] as $keyLevelTwo => $valueLevelTwo) {
            $breadcrumbArr[$keyLevelTwo][] = $valueLevelOne['name'];
            $breadcrumbArr[$keyLevelTwo][] = $valueLevelTwo['name'];
            if (isset($valueLevelTwo['child'])) {
                foreach ($valueLevelTwo['child'] as $keyLevelThree => $valueLevelThree) {
                    $breadcrumbArr[$keyLevelThree][] = $valueLevelOne['name'];
                    $breadcrumbArr[$keyLevelThree][] = $valueLevelTwo['name'];
                    $breadcrumbArr[$keyLevelThree][] = $valueLevelThree['name'];
                }
            }
        }
    }
}
// $breadcrumbArrChild = $breadcrumbArr=[$activePage];
$breadcrumbArr = $breadcrumbArr[$activePage][0];
if ($activePage == 'index') {
    echo sprintf('<div class="breadcrumb">
            <span>%s</span>
         </div>', $breadcrumbArr);
} else {
    echo sprintf('<div class="breadcrumb">
            <a href="index.php">Home</a>
            <span>></span>
            <span>%s</span>
        </div>', $breadcrumbArr);
}
