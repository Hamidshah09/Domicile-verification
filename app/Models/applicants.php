<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class applicants extends Model
{
    protected $guarded = [];
    public function applications(){
        return $this->hasMany(application::class, 'applicant_id', 'id');
    }
    public function childerns(){
        return $this->hasMany(childern::class, 'applicant_id', 'id');
    }
    public function occupations(){
        return $this->belongsTo(occupation::class,'occupation_id', 'id');
    }
    public function marital_status(){
        return $this->hasOne(marital_status::class, 'id','marital_status_id');
    }
}
