<?php

use App\Routes\RouteManager;
use BK_Framework\Router\Router;
use BK_Framework\SuperGlobal\Server;


require_once("vendor/autoload.php");

// phpinfo();

//$answer = class_exists('PDO');
//echo $answer;
////
//$dns = "mysql:host=127.0.0.1;dbname=ask_mate_again";
//$user ="root";
//$password = "18421994";
//$pdo = new PDO($dns, $user, $password);
//$status = $pdo->getAttribute(PDO::ATTR_CONNECTION_STATUS);
//echo $status;

RouteManager::init();
$path = Server::getPath();
$method = Server::getMethod();
Router::execute($path, $method);
