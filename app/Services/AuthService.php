<?php

namespace App\Services;

use Hash;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Prophecy\ServicePacker\Service\Service as BaseService;

class AuthService extends BaseService
{
	private $userSvc;

	public function __construct(UserService $userSvc)
	{
		$this->userSvc  = $userSvc;
	}
	public function register(array $data)
	{
		$data['password'] = Hash::make($data['password']);

		try {
			$user = $this->userSvc->create($data);
			$response['token'] = JWTAuth::fromUser($user);
			return $response;
		} catch (\Exception $e) {
			throw new Error($e);
		}
	}

	public function logout()
	{
		if(auth()->check()) {
			auth()->logout(true);
		} else {
			throw new Error(null,false,'User not found.');
		}
	}
}
