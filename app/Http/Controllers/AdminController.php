<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Timesheets;
use App\User;
use App\PreviousUsers;
use Auth;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
       
    	$usersInfo = array();
    	$counter = 0;
    	$allUsers = User::all()->where('admin', '=', '0');
    	foreach($allUsers as $user){
            if($timesheet = Timesheets::where('user', '=', $user->id)->orderBy('startdate', 'desc')->first()){
                $usersInfo[] = array($allUsers[$user->id-1], $timesheet);
            }
            else{
                $usersInfo[] = array($allUsers[$user->id-1], Timesheets::where('user', '=', '-1')->first());
            }
    		
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
        if($timesheet = Timesheets::where('user', '=', $user->id)->orderBy('startdate', 'desc')->first()){
        }
        else{
            $timesheet = Timesheets::where('user', '=', '-1')->first();
        }
    	

    	return view('timesheet', compact('user', 'timesheet'));
    }

    public function remove($id)
    {
       

    	User::where('id', '=', $id)->delete();

    	return back();

    }

    public function getRecords()
    {
       
    	$users = array();
    	$records = Timesheets::all()->where('startdate', '=', request('date'));
    	foreach($records as $record){
    		$users[] = User::where('id', '=', $record->user)->first();
    	}
    	return view('records', compact('records', 'users'));
    }

    public function getPastUsers()
    {
        $past = User::onlyTrashed();

        return view('pastusers', compact('past'));
    }
}
