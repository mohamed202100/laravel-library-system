<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {

        $users = User::where('id', '!=', Auth::id())
            ->orderBy('name')
            ->paginate(15);

        return view('admin.users.index', compact('users'));
    }
}
