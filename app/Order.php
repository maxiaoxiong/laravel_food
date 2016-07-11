<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['order_no', 'dish_id', 'dormitory_id','username','phone', 'user_id', 'msg'];

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
