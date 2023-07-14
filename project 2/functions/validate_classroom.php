<?php
function validateClassrooms(array $inputs): bool
{
    $classroomId = $inputs['classroom_id'];
    if (!is_numeric($classroomId)) {
        echo <<<HTML
                <meta http-equiv="refresh" content="2; url='/classrooms.php'" />
                HTML;
        throw new InvalidArgumentException('Invalid format, please enter only numbers!');
    }
    if (0 > $classroomId) {
        echo <<<HTML
        <meta http-equiv="refresh" content="2; url='/classrooms.php'" />
        HTML;
        throw new InvalidArgumentException('Invalid format, please enter a valid ID between');
    }
    if (isset($_POST['classroom_id'])) {
        $mysqli = connect();
        $checkId = mysqli_query($mysqli, "SELECT classroom_id FROM classrooms WHERE classroom_id = '$classroomId'");

        if (mysqli_num_rows($checkId) > 0) {
            echo <<<HTML
        <meta http-equiv="refresh" content="2; url='/classrooms.php'" />
        HTML;
            throw new InvalidArgumentException("Duplicate ID's are NOT allowed!");
        }
    }
    $classroomName = $inputs['classroom_name'];
    if (isset($_POST['classroom_name'])) {
        $mysqli = connect();
        $checkName = mysqli_query($mysqli, "SELECT classroom_name FROM classrooms WHERE classroom_name = '$classroomName'");

        if (mysqli_num_rows($checkName) > 0) {
            echo <<<HTML
        <meta http-equiv="refresh" content="2; url='/classrooms.php'" />
        HTML;
            throw new InvalidArgumentException("Duplicate Classroom Name's are NOT allowed!");
        }
    }
    return true;
}
