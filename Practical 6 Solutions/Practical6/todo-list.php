<?php
// Retrieve "tasks" from cookie.
// Explode it from string to array.
// https://www.w3schools.com/php/php_cookies.asp
    //  https://www.php.net/manual/en/reserved.variables.cookies.php
// https://www.php.net/manual/en/function.array-filter.php
// https://www.php.net/manual/en/function.explode.php
$tasks = isset($_COOKIE['tasks']) ? array_filter(explode('|', $_COOKIE['tasks'])) : null;

// If "task_to_add" is given.
if (isset($_POST['task_to_add']))
{
    // Read string from "task_to_add" input field.
    $task = trim($_POST['task_to_add']);

    // If it is not empty.
    if ($task != null)
    {
        // Santinize it and add it to array.
        // https://www.php.net/manual/en/function.htmlspecialchars.php
        // https://www.w3schools.com/php/func_string_htmlspecialchars.asp
        // https://stackoverflow.com/questions/4882307/when-to-use-htmlspecialchars-function
        // https://stackoverflow.com/questions/676677/how-to-add-elements-to-an-empty-array-in-php
        $tasks[] = htmlspecialchars($task);

        // Implode it from array to string, use "|" as separator.
        // Store it to cookie, expire after 1 year.
        // https://www.php.net/manual/en/function.setcookie.php
        // https://www.php.net/manual/en/function.implode.php
        // https://www.php.net/manual/en/function.time.php
            // https://www.electronicshub.org/what-is-epoch-time/
        setcookie('tasks', implode('|', $tasks), time() + 60 * 60 * 24 * 365);
    }
}
// If "task_to_delete" is given.
else if (isset($_POST['task_to_delete']))
{
    // Read the "index" of the array element need to be deleted.
    $key = $_POST['task_to_delete'];

    // Remove the particular array element with the specific "index".
    // https://www.php.net/manual/en/function.unset.php
    // https://stackoverflow.com/questions/369602/deleting-an-element-from-an-array-in-php
    unset($tasks[$key]);

    // Re-index the array.
    // https://www.w3schools.com/php/func_array_values.asp
    $tasks = array_values($tasks);

    // Implode it from array to string, use "|" as separator.
    // Store it to cookie, expire after 1 year.
    // https://www.php.net/manual/en/function.setcookie.php
    // https://www.php.net/manual/en/function.implode.php
    // https://www.php.net/manual/en/function.time.php
        // https://www.electronicshub.org/what-is-epoch-time/    
    setcookie('tasks', implode('|', $tasks), time() + 60 * 60 * 24 * 365);
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=8" />
        <title>My To-do List</title>
        <link type="text/css" href="css/style.css" rel="stylesheet" />
    </head>
    <body>
        <h1>My To-do List</h1>
        
        <?php
        if (empty($tasks))
        {
            echo '<p>You do not have any pending task.</p>';
        }
        else
        {
            printf('<p>You have %d pending task(s):</p>', count($tasks));
            echo '<table>';
            foreach ($tasks as $key => $value)
            {
                printf('
                    <tr>
                        <td>
                            <form action="" method="post" style="display:inline">
                                <input type="hidden" name="task_to_delete" value="%d" />
                                <input type="submit" name="delete" value="X" />
                            </form>
                        </td>
                        <td>%d.</td>
                        <td>%s</td>
                    </tr>',
                    $key, $key + 1, $value);
            }
            echo '</table>';
        }
        ?>
        <br />
        <form action="" method="post">
            <input type="text" name="task_to_add" id="task_to_add"
                   size="40" maxlength="50" />
            <input type="submit" name="add" value="Add" />
        </form>
    </body>

    <script type="text/javascript">
        // Just for fun. Please ignore.
        document.getElementById("task_to_add").focus();
    </script>
</html>
