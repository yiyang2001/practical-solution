<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>P1Q1</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    <body>
        <?php
        // define - to define a constant
        define('ROW', 10);
        define('COL', 15);
        
        // Chapter 2-1 PHP Basics: Slide 26

        echo '<table border="1">';
        // Outer loop to create the rows
        for ($x = 1; $x <= ROW; $x++)
        {
            echo '<tr height="20">';
            // Inner loop to create the columns
            for ($y = 1; $y <= COL; $y++)
            {
                // why use modulo? - to alternate the color of the cell
                // because 0 is false, 1 is true
                // if the sum of x and y is even, then the color is pink, else white
                $bool = ($x + $y) % 2 == 0;
                $color = $bool ? 'pink' : 'white';
                $color = (($x + $y) % 2 == 0) ? 'pink' : 'white';
                echo "<td width='20' bgcolor='$color'>&nbsp;</td>";
            }
            echo '</tr>';
        }
        echo '</table>';
        echo 'The table is having ' . ROW . ' rows and ' . COL . ' columns.';
        
        // Chapter 2-2 PHP Decision and Loops: Slide 16 - 19
        // Chapter 2-2 PHP Decision and Loops: slide 7

        /* 
            Notes:
            * 1. The outer loop is used to create the rows.
            * 2. The inner loop is used to create the columns.
            * 3. The bgcolor attribute is used to set the background color of the cell.
            * 4. The width and height attributes are used to set the width and height of the cell.
            * 5. The &nbsp; is used to add a space in the cell.
         */
        ?>

        <p>
            [ <a href="index.php">Back</a> ]
        </p>
    </body>
</html>
