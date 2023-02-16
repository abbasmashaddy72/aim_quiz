<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        return view('pages.frontend.index');
    }

    public function ready_quiz(Request $request)
    {
        view()->share('title', 'New Quiz User');
        $topic_id = $request->topic_id;

        return view('pages.frontend.ready_quiz', compact('topic_id'));
    }
}
