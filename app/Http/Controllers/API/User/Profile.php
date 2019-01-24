<?php

namespace App\Http\Controllers\API\User;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Resources\GenericResponseResource as GenericResponse;
use App\Exceptions\Error;

class Profile extends Controller
{
    public function __construct(UserService $userSvc)
    {
        $this->userSvc = $userSvc;
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id)
    {
        $user = $this->userSvc->find($id);
        if(empty($user)) {
            throw new Error(null,false,'User not found',404);
        }
        return new GenericResponse($user);
    }
}
