<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Topic;
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

    public function ck_upload(Request $request)
    {
        $topic = new Topic();
        $topic->id = 0;
        $topic->exists = true;
        $image = $topic->addMediaFromRequest('upload')->toMediaCollection('images');

        return response()->json([
            'url' => $image->getUrl('thumb')
        ]);
    }
}
