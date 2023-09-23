<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use illuminate\foundation\auth\user as authenticatable;

class Admin extends Model
{
    use HasFactory;
    protected $guard ='admin';
}
