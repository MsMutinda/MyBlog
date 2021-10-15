<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname',
        'lname',
        'email',
        'phone',
        'gender',
        'hobbies',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //define user-blogs relation
    public function blogs() 
    {
        return $this->hasMany(Blog::class);
    }

    //a user can only like the same post once
    // public function likes() 
    // {
    //     return $this->hasOne('App\Models\LikeDislike','user_id');
    // }

    //a user can only dislike the same post once
    // public function dislikes(){
    //     return $this->hasOne('App\Models\LikeDislike','user_id');
    // }

}
