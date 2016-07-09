<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PushTiming extends Model
{
    protected $fillable = ['schedule_id','name','content','time'];
}
