<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Repositories\PostRepository;
use App\Models\Tag;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * The PostRepository instance.
     *
     * @var \App\Repositories\PostRepository
     */
    protected $postRepository;

    /**
     * The Pagination number.
     *
     * @var int
     */
    protected $nbrPages;

    /** 
     * Create a New PostController instance
     *
     * @param \App\Repositories\PostRepository $postRepository
     * @return void
     */
    public function __construct(PostRepository $postRepository)
    {
    	$this->postRepository = $postRepository;
    	$this->nbrPages = config('app.nbrPages.front.posts');
    }

    /**
     * Display a listing of the posts.
     *
     * @return \Illuminate\Http\Reponse
     */
    public function index()
    {
    	$posts = $this->postRepository->getActiveOrderByDate($this->nbrPages);

    	return view('front.index', compact('posts'));
    }

    /**
     * Display a listing of the posts for the specified category.
     *
     * @param \Illuminate\Http\Request  $request
     * @param string $slug
     * @return \Illuminate\Http\Reponse
     */
    public function show(Request $request, $slug)
    {
        $user = $request->user();

        return view('front.post', array_merge( $this->postRepository->getPostBySlug($slug), compact('user')));
    }
}