<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['order_no','price' ,'status' , 'dish_id', 'dormitory_id','user_name','user_phone', 'user_id', 'msg'];

    public function typefours()
    {
        return $this->belongsToMany(Typefour::class)->withTimestamps();
    }

    public function typethrees()
    {
        return $this->belongsToMany(Typethree::class)->withTimestamps();
    }

    public function typetwos()
    {
        return $this->belongsToMany(Typetwo::class)->withTimestamps();
    }

    public function typeones()
    {
        return $this->belongsToMany(Typeone::class)->withTimestamps();
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dishes()
    {
        return $this->belongsToMany('App\Dish','order_dish')->withPivot('num')->withTimestamps();
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
