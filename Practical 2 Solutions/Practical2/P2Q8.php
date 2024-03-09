<?php
function generateDatePicker()
{
    // why use 1 as the first key? - to make the month number the same as the key
    // without the 1, the month number will be 0-based
    $months = array(
        1 => "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    );
    date_default_timezone_set('Asia/Kuala_Lumpur');
    $today     = getdate();
    // mday =  day of the month(1-31);
    // mon = month (1-12);
    // year = year (4 digits)
    $cur_day   = $today['mday'];
    $cur_month = $today['mon'];
    $cur_year  = $today['year'];

    // Generate days.
    echo '<select name="day">';
    for ($d = 1; $d <= 31; $d++)
    {
        printf('<option %s>%d</option>',
            $d == $cur_day ? 'selected="selected"' : '',
            $d
        );
    }
    echo '</select> ';

    // Generate months.
    echo '<select name="month">';
    foreach ($months as $key => $value)
    {
        printf('<option %s value="%d">%s</option>',
            $key == $cur_month ? 'selected="selected"' : '',
            $key,
            $value
        );
    }
    echo '</select> ';

    // Generate years.
    echo '<select name="year">';
    // why use $cur_year - 20? - to generate 20 years before the current year
    for ($y = $cur_year - 20; $y <= $cur_year; $y++)
    {
        printf('<option %s>%d</option>',
            $y == $cur_year ? 'selected="selected"' : '',
            $y
        );
    }
    echo '</select> ';
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>P2Q8</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    <body>
        <?php
        generateDatePicker();
        ?>

        <p>
            [ <a href="index.php">Back</a> ]
        </p>
    </body>
</html>
