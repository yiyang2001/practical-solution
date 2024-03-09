<?php
$PAGE_TITLE = 'List Student';
include('includes/header.php');
?>

<!-- Start of content -->
<!-- P4Q1 -->
<div>
    <h1>List Student</h1>

    <?php
    require_once('includes/helper.php');

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
    foreach ($headers as $key => $value)
    {
        if ($key == $sort) // The sorted field.
        {
            // Chapter 5 Web Application Development: Slide 6 - Slide 7
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
            // Chapter 5 Web Application Development: Slide 6 - Slide 7
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
            // Chapter 5 Web Application Development: Slide 6 - Slide 7
            printf('
                <tr>
                <td>%s</td>
                <td>%s</td>
                <td>%s</td>
                <td>%s</td>
                <td>
                    <a href="edit-student.php?id=%s">Edit</a> |
                    <a href="delete-student.php?id=%s">Delete</a>
                </td>
                </tr>', // <-- Additional column with links.
                $row->StudentID,
                $row->StudentName,
                $GENDERS[$row->Gender],
                $row->Program . ' - ' .$PROGRAMS[$row->Program],
                $row->StudentID,  // <-- Query string.
                $row->StudentID); // <-- Query string.
        }
    }

    printf('
        <tr>
        <td colspan="5">
            %d record(s) returned.
            [ <a href="insert-student.php">Insert Student</a> ]
        </td>
        </tr>', // <-- Set 'colspan' to 5.
        $result->num_rows);
    echo '</table>';

    $result->free();
    $con->close();
    ///////////////////////////////////////////////////////////////////////
    ?>
    
    <p>
        [ <a href="index.php">Index</a> ]
    </p>
</div>
<!-- End of content -->

<?php
include('includes/footer.php');
?>
