<?php

namespace App\Engine\Logs;


use App\Model\Logs\ApiRequestLogModel;

class CreateOrUpdateApiRequestLog {

    public static function create(
        $ip, $url, $params, $status, $user=0
    ){
        $datetime = date('Y-m-d H:i:s');
        ApiRequestLogModel::create([
            'arl_ip'        => $ip,
            'arl_status'    => $status,
            'arl_user_id'   => $user ?? 0,
            'arl_url'       => $url,
            'arl_params'    => isset($params) ? json_encode($params) : '',
            'arl_datetime'  => $datetime
        ]);
        return;
    }

}