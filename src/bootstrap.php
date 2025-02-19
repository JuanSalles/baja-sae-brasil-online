<?php
$_ENV = getenv('ENV') ?: 'dev';
require_once(__DIR__ . "/../vendor/autoload.php");
require_once(__DIR__ . "/config." . $_ENV . ".php");

error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once(__DIR__ . "/phpbb_login.php");

$_DEV_MODE = $user->data["username"] == "Tiago" || $user->data["username"] == "jbresolin";

date_default_timezone_set('America/Sao_Paulo');