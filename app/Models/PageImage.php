<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PageImage extends Model {
    protected $table = 'page_images';

    protected $fillable = ['page_id','image','sort_order',];

    protected $casts = [
        'image' => 'array',
    ];

    public function page() {
        return $this->belongsTo(PageModel::class, 'page_id');
    }
}