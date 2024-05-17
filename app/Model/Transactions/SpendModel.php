<?php

namespace App\Model\Transactions;

use App\Model\BaseModel;

use App\Model\Member\UserModel;
use App\Model\Lists\ReasonsModel;
 
class SpendModel extends BaseModel {

    public $fields = [
        'spend_id',
        'spend_reference',
        'spend_vender',
        'spend_type',
        'spend_amount',
        'spend_notes',
        'spend_date',
        'spend_datetime'
    ];

    protected $table = 'spends';
    protected $primaryKey = 'spends_id';

};