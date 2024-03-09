<!DOCTYPE html>
<html>

<head>
    <title>PHP Form Handling</title>
</head>

<body>
    <!-- The different between GET and POST -->
    <h2>GET vs POST</h2>
    <p>GET and POST are two different methods for sending data to the server. The GET method appends the data to the URL, while the POST method sends the data in the body of the request. The GET method is less secure than the POST method, and can only be used to send ASCII characters. The POST method does not have any restrictions on data size or type, and is the method that should be used when sending sensitive information.</p>

    <!-- Example of GET and POST -->
    <h2>PHP Form Handling Example (GET)</h2>
    <form action="process_form.php" method="get">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="Teo Yi Yang"><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="p4489@tarc.edu.my"><br>
        <input type="submit" value="Submit">
    </form>
    <h2>PHP Form Handling Example (POST)</h2>
    <form action="process_form.php" method="post">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="Teo Yi Yang"><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="p4489@tarc.edu.my"><br>
        <input type="submit" value="Submit">
    </form>

</body>

</html>