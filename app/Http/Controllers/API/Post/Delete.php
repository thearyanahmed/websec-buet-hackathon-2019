<?php

namespace App\Http\Controllers\API\Post;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exceptions\Error;
use App\Services\PostService;
use App\Models\Post;
use App\Http\Resources\GenericResponseResource as GenericResponse;

class Delete extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id)
    {   
        // check if it is integer,use middleware
        $post = Post::find($id);     
        
        if(empty($post)) {
            throw new Error(null,false,'Sorry,post not found.',404);
        }
        if(auth()->user()->can('delete',Post::class)) {
            try {

                $post->delete();
                $response = [
                    'status' => 'success',
                    'message' => 'Post has been deleted successfully!'
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
