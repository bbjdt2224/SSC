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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->admin == 1){
            return redirect('admin');
        }
        $userInfo = Timesheets::where('user', '=', Auth::id())->orderBy('startdate', 'desc')->first();
        if($userInfo == null){
            $userInfo = Timesheets::orderBy('id', 'desc')->first();
        }
        return view('home', compact('userInfo'));
    }

    public function getWeek($date)
    {   
        if(Auth::user()->admin == 1){
            return redirect('admin');
        }
        $userInfo = Timesheets::where('user', '=', Auth::id())->where('startdate', '=', $date)->first();
        if($userInfo == null){
            $userInfo = Timesheets::orderBy('id', 'desc')->first();
        }
        return view('home', compact('userInfo'));
    }

    public function store()
    {
        if(Auth::user()->admin == 1){
            return redirect('admin');
        }
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
        $existing = Timesheets::where('user', '=', Auth::id())->where('startdate', '=', request('startdate'))->count();
       // dd($existing);
        if($existing == 0){
            Timesheets::create([
                'user' => Auth::id(),
                'startdate' => request('startdate'),
                'firstweek' => $week1,
                'secondweek' => $week2,
                'totals' => $totals,
            ]);
        }
        else{
            Timesheets::where('user', '=', Auth::id())->where('startdate', '=', request('startdate'))->update(['firstweek' => $week1,'secondweek' => $week2, 'totals'=> $totals]);
        }
        if(request('save')){
            return view('save');
        }
        else if(request('submit')){
            Timesheets::where('user', '=', Auth::id())->where('startdate', '=', request('startdate'))->update(['submitted' => 1]);
            return view('success');
        }
        
    }

    public function select()
    {
        if(Auth::user()->admin == 1){
            return redirect('admin');
        }
        $all = Timesheets::where('user', '=', Auth::id())->get();

        return view('select', compact('all'));

    }

    public function new()
    {
        if(Auth::user()->admin == 1){
            return redirect('admin');
        }
        $date = Carbon::parse('this monday')->subWeeks(2)->toDateString();
        $userInfo = Timesheets::where('user', '=', Auth::id())->first();
        $userInfo->startdate = $date;
        

        return view('home', compact('userInfo'));
    }
}
