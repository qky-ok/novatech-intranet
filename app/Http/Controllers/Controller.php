<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    static $jsHeader 	= [];
    static $jsFooter 	= [];
    static $css 		= [];

    function __construct(){
        self::addJsHeader('/js/jquery_3.2.1/jquery-3.2.1.min.js');

        view()->composer('*', 'App\Http\ViewComposers\ViewComposer');
    }

    /**
     * Add js in the header tag
     **/
    static function addJsHeader($src, $cdn = true, $secure = false)
    {
        if ($src == "") {
            return;
        }
        self::$jsHeader[] = self::MakeJS($src, $cdn, $secure);
    }

    /**
     * Add js in the footer
     **/
    static function addJsFooter($src = ""){
        if ($src == "") {
            return;
        }
        self::$jsFooter[] = self::MakeJS($src);
    }

    /**
     * Add css in the header tag
     **/
    static function addCss($href = ""){
        if ($href == "") {
            return;
        }
        self::$css[] = self::MakeCSS($href);
    }

    /**
     * Create Style tag
     * @param string $href
     * @return void|string
     **/
    static function MakeCSS($href){
        $css_tag = '<link href="'.$href.'" rel="stylesheet" type="text/css">';
        return $css_tag;
    }

    /**
     * Create js tag
     * @param string $src
     * @return void|string
     **/
    static function MakeJS($src){
        $js_tag = '<script src="'.$src.'" type="text/javascript"></script>';
        return $js_tag;
    }
}
