<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class CrudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $role = Auth::user()->roles->first()->id;
        if($role == env('CAS_USER')){
            return view('home');
        }else{
            return view('crud.index');
        }
    }
}
