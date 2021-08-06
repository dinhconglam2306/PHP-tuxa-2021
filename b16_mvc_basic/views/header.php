<?php
$cssURL	= PUBLIC_URL . 'css' . DS;

// Session::init();

// // JS
// if (!empty($this->js)) {
// 	foreach ($this->js as $js) {
// 		$fileJs .= '<script type="text/javascript" src="' . VIEW_URL . $js . '"></script>';
// 	}
// }

// // CSS
// if (!empty($this->css)) {
// 	foreach ($this->css as $css) {
// 		$fileCss .= '<link rel="stylesheet" type="text/css" href="' . VIEW_URL . $css . '">';
// 	}
// }

// TITLE
$title = isset($this->title) ? $this->title : 'MVC';
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $title;?></title>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
	<link rel="stylesheet" href="<?php echo $cssURL?>bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo $cssURL?>mdb.min.css">
	<link rel="stylesheet" href="<?php echo $cssURL?>my-style.css">
</head>

<body style="background-color: #eee;">
	<div class="container pt-5">
	
