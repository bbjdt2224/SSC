<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Timesheets;
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
        
        $userInfo = Timesheets::where('user', '=', Auth::id())->orderBy('startdate', 'desc')->first();
        if($userInfo == null){
            $userInfo = Timesheets::orderBy('id', 'desc')->first();
        }
        return view('home', compact('userInfo'));
    }

    public function getWeek($date)
    {   
        
        $userInfo = Timesheets::where('user', '=', Auth::id())->where('startdate', '=', $date)->first();
        if($userInfo == null){
            $userInfo = Timesheets::orderBy('id', 'desc')->first();
        }
        return view('home', compact('userInfo'));
    }

    public function store()
    {
        $date = date('W', strtotime(request('startdate')));
        if($date%2 != 1){
            $date = $date -1;
        }
        $date = date('Y-m-d', strtotime(date('Y')."W".$date."1"));
        $week1 = "";
        $week2 = "";
        $totals = request('week1total').",".request('week2total').",".request('total');
        for($i = 0; $i < 7; $i++){
            $week1 .= request($i.'morningbegin').",".request($i.'morningend').",".request($i.'afternoonbegin').",".request($i.'afternoonend').",".request($i.'eveningbegin').",".request($i.'eveningend').",".request($i.'reason').",".request($i.'total');
            if($i < 6){
                $week1 .= "|";
            }
        }
        for($i = 7; $i < 14; $i++){
            $week2 .= request($i.'morningbegin').",".request($i.'morningend').",".request($i.'afternoonbegin').",".request($i.'afternoonend').",".request($i.'eveningbegin').",".request($i.'eveningend').",".request($i.'reason').",".request($i.'total');
            if($i < 13){
                $week2 .= "|";
            }
        }
        Timesheets::where('user', '=', Auth::id())->where('id', '=', request('id'))->update(['firstweek' => $week1,'secondweek' => $week2, 'totals'=> $totals, 'startdate' => $date]);

        if(request('save')){
            return view('save');
        }
        else if(request('submit')){
            Timesheets::where('user', '=', Auth::id())->where('id', '=', request('id'))->update(['submitted' => 1]);
            return view('sign', compact('date'));
        }
        
    }

    public function select()
    {
        
        $all = Timesheets::where('user', '=', Auth::id())->get();

        return view('select', compact('all'));

    }

    public function new()
    {
        
        $date = date('W', time());
        if($date%2 != 1){
            $date = $date -1;
        }
        $date = date('Y-m-d', strtotime(date('Y')."W".$date."1"));
        if(Timesheets::where('startdate', '=', $date)->where('user', '=', Auth::id())->count() == 0){
            $userInfo = new Timesheets;
            $userInfo->user = Auth::id();
            $userInfo->startdate = $date;
            $userInfo->save();

        }
        return redirect(route('select'));
    }

    public function saveSignature()
    {
        Timesheets::where('startdate', '=', request('date'))->where('user', '=', Auth::id())->update(['signature' => request('signature')]);

        return redirect('select');
    }
}
