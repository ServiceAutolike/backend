<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstagramController extends Controller
{
    public function buffFollow()
    {
        return view('page.app.instagram.buff-follow');
    }
    public function buffLike()
    {
        return view('page.app.instagram.buff-like');
    }
    public function buffComment()
    {
        return view('page.app.instagram.buff-comment');
    }
}
