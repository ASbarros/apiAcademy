<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Measure;
use Illuminate\Http\Request;

class MeasureController extends Controller
{
    private $Measure;

    function __construct(Measure $Measure)
    {
        $this->Measure = $Measure;
    }

    public function index()
    {
        return ['result' => Measure::all()];
    }


    public function store(Request $request)
    {
        $data = $request->all();
        foreach ($data as $key => $value) {
            if (!$value) return ['msg' => 'Preencha todos os campos.', 'color' => 'warning'];
            $this->Measure->$key = $value;
        }
        $this->Measure->save();

        return ['color' => 'success', 'msg' => 'Criado com sucesso'];
    }

    public function show($id)
    {
        return ['result' => Measure::where('id', $id)->first()];
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $this->Measure = Measure::findOrFail($id);

        foreach ($data as $key => $value) {
            if (!$value) return ['msg' => 'Preencha todos os campos.', 'color' => 'warning'];
            $this->Measure->$key = $value;
        }
        $this->Measure->save();

        return ['color' => 'success', 'msg' => 'Atualizado com sucesso'];
    }

    public function destroy($id)
    {
        $this->Measure = Measure::findOrFail($id);
        $this->Measure->delete();
        return ['msg' => 'Apagado com sucesso', 'color' => 'success'];
    }
}
