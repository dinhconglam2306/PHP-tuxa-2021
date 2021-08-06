<?php
class URL
{
    public static function createLink($module,$controller,$action,$params=''){
        $url = "index.php?module=$module&controller=$controller&action=$action".$params;
        return $url;
    }
    public static function redirect($url){
        header("location:$url");
		exit();
    }
}