<?php

namespace App\Domains\User;

use App\Support\Repositories\BaseRepository;
use App\Domains\User\User;

class UserRepository extends BaseRepository
{
    protected $model = User::class;

    public function findUserByEmail(string $email)
    {
    	$user = $this->newQuery()
    		->where('email', '=', $email)
    		->first();

    	return $user;
    }
}