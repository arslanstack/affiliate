<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'referral_code',
        'status',
        'password',
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
        'password' => 'hashed',
    ];

    /**
     * Get the affiliate record associated with the user.
     */

    public function parent()
    {
        return $this->hasOne(Affiliate::class, 'user_id');
    }

    /**
     * Get the user's parent affiliate.
     */
    public function parentUser()
    {
        return $this->hasOneThrough(User::class, Affiliate::class, 'user_id', 'id', 'id', 'parent_id');
    }
    public function child_tree()
    {
        return $this->hasMany(Affiliate::class, 'parent_id');
    }
}
