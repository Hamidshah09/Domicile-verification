<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class conversation extends Model
{
    protected $guarded=[];
    public $timestamps = false;
    
    public function application() { 
        return $this->belongsTo(Application::class, 'application_id', 'id'); 
    } 
    public function sender() { 
        return $this->belongsTo(User::class, 'sender_id', 'id'); 
    } 
    public function receiver() { 
        return $this->belongsTo(User::class, 'receiver_id', 'id'); 
    }
}
