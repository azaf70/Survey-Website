<?php

//header 
require_once "header.php";

//Shows you the main title
echo <<<_END
<h2> Favourite Games  (Poll Table)</h2>
_END;

//custom message
$message = "Thank you for participating in this Survey. Would you like to see results in more detail?";

//vote button 
if(isset($_GET['vote']))
{
    $voteTitle = $_GET['vote'];
    $countVote = "";
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
//if there is no connection then shows an error message
if (!$connection)
    {
        die("Connection failed: " . $mysqli_connect_error);
    }
//updates the poll value
    $updatePoll = "UPDATE poll SET votes = votes + 1 WHERE game = '{$_GET['vote']}'";
    $result = mysqli_query($connection, $updatePoll);

//if query is working
if ($result)
{
    echo $message;
    echo <<<_END
    <form method = "POST" action = "poll_results.php">
    <button name="results">Click Here</button>
    </form>
_END;
} else 
{
    echo"Vote could not be casted";
}
header ("Location: game_poll.php");
}

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$connection)
    {
        die("Connection failed: " . $mysqli_connect_error);
    }

// query to show the table 
$pollQuery = "SELECT * FROM poll WHERE game IS NOT NULL";
$result = mysqli_query($connection, $pollQuery);

//counts the number of rows
$n = mysqli_num_rows($result);
if ($n > 0) 
{
// just a bit of CSS to make the table clearly visible:
echo <<<_END

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

<table cellpadding='2' cellspacing='2'>
<tr>
	<th>Games</th> <th>Comments</th> <th>Votes</th> <th>Cast Your Vote</th>
</tr>
<form action="game_poll.php" method="GET">
_END;

for($i = 0; $i < $n; $i++)
{
$row = mysqli_fetch_assoc($result);
echo "<tr>";
echo "<td>{$row['game']}</td><td>{$row['comments']}</td><td>{$row['votes']}</td><td><button name=\"vote\" value=\"{$row['game']}\">Vote!</button></td>";
echo "</tr>";
}
    echo "</form>";
    echo "</table>";
}
    // if anything else happens indicate a problem
    else 
    {
        echo "Problem occurred!<br>";
    }
require_once "footer.php";
?>