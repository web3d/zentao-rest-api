<?php

error_reporting(E_ALL);

date_default_timezone_set('Asia/Shanghai');

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/inc/zentao/nb/Autoloader.php';
\zentao\nb\Autoloader::register();

$app = new \Slim\Slim();

$app->get('/issue_statues.:format', '\\zentao\\nb\\resource\IssueStatus:index');
$app->get('/', '\\zentao\\nb\\resource\Main:index');
$app->run();