<?php

namespace App\Exceptions;

use Exception;

class Error extends Exception
{
    protected $exception;
    
    protected $showError;

    protected $message ;

    protected $statusCode;
    public function __construct(Exception $exception = null,bool $showError = true,$message = null,$statusCode = 422)
    {
        $this->exception = $exception;    
    	$this->showError = $showError;
        $this->message = $message;
        $this->statusCode = $statusCode;
    }

    public function render()
    {	
    	//change get message 
       
       $errorData['status'] = 'error';
       
       if(!$showError) {
            if(empty($this->message)) {
                $this->message = 'Sorry something went wrong'
            }
       } else {
            if($this->exception instanceof \Exception) {
                $this->message = $this->exception->getMessage();
            } else {
                $this->message = 'Sorry something went wrong';
            }
        }
        $errorData['message'] = $this->message;

       return response()->json($errorData,$this->statusCode);
    }
}
