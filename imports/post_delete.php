<?php

require_once __DIR__ . '/init.php';
require_once __DIR__ . '/post_init.php';

if ((!$user->isGuest && $post->user_id === $user->user_id && $post->comments_count == 0) || $user->isAdmin) {
    if ($post->delete()) {
        $resp->redirect('/posts.php', []);
    }
}
else {
    $resp->redirect('/post.php', ['post' => $post->post_id]);
}



?>