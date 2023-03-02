<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Topic;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        return view('pages.frontend.index');
    }

    public function ready_quiz(Topic $topic)
    {
        view()->share('title', $topic->title);
        $topic_id = $topic->id;

        if ($topic->start >= date('Y-m-d') && $topic->end <= date('Y-m-d')) {
            return abort(404);
        } else {
            return view('pages.frontend.ready_quiz', compact('topic_id'));
        }
    }
}
