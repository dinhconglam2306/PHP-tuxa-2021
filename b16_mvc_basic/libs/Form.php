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
}
