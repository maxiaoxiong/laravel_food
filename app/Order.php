<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['billing_id','subject','type','order_no','user_id','dish_id','dormitory_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dish()
    {
        return $this->belongsTo(Dish::class);
    }

    public function tastes()
    {
        return $this->belongsToMany(Taste::class)->withTimestamps();
    }

    public function tablewares()
    {
        return $this->belongsToMany(Tableware::class)->withTimestamps();
    }

    public function dormitory()
    {
        return $this->belongsTo(Dormitory::class);
    }
}
