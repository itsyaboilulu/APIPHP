<?php

namespace App\Validation;

use App\Validation\BaseValidation;

class AuthValidation extends BaseValidation {

    public static function login($eh, $username, $password){
        $eh = parent::getErrorHelper($eh);

        foreach ([
            'username' => $username,
            'password' => $password
        ] as $key => $value){
            if (parent::isNotSet($value)){
                $ehh = parent::setGenericMessage($eh,$key);
            }
        }


        return $eh;
    }
}