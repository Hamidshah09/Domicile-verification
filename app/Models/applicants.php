<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class applicants extends Model
{
    protected $guarded = [];
    public function applications(){
        return $this->hasMany(application::class, 'applicant_id', 'id');
    }

}
