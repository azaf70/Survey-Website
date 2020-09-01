<?php

// execute the header script:
require_once "header.php";

// strings to hold any validation error messages:

if (!isset($_SESSION['loggedInSkeleton'])) {
    // user isn't logged in, display a message saying they must be:
    echo "You must be logged in to view this page.<br>";
} else {
    // only display the page content if this is the admin account (all other users get a "you don't have permission..." message):
    if ($_SESSION['username'] == "admin") {
        $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

        if (!$connection) {
            die("connection failed" . $mysqli_connect_error);
        }


        $query = "SELECT * FROM users";
        $result = mysqli_query($connection, $query);
        $n = mysqli_num_rows($result);
        if ($n > 0) {
            echo "<table cellpadding='2' cellspacing='2'>";
            echo "<tr>
			<th>username</th>
			</tr>";
            // loop over all rows, adding them into the table:
            for ($i = 0; $i < $n; $i++) {
                // fetch one row as an associative array (elements named after columns):
                $row = mysqli_fetch_assoc($result);
                // add it as a row in our table:
                echo "<tr>";
                //echo "<td>{$row['username']}</td>";
                echo "<td><a href='http://localhost:8080/phpAssignment/info.php?username={$row['username']}' '>" . "{$row['username']}" . "</td></td>";
                echo "</tr>";
            }
            echo "</table>";
        }

        echo "<br><br>";
        echo <<<END
<style> 
table, th, td {border:1px solid black; align:center;}

th, td {
	text-align: left;
	padding: 10px;

}

tr:nth-child(even){background-color:#f96d6d}
tr:nth-child(odd){background-color:#e0f96d}

th{
	background-color: #3f3f3e;
	color:white;
}
</style>


Please type in the username and the attribute you would like to change:<br>
<form action="updateButton.php" method = "POST">
 
  Username: <input type="text" name="username_upd"> 
  <br>
 Attribute: <input type="text" name="atr_upd" >
  <br>
 Change To: <input type="text" name="changed_atr"> 
 <button name = "update" type = "submit" value="update"> Update </button>
 <br>
 </form>
 
 
  <br>
END;
        if (isset($_POST['update'])) {
            $sql = "UPDATE users SET {$_POST['atr_upd']} ='{$_POST['changed_atr']}' WHERE username ='{$_POST['username_upd']}'";
            //$sql = "UPDATE users SET {$_POST['attribute']} ='{$_POST['changed_attribute']}' WHERE $username = '{$_POST['username']} '";
            $result = mysqli_query($connection, $sql);
            //$sql = mysqli_query("DELETE * FROM users WHERE username='$username'");

            if ($result) {
                //header("Location: ".$_SERVER['PHP_SELF']);
                echo "details have been updated";
            } else {
                echo "ERROR! An error has occured. User details couldn't be changed.";
            }

        }
/*
if(isset($_POST['username']))
{
    $sql = "UPDATE users SET {$_POST['attribute']} = '{$_POST['changed_attribute']}' WHERE username = '{$_POST['username']}'";
    //$sql = "UPDATE users SET {$_POST['attribute']} ='{$_POST['changed_attribute']}' WHERE $username = '{$_POST['username']} '";
    $result = mysqli_query($connection,$sql);
    //$sql = mysqli_query("DELETE * FROM users WHERE username='$username'");

    if($result)
    {
        //header("Location: ".$_SERVER['PHP_SELF']);
        echo "details have been updated";
    }

    else {
        echo "ERROR! An error has occured. User details couldn't be changed.";
    }

}
         */
        mysqli_close($connection);

    } else {
        echo "You don't have permission to view this page...<br>";
    }

}
require_once "footer.php";

?>