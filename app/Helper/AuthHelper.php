<?php

namespace App\Helper;

use App\Helper\JwtHelper;

use App\constants;

class AuthHelper {

    public static function passwordCompare($hash, $raw){
        return password_verify($raw,$hash);
    }    

    public static function  createJWT($user){
        
        return JwtHelper::createJWT([
            'user' => [
                'id' => $user->id,
                'name' => $user->name
            ],  
        ]);
    }
}