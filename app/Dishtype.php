<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dishtype extends Model
{
    protected $fillable = ['dish_type_name'];
    public function dishes()
    {
        return $this->hasMany(Dish::class);
    }
}
