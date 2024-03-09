<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>P1Q4</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    <body>
        <table border="0">
            <tr bgcolor="#cccccc">
                <th>COURSE</th>
                <th>PASSING RATE</th>
            </tr>
            <?php
            $data = array(
                "AACS3013" => 70,
                "AACS3073" => 95,
                "AAMS3683" => 55,
                "AACS3034" => 75,
                "AHLA3413" => 65
            );
            
            // Chapter 2-4 PHP Arrays: Slide 4 - 16
            // Chapter 2-2 PHP Decision and Loops: slide 7
            foreach ($data as $key => $value)
            {
                $width = ($value * 5) . 'px';
                $color = ($value >= 70 ? 'lightblue' : 'pink');

                echo "
                    <tr>
                    <td>$key</td>
                    <td><span style='
                        display: inline-block;
                        background-color: $color;
                        width: $width'>&nbsp;</span> $value%
                    </td>
                    </tr>";
            }

            /* Notes:
                * 1. The foreach loop is used to iterate through the $data array.
                * 2. The $key is the course code and the $value is the passing rate.
                * 3. The width of the bar is calculated based on the passing rate.
                * 4. The color of the bar is determined based on the passing rate.
            */
            ?>
        </table>

        <p>
            [ <a href="index.php">Back</a> ]
        </p>
    </body>
</html>
