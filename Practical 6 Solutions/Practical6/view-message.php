<?php
// Must start the session before any output.
// https://www.w3schools.com/php/php_sessions.asp
// https://www.php.net/manual/en/function.session-start.phps
session_start();

// If "delete" button clicked.
if (isset($_POST['delete']))
{
    // Destroy the session.
    // https://www.php.net/manual/en/function.session-destroy.php
    session_destroy();

    // Redirect to the page itself.
    // Effectively a "reload".
    // https://www.w3schools.com/php/func_network_header.asp
    header('Location: ' . $_SERVER['PHP_SELF']);
    // https://www.php.net/manual/en/function.exit.php
    exit();
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=8" />
        <title>View Message</title>
        <link type="text/css" href="css/style.css" rel="stylesheet" />
    </head>
    <body>
        <h1>View Message</h1>

        <?php
        // If the session variable is found.
        // https://www.php.net/manual/en/reserved.variables.session.php
        if (isset($_SESSION['message']))
        {
            // Retrieve as an array.
            $all_msg = $_SESSION['message'];

            // Display its content.
            echo '<ul>';
            foreach ($all_msg as $msg)
            {
                echo "<li>$msg</li>";
            }
            echo '</ul>';
        }
        // If cannot found.
        else
        {
            echo '<p>No message in the session.</p>';
        }
        ?>

        <form action="" method="post">
            <input type="submit" name="delete" value="Delete All" />
            <input type="button" value="Add Message"
                   onclick="location='add-message.php'" />
        </form>
    </body>
</html>
