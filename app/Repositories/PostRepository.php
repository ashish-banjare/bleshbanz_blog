<?php

namespace App\Repositories;

use App\Models\ {
    Post,
    Tag,
    Comment
};

class PostRepository
{

	/**
     * The Tag instance.
     *
     * @var \App\Models\Tag
     */
    protected $tag;

    /**
     * The Comment instance.
     *
     * @var \App\Models\Comment
     */
    protected $comment;

    /**
     * The Model instance.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;    

    /**
     * Create a new BlogRepository instance.
     *
     * @param  \App\Models\Post $post
     * @param  \App\Models\Tag $tag
     * @param  \App\Models\Comment $comment
     */

    public function __construct(Post $post, Tag $tag, Comment $comment){
    	$this->model = $post;
    	$this->tag = $tag;
    	$this->comment = $comment;
    }

    /**
     * Get All Posts Collection paginated.
     *
     * @param int $nbrPages
     * @param array $parameters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
    */
    public function getAll($nbrPages, $parameters)
    {
        return $this->model->with('ingoing')
            ->orderBy($parameters['order'], $parameters['direction'])
            ->when( $parameters['active'], function($query) {
                $query->whereActive(true);
            })->when( $parameters['new'], function ($query) {
                $query->has ('ingoing');
            })->when( auth()->user()->role === 'redac', function ($query) {
                $query->whereHas( 'users', function($query) {
                    $query->where('users.id', auth()->id() );
                });
            })->paginate($nbrPages);
    }

    /**
     * Update post.
     *
     * @param  \App\Models\Post  $post
     * @param  \App\Http\Requests\PostRequest  $request
     * @return void
     */
    public function update($post, $request)
    {
        $request->merge(['active' => $request->has('active')]);

        $post->update($request->all());

        $this->saveCategoriesAndTags($post, $request);
    }
    
    /**
     * Store post
     * 
     * @param \App\Http\Request\PostRequest $request
     * @return void
     */
    public function store($request){
        $request->merge(['user_id' => auth()->id()]);
        $request->merge(['active' => $request->has('active')]);

        $post = Post::create($request->all());

        $this->saveCategoriesAndTags($post, $request);
    }

    /**
     * save categories and tags
     * 
     * @param \App\Models\Post $post
     * @param \App\Http\Requests\PostRequest $request
     * @return void
     */
    protected function saveCategoriesAndTags($post, $request)
    {
        $post->categories()->sync($request->categories);

        $tags_id = [];

        if($request->tags){
            $tags = explode(',', $request->tags);
            foreach($tags as $tag){
                $tag_ref = Tag::firstOrCreate(['tag' => $tag]);
                $tags_id[] = $tag_ref->id;
            }
        }

        $post->tags()->sync($tags_id);
    }
}