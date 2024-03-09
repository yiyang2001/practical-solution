<?php
// Return an array of error messages.
// Empty array if there is no input error.
function detectInputError()
{
    // Use the global variables.
    global $num1, $num2;

    // For holding error messages.
    $error = array();

    // num1 ///////////////////////////////////////////////////////////////////
    if ($num1 == null) {
        $error['num1'] = 'Please enter <strong>Number 1</strong>.';
    }
    // Chapter 2-3 PHP Working with Strings : Slide 45
    // ^: Asserts the start of the string.
    // [+-]?: Allows for an optional plus or minus sign.9223372036854775807
    // \d+: Matches one or more digits (0-9).
    // $: Asserts the end of the string.
    else if (!preg_match('/^[+-]?\d+$/', $num1)) {
        $error['num1'] = '<strong>Number 1</strong> must be an integer.';
    } else if ($num1 < (-PHP_INT_MAX - 1) || $num1 > PHP_INT_MAX) {
        // NOTE:
        // -----
        // Don't cast $num1 to (int) for the comparison.
        // When casted to (int), value > PHP_INT_MAX will be set to PHP_INT_MAX.
        // E.g. 32-bit system (int)-2147483647 --> 2147483647 --> PHP_INT_MAX. OR 64-bit system -9223372036854775807 --> 9223372036854775807
        // Leave $num1 as (string).
        $error['num1'] = '<strong>Number 1</strong> must between ' . (-PHP_INT_MAX - 1) . ' and ' . PHP_INT_MAX . '.';
    }

    // num2 ///////////////////////////////////////////////////////////////////
    if ($num2 == null) {
        $error['num2'] = 'Please enter <strong>Number 2</strong>.';
    } else if (!preg_match('/^[+-]?\d+$/', $num2)) {
        $error['num2'] = '<strong>Number 2</strong> must be an integer.';
    } else if ($num2 < (-PHP_INT_MAX - 1) || $num2 > PHP_INT_MAX) {
        $error['num2'] = '<strong>Number 2</strong> must between ' . (-PHP_INT_MAX - 1) . ' and ' . PHP_INT_MAX . '.';
    } else if (isset($_POST["divide"]) && ((int)$num2 == 0)) {
        $error['num2'] = 'Cannot divide by 0. Change <strong>Number 2</strong>.';
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
    <title>Simple Calculator</title>
    <link type="text/css" href="css/style.css" rel="Stylesheet" />
</head>

<?php include('includes/header.php'); ?>

<body style="font-size: 1.2em">
    <h1>Simple Calculator</h1>
    <?php
    // https://www.w3schools.com/php/func_var_empty.asp
    if (!empty($_POST)) // POST, indicidates a postback.
    {
        // Trim unwanted spaces.
        $num1 = trim($_POST['num1']);
        $num2 = trim($_POST['num2']);

        $error = detectInputError();
        if (empty($error)) // If there is no error.
        {
            $n1 = (int)$num1;
            $n2 = (int)$num2;
            // NOTE:
            // -----
            // Just my personal preference not to work on the user inputs
            // directly. If you wanted to, you can use settype().
            // E.g. settype($num1   , 'int') --> $num become (int)
            // E.g. settype('123'   , 'int') --> 123(int)
            // E.g. settype('123ABC', 'int') --> 123(int)
            // E.g. settype(''      , 'int') --> 0  (int) BEWARE!!!

            // Different buttons perform different actions.
            if (isset($_POST['add'])) {
                $action = 'Add';
                $symbol = '+';
                $answer = $n1 + $n2;
            } else if (isset($_POST['minus'])) {
                $action = 'Minus';
                $symbol = '-';
                $answer = $n1 - $n2;
            } else if (isset($_POST['multiply'])) {
                $action = 'Multiply';
                $symbol = '*';
                $answer = $n1 * $n2;
            } else // Divide, or hacks.
            {
                $action = 'Divide';
                $symbol = '/';
                $answer = $n1 / $n2;
            }

            // Output.
            printf(
                '
                    <div class="info" style="font-size: larger">
                    <strong>%s</strong>: %d %s %d = <strong>%s</strong>
                    </div>',
                $action,
                $n1,
                $symbol,
                $n2,
                $answer
            );
            // NOTE:
            // -----
            // Format $answer with %s so that floating-point result
            // won't be truncated. Unlike strongly-typed languages,
            // PHP casts the result to (float) whenever needed.
            // E.g. 2147483647(int) + 2147483647(int) --> 4294967294(float).
            // Hate or love the behavior? I don't know...
        } else {
            printf(
                '<ul class="error"><li>%s</li></ul>',
                implode('</li><li>', $error)
            );
        }
    }
    ?>
    <form action="" method="post">
        <table cellspacing="5">
            <tr>
                <td><label for="num1">Number 1 :</label></td>
                <td><input type="text" name="num1" id="num1" value="<?php echo isset($num1) ? $num1 : '' ?>" /></td>
            </tr>
            <tr>
                <td><label for="num2">Number 2 :</label></td>
                <td><input type="text" name="num2" id="num2" value="<?php echo isset($num2) ? $num2 : '' ?>" /></td>
            </tr>
        </table>
        <input type="submit" name="add" value="Add" />
        <input type="submit" name="minus" value="Minus" />
        <input type="submit" name="multiply" value="Multiply" />
        <input type="submit" name="divide" value="Divide" />
        <!-- JavaScript to reload the page.
                 Typical reset button won't work. -->
        <input type="button" value="Reset" onclick="location='<?php echo $_SERVER['PHP_SELF'] ?>'" />
    </form>
    <a href="index.php">[Back]</a>

</body>
<?php include('includes/footer.php'); ?>

<!-- JavaScript to place focus (optional) -->
<script type="text/javascript">
    <?php
    if (empty($error)) {
        // No error. Focus on 1st field --> 'num1'.
        echo 'document.getElementsByName("num1")[0].focus();';
    } else {
        // Error. Focus on 1st error field.
        // https://www.w3schools.com/php/func_array_reset.asp
        // https://www.w3schools.com/php/func_array_key.asp
        // reset() - Return the first element of the array
        // key()   - Return the key of the current element in an array
        // Replace the "?" with the correct function to get the first key of the array $error
        reset($error);
        $field = key($error);
        echo "
                var field = document.getElementsByName('$field')[0];
                field.focus();
                field.select();";
    }
    ?>
</script>

</html>