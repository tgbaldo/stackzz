<?php
namespace App\Domains\Category;

use App\Support\Repositories\BaseRepository;
use App\Domains\Category\Category;

class CategoryRepository extends BaseRepository
{
    protected $model = Category::class;
}