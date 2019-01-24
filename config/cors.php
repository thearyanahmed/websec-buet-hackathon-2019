<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel CORS
    |--------------------------------------------------------------------------
    |
    | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
    | to accept any value.
    |
    */
   
    'supportsCredentials' => false,
    'allowedOrigins' => ['http://localhost:8000'],
    'allowedOriginsPatterns' => [],
    'allowedHeaders' => ['Content-Type', 'X-Requested-With','Authorization','Origin'],
    'allowedMethods' => ['POST','PATCH','DELETE'],
    'exposedHeaders' => ['Content-Language','Content-Type'],
    'maxAge' => 60 * 60 * 24,,

];
