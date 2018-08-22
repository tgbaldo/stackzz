<?php
namespace App\Domains\Post;

use App\Support\Repositories\BaseRepository;
use App\Domains\Post\Post;

class PostRepository extends BaseRepository
{
    protected $model = Post::class;
}