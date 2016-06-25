<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreferentialDish extends Model
{
    protected $fillable = ['dish_id'];

    public function dish()
    {
        return $this->belongsTo(Dish::class);
    }
}
