<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEarning extends Model
{
    use HasFactory;

    protected $table = 'user_earnings';
    protected $fillable = [
        'user_id',
        'available_balance',
        'total_earnings',
        'total_withdrawn',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
