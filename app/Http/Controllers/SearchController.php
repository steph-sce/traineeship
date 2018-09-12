<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;

class SearchController extends Controller
{
    public function searchAdmin(Request $request)
    {
        $paginate = $request->paginate ?? 10;
        $search = $request->search ?? null;
        $trashed = Post::trash()->count();

        if($search !== null) {
            $posts = $this->checkAdminCategories($paginate, $search);
        } else {
            $posts = Post::notTrash()
                ->where('title', 'like', '%' . $search . "%")
                ->orWhere('post_type' , 'like', '%' . $search . '%')
                ->paginate($paginate);
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

            if(strpos(strtolower($category->name), $search) === false) {
                //@TODO : Change for stripos
                $posts = Post::published()->$type()
                    ->where('title', 'like', '%' . $search . '%')
                    ->paginate($paginate);
            } else {
                return Category::find($category->id)->posts()->where('status', '=', 'published')->where('post_type', '=', $type)->paginate($paginate);
            }
        }

        return $posts;

    }

    private function checkAdminCategories($paginate, $search)
    {
        $categories = Category::all();
        foreach ($categories as $category) {

            if(strpos(strtolower($category->name), $search) === false) {
                //@TODO : Change for stripos
                $posts = Post::where('title', 'like', '%' . $search . '%')
                    ->orWhere('status' , 'LIKE', '%' . $search . '%')
                    ->orWhere('post_type', 'LIKE', '%' . $search . '%')
                    ->paginate($paginate);
            } else {
                return Category::find($category->id)->posts()->paginate($paginate);
            }
        }

        return $posts;

    }
}
