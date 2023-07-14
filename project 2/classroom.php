<?php
require_once __DIR__ . '/initialize.php';


$classrooms = findClassrooms();


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

    .header {
        margin-top: 30px;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table th,
    .table td {
        padding: 8px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }

    .table th {
        background-color: #f2f2f2;
    }

    .table td a {
        color: #0066cc;
        text-decoration: none;
    }

    .table td a:hover {
        text-decoration: underline;
    }
</style>

<div>
    <a href="index.php">Create and List Student</a> |
    <a href="classroom.php">Create and List Classroom</a> |

</div>
<h2>Add classroom</h2>

<form method="post" action="actions/create_classroom.php">

    <label for="classroom_id">Classroom ID: </label>
    <input type="number" name="classroom_id" min="1" placeholder="ID..." required>
    <br /><br />

    <label for="classrooms">Classroom Name: </label>
    <input type="text" name="classroom_name" placeholder="Classroom..." required>
    <br /><br />

    <button type="submit">Submit</button>

    <h3 class="header">Listed Classrooms</h3>
    <table class="table" border="1">
        <thead>
        <tr>
            <th width="150">Classroom ID</th>
            <th width="150">Classrooms</th>
            <th width="150">Update</th>
            <th width="150">Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($classrooms as $classroom) : ?>
            <tr>
                <td align="center"><?= $classroom['classroom_id'] ?></td>
                <td align="center"><?= $classroom['classroom_name'] ?></td>
                <td align="center"><a href="actions/update_classroom.php?classroom_id=<?= $classroom['classroom_id'] ?>">Update</a>
                <td align="center"><a href="actions/delete_classroom.php?classroom_id=<?= $classroom['classroom_id'] ?>">Delete</a>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</form>
</body>
</html>


