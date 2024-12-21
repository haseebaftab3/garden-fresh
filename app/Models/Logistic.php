<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logistic extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'logistic_provider',
        'tracking_id',
        'status',
    ];

    /**
     * Relationship: Logistic belongs to an Order
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
