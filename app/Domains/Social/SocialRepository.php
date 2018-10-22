<?php

namespace App\Domains\Social;

use App\Support\Repositories\BaseRepository;
use App\Domains\User\User;

class SocialRepository extends BaseRepository
{
    protected $model = Social::class;
}