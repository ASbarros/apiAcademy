<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    protected $fillable = [
        'desc', 'id'
    ];

    protected $hidden = ['created_at', 'updated_at'];
}
