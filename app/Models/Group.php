<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';

    protected $fillable = [
        'id', 'desc', 'obs'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function getUsers()
    {
        return $this->belongsToMany(User::class, 'users_groups');
    }
}
