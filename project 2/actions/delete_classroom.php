<?php

require_once __DIR__ . '/../initialize.php';



try {
    $classroomId = 'classroom_id';

    deleteClassroom($classroomId);

    header("Location: /index.php");
    die;
} catch (mysqli_sql_exception $exception) {
    echo <<<HTML
    <meta http-equiv="refresh" content="2; url='/index.php'" />
    HTML;
    echo 'Warning! Cannot delete a classroom that has students.';
}
