<?php
namespace App\Domains\Tag;

use App\Support\Repositories\BaseRepository;
use App\Domains\Tag\Tag;

class TagRepository extends BaseRepository
{
    protected $model = Tag::class;

    public function getTagsHavePosts()
    {
    	$query = "SELECT
    		tags.name,
    		COUNT(*) as posts
    		FROM tags
    		INNER JOIN posts_tags
    			ON tags.id = posts_tags.tag_id
    		GROUP BY tags.name
    		ORDER BY tags.name ASC
    	";

    	$tags = $this->db->select($query);

    	return $tags;
    }
}