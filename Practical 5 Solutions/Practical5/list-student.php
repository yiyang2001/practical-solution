<?php
$PAGE_TITLE = 'List Student';
include('includes/header.php');
?>

<!-- Start of content -->
<!-- P4Q1 -->
<div>
    <h1>List Student</h1>

    <!-- Add a form tag to cover the table -->
    <form action="" method="post">

    <?php
    require_once('includes/helper.php');

    ///////////////////////////////////////////////////////////////////////////
    // Working with multiple deletion /////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////
    if (isset($_POST['delete'])) // If "delete" button is clicked.
    {
        $checked = isset($_POST['checked']) ? $_POST['checked'] : null;
        // NOTE:
        // -----
        // All checkboxes are named as "checked[]" value their value set to
        // the respective StudentID. For such, $checked is an array containing
        // all of the selected StudentID.

        if (!empty($checked)) // If at least 1 checkbox is checked.
        {
            $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            // Real escape all StudentID.
            $escaped = array();
            foreach ($checked as $value)
            {
                $escaped[] = $con->real_escape_string($value);
            }

            // SQL with WHERE field IN (...) clause.
            // https://www.w3schools.com/php/func_string_implode.asp
            $sql = "DELETE FROM Student WHERE StudentID IN ('" .
                   implode("','", $escaped) . "')";
            
            // https://www.php.net/manual/en/mysqli.query.php#refsect1-mysqli.query-returnvalues
            if ($con->query($sql))
            {
                printf('
                    <div class="info">
                    <strong>%d</strong> record(s) has been deleted.
                    </div>',
                    $con->affected_rows);
            }

            $con->close();
        }
    }
    ///////////////////////////////////////////////////////////////////////////
    
    // Array of actual table field names and their display names.
    $headers = array(
        'StudentID'   => 'Student ID',
        'StudentName' => 'Student Name',
        'Gender'      => 'Gender',
        'Program'     => 'Program'
    );
    
    // https://www.w3schools.com/php/php_superglobals_get.asp
    // https://www.w3schools.com/php/func_array_key_exists.asp
    // Validate sort, order and filter.
    $sort    = isset($_GET['sort']) ? (array_key_exists($_GET['sort'], $headers) ? $_GET['sort'] : 'StudentID') : 'StudentID';
    $order   = isset($_GET['order']) ? ($_GET['order'] == 'DESC' ? 'DESC' : 'ASC') : 'ASC';
    $program = isset($_GET['program']) ? (array_key_exists($_GET['program'], $PROGRAMS) ? $_GET['program'] : '%') : '%';


    ///////////////////////////////////////////////////////////////////////////
    // Generate filter options ////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////

    echo '<p>Filter : ';
    printf('<a href="?sort=%s&order=%s">All Programs</a> ', $sort, $order);
    foreach ($PROGRAMS as $key => $value)
    {
        printf('| <a href="?sort=%s&order=%s&program=%s">%s</a> ',
               $sort, $order, $key, $key);
    }
    echo '</p>';


    ///////////////////////////////////////////////////////////////////////
    // Generate clickable table headers ///////////////////////////////////
    ///////////////////////////////////////////////////////////////////////

    echo '<table border="1" cellpadding="5" cellspacing="0">';
    echo '<tr>';
    echo '<th>&nbsp;</th>'; // <-- Addtion column header (empty).
    foreach ($headers as $key => $value)
    {
        if ($key == $sort) // The sorted field.
        {
            printf('
                <th>
                <a href="?sort=%s&order=%s&program=%s">%s</a>
                <img src="images/%s" alt="%s" />
                </th>',
                $key,
                $order == 'ASC' ? 'DESC' : 'ASC',
                $program,
                $value,
                $order == 'ASC' ? 'asc.png' : 'desc.png',
                $order == 'ASC' ? 'Ascending' : 'Descending');
        }
        else // Non-sorted field.
        {
            printf('
                <th>
                <a href="?sort=%s&order=ASC&program=%s">%s</a>
                </th>',
                $key,
                $program,
                $value);
        }
    }
    echo '<th>&nbsp;</th>'; // <-- Addtion column header (empty).
    echo '</tr>';


    ///////////////////////////////////////////////////////////////////////
    // Database select ////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////

    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $sql = "SELECT * FROM Student WHERE Program LIKE '$program' ORDER BY $sort $order";

    if ($result = $con->query($sql))
    {
        while ($row = $result->fetch_object())
        {
            printf('
                <tr>
                <td>
                    <input type="checkbox" name="checked[]" value="%s" />
                </td>
                <td>%s</td>
                <td>%s</td>
                <td>%s</td>
                <td>%s</td>
                <td>
                    <a href="edit-student.php?id=%s">Edit</a> |
                    <a href="delete-student.php?id=%s">Delete</a>
                </td>
                </tr>',
                $row->StudentID, // <-- Value of the checkboxes.
                $row->StudentID,
                $row->StudentName,
                $GENDERS[$row->Gender],
                $row->Program . ' - ' .$PROGRAMS[$row->Program],
                $row->StudentID,
                $row->StudentID);
        }
    }

    printf('
        <tr>
        <td colspan="6">
            %d record(s) returned.
            [ <a href="insert-student.php">Insert Student</a> ]
        </td>
        </tr>',
        $result->num_rows);
    echo '</table>';

    $result->free();
    $con->close();
    ///////////////////////////////////////////////////////////////////////
    ?>

    <!-- Submit button for multiple deletion -->
    <br />
    <!<!-- https://stackoverflow.com/questions/7814949/javascript-onclick-event-return-keyword-functionality -->
    <input type="submit" name="delete" value="Delete Checked"
           onclick="return confirm('This will delete all checked records.\nAre you sure?')" />
    </form>
    <!-- End of form -->

    <p>
        [ <a href="index.php">Index</a> ]
    </p>
</div>
<!-- End of content -->

<?php
include('includes/footer.php');
?>
