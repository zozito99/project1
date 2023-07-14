<?php
require_once __DIR__ . '/../initialize.php';

$classrooms = findClassrooms();

if (isset($_GET['classroom_id'])) {
    $classroomId = $_GET['classroom_id'];

    $mysqli = connect();
    $sql = "SELECT * FROM classrooms WHERE classroom_id = '$classroomId'";
    $result = $mysqli->query($sql);
    $classroom = $result->fetch_assoc();

    $classroom_name = $classroom['classroom_name'];
}

if (isset($_POST['classroom_id'])) {
    $classroomId = $_POST['classroom_id'];
    $classroom_name = $_POST['classroom_name'];

    $mysqli = connect();
    $sql = "UPDATE classrooms SET classroom_name = '$classroom_name' WHERE classroom_id = '$classroomId'";
    $result = $mysqli->query($sql);

    header('Location: /index.php');
    die;
}

?>
<h1>Student Management</h1>
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

    input[type="number"],
    input[type="text"] {
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

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 8px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #4CAF50;
        color: #fff;
    }

    tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    h3 {
        margin-top: 30px;
    }
</style>
<form method="post">
    <label for="clasroom_id">Classroom ID: </label>
    <input type="number" name="clasroom_id" value="<?php echo $classroomId ?>" readonly>
    <br /><br />
    <input type="hidden" name="classroom_id" value="<?php echo $classroomId ?>">
    <label for="classroom_name">Classroom Name: </label>
    <input type="text" name="classroom_name" value="<?php echo $classroom_name ?>" required>
    <br /><br />

    <button type="submit">Update</button>

    <h3>Available Classroom ID's</h3>

    <table border="1">
        <thead>
        <tr>
            <th width="150">Classroom ID</th>
            <th width="150">Classrooms</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($classrooms as $classroom) : ?>
            <tr>
                <td align="center"><?= $classroom['classroom_id'] ?></td>
                <td align="center"><?= $classroom['classroom_name'] ?></td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</form>