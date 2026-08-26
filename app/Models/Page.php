<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Page extends Model {
    protected $fillable = ['title','slug','content','featured_image','status','meta_title','meta_description',];

    public function images(): HasMany
{
    return $this->hasMany(PageImage::class)->orderBy('sort_order');
}
}
