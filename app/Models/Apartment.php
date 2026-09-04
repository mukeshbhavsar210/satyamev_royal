<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Apartment extends Model {
    protected $fillable = [ 'project_id','rooms','area','description','show'];

    public function images(): HasMany{
        return $this->hasMany(ApartmentImage::class, 'apartment_id');
    }

    public function apartmentImages() {
        return $this->hasMany(ApartmentImage::class);
    }

    public function apartment() {
        return $this->belongsTo(Apartment::class, 'apartment_id');
    }

    public function project() {
        return $this->belongsTo(Project::class);
    }

    // public function project() {
    //     return $this->belongsTo(Project::class, 'project_id');
    // }
}
