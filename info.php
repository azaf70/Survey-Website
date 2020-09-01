<?php

// Things to notice:
// You need to add code to this script to implement the admin functions and features
// Notice that the code not only checks whether the user is logged in, but also whether they are the admin, before it displays the page content
// You can implement all the admin tools functionality from this script, or...

// execute the header script:
require_once "header.php";
// default values we show in the form:
$username = "";
$password = "";
$email = "";
$firstname = "";
$dob = "";
$lastname = "";
$telephone = "";
$usernames = "";
// strings to hold any validation error messages:
$username_val = "";
$password_val = "";
$email_val = "";
$firstname_val = "";
$lastname_val = "";
$telephone_val = "";


echo "Here are the details of user: " . $_GET['username'] . "</b> <br>";
// message to output to user:
$message = "";


if (!isset($_SESSION['loggedInSkeleton'])) 
{
    // user isn't logged in, display a message saying they must be:
    echo "You must be logged in to view this page.<br>";
} 
else {
    if ($_SESSION['username'] == "admin") 
    {

        $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
        if (!$connection) {
            die("connection failed" . $mysqli_connect_error);
        }

        $sql = "SELECT * FROM users WHERE username='{$_GET['username']}' ";
        $result = mysqli_query($connection, $sql);
        $n = mysqli_num_rows($result);
        //$sql = mysqli_query("DELETE * FROM users WHERE username='$username'");

        if ($n > 0) 
        {

echo <<<END
<style> 
table, th, td {border:0.5px solid black; align:center;}

th, td {
	text-align: left;
	padding: 10px;
}

tr:nth-child(even){background-color:#f96d6d}


th{
	background-color: #3f3f3e;
	color:white;
}

</style>
END;
            echo "<table cellpadding='2' cellspacing='2'>";
            echo "<tr><th>firstname</th></th><th>lastname</th>
			<th>username</th><th>password</th><th>email</th>
			<th>DOB</th><th>telephone</th></tr>";
            // loop over all rows, adding them into the table:
            for ($i = 0; $i < $n; $i++) {
                // fetch one row as an associative array (elements named after columns):
                $row = mysqli_fetch_assoc($result);
                // add it as a row in our table:
                echo "<tr>";
                echo "<td>{$row['firstname']}</td><td>{$row['lastname']}</td><td>{$row['username']}
				</td><td>{$row['password']}</td><td>{$row['email']}</td><td>{$row['DOB']}</td><td>{$row['telephone']}</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No user found";
        }

    }
}


require_once "footer.php";

?>