<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>P1Q7</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    <body>
        <?php
        $s1 = 'INVALID-ID';
        $s2 = '1234567890';
        $s3 = '00XXX12345';
        $s4 = '00WAD12345';

    // Chapter 2-3 PHP Working with Strings - Slide 43- 47
        $pattern1 = '/^\d{2}[A-Z]{3}\d{5}$/'; 
        /*
            "/^" - start of the string
            "\d{2}" - exactly 2 digits
            "[A-Z]{3}" - exactly 3 uppercase letters
            "\d{5}" - exactly 5 digits
            "$/" - end of the string
            "/..../" - delimiter

            common tokens:
            \d - any digit
            \w - any word character
            \s - any whitespace character
            \D - any non-digit
            \W - any non-word character
            \S - any non-whitespace character
            [abc] - exactly 1 character from the list
            [^abc] - any character except those in the list
            [a-z] - any lowercase letter
            [A-Z] - any uppercase letter
            [a-zA-Z] - any letter
            [0-9] - any digit
            [a-zA-Z] - any letter
            [a-zA-Z0-9] - any letter or digit
            a{3} - exactly 3 'a's
            * - 0 or more
            + - 1 or more
            example:
            "/^a{3}.*$/" - exactly 3 'a's followed by 0 or more of any character
            "/^a{3}.+$/" - exactly 3 'a's followed by 1 or more of any character
        */
        
        echo '<pre>';
        echo $s1. ' = ' . (preg_match($pattern1, $s1) ? 'Matched' : 'Not matched') . "\n";
        echo $s2. ' = ' . (preg_match($pattern1, $s2) ? 'Matched' : 'Not matched') . "\n";
        echo $s3. ' = ' . (preg_match($pattern1, $s3) ? 'Matched' : 'Not matched') . "\n";
        echo $s4. ' = ' . (preg_match($pattern1, $s4) ? 'Matched' : 'Not matched') . "\n";
        echo '</pre>';


        $pattern2 = '/^\d{2}[ACJPSW][ABHPT][ABCDP]\d{5}$/'; 
        /*
            "/^" - start of the string
            "\d{2}" - exactly 2 digits
            "[ACJPSW]" - exactly 1 character from the list
            "[ABHPT]" - exactly 1 character from the list
            "[ABCDP]" - exactly 1 character from the list
            "\d{5}" - exactly 5 digits
            "$/" - end of the string
            "/..../" - delimiter
        */
        

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
