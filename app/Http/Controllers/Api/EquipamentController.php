<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Equipament;
use Illuminate\Http\Request;

class EquipamentController extends Controller
{
    private $Equipament;

    function __construct(Equipament $Equipament)
    {
        $this->Equipament = $Equipament;
    }

    public function index()
    {
        return ['result' => Equipament::all()];
    }

    public function store(Request $request)
    {
        if (!$request->name) return ['color' => 'danger', 'msg' => 'Campo nome é obrigatório'];
        $Equipament = new Equipament();
        $Equipament->name = $request->name;
        if ($request->obs)
            $Equipament->obs = $request->obs;
        else $Equipament->obs = '';
        $Equipament->save();
        return ['color' => 'success', 'msg' => 'Criado com sucesso'];
    }

    public function show($id)
    {
        return ['result' => Equipament::where('id', $id)->first()];
    }

    public function update(Request $request, $id)
    {
        if (!$request->name) return ['msg' => 'Novo nome não pode ser vazio', 'color' => 'warning'];

        $Equipament = Equipament::findOrFail($id);
        $Equipament->name = $request->name;
        $Equipament->img = $request->img;

        if ($request->obs) $Equipament->obs = $request->obs;
        else $Equipament->obs = '';

        $Equipament->save();
        return ['msg' => 'Atualizado com sucesso', 'color' => 'success'];
    }

    public function destroy($id)
    {
        $Equipament = Equipament::findOrFail($id);
        $Equipament->delete();
        return ['msg' => 'Apagado com sucesso', 'color' => 'success'];
    }
}
