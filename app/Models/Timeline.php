<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
     protected $fillable = [
        'year',
        'title',
        'image',
        'description',
        'sort_order',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
