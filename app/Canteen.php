<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Canteen extends Model
{
    protected $fillable = ['id','name','img'];

    public function windows()
    {
        return $this->hasMany(Window::class);
    }
}
