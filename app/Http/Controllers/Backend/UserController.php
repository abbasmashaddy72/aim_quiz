<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        view()->share('title', 'Users');
    }

    public function index()
    {
        return view('pages.backend.users.index');
    }

    public function impersonate(User $user)
    {
        auth()->user()->impersonate($user);

        return redirect()->route('home.index');
    }

    public function leaveImpersonate()
    {
        auth()->user()->leaveImpersonation();

        return redirect()->route('home.index');
    }
}
