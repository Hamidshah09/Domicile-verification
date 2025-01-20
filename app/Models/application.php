<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class application extends Model
{
    protected $guarded = [];
    public function application_statuses(){
        return $this->belongsTo(application_statuses::class, 'application_status_id', 'id' );
    }
    public function application_types(){
        return $this->belongsTo(application_types::class, 'application_type_id', 'id' );
    }
    public function documents(){
        return $this->hasMany(document::class, 'application_id',  'id');
    }
    public function applicants(){
        return $this->belongsTo(applicants::class, 'applicant_id', 'id');
    }
    public function conversations(){
        return $this->hasMany(conversation::class, 'application_id', 'id');
    }
    public function users(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
}
