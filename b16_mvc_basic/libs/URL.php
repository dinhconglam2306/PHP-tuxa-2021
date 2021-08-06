<?php
class URL
{
    public static function createLink($controller,$action,$params=''){
        $url = "index.php?controller=$controller&action=$action".$params;
        return $url;
    }
    public static function redirect($url){
        header("location:$url");
		exit();
    }
}