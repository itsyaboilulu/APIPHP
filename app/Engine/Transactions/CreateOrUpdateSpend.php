<?php
namespace App\Engine\Transactions;

use App\Model\Transactions\SpendModel;

class CreateOrUpdateSpend {

    public static function create(
        $ref, $vender, $type, $amount, $notes, $datetime = null
    ){
        $datetime = $datetime ?? date('Y-m-d H:i:s');

        return SpendModel::create([
            'spend_vender' => $vender,
            'spend_reference' => $ref,
            'spend_type' => $type,
            'spend_amount' => $amount,
            'spend_notes' => $notes,
            'spend_date' => $datetime,
            'spend_datetime' => date('Y-m-d H:i:s')
        ]);
    }
}