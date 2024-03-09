<?php
$PAGE_TITLE = 'Select Student';
// https://www.w3schools.com/php/php_includes.asp
include('includes/header.php');
?>

<!-- Start of content -->
<!-- P3Q3 -->
<div>
    <h1>List Student</h1>

    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>Student ID</th>
            <th>Student Name</th>
            <th>Gender</th>
            <th>Program</th>
        </tr>

        <?php
        // https://www.w3schools.com/php/keyword_require_once.asp
        require_once('includes/helper.php');
        // NOTE:
        // -----
        // The "helper.php" file contains definition for
        // DB_HOST, DB_USER, DB_PASS and DB_NAME.

        ///////////////////////////////////////////////////////////////////////
        // Database select ////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////

        // NOTE:
        // -----
        // I am using OOP way and have ignored some error checkings.
        // Just personal preference, no need to follow exactly.
        // https://www.w3schools.com/php/php_mysql_connect.asp
        $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if($con->connect_error){
            die("Connection failed: " . $con->connect_error);
        }
        
        // https://www.w3schools.com/php/php_mysql_select.asp
        // https://www.w3schools.com/php/func_mysqli_query.asp
        $sql = "SELECT * FROM Student";
        $result = $con->query($sql);

        if ($result->num_rows > 0)
        {
            // https://www.w3schools.com/php/func_mysqli_fetch_object.asp
            // https://www.php.net/manual/en/mysqli-result.fetch-object.php
            // https://stackoverflow.com/questions/6681075/while-loop-in-php-with-assignment-operator
            while ($row = $result->fetch_object())
            {
                printf('
                    <tr>
                    <td>%s</td>
                    <td>%s</td>
                    <td>%s</td>
                    <td>%s</td>
                    </tr>',
                    $row->StudentID,
                    $row->StudentName,
                    $GENDERS[$row->Gender],
                    $row->Program . " - " . $PROGRAMS[$row->Program]);
                // NOTE:
                // -----
                // Lookup tables (arrays) are defined in "helper.php".
            }
        }

        printf('
            <tr>
            <td colspan="4">
                %d record(s) returned.
                [ <a href="insert-student.php">Insert Student</a> ]
            </td>
            </tr>',
            $result->num_rows);
        
        // https://www.w3schools.com/php/func_mysqli_free_result.asp
        $result->free();
        // https://www.w3schools.com/php/func_mysqli_close.asp
        $con->close();
        ///////////////////////////////////////////////////////////////////////
        ?>
    </table>
</div>
<!-- End of content -->
<?php
include('includes/footer.php');
?>
