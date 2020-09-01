
<?php

// Things to notice:
// This script builds upon the client-side version of set profile cv_set_profile.php
// It performs server-side validation in addition to client-side validation
// The external helper.php is being used for String and Int validation as before
// An additional sol_helper.php has been added that contains additional features
// Like email and rating validations functions

// execute the header script:
require_once "header.php";

// variables to help with validation processes
$show_form = false;
$errors = "";
$profile['survey_name'] = $profile['number_of_questions'] = "";
$survey_name_errors = $number_of_questions_errors = "";

// check that the user is still logged in
// if they're not, remind them to login and don't run any queries
if (!isset($_SESSION['loggedInSkeleton'])) {
        // user isn't logged in, display a message saying they must be:
    echo "You must be logged in to view this page.<br>";
} else {

        // user is already logged in, find their personal details from the members table and display:
        // connect directly to our database (notice 4th argument):
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

        // if the connection fails, we need to know, so allow this exit:
    if (!$connection) {
        die("Connection failed: " . $mysqli_connect_error);
    }


    if (isset($_POST["survey_name"])) {
            // the user has clicked the update button
            // take the data from the form (POST method)

        $newName = $_POST["survey_name"];
        $newQuestions = $_POST["number_of_questions"];
        

            /////////////////////////////////////////
            //////// SERVER-SIDE VALIDATION /////////
            /////////////////////////////////////////
            // First, sanitise the user input (functions in helper.php)
        $newName = sanitise($newName, $connection);
        $newQuestions = sanitise($newQuestions, $connection);

            // Next, validate the user input (functions in helper.php and in sol_helper.php - left to lab exercises)

        $number_of_questions_errors = validateString($newQuestions, 1, 30);
        $survey_name_errors = validateString($newName, 1, 20);
        
            // email validation also performs email specific sanitisation
        
            // concatenate the errors from both validation calls
        $errors = $survey_name_errors . $number_of_questions_errors;

            // if there are no errors with the server-side validation, process the new favourite information
        if ($errors == "") {
            echo $_GET['survey_name'];
                // insert the user data into the DB
            $sql = "UPDATE surveys SET survey_name='{$_POST["survey_name"]}', number_of_questions='{$_POST["number_of_questions"]}' WHERE survey_name='{$_GET['survey_name']}' ";
            echo $sql;


                // no data returned, we just test for true(success)/false(failure):
            if (mysqli_query($connection, $sql)) {
                echo "<br>Survey Updated<br>";
            } else {
                die("Error inserting row: " . mysqli_error($connection));
            }
        } else {
            echo "<h3>Questions error</h3><br>";
        }
    }
        // prepare to show the user's profile data
        // find our particular, logged-in user
    $query = "SELECT * FROM surveys WHERE survey_name='{$_GET['survey_name']}'";

        // this query can return data ($result is an identifier):
    $result = mysqli_query($connection, $query);

        // how many rows came back?:
    $n = mysqli_num_rows($result);

        // check that there is some data to show
    if ($n > 0) {

            // get the data back as an associative array
            // should be a single row of data - usernames are unique (primary key)!
        $profile = mysqli_fetch_assoc($result);

    }

        // the following run of IF statements change what is displayed in the form fields
        // so that user entered content is shown if the user has tried to make an update
        // this means any erroneous entries show up so they can be amended when SS validation occurs

    if (isset($_POST["survey_name"])) {
        $profile['survey_name'] = $_POST["survey_name"];
    }

    if (isset($_POST["number_of_questions"])) {
        $profile['number_of_questions'] = $_POST["number_of_questions"];
    }


        // we're finished with the database, close the connection:
    mysqli_close($connection);

    $show_form = true;
}


if ($show_form) {
    // display the user's profile data in a table for easy editing
    echo <<<_END
            <b>Edit your Survey: </b><br>
            <form action="http://localhost:8080/phpAssignment/edit_surveys.php?survey_name={$_GET['survey_name']}" method="post">
            
            <table border="0" cellpadding="2">
                <tr>
                    <td bgcolor="#e0f96d">Survey Name: </td><td><input type="text" name="survey_name" value="{$profile['survey_name']}" required><b>$survey_name_errors</b></td> 
                </tr>
                <tr>
                    <td bgcolor="#f96d6d">Number of Questions: </td><td><input type="text" " name="number_of_questions" value="{$profile['number_of_questions']}" required><b>$survey_name_errors</b></td> 
                </tr>
                
            </table>
    <br><input type="submit" value="Update">
</form>
_END;
}
echo "{$_GET['survey_name']}";


// finish off the HTML for this page:
require_once "footer.php";

?>


