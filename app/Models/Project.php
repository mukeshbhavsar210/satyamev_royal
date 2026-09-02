<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {
    protected $fillable = [
        'title','category','image','pdf','rera','completion','units','location','description','status'
    ];

    // public function apartments() {
    //     return $this->hasMany(Apartment::class);
    // }

    public function apartments() {
        return $this->hasMany(Apartment::class, 'project_id');
    }
}
