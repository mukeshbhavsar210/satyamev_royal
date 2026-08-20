<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model {
    protected $fillable = [ 'project_id','apartment_name','category','image','location','rooms','area','units','description','completion','status'];

    public function apartmentImages() {
        return $this->hasMany(ApartmentImage::class);
    }

    public function project() {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
