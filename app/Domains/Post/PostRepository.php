<?php
namespace App\Domains\Post;

use App\Support\Repositories\BaseRepository;
use App\Domains\Post\Post;

class PostRepository extends BaseRepository
{
    protected $model = Post::class;

    public function getPostBySlug(string $slug = null)
    {
    	if (! $slug) {
    		return false;
    	}

    	return $this->newQuery()
    		->with('comments')
            ->with('user')
    		->where('slug', $slug)
    		->first();
    }

    public function getAllPosts()
    {
        return $this->newQuery()
            ->with('user')
            ->with('tags')
            ->get();
    }
}