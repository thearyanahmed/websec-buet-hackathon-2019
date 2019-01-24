<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::deleting(function($user){
            $user->posts->each->delete();
        });
    }
    /**
     * ==========================
     * Add comment 
     * ==========================
     * Gets the JWT Indentifier
     * @return JWT identifier
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    /**
     * ======================
     *Add comment
     * ======================
     * @return [type] [description]
     */
    public function getJWTCustomClaims()
    {
       return [];
    }

    public function isAdmin() : bool
    {
        return $this->role == 'admin';
    }

    public function isModerator() : bool
    {
        return $this->role == 'moderator';
    } 

    public function posts()
    {
        return $this->hasMany(Post::class);       
    }   
}
