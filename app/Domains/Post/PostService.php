<?php

namespace App\Domains\Post;

use App\Domains\Post\PostRepository;

class PostService
{
	private $postRepository;

	public function __construct(PostRepository $postRepository)
	{
		$this->postRepository = $postRepository;
	}

	public function store(array $data) : bool
	{
		$tags = $data['tags'];
		unset($data['tags']);

		$data['slug'] = str_slug($data['title']);

		$this->postRepository->store($data);
	}
}