<?php
namespace App\Middleware;

use App\Helper\JwtHelper;

class JwtMiddleware {

    public function __invoke($request, $response, $next)
    {
        $headers = $request->getHeaders();

        if (!isset($headers['HTTP_AUTHTOKEN']) || !JwtHelper::validateJWT($headers['HTTP_AUTHTOKEN'][0])){
            return $response->withStatus(401);
        };

        $request = $request->withAttribute(
            'userLoggedIn',(object) JwtHelper::readJwt($headers['HTTP_AUTHTOKEN'][0])['user']
        );

        $response = $next($request, $response);

        return $response;
    }


}