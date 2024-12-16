<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'status',
        'discount_type',
        'discount_value',
        'applicable_to',
        'usage_limit',
        'is_visible',
    ];

    /**
     * Scope to get active sales.
     */
    public function scopeActive(Builder $query)
    {
        return $query->where('status', 'active')
            ->whereDate('start_date', '<=', Carbon::now())
            ->whereDate('end_date', '>=', Carbon::now());
    }


    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
