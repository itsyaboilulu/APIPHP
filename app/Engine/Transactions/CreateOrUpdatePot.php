<?php
namespace App\Engine\Transactions;

use App\Model\Transactions\PotModel;

class CreateOrUpdatePot {

    public static function create(
        $amount, $status, $by, $for, $reason, $notes, $datetime = null
    ){
        $datetime = $datetime ?? date('Y-m-d H:i:s');

        return PotModel::create([
            'pot_status' => $status,
            'pot_amount' => $amount,
            'pot_created_by' => $by,
            'pot_created_for' => $for,
            'pot_created_datetime' => date('Y-m-d H:i:s'),
            'pot_datetime' =>  $datetime,
            'pot_reason_id' => $reason,
            'pot_notes' => $notes
        ]);
    }
}