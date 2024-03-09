<?php
// Check if cookie is set.
// https://www.w3schools.com/php/php_cookies.asp
    //  https://www.php.net/manual/en/reserved.variables.cookies.php
if (isset($_COOKIE['bg_image']))
{
    // Form the path to the background image.
    $bg_image = 'images/large/' . $_COOKIE['bg_image'] . '.jpg';
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=8" />
        <title>My Homepage</title>
        <link type="text/css" href="css/style.css" rel="stylesheet" />
    </head>
    <body style="background-image: url('<?php echo isset($bg_image) ? $bg_image : '' ?>');
                 background-position: center center;
                 background-repeat: no-repeat;
                 background-attachment: fixed;
                 background-color: #ccc;
                 ">

        <div id="div" style="background-color: white;
                    border: 1px solid black;
                    padding: 10px">
            <h1>My Homepage</h1>
            <a href="select-background.php">Select Background Image</a>
        </div>

    </body>
</html>
