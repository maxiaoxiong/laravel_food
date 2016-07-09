<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PushTimely extends Model
{
    protected $fillable = ['msg_id','sendno','content'];
    
}
