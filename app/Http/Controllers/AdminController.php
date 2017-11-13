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
        $this->middleware('auth');
        $this->middleware('admin');
    }

    // gets all user information and most recent timesheet opens admin view
    public function index()
    {
       
    	$usersInfo = array();
    	$allUsers = User::all()->where('admin', '=', '0');
    	foreach($allUsers as $user){
            $timesheet = Timesheets::where('user', '=', $user->id)->orderBy('startdate', 'desc')->first();
            $usersInfo[] = array($user, $timesheet);
    	}
    	return view('admin.admin', compact('usersInfo'));
    }

    // gets a user by id and sends it to the change hours page
    public function hours($id)
    {
       
    	$user = User::find($id);
    	return view('admin.changehours', compact('user'));
    }

    // takes the hours given from the form and updates the database
    public function change()
    {
        $hours = 0;
        if(request('hours') > 0){
            $hours = request('hours');
        }
    	User::where('id', '=', request('id'))->update(['hours' => $hours]);

    	return redirect('admin');
    }

    // gets a user with an id and their timesheet with the date in the parameters
    public function viewUser($id, $date)
    {
       $user = User::withTrashed()->find($id);
        $timesheet = Timesheets::where('user', '=', $id)->where('startdate', '=', $date)->first();

    	return view('admin.timesheet', compact('user', 'timesheet'));
    }

    // removes a user
    public function remove($id)
    {

    	User::find($id)->delete();

    	return back();

    }

    // gets past timesheets within the past two weeks of the given date
    public function getRecords()
    {
       
    	$users = array();
        $date = request('date');
    	$records = Timesheets::whereBetween('startdate', [date('Y-m-d', strtotime('-13 day', strtotime($date))),$date])->get();
    	foreach($records as $record){
    		$users[] = User::withTrashed()->where('id', '=', $record->user)->first();
    	}
    	return view('admin.records', compact('records', 'users', 'date'));
    }

    // gets deleted users
    public function getPastUsers()
    {
        $past = User::onlyTrashed()->get();
        return view('admin.pastusers', compact('past'));
    }

    // revives deleted users
    public function restorePast($id)
    {
        User::withTrashed()->find($id)->restore();

        return redirect('admin');
    }

    // allows a user to edit a submitted timesheet
    public function allowEdit($id, $date){
        Timesheets::where('user', '=', $id)->where('startdate', '=', $date)->update(['submitted' => 0]);
        return redirect(route('admin'));
    }

    // gets all employees
    public function allEmployees(){
        $users = User::all();
        return view('admin.allEmployees', compact('users'));
    }

    //updates all employee data in database
    public function update(){
        for($i = 0; $i < count(request('id')); $i ++){
            User::where('id', '=', request('id')[$i])->update(['fundcc'=>request('fundcc')[$i],'jobcode'=>request('jobcode')[$i],'admin'=>request('admin')[$i],'hours'=>request('hours')[$i]]);
        }
        return redirect(route('admin'));
    }
}
