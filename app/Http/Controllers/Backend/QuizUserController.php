<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuizUserController extends Controller
{
    public function __construct()
    {
        view()->share('title', 'Quiz User');
    }

    public function index()
    {
        return view('pages.backend.quiz_user.index');
    }
}
