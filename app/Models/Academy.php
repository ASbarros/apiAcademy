<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Academy extends Model
{
    use HasApiTokens, Notifiable;

    protected $table = 'academys';

    protected $fillable = [
        'name', 'nameFantasy', 'cnpj',
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
