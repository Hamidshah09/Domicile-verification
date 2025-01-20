<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    public function user_types(){
        return $this->belongsTo(user_types::class, 'user_type_id', 'id');
    }
    public function role_types(){
        return $this->belongsTo(role_types::class, 'role', 'id');
    }
    public function user_statuses(){
        return $this->belongsTo(user_statuses::class, 'status_id', 'id');
    }
    public function sentConversations() { 
        return $this->hasMany(Conversation::class, 'sender_id', 'id'); 
    }  
    public function receivedConversations() { 
        return $this->hasMany(Conversation::class, 'receiver_id', 'id'); 
    }
    public function applications(){
        return $this->hasMany(application::class, 'user_id', 'id');
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $fillable = [
        
        'cnic',
        'fathername',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
