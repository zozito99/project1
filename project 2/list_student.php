<?php
require_once __DIR__ . '/initialize.php';

$students = findStudents();

$sql = <<<SQL
    SELECT * FROM students JOIN classrooms ON students.classroom_id=classrooms.classroom_id ORDER BY classrooms.classroom_id ASC
SQL;

$mysqli = connect();
$result = $mysqli->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Student List</title>

</head>
<body>
<h1>Student List</h1>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f1f1f1;
        margin: 0;
        padding: 20px;
    }

    h1 {
        text-align: center;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }

    .update-link,
    .delete-link {
        color: #0066cc;
        text-decoration: none;
        margin-right: 10px;
    }

    .update-link:hover,
    .delete-link:hover {
        text-decoration: underline;
    }
</style>
<table>
    <thead>
    <tr>
        <th>Registration Number</th>
        <th>Name</th>
        <th>Grade</th>
        <th>Classroom ID</th>
        <th>Action</th>
    </tr>
    </thead>
    <table border="1">
        <thead>
        <tr>
            <th width="150">Classroom Name</th>
            <th width="150">Name</th>
            <th width="150">Grade</th>
            <th width="150">Update</th>
            <th width="150">Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($rows as $row) : ?>
            <tr>
                <td align="center"><?= $row['classroom_name'] ?></td>
                <td align="center"><?= $row['student_name'] ?></td>
                <td align="center"><?= $row['student_grade'] ?></td>
                <td align="center"><a href="actions/update_student.php?registration_id=<?= $row['registration_id'] ?>">Update</td>
                <td align="center"><a href="actions/delete_student.php?registration_id=<?= $row['registration_id'] ?>">Delete</a>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</body>
</html>
