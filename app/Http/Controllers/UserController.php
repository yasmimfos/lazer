<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateUserRequest;
use App\Http\Resources\UserResouce;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return UserResouce::collection($users);
    }
    public function store(StoreUpdateUserRequest $request)
    {
        $data = $request->validated();
        $data['senha'] = bcrypt($data->senha);

        $user = User::create($data);
        return new UserResouce($user);
    }
    public function show(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }
        return new UserResouce($user);
    }
    public function update(StoreUpdateUserRequest $request, string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }

        $data = $request->validated();
        if ($request->password) {
            $data['senha'] = bcrypt($request->senha);
        }

        $user->update($data);

        return new UserResouce($user);
    }
    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }
        $user->delete();
        return response()->json([], 204);
    }
}
