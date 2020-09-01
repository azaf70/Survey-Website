<?php

// execute the header script:
require_once "header.php";
require_once "credentials.php";

// create the basic HTML and form on the page
echo <<<_END
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
 <h3>Change User Password</h3>
 <form action="changepassword.php" method="post">
     <table>
     <tr><td>Enter a username: </td> <td><input type="text" maxlength="16" minlength="1" name="username" required></td></tr>
     <tr><td>Enter current password: </td> <td><input type="password" minlength="1" name="currentPW" required></td></tr>
     <tr><td>Enter new password: </td> <td><input type="password" minlength="1" name="newPW" required></td></tr>
     <td><input type="submit" value="Change Password"></td>
    </table>
</form>
<br><div id='results'></div>

_END;

// the user has just submitted the form to try to call the password . php API
// they should have included a username, current password and a new password
if (isset($_POST['username']) && isset($_POST['currentPW']) && isset($_POST['newPW'])) 
{
    $username = $_POST['username'];
    $currentPW = $_POST['currentPW'];
    $newPW = $_POST['newPW'];


    // connect directly to our database (notice 4th argument):
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    // if the connection fails, we need to know, so allow this exit:
    if (!$connection) {
        die("Connection failed: " . $mysqli_connect_error);
    }
    /////////////////////////////////////////
    //////// SERVER-SIDE VALIDATION /////////
    /////////////////////////////////////////
    $errors = "";
    // First, sanitise the user input (functions in helper.php)
    $username = sanitise($username, $connection);
    $currentPW = sanitise($currentPW, $connection);
    $newPW = sanitise($newPW, $connection);
    // Next, validate the user input (functions in helper.php)
    $username_errors = validateString($username, 1, 16);
    $currentPW_errors = validateString($currentPW, 1, 16);
    $newPW_errors = validateString($newPW, 1, 16);
    // concatenate the errors from both validation calls
    $errors = $username_errors . $currentPW_errors . $newPW_errors;

    if ($errors == "") 
    {

        // execute the client request to the API using JQuery
    echo <<<_END
        <script>
        // wait for the script to load in the browser
        $(document).ready(function()
        {
            var requestData = {};
            requestData['username'] = '$username';
            requestData['currentPW'] = '$currentPW';
            requestData['newPW'] = '$newPW';     
                
            console.log(requestData['username']);
            console.log(requestData['currentPW']);
            console.log(requestData['newPW']);
                
            // run the getJSON query, sending the username from the HTML form
            $.post('password.php', requestData)
            .done(function(data) 
            {
                // debug message to help during development:
                console.log('password change request successful');
                // show the result from the API in the field named 'results' in the page HTML
                $('#results').append("<b>Password updated </b>" + "<br>");     
            })
                        
            .fail(function(jqXHR) 
            {
                // debug message to help during development:
                console.log('request returned failure, HTTP status code ' + jqXHR.status);
                // display some error text on the page
                $('#results').append("<b>Update failed</b> <br>");
            })
            .always(function() 
            {
                // debug message to help during development:
			    console.log('request completed');
                
            });
        });
        </script>
_END;

    
} 
else 
{
    echo "<br>Server-side validation failed<br>";
}

}

// execute the footer script:
require_once "footer.php";

?>