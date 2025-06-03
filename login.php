<?php require __DIR__ . '/imports/init.php' ?>
<?php if (!$user->isGuest) {
    $resp->redirect('index.php', []);
    die();
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include __DIR__ . '/imports/head.php' ?>
</head>

<body>
    <?php include __DIR__ . '/imports/content/login_content.php' ?>
    <?php include __DIR__ . '/imports/loader.php' ?>
    <?php include __DIR__ . '/imports/scripts.php' ?>
</body>

</html>