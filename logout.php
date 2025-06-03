<?php

require __DIR__ . '/imports/init.php';

// header("Location: " . "https://practice.local/public/website/index.php?token=test_token01&post=123&page=5");
// header("Location: " . "/public/website/index.php?token=test_token01&post=123&page=5");

if ($user->isGuest) {
    $resp->redirect('index.php', []);
    die();
}
$user->logout();
