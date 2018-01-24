<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Survey;
use App\Classes;

class SurveyController extends Controller
{

	public function index(){
		$classes = Classes::all();
		$users = User::where('admin', '=', '0')->get();
		return view('user.survey', compact('classes', 'users'));
	}

    public function changeclasses(){
    	$classes = Classes::where('catagory', '=', request('val'))->get();
    	return $classes;
    }

    public function submit(){
    	foreach(request('class') as $c){
    		Survey::create([
    			'tutor'=> request('name'),
	            'day'=>request('day'),
	            'center'=>request('building'),
	            'class'=>$c,
	            'students'=>request('students'),
    		]);
    	}

    	return view('welcome');
    }
}
