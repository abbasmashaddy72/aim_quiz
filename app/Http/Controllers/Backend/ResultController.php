<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function __construct()
    {
        view()->share('title', 'Result');
    }

    public function index()
    {
        return view('pages.backend.result.index');
    }
}
