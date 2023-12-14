<?php

use App\Controller\AccountController;
use App\Controller\AuthenticationController;
use App\Router;
use App\Controller\UserController;

// Usage:
$router = new Router();
// Add routes
$router->addRoute('/\//', [new UserController(), 'index']);
// $router->addRoute('/\/user/', [new UserController(), 'userList']);
// $router->addRoute('/\/user\/index/', [new UserController(), 'userList']);
// //$router->addRoute('/\/user/', [new UserController(), 'index']);
// $router->addRoute('/\/user\/show\/(\d+)/', [new UserController(), 'show']);
$router->addRoute('/\/user\/create/', [new UserController(), 'create']);
// $router->addRoute('/\/user\/update\/(\d+)/', [new UserController(), 'update']);
// $router->addRoute('/\/user\/delete\/(\d+)/', [new UserController(), 'delete']);
$router->addRoute('/\/user\/signin/', [new UserController(), 'signin']);
$router->addRoute('/\/user\/register/', [new UserController(), 'register']);
$router->addRoute('/\/user\/changePassword/', [new UserController(), 'changePassword']);
$router->addRoute('/\/auth\/validate/', [new AuthenticationController(), 'authenticate']);
$router->addRoute('/\/auth\/changePassword/', [new AuthenticationController(), 'changePassword']);
$router->addRoute('/\/user\/logout/', [new UserController(), 'logout']);
$router->addRoute('/\/admin\/account-list/', [new AccountController(), 'accountList']);
$router->addRoute('/\/admin\/account-create/', [new AccountController(), 'createAccount']);
$router->addRoute('/\/admin\/account-detail\/(\d+)/', [new AccountController(), 'getAccount']);
$router->addRoute('/\/admin\/account-form\/(\d+)/', [new AccountController(), 'updateAccount']);
$router->addRoute('/\/admin\/account-delete\/(\d+)/', [new AccountController(), 'deleteAccount']);
