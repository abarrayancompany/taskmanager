<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as authenticatable;

class Admin extends authenticatable
{
    protected $guard ='admin';
    use HasFactory;
}
