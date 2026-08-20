<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
     protected $fillable = [
        'title','image','description','size','sort_order','status',
    ];
}
