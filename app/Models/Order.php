<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'session_id',
        'order_number',
        'subtotal',
        'total',
        'status',
        'items',
        'notes',
    ];

    /**
     * Relationship: Order belongs to a User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }


    /**
     * Relationship: Order has one Payment
     */
    public function payment()
    {
        return $this->hasOne(Payment::class, 'order_id', 'id');
    }

    /**
     * Relationship: Order has one Address (Billing)
     */
    public function billingAddress()
    {
        return $this->hasOne(Address::class, 'order_id', 'id')->where('type', 'billing');
    }

    /**
     * Relationship: Order has one Address (Shipping)
     */
    public function shippingAddress()
    {
        return $this->hasOne(Address::class, 'order_id', 'id');
    }
    public function timelines()
    {
        return $this->hasMany(OrderTimeline::class);
    }
    public function logistic()
    {
        return $this->hasOne(Logistic::class);
    }
}
