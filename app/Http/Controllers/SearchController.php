<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use Route;

class SearchController extends Controller
{
    public function searchAdmin(Request $request)
    {
        $paginate = $request->paginate ?? 10;
        $search = $request->search ?? null;
        $from = $request->from ?? null;
        $trashed = Post::trash()->count();

        if($search !== null) {
            $posts = $this->checkAdminCategories($paginate, $search, $from);
        } else {
            if($from === route('post.index')) {
                $posts = Post::where('title', 'like', '%' . $search . "%")
                    ->orWhere('post_type' , 'like', '%' . $search . '%')
                    ->notTrash()
                    ->paginate($paginate);
            } else {
                $posts = Post::where('title', 'like', '%' . $search . "%")
                    ->orWhere('post_type' , 'like', '%' . $search . '%')
                    ->trash()
                    ->paginate($paginate);
            }
        }


        $posts->withPath('?search=' . $search);
        return view('back.partials.searchResult', ['posts' => $posts, 'trashed' => $trashed, 'search' => $search]);

    }

    public function searchStages(Request $request)
    {
        $paginate = $request->paginate ?? 5;
        $search = $request->search ?? null;

        if($search !== null) {
            $posts = $this->checkCategories($paginate, $search, 'stage');
        } else {
            $posts = Post::published()->stage()
                ->where('title', 'like', '%' . $search . "%")
                ->paginate($paginate);
        }


        $posts->withPath('?search=' . $search);
        return view('front.partials.searchResult', ['posts' => $posts, 'search' => $search]);

    }

    public function searchFormations(Request $request)
    {
        $paginate = $request->paginate ?? 5;
        $search = $request->search ?? null;

        if($search !== null) {
            $posts = $this->checkCategories($paginate, $search, 'formation');
        } else {
            $posts = Post::published()->formation()
                ->where('title', 'like', '%' . $search . "%")
                ->paginate($paginate);
        }


        $posts->withPath('?search=' . $search);
        return view('front.partials.searchResult', ['posts' => $posts, 'search' => $search]);

    }

    private function checkCategories($paginate, $search, $type = null)
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

    private function checkAdminCategories($paginate, $search, $from)
    {
        $categories = Category::all();
        foreach ($categories as $category) {
            if(stripos($category->name, $search) === false) {
                if($from === route('post.index')) {
                    $posts = Post::where('title', 'LIKE', '%' . $search . '%')
                        ->orWhere('status' , 'LIKE', '%' . $search . '%')
                        ->orWhere('post_type', 'LIKE', '%' . $search . '%')
                        ->notTrash()
                        ->paginate($paginate);
                } else {
                    $posts = Post::where('title', 'LIKE', '%' . $search . '%')
                        ->orWhere('status' , 'LIKE', '%' . $search . '%')
                        ->orWhere('post_type', 'LIKE', '%' . $search . '%')
                        ->trash()
                        ->paginate($paginate);
                }

            } else {
                if($from === route('post.index')) {
                    return Category::find($category->id)->posts()->notTrash()->paginate($paginate);
                } else {
                    return Category::find($category->id)->posts()->trash()->paginate($paginate);
                }
            }
        }

        return $posts;

    }
}
