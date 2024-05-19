<?php

namespace App\Engine\Logs;


use App\Model\Logs\LoginAuditModel;

class CreateOrUpdateLoginAudit {

    public static function create(
        $ip, $success, $username, $withPassword
    ){
        $datetime = date('Y-m-d H:i:s');
        LoginAuditModel::create([
            'la_ip_address',
            'la_success',
            'la_username',
            'la_with_password',
            'la_datetime'           => $datetime	
        ]);
        return;
    }

}