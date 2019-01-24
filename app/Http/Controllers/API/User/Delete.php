<?php

namespace App\Http\Controllers\API\User;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Resources\GenericResponseResource as GenericResponse;
use App\Exceptions\Error;

class Delete extends Controller
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
        // policy not working
        if(auth()->user()->isAdmin()) {
            
            if($user->id == auth()->user()->id) {
                throw new Error(null,false,'Cannot delete self.',422);
            }

            $user->delete();
            $response = [
                'status'  => 'success',
                'message' => 'User has been deleted!'
            ];
            return new GenericResponse($response);

        } else {
            throw new Error(null,false,'Unauthorized',403);
        }

    }
}
