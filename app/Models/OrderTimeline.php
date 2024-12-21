<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTimeline extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'status',
        'icon',
        'description',
        'event_date',
        'event_time',
    ];

    // Relationship with Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
