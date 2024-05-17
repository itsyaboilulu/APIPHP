<?php
namespace App\Engine\Member;

use App\Model\Member\UserModel;

class getUser {
    function __construct() {
        $this->model = UserModel::select();
        $this->params = [];
    }

    public function fromUsername($username){
        $data = $this->model->findByUsername($username);

        return $this->refecter($data);
    }

    public function find($id){
        $data = $this->model->find($id);
        return $this->refecter($data);
    }

    //params
    public function withPassword(){
        $this->params['withPassword'] = true;
        return $this;
    }

    //private
    private function refecter($data){
        if (!$data) return false;

        $ret = [
            'id' => $data->user_id,
            'name' => $data->user_username
        ];

        if (isset($this->params['withPassword']) && $this->params['withPassword']){
            $ret['password'] = $data->user_password;
        }

        return (object) $ret;
    }
}