<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceConfiguration extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id', 'user_id', 'normal_bill', 'extra_bill', 'extra_time'
    ];

    public function Vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id', 'id');
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
