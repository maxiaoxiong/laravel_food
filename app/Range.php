<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Range extends Model
{
    protected $fillable = ['user_id', 'dish_id', 'range'];
}
