<?php

namespace App\Models;

use App\Models\Offer;
use App\Models\ProfileImage;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname1',
        'surname2',
        'phone',
        'email',
        'password',
        'admin',
        'others'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The offers that a user is subscribed to.
     */
    public function offers()
    {
        return $this->belongsToMany(Offer::class);
    }

     /**
     * The profile image that belong to a user.
     */
    public function profileImage()
    {
        return $this->hasOne(ProfileImage::class, 'user_id', 'id');
    }

    public function doesntHaveProfileImage(){
        return $this->profileImage()->count() == 0;
    }
}
