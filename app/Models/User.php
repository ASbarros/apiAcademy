<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;


use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name', 'email', 'cpf', 'active', 'managerAcademy'
    ];

    protected $hidden = [
        'pswd', 'changePswd', 'created_at', 'updated_at'
    ];

    public function getGroups()
    {
        return $this->belongsToMany('App\Models\Group', 'users_groups', 'idUsers', 'idGroups')
            ->withPivot('idUsers', 'idGroups')
            ->withTimestamps();
    }

    public function validationFileds($data)
    {
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL))
            return [false, ['result' => $data, 'msg' => 'E-mail inválido!', 'color' => 'warning']];
        else if (strpos($data['cpf'], ".") || strpos($data['cpf'], "-"))
            return [false, ['msg' => 'Digite apenas os números no CPF', 'color' => 'warning']];
        else if (!$this->validaCPF($data['cpf']))
            return [false, ['msg' => 'CPF inválido!', 'color' => 'warning']];
        else return [true];
    }

    private function validaCPF($cpf)
    {
        // Extrai somente os números
        $cpf = preg_replace('/[^0-9]/is', '', $cpf);

        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }

        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{
                    $c} * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf{
                $c} != $d) {
                return false;
            }
        }
        return true;
    }
}
