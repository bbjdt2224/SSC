<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Timesheets;
use App\Shifts;
use Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $userInfo = Timesheets::where('user_id', '=', Auth::id())->orderBy('startdate', 'desc')->first();
        if($userInfo == null){
            $userInfo = Timesheets::orderBy('id', 'desc')->first();
        }
        return view('user.usertimesheet', compact('userInfo'));
    }

    // get a user timesheet where the start date is the same as the given date
    public function getWeek($date)
    {   
        
        $userInfo = Timesheets::where('user_id', '=', Auth::id())->where('startdate', '=', $date)->first();
        $shifts = Shifts::where('timesheet', '=', $userInfo->id)->get();
        if($userInfo == null){
            $userInfo = Timesheets::orderBy('id', 'desc')->first();
        }
        return view('user.usertimesheet', compact('userInfo', 'shifts'));
    }

    // save changes user made to their timesheet
    public function store()
    {
        $date = date('W', strtotime(request('startdate')));
        if($date%2 != 1){
            $date = $date -1;
        }
        $totals = request('week1total').",".request('week2total').",".request('total');
        for($i = 0; $i < 14; $i++){
            if(request($i.'morning') != null){
                if($i < 7){
                    $today = date('Y-m-d', strtotime(date('Y')."W".$date.($i+1)));
                }
                else{
                    $tdate = $date+1;
                    $today = date('Y-m-d', strtotime(date('Y')."W".$tdate.(($i%7)+1)));
                }
                $start = $today." ".date('H:i:s', strtotime(request($i.'morningbegin')));
                $end = $today." ".date('H:i:s', strtotime(request($i.'morningend')));
                Shifts::find(request($i.'morning'))->update(['start'=> $start, 'end' => $end, 'timesheet'=> request('id'), 'tod' => 'morning']);
            }
            elseif(request($i.'morningbegin') != "-" && request($i.'morningend') != "-"){
                if($i < 7){
                    $today = date('Y-m-d', strtotime(date('Y')."W".$date.($i+1)));
                }
                else{
                    $tdate = $date+1;
                    $today = date('Y-m-d', strtotime(date('Y')."W".$tdate.(($i%7)+1)));
                }
                $start = $today." ".date('H:i:s', strtotime(request($i.'morningbegin')));
                $end = $today." ".date('H:i:s', strtotime(request($i.'morningend')));
                Shifts::create([
                    'start' => $start,
                    'end' => $end,
                    'timesheet' => request('id'),
                    'tod' => 'morning',
                ]);
            }
            if(request($i.'afternoon') != null){
                if($i < 7){
                    $today = date('Y-m-d', strtotime(date('Y')."W".$date.($i+1)));
                }
                else{
                    $tdate = $date+1;
                    $today = date('Y-m-d', strtotime(date('Y')."W".$tdate.(($i%7)+1)));
                }
                $start = $today." ".date('H:i:s', strtotime(request($i.'afternoonbegin')));
                $end = $today." ".date('H:i:s', strtotime(request($i.'afternoonend')));
                Shifts::find(request($i.'afternoon'))->update(['start'=> $start, 'end' => $end, 'timesheet'=> request('id'), 'tod' => 'afternoon']);
            }
            elseif(request($i.'afternoonbegin') != "-" && request($i.'afternoonend') != "-"){
                if($i < 7){
                    $today = date('Y-m-d', strtotime(date('Y')."W".$date.($i+1)));
                }
                else{
                    $tdate = $date+1;
                    $today = date('Y-m-d', strtotime(date('Y')."W".$tdate.(($i%7)+1)));
                }
                $start = $today." ".date('H:i:s', strtotime(request($i.'afternoonbegin')));
                $end = $today." ".date('H:i:s', strtotime(request($i.'afternoonend')));
                Shifts::create([
                    'start' => $start,
                    'end' => $end,
                    'timesheet' => request('id'),
                    'tod' => 'afternoon',
                ]);
            }
            if(request($i.'evening') != null){
                if($i < 7){
                    $today = date('Y-m-d', strtotime(date('Y')."W".$date.($i+1)));
                }
                else{
                    $tdate = $date+1;
                    $today = date('Y-m-d', strtotime(date('Y')."W".$tdate.(($i%7)+1)));
                }

                $start = $today." ".date('H:i:s', strtotime(request($i.'eveningbegin')));
                $end = $today." ".date('H:i:s', strtotime(request($i.'eveningend')));
                Shifts::find(request($i.'evening'))->update(['start'=> $start, 'end' => $end, 'timesheet'=> request('id'), 'tod' => 'evening']);
            }
            elseif(request($i.'eveningbegin') != "-" && request($i.'eveningend') != "-"){
                if($i < 7){
                    $today = date('Y-m-d', strtotime(date('Y')."W".$date.($i+1)));
                }
                else{
                    $tdate = $date+1;
                    $today = date('Y-m-d', strtotime(date('Y')."W".$tdate.(($i%7)+1)));
                }
                $start = $today." ".date('H:i:s', strtotime(request($i.'eveningbegin')));
                $end = $today." ".date('H:i:s', strtotime(request($i.'eveningend')));
                Shifts::create([
                    'start' => $start,
                    'end' => $end,
                    'timesheet' => request('id'),
                    'tod' => 'evening',
                ]);
            }
        }
        $date = date('W', strtotime(request('startdate')));
        if($date%2 != 1){
            $date = $date -1;
        }
        $date = date('Y-m-d', strtotime(date('Y')."W".$date."1"));
        if(Timesheets::where('user_id', '=', Auth::id())->where('startdate', '=', $date)->first() == null){
            Timesheets::where('user_id', '=', Auth::id())->where('id', '=', request('id'))->update([ 'totals'=> $totals, 'startdate' => $date]);
        }
        elseif(Timesheets::where('user_id', '=', Auth::id())->where('startdate', '=', $date)->first()->id == request('id')){
            Timesheets::where('user_id', '=', Auth::id())->where('id', '=', request('id'))->update([ 'totals'=> $totals, 'startdate' => $date]);
        }
        else{
            Timesheets::where('user_id', '=', Auth::id())->where('id', '=', request('id'))->update(['totals'=> $totals]);
            return redirect()->back()->withErrors(['Timesheet already exists for that date']);
        }

        if(request('save')){
            return view('user.save');
        }
        else if(request('submit')){
            Timesheets::where('user_id', '=', Auth::id())->where('id', '=', request('id'))->update(['submitted' => 1]);
            return view('user.sign', compact('date'));
        }
        
    }

    // gets all timesheets made by user
    public function select()
    {
        
        $all = Timesheets::where('user_id', '=', Auth::id())->orderBy('startdate', 'desc')->get();

        return view('select', compact('all'));

    }

    // makes a new timesheet
    public function new()
    {
        
        $date = date('W', time());
        if($date%2 != 1){
            $date = $date -1;
        }
        $date = date('Y-m-d', strtotime(date('Y')."W".$date."1"));
        if(Timesheets::where('startdate', '=', $date)->where('user_id', '=', Auth::id())->count() == 0){
            $userInfo = new Timesheets;
            $userInfo->user_id = Auth::id();
            $userInfo->startdate = $date;
            $userInfo->save();

        }
        return redirect(route('home'));
    }

    // saves the signature to the database
    public function saveSignature()
    {
        Timesheets::where('startdate', '=', request('date'))->where('user_id', '=', Auth::id())->update(['signature' => request('signature')]);
        return redirect('home');
    }
}
