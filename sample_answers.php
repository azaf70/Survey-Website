<?php
require_once "header.php";
//$usernames = $_SESSION['username'];
$message = "";

//$usernames = $_SESSION['username'];

if (!isset($_SESSION['loggedInSkeleton'])) {
        // user isn't logged in, display a message saying they must be:
    echo "You must be logged in to view this page.<br>";
} 
else 
{
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
echo "Welcome ", $_SESSION['username'];


if ($_SESSION['username'] == "admin") {
    $query = "SELECT * FROM sampleQuestions";
    $result = mysqli_query($connection, $query);
    $n = mysqli_num_rows($result);
	 
	 
	  // if we got some results then show them in a table:
    if ($n > 0) {
        echo <<<_END
<style> 
table, th, td {border:1px solid black; align:center;}

th, td {
	text-align:left;
	padding: 10px;

}

tr:nth-child(even){background-color:#f96d6d}
tr:nth-child(odd){background-color:#e0f96d}

th{
	background-color: #3f3f3e;
	color:white;
}
</style>
_END;

        echo "<table cellpadding='2' cellspacing='2'>";
        echo "<tr><th>Question</th><th>Answer</th><th>Username</th></tr>";
		
		// loop over all rows, adding them into the table:
        for ($i = 0; $i < $n; $i++) 
        {
           
            // fetch one row as an associative array (elements named after columns):
            $row = mysqli_fetch_assoc($result);
            $usernames = $row['username'];
            // add it as a row in our table:
            echo "<tr>";
            echo "<td>{$row['sample_question']}</td><td>{$row['sample_answer']}</td><td>{$usernames}</td>";
            echo "</tr>";
        }
        echo "</table>";

    }
} 
else {
    $usernames = $_SESSION['username'];
    $query = "SELECT * FROM sampleQuestions WHERE username = '$usernames' ";
    $result = mysqli_query($connection, $query);
    $n = mysqli_num_rows($result);
	 
	 
	  // if we got some results then show them in a table:
    if ($n > 0) {
        echo <<<_END
<style> 
table, th, td {border:1px solid black; align:center;}

th, td {
	text-align:left;
	padding: 10px;

}

tr:nth-child(even){background-color:#f96d6d}
tr:nth-child(odd){background-color:#e0f96d}

th{
	background-color: #3f3f3e;
	color:white;
}
</style>
_END;
        echo "<table cellpadding='2' cellspacing='2'>";
        echo "<tr><th>Questions</th><th>Answers</th></tr>";
		
		// loop over all rows, adding them into the table:
        for ($i = 0; $i <$n; $i++)
        {
            $n= 5;
            // fetch one row as an associative array (elements named after columns):
            $row = mysqli_fetch_assoc($result);
            // add it as a row in our table:
            echo "<tr>";
            echo "<td>{$row['sample_question']}</td><td>{$row['sample_answer']}</td>";
            echo "</tr>";
        }
        echo "</table>";


    }
}
}

?>