<?php
require_once "header.php";
echo "<h2>Favourite Games  (Poll Table)</h2>";

if(isset($_GET['vote']))
{
    $voteTitle = $_GET['vote'];
    $countVote = "";
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$connection)
    {
        die("Connection failed: " . $mysqli_connect_error);
    }

$updatePoll = "UPDATE poll SET votes = votes + 1 WHERE game = '$voteTitle'";
if (mysqli_query($connection, $updatePoll)) 
{
        echo "Vote Casted! Your participation is Appreciated.";
} else 
{
        die("Error inserting your Vote: " . mysqli_error($connection));
}

}

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$connection)
    {
        die("Connection failed: " . $mysqli_connect_error);
    }

$pollQuery = "SELECT * FROM poll WHERE game IS NOT NULL";
$result = mysqli_query($connection, $pollQuery);

$n = mysqli_num_rows($result);
if ($n > 0) {
    // just a bit of CSS to make the table clearly visible:
echo <<<_END
echo "<br><br>";

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

 <table cellpadding='2' cellspacing='2'>
<tr>
	<th>Games</th> <th>Comments</th> <th>Votes</th>  <th>Caste Your Vote</th>
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
    else {
        echo "Problem occurred!<br>";
    }
require_once "footer.php";
?>