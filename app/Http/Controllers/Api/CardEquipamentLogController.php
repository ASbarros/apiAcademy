<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CardEquipamentLog;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class CardEquipamentLogController extends Controller
{
    private $CardEquipamentLog;

    function __construct(CardEquipamentLog $CardEquipamentLog)
    {
        $this->CardEquipamentLog = $CardEquipamentLog;
    }

    public static function destroy($idCard, $idEquipament)
    {
        $date = new DateTime();
        CardEquipamentLog::where([
            ['idCard', $idCard],
            ['idEquipaments', $idEquipament],
        ])->whereDate(
            'date',
            $date->format('Y-m-d')
        )->delete();
    }
}
