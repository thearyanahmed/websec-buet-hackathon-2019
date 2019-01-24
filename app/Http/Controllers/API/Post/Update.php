<?php

namespace App\Http\Controllers\API\Post;

use App\Http\Requests\Post\UpdateRequest;
use App\Services\PostService;
use App\Http\Controllers\Controller;
use App\Http\Resources\GenericResponseResource as GenericResponse;
use App\Exceptions\Error;
class Update extends Controller
{
    private $postSvc;

    public function __construct(PostService $postSvc)
    {
        $this->postSvc = $postSvc;
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(UpdateRequest $request,$id)
    {
        $post = $this->postSvc->find($id);

        if(empty($post)) {
            throw new Error(null,false,'Sorry,post not found.',404);
        }
        if(!auth()->user()->can('update',$post)) {
            throw new Error(null,false,'Unauthorized',403);
        }

        $data = $request->validated();

        foreach($data as $key => $value) {
            if($value == '' || empty($value)) {
                unset($data[$key]);
            }
        }   
        try {
            if(auth()->user()->isAdmin()) {
                $data['last_modified_by'] = auth()->user()->id;
            }
            $this->postSvc->update($data,$id);
            
            $response = [
                'status'  => 'success',
                'message' => 'post has been updated!'
            ];

            return new GenericResponse($response);
        } catch (\Exception $e) {
            throw new Error($e,false);
        }
    }
}
