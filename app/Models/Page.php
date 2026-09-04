<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Page extends Model {
    protected $fillable = ['title','slug','image','content','featured_title','featured_description','status'];

    public function images() {
        return $this->hasMany(PageImage::class, 'page_id');
    }

    // public function images(): HasMany{
    //     return $this->hasMany(ApartmentImage::class, 'page_id');
    // }

    // public function images(): HasMany {
    //     return $this->hasMany(PageImage::class)->orderBy('sort_order');
    // }
}