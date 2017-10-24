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
            $timesheet = Timesheets::where('user', '=', $user->id)->orderBy('startdate', 'desc')->first();
            $usersInfo[] = array($user, $timesheet);
    	}
    	return view('admin', compact('usersInfo'));
    }

    public function hours($id)
    {
       
    	$user = User::find($id);
    	return view('changehours', compact('user'));
    }

    public function change()
    {
        $hours = 0;
        if(request('hours') > 0){
            $hours = request('hours');
        }
    	User::where('id', '=', request('id'))->update(['hours' => $hours]);

    	return redirect('admin');
    }

    public function viewUser($id)
    {
       
    	$user = User::find($id);
        $timesheet = Timesheets::where('user', '=', $user->id)->orderBy('startdate', 'desc')->first();

    	

    	return view('timesheet', compact('user', 'timesheet'));
    }

    public function remove($id)
    {
       

    	User::find($id)->delete();

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

    public function allowEdit($id, $date){
        Timesheets::where('user', '=', $id)->where('startdate', '=', $date)->update(['submitted' => 0]);
        return redirect(route('admin'));
    }
}
