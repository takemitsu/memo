<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Http\Requests;
use App\Http\Requests\UserStoreRequest;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        return $users =  User::all()->toJson();
    }

    public function store(UserStoreRequest $request)
    {
        // 重複チェックとかは、またあとで。
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->is_admin = $request->is_admin;
        $user->save();
        return $user->toJson();
    }

    public function show($id)
    {
        $user = User::find($id);
        return $user->toJson();
    }

    public function update(UserStoreRequest $request, $id)
    {
        // 重複チェックとかは、またあとで。
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->is_admin = $request->is_admin;
        $user->save();
        return $user->toJson();
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return $user->toJson();
    }
}
