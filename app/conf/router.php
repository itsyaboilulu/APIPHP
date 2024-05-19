<?php

//controllers
use App\Controller\AuthController;
use App\Controller\BankController;
use App\Controller\ListController;
use App\Controller\DiceController;

use App\Middleware\JwtMiddleware;
use App\Middleware\ApiRequestMiddleware;

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', '*')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});


$app->group('/v1', function($v1){

    $v1->get('', function ( $request, $response, $args = []){
        echo 'Welcome to v1';
    }); 

    $v1->group('/auth', function($auth){
        $auth->post('/login',  AuthController::class.':login');
    });

    $v1->group('', function($v1){

        $v1->get('/test', function ( $request, $response, $args = []){
            echo 'Welcome to v1';
        }); 

        $v1->group('/bank', function($bank){
            $bank->post('/pot', BankController::class.':addToPot');
            $bank->get('', BankController::class.':getBank');
        });

        $v1->group('/lists', function($lists){
            $lists->get('/users', ListController::class.':getUsers');
            $lists->get('/reasons', ListController::class.':getReasons');
            $lists->get('/dice', ListController::class.':getDice');
        });

        $v1->group('/dice', function($dice){
            $dice->post('/roll', DiceController::class.':setRoll');
            $dice->get('/roll', DiceController::class.':getRoll');
            $dice->post('/logMIAI', DiceController::class.':logMIAI');
            $dice->post('/logFreeParking', DiceController::class.':logFreeParking');
        });

    })
    ->add(new ApiRequestMiddleware)
    ->add(new JwtMiddleware);
});

$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function($req, $res) {
    $handler = $this->notFoundHandler; // handle using the default Slim page not found handler
    return $handler($req, $res);
});

