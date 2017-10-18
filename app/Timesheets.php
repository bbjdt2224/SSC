<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timesheets extends Model
{
        protected $fillable = [
        'user', 'startdate', 'firstweek', 'secondweek', 'totals',
    ];
}
