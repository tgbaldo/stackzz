<?php

namespace App\Domains\Tag;

use App\Domains\Post\Post;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	protected $fillable = [
		'name'
	];

	public function posts()
    {
        return $this->belongsToMany(Post::class, 'posts_tags');
    }
}
