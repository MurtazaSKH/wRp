<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Question;
use App\Category;
use DB;
use Response;

class QuestionController extends Controller
{
    public function load(Request $request){
        $data = $request;
        $id = 0;
        
        if(isset($data->id))
            $id = $data->id;
        
        $obj = Question::all();
        if($id > 0)
            $obj = Question::where('id', $id)->get();
        
        foreach($obj as $row){
            $row->possibilities = json_decode($row->possibilities);
        }      
        //return var_dump($obj->categories['id']);
        return view('pages/questions')->with(['data' => $obj, 'categories' => Category::all()]);    
    }
    
    public function proc(Request $request){
        $data = $request;
        $id = 0;
    
        //return var_dump($data->categoryedit);
        if(isset($data->id))
            $id = $data->id;
        
        $obj = new Question();
        if($id > 0)
            $obj = Question::find($id);
        
        $obj->category_id = $data->category;
        $obj->question = $data->question;
        $obj->possibilities = json_encode($data->possibilities);
        $obj->correct = $data->checkbox;
        $obj->save();
        return redirect('questions'); 
    }
    
    public function editQuestion(Request $request){
        $data = $request;
        $id = 0;
    
        if(isset($data->id))
            $id = $data->id;
        
        if($id > 0)
            $obj = Question::find($id);
        
        //$obj->category_id = $data->category;
        $obj->question = $data->question;
        $obj->possibilities = json_encode($data->possibilities);
        $obj->correct = $data->checkbox;
        $obj->save();
        return redirect('questions'); 
    }
    
    public function delete(Request $request){
        $data = $request;
        $id = 0;
        
        if(isset($data->id))
            $id = $data->id;
        
        $obj = new Question();
        if($id > 0)
            $obj = Question::where('id', $id)->delete();
        
        return redirect('questions');    
    }
    
    public function apiload(Request $request){
        //$req = $request::instance();
        $data = json_decode($request->getContent());
        $id = 0;
        
        if(isset($data->id))
            $id = $data->id;
        
        $obj = Question::all();
        if($id > 0)
            $obj = Question::where('category_id', $id)->get();
            
        foreach($obj as $row){
            $row->possibilities = json_decode($row->possibilities);
        }    
        return Response::json(['data' => $obj]);     
    }
}
