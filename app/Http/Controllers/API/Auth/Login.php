<?php

namespace App\Http\Controllers\API\Auth;

use App\Services\AuthService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Exceptions\Error;
use App\Http\Resources\GenericResponseResource as GenericResponse;

class Login extends Controller
{
    public function __construct(AuthService $authSvc)
    {
        // $this->middleware('guest must be called');
        $this->authSvc = $authSvc;
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(LoginRequest $request)
    {
        $credentials = $request->validated();
        $response    = $this->authSvc->login($credentials);
        return new GenericResponse($response);
    }
}
