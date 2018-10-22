<?php

namespace App\Domains\User;

use App\Domains\User\UserRepository;
use App\Domains\Social\SocialRepository;

class UserService
{
    protected $userRepository;
    protected $social;

    public function __construct(
    	UserRepository $userRepository,
    	SocialRepository $socialRepository
    ) {
    	$this->userRepository = $userRepository;
    	$this->socialRepository = $socialRepository;
    }

    public function createUserWithSocial($userSocial)
    {
    	$dataUser = [
    		'name' => $userSocial->name,
    		'email' => $userSocial->email,
    		'avatar' => $userSocial->avatar,
    		'password' => str_random()
    	];
    	$userLocal = $this->userRepository->create($dataUser);

    	if (! $userLocal) {
    		throw new Exception('Falha ao criar usuário local!');
    	}

    	$dataSocial = [
    		'user_id' => $userLocal->id,
    		'provider' => 'google',
    		'social_id' => $userSocial->id
    	];
    	$userSocial = $this->socialRepository->create($dataSocial);

    	if (!$userSocial) {
    		$userLocal->delete();
    		throw new Exception('Falha ao associar usuário social!');
    	}

    	return $userLocal;
    }

    public function updateUserAvatar(User $user, string $avatarUrl)
    {
    	if (! isset($user->avatar)) {
    		return false;
    	}

    	if ($user->avatar == $avatarUrl) {
    		return false;
    	}

    	$user->avatar = $avatarUrl;
    	$user->save();

    	return true;
    }
}
