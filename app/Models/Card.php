<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = [
        'idGoal', 'idHeating', 'nextReview', 'startDate', 'frequency', 'idUser'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    protected function getUser()
    {
        return $this->hasOne(User::class, 'id', 'idUser');
    }

    protected function getHeating()
    {
        return $this->hasOne(Heating::class, 'id', 'idHeating');
    }

    protected function getGoal()
    {
        return $this->hasOne(Goal::class, 'id', 'idGoal');
    }

    protected function getEquipaments()
    {
        return $this->belongsToMany('App\Models\Equipament', 'card_equipaments', 'idCard', 'idEquipaments');
    }
}