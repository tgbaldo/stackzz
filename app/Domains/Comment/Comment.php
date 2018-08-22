<?php

namespace App\Domains\Comment;

use App\Domains\User\User;
use App\Domains\Post\Post;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	protected $fillable = [
        'user_id',
        'post_id',
        'content'
    ];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function post()
    {
        return $this->belongsTo(Post::class);
    }
}