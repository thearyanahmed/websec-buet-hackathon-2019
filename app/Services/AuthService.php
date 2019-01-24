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
			return [
				'name' => $user->name,
				'token' => JWTAuth::fromUser($user)
			];
		} catch (\Exception $e) {
			throw new Error($e);
		}
	}

	public function login(array $data)
	{
		// must be unauthenticated
        try {
            if (! $token = JWTAuth::attempt($data)) {
                $response  = [
                    'status'  => 'error',
                    'message' => 'Invalid Credentials'
                ];
            } else {
                $response['token'] = $token;
            }
        	return $response;

        } catch ( JWTException $e) {
            throw new Error($e);
        }
	}

	public function logout()
	{
		if(auth()->check()) {
			return auth()->logout(true);
		} else {
			throw new Error(null,false,'User not authenticated!');
		}
	}
}
