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
        $users = User::all();
        return UserResouce::collection($users);
    }
    public function store(StoreUpdateUserRequest $request)
    {
        $data = $request->validated();

        $data['password'] = bcrypt($request->password);

        $user = User::create($data);
        return new UserResouce($user);
    }
    public function show(string $id)
    {
        $user = User::getById($id);
        return $user;
    }
    public function update(StoreUpdateUserRequest $request, $id)
    {
        $user = User::getById($id);

        $data = $request->validated();
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return new UserResouce($user);
    }
    public function destroy(string $id)
    {
        $user = User::getById($id);
        $user->delete();
        return response()->json([], 204);
    }
}
