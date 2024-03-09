<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=8" />
        <title>Kinder Math Result</title>
        <link type="text/css" href="css/style.css" rel="Stylesheet" />
    </head>
    <body style="font-size: 1.2em">
        <h1>Your Result</h1>
        <?php
        // https://www.w3schools.com/php/func_var_isset.asp
        // https://www.w3schools.com/Php/php_superglobals_post.asp
        if (isset($_POST['submit'])) // POST with submit button pressed.
        {
            // https://stackoverflow.com/questions/4688880/html-element-array-name-something-or-name-something
            $ans   = $_POST['ans'];   // Array of answers.
            $nums1 = $_POST['nums1']; // Array of first numbers.
            $nums2 = $_POST['nums2']; // Array of second numbers.
            $count = 0; // No. of correct.
            
            
            echo '<table cellspacing="0" cellpadding="10">';
            for ($i = 0; $i < count($ans); $i++)
            {
                $an = $ans  [$i]; // Get individual answer.
                $n1 = $nums1[$i]; // Get individual first number.
                $n2 = $nums2[$i]; // Get individual second number.

                if ((int)$n1 + (int)$n2 == (int)$an) // If answer correct.
                {
                    $class = 'correct';
                    $image = 'images/correct-big.png';
                    $remark = 'Correct!';
                    $count++;
                }
                else // If answer wrong.
                {
                    $class = 'wrong';
                    $image = 'images/wrong-big.png';
                    $remark = 'It should be <strong>' . ((int)$n1 + (int)$n2) . '</strong>.';
                }

                printf('
                    <tr class="%s">
                        <td>Q%d.</td>
                        <td>%d + %d = %s</td>
                        <td><img src="%s" alt="" /></td>
                        <td>%s</td>
                    </tr>
                    <tr><td colspan="4"></td></tr>',
                    $class, $i + 1,
                    $n1, $n2, $an,
                    $image, $remark);
                // NOTE:
                // -----
                // Use %s for $an so that empty string
                // won't be displayed as 0 (zero).
            }
            echo '</table>';

            printf('
                You get <strong>%d</strong> correct out of %d questions.
                <a href="./kinder-math-ques.php">Try again</a>.',
                $count, count($ans));
        }
        else // GET or hacks.
        {
            echo '
                <p>
                <strong>OOPS...</strong>
                You should
                <a href="./kinder-math-ques.php">answer the questions</a>
                first.
                </p>
                ';
        }
        ?>
    </body>
</html>
