<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Requests\StorePost;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::notTrash()->orderBy('id', 'ASC')->paginate(10);
        return view('back.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {

        $post = Post::create($request->all());
        $file = $request->picture;

        if(!empty($file)) {
            $link = $request->file('picture')->store('images');
            $this->savePicture($post, $link);
        }

        $post->save();
        return redirect()->route('post.index')->with('success', 'Le post a bien été crée');
//        dd($request->validated());
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
        return view('back.edit', ['post' => $post]);
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
        $start_date = \DateTime::createFromFormat('d-m-Y', $request->input('start_date'));
        $end_date = \DateTime::createFromFormat('d-m-Y', $request->input('end_date'));
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->post_type = $request->input('post_type');
        $post->start_date = $start_date;
        $post->end_date = $end_date;
        $post->price = $request->input('price');
        $post->max_students = $request->input('max_students');
        $post->status = $request->input('status');
        $file = $request->picture;

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
        return redirect()->route('post.index')->with('success', __('Post have been trashed !'));
    }


    public function showTrash()
    {
        $posts = Post::trash()->paginate(10);
        return view('back.trash', ['posts' => $posts]);
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
}
