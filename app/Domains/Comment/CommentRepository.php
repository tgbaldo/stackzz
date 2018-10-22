<?php

namespace App\Domains\Comment;

use App\Support\Repositories\BaseRepository;
use App\Domains\Comment\Comment;

class CommentRepository extends BaseRepository
{
    protected $model = Comment::class;
}