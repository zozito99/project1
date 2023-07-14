<?php
require_once __DIR__ . '/../initialize.php';

$students = findStudents();

$classrooms = findClassrooms();



if (isset($_GET['registration_id'])) {
    $registrationId = $_GET['registration_id'];

    $mysqli = connect();
    $sql = "SELECT * FROM students WHERE registration_id = '$registrationId'";
    $result = $mysqli->query($sql);
    $student = $result->fetch_assoc();

    $classroom_id = $student['classroom_id'];
    $student_name = $student['student_name'];
    $student_grade = $student['student_grade'];

}

if (isset($_POST['registration_id'])) {
    $registrationId = $_POST['registration_id'];
    $classroom_id = $_POST['classroom_id'];
    $student_name = $_POST['student_name'];
    $student_grade = $_POST['student_grade'];


    $mysqli = connect();
    $sql = "UPDATE students SET classroom_id = '$classroom_id', student_name = '$student_name', student_grade = '$student_grade' WHERE registration_id = '$registrationId'";
    $mysqli->query($sql);


    header('Location: /index.php');
}
?>

<h1>Student Management </h1>
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

    form {
        max-width: 500px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    label {
        display: block;
        margin-bottom: 10px;
    }

    select, input[type="text"], input[type="number"] {
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

    a {
        color: #4CAF50;
        text-decoration: none;
    }
</style>
<link rel="stylesheet" href="/../style.css">
<form method="post">
    <label for="classroom_id">Classroom Name: </label>
    <select name="classroom_id">
        <?php foreach ($classrooms as $classroom) : ?>
            <option value="<?php echo $classroom['classroom_id'] ?>"><?php echo $classroom['classroom_name'] ?></option>
        <?php endforeach; ?>
    </select>
    <br /><br />
    <label for="student_name">Student Name: </label>
    <input type="hidden" name="registration_id" value="<?php echo $registrationId ?>" required />
    <input type="text" name="student_name" value="<?php echo $student_name ?>" placeholder="Student name..." required>
    <br /><br />
    <label for="student_grade">Student Grade: </label>
    <input type="number" name="student_grade" value="<?php echo $student_grade ?>" min="1" max="10" required />
    <br /><br />

    <button type="submit">Update</button>

    <br /><br />

    <a href="../index.php">Back to Main Page</a>
</form>