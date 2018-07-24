<?php
use App\Middleware\GuestMiddleware;
use App\Middleware\AuthMiddleware;
use App\Middleware\APIMiddleware;

$app->get('/', 'HomeController:index')->setName('home');

$app->group('', function () {
	$this->get('/auth/signup', 'AuthController:getSignUp')->setName('auth.signup');
	$this->post('/auth/signup', 'AuthController:postSignUp');
	$this->get('/auth/signin', 'AuthController:getSignIn')->setName('auth.signin');
	$this->post('/auth/signin', 'AuthController:postSignIn');


})->add(new GuestMiddleware($container));

//API
$app->group('', function () {
    $this->get('/api/v1/send','ReceiverAPIController:getFormDetail');
})->add(new APIMiddleware($container));


$app->group('', function () {
    $this->get('/auth/signout', 'AuthController:getSignOut')->setName('auth.signout');
	$this->get('/auth/password/change', 'PasswordController:getChangePassword')->setName('auth.password.change');
	$this->post('/auth/password/change', 'PasswordController:postChangePassword');

    $this->get('/admin', 'AdminController:index')->setName('admin.dashboard');

    $this->get('/admin/items', 'AdminController:items')->setName('admin.items');
    $this->get('/admin/items/add', 'AdminController:addItem')->setName('admin.addItem');
    $this->get('/admin/items/one', 'AdminController:itemPage')->setName('admin.itemPage');


    //Admin item API
    $this->get('/api/v1/admin/item/list','AdminAPIController:getItemList');
    $this->get('/api/v1/admin/item/add','AdminAPIController:postAddItem');
    $this->get('/api/v1/admin/item/update','AdminAPIController:postUpdateItem');
    $this->get('/api/v1/admin/item/del','AdminAPIController:postDelItem');

    //Admin text API
    $this->get('/api/v1/admin/text/list','AdminAPIController:getItemDetail');
    $this->get('/api/v1/admin/text/add','AdminAPIController:postAddText');
    $this->get('/api/v1/admin/text/update','AdminAPIController:postUpdateText');
    $this->get('/api/v1/admin/text/del','AdminAPIController:postDelText');


    $this->get('/api/v1/admin/result/list','AdminAPIController:getResultList');


})->add(new AuthMiddleware($container));



