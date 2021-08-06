<?php
function createInput($text, $placeholder, $name)
{
    $result = sprintf('<input class="input--style-2" type="%s" placeholder="%s" name="%s">', $text, $placeholder, $name);
    return  $result;
}

function createSelectBox($className, $title, $arr)
{
    $xhtml = '';
    $xhtmlOptions = '';
    foreach ($arr as $value) {
        $xhtmlOptions .=   "<option>$value</option>";
    }
    $xhtml .= sprintf(
        ' 
    <div class="rs-select2 js-select-simple select--no-search">
        <select name="%s">
            <option disabled="disabled" selected="selected">%s</option>
            %s
        </select>
        <div class="select-dropdown"></div>
    </div>',
        $className,
        $title,
        $xhtmlOptions
    );
    return $xhtml;
}
