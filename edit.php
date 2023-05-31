<?php
$filePath = 'ind.txt';

function readList()
{
    global $filePath;
    $students = [];
    $file = fopen($filePath, 'r');
    while (($line = fgets($file)) !== false) {
        $students[] = json_decode(trim($line), true);
    }
    fclose($file);
    return $students;
}

function writeList($students)
{
    global $filePath;
    $file = fopen($filePath, 'w');
    foreach ($students as $student) {
        fwrite($file, json_encode($student) . PHP_EOL);
    }
    fclose($file);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['edit'])) {
        $index = $_POST['index'];
        $name = trim($_POST['name']);
        $grade = trim($_POST['grade']);
        $classroom = trim($_POST['classroom']);

        if (!empty($name) && !empty($grade) && !empty($classroom)) {
            $students = readList();
            if (isset($students[$index])) {
                $students[$index]['name'] = $name;
                $students[$index]['grade'] = $grade;
                $students[$index]['classroom'] = $classroom;
                writeList($students);
                header('Location: index.php');
                exit();
            }
        }
    }
}

if (isset($_GET['index'])) {
    $index = $_GET['index'];
    $students = readList();
    if (isset($students[$index])) {
        $student = $students[$index];
    } else {
        header('Location: index.php');
        exit();
    }
} else {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Student</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

<h1>Edit Student</h1>
<form method="POST" action="edit.php">
    <input type="hidden" name="index" value="<?php echo $index; ?>">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php echo $student['name']; ?>"><br>

    <label for="grade">Grade:</label>
    <input type="number" id="grade" name="grade" min="0" max="10" value="<?php echo $student['grade']; ?>"><br>

    <label for="classroom">Classroom:</label>
    <input type="text" id="classroom" name="classroom" value="<?php echo $student['classroom']; ?>"><br>

    <button type="submit" name="edit">Save Changes</button>
</form>

</body>

</html>
