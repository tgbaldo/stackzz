<?php

namespace App\Domains\Comment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domains\Comment\CommentRepository;
use App\Domains\Comment\CommentService;

class CommentController extends Controller
{
    private $commentRepository;
    private $commentService;

    public function __construct(
        CommentRepository $commentRepository,
        CommentService $commentService
    ) {
        $this->commentRepository = $commentRepository;
        $this->commentService = $commentService;
    }

    /**
    * cria um novo comentário
    * @param Request $request
    * @return view
    */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'content' => 'required',
            'post_id' => 'required|exists:posts,id'
        ]);

        return $this->commentService->store(
            $request->all()
        );
    }
}
