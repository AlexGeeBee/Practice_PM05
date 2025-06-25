<?php

require __DIR__ . '/init.php';

$user_id = $req->get('user_id');

if ($user->isAdmin
&& intval($user_id)
&& $user->findOne($user_id)
&& !empty($req->get('block'))) {

    $block_status = $user->block_status($user_id);

    if ($req->get('block') == 'temp' && !empty($req->get('block_date'))) {
        $block_date = new DateTime($req->get('block_date'));
        $now = new DateTime('now');

        if ($block_date <= $now) {
            $resp->redirect('/temp-block.php', ['user_id' => $user_id, 'error' => 'Выбрана прошедшая дата']);
            die();
        }
        if (!$block_status) {
            $user->block($user_id, $block_date->format("Y-m-d H:i:s"));
        }
        else {
            $resp->redirect('/temp-block.php', ['user_id' => $user_id, 'error' => 'Пользователь уже заблокирован']);
            die();
        }
        
    }

    elseif ($req->get('block') == 'perm') {
        if ($block_status != 'permanently') {
            $user->block($user_id);
        }
        else {
            $resp->redirect('/users.php', ['user_id' => $user_id, 'error' => 'Пользователь уже заблокирован']);
            die();
        }
    }
}

$resp->redirect('/index.php', []);
die();

?>