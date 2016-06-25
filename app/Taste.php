<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taste extends Model
{
    protected $fillable = ['name'];
    public function Dishes()
    {
        return $this->belongsToMany(Dish::class)->withTimestamps();
    }
}
