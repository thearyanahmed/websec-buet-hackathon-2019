<?php

namespace App\Http\Controllers\API\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Http\Resources\GenericResponseResource as GenericResponse;
use App\Exceptions\Error;
class Downgrade extends Controller
{
    private $userSvc; 

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
        // authorize first
        if(auth()->user()->can('update',User::class)) {
            if($user->role == 'user' && $user->role != 'admin') {
                 throw new Error(null,false,'User is not a moderator.',422);
            }      
           try {
                $user->update(['role' => 'user']);
                
                $response = [
                    'status' => 'success',
                    'message' => 'User is now a regular user.'
                ] ;
                return new GenericResponse($response);
           } catch (\Exception $e) {    
                throw new Error($e,false);
           } 
        } else {
            throw new Error(null,false,'Unauthorized',403);
        }
    }
}
