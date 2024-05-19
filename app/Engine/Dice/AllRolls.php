<?php
namespace App\Engine\Dice;

use App\Model\Dice\DiceRollsModel;

class AllRolls {

    public static function get(
    ){

        $rolls = DiceRollsModel::select()
            ->with([
                'member', 'targetMember'
            ])
            ->orderBy('roll_id', 'desc')
            ->get();

        $ret = [];
        $children = [];

        foreach ($rolls as $i) {
            if ($i->roll_parent_roll){
                $children[$i->roll_parent_roll] = $i->roll_id;
            }
            $ret[$i->roll_id] = [
                'id' => $i->roll_id,
                'roll' => $i->roll_roll,
                'type' => $i->roll_type,
                'time' => $i->roll_datetime,
                'parent' => $i->roll_parent_roll,
                'member' => [
                    'id' => $i->targetMember->user_id,
                    'name' => $i->targetMember->user_username
                ],
                'roller' => [
                    'id' => $i->member->user_id,
                    'name' => $i->member->user_username
                ],
                'child' => isset($children[$i->roll_id]) ? $ret[$children[$i->roll_id]] : null
            ];
            if (isset($children[$i->roll_id])){
                unset($ret[$children[$i->roll_id]]);
            }
        }

        return array_values($ret);
    }
}