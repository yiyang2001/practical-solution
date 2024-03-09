<?php
// If "image" is given.
if (isset($_GET['image']))
{
    $image = trim($_GET['image']);

    // User does want any background image.
    if ($image == "remove")
    {
        // Remove the cookie by making it expired.
        // https://www.php.net/manual/en/function.setcookie.php
        // https://www.php.net/manual/en/function.implode.php
        // https://www.php.net/manual/en/function.time.php
            // https://www.electronicshub.org/what-is-epoch-time/        
        setcookie('bg_image', null, time() - 999999999);
    }
    // User has selected his favorite background image.
    else
    {
        // Save to cookie. Make it expires after 1 week.
        // https://www.php.net/manual/en/function.setcookie.php
        // https://www.php.net/manual/en/function.implode.php
        // https://www.php.net/manual/en/function.time.php
            // https://www.electronicshub.org/what-is-epoch-time/        
        setcookie('bg_image', $image, time() + 60 * 60 * 24 * 7);
    }

    // Redirect user back to "homepage.php".
    // https://www.w3schools.com/php/func_network_header.asp
    header('Location: homepage.php');
    // https://www.php.net/manual/en/function.exit.php
    exit();
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=8" />
        <title>Select Background Image</title>
        <link type="text/css" href="css/style.css" rel="stylesheet" />
    </head>
    <body>
        <p>
            Select your favorite background image:
        </p>
        <div>
            <?php
            // Array of all available images.
            // As in the "small" and "large" folders.
            $images = array(
                "city",
                "desert",
                "lake",
                "ocean",
                "river",
                "sunrise"
            );

            // Display smaller version of the images.
            foreach ($images as $img)
            {
                // Form the path.
                $path = 'images/small/' . $img . '.jpg';

                // Images are placed with <a> tags,
                // thus they are clickable.
                printf('
                    <a href="?image=%s"><img src="%s" alt="%s" style="border: none" /></a>',
                    $img, $path, $img);
            }
            ?>
        </div>
        <p>
            I <a href="?image=remove">don't want</a> a background image.
        </p>
    </body>
</html>
