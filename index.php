<?php

error_reporting(E_ALL);

date_default_timezone_set('Asia/Shanghai');

define('ZTNB_ROOT', __DIR__);

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/inc/zentao/nb/Autoloader.php';
\zentao\nb\Autoloader::register();

$app = \zentao\core\Application::app(dirname(ZTNB_ROOT)); //禅道的router

$slim = new \Slim\Slim();

$slim->get('/users/current.:format', '\\zentao\\nb\\resource\User:fetchByKey');
$slim->get('/users.:format', '\\zentao\\nb\\resource\User:index');
$slim->get('/roles/:id.:format', '\\zentao\\nb\\resource\Role:fetch');
$slim->get('/roles.:format', '\\zentao\\nb\\resource\Role:fetchAll');
$slim->get('/issue_statues.:format', '\\zentao\\nb\\resource\IssueStatus:index');
$slim->get('/projects/:id/:projectId.:format', '\\zentao\\nb\\resource\ProjectMembership:fetchAll');
$slim->get('/projects/:id.:format', '\\zentao\\nb\\resource\Project:fetch');
$slim->get('/projects.:format', '\\zentao\\nb\\resource\Project:fetchAll');
$slim->get('/enumerations/issue_priorities.:format', '\\zentao\\nb\\resource\Enum:issue_priorities');
$slim->get('/trackers.:format', '\\zentao\\nb\\resource\Tracker:index');
$slim->get('/', '\\zentao\\nb\\resource\Main:index');
$slim->run();