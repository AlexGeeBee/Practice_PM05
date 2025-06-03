<?php

require_once __DIR__ . '/autoloader.php';
require_once __DIR__ . '/config.php';

$req = new Request();
$mysql = new MySql($db_params);
$user = new User($req, $mysql);
$resp = new Response($user);
$menu = new Menu($menu_items, $resp);
$post = new Post($user);

$comment = new Comment($post);

?>