<?php

namespace App\Model\Dice;

use App\Model\BaseModel;

use App\Model\Member\UserModel;
 
class ReasonsModel extends BaseModel {

    public $fields = [
        'roll_id',
        'roll_roll',
        'roll_type',
        'roll_member',
        'roll_target_member',
        'roll_parent_roll',
        'roll_datetime',
    ];

    protected $table = 'dice_rolls';

    public function member(){
        return $this->hasOne(UserModel::class, 'user_id', 'roll_member');
    }

    public function targetMember(){
        return $this->hasOne(UserModel::class, 'user_id', 'roll_target_member');
    }

}