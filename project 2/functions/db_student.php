<?php
require_once __DIR__ . '/connection.php';

function insertStudents(array $inputs)
{
    $mysqli = connect();
    $sql = <<<SQL
        INSERT INTO students (
            registration_id,
            student_name,
            student_grade,
            classroom_id
        ) VALUES (?, ?, ?, ?)
    SQL;

    $registrationId = uniqid();

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param(
        'ssss',
        $registrationId,
        $inputs['student_name'],
        $inputs['student_grade'],
        $inputs['classroom_id']
    );
    $stmt->execute();
}

function deleteStudent($registrationId)
{
    if (isset($_GET['registration_id'])) {
        $registrationId = $_GET['registration_id'];

        $mysqli = connect();

        $sql = "DELETE FROM students WHERE registration_id = '$registrationId'";

        $mysqli->query($sql);
    }
}

function findStudents(): array
{
    $mysqli = connect();
    $sql = <<<SQL
        SELECT * FROM students
        ORDER BY classroom_id ASC
    SQL;
    $result = $mysqli->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}
