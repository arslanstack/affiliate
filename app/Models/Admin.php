<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $table = "admins";

    protected $fillable = [
        'name',
        'email',
        'is_SuperAdmin',
        'status',
        'email_verified_at',
        'password',
        'remember_token',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getIsSuperAdminAttribute($value)
    {
        return $value == 1 ? 'Yes' : 'No';
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d-m-Y h:i A', strtotime($value));
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('d-m-Y h:i A', strtotime($value));
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
