<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::select('nome', 'email')->get();
        return response()->json($users, 200);
    }
    public function store(Request $request)
    {
        //hashear a senha
        $user = User::create($request->all());
        return response()->json(['Usuário cadastrado com sucesso!'], 201);
    }
}
