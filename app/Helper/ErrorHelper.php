<?php

namespace App\Helper;

class ErrorHelper {
    function __construct() {
        $this->errors = [];
    }

    public function addError($name, $message, $element = null){
        $this->errors[] = [
            'name'=>$name,
            'message'=>$message,
            'element'=>$element
        ];
    }

    public function hasErrors(){
        return count($this->errors)>0;
    }
    
    public function getResponse($response){
        return $response->withJson(
            ['errors'=>$this->errors]
        );
    }

}