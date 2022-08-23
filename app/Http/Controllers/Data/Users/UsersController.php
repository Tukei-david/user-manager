<?php

namespace App\Http\Controllers\Data\Users;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    //
    public function index() {
        return response()->json(['results' => User::latest()->paginate(20)]);
    }

    public function store(StoreUserRequest $request) {
        // Saving the user
        $user = User::create($request->only('name', 'role', 'email') + ['password' => Hash::make($request->password)]);
        // return $request->all();
        return response()->json(['user' => $user]);
    }
}
