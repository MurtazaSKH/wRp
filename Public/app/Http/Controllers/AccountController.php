<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Category;

class AccountController extends Controller
{
    public function index(){
        //$obj = Category::all();
        //return view('pages.account')->with('data', $obj);
        return view('pages.quiz');    
        
    }
    
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
