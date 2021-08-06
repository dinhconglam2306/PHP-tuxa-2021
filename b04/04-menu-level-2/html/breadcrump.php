<?php
require_once 'data.php';

$xhtml = '';

if ($activePage == 'index') {
    $xhtml = '<span>Home</span>';
} else {
    if (count($breadcrumbArrChild) >= 2) {
        $xhtmlLevel2 = '';
        foreach ($breadcrumbArrChild as $key => $value) {
            if ($key == count($breadcrumbArrChild) - 1) {
                $xhtmlLevel2 .= sprintf('<span>%s</span>', $value['name']);
            } else {
                $xhtmlLevel2 .= sprintf('<a href="%s">%s</a>' . ' > ', $value['link'], $value['name']);
            }
        }
        $xhtml =  '<a href="index.php">Home</a>' . ' > ' . $xhtmlLevel2;
    } else {
        $xhtml = sprintf(
            '
            <a href="index.php">Home</a>
            <span>></span>
            <span>%s</span>',
            $breadcrumbArrChild[0]['name']
        );
    }
}
?>
<div class="breadcrumb">
    <?php echo $xhtml; ?>
</div>