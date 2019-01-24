<?php

namespace App\Http\Controllers\API\Auth;

use App\Services\AuthService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Register as RegisterRequest;
use App\Http\Resources\UserResource;

class Register extends Controller
{
    /**
     * Authentication Service
     * @var Prophecy\ServicePacker\Service\Service 
     */
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->middleware('guest');
        $this->authService = $authService;
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(RegisterRequest $request)
    {
        $data = $request->validated();
        $message  = ['message' => 'working','data' => $data];

        
        $response = $this->authService->register($data);
        // validate data
        // make custom request
        return new UserResource($response);
        // return $this->jsonResponse($response);
    }
}


