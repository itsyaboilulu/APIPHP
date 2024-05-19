<?php
namespace App\Middleware;

use App\Engine\Logs\CreateOrUpdateApiRequestLog;

class ApiRequestMiddleware {

    public function __invoke($request, $response, $next)

    {
        $user = $request->getAttribute('userLoggedIn');
        $response = $next($request, $response);

        CreateOrUpdateApiRequestLog::create(
            $request->getServerParam('REMOTE_ADDR'), 
            $request->getUri(), 
            $request->getParams(), 
            $response->getStatusCode(),
            isset($user) ? ($user->id || $user->i) : 0
        );

        return $response;
    }


}