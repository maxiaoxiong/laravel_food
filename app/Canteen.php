<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Canteen extends Model
{
    protected $fillable = ['id','canteen_name'];

    public function windows()
    {
        return $this->hasMany(Window::class);
    }
}
