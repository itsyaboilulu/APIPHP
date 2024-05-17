<?php
namespace App\Engine\Lists;

use App\Model\Lists\ReasonsModel;

class allReasons {

    public static function get(){
        return ReasonsModel::all()->map(function($i){
            return [
                'id' => $i->reason_id,
                'name' => $i->reason_name,
                'icon' => $i->reason_icon
            ];
        });
    }
}