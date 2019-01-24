<?php

namespace App\Http\Controllers\API\Post;
use App\Services\PostService;
use App\Http\Controllers\Controller;
use App\Http\Resources\GenericResponseResource as GenericResponse;
use App\Exceptions\Error;

class Show extends Controller
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
    public function __invoke($id)
    {
        // check if its integer 
        // Service not working ->
        // $post = $this->postSvc->find($id);
        $post = \App\Models\Post::find($id);
        if(! $post) {
            $response['status'] = 'error';
            $response['message'] = 'Sorry,post not found!';
            return new GenericResponse($response);
        }

        if( ! auth()->user()->can('view',$post)) {
            throw new Error(null,false,'Unauthorized',403);
        }

        return new GenericResponse($post);
    }
}
