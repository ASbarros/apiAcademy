<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardEquipament extends Model
{
    protected $table = 'card_equipaments';

    protected $fillable = [
        'idCard', 'idEquipaments', 'rest', 'weight', 'series', 'repetition', 'side'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function getEquipaments()
    {
        return $this->hasOne(Equipament::class, 'id', 'idEquipaments');
    }
}
