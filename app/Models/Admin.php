<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'token',
        'token_expires_at',
    ];

    protected $hidden = [
        'password',
        'token',
        'token_expires_at',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'token_expires_at' => 'datetime',
        ];
    }
}
