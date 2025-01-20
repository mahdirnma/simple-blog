<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $writer=Auth::user();
        $posts=$writer->posts;
        return view('writer.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('writer.post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $writer=Auth::user();
        $writer->posts()->create($request->validated());
        return to_route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $posts=Post::all();
        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Post $post)
    {
        $post->update([
            'is_published'=>true,
        ]);
        return to_route('admin.posts.show');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }

    public function postLike()
    {
        $user=Auth::user();
        $posts=Post::all();
        return view('user.post.index', compact('posts','user'));
    }

    public function AddPostLike(Post $post)
    {
        $user=Auth::user();
        $user->posts()->attach($post);
        return to_route('admin.posts.like');
    }
}
