<?php

namespace App\Controller;

use App\Engine\Dice\CreateOrUpdateDiceRoll;
use App\Engine\Dice\AllRolls;
use App\Engine\Transactions\CreateOrUpdatePot;
use App\Engine\Transactions\CreateOrUpdateSpend;
use App\Engine\Transactions\AllTransactions;
use App\Engine\Member\getUser;

class DiceController {

    public function setRoll($request, $response){
        $user = $request->getAttribute('userLoggedIn');

        $postData = $request->getParams();
        $target = $postData['target'] ?? ($user->id ?? $user->i);
        $roll = $postData['roll'] ?? 6;
        $type = $postData['type'] ?? 'Shame';
        $parent = $postData['parent'] ?? 0;

        $log = CreateOrUpdateDiceRoll::create($target, ($user->id ?? $user->i), $roll, $type, $parent);

        return $response->withJson(['success' => $log->id]);
    }

    public function getRoll($request, $response){
        return $response->withJson(AllRolls::get());
    }

    public function logMIAI($request, $response){
        //log money isnt an issue, (DOS: 2)
        $user = $request->getAttribute('userLoggedIn');

        $postData = $request->getParams();
        $target = $postData['target'] ?? ($user->id ?? $user->i);

        return $response->withJson([
            'success' => CreateOrUpdatePot::create(
                20, 'Debit', $user->id ?? $user->i, $target, 1, 'Rolled a 2 on dice of shame'
            )
        ]);
    }

    public function logFreeParking($request, $response){
        //log free parking, (KennyLoggins: 2)
        $user = $request->getAttribute('userLoggedIn');

        $postData = $request->getParams();
        $target = $postData['target'] ?? ($user->id ?? $user->i);
        $amount =  AllTransactions::totals()->pot_total;

        $target = (new getUser())->find($target);

        if ($amount){
            CreateOrUpdateSpend::create(
                "KL".time(), "Internal - ".$target->name, 'Bank', $amount, $target->name . ' rolled a 2 on the kenny loggins dice and chose to withdraw'
            );
        }

        return $response->withJson([
            'success' => $amount
        ]);
    }

}