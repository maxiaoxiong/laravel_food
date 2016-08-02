<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    protected $fillable = ['name', 'time','over_time'];

//    public function getOverTimeAttribute($value)
//    {
//        return Carbon::createFromDate('H:i:s',$value);
//    }
}
