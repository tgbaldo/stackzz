<?php

namespace App\Domains\Post;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domains\Post\PostRepository;
use App\Domains\Post\PostService;
use App\Domains\Tag\TagRepository;
use App\Domains\Category\CategoryRepository;

class PostController extends Controller
{
    private $postRepository;
    private $postService;
    private $tagRepository;
    private $categoryRepository;

    public function __construct(
        PostRepository $postRepository,
        PostService $postService,
        TagRepository $tagRepository,
        CategoryRepository $categoryRepository
    ) {
        $this->postRepository = $postRepository;
        $this->postService = $postService;
        $this->tagRepository = $tagRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
    * retorna posts do tipo contribuições
    * @return view
    */
    public function index(Request $request)
    {
        $posts = $this->postRepository->getAllPosts(
            $request->query()
        );
        $tags = $this->tagRepository->getTagsHavePosts();

        $data = [
            'posts' => $posts,
            'tags' => $tags,
            'filters' => $request->query()
        ];
        
        return view('posts/index', $data);
    }

    /**
    * retorna um post
    * @return view
    */
    public function show(Request $request, string $slug)
    {
        $post = $this->postService->getPostBySlug($slug);

        return view('posts/show', ['post' => $post]);
    }

    /**
    * retorna view que cria um novo post
    * @return view
    */
    public function create()
    {
        $data = [
            'tags' => $this->tagRepository->lists(),
            'categories' => $this->categoryRepository->lists()
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
            'tags' => 'required',
            'category_id' => 'required|exists:categories,id'
        ]);

        $this->postService->store(
            $request->all()
        );

        return redirect(route('posts'));
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
