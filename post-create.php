<?php require __DIR__ . '/imports/init.php' ?>
<?php if ($user->isGuest || $user->isAdmin) {
    $resp->redirect('index.php', []);
    die();
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include __DIR__ . '/imports/head.php' ?>
    <?php include __DIR__ . '/imports/carousel.php' ?>
    <?php include __DIR__ . '/imports/date-timepicker.php' ?>
</head>

<body>
    <?php include __DIR__ . '/imports/content/post-create_content.php' ?>
    <?php include __DIR__ . '/imports/loader.php' ?>
    <?php include __DIR__ . '/imports/scripts.php' ?>
</body>

</html>