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

    public function ready_quiz(Request $request)
    {
        // $topic = Topic::where('id', 1)->get();

        // $topic->transform(function ($category) {
        //     $category->questions = Question::whereHas('topics', function ($q) use ($category) {
        //         $q->where('id', $category->id);
        //     })->where('age_restriction', '=', '>=12')
        //         ->orderByRaw("RAND()")
        //         ->take(5)
        //         ->get();
        //     return $category;
        // });

        // dd($topic);

        view()->share('title', 'New Quiz User');
        $topic_id = $request->topic_id;

        return view('pages.frontend.ready_quiz', compact('topic_id'));
    }
}
