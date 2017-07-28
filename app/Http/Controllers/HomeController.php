<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        parent::__construct();
    }

    /**
     * Show the application initial page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        /*Controller::addCss('/js/datatables_1.10.15/datatables.min.css');
        Controller::addJsFooter('/js/datatables_1.10.15/datatables.min.js');*/
        Controller::addJsFooter('/js/index.js');

        return view('intranet');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function home(){
        Controller::addJsFooter('/js/index.js');

        return view('intranet');
    }
}
