<?php
$PAGE_TITLE = 'Insert Student';
include('includes/header.php');
?>

<!-- Start of content -->
<!-- P3Q4 -->
<div>
    <h1>Insert Student</h1>

    <?php
    require_once('includes/helper.php');

    if (!empty($_POST)) // Something posted back.
    {
        $id      = strtoupper(trim($_POST['id']));
        $name    = trim($_POST['name']);
        $gender  = isset($_POST['gender']) ? trim($_POST['gender']) : null;
        $program = trim($_POST['program']);

        // Validations.
        $error['id']      = validateStudentID($id);
        $error['name']    = validateStudentName($name);
        $error['gender']  = validateGender($gender);
        $error['program'] = validateProgram($program);
        $error = array_filter($error); // Remove null values.
        // NOTE:
        // -----
        // The validation functions are defined at "helper.php".
        // Any validation approach will do. No need to follow this.

        if (empty($error)) // If no error.
        {
            ///////////////////////////////////////////////////////////////////
            // Database insert ////////////////////////////////////////////////
            ///////////////////////////////////////////////////////////////////
            
            // NOTE:
            // -----
            // I am using prepare() method and Statement object.
            // Personal preference. No need to follow.
            // The query() + real_escape_string() methods will work too.
                      
            $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            $sql = '
                INSERT INTO Student (StudentID, StudentName, Gender, Program)
                VALUES (?, ?, ?, ?)
            ';
            $stm = $con->prepare($sql);
            $stm->bind_param('ssss', $id, $name, $gender, $program);
            $stm->execute();
            
            if ($stm->affected_rows > 0)
            {
                printf('
                    <div class="info">
                    Student <strong>%s</strong> has been inserted.
                    [ <a href="list-student.php">Back to list</a> ]
                    </div>',
                    $name);

                // Reset fields.
                $id = $name = $gender = $program = null;
            }
            else
            {
                // Something goes wrong.
                echo '
                    <div class="error">
                    Opps. Database issue. Record not inserted.
                    </div>
                    ';
            }
            
            $stm->close();
            $con->close();
            ///////////////////////////////////////////////////////////////////
        }
        else // Input error detected. Display error message.
        {
            echo '<ul class="error">';
            foreach ($error as $value)
            {
                echo "<li>$value</li>";
            }
            echo '</ul>';
        }
    }
    ?>

    <form action="" method="post">
        <table cellpadding="5" cellspacing="0">
            <tr>
                <td><label for="id">Student ID :</label></td>
                <td>
                    <?php
                    htmlInputText('id', isset($id) ? $id : "" , 10);
                    // NOTE:
                    // -----
                    // HTML helpers are defined at "helper.php".
                    // Personal preference. Time savers, but not a must.
                    ?>
                </td>
            </tr>
            <tr>
                <td><label for="name">Student Name :</label></td>
                <td>
                    <?php htmlInputText('name', isset($name) ? $name : "" , 30) ?>
                </td>
            </tr>
            <tr>
                <td>Gender :</td>
                <td>
                    <?php htmlRadioList('gender', $GENDERS, isset($gender) ? $gender : "") ?>
                </td>
            </tr>
            <tr>
                <td><label for="program">Program :</label></td>
                <td>
                    <?php htmlSelect('program', $PROGRAMS, isset($program) ? $program : "", '-- Select One --') ?>
                </td>
            </tr>
        </table>

        <input type="submit" name="insert" value="Insert" />
        <input type="button" value="Cancel" onclick="location='list-student.php'" />
    </form>

    <p>
        [ <a href="index.php">Index</a> ]
    </p>
</div>
<!-- End of content -->

<?php
include('includes/footer.php');
?>
