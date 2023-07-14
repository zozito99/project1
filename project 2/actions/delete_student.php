<?php

require_once __DIR__ . '/../initialize.php';



try {
    $registrationId = uniqid();

    deleteStudent($registrationId);

    header("Location: /index.php");
    die;
} catch (InvalidArgumentException $exception) {
    echo $exception->getMessage();
}
