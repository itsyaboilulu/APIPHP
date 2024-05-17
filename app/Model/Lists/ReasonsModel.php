<?php

namespace App\Model\Lists;

use App\Model\BaseModel;
 
class ReasonsModel extends BaseModel {

    public $fields = [
        'reason_id',
        'reason_name',
        'reason_icon',
    ];

    protected $table = 'reasons';

}