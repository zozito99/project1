<?php

require_once __DIR__ . '/connection.php';

function insertClassrooms(array $inputs)
{
    $mysqli = connect();
    $sql = <<<SQL
        INSERT INTO classrooms (
            classroom_id,
            classroom_name
        ) VALUES (
            '{$inputs['classroom_id']}',
            '{$inputs['classroom_name']}'
        )
    SQL;

    $result = $mysqli->query($sql);

    if ($result) {
        // Success message or further processing
        echo "Classroom record inserted successfully.";
    } else {
        // Error message or error handling
        echo "Failed to insert classroom record: " . $mysqli->error;
    }
}


function deleteClassroom($classroomId)
{
    if (isset($_GET['classroom_id'])) {
        $classroomId = $_GET['classroom_id'];

        $mysqli = connect();
        $sql = "DELETE FROM classrooms WHERE classroom_id = '$classroomId'";
        $mysqli->query($sql);
    }
}
function findClassrooms(): array
{
    $mysqli = connect();
    $sql = <<<SQL
        SELECT * FROM classrooms
        ORDER BY classroom_id ASC
    SQL;
    $result = $mysqli->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}
