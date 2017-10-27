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

    public function hours($id)
    {
       
    	$user = User::find($id);
    	return view('admin.changehours', compact('user'));
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

    public function viewUser($id, $date)
    {
       $user = User::withTrashed()->find($id);
        $timesheet = Timesheets::where('user', '=', $id)->where('startdate', '=', $date)->first();

    	

    	return view('admin.timesheet', compact('user', 'timesheet'));
    }

    public function remove($id)
    {
       

    	User::find($id)->delete();

    	return back();

    }

    public function getRecords()
    {
       
    	$users = array();
    	$records = Timesheets::whereBetween('startdate', [date('Y-m-d', strtotime('-13 day', strtotime(request('date')))),request('date')])->get();
    	foreach($records as $record){
    		$users[] = User::withTrashed()->where('id', '=', $record->user)->first();
    	}
    	return view('admin.records', compact('records', 'users'));
    }

    public function getPastUsers()
    {
        $past = User::onlyTrashed()->get();
        return view('admin.pastusers', compact('past'));
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

    public function allEmployees(){
        $users = User::all();
        return view('admin.allEmployees', compact('users'));
    }

    public function update(){
        for($i = 0; $i < count(request('id')); $i ++){
            User::where('id', '=', request('id')[$i])->update(['fundcc'=>request('fundcc')[$i],'jobcode'=>request('jobcode')[$i],'admin'=>request('admin')[$i],'hours'=>request('hours')[$i]]);
        }
        return redirect(route('admin'));
    }
}
