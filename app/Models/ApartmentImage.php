<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApartmentImage extends Model {
    protected $fillable = [ 'apartment_id', 'image', 'sort_order', ];

    public function apartment(){
        return $this->belongsTo(Apartment::class, 'apartment_id');
    }

    // public function apartment() {
    //     return $this->belongsTo(Apartment::class);
    // }
}