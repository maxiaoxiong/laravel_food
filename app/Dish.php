<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    protected $fillable = ['id','dish_name','dish_price','dish_img','window_id','dishtype_id','order_at'];
    public function window()
    {
        return $this->belongsTo(Window::class);
    }

    public function dishtype()
    {
        return $this->belongsTo(Dishtype::class);
    }

    public function tastes()
    {
        return $this->belongsToMany(Taste::class)->withTimestamps();
    }

    public function tablewares()
    {
        return $this->belongsToMany(Tableware::class)->withTimestamps();
    }

    public function getTasteAttribute()
    {
        return $this->tastes->lists('id')->all();
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function ranges()
    {
        return $this->hasMany(Range::class);
    }
}
