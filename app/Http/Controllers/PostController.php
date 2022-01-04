<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Auth;
use Psy\Util\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::when(request()->search,function ($query) {
            $keyword = request()->search;
            $query->orWhere('title','like',"%$keyword%")
                    ->orWhere('description','like','%'.$keyword.'%');
        })->with(['user','category'])->latest("id")->paginate(10);
        return view('post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {

        $request->validate([
           'title' => 'required|min:3|unique:posts,title',
           'category' => 'required|exists:categories,id',
           'description' => 'required|min:10'
        ]);
        $post = new Post();
        $post->title = $request->title;
        $post->slug = date("d-m-Y").\Illuminate\Support\Str::slug($request->title);
        $post->category_id = $request->category;
        $post->description = $request->description;
        $post->excerpt = \Illuminate\Support\Str::words($request->description, 20);
        $post->user_id = Auth::id();
        $post->isPublish = 1;

        $post->save();
        return redirect()->route('post.index')->with('status',"Aung P Aung P");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
//        return $post;
        $post->delete();
        return redirect()->route('post.index')->with('status',"Aung P Aung P");

    }
}
