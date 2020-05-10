<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Repositories\UserRepository;
use App\Model\User;

class UserController extends Controller
{
	use Indexable;

	/**
     * Create a new UserController instance.
     *
     * @param  \App\Repositories\UserRepository $repository
     */
	public function __construct(UserRepository $repository)
	{
		$this->repository = $repository;

        $this->table = 'users';
	}
}