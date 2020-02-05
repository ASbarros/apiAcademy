<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Academy;
use App\Models\Group;
use App\Models\Measure;
use App\Models\User;
use App\Models\UsersGroups;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class UserController extends Controller
{
    private $User;
    private $EmailUser;

    function __construct(User $User)
    {
        $this->User = $User;
        $this->EmailUser = apache_request_headers()['Apiemail'];
    }

    public function index()
    {
        $this->User = $this->User->where('email', $this->EmailUser)->first();
        if ($this->User->isDeveloper())
            return ['result' => $this->User->all()];
        if ($this->User->isAdmin())
            return ['result' => $this->User->where('idAcademy', $this->User->managerAcademy)->get()];
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $this->User->validationFileds($data);

        $this->User->active = $data['active'] ? 1 : 0;
        $this->User->pswd = $data['cpf'];
        $this->User->name = $data['name'];
        $this->User->idAcademy = $request['idAcademy'];
        $this->User->namagerAcademy = $request['managerAcademy'];
        $this->User->email = $data['email'];
        $this->User->cpf = $data['cpf'];

        $this->User->save();
        return ['color' => 'success', 'msg' => 'Criado com sucesso'];
        // refatorar conforme a pagina 122 do pdf
    }

    public function create()
    {
        $Retorno = [];
        $Retorno['result'][0]['groups'] = Group::all();
        $Retorno['result'][0]['academys'] = Academy::all();
        return $Retorno;
    }

    public function edit(Request $request, $id = null)
    {
        if ($id) {
            $data = $request->all();
            $User = User::findOrFail($id);
            if (!$this->User->validationFileds($data)[0])
                $this->User->validationFileds($data)[1];
            $User->pswd = $data['pswd'];
            $User->name = $data['name'];
            $User->email = $data['email'];
            $User->cpf = $data['cpf'];

            $User->save();
        } else { // $id undefined, return user ...
            return ['result' => User::where('email', $this->EmailUser)->first()];
        }
        return ['msg' => $request->img, 'color' => 'success'];
    }

    public function show($id)
    {
        $Resultado = [];
        $Groups = UsersGroups::where('idUsers', $id)->get();
        $Resultado['groups'] = [];
        foreach ($Groups as $i => $Group) {
            $Resultado['groups'][$i] = Group::findOrFail($Group->idGroups);
        }
        $User = User::findOrFail($id);
        $Resultado['user'] = $User;
        $Resultado['academy'] = Academy::where('id', $User->idAcademy)->get('name');
        $Resultado['measure'] = !empty(Measure::where('idUser', $id)->first()) ? Measure::where('idUser', $id)->select('id')->first() : '';
        return ['result' => [$Resultado]];
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $User = User::findOrFail($id);
        if (!$this->User->validationFileds($data)[0])
            $this->User->validationFileds($data)[1];
        $User->active = $data['active'] ? 1 : 0;
        $User->pswd = $data['pswd'];
        $User->name = $data['name'];
        $User->idAcademy = $data['idAcademy'];
        $User->managerAcademy = $data['managerAcademy'];
        $User->email = $data['email'];
        $User->cpf = $data['cpf'];

        // update users_groups ...
        $ArrayGroups = $data['group'];
        $User->save();
        $User->getGroups()->sync($ArrayGroups);

        return ['msg' => 'Atualizado com sucesso', 'color' => 'success'];
    }

    public function destroy($id)
    {
        $User = User::findOrFail($id);
        $User->delete();
        return ['msg' => 'Apagado com sucesso', 'color' => 'success'];
    }
}
