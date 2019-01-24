<?php

namespace App\Http\Controllers\API\Post;

use App\Http\Requests\Post\StoreRequest;
use App\Http\Controllers\Controller;
use App\Services\PostService;
use App\Http\Resources\GenericResponseResource as GenericResponse;
use App\Models\Post;

class Store extends Controller
{
    private $postSvc;

    public function __construct(PostService $postSvc)
    {
        // authenticated user
        $this->postSvc = $postSvc;
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        // $this->postSvc->create($data);
        Post::create($data);

        $response = [
            'status'  => 'success',
            'message' => 'Post created successfully'
        ];

        return new GenericResponse($response);
    }
}
