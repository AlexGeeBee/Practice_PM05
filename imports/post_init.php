<?php

require_once __DIR__ . '/init.php';

if (!empty($req->get()['post'])) {
    $post->findOne($req->get('post'));
}
else {
    $resp->redirect('/index.php', []);
    die();
}



?>