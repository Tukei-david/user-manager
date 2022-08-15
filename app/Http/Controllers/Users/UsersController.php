<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    // Routes get pointed to
    public function index()
    {
        return view('users.index');
    }
}
