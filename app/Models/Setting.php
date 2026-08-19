<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'company_name',
        'phone',
        'mobile',
        'address',
        'business_line',
        'facebook_url',
        'instagram_url',
        'punch_line',
        'since',
        'ceo_message',
        'theme_template',
        'primary_color',
        'secondary_color',
        'preloader',
        'hero',
        'gallery',
        'why'
    ];

    protected $casts = [
        'hero' => 'array',
        'gallery' => 'array',
        'why' => 'array',
    ];
}
