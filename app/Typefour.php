<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Typefour extends Model
{
    protected $fillable = ['name','price'];
    protected $hidden = ['pivot','created_at','updated_at'];


    public function dishes()
    {
        return $this->belongsToMany(Dish::class)->withTimestamps();
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withTimestamps();
    }
}
