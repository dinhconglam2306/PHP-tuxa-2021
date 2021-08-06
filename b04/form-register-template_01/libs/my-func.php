<?php
function createInput($text, $placehoder, $name)
{
    $result = '<input class="input--style-2" type="' . $text . '" placeholder="' . $placehoder . '" name="' . $name . '">';
    return $result = '<div class="input-group">' . $result . '</div>';
}



function createSelecBox($className, $title, $arr)
{
    $txt = '';
    $txt .= '<div class="input-group">
                <div class="rs-select2 js-select-simple select--no-search">
                    <select name="'.$className.'">
                        <option disabled="disabled" selected="selected">'.$title.'</option>';
                foreach ($arr as $value) {
                    $txt .=   '<option>' . $value . '</option>';
                }
            $txt .=  '</select>
            <div class="select-dropdown"></div>
                </div>
            </div>';
    return $txt;
}
