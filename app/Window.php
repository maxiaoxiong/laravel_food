<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Window extends Model
{
    protected $fillable = ['id','window_name','canteen_id'];

    public function canteen()
    {
        return $this->belongsTo(Canteen::class);
    }

    public function dishes()
    {
        return $this->hasMany(Dish::class);
    }
}
