<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Requests\StorePost;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // GET parameters
        $paginate = $request->input('paginate') ?? 10;
        $search = $request->input('search') ?? null;

        if($search !== null) {
            $posts = $this->checkCategories($paginate, $search, 'notTrash');
            $posts->withPath('?search=' . $search);
        } else {
            $posts = Post::notTrash()->orderBy('updated_at', 'DESC')->paginate($paginate);
        }
        $trashed = Post::trash()->count();


        return view('back.index', ['posts' => $posts, 'trashed' => $trashed, 'search' => $search]);
    }


    public function showTrash(Request $request)
    {
        // GET parameters
        $paginate = $request->input('paginate') ?? 10;
        $search = $request->input('search') ?? null;

        if($search !== null) {
            $posts = $this->checkCategories($paginate, $search, 'trash');
            $posts->withPath('?search=' . $search);
        } else {
            $posts = Post::trash()->orderBy('updated_at', 'DESC')->paginate($paginate);
        }


        return view('back.trash', ['posts' => $posts, 'search' => $search]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('back.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {
        $catIDTab = $this->fillPostCategoriesIdArray($request->hcategories);
        $post = Post::create($request->except(['start_date', 'end_date']));
        $post->start_date = \DateTime::createFromFormat('d-m-Y', $request->input('start_date'));
        $post->end_date = \DateTime::createFromFormat('d-m-Y', $request->input('end_date'));
        $post->categories()->attach($catIDTab);
        $file = $request->picture;

        if(!empty($file)) {
            $link = $request->file('picture')->store('/');
            $this->savePicture($post, $link);
        }

        $post->save();
        return redirect()->route('post.index')->with('success', 'Le post a bien été crée');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $postCategories = $post->categories()->get();
        return view('back.edit', ['post' => $post, 'categories' => $categories, 'postCategories' => $postCategories]);
        in_array($id, $post->categories()->pluck('id')) ? "checked" : "";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(StorePost $request, Post $post)
    {
        $catIDTab = $this->fillPostCategoriesIdArray($request->hcategories);
        $post->update($request->except(['start_date', 'end_date']));
        $post->start_date = \DateTime::createFromFormat('d-m-Y', $request->input('start_date'));
        $post->end_date = \DateTime::createFromFormat('d-m-Y', $request->input('end_date'));
        $file = $request->picture;
        $post->categories()->sync($catIDTab);

        if(!empty($file)) {
            $link = $request->file('picture')->store('/');
            $this->savePicture($post, $link);
        }
        $post->save();
        return redirect()->route('post.index')->with('success', __('Post has been updated !'));
    }



    /**
     * Set the status of the specified resource to trash.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */


    public function setTrash(Post $post)
    {
        $post->update([
            'status' => 'trash'
        ]);


        return redirect()->route('post.index')->with('warning', __('Post has been trashed !'));
    }


    public function massTrash(Request $request)
    {
        $postIdTab = explode(',', $request->input('ids'));
        foreach ($postIdTab as $postId) {
            $post = Post::find($postId);
            $post->update([
                'status' => 'trash'
            ]);
        }
    }

    public function massDelete(Request $request)
    {
        $postIdTab = explode(',', $request->input('ids'));
        foreach ($postIdTab as $postId) {
            $post = Post::find($postId);
            $post->delete();
        }

    }
    public function restore(Request $request)
    {
        $postIdTab = explode(',', $request->input('ids'));
        foreach ($postIdTab as $postId) {
            $post = Post::find($postId);
            $post->update([
                'status' => 'draft'
            ]);
        }

    }

    public function setDraft(Post $post)
    {
        $post->update([
            'status' => 'draft'
        ]);
        return redirect()->route('showTrash')->with('success', __('Post has been restored to draft'));
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('showTrash')->with('success', __('Post has been deleted !'));
    }

    private function savePicture(Post $post, $link)
    {
        if(count($post->picture) > 0) {
            Storage::disk('local')->delete($post->picture->link);
            $post->picture()->delete();
        }
        $post->picture()->create([
            'link' => $link,
            'title' => $request->img_title ?? "No title"
        ]);
    }

    private function checkCategories($paginate, $search, $type)
    {
        $categories = Category::all();
        foreach ($categories as $category) {
            if(stripos($category->name, $search) === false) {
                if($type === 'notTrash') {
                    $posts = Post::where('title', 'like', '%' . $search . '%')
                        ->orWhere('post_type', 'like', '%' . $search . '%')
                        ->orWhere('status', 'like', '%' . $search . '%')
                        ->$type()
                        ->paginate($paginate);
                } else {
                    $posts = Post::where('title', 'like', '%' . $search . '%')
                        ->orWhere('post_type', 'like', '%' . $search . '%')
                        ->$type()
                        ->paginate($paginate);

                }

            } else {
                return Category::find($category->id)->posts()->$type()->paginate($paginate);
            }
        }

        return $posts;

    }

    private function fillPostCategoriesIdArray($data)
    {
        $catTab = explode(',', $data);
        $array = [];
        foreach ($catTab as $name) {
            $newCatOrNot = Category::where('name', '=', $name)->get();
            if($newCatOrNot->count() === 0) {
                $category = new Category(['name' => $name]);
                $category->save();
                array_push($array, $category->id);
            } else {
                array_push($array, $newCatOrNot[0]->id);
            }

        }
        return $array;
    }
}
