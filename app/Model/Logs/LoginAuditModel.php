<?php

namespace App\Model\Logs;

use App\Model\BaseModel;
 
class LoginAuditModel extends BaseModel {

    public $fields = [
        'la_id',
        'la_ip_address',
        'la_success',
        'la_username',
        'la_with_password',
        'la_datetime'	
    ];

    protected $table = 'login_audit';
    protected $guarded = ['la_id'];

}