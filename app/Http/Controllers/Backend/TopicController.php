<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function __construct()
    {
        view()->share('title', 'Topic');
    }

    public function index()
    {
        return view('pages.backend.topic.index');
    }
}
