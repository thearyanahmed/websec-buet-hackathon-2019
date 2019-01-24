<?php

namespace App\Http\Controllers\API\Auth;

use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Http\Controllers\Controller;

class Logout extends Controller
{
    private $authSvc;

    public function __construct(AuthService $authSvc)
    {
        // guard auth middleware
        $this->authSvc = $authSvc;    
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // $this->authSvc->logout();
        
    }
}
