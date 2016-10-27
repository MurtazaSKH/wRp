<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\MessageBag;
use Auth;
use App\User;
use App\Score;
use Redirect;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    public function getLogin(){
        if(auth()->user())
            return redirect()->back();
        return view('pages.login');    
    }
    
    public function getSignup(){
        if(auth()->user())
            return redirect()->back();
        return view('pages.signup');
    }
    
    public function postSignup(Request $request){
        
        $authUserEmail = User::where('email', $request->email)->first();
        if($authUserEmail){
            $errors = new MessageBag(['email' => ['Email or username already exist.Please type another one']]);
			return Redirect::back()->withErrors($errors)->withInput(Input::except('password'));
        }else{
            $createUser = User::create([
    				           'name' => $request->name,
    				           'email' => $request->email,
    				           'password' => bcrypt($request['password']),
    				      ]);
            if($createUser){
                $authAttempt = Auth::attempt(['email' => $request->email, 'password' => $request->password]);
                if($authAttempt)
                    return redirect()->intended('account');
            }else{
                echo "wronge";
            }    
        }
        
    }
    
    public function postLogin(Request $request){
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password ]))
            return redirect()->intended('account');
        
        return redirect()->back();
    }
    
    public function postscore(Request $request){
        $data = json_decode($request->getContent());
        
        $obj = new Score;
        $obj->user_id = Auth::user()->id;
        $obj->name = Auth::user()->name;
        $obj->email = Auth::user()->email;
        $obj->score = number_format($data->score, 2);
        $obj->save();
    }
    
    public function load(Request $request){
        $data = $request;
        
        $obj = Score::all();
        
        return view('pages/users')->with(['data' => $obj]);    
    }   
}
