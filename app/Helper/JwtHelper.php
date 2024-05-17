<?php

namespace App\Helper;

use ReallySimpleJWT\Token;
use Carbon\Carbon;


use App\constants;

class JwtHelper {


    public static function  createJWT($payload){
        require __DIR__ . '/../conf/constants.php';
        return Token::customPayload(array_merge(
            $payload,
            ['expire' => time() + ($constants['jwt']['expire'])]
        ), $constants['jwt']['secret']);
    }

    public static function validateJWT($token){
        if (!$token){return false;   }
        try {
            require __DIR__ . '/../conf/constants.php';
            return Token::validate($token, $constants['jwt']['secret']);  
        } catch (Exception $e) {
            return false;
        }
    }

    public static function readJwt($token){
        return Token::getPayload($token);
    }
}