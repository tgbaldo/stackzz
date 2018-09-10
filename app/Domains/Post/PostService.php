<?php

namespace App\Domains\Post;

use App\Domains\Post\PostRepository;
use Illuminate\Support\Facades\Auth;

class PostService
{
	private $postRepository;

	public function __construct(PostRepository $postRepository)
	{
		$this->postRepository = $postRepository;
	}

	public function store(array $data) : bool
	{
		$data['user_id'] = Auth::id();

		try {
			$post = $this->postRepository->create($data);
			$post->tags()->attach($data['tags']);
		} catch (\Exception $e) {
			echo $e->getMessage();
			return false;
		}

		return true;
	}

	public function getPostBySlug(string $slug = null)
	{
		if (! $slug) {
			return redirect('/404');
		}

		$post = $this->postRepository->getPostBySlug($slug);

		if (! $post) {
			return redirect('/404');
		}

		return $post;
	}
}
