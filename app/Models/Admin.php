<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;



class Admin extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['login', 'password', 'role'];
    protected $casts = [
        'login' => 'string',
        'password' => 'string',
        'role' => 'string',
    ];
    protected $hidden = ['password', 'remember_token'];
}