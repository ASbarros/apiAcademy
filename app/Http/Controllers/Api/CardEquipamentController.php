<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CardEquipament;
use App\Models\Equipament;
use Illuminate\Http\Request;

class CardEquipamentController extends Controller
{
    private $CardEquipament;
    private $Resultado;

    function __construct(CardEquipament $CardEquipament)
    {
        $this->CardEquipament = $CardEquipament;
        $this->Resultado = [];
    }

    public function index()
    {
        return ['result' => $this->CardEquipament->all()];
    }

    public function store(Request $request)
    {
        $data = $request->all();
        try {
            $this->CardEquipament->idEquipaments = $data['idEquipaments'];
            $this->CardEquipament->rest = $data['rest'];
            $this->CardEquipament->repetition = $data['repetition'];
            $this->CardEquipament->series = $data['series'];
            $this->CardEquipament->weight = $data['weight'];
            $this->CardEquipament->side = $data['side'];
            $this->CardEquipament->idCard = $data['idCard'];
        } catch (\Throwable $th) {
            return ['msg' => 'Erro nos dados.', 'color' => 'warning'];
        }
        try {
            $this->CardEquipament->save();
        } catch (\Throwable $th) {
            return ['msg' => 'Registro já existe', 'color' => 'warning'];
        }
        return ['msg' => 'Criado com sucesso', 'color' => 'success'];
    }


    public function show($idCard, $idEquipament = null)
    {
        if ($idEquipament) {
            $CardEquipaments = CardEquipament::where('idCard', $idCard)->get();

            foreach ($CardEquipaments as $a) {
                $equipament = $a->getEquipaments;
                if ($equipament->id == $idEquipament) $this->Resultado['equipament'] = $equipament;
            }

            $this->Resultado['data'] = CardEquipament::where([
                ['idCard', $idCard],
                ['idEquipaments', $idEquipament]
            ])->get();

            return ['result' => [$this->Resultado]];
        } else {
            $Equipaments = CardEquipament::where('idCard', $idCard)->get();
            $Retorno = [];
            foreach ($Equipaments as $i => $Equipament) {
                $Retorno[$i]['equipament'] = Equipament::where('id', $Equipament->idEquipaments)
                    ->select('name', 'id')
                    ->first();
                $Retorno[$i]['dados'] = CardEquipament::where([
                    ['idEquipaments', $Equipament->idEquipaments],
                    ['idCard', $Equipament->idCard]
                ])->select('weight', 'series', 'repetition')
                    ->first();
            }

            return ['result' => $Retorno];
        }
    }

    public function update(Request $request, $idCard, $idEquipament = null)
    {
        $data = $request->all();
        if ($idEquipament) {
            $this->CardEquipament = CardEquipament::where([
                ['idCard', $idCard],
                ['idEquipaments', $idEquipament]
            ]);

            $this->CardEquipament->update(
                ['rest' => $data['rest']]
            );

            $this->CardEquipament->update(
                ['repetition' => $data['repetition']]
            );

            $this->CardEquipament->update(
                ['weight' => $data['weight']]
            );

            $this->CardEquipament->update(
                ['side' => $data['side']]
            );

            return ['msg' => 'Atualizado com sucesso', 'color' => 'success'];
        } else {
            foreach ($data as $i)
                if ($i) {
                    $this->CardEquipament = CardEquipament::where([
                        ['idCard', $idCard],
                        ['idEquipaments', $i['idEquipament']]
                    ]);

                    $this->CardEquipament->update(
                        ['weight' => $i['weight']]
                    );
                    return ['msg' => 'Atualizado com sucesso', 'color' => 'success'];
                }
        }
    }

    public function destroy($idCard, $idEquipament)
    {
        $this->CardEquipament = CardEquipament::where([
            ['idCard', $idCard],
            ['idEquipaments', $idEquipament]
        ])->delete();

        return ['msg' => 'Apagado com sucesso', 'color' => 'success'];
    }
}
