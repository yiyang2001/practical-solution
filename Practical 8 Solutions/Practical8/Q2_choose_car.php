<html>

<head>
    <script>
        function showCarModel(str) {
            // https://stackoverflow.com/questions/58006801/meaning-of-window-xmlhttprequest-ajax
            if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                // https://www.w3schools.com/js/js_ajax_http.asp
                xmlhttp = new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }

            // Create a function that will receive data sent from the server
            // https://www.w3schools.com/js/js_ajax_http.asp
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    // https://www.w3schools.com/js/js_ajax_http_response.asp
                    // https://www.w3schools.com/jsref/prop_html_innerhtml.asp
                    document.getElementById("model").innerHTML = xmlhttp.responseText;
                    //  document.getElementById('models').innerHTML = ajax.responseText;
                }
            }
            // https://www.w3schools.com/js/js_ajax_http_send.asp
            xmlhttp.open("GET", "getCars.php?q=" + str, true);
            xmlhttp.send();
        }
    </script>
</head>

<body>
    <form id="carForm" name="carForm">
        <fieldset>
            <legend>Choose Your Car</legend>

            <label for="make">Make:</label>
            <select id="make" onchange="showCarModel(this.value)">
                <option value="">Select make</option>
                <option value="Ford">Ford</option>
                <option value="Honda">Honda</option>
                <option value="Mazda">Mazda</option>
                <option value="dummy">Dummy cars</option>
            </select>
            <br><br>
            <label for="model">Model:</label>
            <select id="model">
                <option value="">Select model</option>
            </select>
        </fieldset>
    </form>
</body>