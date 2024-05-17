<?php

namespace App\Model\Dice;

use App\Model\BaseModel;
 
class DiceModel extends BaseModel {

    public $fields = [
        'dice_id',
        'dice_type',
        'dice_value',
        'dice_title',
        'dice_desc'
    ];

    protected $table = 'dice';

}