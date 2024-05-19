<?php

namespace App\Model\Logs;

use App\Model\BaseModel;
 
class ApiRequestLogModel extends BaseModel {

    public $fields = [
        'arl_id',
        'arl_ip',
        'arl_user_id',
        'arl_url',
        'arl_params',
        'arl_datetime'	
    ];

    protected $table = 'api_request_log';
    protected $guarded = ['arl_id'];

}