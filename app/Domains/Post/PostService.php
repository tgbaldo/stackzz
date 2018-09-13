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

	public function update(int $id, array $data) : bool
	{
		if (! $this->isOwnerUserPost($id)) {
			throw new Exception('Você não pode editar um post que não é seu!');
		}

		try {
			$post = $this->postRepository->findById($id);

			$post->fill($data);
			$post->save();
			
			$post->tags()->sync($data['tags']);

		} catch (\Exception $e) {
			exit($e->getMessage());
		}

		return true;
	}

	public function delete(int $id)
	{
		$post = $this->postRepository->findById($id, true);

        if (! $this->isOwnerUserPost($post->id)) {
            return redirect(route('posts'));
        }

        return $post->delete();
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

	public function isOwnerUserPost(int $postId) : bool
	{
		return $this->postRepository->isOwnerUserPost(
			$postId,
			Auth::id()
		);
	}
}
