<?php

namespace App\Exceptions;

use Exception;

class Error extends Exception
{
    protected $exception;
    
    protected $showError;

    public function __construct(Exception $exception,bool $showError = true)
    {
        $this->exception = $exception;    
    	$this->showError = $showError;
    }

    public function render()
    {	
    	//change get message 
        $message = [
            'type'    => 'error',
            'message' => $showError ? $this->exception->getMessage() : 'Sorry something went wrong!'
        ];
        return redirect()->back()->with($message);
    }
}
