<?php
$PAGE_TITLE = 'Edit Student';
include('includes/header.php');
?>

<!-- Start of content -->
<!-- P4Q2 -->
<div>
    <h1>Edit Student</h1>

    <?php
    require_once('includes/helper.php');

    // GET METHOD /////////////////////////////////////////////////////////////
    // --> Retrieve Student record based on the passed StudentID.
    // https://www.w3schools.com/php/php_superglobals_server.asp
    if ($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        // Read query string --> StudentID.
        // https://www.w3schools.com/php/func_string_strtoupper.asp
        $id = isset($_GET['id']) ? strtoupper(trim($_GET['id'])) : null;

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
            $hideForm = false; // Flag, "false" to show the form.
            
            // Record found. Read field values.
            $id      = $row->StudentID;
            $name    = $row->StudentName;
            $gender  = $row->Gender;
            $program = $row->Program;
        }
        else
        {
            echo '
                <div class="error">
                Opps. Record not found.
                [ <a href="list-student.php">Back to list</a> ]
                </div>
                ';

            $hideForm = true; // Flag, "true" to hide the form.
        }

        $result->free();
        $con->close();
        ///////////////////////////////////////////////////////////////////////
    }
    // POST METHOD ////////////////////////////////////////////////////////////
    // --> Update the record.
    else
    {
        $hideForm = false; // Flag, "false" to show the form.
        
        $id      = strtoupper(trim($_POST['id']));
        $name    = trim($_POST['name']);
        $gender  = trim($_POST['gender']);
        $program = trim($_POST['program']);

        // Validations:
        // ------------
        // Validation functions are defined at "helper.php".
        // I don't validate StudentID (PK) as it is not being updated.
        // Can check the existence of the StudentID if wanted to.
        $error['name']    = validateStudentName($name);
        $error['gender']  = validateGender($gender);
        $error['program'] = validateProgram($program);
        // https://www.w3schools.com/php/func_array_filter.asp
        $error = array_filter($error); // Remove null values.

        if (empty($error))
        {
            ///////////////////////////////////////////////////////////////////
            // Database update ////////////////////////////////////////////////
            ///////////////////////////////////////////////////////////////////
            $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            $sql = '
                UPDATE Student
                SET StudentName = ?, Gender = ?, Program = ?
                WHERE StudentID = ?
            ';
            // https://www.php.net/manual/en/mysqli.prepare.php
            $stm = $con->prepare($sql);
            // https://www.php.net/manual/en/mysqli-stmt.bind-param.php
            $stm->bind_param('ssss', $name, $gender, $program, $id);

            // https://www.php.net/manual/en/mysqli-stmt.execute.php
            if($stm->execute())
            {
                // NOTE: $stm->affected_rows?
                // -----
                // It is interesting that if we update a record with same field
                // values, [$stm->affected_rows] returns 0 (as there no changes
                // were taken place). For such, I don't use it.
                printf('
                    <div class="info">
                    Student <strong>%s</strong> has been updated.
                    [ <a href="list-student.php">Back to list</a> ]
                    </div>',
                    $name);
            }
            else
            {
                echo '
                    <div class="error">
                    Opps. Database issue. Record not updated.
                    </div>
                    ';
            }

            $stm->close();
            $con->close();
            ///////////////////////////////////////////////////////////////////
        }
        else
        {
            // Validation failed. Display error message.
            echo '<ul class="error">';
            foreach ($error as $value)
            {
                echo "<li>$value</li>";
            }
            echo '</ul>';
        }
    }
    ?>

    <!<!-- https://www.php.net/manual/en/control-structures.alternative-syntax.php -->
    <?php if ($hideForm == false) : // Hide or show the form.  ?>

    <form action="" method="post">
        <table cellpadding="5" cellspacing="0">
            <tr>
                <td><label for="id">Student ID :</label></td>
                <td>
                    <?php echo $id ?>
                    <?php htmlInputHidden('id', $id) // Hidden field. ?>
                </td>
            </tr>
            <tr>
                <td><label for="name">Student Name :</label></td>
                <td>
                    <?php htmlInputText('name', $name, 30) ?>
                </td>
            </tr>
            <tr>
                <td>Gender :</td>
                <td>
                    <?php htmlRadioList('gender', $GENDERS, $gender) ?>
                </td>
            </tr>
            <tr>
                <td><label for="program">Program :</label></td>
                <td>
                    <?php htmlSelect('program', $PROGRAMS, $program, '-- Select One --') ?>
                </td>
            </tr>
        </table>
        <br />
        <input type="submit" name="update" value="Update" />
        <input type="button" value="Cancel" onclick="location='list-student.php'" />
    </form>

    <?php endif ?>

    <p>
        [ <a href="index.php">Index</a> ]
    </p>
</div>
<!-- End of content -->

<?php
include('includes/footer.php');
?>
