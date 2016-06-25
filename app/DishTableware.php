<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DishTableware extends Model
{
    public function Dishes()
    {
        return $this->belongsToMany(Dish::class)->withTimestamps();
    }
}
