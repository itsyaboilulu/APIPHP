<?php

namespace App\Controller;

use  App\Validation\AuthValidation;

use App\Model\Member\UserModel;

use App\Helper\AuthHelper;

use App\Engine\Transactions\AllTransactions;
use App\Engine\Transactions\CreateOrUpdatePot;

class BankController {

    public function getBank($request, $response){
        return $response->withJson(
            AllTransactions::get()
        );
    }

    public function addToPot($request, $response){
        $user = $request->getAttribute('userLoggedIn');

        $postData = $request->getParams();
        $pot = $postData['pot'];
        $payee = $postData['payee'];
        $reason = $postData['reason'];
        $notes = $postData['notes'];

        return $response->withJson([
            'success' => CreateOrUpdatePot::create(
                $pot, 'Debit', $user->id ?? $user->i, $payee, $reason, $notes
            )
        ]);
    }


}