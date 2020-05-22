<?php

namespace App\Http\Controllers\Back;

use App\Repositories\PostRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;

class PostController extends Controller
{
    use Indexable;

    /**
     * Create a new PostController instance.
     *
     * @param App\Repositories\PostRepository $repository
    */
    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;

        $this->table = 'posts';
    }

    
    /**
     * Show the form for creating a new post.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all()->pluck('title', 'id');

        return view('back.posts.create', compact('categories'));
    }

    /**
     * Store a newly created post in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $this->repository->store($request);

        return redirect(route('posts.index'))->with('post-ok', __('The post has been successfully created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('back.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the post.
     *
     * @param  \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // $this->authorize('manage', $post);

        $categories = Category::all()->pluck('title', 'id');

        return view('back.posts.edit', compact('post', 'categories') );
    }

    /**
     * Update the post in storage.
     *
     * @param  \App\Http\Requests\PostRequest  $request
     * @param  \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $this->repository->update($post, $request);

        return back()->with('post-ok', __('The post has been successfully updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
