<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersGroups extends Model
{
    protected $table = 'users_groups';

    protected $fillable = [
        'idgroups', 'idusers'
    ];

    protected $hidden = ['created_at', 'updated_at'];
}
