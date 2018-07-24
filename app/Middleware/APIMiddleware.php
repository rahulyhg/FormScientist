<?php

namespace App\Middleware;

/**
 * API Middleware
 * @author  Yifan Wu
 * @package Middleware
 */
class APIMiddleware extends Middleware
{
    /**
     * Validate the code and transfer it to the next page
     * @param $request $code
     * @param $response
     * @param $next
     * @return next page with $code
     */
    public function __invoke($request,$response,$next)
    {
        $response = $next($request,$response);
        return $response->withHeader('Access-Control-Allow-Origin', 'localhost') // set CORS URL
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');

    }

}