<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\CardEquipament;
use App\Models\Equipament;
use App\Models\Goal;
use App\Models\Heating;
use App\Models\User;
use Illuminate\Http\Request;

class CardController extends Controller
{
    private $Card;

    function __construct(Card $Card)
    {
        $this->Card = $Card;
    }

    public function index()
    {
        $Retorno = [];
        foreach ($this->Card->all() as $i => $Card) {
            $Retorno[$i]['id'] = $Card->id;
            $Retorno[$i]['nextReview'] = $Card->nextReview;
            $Retorno[$i]['startDate'] = $Card->startDate;
            $Retorno[$i]['frequency'] = $Card->frequency;
            $Retorno[$i]['idUser'] = $Card->idUser;
            $Retorno[$i]['user'] = $Card->getUser->name;
            $Retorno[$i]['goal'] = $Card->getGoal->desc;
            $Retorno[$i]['idHeating'] = $Card->idHeating;
            $Retorno[$i]['heating'] = $Card->getHeating->desc;
            $Retorno[$i]['idGoal'] = $Card->idGoal;
        }

        return ['result' => $Retorno];
    }

    public function store(Request $request)
    {
        $Card = new Card();
        try {
            $Card->idHeating = $request->idHeating;
            $Card->idGoal = $request->idGoal;
            $Card->nextReview = substr($request->nextReview, 0, 10);
            $Card->startDate = substr($request->startDate, 0, 10);
            $Card->idUser = $request->idUser;
            $Card->frequency = $request->frequency;
            $Card->save();
            return ['color' => 'success', 'msg' => 'Criado com sucesso'];
        } catch (\Throwable $th) {
            return ['color' => 'warning', 'msg' => 'Erro no processamento'];
        }
    }

    public function create()
    {
        $Retorno = [];
        $RetornoUsers = [];
        $Users = User::all()->where('active', '1')->where('idAcademy', '1');
        foreach ($Users as $i => $User) {
            $RetornoUsers[$i]['name'] = $User->name;
            $RetornoUsers[$i]['id'] = $User->id;
        }
        $Retorno['result'][0]['users'] = $RetornoUsers;
        $Retorno['result'][0]['heatings'] = Heating::all();
        $Retorno['result'][0]['goals'] = Goal::all();
        return $Retorno;
    }

    public function show($id)
    {
        $Card = Card::findOrFail($id);
        $Retorno = [];
        $Retorno['id'] = $Card->id;
        $Retorno['nextReview'] = $Card->nextReview;
        $Retorno['startDate'] = $Card->startDate;
        $Retorno['frequency'] = $Card->frequency;
        $Retorno['idUser'] = $Card->idUser;
        $Retorno['user'] = $Card->getUser->name;
        $Retorno['idHeating'] = $Card->idHeating;
        $Retorno['heating'] = $Card->getHeating->desc;
        $Retorno['idGoal'] = $Card->idGoal;
        $Retorno['goal'] = $Card->getGoal->desc;

        $Equipaments = CardEquipament::where('idCard', $Card->id)->get();
        $Retorno['equipaments'] = [];
        foreach ($Equipaments as $Equipament) {
            $Retorno['equipaments'][] = Equipament::where('id', $Equipament->idEquipaments)
                ->select('name', 'id')
                ->get();
        }

        return ['result' => $Retorno];
    }

    public function update(Request $request, $id)
    {
        $Card = Card::findOrFail($id);
        try {
            $Card->idHeating = $request->idHeating;
            $Card->idGoal = $request->idGoal;
            $Card->nextReview = substr($request->nextReview, 0, 10);
            $Card->startDate = substr($request->startDate, 0, 10);
            $Card->idUser = $request->idUser;
            $Card->frequency = $request->frequency;
            $Card->save();
            return ['color' => 'success', 'msg' => 'Atualizado com sucesso'];
        } catch (\Throwable $th) {
            return ['color' => 'warning', 'msg' => 'Erro no processamento'];
        }
    }


    public function destroy($id)
    {
        $Card = Card::findOrFail($id);
        $Card->delete();
        return ['msg' => 'Apagado com sucesso', 'color' => 'success'];
    }
}
