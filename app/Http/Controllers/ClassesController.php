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

    }

    public function edit(){

    }
}
