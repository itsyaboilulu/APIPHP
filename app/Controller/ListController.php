<?php

namespace App\Controller;

use App\Engine\Member\allUser;
use App\Engine\Lists\allReasons;
use App\Engine\Dice\diceByType;

class ListController {

    public function getUsers($request, $response){
        return $response->withJson(
            allUser::get()
        );
    }

    public function getReasons($request, $response){
        return $response->withJson(
            allReasons::get()
        );
    }

    public function getDice($request, $response){
        return $response->withJson(
            diceByType::get()
        );
    }
}