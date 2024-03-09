<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
</head>

<body>
    <?php
    $txt = "My Name is Jin";
    $x = 8;
    $y = 1;
    echo $x + $y;

    function myTest()
    {
        print "<p>This is the message from function</p>";
    }

    myTest();

    if ($x + $y > 100) {
        echo "Greater than 100";
    } elseif ($x + $y == 100) {
        echo "Equal to 100";
    } else {
        echo "Less than 100";
    }

    echo "<ul>";
    while ($x > 0) {
        echo "<li>$x</li>";
        $x--;
    }
    echo "</ul>";

    for ($i = 0; $i <= 10; $i++) {
        echo "<p>Paragraph Number $i</p>";
    }

    $fruits = array("apple", "orange", "banana", "watermelon");

    foreach ($fruits as $value) {
        echo "<p><b>$value</b></p>";
    }

    ?>
    <li><a href="/index.php">[Back]</a></li>

</body>

</html>