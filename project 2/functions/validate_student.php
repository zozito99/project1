<?php

function validateInputs(array $inputs): bool
{

    $grade = $inputs['student_grade'];
    if (!is_numeric($grade)) {
        echo <<<HTML
                <meta http-equiv="refresh" content="2; url='/index.php'" />
                HTML;
        throw new InvalidArgumentException('Invalid format, please enter only numbers!');
    }

    if (10 < $grade || 0 > $grade) {
        echo <<<HTML
                <meta http-equiv="refresh" content="2; url='/index.php'" />
                HTML;
        throw new InvalidArgumentException('Invalid format, please enter a grade between 1 and 10');
    }
    $student_name = $inputs['student_name'];
    if (is_numeric($student_name)) {
        echo <<<HTML
            <meta http-equiv="refresh" content="2; url='/index.php'" />
            HTML;
        throw new InvalidArgumentException('Invalid format, please enter only letters!');
    }
    $classroom_id = $inputs['classroom_id'];
    if (!is_numeric($classroom_id)) {
        echo <<<HTML
                <meta http-equiv="refresh" content="2; url='/index.php'" />
                HTML;
        throw new InvalidArgumentException("Invalid format, please enter only the given ID's");
    }
    return true;
}
