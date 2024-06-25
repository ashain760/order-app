<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;

    protected $dateFormat = 'Y-m-d';

    protected $fillable = [
        'name', 'email', 'password'
    ];

    protected $dates = ['last_signed', 'deleted_at'];
}
