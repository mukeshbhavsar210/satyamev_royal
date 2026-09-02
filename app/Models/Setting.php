<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'company_name','email','phone','mobile','whatsapp','address_line1','address_line2','foreign_office','business_line',
        'linkedin','facebook','instagram','youtube','punch_line1','punch_line2','experience_line','since','ceo_message',
        'ceo_name','theme_template','hero','gallery','why','showcase','primary_color','secondary_color','preloader_color',
        'preloader','preloader_line1','preloader_line2','cookies','arch_color'
    ];

    protected $casts = [
        'hero' => 'array',
        'gallery' => 'array',
        'why' => 'array',
        'showcase' => 'array',
    ];
}
