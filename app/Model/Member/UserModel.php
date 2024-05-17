<?php

namespace App\Model\Member;

use App\Model\BaseModel;
 
class UserModel extends BaseModel {

    public $fields = [
        'user_id',
        'user_username',
        'user_password',
    ];

    protected $table = 'users';
    protected $primaryKey = 'user_id';


    public function scopeFindByUsername($scope, $username){
        return $scope->where('user_username', $username)->first();
    }
};