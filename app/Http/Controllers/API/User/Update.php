<?php

namespace App\Http\Controllers\API\User;

use App\Http\Requests\User\UpdateRequest;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Http\Resources\GenericResponseResource as GenericResponse;
use App\Exceptions\Error;

class Update extends Controller
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
    public function __invoke(UpdateRequest $request,$id)
    {
        $user = $this->userSvc->find($id);
        // authorize first
        if(auth()->user()->can('update',User::class)) {
            $data = $request->validated();

            foreach($data as $key => $value) {
                if($value == '' || empty($value)) {
                    unset($data[$key]);
                }
            }
           try {
                $user->update($data);                
                $response = [
                    'status' => 'success',
                    'message' => 'User has been updated!'
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
