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
    $breadcrumbArr[$keyLevelOne][] = ['name' => $valueLevelOne['name'], 'link' => $valueLevelOne['link']];
    if (isset($valueLevelOne['child'])) {
        foreach ($valueLevelOne['child'] as $keyLevelTwo => $valueLevelTwo) {
            $breadcrumbArr[$keyLevelTwo][] = ['name' => $valueLevelOne['name'], 'link' => $valueLevelOne['link']];
            $breadcrumbArr[$keyLevelTwo][] =['name' => $valueLevelTwo['name'], 'link' => $valueLevelTwo['link']];
            if (isset($valueLevelTwo['child'])) {
                foreach ($valueLevelTwo['child'] as $keyLevelThree => $valueLevelThree) {
                    $breadcrumbArr[$keyLevelThree][] = ['name' => $valueLevelOne['name'], 'link' => $valueLevelOne['link']];
                    $breadcrumbArr[$keyLevelThree][] = ['name' => $valueLevelTwo['name'], 'link' => $valueLevelTwo['link']];
                    $breadcrumbArr[$keyLevelThree][] = ['name' => $valueLevelThree['name'], 'link' => $valueLevelThree['link']];
                }
            }
        }
    }
}
$breadcrumbArrChild = $breadcrumbArr[$activePage];
