<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Heating;
use Illuminate\Http\Request;

class HeatingController extends Controller
{

    private $Heating;

    function __construct(Heating $Heating)
    {
        $this->Heating = $Heating;
    }

    public function index()
    {
        return ['result' => Heating::all()];
    }

    public function store(Request $request)
    {
        $Heating = new Heating();
        $Heating->desc = $request->desc;
        $Heating->save();
        return ['color' => 'success', 'msg' => 'Criado com sucesso'];
    }

    public function show($id)
    {
        return ['result' => Heating::where('id', $id)->get()];
    }

    public function update(Request $request, $id)
    {
        $Heating = Heating::findOrFail($id);
        $Heating->desc = $request->desc;
        $Heating->save();
        return ['color' => 'success', 'msg' => 'Atualizado com sucesso'];
    }

    public function destroy($id)
    {
        $Heating = Heating::findOrFail($id);
        $Heating->delete();
        return ['msg' => 'Apagado com sucesso', 'color' => 'success'];
    }
}
