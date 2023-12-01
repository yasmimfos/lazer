<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateUserRequest;
use App\Http\Resources\UserResouce;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::GetAll();
        return $users;
    }
    public function store(StoreUpdateUserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($request->password);

        $user = User::create($data);
        return new UserResouce($user);
    }
    public function show(Request $request)
    {
        $user = User::getById($request->user()->id);
        return $user;
    }
    public function update(StoreUpdateUserRequest $request)
    {
        $user = User::find($request->user()->id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $data = $request->validated();
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return new UserResouce($user);
    }
    public function destroy(Request $request)
    {
        $user = User::find($request->user()->id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $user->delete();
        return response()->json([], 204);
    }
}
