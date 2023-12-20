<?php

use App\Controller\AccountController;
use App\Controller\AuthenticationController;
use App\Controller\hoadonController;
use App\Controller\naptienController;
use App\Controller\TypeAccountController;
use App\Router;
use App\Controller\UserController;

// Usage:
$router = new Router();
// Add routes
$router->addRoute('/\//', [new UserController(), 'index']);
$router->addRoute('/\/user/', [new UserController(), 'index']);
$router->addRoute('/\/user\/create/', [new UserController(), 'create']);
$router->addRoute('/\/user\/signin/', [new UserController(), 'signin']);
$router->addRoute('/\/user\/register/', [new UserController(), 'register']);
$router->addRoute('/\/user\/changePassword/', [new UserController(), 'changePassword']);
$router->addRoute('/\/user\/naptien/', [new UserController(), 'naptien']);
$router->addRoute('/\/auth\/validate/', [new AuthenticationController(), 'authenticate']);
$router->addRoute('/\/auth\/naptien/', [new AuthenticationController(), 'naptien']);
$router->addRoute('/\/auth\/muaacc/', [new AuthenticationController(), 'muaacc']);
$router->addRoute('/\/user\/naptienlist/', [new naptienController(), 'naptienlistid']);
$router->addRoute('/\/user\/hoadonlist/', [new hoadonController(), 'HoaDonListId']);
$router->addRoute('/\/auth\/changePassword/', [new AuthenticationController(), 'changePassword']);
$router->addRoute('/\/user\/logout/', [new UserController(), 'logout']);
$router->addRoute('/\/user\/(\w+)/', [new AccountController(), 'acctype']);
$router->addRoute('/\/user\/acc-detail\/(\d+)/', [new AccountController(), 'accdetail']);
$router->addRoute('/\/user\/search\/(\w+)/', [new AccountController(), 'acctype']);
$router->addRoute('/\/admin\/account-list/', [new AccountController(), 'accountList']);
$router->addRoute('/\/admin\/account-create/', [new AccountController(), 'createAccount']);
$router->addRoute('/\/admin\/account-detail\/(\d+)/', [new AccountController(), 'getAccount']);
$router->addRoute('/\/admin\/account-form\/(\d+)/', [new AccountController(), 'updateAccount']);
$router->addRoute('/\/admin\/account-delete\/(\d+)/', [new AccountController(), 'deleteAccount']);
$router->addRoute('/\/admin\/type-account-list/', [new TypeAccountController(), 'typeAccountList']);
$router->addRoute('/\/admin\/type-account-create/', [new TypeAccountController(), 'createTypeAccount']);
$router->addRoute('/\/admin\/type-account-detail\/(\d+)/', [new TypeAccountController(), 'getTypeAccount']);
$router->addRoute('/\/admin\/type-account-form\/(\d+)/', [new TypeAccountController(), 'updateTypeAccount']);
$router->addRoute('/\/admin\/type-account-delete\/(\d+)/', [new TypeAccountController(), 'deleteTypeAccount']);
$router->addRoute('/\/admin\/user-list/', [new UserController(), 'getAllUsers']);
$router->addRoute('/\/admin\/create-new-user/', [new UserController(), 'createUser']);
$router->addRoute('/\/admin\/show-user\/(\d+)/', [new UserController(), 'show']);
$router->addRoute('/\/admin\/update-user-info\/(\d+)/', [new UserController(), 'update']);
$router->addRoute('/\/admin\/delete-user\/(\d+)/', [new UserController(), 'delete']);
$router->addRoute('/\/admin\/quanlynap/', [new naptienController(), 'naptienlist']);
