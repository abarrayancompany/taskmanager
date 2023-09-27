<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    public function type() {
        return $this->belongsTo('App\Models\TaskType','type_id');
    }
    public function user() {
        return $this->belongsTo('App\Models\User','user_id');
    }
}
