<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timesheets extends Model
{
    protected $fillable = [
        'user', 'startdate', 'firstweek', 'secondweek', 'totals',
    ];

    protected $attributes = [
    	//'firstWeek' => "-,-,-,-,-,-,,0|-,-,-,-,-,-,,0|-,-,-,-,-,-,,0|-,-,-,-,-,-,,0|-,-,-,-,-,-,,0|-,-,-,-,-,-,,0|-,-,-,-,-,-,,0",
    	//'secondweek' => "-,-,-,-,-,-,,0|-,-,-,-,-,-,,0|-,-,-,-,-,-,,0|-,-,-,-,-,-,,0|-,-,-,-,-,-,,0|-,-,-,-,-,-,,0|-,-,-,-,-,-,,0",
    	//'totals' => "0,0,0",
    	//'submitted' => "0",
    ];

    public function user(){
    	return $this->belongsTo('App\User');
    }
}
