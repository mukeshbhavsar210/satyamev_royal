<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Page extends Model {
    protected $fillable = ['title','slug','content','featured_title','featured_description','featured_image','status'];

    public function images(): HasMany {
        return $this->hasMany(PageImage::class)->orderBy('sort_order');
    }
}