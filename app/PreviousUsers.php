<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreviousUsers extends Model
{
    protected $fillable = [
        'name', 'email', 'password', 'fundcc', 'jobcode', 'oldid',
    ];
}
