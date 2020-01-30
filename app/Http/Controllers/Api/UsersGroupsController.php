<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UsersGroups;
use Illuminate\Http\Request;

class UsersGroupsController extends Controller
{
    private $UserGroup;

    function __construct(UsersGroups $usersGroups)
    {
        $this->UserGroup = $usersGroups;
    }

    public function index()
    {
        return UsersGroups::all();
    }

    public function store(Request $request)
    {
        $this->UserGroup->pswdUsers = $request->pswd;
        $this->UserGroup->idGroups = $request->idgroups;
        $this->UserGroup->idUsers = $request->idusers;
        $this->UserGroup->save();
        return ['status' => 'success'];
    }

    public function show($id)
    {
        return ['msg' => 'funcao nao implementada'];
    }

    public function update(Request $request, $id)
    {
        return ['msg' => 'funcao nao implementada'];
    }

    public function destroy($id)
    {
        return ['msg' => 'funcao nao implementada'];
    }
}
