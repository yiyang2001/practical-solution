<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=8" />
    <title>Kinder Math Question</title>
    <link type="text/css" href="css/style.css" rel="Stylesheet" />
</head>
<?php include('includes/header.php'); ?>

<body style="font-size: 1.2em">
    <h1>Kindergarten Math</h1>
    <form action="kinder-math-result.php" method="post">
        <table border="0" cellspacing="0" cellpadding="10">
            <?php
            // Chapter 2-1 PHP Basics: slide 26 
            define('MIN', 1); // Min value of random numbers.
            define('MAX', 9); // Max value of random numbers.
            define('NUM_OF_QUES', 5); // No. of questions to generate.

            // Generate questions.
            for ($i = 1; $i <= NUM_OF_QUES; $i++) {
                // https://www.w3schools.com/PHP/func_math_rand.asp
                $n1 = rand(MIN, MAX); // First number.
                $n2 = rand(MIN, MAX); // Second number.t

                // Chapter 2-3 PHP Working with Strings: Slide 28 - Slide 37
                // Print the question and textbox.
                // Hidden fields hold the first and second numbers.
                // It is for checking purpose at later page.
                printf(
                    '
                    <tr class="question">
                        <td>Q%d.</td>
                        <td>%d + %d = </td>
                        <td>
                            <input type="text" name="ans[]" maxlength="2" style="width: 2.0em" />
                            <input type="hidden" name="nums1[]" value="%d" />
                            <input type="hidden" name="nums2[]" value="%d" />
                        </td>
                    </tr>
                    <tr><td colspan="3"></td></tr>',
                    $i,
                    $n1,
                    $n2,
                    $n1,
                    $n2
                );
            }
            ?>
        </table>
        <input type="submit" name="submit" value="Submit" />
        <!-- JavaScript to reload the page. -->
        <!--            https://www.w3schools.com/Php/php_superglobals_server.asp-->
        <input type="button" value="Re-Generate" onclick="location='<?php echo $_SERVER['PHP_SELF'] ?>'" />
    </form>

    <a href="index.php">[Back]</a>
    
</body>
<?php include('includes/footer.php'); ?>

<!-- JavaScript to place focus (optional) -->
<script type="text/javascript">
    // Focus on the 1st field --> 'ans[]'.
    document.getElementsByName("ans[]")[0].focus();
</script>

</html>