<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use Response;

class CategoryController extends Controller
{
    public function load(Request $request){
        $data = $request;
        $id = 0;
        
        if(isset($data->id))
            $id = $data->id;
        
        $obj = Category::all();
        if($id > 0)
            $obj = Category::where('id', $id)->get();
        
        return view('pages/categories')->with('data', $obj);    
    }
    
    public function proc(Request $request){
        $data = $request;
        $id = 0;
        
        if(isset($data->id))
            $id = $data->id;
        
        $obj = new Category();
        if($id > 0)
            $obj = Category::find($id);
        
        $obj->title = $data->title;
        $obj->save();
        return redirect('categories');    
    }
    
    public function delete(Request $request){
        $data = $request;
        $id = 0;
        
        if(isset($data->id))
            $id = $data->id;
        
        $obj = new Category();
        if($id > 0)
            $obj = Category::where('id', $id)->delete();
        
        return redirect('categories');    
    }
    
    public function apiload(Request $request){
        $data = $request;
        $id = 0;
        
        if(isset($data->id))
            $id = $data->id;
        
        $obj = Category::all();
        if($id > 0)
            $obj = Category::where('id', $id)->get();
        
        return Response::json(['data' => $obj]);    
    }
}
