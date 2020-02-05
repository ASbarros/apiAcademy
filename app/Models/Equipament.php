<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipament extends Model
{
    protected $table = 'equipaments';

    protected $fillable = [
        'name', 'obs', 'id', 'img'
    ];

    protected $hidden = ['created_at', 'updated_at'];
}
