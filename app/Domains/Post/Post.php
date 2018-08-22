<?php

namespace App\Domains\Post;

use App\Domains\Tag\Tag;
use App\Domains\User\User;
use App\Domains\Comment\Comment;
use App\Domains\Category\Category;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'user_id'
    ];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'posts_tags');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}