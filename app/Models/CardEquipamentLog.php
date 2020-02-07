<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardEquipamentLog extends Model
{
    protected $table = 'card_equipaments_log';

    protected $fillable = [
        'idcard', 'idequipaments', 'rest', 'weight', 'series',
        'repetition', 'side', 'completed', 'date', 'operation'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function getEquipaments()
    {
        return $this->hasOne(Equipament::class, 'id', 'idEquipaments');
    }
}
