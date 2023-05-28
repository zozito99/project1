<?php

$filePath = 'ind.txt';

if (!file_exists($filePath)) {
    $file = fopen($filePath, 'w');
    fclose($file);
}

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

if (isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $grade = trim($_POST['grade']);
    $classroom = trim($_POST['classroom']);
    $number = trim($_POST['number']);
    if (!empty($name) && !empty($grade) && !empty($classroom) && !empty($number)) {
        $student = [
            'name' => $name,
            'grade' => $grade,
            'classroom' => $classroom,
            'number' => $number
        ];

        $students = readList();
        $students[] = $student;
        writeList($students);
    }
}

if (isset($_POST['removeTask'])) {
    $index = $_POST['index'];
    $students = readList();
    if (isset($students[$index])) {
        unset($students[$index]);
        $students = array_values($students);
        writeList($students);
    }
}

if (isset($_POST['clearLists'])) {
    $students = [];
    writeList($students);
}

$students = readList();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Management System</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<h1>Student Management System</h1>

<h2>Add a Student</h2>
<form method="POST" action="">
    <label for="number">Registration Number:</label>
    <input type="text" id="number" name="number" placeholder><br>

    <label for="name">Name:</label>
    <input type="text" id="name" name="name" placeholder><br>

    <label for="grade">Grade:</label>
    <input type="number" id="grade" name="grade" min="0" max="10" placeholder><br>

    <label for="classroom">Classroom:</label>
    <input type="text" id="classroom" name="classroom" placeholder><br>

    <button type="submit" name="submit">Add Student</button>
    <button type="submit" name="clearLists">Clear List</button>
</form>

<br>

<h1>Your Lists</h1>
<?php if (!empty($students)): ?>
    <ol>
        <?php foreach ($students as $index => $student) : ?>
            <li>
                <span class="student-name"><?php echo $student['name']; ?></span>
                <span class="student-details">
                    Grade: <?php echo $student['grade']; ?>,
                    Classroom: <?php echo $student['classroom']; ?>,
                    Registration Number: <?php echo $student['number']; ?>
                </span>
                <form method="POST" action="">
                    <input type="hidden" name="index" value="<?php echo $index; ?>">
                    <button type="submit" name="removeTask">Delete</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ol>
<?php else: ?>
    <p>No lists found.</p>
<?php endif; ?>

</body>
</html>
