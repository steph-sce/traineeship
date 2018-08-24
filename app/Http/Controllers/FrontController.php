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

    public function showStages()
    {
        $posts = Post::stage()->orderBy('start_date', 'ASC')->paginate(5);
        return view('front.type', ['posts' =>$posts]);

    }

    public function showFormations()
    {
        $posts = Post::formation()->orderBy('start_date', 'ASC')->paginate(5);
        return view('front.type', ['posts' =>$posts]);

    }

    public function contact()
    {
        return view('front.contact');
    }
}
