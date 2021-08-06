<?php require_once 'data.php';
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