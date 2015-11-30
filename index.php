<?php

error_reporting(0);
//error_reporting(E_ALL);

date_default_timezone_set('Asia/Shanghai');

define('ZTNB_ROOT', __DIR__);

define('ROOT_PATH', ZTNB_ROOT);

require ZTNB_ROOT . '/inc/Logger.php';

//Logger::write($_SERVER);

//
Logger::write(array('uri' => $_SERVER['REQUEST_URI'], 'pathinfo' => $_SERVER['PATH_INFO'], 'auth' => array($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'])));

Logger::write(file_get_contents('php://input'));

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/inc/zentao/nb/Autoloader.php';
\zentao\nb\Autoloader::register();

$app = \zentao\core\Application::app(dirname(ZTNB_ROOT)); //禅道的router

$slim = new \Slim\Slim();

$routes = require __DIR__ . '/data/config/routes.php';

foreach ($routes as $method => $_routes) {
    if ($_routes) {
        foreach ($_routes as $rule => $map) {
            $slim->$method($rule, '\\zentao\\nb\\resource\\' . $map);
        }
    }
}

$slim->run();