<?php
// execute the header script:
require_once "header.php";

// variables to help with validation processes
$show_form = false;


// check that the user is still logged in
// if they're not, remind them to login and don't run any queries
if (!isset($_SESSION['loggedInSkeleton'])) 
{
        // user isn't logged in, display a message saying they must be:
    echo "You must be logged in to view this page.<br>";
} 

else 
{
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
echo "Welcome ", $_SESSION['username'];

$query = "SELECT * FROM surveyQuestions WHERE survey_id = '{$_GET['survey_id']}'";
$result = mysqli_query($connection, $query);    
$n = mysqli_num_rows($result);
	 
	  // if we got some results then show them in a table:

if ($n > 0) {

echo "<br><br>";
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
echo "<tr><th>Question Number</th><th>Question Type</th><th>Question</th><th>Survey ID</th><th>Response</th></tr>";
		
		// loop over all rows, adding them into the table:
        for ($i = 0; $i <$n; $i++) 
        {
            // fetch one row as an associative array (elements named after columns):
            $row = mysqli_fetch_assoc($result);
            // add it as a row in our table:
            echo "<tr>";
            echo "<td>{$row['question_no']}</td><td>{$row['question_type']}</td><td>{$row['question']}</td><td>{$_GET['survey_id']}</td><td>{$row['response']}</td>";
            echo "</tr>";
        }
        echo "</table>";

    }


$query = "SELECT * FROM surveys";
$result = mysqli_query($connection, $query);
$n = mysqli_num_rows($result);
if ($n > 0) 
{

    for ($i = 0; $i < $n; $i++) 
    {
            $show_question_form = true;
                // fetch one row as an associative array (elements named after columns):
			//$del_survey = "{$row['username']}";
                // add it as a row in our table: 
    }
// we're finished with the database, close the connection:
$show_form = true;

if($show_question_form)
{

$minNum = $_GET['number_of_questions'] + 1;
echo $minNum;
 echo <<<_END
   <form method = "POST">
   <b>Please choose the question number</b>
<select name = "question_no">
<option name = "option" selected disabled > Choose one </option> 
_END;
echo "<br>";
for($i = 1; $i <= $minNum; $i++)
{
echo <<<_END
    <option name = "option" > $i </option>
_END;
}
            echo <<<_END
</select>
_END;
echo "<br>";
echo "<br>";
echo "<br>";
  //<option name = "option" value = "checkbox">checkbox</option>
echo <<<_END
<b>Please choose the question type? </b>
<select name="questType"> 
  <option name = "option" selected disabled  >Choose one</option>
  <option name = "option" value = "Text Box" >Text Box</option>
  <option name = "option" value = "Numbers" >Numbers</option>
  <option name = "option" value = "Date" >Date</option>
  <option name = "option" value = "Radio Buttons" >Radio Buttons</option>
</select>


<br>
<br>
<br>

<b>Please type in the Question:</b>
<input type="text" maxlength="500" minlength="1" name="surv_question"  required>
<br>
<br>
<br>

<b>If you chose Radio or Checkbox as your option; please type in the question separated with a dash:</b>
<input type="text" maxlength="500" minlength="1" name="resp" >
<br>
<input type="submit" name = "questionType" value="Submit">
</form>
<br>
_END;


    if (isset($_POST['surv_question'])) 
    {
       $validation= "SELECT * FROM surveyQuestions WHERE question_no = '{$_POST['question_no']}' AND survey_id = '{$_GET['survey_id']}' ";
       $result = mysqli_query($connection, $validation);
       $n = mysqli_num_rows($result);
       if ($n == 0) 
       {
        
            $query = "INSERT INTO surveyQuestions (question_no, question_type, question, survey_id, response) VALUES ('{$_POST['question_no']}', '{$_POST['questType']}' , '{$_POST['surv_question']}', '{$_GET['survey_id']}', '{$_POST['resp']}')";
            //echo $query;
            $result = mysqli_query($connection, $query);
            if ($result) 
            {

                echo "Updated.";
                echo "Click here to Answer these questions.";
                echo <<<_END
                <form  method='POST' action ='answer_surveys.php?survey_id={$_GET['survey_id']}&survey_name={$_GET['survey_name']}&number_of_questions={$_GET['number_of_questions']}'>
                <button name ='ans_questions' value='{$_GET['number_of_questions']}'>Answer Questions </button> </form>
_END;

        }
    
            else
            {
                echo"Not updated.";
            
            }
        }
    }
    else{
        echo "Question Not Created. You have already created this question.";
    }
            $sqlq = "SELECT number_of_questions FROM surveys WHERE survey_id = '{$_GET['survey_id']}'";
            $sqlGetMaxQNo =  "SELECT * FROM surveyQuestions WHERE survey_id = '{$_GET['survey_id']}' AND question_no = (SELECT MAX(question_no) FROM surveyQuestions WHERE survey_id = '{$_GET['survey_id']}')";
            $result = mysqli_query($connection, $sqlGetMaxQNo);
            $n = mysqli_num_rows($result);
	 
        
	  // if we got some results then show them in a table:
    if ($n > 0) {
         $row = mysqli_fetch_assoc($result);

         //echo "{$row['number_of_questions']}";
            

    $updNumQ = "UPDATE surveys SET number_of_questions = '{$row['question_no']}' WHERE survey_id = '{$_GET['survey_id']}';";
    $resultupd = mysqli_query($connection, $updNumQ);
            //$res = mysqli_query($connection, $sql);

            //$n = mysqli_num_rows($result);
            //echo $result;
            if ($result) 
            {
                echo "Updated";
            }
            else{
                echo "not Updated";
            }
        }
}
}
if ($show_form) {

$sql = "SELECT * FROM surveys WHERE survey_id = '{$_GET['survey_id']}' ";
$result = mysqli_query($connection, $sql);
$n = mysqli_num_rows($result);
	 
	  // if we got some results then show them in a table:
if ($n > 0) {
     $row = mysqli_fetch_assoc($result);
    // display the user's profile data in a table for easy editing
    echo <<<_END
            <b>You are working on: </b><br>
            
            <table border="0" cellpadding="2">
                <tr>
                    <td bgcolor="#f96d6d">Survey Name: </td><td>{$_GET['survey_name']}</td>
                </tr>
                <tr>
                    <td bgcolor="#f96d6d">Number of Questions:</td><td>{$row['number_of_questions']}</td>
                    </tr>
            </table>
</form>
_END;
}
}
        mysqli_close($connection);
}

    
// finish off the HTML for this page:
require_once "footer.php";

?>


