<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCommission extends Model
{
    use HasFactory;

    protected $table = 'user_commissions';

    protected $fillable = [
        'user_id',
        'order_id',
        'shopper_id',
        'commission_level_id',
        'commission_amount',
        'commission_percentage',
        'order_amount',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function commissionLevel()
    {
        return $this->belongsTo(CommissionLevel::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function shopper()
    {
        return $this->belongsTo(User::class, 'shopper_id');
    }

    public function getCommissionAmountAttribute($value)
    {
        return number_format($value, 2);
    }

    public function getCommissionPercentageAttribute($value)
    {
        return number_format($value, 2);
    }

    public function getOrderAmountAttribute($value)
    {
        return number_format($value, 2);
    }
}
