<?php

// Things to notice:
// You need to add code to this script to implement the admin functions and features
// Notice that the code not only checks whether the user is logged in, but also whether they are the admin, before it displays the page content
// You can implement all the admin tools functionality from this script, or...

// execute the header script:
require_once "header.php";

if (!isset($_SESSION['loggedInSkeleton'])) {
	// user isn't logged in, display a message saying they must be:
    echo "You must be logged in to view this page.<br>";
} else {
	// only display the page content if this is the admin account (all other users get a "you don't have permission..." message):
    if ($_SESSION['username']) {
        $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

        if (!$connection) {
            die("connection failed" . $mysqli_connect_error);
        }
        $query = "SELECT * FROM surveys";
        $result = mysqli_query($connection, $query);
        $n = mysqli_num_rows($result);



        if ($n > 0) {
            echo "<table cellpadding='2' cellspacing='2'>";
            echo "<tr>
			<th>survey name</th> <th> num qs </th>
			</tr>";
            // loop over all rows, adding them into the table:
            for ($i = 0; $i < $n; $i++) {
                // fetch one row as an associative array (elements named after columns):
                $row = mysqli_fetch_assoc($result);
                // add it as a row in our table:
                echo "<tr>";
                echo "<td>{$row['survey_name']}</td>";
                echo "<td>{$row['number_of_questions']}</td>";
                echo "</tr>";
            }
            echo "</table>";
        }

    } else {
        echo "You don't have permission to view this page...<br>";
    }
}

echo "<br><br>";
echo <<<END
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

END;
// finish off the HTML for this page:
require_once "footer.php";
?>