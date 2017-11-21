<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shifts;

class ShiftsController extends Controller
{
    public function add($start, $end, $timesheet, $tod){
    	Shifts::create([
    		'start' => $start,
    		'end' => $end,
    		'timesheet' => $timesheet,
            'tod' => $tod,
    	]);
    	return;
    }

    public function edit($start, $end, $timesheet, $id, $tod){
    	Shifts::find($id)->update(['start'=> $start, 'end' => $end, 'timesheet'=> $timesheet, 'tod' => $tod.]);
        return;
    }

}
