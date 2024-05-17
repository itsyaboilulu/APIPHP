<?php

namespace App\Model\Transactions;

use App\Model\BaseModel;

use App\Model\Member\UserModel;

class PaymentModel extends BaseModel {

    public $fields = [
        'payment_id',
        'payment_reference',
        'payment_type',
        'payment_amount',
        'payment_payee',
        'payment_notes',
        'payment_date',
        'payment_datetime'
    ];

    protected $table = 'payments';

    public function payee(){
        return $this->hasOne(UserModel::class, 'user_id', 'payment_payee');
    }

};