<?php
function getGrade($mark)
{
    if      ($mark >= 80) return 'A';
    else if ($mark >= 70) return 'B';
    else if ($mark >= 60) return 'C';
    else if ($mark >= 50) return 'D';
    else                  return 'F';
}
// Chapter 2-5 PHP Functions: Slide 3 - 4
// Chapter 2-2 PHP Decision and Loops: Slide 3 - 6
function getComment($grade)
{
    switch ($grade)
    {
        case 'A':
            return 'Passed with distinction';
            break;
        case 'B':
        case 'C':
            return 'Passed';
            break;
        case 'D':
            return 'Passed with condition';
            break;
        default:
            return 'Failed';
            break;
    }
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>P1Q5</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    <body>
        <table border="1">
            <tr>
                <th>Name</th>
                <th>Mark</th>
                <th>Grade</th>
                <th>Comment</th>
            </tr>
            <?php
            $marks = array(
                "Alex" => 90,
                "Barbie" => 65,
                "Christine" => 45,
                "Danny" => 55,
                "Elaine" => 75,
            );

            foreach ($marks as $key => $value)
            {
                $grade = getGrade($value);
                $comment = getComment($grade);

                echo "
                    <tr>
                    <td>$key</td>
                    <td>$value</td>
                    <td>$grade</td>
                    <td>$comment</td>
                    </tr>";
            }
            
            // Chapter 2-4 PHP Arrays: Slide 4 - 16
            /*
                Notes:
                * 1. The foreach loop is used to iterate through the $marks array.
                * 2. The $key is the student's name and the $value is the mark.
                * 3. The getGrade() function is used to get the grade based on the mark.
                * 4. The getComment() function is used to get the comment based on the grade.
            */
            ?>
            
        </table>

        <p>
            [ <a href="index.php">Back</a> ]
        </p>
    </body>
</html>
