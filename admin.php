<?php

// Things to notice:
// You need to add code to this script to implement the admin functions and features
// Notice that the code not only checks whether the user is logged in, but also whether they are the admin, before it displays the page content
// You can implement all the admin tools functionality from this script, or...

// execute the header script:
require_once "header.php";

// to make sure that the value in the form of these variables are empty
$username = "";
$password = "";
$email = "";
$firstname = "";
$lastname = "";
$telephone = "";
$dob = "";

//strings to hold any validation error message
$username_errors = "";
$password_errors  = "";
$email_errors  = "";
$firstname_errors  = "";
$lastname_errors  = "";
$telephone_errors  = "";
$dob_errors  = "";

// strings to hold any validation error messages:


if (!isset($_SESSION['loggedInSkeleton']))
{	
	// user isn't logged in, display a message saying they must be:
	echo "You must be logged in to view this page.<br>";
}
else
{
	// only display the page content if this is the admin account (all other users get a "you don't have permission..." message):
	if ($_SESSION['username'] == "admin")
	{

	//connection
	$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	//to show an error message if something is wrong with the connection
	if (!$connection) 
	{
		//error message
		die("connection failed" . $mysqli_connect_error);
	}
	    //query used to show info in the tables
		$query = "SELECT * FROM users";
		//execution
		$result = mysqli_query($connection, $query);
		//counting the number of rows and cgecking if it has data
		$n = mysqli_num_rows($result);
		
		
        //ensures that everything iside it works only if it has a data
		if ($n > 0) 
		{
			//styling
			echo "<table cellpadding='2' cellspacing='2'>";
			echo "<tr> <th>username</th> </tr>";
            // loop over all rows, adding them into the table:
			for ($i = 0; $i < $n; $i++) 
			{
                // fetch one row as an associative array (elements named after columns):
				$row = mysqli_fetch_assoc($result);
                // add it as a row in our table:
				echo "<tr>";
				echo "<td><a href='http://localhost:8080/phpAssignment/info.php?username={$row['username']}' '>" . "{$row['username']}" . "</td></td>";
				echo "</tr>";
			}
			echo "</table>";
		}

	}
	else
	{
		echo "You don't have permission to view this page...<br>";
	}
}

echo "<br><br>";
echo <<<END
<style> 
table, th, td {border:1px solid black; align:center;}

th, td 
{
	text-align:left;
	padding: 10px;

}

tr:nth-child(even){background-color:#f96d6d}
tr:nth-child(odd){background-color:#e0f96d}

th
{
	background-color: #3f3f3e;
	color:white;
}
</style>
<form action="admin.php" method="GET">
DELETE A User:<input type="text" name="username" maxlength="16">
<button name="button_delete" type="submit" value="Delete User">Delete</button>
</form>	
END;

// Button action. So when delete is presses the query is run
if (isset($_GET['button_delete'])) 
{
	//Delete query
	$sql = "DELETE FROM users WHERE username='{$_GET['username']}'";
	//
	$result = mysqli_query($connection, $sql);
    //counting the number of rows and cgecking if it has data
	if ($result) 
	{
		//refreshes the page
		header("Location: " . $_SERVER['PHP_SELF']);
		echo "$username DELETED";
	} 
	else 
	{
		echo "ERROR! USERNAME NOT DELETED";
	}
}

echo "<br><br>";
echo <<<END
<form action="insert.php">
<button name="user_button" type="submit" value="Delete User">CREATE A NEW USER</button>
</form>
<br>
<form action="updateButton.php">
<button name="update_button" type="submit" value="Update">Update User</button>
</form>
<br>
<form action="changepassword.php">
<button name="change_password" type="submit" value="change">Change Password</button>
</form>
END;


// finish off the HTML for this page
require_once "footer.php";
?>