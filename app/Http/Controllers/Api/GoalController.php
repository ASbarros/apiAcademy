<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Goal;
use Illuminate\Http\Request;

class GoalController extends Controller
{
    private $Goal;

    function __construct(Goal $Goal)
    {
        $this->Goal = $Goal;
    }
    
    public function index()
    {
        return ['result' => Goal::all()];
    }

    public function store(Request $request)
    {
        $Goal = new Goal();
        $Goal->desc = $request->desc;
        $Goal->save();
        return ['color' => 'success', 'msg' => 'Criado com sucesso'];
    }

    public function show($id)
    {
        return ['result' => Goal::where('id', $id)->get()];
    }

    public function update(Request $request, $id)
    {
        $Goal = Goal::findOrFail($id);
        $Goal->desc = $request->desc;
        $Goal->save();
        return ['color' => 'success', 'msg' => 'Atualizado com sucesso'];
    }

    public function destroy($id)
    {
        $Goal = Goal::findOrFail($id);
        $Goal->delete();
        return ['msg' => 'Apagado com sucesso', 'color' => 'success'];
    }
}
