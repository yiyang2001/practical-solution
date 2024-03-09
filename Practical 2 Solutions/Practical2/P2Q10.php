<?php
function isValidIC($ic)
{
    $pattern = '/^\d{6}-\d{2}-\d{4}$/';
    /* 
        "^" - start of the string
        "\d{6}" - exactly 6 digits
        "-" - a hyphen
        "\d{2}" - exactly 2 digits
        "-" - a hyphen
        "\d{4}" - exactly 4 digits
        "$" - end of the string
        "/..../" - delimiter
    */

    // preg_match() is used to perform a regular expression match.
    if (preg_match($pattern, $ic))
    {
        // why substr()?
        // substr() returns the portion of string specified by the start and length parameters.
        $year  = substr($ic, 0, 2);
        $month = substr($ic, 2, 2);
        $day   = substr($ic, 4, 2);
        // why checkdate()?
        // checkdate() checks the validity of the date.
        if (checkdate($month, $day, $year))
        {
            return true;
        }
    }
    return false;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>P2Q10</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    <body>
        <?php
        $s1 = 'INVALID-IC-NUM';
        $s2 = '999999-01-1234';
        $s3 = '900231-01-1234';
        $s4 = '900214-01-1234';

        echo '<pre>';
        echo $s1. ' = ' . (isValidIC($s1) ? 'Valid' : 'Invalid') . "\n";
        echo $s2. ' = ' . (isValidIC($s2) ? 'Valid' : 'Invalid') . "\n";
        echo $s3. ' = ' . (isValidIC($s3) ? 'Valid' : 'Invalid') . "\n";
        echo $s4. ' = ' . (isValidIC($s4) ? 'Valid' : 'Invalid') . "\n";
        echo '</pre>';
        ?>

        <p>
            [ <a href="index.php">Back</a> ]
        </p>
    </body>
</html>
