<?php

// read in the details of our MySQL server:
require_once "credentials.php";

// We'll use the procedural (rather than object oriented) mysqli calls

// connect to the host:
$connection = mysqli_connect($dbhost, $dbuser, $dbpass);

// exit the script with a useful message if there was an error:
if (!$connection)
{
	die("Connection failed: " . $mysqli_connect_error);
}

// build a statement to create a new database:
$sql = "CREATE DATABASE IF NOT EXISTS " . $dbname;

// no data returned, we just test for true(success)/false(failure):
if (mysqli_query($connection, $sql)) 
{
	echo "Database created successfully, or already exists<br>";
} 
else 
{
	die("Error creating database: " . mysqli_error($connection));
}



// connect to our database:
mysqli_select_db($connection, $dbname);


///////////////////////////////////////////
///////////////////////////////////////////
 ///////////////////////////////////////////
////////////// DROP TABLES //////////////
///////////////////////////////////////////
///////////////////////////////////////////
///////////////////////////////////////////

///////////////////////////////////////////
//////////////DROP Poll Table //////////////
///////////////////////////////////////////
// if there's an old version of our table, then drop it:
$sql = "DROP TABLE IF EXISTS poll";
//$sql = "DROP TABLE IF EXISTS surveys";

// no data returned, we just test for true(success)/false(failure):
if (mysqli_query($connection, $sql)) 
{
	echo "Dropped existing table: poll table<br>";
} 
else 
{
	die("Error checking for existing poll table: " . mysqli_error($connection));
}

///////////////////////////////////////////
//////////////DROP answers //////////////
///////////////////////////////////////////
// if there's an old version of our table, then drop it:
$sql = "DROP TABLE IF EXISTS answers";
//$sql = "DROP TABLE IF EXISTS surveys";

// no data returned, we just test for true(success)/false(failure):
if (mysqli_query($connection, $sql)) 
{
	echo "Dropped existing table: answers<br>";
} 
else 
{
	die("Error checking for existing table: " . mysqli_error($connection));
}



///////////////////////////////////////////
//////////////DROP sampleQuestions //////////////
///////////////////////////////////////////
// if there's an old version of our table, then drop it:
$sql = "DROP TABLE IF EXISTS sampleQuestions";
//$sql = "DROP TABLE IF EXISTS surveys";

// no data returned, we just test for true(success)/false(failure):
if (mysqli_query($connection, $sql)) 
{
	echo "Dropped existing table: sample questions<br>";
} 
else 
{
	die("Error checking for existing table: " . mysqli_error($connection));
}




///////////////////////////////////////////
//////////////DROP surveyQuestions //////////////
///////////////////////////////////////////
// if there's an old version of our table, then drop it:
$sql = "DROP TABLE IF EXISTS surveyQuestions";
//$sql = "DROP TABLE IF EXISTS surveys";

// no data returned, we just test for true(success)/false(failure):
if (mysqli_query($connection, $sql)) 
{
	echo "Dropped existing table: survey questions<br>";
} 
else 
{
	die("Error checking for existing table: " . mysqli_error($connection));
}


///////////////////////////////////////////
//////////////DROP Surveys //////////////
///////////////////////////////////////////
$sql = "DROP TABLE IF EXISTS surveys";
//$sql = "DROP TABLE IF EXISTS surveys";

// no data returned, we just test for true(success)/false(failure):
if (mysqli_query($connection, $sql)) 
{
	echo "Dropped existing table: surveys<br>";
} 
else 
{
	die("Error checking for existing table: " . mysqli_error($connection));
}


///////////////////////////////////////////
//////////////DROP users //////////////
///////////////////////////////////////////
// if there's an old version of our table, then drop it:
$sql = "DROP TABLE IF EXISTS users";
//$sql = "DROP TABLE IF EXISTS surveys";

// no data returned, we just test for true(success)/false(failure):
if (mysqli_query($connection, $sql)) {
	echo "Dropped existing table: users<br>";
} 
else 
{
	die("Error checking for existing table: " . mysqli_error($connection));
}


///////////////////////////////////////////
///////////////////////////////////////////
 ///////////////////////////////////////////
////////////// CREATE TABLES //////////////
///////////////////////////////////////////
///////////////////////////////////////////
///////////////////////////////////////////


///////////////////////////////////////////
//////////////CREATE Users //////////////
///////////////////////////////////////////
$sql = "CREATE TABLE users (firstname VARCHAR(32), lastname VARCHAR(64), username VARCHAR(16),
password VARCHAR(16), email VARCHAR (64), DOB Date, telephone VARCHAR(16), PRIMARY KEY (username))";
// no data returned, we just test for true(success)/false(failure):
if (mysqli_query($connection, $sql)) 
{
	echo "Table created successfully: users<br>";
} 
else 
{
	die("Error creating table: " . mysqli_error($connection));
}

///////////////////////////////////////////
//////////////CREATE Surveys //////////////
///////////////////////////////////////////
$sql = "CREATE TABLE surveys (survey_id INT(3) AUTO_INCREMENT, username VARCHAR(16), survey_name VARCHAR(100), number_of_questions INT(3),PRIMARY KEY (survey_id), FOREIGN KEY (username) REFERENCES users (username) ON UPDATE CASCADE ON DELETE SET NULL)";
// no data returned, we just test for true(success)/false(failure):
if (mysqli_query($connection, $sql)) 
{
	echo "Table created successfully: surveys<br>";
} 
else 
{
	die("Error creating table: " . mysqli_error($connection));
}


///////////////////////////////////////////
//////////////CREATE SurveyQuestions //////////////
///////////////////////////////////////////
$sql = "CREATE TABLE surveyQuestions (question_id INT(3) AUTO_INCREMENT, question_no INT(3), question_type VARCHAR(50), question VARCHAR(100),survey_id INT(3), response VARCHAR(50) , PRIMARY KEY (question_id), FOREIGN KEY (survey_id) REFERENCES surveys (survey_id)ON UPDATE CASCADE ON DELETE SET NULL)";
// no data returned, we just test for true(success)/false(failure):
if (mysqli_query($connection, $sql)) 
{
	echo "Table created successfully: survey questions<br>";
} 
else 
{
	die("Error creating table: " . mysqli_error($connection));
}

///////////////////////////////////////////
//////////////CREATE Sample Questions //////////////
///////////////////////////////////////////

$sql = "CREATE TABLE sampleQuestions (question_id INT(3) not null auto_increment, survey_id INT(3), sample_question VARCHAR(50), sample_answer VARCHAR(90), username VARCHAR(16),PRIMARY KEY (question_id), FOREIGN KEY (username) REFERENCES users (username), FOREIGN KEY (survey_id) REFERENCES surveys (survey_id) ON UPDATE CASCADE ON DELETE SET NULL)";
// no data returned, we just test for true(success)/false(failure):
if (mysqli_query($connection, $sql)) 
{
	echo "Table created successfully: sample questions<br>";
} 
else 
{
	die("Error creating table: " . mysqli_error($connection));
}

///////////////////////////////////////////
//////////////CREATE Answers //////////////
///////////////////////////////////////////

$sql = "CREATE TABLE answers (answer_id INT(3) not null auto_increment, survey_id INT(3), question_id INT(3), username VARCHAR(16), answer VARCHAR(100) ,PRIMARY KEY (answer_id), FOREIGN KEY (question_id) REFERENCES surveyQuestions (question_id), FOREIGN KEY (survey_id) REFERENCES surveyQuestions (survey_id), FOREIGN KEY (username) REFERENCES users (username) ON UPDATE CASCADE ON DELETE SET NULL)";
// no data returned, we just test for true(success)/false(failure):
if (mysqli_query($connection, $sql)) 
{
	echo "Table created successfully: answers<br>";
} 
else 
{
	die("Error creating table: " . mysqli_error($connection));
}


///////////////////////////////////////////
//////////////CREATE Poll //////////////
///////////////////////////////////////////

$sql = "CREATE TABLE poll (game VARCHAR(100), comments VARCHAR(50),votes INT UNSIGNED default 0,username VARCHAR(16), PRIMARY KEY (game), FOREIGN KEY (username) REFERENCES users (username) ON UPDATE CASCADE ON DELETE SET NULL)";
// no data returned, we just test for true(success)/false(failure):
if (mysqli_query($connection, $sql)) 
{
	echo "Table created successfully: Poll<br>";
} 
else 
{
	die("Error creating POLL table: " . mysqli_error($connection));
}





///////////////////////////////////////////
///////////////////////////////////////////
 ///////////////////////////////////////////
////////////// CREATE DATA //////////////
///////////////////////////////////////////
///////////////////////////////////////////
///////////////////////////////////////////


///////////////////////////////////////////
//////////////USERS Data//////////////
///////////////////////////////////////////

$firstnames[] = 'barry'; $lastnames[] = 'g'; $usernames[] = 'barryg'; $passwords[] = 'letmein'; $emails[] = 'barryg@domain.com'; $DOBs[] = '2000-12-29'; $telephones[] = '037389300';
$firstnames[] = 'mandy'; $lastnames[] = 'lousie'; $usernames[] = 'mandyb'; $passwords[] = 'abc123'; $emails[] = 'mandy@mandy-g.co.uk'; $DOBs[] = '1999-10-10'; $telephones[] = '075749200932';
$firstnames[] = 'timmy'; $lastnames[] = 'g'; $usernames[] = 'timmy'; $passwords[] = 'secret95'; $emails[] = 'timmy@timmy.com'; $DOBs[] = '1890-01-30'; $telephones[] = '07274257182';
$firstnames[] = 'brian'; $lastnames [] = 'g'; $usernames[] = 'briang'; $passwords[] = 'password'; $emails[] = 'brian@briang.com'; $DOBs[] = '1999-12-06'; $telephones[]= '0623683993';
$firstnames[] = 'test1'; $lastnames[] = 'test1'; $usernames[] = 'test1'; $passwords[] = 'test123'; $emails[] = 'test1@test.com'; $DOBs[] = '2000-03-10'; $telephones[] = '06389297363';
$firstnames[] = 'test2'; $lastnames[] = 'test2'; $usernames[] = 'test2'; $passwords[] = 'test123'; $emails[] = 'test2@test.com'; $DOBs[] = '1890-07-29'; $telephones[] = '0839302883';
$firstnames[] = 'test3'; $lastnames[] = 'test3'; $usernames[] = 'test3'; $passwords[] = 'test123'; $emails[] = 'test3@test.com'; $DOBs[] = '2001-03-11'; $telephones[] = '08483938933';
$firstnames[] = 'test4'; $lastnames[] = 'test4'; $usernames[] = 'test4'; $passwords[] = 'test123'; $emails[] = 'test4@alphabet.test.com'; $DOBs[] = '1998-12-03'; $telephones[] = '075273999323';
$firstnames[] = 'asni'; $lastnames[] = 'rutno'; $usernames[] = 'aski'; $passwords[] = 'test123'; $emails[] = 'asnis@m-domain.com'; $DOBs[] = '2011-03-22'; $telephones[] = '07883738567';
$firstnames[] = 'Abdul'; $lastnames[] = 'Zaf'; $usernames[] = 'admin'; $passwords[] = 'secret'; $emails[] = 'admin@gmail.com'; $DOBs[] = '1999-02-26'; $telephones[] = '07875433567';


// loop through the arrays above and add rows to the table:
for ($i=0; $i<count($usernames); $i++)
{
	$sql = "INSERT INTO users (firstname, lastname, username, password, email, DOB, telephone) 
	VALUES ('$firstnames[$i]', '$lastnames[$i]', '$usernames[$i]', '$passwords[$i]', '$emails[$i]', '$DOBs[$i]', '$telephones[$i]')";
	
	// no data returned, we just test for true(success)/false(failure):
	if (mysqli_query($connection, $sql)) 
	{
		echo "row inserted<br>";
	}
	else 
	{
		die("Error inserting row: " . mysqli_error($connection));
	}

}

///////////////////////////////////////////
////////////// Surveys Data///////////////////
///////////////////////////////////////////


$usernames = array(); // clear this array (as we already used it above)

$survey_names[] = 'Games'; $numbers_of_questions[] = '5'; $usernames[] = 'admin' ;
$survey_names[] = 'General Nothing'; $numbers_of_questions[] = '4'; $usernames[] = 'barryg' ; 
$survey_names[] = 'Sports Survey'; $numbers_of_questions[] = '2'; $usernames[] = 'mandyb';
$survey_names[] = 'Brians Survey'; $numbers_of_questions[] = '10'; $usernames[] = 'briang';
$survey_names[] = 'Timmys General Knowledge'; $numbers_of_questions[] = '6'; $usernames[] = 'timmy'; 

for ($i = 0; $i < count($survey_names); $i++) 
{
	
	$query = " INSERT INTO surveys (username, survey_name, number_of_questions) VALUES ('$usernames[$i]', '$survey_names[$i]', '$numbers_of_questions[$i]')";
	//$result = mysqli_query($connection, $query);

	if (mysqli_query($connection, $query)) 
	{
		echo "row inserted for surveys<br>";
	} else 
	{
		die("Error inserting row: " . mysqli_error($connection));
	}
}



///////////////////////////////////////////
////////////// Survey Questions Data///////////////////
///////////////////////////////////////////


 $question_nos[] = '1'; $question_types[] = 'Checkbox Option'; $questions[] = 'Whats your favourite game?'; $survey_ids[] = '3'; $responses[] = 'Fortnite-BLACK OPS 4-RDR2';
 $question_nos[] = '2'; $question_types[] = 'Radio Buttons'; $questions[] = 'Whats your favourite Sport?'; $survey_ids[] = '3'; $responses[] = 'Cricket-Soccer-Hockey';
 $question_nos[] = '3'; $question_types[] = 'Text Box'; $questions[] = 'Whats your favourite car?'; $survey_ids[] = '3'; $responses[] = 'Lambo';
 $question_nos[] = '4'; $question_types[] = 'Numbers'; $questions[] = 'Whats your favourite number?'; $survey_ids[] = '3'; $responses[] = '5';

for ($i = 0; $i < count($question_nos); $i++) 
{
	$query = "INSERT INTO surveyQuestions (question_no, question_type, question, survey_id, response) VALUES ( '$question_nos[$i]', '$question_types[$i]' , '$questions[$i]' , '$survey_ids[$i]', '$responses[$i]')";
	//$result = mysqli_query($connection, $query);

	if (mysqli_query($connection, $query)) 
	{
		echo "row inserted for survey questions <br>";
	} else 
	{
		die("Error inserting row for survey questions: " . mysqli_error($connection));
	}
}

///////////////////////////////////////////
////////////// Sample Questions ///////////
///////////////////////////////////////////
$usernames = array(); // clear this array (as we already used it above)

$number_questions[] = '1'; $sample_questions[] = 'Which one is your favourite brand?'; $sample_answers[] = 'Lamborghini'; $usernames[] = 'admin';

echo sizeof($number_questions) . "<br>";
for ($i = 0; $i < sizeof($number_questions); $i++) 
{
	$query = "INSERT INTO sampleQuestions (survey_id, sample_question, sample_answer, username) 
	VALUES ('$number_questions[$i]', '$sample_questions[$i]', '$sample_answers[$i]', '$usernames[$i]')";

 	if (mysqli_query($connection, $query)) 
 	{
 		echo "row inserted for sample questions <br>";
 	} else 
 	{
 		die("Error inserting row for sample questions: " . mysqli_error($connection));
 	}
 }


 
///////////////////////////////////////////
////////////// ANSWERS ///////////
///////////////////////////////////////////

$usernames = array();
$answers[] = 'Fortnite'; $survey_ids[] = '3'; $question_ids[] = '1'; $usernames[] = 'timmy';

//echo sizeof($answers) . "<br>";
for ($i = 0; $i < sizeof($answers); $i++) 
{
	//echo sizeof($questions);
	$query = "INSERT INTO answers (answer, survey_id, question_id, username) 
	VALUES ('$answers[$i]', '$survey_ids[$i]', '$question_ids[$i]', '$usernames[$i]')";

 	if (mysqli_query($connection, $query)) 
 	{
 		echo "row inserted for answers <br>";
	} 
	 else 
 	{
 		die("Error inserting row for answers: " . mysqli_error($connection));
 	}
 }

 ///////////////////////////////////////////
////////////// Poll Table ///////////
///////////////////////////////////////////

$usernames = array();
$votes = array();
$games = array();


//CREATE TABLE poll (game VARCHAR(100), comments VARCHAR(50),votes INT UNSIGNED default 0,username VARCHAR(16), FOREIGN KEY (username) REFERENCES users (username) )";
$games[] = 'Fortnite'; $comments[] = 'Best Game of The Year'; $votes[] = '0'; $usernames[] = 'admin';
$games[] = 'Black Ops 4'; $comments[] = 'Best 3rd Person Game of The Year'; $votes[] = '0'; $usernames[] = 'timmy';
$games[] = 'Red Dead Redemption'; $comments[] = 'Rockstar Games'; $votes[] = '0'; $usernames[] = 'barryg';
$games[] = 'Spider Man 3'; $comments[] = 'Amazing Visuals'; $votes[] = '0'; $usernames[] = 'mandyb';
$games[] = 'Fifa 19'; $comments[] = 'Wonderful graphics'; $votes[] = '0'; $usernames[] = 'briang';

//echo sizeof($answers) . "<br>";
for ($i = 0; $i < sizeof($usernames); $i++) 
{
	//echo sizeof($questions);
	$query = "INSERT INTO poll (game, comments, votes , username) 
	VALUES ('$games[$i]', '$comments[$i]', '$votes[$i]', '$usernames[$i]')";

 	if (mysqli_query($connection, $query)) 
 	{
 		echo "row inserted for Poll(games) <br>";
	 } 
	else 
 	{
 		die("Error inserting row for Poll(games): " . mysqli_error($connection));
 	}
 }


// we're finished, close the connection:
mysqli_close($connection);

?>