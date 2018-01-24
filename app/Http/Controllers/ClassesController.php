<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Classes;

class ClassesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function insertClass(){
    	return view('class.insert');
    }

    public function add(){
    	Classes::create([
    		'catagory'=>request('catagory'),
    		'class'=>request('class'),
    	]);
    	return view('class.insert');
    }

    public function editClasses(){
        $classes = Classes::all();
        return view('class.editClasses', compact('classes'));
    }

    public function edit(){
        foreach(request('id') as $id){
            Classes::find($id)->update(['catagory'=>request('catagory'.$id), 'class'=>request('class'.$id)]);
        }
        return redirect(route('admin'));
    }

    public function delete($id){
        Classes::find($id)->delete();
        return redirect(route('editClass'));
    }
}
