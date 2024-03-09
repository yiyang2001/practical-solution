<?php
// Return an array of all clubs.
function getClubs()
{
    return array(
        'LD' => 'Ladies Club',
        'GT' => 'Gentlemen Club',
        'DT' => 'DOTA and Gaming Club',
        'MG' => 'Manga and Comic Club',
        'PS' => 'Pet Society Club',
        'FV' => 'Farmville Club'
    );
}

// Return an array of error messages.
// Empty array if there is no input error.
function detectInputError()
{
    // Use the global variables.
    // https://www.w3schools.com/php/keyword_global.asp
    global $gender, $name, $phone, $clubs;

    // For holding error messages.
    $error = array();

    // gender /////////////////////////////////////////////////////////////////
    if ($gender == null)
    {
        $error['gender'] = 'Unisex? Please select your <strong>gender</strong>.';
    }
    // EXTRA: To prevent hacks.
    else if (!preg_match('/^[MF]$/', $gender))
    {
        $error['gender'] = '<strong>Gender</strong> can only be either M or F.';
    }

    // name ///////////////////////////////////////////////////////////////////
    if ($name == null)
    {
        $error['name'] = 'Nameless? Please enter your <strong>name</strong>.';
    }
    // EXTRA: To prevent hacks.
    else if (strlen($name) > 30)
    {
        $error['name'] = 'Your <strong>name</strong> is too long. It must be less than 30 characters.';
    }
    // ^ = start of string, $ = end of string.
    // A-Za-z = alphabets, @ = space, , = comma, ' = apostrophe, . = dot, - = hyphen, / = slash.
    else if (!preg_match('/^[A-Za-z @,\'\.\-\/]+$/', $name))
    {
        $error['name'] = 'There are invalid characters in your <strong>name</strong>.';
    }

    // phone //////////////////////////////////////////////////////////////////
    if ($phone == null)
    {
        $error['phone'] = 'Please enter your <strong>mobile phone</strong> number.';
    }
    // EXTRA: To prevent hacks.
    // 3 digits, hyphen, 7 digits.
    // starts with 01.
    else if (!preg_match('/^01\d-\d{7}$/', $phone))
    {
        $error['phone'] = 'Your <strong>mobile phone</strong> number is invalid. Format: 999-9999999 and starts with 01.';
    }

    // clubs //////////////////////////////////////////////////////////////////
    if ($clubs == null)
    {
        $error['clubs'] = 'Please select <strong>clubs</strong> that you want to join.';
    }
    else if (count($clubs) > 3)
    {
        $error['clubs'] = 'You cannot select more than 3 <strong>clubs</strong>.';
    }
    // EXTRA: To prevent hacks.
    // https://www.w3schools.com/php/func_array_diff.asp
    // https://www.w3schools.com/php/func_array_keys.asp
    else if (array_diff($clubs, array_keys(getClubs())) != null)
    {
        $error['clubs'] = 'You have selected invalid <strong>clubs</strong>.';
    }

    // gender-clubs ///////////////////////////////////////////////////////////
    if ($gender != null && $clubs != null)
    {
        // https://www.w3schools.com/php/func_array_in_array.asp
        if ($gender == 'M' && in_array('LD', $clubs))
        {
            $error['gender-clubs'] = 'Sorry. Males are not allowed to join the <strong>Ladies Club</strong>.';
        }
        else if ($gender == 'F' && in_array('GT', $clubs))
        {
            $error['gender-clubs'] = 'Sorry. Females are not allowed to join the <strong>Gentlemen Club</strong>.';
        }
    }

    ///////////////////////////////////////////////////////////////////////////
    return $error;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=8" />
        <title>Clubs Result</title>
        <link type="text/css" href="css/style.css" rel="stylesheet" />
    </head>
    <body style="font-size: 1.2em">
        <?php
        if (isset($_POST['submit'])) // POST with submit button pressed.
        {
            // Trim unwanted whitespaces.
            $gender = trim($_POST['gender']);
            $name   = trim($_POST['name']);
            $phone  = trim($_POST['phone']);
            $clubs  = isset($_POST['clubs']) ? $_POST['clubs'] : null ; // It is an array.

            $error = detectInputError();
            // https://www.w3schools.com/php/func_var_empty.asp
            if (empty($error)) // If there is no error.
            {
                printf('
                    <h1>Thanks for joining</h1>
                    <p>
                        <strong style="font-size: larger">%s. %s</strong><br />
                        You have joined the following clubs:
                    </p>',
                    $gender == 'M' ? 'Mr' : 'Ms', $name);

                $allClubs = getClubs();
                echo '<ul>';
                foreach ($clubs as $value)
                {
                    echo "<li>$allClubs[$value] ($value)</li>";
                }
                echo '</ul>';
            }
            else // If error detected.
            {
                printf('
                    <h1>OOPS... There are input errors</h1>
                    <ul style="color: red"><li>%s</li></ul>
                    <p>[ <a href="javascript:history.back()">Back</a> ]</p>',
                    implode('</li><li>', $error));
                // https://www.w3schools.com/php/func_string_implode.asp
            }
        }
        else // GET or hacks.
        {
            // JavaScript to redirect user to the right page.
            echo '
                <script type="text/javascript">
                location = "clubs-join.php";
                </script>
                ';
        }
        ?>
    </body>
</html>
