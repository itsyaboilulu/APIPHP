<?php
namespace App\Engine\Dice;

use App\Model\Dice\DiceModel;

class diceByType {

    public static function get(){
        $ret = [];

        foreach ( DiceModel::all() as $i){
            if (!isset($ret[$i->dice_type])){
                $ret[$i->dice_type] = [];
            }
            $ret[$i->dice_type][] = [
                'id' => $i->dice_id,
                'value' => $i->dice_value,
                'title' => $i->dice_title,
                'desc' => $i->dice_desc
            ];
        }

        return $ret;
    }
}