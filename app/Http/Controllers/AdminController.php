<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Timesheets;
use App\User;
use App\PreviousUsers;
use Auth;

class AdminController extends Controller
{
    public function index()
    {
    	$usersInfo = array();
    	$counter = 0;
    	$allUsers = User::all()->where('admin', '=', '0');
    	foreach($allUsers as $user){
    		$usersInfo[] = array($allUsers[$counter], Timesheets::where('user', '=', $user->id)->orderBy('startdate', 'desc')->first());
    		$counter ++;
    	}
    	return view('admin', compact('usersInfo'));
    }

    public function hours($id)
    {
    	$user = User::where('id', '=', $id)->first();
    	return view('changehours', compact('user'));
    }

    public function change()
    {
    	User::where('id', '=', request('id'))->update(['hours' => request('hours')]);

    	$usersInfo = array();
    	$counter = 0;
    	$allUsers = User::all()->where('admin', '=', '0');
    	foreach($allUsers as $user){
    		$usersInfo[] = array($allUsers[$counter], Timesheets::where('user', '=', $user->id)->orderBy('startdate', 'desc')->first());
    		$counter ++;
    	}
    	return view('admin', compact('usersInfo'));
    }

    public function viewUser($id)
    {
    	$user = User::find($id);
    	$timesheet =  Timesheets::where('user', '=', $user->id)->orderBy('startdate', 'desc')->first();

    	return view('timesheet', compact('user', 'timesheet'));
    }

    public function remove($id)
    {
    	$user = User::where('id', '=', $id)->first();
    	PreviousUsers::create([
    		'oldid' => $user->id,
    		'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
            'fundcc' => $user->fundcc,
            'jobcode' => $user->jobcode,
    	]);

    	User::where('id', '=', $id)->delete();

    	return back();

    }
}
