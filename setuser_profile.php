<?php

// execute the header script:
require_once "header.php";


$show_form=false;
// variables to help with validation processes
$errors="";
$profile['username'] = $profile['password'] = $profile['firstname'] = $profile['lastname'] = $profile['DOB'] = $profile['email'] = "";
// variables to help with validation processes
$password_errors = $firstname_errors = $lastname_errors = $age_errors = $DOB_errors = $email_errors ="";

// check that the user is still logged in
// if they're not, remind them to login and don't run any queries
if (!isset($_SESSION['loggedInSkeleton']))
    {
        // user isn't logged in, display a message saying they must be:
        echo "You must be logged in to view this page.<br>";
    }

    else {
        // user is already logged in, find their personal details from the members table and display:
        // connect directly to our database (notice 4th argument):
        $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

        // if the connection fails, we need to know, so allow this exit:
        if (!$connection) 
        {
            die("Connection failed: " . $mysqli_connect_error);
        }


        if (isset($_POST["password"])) {
            // the user has clicked the update button
            // take the data from the form (POST method)

            $newPassword = $_POST["password"];
            $newFirstname = $_POST["firstname"];
            $newLastname = $_POST["lastname"];
            $newDOB = $_POST["DOB"];
            $newEmail = $_POST["email"];

            /////////////////////////////////////////
            //////// SERVER-SIDE VALIDATION /////////
            /////////////////////////////////////////
            // First, sanitise the user input (functions in helper.php)
            $newPassword = sanitise($newPassword, $connection);
            $newFirstname = sanitise($newFirstname, $connection);
            $newLastname = sanitise($newLastname, $connection);
            $newDOB = sanitise($newDOB, $connection);

            // Next, validate the user input (functions in helper.php and in sol_helper.php - left to lab exercises)

            $password_errors = validateString($newPassword, 1, 16);
            $firstName_errors = validateString($newFirstname, 1, 16);
            $lastname_errors = validateString($newLastname, 1, 32);
            $DOB_errors = validateDOB($newDOB);
            // email validation also performs email specific sanitisation
            $email_errors = validateEmail($newEmail);
            // concatenate the errors from both validation calls
            $errors = $password_errors . $firstName_errors . $lastname_errors . $age_errors . $DOB_errors . $email_errors;

            // if there are no errors with the server-side validation, process the new favourite information
            if ($errors == "") 
            {
                // insert the user data into the DB
                $sql = "UPDATE users SET password='{$_POST["password"]}', firstname='{$_POST["firstname"]}', lastname='{$_POST["lastname"]}', DOB='{$_POST["DOB"]}', email='{$_POST["email"]}' WHERE username='{$_SESSION['username']}'";

                // no data returned, we just test for true(success)/false(failure):
                if (mysqli_query($connection, $sql)) 
                {
                    echo "<br>Profile Updated<br>";
                } 
                else 
                {
                    die("Error inserting row: " . mysqli_error($connection));
                }
            }

            else 
            {
                echo "<h3>Validation error</h3><br>";
            }
        }
        // prepare to show the user's profile data
        // find our particular, logged-in user
        $query = "SELECT * FROM users WHERE username='{$_SESSION['username']}'";

        // this query can return data ($result is an identifier):
        $result = mysqli_query($connection, $query);

        // how many rows came back?:
        $n = mysqli_num_rows($result);

        // check that there is some data to show
        if ($n > 0) 
        {
            // get the data back as an associative array
            // should be a single row of data - usernames are unique (primary key)!
            $profile = mysqli_fetch_assoc($result);

        }
        // the following run of IF statements change what is displayed in the form fields
        // so that user entered content is shown if the user has tried to make an update
        // this means any erroneous entries show up so they can be amended when SS validation occurs

        if (isset($_POST["password"])) 
        {
            $profile['password']=$_POST["password"];
        }

        if (isset($_POST["firstname"])) 
        {
            $profile['firstname']=$_POST["firstname"];
        }

        if (isset($_POST["lastname"])) 
        {
            $profile['lastname']=$_POST["lastname"];
        }

        if (isset($_POST["DOB"])) 
        {
            $profile['DOB']=$_POST["DOB"];
        }

        if (isset($_POST["email"])) 
        {
            $profile['email']=$_POST["email"];
        }

        // we're finished with the database, close the connection:
        mysqli_close($connection);

        $show_form = true;
    }

if ($show_form) 
{
    //displays the user's profile data in a table whic allows easy editing
    echo <<<_END
            <b>Edit your Profile Data: </b><br>
            <form action="setuser_profile.php" method="post">
            
            <table border="0" cellpadding="2">
                <tr>
                <td bgcolor="#f96d6d">Username: </td><td>{$profile['username']}</td>
                </tr>
                <tr>
                <td bgcolor="#e0f96d">Password: </td><td><input type="password" name="password" minlength="1" maxlength="16" value="{$profile['password']}" required><b>$password_errors</b></td> 
                </tr>
                <tr>
                <td bgcolor="#f96d6d">First name: </td><td><input type="text" minlength="1" maxlength="16" name="firstname" value="{$profile['firstname']}" required><b>$firstname_errors</b></td> 
                </tr>
                <tr>
                <td bgcolor="#e0f96d">Last name: </td><td><input type="text" minlength="1" maxlength="32" name="lastname" value="{$profile['lastname']}" required><b>$lastname_errors</b></td> 
                </tr>
                <tr>
                <td bgcolor="#f96d6d">Date of Birth: </td><td><input type="date" name="DOB" value="{$profile['DOB']}" required><b>$DOB_errors</b></td> 
                </tr>
                <tr>
                <td bgcolor="#e0f96d">Email: </td><td><input type="email" minlength="3" maxlength="128" name="email" value="{$profile['email']}" required><b>$email_errors</b></td> 
                </tr>
                
            </table>
    <br><input type="submit" value="Update">
</form>
<br>
<a href="changepassword.php">I need to change my password</a><br>
_END;
}

// finish off the HTML for this page:
require_once "footer.php";

?>