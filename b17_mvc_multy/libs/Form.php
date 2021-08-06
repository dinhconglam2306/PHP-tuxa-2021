<?php
class Form
{
	public static function createInput($type, $name, $value)
	{
		$xhtml = sprintf(
			'<input class="form-control" type="%s" name="%s" value="%s">',
			$type,
			$name,
			$value
		);

		return $xhtml;
	}
	public static function createLabel($title)
	{
		$xhtml = sprintf(
			' <label class="font-weight-bold">%s</label>',
			$title
		);
		return $xhtml;
	}


	public static function createFormGroup($label, $input)
	{
		$xhtml = sprintf(
			'<div class="form-group">%s%s</div>',
			$label,
			$input
		);
		return $xhtml;
	}

	public static function createSelectbox($arrData, $name, $keySelected = null, $class = null)
	{
		$xhtml = "";
		if (!empty($arrData)) {
			$xhtml = '<select class="' . $class . '" name="' . $name . '">';
			foreach ($arrData as $key => $value) {
				if ($keySelected == $key && $keySelected != null) {
					$xhtml .= '<option value="' . $key . '" selected="true">' . $value . '</option>';
				} else {
					$xhtml .= '<option value="' . $key . '">' . $value . '</option>';
				}
			}
			$xhtml .= '</select>';
		}
		return $xhtml;
	}
	public static function inputLogin($type, $id, $name, $value)
    {
        $xhtml = sprintf(' <input type="%s" id="%s" name="%s" value="%s" class="form-control not-dark" required />', $type, $id, $name, $value);
        return $xhtml;
    }

    public static function labelLogin($forId, $textName, $required = true)
    {
        $xhtml = '';
        if ($required = true) {
            $xhtml = sprintf(' <label for="%s">%s<small>*</small></label>', $forId, $textName);
        } else if ($required = false) {
            $xhtml = sprintf(' <label for="%s">%s</label>', $forId, $textName);
        }
        return $xhtml;
    }

    public static function textareaLogin($id, $name, $value)
    {
        $xhtml = sprintf(' <textarea class="sm-form-control" id="%s" name="%s" rows="6" cols="30">%s</textarea>', $id, $name, $value);
        return $xhtml;
    }
    public static function buttonLogin($type, $textContent)
    {
        $xhtml = sprintf(' <button type="%s" tabindex="5" class="button button-3d m-0">%s</button>', $type, $textContent);
        return $xhtml;
    }

    public static function groupFormCol12Login($label, $input, $required = true)
    {
        $xhtml = '';
        if ($required = true) {
            $xhtml = sprintf(' <div class="col-12 form-group">%s%s </div>', $label, $input);
        } else if ($required = false) {
            $xhtml = sprintf(' <div class="col-12 form-group">%s </div>', $label);
        }
        return $xhtml;
    }

    public static function groupFormColSm6ColLg4Login($aClass, $h3Title, $spanContent)
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

    public static function createButtonLogin($type, $name)
    {
        $xhtml = sprintf(
            ' <button type="%s" class="button button-3d button-black m-0">%s</button>',
            $type,
            $name
        );
        return $xhtml;
    }

    public static function createALogin($url, $name)
    {
        $xhtml = sprintf(
            ' <a href="%s" class="button button-3d m-0">Quay về</a>',
            $url,
            $name
        );
        return $xhtml;
    }
}
