<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tableware extends Model
{
    protected $fillable = ['name','price'];

    protected $hidden = ['pivot','created_at','updated_at'];
}
