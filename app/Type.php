<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = ['name'];
    protected $hidden = ['created_at','updated_at'];
    public function dishes()
    {
        return $this->hasMany(Dish::class);
    }
}
