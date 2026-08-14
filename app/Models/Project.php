<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {
    protected $fillable = [ 'project_name','category','image','location','description', 'status', ];

    public function images() {
        return $this->hasMany(ProjectImage::class);
    }   
}
