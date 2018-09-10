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

    public function getAllPosts(array $filters = [], int $take = 2)
    {
        $query = $this->newQuery()
            ->with('user')
            ->with('tags');

        if (isset($filters['busca']) && !empty($filters['busca'])) {
            $query->where('title', 'like', '%'.$filters['busca'].'%');
        }
        
        return $query->orderBy('id', 'DESC')
            ->paginate($take);
    }
}