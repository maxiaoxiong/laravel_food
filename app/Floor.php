<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    protected $fillable = ['building_id','floor_name'];

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function dormitories()
    {
        return $this->hasMany(Dormitory::class);
    }
}
