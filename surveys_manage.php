<?php

// execute the header script:
require_once "header.php";

//to ensure string have no values and are empty
$number_of_questions = "";
$survey_name = "";

//setting the variable username to the logged in user
$usernames = $_SESSION['username'];

$show_form = true;

//validations string
$survey_name_errors = "";
$number_of_questions_errors = "";

//connect directly to our database (notice 4th argument):
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// if the connection fails, we need to know, so allow this exit:
if (!$connection) 
{
	die("Connection failed: " . $mysqli_connect_error);
}

//the actual form which shows buttons 
if ($show_form) 
{
	echo <<<_END

	<form action="sample_survey.php?survey_id=5" method = "POST">
	<button name="sample_Survey" type="submit">A Sample Survey</button>
	</form>

	<form action="sample_answers.php?survey_id=5" method = "POST">
	<button name="sample_Answers" type="submit">View Sample Survey's Results</button>
	</form>
	<br>
	<br>
	<br>
	<br>
	</form>
	
	<form action="game_poll.php" method = "POST">
	<button name="poll" type="submit">A Poll Table</button>
	</form>
	<form action ="poll_results.php" method = "POST">
	<button name="poll" type="submit">Poll Results</button>
	<br>
	<br>
	<br>
    </form>

	<form action="surveys_manage.php" method="POST">
	
          Please answer all the questions to create a survey:<br>
          Name of the survey: <input type="text" maxlength="205" minlength="1" name="survey_name" value="$survey_name" required> <b>$survey_name_errors</b>
          <br>
          Number of Questions: <input type="number" min="1" max="20" name="number_of_questions" value="$number_of_questions" required> <b>$number_of_questions_errors</b>
          <br>
          <input type="submit" name = "create_survey" value="Submit">
	</form>    
	
	</br>
	</br>
	<form action="surveys_manage.php" method = "GET">
    <button name="show_table" type="submit" value="show_tab">Your Surveys</button>
    <button name="hide_table" type="submit" value="hide_tab">Hide Surveys</button>
    </form>
_END;

}
if (($_SESSION['username']== "admin"))
{
	if(isset($_GET['show_table']))
	{
	///$query = "SELECT * FROM surveys  WHERE username='{$_SESSION['username']}'";
	$query = "SELECT * FROM surveys";
	$result = mysqli_query($connection, $query);
	$n = mysqli_num_rows($result);
	if ($n > 0) 
	{
			echo "<table cellpadding='2' cellspacing='2'>";
			echo "<tr>
			<th>Survey Name</th> <th> Number of Questions </th> <th> Created By </th>  <th> Delete </th> <th>Edit</th> <th>Create Questions</th> <th>Take this Survey</th> <th>Show Answers</th>
			</tr>";
            // loop over all rows, adding them into the table:
			for ($i = 0; $i < $n; $i++) {
        // fetch one row as an associative array (elements named after columns):
				$row = mysqli_fetch_assoc($result);
		
        // add it as a row in our table:
				echo "<tr>";
				echo "<td>{$row['survey_name']}</td>";
				echo "<td>{$row['number_of_questions']}</td>";
				echo "<td>{$row['username']}</td>";
				echo "<td> <form  action = 'surveys_manage.php?show_table=show_tab' method='POST'> <button name ='delete_survey' value='{$row['survey_name']}'> Delete this Survey </button> </form> </td>";
				echo "<td><form  method='POST' action ='edit_surveys.php?survey_name={$row['survey_name']}&survey_id={$row['survey_id']}'> <button name ='edit_survey' value='{$row['survey_name']}'> Edit this Survey </button> </form> </td>";
				echo "<td><form  method='POST' action ='create_questions.php?survey_id={$row['survey_id']}&survey_name={$row['survey_name']}&number_of_questions={$row['number_of_questions']}'> <button name ='create_questions' value='{$row['number_of_questions']}'>Create Questions </button> </form> </td>";
				echo "<td><form  method='POST' action ='answer_surveys.php?survey_id={$row['survey_id']}&survey_name={$row['survey_name']}&number_of_questions={$row['number_of_questions']}'> <button name ='create_questions' value='{$row['number_of_questions']}'>Take this Survey </button> </form> </td>";
				echo "<td><form  method='POST' action ='answers.php?survey_id={$row['survey_id']}&survey_name={$row['survey_name']}&number_of_questions={$row['number_of_questions']}'> <button name ='answers' value='{$row['number_of_questions']}'>Show Answers </button> </form> </td>";
				echo "</tr>";
				echo $row['number_of_questions'];
			}
			echo "</table>";
		
	}
	echo "<br><br>";
	echo <<<END
<style> 
table, th, td {border:1px solid black; align:center};

th, td {
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

END;
	}
}

else
{
	if (isset($_GET['show_table'])) 
	{
	$query = "SELECT * FROM surveys WHERE username='{$_SESSION['username']}'";
	$result = mysqli_query($connection, $query);
	$n = mysqli_num_rows($result);
	if ($n > 0) 
	{
		echo "<table cellpadding='2' cellspacing='2'>";
		echo "<tr>
			<th>Survey Name</th> <th> Number of Questions </th>  <th> Delete </th> <th>Edit</th> <th>Create Questions</th> <th>Take this Survey</th> <th>Show Answers</th>
			</tr>";
            // loop over all rows, adding them into the table:
		for ($i = 0; $i < $n; $i++) 
		{
        // fetch one row as an associative array (elements named after columns):
		$row = mysqli_fetch_assoc($result);
		
        // add it as a row in our table:
			echo "<tr>";
			echo "<td>{$row['survey_name']}</td>";
			echo "<td>{$row['number_of_questions']}</td>";
			echo "<td> <form  action = 'surveys_manage.php?show_table=show_tab' method='POST'> <button name ='delete_survey' value='{$row['survey_name']}'> Delete this Survey </button> </form> </td>";
			echo "<td><form  method='POST' action ='edit_surveys.php?survey_name={$row['survey_name']}&survey_id={$row['survey_id']}'> <button name ='edit_survey' value='{$row['survey_name']}'> Edit this Survey </button> </form> </td>";
			echo "<td><form  method='POST' action ='create_questions.php?survey_id={$row['survey_id']}&survey_name={$row['survey_name']}&number_of_questions={$row['number_of_questions']}'> <button name ='create_questions' value='{$row['number_of_questions']}'>Create Questions </button> </form> </td>";
			echo "<td><form  method='POST' action ='answer_surveys.php?survey_id={$row['survey_id']}&survey_name={$row['survey_name']}&number_of_questions={$row['number_of_questions']}'> <button name ='create_questions' value='{$row['number_of_questions']}'>Take this Survey </button> </form> </td>";
			echo "<td><form  method='POST' action ='answers.php?survey_id={$row['survey_id']}&survey_name={$row['survey_name']}&number_of_questions={$row['number_of_questions']}'> <button name ='answers' value='{$row['number_of_questions']}'>Show Answers </button> </form> </td>";
			echo "</tr>";
			echo $row['number_of_questions'];
		}
		echo "</table>";
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
}
}

if (isset($_POST['delete_survey'])) 
{
	$row = mysqli_fetch_assoc($result);
	echo $query = "DELETE FROM surveyQuestions WHERE survey_id = '3' ";
	// $query = "SELECT * FROM surveyQuestions WHERE username='{$_SESSION['username']}' ";
	$results = mysqli_query($connection, $query);
    // $query = "SELECT * FROM answers WHERE username='{$_SESSION['username']}' ";
	// $results = mysqli_query($connection, $query);
	// $resultAns = mysqli_query($connection, $query);
	// if($results && $resultAns)
	// {

	
	// $rows = mysqli_fetch_assoc($results);
	// $rows = mysqli_fetch_assoc($resultAns);
	
	// echo $query = "DELETE FROM surveyQuestions WHERE username = '{$rows['username']}'";
	// echo $query = "DELETE FROM answers WHERE username = '{$rows['username']}'";
	// echo $query = "DELETE FROM surveys WHERE username = '{$rows['username']}'";
	// echo $query = "DELETE FROM users WHERE username = '{$rows['username']}'";
	// //echo $query;
	// $result = mysqli_query($connection, $query);
	// $result = mysqli_query($connection, $query);
	// $result = mysqli_query($connection, $query);
	// $result = mysqli_query($connection, $query);
	
	if ($result) 
	{
		echo "DELETED. Please refresh the page. ";
	} 
	else 
	{
		echo "<br>";
		echo "ERROR! Survey NOT DELETED";
	}
}



if (isset($_POST['edit_survey'])) 
{
	$query = "UPDATE FROM surveys WHERE survey_name = '{$_POST['edit_survey']}'";
	//echo $query;
	$result = mysqli_query($connection, $query);
	if ($result) 
	{
		echo ". Please refresh the page. ";

	} 
	else 
	{
		echo "<br>";
		echo "ERROR! Survey NOT DELETED";
	}
}



if (isset($_POST['create_survey']))
{
	$query = " INSERT INTO surveys (username, survey_name, number_of_questions) VALUES ('$usernames', '{$_POST['survey_name']}', '{$_POST['number_of_questions']}') ";
	$result = mysqli_query($connection, $query);

	if($result)
	{
		echo"Survey Created Successfully";
	}
	else{
		echo"Survey not Created";
	}
}

if (isset($_SESSION['loggedInSkeleton'])) 
{
	$show_form = true;

	if (isset($_POST['survey_name'])) 
	{
		$survey_name = $_POST['survey_name'];
		$number_of_questions = $_POST['number_of_questions'];

		$survey_name = sanitise($survey_name, $connection);
		$number_of_questions = sanitise($number_of_questions, $connection);

		$survey_name_errors = validateString($survey_name, 1, 100);
		$number_of_questions_errors = validateString($number_of_questions, 1, 20);

		$errors = $survey_name_errors . $number_of_questions_errors;

		if ($errors == "") 
		{
			$query = "SELECT * FROM surveys WHERE username='{$_SESSION['username']}'";
			$result = mysqli_query($connection, $query);
			$n = mysqli_num_rows($result);
			if ($n > 0) 
			{
				echo "<table cellpadding='2' cellspacing='2'>";
				echo "<tr>
			<th>survey name</th> <th> num qs </th>
			</tr>";
            // loop over all rows, adding them into the table:
				for ($i = 0; $i < $n; $i++) 
				{
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

END;

        // otherwise, if server-side validation fails, report this via the browser

mysqli_close($connection);
}	
// finish of the HTML for this page:
require_once "footer.php";
?>