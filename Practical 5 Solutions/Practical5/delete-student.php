<?php
$PAGE_TITLE = 'Delete Student';
include('includes/header.php');
?>

<!-- Start of content -->
<!-- P4Q3 -->
<div>
    <h1>Delete Student</h1>

    <?php
    require_once('includes/helper.php');

    // GET METHOD /////////////////////////////////////////////////////////////
    // --> Retrieve Student record based on the passed StudentID.
    // https://www.w3schools.com/php/php_superglobals_server.asp
    if ($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        // https://www.w3schools.com/php/func_string_strtoupper.asp
        $id = strtoupper(trim($_GET['id']));

        ///////////////////////////////////////////////////////////////////////
        // Database select ////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////
        $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        // https://www.w3schools.com/php/func_mysqli_real_escape_string.asp
        // https://stackoverflow.com/questions/6327679/what-does-mysql-real-escape-string-really-do          
        $id  = $con->real_escape_string($id);
        $sql = "SELECT * FROM Student WHERE StudentID = '$id'";

        $result = $con->query($sql);
        if ($row = $result->fetch_object())
        {
            // Record found. Read field values.
            $id      = $row->StudentID;
            $name    = $row->StudentName;
            $gender  = $row->Gender;
            $program = $row->Program;
            
            printf('
                <p>
                    Are you sure you want to delete the following student?
                </p>
                <table border="1" cellpadding="5" cellspacing="0">
                    <tr>
                        <td>Student ID :</td>
                        <td>%s</td>
                    </tr>
                    <tr>
                        <td>Student Name :</td>
                        <td>%s</td>
                    </tr>
                    <tr>
                        <td>Gender :</td>
                        <td>%s</td>
                    </tr>
                    <tr>
                        <td>Program :</td>
                        <td>%s</td>
                    </tr>
                </table>
                <form action="" method="post">
                    <input type="hidden" name="id" value="%s" />
                    <input type="hidden" name="name" value="%s" />
                    <input type="submit" name="yes" value="Yes" />
                    <input type="button" value="Cancel"
                           onclick="location=\'list-student.php\'" />
                </form>',
                $id, $name, $GENDERS[$gender], $PROGRAMS[$program],
                $id, $name);
        }
        else
        {
            echo '
                <div class="error">
                Opps. Record not found.
                [ <a href="list-student.php">Back to list</a> ]
                </div>
                ';
        }
        
        $result->free();
        $con->close();
        ///////////////////////////////////////////////////////////////////////
    }
    // POST METHOD ////////////////////////////////////////////////////////////
    // --> Delete the record.   
    else
    {
        $id   = strtoupper(trim($_POST['id']));
        $name = trim($_POST['name']);

        ///////////////////////////////////////////////////////////////////////
        // Database delete ////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////
        $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $sql = '
            DELETE FROM Student
            WHERE StudentID = ?
        ';
        // https://www.php.net/manual/en/mysqli.prepare.php
        $stm = $con->prepare($sql);
        // https://www.php.net/manual/en/mysqli-stmt.bind-param.php
        $stm->bind_param('s', $id);
        // https://www.php.net/manual/en/mysqli-stmt.execute.php
        $stm->execute();

        // https://www.php.net/manual/en/mysqli-stmt.affected-rows.php
        if ($stm->affected_rows > 0)
        {
            printf('
                <div class="info">
                Student <strong>%s</strong> has been deleted.
                [ <a href="list-student.php">Back to list</a> ]
                </div>',
                $name);
        }
        else
        {
            echo '
                <div class="error">
                Opps. Database issue. Record not deleted.
                </div>
                ';
        }

        $stm->close();
        $con->close();
        ///////////////////////////////////////////////////////////////////////
    }
    ?>

    <p>
        [ <a href="index.php">Index</a> ]
    </p>
</div>
<!-- End of content -->

<?php
include('includes/footer.php');
?>
