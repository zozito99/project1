<?php

require_once __DIR__ . '/../initialize.php';

try {
    $inputs = [
        'registration_id' => uniqid(),
        'student_name' =>  htmlentities(filter_input(INPUT_POST, 'student_name')),
        'student_grade' => filter_input(INPUT_POST, 'student_grade', FILTER_SANITIZE_NUMBER_INT),
        'classroom_id' => filter_input(INPUT_POST, 'classroom_id', FILTER_SANITIZE_NUMBER_INT),
    ];
    validateInputs($inputs);

    insertStudents($inputs);


    header('Location: /index.php');
    die;
}
catch (InvalidArgumentException $e) {
    echo $e->getMessage();
}