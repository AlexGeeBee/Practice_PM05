<?php

function autoload($class) {
    $filename = __DIR__ . "/classes/$class.class.php";
    if (file_exists($filename)) {
        require_once $filename;
    }
}

spl_autoload_register('autoload');

?>