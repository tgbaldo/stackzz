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
        'user_id',
        'category_id'
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

    public function setTitleAttribute($value)
    {
        $this->attributes['slug'] = str_slug($value);
        $this->attributes['title'] = $value;
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function($post) {
            $post->tags()->detach();
            $post->comments()->delete();
        });
    }
}
