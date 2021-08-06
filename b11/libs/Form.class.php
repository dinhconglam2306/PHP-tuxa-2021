<?php

class Form
{
    public static function input($type, $id, $name, $value)
    {
        $xhtml = sprintf(' <input type="%s" id="%s" name="%s" value="%s" class="form-control not-dark" required />', $type, $id, $name, $value);
        return $xhtml;
    }

    public static function label($forId, $textName, $required = true)
    {
        $xhtml = '';
        if ($required = true) {
            $xhtml = sprintf(' <label for="%s">%s<small>*</small></label>', $forId, $textName);
        } else if ($required = false) {
            $xhtml = sprintf(' <label for="%s">%s</label>', $forId, $textName);
        }
        return $xhtml;
    }

    public static function textarea($id, $name, $value)
    {
        $xhtml = sprintf(' <textarea class="sm-form-control" id="%s" name="%s" rows="6" cols="30">%s</textarea>', $id, $name, $value);
        return $xhtml;
    }
    public static function button($type, $textContent)
    {
        $xhtml = sprintf(' <button type="%s" tabindex="5" class="button button-3d m-0">%s</button>', $type, $textContent);
        return $xhtml;
    }

    public static function groupFormCol12($label, $input, $required = true)
    {
        $xhtml = '';
        if ($required = true) {
            $xhtml = sprintf(' <div class="col-12 form-group">%s%s </div>', $label, $input);
        } else if ($required = false) {
            $xhtml = sprintf(' <div class="col-12 form-group">%s </div>', $label);
        }
        return $xhtml;
    }

    public static function groupFormColSm6ColLg4($aClass, $h3Title, $spanContent)
    {
        $xhtml = sprintf(' <div class="col-sm-6 col-lg-4">
                                <div class="feature-box fbox-center fbox-bg fbox-plain">
                                    <div class="fbox-icon">
                                        <a href="#"><i class="%s"></i></a>
                                    </div>
                                    <div class="fbox-content">
                                        <h3>%s<span class="subtitle">%s</span></h3>
                                    </div>
                                </div>
                            </div>', $aClass, $h3Title, $spanContent);

        return $xhtml;
    }

    public static function createButton($type, $name)
    {
        $xhtml = sprintf(
            ' <button type="%s" class="button button-3d button-black m-0">%s</button>',
            $type,
            $name
        );
        return $xhtml;
    }

    public static function createA($url, $name)
    {
        $xhtml = sprintf(
            ' <a href="%s" class="button button-3d m-0">Quay về</a>',
            $url,
            $name
        );
        return $xhtml;
    }
}
