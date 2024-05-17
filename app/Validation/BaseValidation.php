<?php

namespace App\Validation;

use App\Helper\ErrorHelper;

class BaseValidation {

    //error helper
    protected static function setGenericMessage($eh, $field, $type='required'){
        switch ($type) {
            case 'required':
            default:
                $name = 'required';
                $message = 'This field is required';
                break;
        }
        
        $eh->addError(
            $name, 
            $message, 
            $field
        );
        return $eh;
    }

    protected static function getErrorHelper($eh=null){
        if (!$eh){
            $eh = new ErrorHelper();
        }
        return $eh;
    }
    
    //single checks
    protected static function isNotSet($value){
        return !(isset($value) && $value);
    }

}