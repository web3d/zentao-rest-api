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

$slim->get('/users/current.:format', '\\zentao\\nb\\resource\User:fetchByKey');
$slim->get('/users.:format', '\\zentao\\nb\\resource\User:index');
$slim->get('/roles/:id.:format', '\\zentao\\nb\\resource\Role:fetch');
$slim->get('/roles.:format', '\\zentao\\nb\\resource\Role:fetchAll');
$slim->get('/issue_statuses.:format', '\\zentao\\nb\\resource\IssueStatus:index');
$slim->get('/issues/:id.:format', '\\zentao\\nb\\resource\Issue:fetch');
$slim->get('/issues.:format', '\\zentao\\nb\\resource\Issue:fetchAll');
$slim->get('/projects/:id/memberships.:format', '\\zentao\\nb\\resource\ProjectMembership:fetchAll');
$slim->get('/projects/:id/versions.:format', '\\zentao\\nb\\resource\ProjectVersion:fetchAll');
$slim->get('/projects/:id/issue_categories.:format', '\\zentao\\nb\\resource\IssueCategory:fetchAllByProjectId');
$slim->get('/projects/:id.:format', '\\zentao\\nb\\resource\Project:fetch');
$slim->get('/projects.:format', '\\zentao\\nb\\resource\Project:fetchAll');
$slim->get('/enumerations/issue_priorities.:format', '\\zentao\\nb\\resource\Enum:issue_priorities');
$slim->get('/trackers.:format', '\\zentao\\nb\\resource\Tracker:index');
$slim->get('/queries.:format', '\\zentao\\nb\\resource\Query:index');
$slim->get('/', '\\zentao\\nb\\resource\Main:index');
$slim->run();