<!DOCTYPE html>
<html>
<head>
    <title>PHP Form Handling</title>
</head>
<body>
    <h2>Form Data Submitted</h2>
    <?php
    // Check if the form is submitted using POST or GET
    // If the form is submitted using POST, retrieve the data using $_POST
    // $_SERVER is an array containing information such as headers, paths, and script locations
    // $_SERVER["REQUEST_METHOD"] returns the request method used to access the page
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //$_POST is an associative array of variables passed to the current script via the HTTP POST method
        $name = $_POST["name"];
        $email = $_POST["email"];
        echo "Name: $name<br>";
        echo "Email: $email";
    } 
    // If the form is submitted using POST, retrieve the data using $_POST
    elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
        $name = $_GET["name"];
        $email = $_GET["email"];
        echo "Name: $name<br>";
        echo "Email: $email";
    } 
    // If the form is submitted using other methods, display an error message
    else {
        echo "Invalid request method";
    }
    ?>
</body>
</html>
