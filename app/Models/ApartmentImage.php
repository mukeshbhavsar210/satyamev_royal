<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApartmentImage extends Model {
    protected $fillable = [ 'project_id', 'image', 'sort_order', ];

    public function project() {
        return $this->belongsTo(Project::class);
    }
}