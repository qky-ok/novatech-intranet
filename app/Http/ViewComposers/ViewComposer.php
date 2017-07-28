<?php

namespace App\Http\ViewComposers;

use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;

class ViewComposer{
    private static $rendered = false;

    public function compose(){
        if(static::$rendered) return;

        View::share([
            'jsHeader'		=> array_unique(Controller::$jsHeader),
            'cssTags'		=> array_unique(Controller::$css),
            'jsFooter'		=> array_unique(Controller::$jsFooter)
        ]);
    }
}
