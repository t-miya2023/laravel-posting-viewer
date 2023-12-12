<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;


class Admin extends User implements MustVerifyEmail
{
    use HasFactory,Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden =[
        'password',
        'remember_Token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
