<?php

namespace App\Controller;

use  App\Validation\AuthValidation;

use App\Model\Member\UserModel;

use App\Helper\AuthHelper;

use App\Engine\Member\getUser;

class AuthController {

    public function login($request, $response){

        $postData = $request->getParams();
        $username = $postData['username'];
        $password = $postData['password'];

        // return $response->withJson(
        //     password_hash(
        //         $password, PASSWORD_BCRYPT
        //     )
        // );


        $eh = AuthValidation::login(null, $username, $password);

        if ($eh->hasErrors()){
            return $eh->getResponse($response);
        }


        //check username
        $user = (new getUser())->withPassword()->fromUsername($username);

        if (!$user || !AuthHelper::passwordCompare($user->password, $password)){
            $eh->addError('Invalid','Invalid username or password');
            return $eh->getResponse($response);
        }

        unset($user->password);

        return $response->withJson([
            'success' => true,
            'user' => $user,
            'jwt' => AuthHelper::createJWT($user)
        ]);
    }

}