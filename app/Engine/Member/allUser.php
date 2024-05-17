<?php
namespace App\Engine\Member;

use App\Model\Member\UserModel;

class allUser {

    public static function get(){
        return UserModel::all()->map(function($i){
            return [
                'id' => $i->user_id,
                'name' => $i->user_username
            ];
        });
    }
}