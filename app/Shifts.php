<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shifts extends Model
{
    protected $fillable = [
        'start', 'end', 'timesheet', 'tod',
    ];
}
