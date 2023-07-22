<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    //  Actions
   
    /*public function index(){
        $user = 'Faten Hmaid';
        $title='store';
       // var_dump(compact('user','title'));
        //exit;
        //Return Response:view ,json, redirect,file
        return view('dashboard',compact('user','title'));

    }*/
     public function __construct(){
        $this->middleware(['auth'])->only('index');
     }

    public function index(){
        
        $title='store';
        $user= Auth::user();
       // dd($user);
     
        //Return Response:view ,json, redirect,file
        return  view('dashboard.index')->with([
            'user'=>'Faten Hmaid',
            'title'=>$title
        ]
       );

    }

 /*   public function index(){
        
        $title='store';
     
        //Return Response:view ,json, redirect,file
        return View::make ('dashboard',[
            'user'=>'faten',
            'title'=>$title
        ]
       );

    }*/
}
