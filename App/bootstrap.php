<?php

use Core\App;
use Core\Container;
use Models\Database;
use Models\User;


$container = new Container();


$container->bind('Models\Database', function () {
    $config = require base_path('config.php');


    return new Database($config);
});

App::setContainer($container);