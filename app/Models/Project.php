<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {

    protected $fillable = [
        'title','category','location','image','pdf','units','rera','completion','description','year','timeline','show'
    ];

    // public function apartments() {
    //     return $this->hasMany(Apartment::class);
    // }

    public function apartments() {
        return $this->hasMany(Apartment::class, 'project_id');
    }
}
