<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    private $Desenvolvedor = [
        ['title' => 'Home', 'url' => '/home', 'icon' => 'home'],
        ['title' => 'Aluno', 'url' => '/users-list', 'icon' => 'contact'],
        ['title' => 'Equipamento', 'url' => '/equipament-list', 'icon' => 'fitness'],
        ['title' => 'Fixa', 'url' => '/card-list', 'icon' => 'clipboard'],
        ['title' => 'Objetivo', 'url' => '/goal-list', 'icon' => 'trending-up'],
        ['title' => 'Aquecimento', 'url' => '/heating-list', 'icon' => 'body'],
        ['title' => 'Grupos', 'url' => '/group-list', 'icon' => 'people'],
        ['title' => 'Academias', 'url' => '/academy-list', 'icon' => 'construct']
    ];

    private $Administrador = [
        ['title' => 'Home', 'url' => '/home', 'icon' => 'home'],
        ['title' => 'Aluno', 'url' => '/users-list', 'icon' => 'contact'],
        ['title' => 'Equipamento', 'url' => '/equipament-list', 'icon' => 'fitness'],
        ['title' => 'Fixa', 'url' => '/card-list', 'icon' => 'clipboard'],
        ['title' => 'Objetivo', 'url' => '/goal-list', 'icon' => 'trending-up'],
        ['title' => 'Aquecimento', 'url' => '/heating-list', 'icon' => 'body'],
        // ['title' => 'Grupos', 'url' => '/group-list', 'icon' => 'people'],
        // ['title' => 'Academias', 'url' => '/academy-list', 'icon' => 'construct']
    ];

    private $Aluno = [
        ['title' => 'Home', 'url' => '/home', 'icon' => 'home'],
        //  ['title' => 'Aluno', 'url' => '/users-list', 'icon' => 'contact'],
        //  ['title' => 'Equipamento', 'url' => '/equipament-list', 'icon' => 'fitness'],
        //  ['title' => 'Fixa', 'url' => '/card-list', 'icon' => 'clipboard'],
        //  ['title' => 'Objetivo', 'url' => '/goal-list', 'icon' => 'trending-up'],
        //  ['title' => 'Aquecimento', 'url' => '/heating-list', 'icon' => 'body'],
        //  ['title' => 'Grupos', 'url' => '/group-list', 'icon' => 'people'],
        //  ['title' => 'Academias', 'url' => '/academy-list', 'icon' => 'construct']
    ];

    public function index(Request $request)
    {
        $data = $request->all();
        $User =  User::where('email', $data['email'])
            ->where('pswd', '=', $data['pswd'])
            ->first();
        $Response = [];

        if ($User) {
            $token = TokenController::getToken($User->email);
            header('Apitoken: ' . $token);

            try {
                $Card = Card::where('idUser', $User->id)
                    ->select('id')
                    ->first();

                $Equipaments = $Card->getEquipaments;

                foreach ($Equipaments as $Equipament) {
                    $Response['idEquipaments'][] = $Equipament->pivot->idEquipaments;
                    $Response['idCard'] = $Equipament->pivot->idCard;
                }
            } catch (\Throwable $th) {
                //throw $th;
            }

            $Groups = $User->getGroups;

            foreach ($Groups as $key => $value) {
                if (strcmp($value->desc, 'Desenvolvedor') == 0) {
                    $Response['appPages'] = $this->Desenvolvedor;
                    break;
                } else if (strcmp($value->desc, 'Administrador') == 0) {
                    $Response['appPages'] = $this->Administrador;
                    break;
                } else if (strcmp($value->desc, 'Aluno') == 0) {
                    $Response['appPages'] = $this->Aluno;
                    break;
                }
            }

            return ['result' => $Response, 'Apitoken' => $token, 'msg' => 'success', 'success' => true];
        }
        return ['msg' => 'Email/Senha não correspondem', 'color' => 'warning'];
    }
}
