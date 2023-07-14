<?php

require_once __DIR__ . '/../initialize.php';

try {
    $inputs = [
        'classroom_id' => filter_input(INPUT_POST, 'classroom_id', FILTER_SANITIZE_NUMBER_INT),
        'classroom_name' => filter_input(INPUT_POST, 'classroom_name'),
    ];
    validateClassrooms($inputs);

    insertClassrooms($inputs);


    header('Location: /index.php');
    die;
} catch (InvalidArgumentException $e) {
    echo $e->getMessage();
}
