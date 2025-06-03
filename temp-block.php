<?php require __DIR__ . '/imports/init.php' ?>
<?php if (!$user->isAdmin) {
    $resp->redirect('index.php', []);
    die();
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include __DIR__ . '/imports/head.php' ?>
    <?php include __DIR__ . '/imports/daterangepicker.php' ?>
</head>

<body>
    <?php include __DIR__ . '/imports/content/temp-block_content.php' ?>
    <?php include __DIR__ . '/imports/loader.php' ?>
    <?php include __DIR__ . '/imports/scripts.php' ?>
    <?php include __DIR__ . '/imports/datepicker_script.php' ?>
</body>

</html>