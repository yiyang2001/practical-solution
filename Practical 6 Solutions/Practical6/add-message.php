<?php
// Must start the session before any output.
// https://www.w3schools.com/php/php_sessions.asp
// https://www.php.net/manual/en/function.session-start.php
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=8" />
        <title>Add Message</title>
        <link type="text/css" href="css/style.css" rel="stylesheet" />
    </head>
    <body>
        <h1>Add Message</h1>

        <?php
        // If "message_to_add" is given.
        if (isset($_POST['message_to_add']))
        {
            // Read the input.
            $msg = trim($_POST['message_to_add']);
            
            if ($msg != null)
            {
                // Sanitize the input.
                // https://www.php.net/manual/en/function.htmlspecialchars.php
                // https://www.w3schools.com/php/func_string_htmlspecialchars.asp
                // https://stackoverflow.com/questions/4882307/when-to-use-htmlspecialchars-function                
                $msg = htmlspecialchars($msg);

                // Treat the session variable as an array.
                // and append new element to the array.
                // If fail to work, please destroy the session first.
                // https://stackoverflow.com/questions/676677/how-to-add-elements-to-an-empty-array-in-php
                // https://www.php.net/manual/en/reserved.variables.session.php
                $_SESSION['message'][] = $msg;

                echo '<p>Message added to session.</p>';
            }
        }
        ?>

        <form action="" method="post">
            <input type="text" name="message_to_add" id="message_to_add" maxlength="40" size="40" />
            <input type="submit" name="add" value="Add" />
            <input type="button" value="View"
                   onclick="location='view-message.php'" />
        </form>
    </body>

    <script type="text/javascript">
        // Just for fun. Please ignore.
        document.getElementById("message_to_add").focus();
    </script>
</html>
