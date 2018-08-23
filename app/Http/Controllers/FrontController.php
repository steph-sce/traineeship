<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class FrontController extends Controller
{
    public function index()
    {
        $posts = Post::published()->closest()->take(2)->get();
        return view('front.index', ['posts' => $posts]);
    }
}
