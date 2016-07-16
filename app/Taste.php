<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taste extends Model
{
    protected $fillable = ['name'];
    protected $hidden = ['pivot','created_at','updated_at'];


    public function Dishes()
    {
        return $this->belongsToMany(Dish::class)->withTimestamps();
    }
}
