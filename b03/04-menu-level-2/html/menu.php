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
$xhtml = '';
$activePage = basename($_SERVER['PHP_SELF'], ".php");
foreach($arrMenu as $keyLevelOne => $valueLevelOne){
    $classActive= ($keyLevelOne == $activePage)? 'class="active"' : '';
    if(isset($valueLevelOne['child'][$activePage])) $classActive =  'class="active"';
    $xhtml .= sprintf('<li %s><a href="%s">%s</a>',$classActive,$valueLevelOne['link'],$valueLevelOne['name']);
    if(isset($valueLevelOne['child'])){
        $xhtml.='<ul>';
        foreach($valueLevelOne['child'] as $keyLevelTwo => $valueLevelTwo){
            $xhtml .= sprintf('<li><a href="%s">%s</a>',$valueLevelTwo['link'],$valueLevelTwo['name']);
        }
        $xhtml.='</ul>';
    }

    $xhtml.='</li>';
}
?>

<div class="menuBackground">
    <div class="center">
        <ul class="dropDownMenu">
            <?php echo $xhtml;?>
        </ul>
    </div>
</div>