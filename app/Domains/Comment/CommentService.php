<?php

namespace App\Domains\Comment;

use App\Domains\Comment\CommentRepository;
use App\Domains\Post\PostRepository;
use Illuminate\Support\Facades\Auth;

class CommentService
{
	private $commentRepository;
	private $postRepository;

	public function __construct(
		CommentRepository $commentRepository,
		PostRepository $postRepository
	) {
		$this->commentRepository = $commentRepository;
		$this->postRepository = $postRepository;
	}

	public function store(array $data)
	{
		$data['user_id'] = Auth::id();

		$comment = $this->commentRepository->create($data);

		if (! $comment) {
			return response()->json([
	            'status' => false,
	            'message' => 'Erro, tente novamente'
	        ]);
		}
		
		$post = $this->postRepository->findById($data['post_id']);

        return response()->json([
            'status' => true,
            'redirect' => route('posts.show', ['slug' => $post->slug]),
            'message' => 'Comentário enviado com sucesso!'
        ]);
	}
}
