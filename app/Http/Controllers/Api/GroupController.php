<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    private $Group;

    function __construct(Group $Group)
    {
        $this->Group = $Group;
    }
    
    public function index()
    {
        return ['result' => Group::all()];
    }

    public function store(Request $request)
    {
        $Group = new Group();

        if (!$request->desc) return ['color' => 'warning', 'msg' => 'Digite o nome do grupo'];

        $Group->desc = $request->desc;

        if ($request->obs) $Group->obs = $request->obs;
        else $Group->obs = '';

        $Group->save();

        return ['color' => 'success', 'msg' => 'Criado com sucesso'];
    }

    public function show($id)
    {
        return ['result' => Group::where('id', $id)->get()];
    }

    public function update(Request $request, $id)
    {
        $Group = Group::findOrFail($id);

        if (!$request->desc) return ['color' => 'warning', 'msg' => 'Novo nome não pode ser vazio!'];

        $Group->desc = $request->desc;

        if ($request->obs) $Group->obs = $request->obs;
        else $Group->obs = '';

        $Group->save();

        return ['color' => 'success', 'msg' => 'Atualizado com sucesso', 'result' => $request->all()];
    }

    public function destroy($id)
    {
        $Group = Group::findOrFail($id);
        $Group->delete();
        return ['msg' => 'Apagado com sucesso', 'color' => 'success'];
    }
}
