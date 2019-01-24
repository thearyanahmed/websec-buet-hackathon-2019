<?php

namespace App\Http\Controllers\API\Post;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exceptions\Error;
use App\Services\PostService;
use App\Models\Post;
use App\Http\Resources\GenericResponseResource as GenericResponse;

class Approve extends Controller
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
        // check if it is integer,use middleware
        $post = $this->postSvc->find($id);

        if(empty($post)) {
            throw new Error(null,false,'Sorry,post not found.',404);
        }
        if(auth()->user()->can('approve',Post::class)) {
            if($post->status == 0) {
                throw new Error(null,false,'Post was already approved!',422);
            }

            try {
                $data = [
                    'status' => 1,
                    'last_modified_by' => auth()->user()->id
                ];
                $post->update($data);

                $response = [
                    'status'  => 'success',
                    'message' => 'Post has been approved successfully!'
                ];
                return new GenericResponse($response );
            } catch (\Exception $e) {
                throw new Error($e,false);
            }
        } else {
            throw new Error(null,false,'Unauthorized',403);
        }
    }
}
