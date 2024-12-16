<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $table = 'admin';
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];

    // Hidden attributes for arrays
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Casts for attributes
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
