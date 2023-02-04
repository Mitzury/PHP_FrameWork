<?php
session_cache_expire(5);
session_start();
$_SESSION['sch'] = session_id();

ini_set('display_errors',0);
error_reporting(E_ALL);
define ('ROOT', dirname(__FILE__));

require_once(ROOT.'/core/Router.php');

$router = new Router();
$router->run();

?>
