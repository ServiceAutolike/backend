<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class YoutubeController extends Controller
{
    public function buffSub()
    {
        return view('page.app.youtube.buff-sub');
    }
    public function buffLike()
    {
        return view('page.app.youtube.buff-like');
    }
    public function buffComment()
    {
        return view('page.app.youtube.buff-comment');
    }
}
