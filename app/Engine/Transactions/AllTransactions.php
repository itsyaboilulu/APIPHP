<?php
namespace App\Engine\Transactions;

use App\Model\Transactions\PotModel;
use App\Model\Transactions\PaymentModel;
use App\Model\Transactions\SpendModel;
use Illuminate\Database\Capsule\Manager as DB;

class AllTransactions {
    function __construct() {
        $this->params = [];
    }

    public static function totals(){
        $totals = DB::select("
            SELECT 
                sub.*, 
                (sub.debit_total - sub.spend_total) as pot_total,
                (sub.debit_total - sub.paid_total) as pending_total
            FROM (
                SELECT 
                    ( SELECT SUM(s.spend_amount) FROM spends s ) as spend_total,
                    ( SELECT SUM(d.pot_amount) FROM pot d ) as debit_total,
                    ( SELECT SUM(p.payment_amount) FROM payments p ) as paid_total
                LIMIT 1
            ) sub;
        ");

        return $totals[0];
    }

    public static function allPot() {
        $potModel = PotModel::with(['payee','reason'])->get();

        $ret = [];

        foreach ($potModel as $i){
            $_ret = (object) [
                'id' => $i->pot_id,
                'amount' => $i->pot_amount,
                'status' => $i->pot_status,
                'time' => $i->pot_datetime,
                'date' => date_format(date_create($i->pot_datetime),'Y-m-d'),
                'reason' => $i->reason->reason_name,
                'icon' => $i->reason->reason_icon,
                'note' => $i->pot_notes,
                'payee' => $i->payee->user_username,
                'payeeId' => $i->payee->user_id,
                'added' => $i->pot_created_datetime
            ];

            $ret[] = $_ret;
        }

        return $ret;
    }

    public static function allPayments(){
        $paymentModel =  PaymentModel::select()->with(['payee'])->get();

        $ret = [];

        foreach ($paymentModel as $i){
            $_ret = (object) [
                'id' => $i->payment_id,
                'type' => $i->payment_type,
                'amount' => $i->payment_amount,
                'date' => date_format(date_create($i->payment_datetime),'Y-m-d'),
                'payee' => $i->payee->user_username,
                'payeeId' => $i->payee->user_id,
                'added' => $i->payment_datetime,
                'reference' => $i->payment_reference,
                'note' => $i->payment_notes,
            ];

            $ret[] = $_ret;
        }

        return $ret;
    }

    public static function allSpends(){
        $spendModel = SpendModel::all();

        $ret = [];

        foreach ($spendModel as $i){
            $_ret = (object) [
                'id' => $i->spend_id,
                'amount' => $i->spend_amount,
                'status' => $i->spend_status,
                'time' => $i->spend_datetime,
                'date' => date_format(date_create($i->spend_date),'Y-m-d'),
                'reference' => $i->spend_reference,
                'note' => $i->spend_notes,
                'added' => $i->spend_datetime,
                'vender' => $i->spend_vender
            ];

            $ret[] = $_ret;
        }

        return $ret;
    }


    public static function get(){
    
        $ret = [];

        // return self::allPayments();

        foreach(self::allPot() as $p){
            $ret[] = (object)[
                'id' => 'd'.$p->id,
                'amount' => $p->amount,
                'date' => $p->date,
                'type' => $p->reason,
                'payee' => $p->payee,
                'payeeId' => $p->payeeId, 
                'trans' => 'Debit',
                'icon' => $p->icon,
                'data' => [
                    'added' => $p->added,
                    'reason' => $p->reason,
                    'notes' => $p->note
                ]
            ];
        }

        foreach(self::allPayments() as $p){
            $ret[] = (object)[
                'id' => 'p'.$p->id,
                'amount' => $p->amount,
                'date' => $p->date,
                'type' => $p->type,
                'trans' => 'Payment',
                'payee' => $p->payee,
                'payeeId' => $p->payeeId, 
                'icon' => 'Add',
                'data' => [
                    'added' => $p->added,
                    'reference' => $p->reference,
                    'notes' => $p->note
                ]
            ];
        }

        foreach(self::allSpends() as $p){
            $ret[] = (object)[
                'id' => 'p'.$p->id,
                'amount' => $p->amount,
                'date' => $p->date,
                'trans' => 'Spend',
                'vender' => $p->vender,
                'icon' => 'PaidIcon',
                'data' => [
                    'added' => $p->added,
                    'reference' => $p->reference,
                    'notes' => $p->note
                ]
            ];
        }
        
        usort($ret, function($a, $b) {
            return strtotime($b->date) - strtotime($a->date);
        });

        return $ret;
    }

}
