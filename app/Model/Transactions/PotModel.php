<?php

namespace App\Model\Transactions;

use App\Model\BaseModel;

use App\Model\Member\UserModel;
use App\Model\Lists\ReasonsModel;
 
class PotModel extends BaseModel {

    public $fields = [
        'pot_id',
        'pot_amount',
        'pot_status',
        'pot_created_by',
        'pot_created_for',
        'pot_created_datetime',
        'pot_datetime',
        'pot_reason_id',
        'pot_notes'
    ];

    protected $table = 'pot';
    protected $guarded = ['pot_id'];

    public function payee(){
        return $this->hasOne(UserModel::class, 'user_id', 'pot_created_for');
    }

    public function reason(){
        return $this->hasOne(ReasonsModel::class, 'reason_id', 'pot_reason_id');
    }
    
};