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
        if(Auth::user()->admin == 0){
            return redirect('select');
        }
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
        if(Auth::user()->admin == 0){
            return redirect('select');
        }
    	$user = User::where('id', '=', $id)->first();
    	return view('changehours', compact('user'));
    }

    public function change()
    {
        if(Auth::user()->admin == 0){
            return redirect('select');
        }
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
        if(Auth::user()->admin == 0){
            return redirect('select');
        }
    	$user = User::find($id);
    	$timesheet =  Timesheets::where('user', '=', $user->id)->orderBy('startdate', 'desc')->first();

    	return view('timesheet', compact('user', 'timesheet'));
    }

    public function remove($id)
    {
        if(Auth::user()->admin == 0){
            return redirect('select');
        }
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

    public function getRecords()
    {
        if(Auth::user()->admin == 0){
            return redirect('select');
        }
    	$users = array();
    	$records = Timesheets::all()->where('startdate', '=', request('date'));
    	foreach($records as $record){
    		$users[] = User::where('id', '=', $record->user)->first();
    	}
    	return view('records', compact('records', 'users'));
    }
}
