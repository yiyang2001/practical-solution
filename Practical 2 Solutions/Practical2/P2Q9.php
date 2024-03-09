<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>P2Q9</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    <body>
        <?php
        $s1 = 'INVALID-IC-NUM';
        $s2 = '12345678901234';
        $s3 = '123456-01-1234';
        $s4 = '900214-01-1234';

        $pattern1 = '/^\d{6}-\d{2}-\d{4}$/'; 
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

        $pattern2 = '/^\d{2}(0[1-9]|1[0-2])(0[1-9]|[12][0-9]|3[01])-\d{2}-\d{4}$/'; 
        /* 
            "^" - start of the string
            "\d{2}" - exactly 2 digits
            "(0[1-9]|1[0-2])" - either 01-09 or 10-12
            "(0[1-9]|[12][0-9]|3[01])" - either 01-09, 10-29 or 30-31
            "-" - a hyphen
            "\d{2}" - exactly 2 digits
            "-" - a hyphen
            "\d{4}" - exactly 4 digits
            "$" - end of the string
            "/..../" - delimiter
        */

        echo '<pre>';
        echo $s1. ' = ' . (preg_match($pattern1, $s1) ? 'Matched' : 'Not matched') . "\n";
        echo $s2. ' = ' . (preg_match($pattern1, $s2) ? 'Matched' : 'Not matched') . "\n";
        echo $s3. ' = ' . (preg_match($pattern1, $s3) ? 'Matched' : 'Not matched') . "\n";
        echo $s4. ' = ' . (preg_match($pattern1, $s4) ? 'Matched' : 'Not matched') . "\n";
        echo '</pre>';

        echo '<pre>';
        echo $s1. ' = ' . (preg_match($pattern2, $s1) ? 'Matched' : 'Not matched') . "\n";
        echo $s2. ' = ' . (preg_match($pattern2, $s2) ? 'Matched' : 'Not matched') . "\n";
        echo $s3. ' = ' . (preg_match($pattern2, $s3) ? 'Matched' : 'Not matched') . "\n";
        echo $s4. ' = ' . (preg_match($pattern2, $s4) ? 'Matched' : 'Not matched') . "\n";
        echo '</pre>';
        ?>

        <p>
            [ <a href="index.php">Back</a> ]
        </p>
    </body>
</html>
