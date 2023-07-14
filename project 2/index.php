<?php
require_once __DIR__ . '/initialize.php';

$students = findStudents();

$classrooms = findClassrooms();

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
    <title>Student Management System</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<h1>Student Management System</h1>
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

    a {
        text-decoration: none;
    }

    .nav-links a {
        margin-right: 10px;
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    h2 {
        margin-top: 0;
    }

    form {
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 10px;
    }

    input[type="number"],
    input[type="text"],
    select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        margin-bottom: 10px;
    }

    button[type="submit"] {
        background-color: #4CAF50;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
</style>
<div>
    <a href="index.php">Create Student</a> |
    <a href="classroom.php">Create and List Classroom</a> |
    <a href="list_student.php">List student</a> |
</div>
<h2>Add a Student</h2>
<form method="POST" action="actions/create_student.php">
    <label for="registration_number">Registration Number:</label>
    <input type="number"  name="registration_id" placeholder="Enter numbers only" required><br>

    <label for="name">Name:</label>
    <input type="text"  name="student_name" placeholder="Enter name" required><br>

    <label for="grade">Grade:</label>
    <input type="number"  name="student_grade" min="0" max="10" placeholder="Enter grade" required><br>
    <label for="classroom_id">Classroom Name: </label>
    <select name="classroom_id">
        <?php foreach ($classrooms as $classroom) : ?>
            <option value="<?php echo $classroom['classroom_id'] ?>"><?php echo $classroom['classroom_name'] ?></option>
        <?php endforeach; ?>
    </select>

    <button type="submit" name="submit">Add Student</button>

</form>
</body>
</html>