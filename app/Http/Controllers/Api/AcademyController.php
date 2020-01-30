<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Academy;
use Illuminate\Http\Request;
use \Illuminate\Support\Str;

class AcademyController extends Controller
{
    private $Academy;

    function __construct(Academy $Academy)
    {
        $this->Academy = $Academy;
    }

    public function index()
    {
        return ['result' => Academy::all()];
    }

    public function store(Request $request)
    {
        try {
            $this->Academy->cnpj = $request->cnpj;
            $this->Academy->name = $request->name;
            $this->Academy->nameFantasy = $request->nameFantasy;
            $this->Academy->save();
        } catch (\Throwable $th) {
            return ['msg' => 'CNPJ já registrado.'];
        }
        return ['msg' => 'Criado com sucesso.'];
    }

    public function show($id)
    {
        return ['result' => $this->Academy->where('id', $id)->get()];
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        if (!$data['name']) return ['msg' => 'Nova razão social não pode ser vazia', 'color' => 'warning'];
        if (!$data['nameFantasy']) return ['msg' => 'Novo nome não pode ser vazio', 'color' => 'warning'];

        $this->Academy = Academy::findOrFail($id);
        $this->Academy->name = $data['name'];
        $this->Academy->cnpj = $data['cnpj'];
        $this->Academy->nameFantasy = $data['nameFantasy'];

        $this->Academy->save();
        return ['msg' => 'Atualizado com sucesso', 'color' => 'success'];
    }

    public function destroy($id)
    {
        $this->Academy = Academy::findOrFail($id);
        try {
            $this->Academy->delete();
        } catch (\Throwable $th) {
            return ['msg' => 'Registro não apagado, possui dependêcias', 'color' => 'warning'];
        }
        return ['msg' => 'Apagado com sucesso', 'color' => 'success'];
    }
}
