<?php
// Check if delete button was clicked.
if (isset($_POST['delete']))
{
    // Delete the file.
    $image = $_POST['image'];
    $path = "uploads/$image";
    // https://www.w3schools.com/php/func_filesystem_unlink.asp
    unlink($path);
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=8" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <title>Image Gallery</title>
    </head>
    <body>
        <h1>Image Gallery</h1>

        <div style="float: left; width: 250px;">
        
        <?php
        // Display all file names from uploads folder as an list.
        // Only JPG, GIF and PNG images are displayed.
        echo '<ul>';
        // https://www.php.net/manual/en/function.glob.php
        foreach (glob('uploads/*.{jpg,jpeg,gif,png}', GLOB_BRACE) as $file)
        {
            // Create clickable hyperlink.
            // https://www.php.net/manual/en/function.pathinfo.php
            $basename = pathinfo($file, PATHINFO_BASENAME);
            printf('<li><a href="?image=%s" alt="">%s</a></li>',
                    $basename, $basename);
        }
        echo '</ul>';
        ?>

        [ <a href="upload.php">Upload Image</a> ]
        </div>

        <div style="float: left;">
        
        <?php
        // Check if image is passed as query string.
        if (isset($_GET['image']))
        {
            // Display the image.
            $image = $_GET['image'];
            printf('<img style="border: 1px solid gray;" src="uploads/%s" alt="" />', $image);

            // Form for deletion.
            printf('
                <form action="%s" method="post">
                    <input type="hidden" name="image" value="%s" />
                    <input type="submit" name="delete" value="Delete" />
                </form>', $_SERVER['PHP_SELF'] ,$image);
        }
        ?>

        </div>
        
    <p style="clear: both;">
        <br />
        [ <a href="index.php">Index</a> ]
    </p>
    </body>
</html>
