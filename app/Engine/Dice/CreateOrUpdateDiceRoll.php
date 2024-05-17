<?php
namespace App\Engine\Dice;

use App\Model\Dice\DiceRollsModel;

class CreateOrUpdateDiceRoll {

    public static function create(
        $target, $member, $roll, $type, $parent=0
    ){
        return DiceRollsModel::create([
            'roll_roll' => $roll,
            'roll_type' => $type,
            'roll_member' => $member,
            'roll_target_member' => $target,
            'roll_parent_roll' => $parent,
            'roll_datetime' => date('Y-m-d H:i:s')
        ]);
    }
}