<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=8" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <title>Send Email</title>
    </head>
    <body>
        <h1>Send Email</h1>

        <?php
        if (isset($_POST['submit']))
        {
            $to      = $_POST['to'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];

            require_once 'includes/class.phpmailer.php';

            $mail = new PHPMailer(true);

            $mail->IsSMTP();
            $mail->Host      = 'smtp.gmail.com';
            $mail->Port      = '465';
            $mail->SMTPAuth  = true;
            $mail->Username  = 'schoolforumassignment@gmail.com';
            $mail->Password  = 'Kwu4Om11s5Kz';

            try
            {
                $mail->SetFrom('schoolforumassignment@gmail.com', 'AACS3173 Admin');
                $mail->AddAddress($to);
                $mail->Subject = $subject;
                $mail->Body    = $message;

                $mail->Send();
                echo '<p class="info">Message successfully sent!</p>';
            }
            catch (Exception $e)
            {
                echo '<p class="error">' . $e->getMessage() . '</p>';
            }
        }
        ?>

        <form action="" method="post">
            <table cellspacing="10">
                <tr>
                    <td>To:</td>
                    <td><input type="text" name="to" value="<?php echo isset($to) ? $to : '' ?>" style="width: 300px" /></td>
                </tr>
                <tr>
                    <td>Subject:</td>
                    <td><input type="text" name="subject" value="<?php echo isset($subject) ? $subject : '' ?>" style="width: 300px" /></td>
                </tr>
                <tr>
                    <td valign="top">Message:</td>
                    <td><textarea name="message" style="width: 300px; height: 200px"><?php echo isset($message) ? $message : '' ?></textarea></td>
                </tr>
            </table>
            <input type="submit" name="submit" value="Send Email" />
        </form>

    <p>
        [ <a href="index.php">Index</a> ]
    </p>
    </body>
</html>
