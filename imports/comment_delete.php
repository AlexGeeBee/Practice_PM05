<?php

require_once __DIR__ . '/init.php';

if (!empty($req->get('comment')) && $user->isAdmin) {
    $comment->findOne($req->get('comment'));
    $comment->delete();

    $post_id = !empty($req->get('post')) ? ['post' => $req->get('post')] : [];
    $resp->redirect('/post.php', $post_id);
}
?>