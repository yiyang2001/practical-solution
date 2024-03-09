<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=8" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <title>Upload Image</title>
    </head>
    <body>
        <h1>Upload Image</h1>
        
        <?php
        // Check if $_FILES is set.
        // https://www.php.net/manual/en/features.file-upload.post-method.php
        if (isset($_FILES['file']))
        {
            
            $file = $_FILES['file'];

            // If there is upload error.
            // https://www.php.net/manual/en/features.file-upload.errors.php
            if ($file['error'] > 0)
            {
                // Check the error code.
                switch ($file['error'])
                {
                    case UPLOAD_ERR_NO_FILE: // Code = 4.
                        $err = 'No file was selected.';
                        break;
                    case UPLOAD_ERR_FORM_SIZE: // Code = 2.
                        $err = 'File uploaded is too large. Maximum 1MB allowed.';
                        break;
                    default: // Other codes.
                        $err = 'There was an error while uploading the file.';
                        break;
                }
            }
            else if ($file['size'] > 1048576)
            {
                // Check the file size. Prevent hacks.
                // 1MB = 1024KB = 1048576B.
                $err = 'File uploaded is too large. Maximum 1MB allowed.';
            }
            else
            {
                // Extract the file extension.
                // Convert to lowercase for easy checking.
                // https://www.php.net/manual/en/function.pathinfo.php
                $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

                // Check the file extension.
                if ($ext != 'jpg'  &&
                    $ext != 'jpeg' &&
                    $ext != 'gif'  &&
                    $ext != 'png')
                {
                    $err = 'Only JPG, GIF and PNG format are allowed.';
                }
                else
                {
                    // Everything OK, save the file.

                    // Create an unique ID and use it as file name.
                    // https://www.w3schools.com/php/func_misc_uniqid.asp
                    $save_as = uniqid() . '.' . $ext;

                    // Save the file.
                    // https://www.w3schools.com/php/func_filesystem_move_uploaded_file.asp
                    move_uploaded_file($file['tmp_name'], 'uploads/' . $save_as);
                    
                    printf('
                        <div class="info">
                        Image uploaded successfully.
                        It is saved as [ <a href="gallery.php?image=%s">%s</a> ].
                        </div>',
                        $save_as, $save_as);
                }
            }

            // Display error message.
            if (isset($err))
            {
                echo '<div class="error">' . $err . '</div>';
            }
        }

        ?>

        <br />
        <!<!-- https://www.w3schools.com/php/php_file_upload.asp -->
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
            <input type="file" name="file" id="file" /><br />
            <input type="submit" value="Upload" />
        </form>

        <p>
            [ <a href="gallery.php">Image Gallery</a> ]
        </p>

        <p>
            [ <a href="index.php">Index</a> ]
        </p>
    </body>
</html>
