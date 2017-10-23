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
    	$allUsers = User::all()->where('admin', '=', '0');
    	foreach($allUsers as $user){
            if($timesheet = Timesheets::where('user', '=', $user->id)->orderBy('startdate', 'desc')->first()){
                $usersInfo[] = array($user, $timesheet);
            }
            else{
                $usersInfo[] = array($user, Timesheets::where('user', '=', '-1')->first());
            }
    		
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

    	return redirect('admin');
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
        $past = User::onlyTrashed()->get();
        return view('pastusers', compact('past'));
    }

    public function restorePast($id)
    {
        User::withTrashed()->find($id)->restore();

        return redirect('admin');
    }
}
