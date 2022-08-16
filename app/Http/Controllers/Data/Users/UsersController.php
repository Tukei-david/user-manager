<?php

namespace App\Http\Controllers\Data\Users;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    //
    public function index() {
        return response()->json(['results' => User::latest()->paginate(20)]);
    }
}
