<?php

namespace App\Domains\Post;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domains\Post\PostRepository;
use App\Domains\Tag\TagRepository;

class PostController extends Controller
{
    private $postRepository;
    private $tagRepository;

    public function __construct(
        PostRepository $postRepository,
        TagRepository $tagRepository
    ) {
        $this->postRepository = $postRepository;
        $this->tagRepository = $tagRepository;
    }

    /**
    * retorna posts do tipo contribuições
    * @return view
    */
    public function index(Request $request)
    {
        $data = [
            'posts' =>$this->postRepository->getAll(), 
            'tags' => $this->tagRepository->getTagsHavePosts()
        ];
        
        return view('posts/index', $data);
    }

    /**
    * retorna um post
    * @return view
    */
    public function show(Request $request, string $id)
    {
        $post = null;

        return view('posts/show', ['post' => $post]);
    }

    /**
    * retorna view que cria um novo post
    * @return view
    */
    public function create()
    {
        $data = [
            'tags' => $this->tagRepository->lists()
        ];

        return view('posts/create', $data);
    }

    /**
    * retorna view que edita um post
    * @return view
    */
    public function edit(Request $request, string $id)
    {
        $data = [];

        return view('posts/edit', $data);
    }

    /**
    * cria um novo post
    * @param Request $request
    * @return view
    */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required|unique:posts|max:255',
            'content' => 'required',
        ]);

        var_dump($validate);exit;
    }

    /**
    * atualiza um post
    * @param Request $request
    * @return view
    */
    public function update(Request $request, string $id)
    {

    }
}
