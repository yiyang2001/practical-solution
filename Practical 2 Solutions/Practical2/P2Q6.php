<?php
$states = array(
    'JH' => 'Johor',
    'KD' => 'Kedah',
    'KT' => 'Kelantan',
    'KL' => 'Kuala Lumpur',
    'LB' => 'Labuan',
    'MK' => 'Melaka',
    'NS' => 'Negeri Sembilan',
    'PH' => 'Pahang',
    'PN' => 'Penang',
    'PR' => 'Perak',
    'PL' => 'Perlis',
    'PJ' => 'Putrajaya',
    'SB' => 'Sabah',
    'SW' => 'Sarawak',
    'SG' => 'Selangor',
    'TR' => 'Terengganu'
);

// Chapter 2-4 PHP Arrays: Slide 4 - 16
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>P1Q2</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    <body>
        <?php
        echo '<ul>';
        foreach ($states as $key => $value)
        {
            echo "<li>$value ($key)</li>";
        }
        echo '</ul>';
        ?>

        <p>
            [ <a href="index.php">Back</a> ]
        </p>
    </body>
</html>
