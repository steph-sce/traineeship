<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;

class FrontController extends Controller
{
    public function index()
    {
        $posts = Post::published()->closest()->take(2)->get();
        return view('front.index', ['posts' => $posts]);
    }

    public function show(Post $post)
    {
        return view('front.show', ['post' => $post]);
    }

    public function showStages(Request $request)
    {
        $paginate = $request->input('paginate') ?? 5;
        $search = $request->input('search') ?? null;

        if($search !== null) {
            $posts = $this->checkCategories($paginate, $search, 'stage');

        } else {
            $posts = Post::published()->stage()
                ->orderBy('start_date', 'ASC')
                ->paginate($paginate);
        }

        $posts->withPAth('?search=' . $search);
        return view('front.type', ['posts' =>$posts, 'search' => $search]);

    }

    public function showFormations(Request $request)
    {
        $paginate = $request->input('paginate') ?? 5;
        $search = $request->input('search') ?? null;
        if($search !== null) {
            $posts = $this->checkCategories($paginate, $search, 'formation');
        } else {
            $posts = Post::published()->formation()
                ->orderBy('start_date', 'ASC')
                ->paginate($paginate);
        }

        $posts->withPAth('?search=' . $search);
        return view('front.type', ['posts' =>$posts, 'search' => $search]);

    }

    public function contact()
    {
        return view('front.contact');
    }

    private function checkCategories($paginate, $search, $type)
    {
        $categories = Category::all();
        foreach ($categories as $category) {

            if(stripos($category->name, $search) === false) {
                $posts = Post::published()->$type()
                    ->where('title', 'like', '%' . $search . '%')
                    ->paginate($paginate);
            } else {
                return Category::find($category->id)->posts()->where('status', '=', 'published')->where('post_type', '=', $type)->paginate($paginate);
            }
        }

        return $posts;

    }
}
