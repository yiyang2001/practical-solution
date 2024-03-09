<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=8" />
        <title>Clubs Join</title>
        <link type="text/css" href="css/style.css" rel="stylesheet" />        
    </head>

    <?php include('includes/header.php'); ?>

    <body style="font-size: 1.2em">
        <h1>Join TARUC's interest clubs</h1>
        <form action="clubs-result.php" method="post">
            <table cellspacing="0" cellpadding="5">
                <tr>
                    <td>Gender :</td>
                    <td>
                        <input type="radio" name="gender" id="M" value="M" />
                        <label for="M">Male</label>
                        <input type="radio" name="gender" id="F" value="F" />
                        <label for="F">Female</label>
                    </td>
                </tr>
                <tr>
                    <td><label for="name">Name :</label></td>
                    <td>
                        <input type="text" name="name" id="name" maxlength="300" />
                    </td>
                </tr>
                <tr>
                    <td><label for="phone">Mobile Phone :</label></td>
                    <td>
                        <input type="text" name="phone" id="phone" maxlength="11" />
                    </td>
                </tr>
                <tr>
                    <td valign="top">Interest Clubs :</td>
                    <td>
                        <small>(Select 1 to 3 clubs)</small>
                        <br />
                        <input type="checkbox" name="clubs[]" id="LD" value="LD" />
                        <label for="LD">Ladies Club</label><br />

                        <input type="checkbox" name="clubs[]" id="GT" value="GT" />
                        <label for="GT">Gentlemen Club</label><br />

                        <input type="checkbox" name="clubs[]" id="DT" value="DT" />
                        <label for="DT">DOTA and Gaming Club</label><br />

                        <input type="checkbox" name="clubs[]" id="MG" value="MG" />
                        <label for="MG">Manga and Comic Club</label><br />

                        <input type="checkbox" name="clubs[]" id="PS" value="PS" />
                        <label for="PS">Pet Society Club</label><br />

                        <input type="checkbox" name="clubs[]" id="FV" value="FV" />
                        <label for="FV">Farmville Club</label><br />
                    </td>
                </tr>
            </table>
            <input type="submit" name="submit" value="Submit" />
            <input type="reset" value="Reset" />
        </form>
        <a href="index.php">[Back]</a>

    </body>
    <?php include('includes/footer.php'); ?>

    <!-- JavaScript to place focus (optional) -->
    <script type="text/javascript">
        // Focus on the 1st field --> 'gender'.
        document.getElementsByName("gender")[0].checked = true;
    </script>
</html>
