<?php
function printList($arr)
{
    echo '<ul>';
    foreach ($arr as $value)
    {
        // why use % 2 == 0? 
        // if $value is even, $bool should be true as the remainder is 0
        $bool = $value % 2 == 0;
        $color = $bool ? 'red' : 'black';

        $color = $value % 2 == 0 ? 'red' : 'black';
        printf('<li style="color:%s">%04d</li>', $color, $value);
        // Chapter 2-3 PHP Working with Strings: Slide 28 - 37
    }
    echo '</ul>';
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>P1Q3</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    <body>
        <?php
        $num = array();
        // Generate 5 random numbers.
        for ($i = 0; $i < 5; $i++)
        {
            $num[$i] = rand(0, 9999);
            // https://www.w3schools.com/php/func_math_rand.asp
        }
        echo 'Original:';
        printList($num);

        // Chapter 2-4 PHP Arrays: slide 22 - 23
        echo 'Ascending:';
        // sort() function sorts an array in ascending order.
        sort($num);
        printList($num);
        
        echo 'Descending:';
        // rsort() function sorts an array in descending order.
        rsort($num);
        printList($num);
        ?>

        <p>
            [ <a href="index.php">Back</a> ]
        </p>
    </body>
</html>
