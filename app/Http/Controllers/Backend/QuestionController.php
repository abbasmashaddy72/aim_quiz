<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function __construct()
    {
        view()->share('title', 'Question');
    }

    public function index()
    {
        return view('pages.backend.question.index');
    }
}
