<?php

// Things to notice:
// The main job of this script is to execute an INSERT statement to add the submitted username, password and email address
// However, the assignment specification tells you that you need more fields than this for each user.
// So you will need to amend this script to include them. Don't forget to update your database (create_data.php) in tandem so they match
// This script does client-side validation using "password","text" inputs and "required","maxlength" attributes (but we can't rely on it happening!)
// we sanitise the user's credentials - see helper.php (included via header.php) for the sanitisation function
// we validate the user's credentials - see helper.php (included via header.php) for the validation functions
// the validation functions all follow the same rule: return an empty string if the data is valid...
// ... otherwise return a help message saying what is wrong with the data.
// if validation of any field fails then we display the help messages (see previous) when re-displaying the form

// execute the header script:
require_once "credentials.php";
require_once "header.php";

// default values we show in the form:
$username = "";
$password = "";
$email = "";
$firstname = "";
$dob = "";
$lastname = "";
$telephone = "";

$dobs = "";
$firstnames = "";
$lastnames = "";
$usernames = "";
$passwords = "";
$emails = "";
$telephones = "";

$username_errors = "";
$password_errors = "";
$email_errors = "";
$firstname_errors = "";
$lastname_errors = "";
$telephone_errors = "";
$dob_errors = "";

$username_errors = $password_errors = $firstname_errors = $lastname_errors = $email_errors = $dob_errors = $telephone_errors = $errors = "";
// should we show the signup form?:
$show_signup_form = true;
// message to output to user:
$message = "";

if ($_SESSION['username'] == "admin") 
{
    // user just tried to sign up:

    // connect directly to our database (notice 4th argument) we need the connection for sanitisation:
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if (isset($_GET['add_user'])) 
    {

    $usernames = $_GET['username'];
    $passwords = $_GET['password'];
    $emails = $_GET['email'];
    $telephones = $_GET['telephone'];
    $firstnames = $_GET['firstname'];
    $lastnames = $_GET['lastname'];
    $dobs = $_GET['DOB'];

    $query = "INSERT INTO users (firstname, lastname, username, password, email, telephone, DOB) 
	VALUES ('$firstnames', '$lastnames', '$usernames', '$passwords', '$emails', '$telephones', '$dobs')";
    $result = mysqli_query($connection, $query);

        // no data returned, we just test for true(success)/false(failure):
    if ($result) 
    {
            // show a successful signup message:
        $message = "USER ADDED<br>";

    } else 
    {
        // show the fom:
        $show_signup_form = true;
        // show an unsuccessful signup message:
        $message = "NO USER ADDED<br>";
    }

        // if the connection fails, we need to know, so allow this exit:
        if (!$connection) 
        {
            die("Connection failed: " . $mysqli_connect_error);
        }
        mysqli_close($connection);
    }

} 
else 
{
    // just a normal visit to the page, show the signup form:
    $show_signup_form = true;
}

if ($show_signup_form) 
{
// show the form that allows users to sign up
// Note we use an HTTP POST request to avoid their password appearing in the URL:
echo <<<_END
<form action="insert.php" method="get">
  Please choose a username and password:<br>
  Username: <input type="text" name="username" maxlength="16" value="$username" required> $username_errors
  <br>
  Password: <input type="password" name="password" maxlength="16" value="$password" required> $password_errors
  <br>
  Email: <input type="email" name="email" maxlength="64" value="$email" required> $email_errors
  <br>
  First Name: <input type="text" name="firstname" maxlength="16" value="$firstname" required> $firstname_errors
  <br> 
  Last Name: <input type="text" name="lastname" maxlength="16" value="$lastname" required> $lastname_errors
  <br>
  D.O.B: <input type="DATE" name="DOB"  value="DOB" required> $dob_errors
  <br>
  Telephone: <input type="number" name="telephone" maxlength="16" value="$telephone" required> $telephone_errors
  <br>
  <input type="submit" name = "add_user"  value="Submit">
</form>	
_END;
}


// display our message to the user:
echo $message;

// finish off the HTML for this page:
require_once "footer.php";

?>

