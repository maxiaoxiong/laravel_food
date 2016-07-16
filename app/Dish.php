<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['id','name','price','dish_img','window_id','dishtype_id','delivery_time','type_id'];

    public function typefours()
    {
        return $this->belongsToMany(Typefour::class)->withPivot('limit_num')->withTimestamps();
    }
    
    public function typethrees()
    {
        return $this->belongsToMany(Typethree::class)->withPivot('limit_num')->withTimestamps();
    }
    
    public function typetwos()
    {
        return $this->belongsToMany(Typetwo::class)->withPivot('limit_num')->withTimestamps();
    }
    
    public function typeones()
    {
        return $this->belongsToMany(Typeone::class)->withPivot('limit_num')->withTimestamps();
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function window()
    {
        return $this->belongsTo(Window::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dishtype()
    {
        return $this->belongsTo(Dishtype::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tastes()
    {
        return $this->belongsToMany(Taste::class)->withPivot('limit_num')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tablewares()
    {
        return $this->belongsToMany(Tableware::class)->withPivot('limit_num')->withTimestamps();
    }

    /**
     * @return mixed
     */
    public function getTasteAttribute()
    {
        return $this->tastes->lists('id')->all();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class,'order_dish')->withPivot('num')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ranges()
    {
        return $this->hasMany(Range::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
