<?php
require_once "header.php";

$usernames = $_SESSION['username'];
$message = "";


if (!isset($_SESSION['loggedInSkeleton'])) 
{
    // user isn't logged in, display a message saying they must be:
    echo "You must be logged in to view this page.<br>";
} 
else 
{
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    echo "Welcome ", $usernames;

    if ($_SESSION['username'] == "admin") 
    {
    $query = "SELECT * FROM surveyQuestions WHERE survey_id = '{$_GET['survey_id']}'";
    $result = mysqli_query($connection, $query);
    $n = mysqli_num_rows($result);
    
    $queryAns = "SELECT * FROM answers WHERE survey_id = '{$_GET['survey_id']}'";
    $resultAns = mysqli_query($connection, $queryAns);
    $resAns = mysqli_num_rows($resultAns);
	 
	  // if we got some results then show them in a table:
    if ($n > 0) 
    {
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
_END;

    echo "<table cellpadding='2' cellspacing='2'>";
    echo "<tr><th>Question</th><th>Answer</th> <th>Usernames</th> <th>Delete this QandA</th> </tr>";
		
    // loop over all rows, adding them into the table:
    for ($i = 0; $i < $n; $i++) {
           
    // fetch one row as an associative array (elements named after columns):
    $row = mysqli_fetch_assoc($result);
    $resAns = mysqli_fetch_assoc($resultAns);
    //$usernames = $row['username'];
    // add it as a row in our table:
    echo "<tr>";
    echo "<td>{$row['question']}</td> <td> {$resAns['answer']} </td>  <td> {$resAns['username']} </td>";
    echo "<td><form  method='POST' action ='answers.php?survey_id={$_GET['survey_id']}&survey_name={$_GET['survey_name']}&number_of_questions={$_GET['number_of_questions']}'> <button name ='delete_q' value='{$row['question_id']}' '>Delete this QandA</button> </form> </td>";
    echo "</tr>";
    }
    echo "</table>";

    }
    if(isset($_POST['delete_q']))
    {
        $queryAns = "SELECT * FROM answers WHERE survey_id = '{$_GET['survey_id']}'";
        $resultAns = mysqli_query($connection, $queryAns);
        $resAns = mysqli_fetch_assoc($resultAns);
        echo $delAns = "DELETE FROM answers WHERE answer =  '{$resAns['answer']}' AND  answer_id = '{$resAns['answer_id']}' ";
        echo $delQuest = "DELETE FROM surveyQuestions WHERE surveyQuestions = '{$row['question']}' AND question_id = '{$row['question_id']}' ";
        $delAnswer = mysqli_query($connection, $delAns);
        $delQuestion = mysqli_query($connection, $delQuest);
        
//&& $delAnswer
        if($delAnswer && delQuestion)
        {
            echo "Question and Ansers have been deleted";
        }
        else
        {
            echo "An error occurred; QandA not deleted";
        }

        }
    } 
    else 
    {
        $usernames = $_SESSION['username'];

        $query = "SELECT * FROM surveyQuestions WHERE survey_id = '{$_GET['survey_id']}' ";
       // echo $query;
        $result = mysqli_query($connection, $query);
        $n = mysqli_num_rows($result);
	 
	 
	  // if we got some results then show them in a table:
        if ($n > 0) 
        {
        echo <<<_END
        <style>
            table, th, td {border: 1px solid black; align: center;}
                
            th, td 
            {
                text-align: left;
                padding: 8px;
            }
            
            tr:nth-child(even){background-color: #f2f2f2}
            
            th 
            {
                background-color: #b3e6ff;
                color: black;
            }
            
            
        </style>
_END;
       
        echo <<<_END

        <form action = 'answers.php?survey_id={$_GET['survey_id']}' method = 'POST'> 
            
_END;

        $answer_query = "SELECT * FROM answers WHERE survey_id = '{$_GET['survey_id']}'";
        $result2 = mysqli_query($connection, $answer_query);
        $nn = mysqli_num_rows($result2);

		// loop over all rows, adding them into the table:
        for ($i = 0; $i < $n; $i++) 
        {

            // fetch one row as an associative array (elements named after columns):
            $row = mysqli_fetch_assoc($result);
            $row_nn = mysqli_fetch_assoc($result2);
            // add it as a row in our table:
            // echo "<td>{$row['question']}</td>";
            echo "{$row['question']}";
            echo "<input name='answerposted' value = '{$row_nn['answer']}' type='text'>";
            echo "<br>"; 
            // echo "</tr>";
            }
            echo "<input type = 'submit' name = 'updAnswers' >";
            
        // if we got some results then show them in a table:
        
        // echo "</table>";
        echo "</form>";
        if (isset($_POST['updAnswers'])) 
        {

                //$newAnswer = $_POST["answer"];

        $query = "SELECT * FROM surveyQuestions WHERE survey_id = '{$_GET['survey_id']}' ";
        $result1 = mysqli_query($connection, $query);
        $n = mysqli_num_rows($result1);
        if ($n > 0) {
            $row = mysqli_fetch_assoc($result1);
            
            echo $sql = "UPDATE answers SET (answer,survey_id, question_id, username) VALUES ('{$_POST['answerposted']}' , '{$_GET['survey_id']}', '{$row['question_id']}', $usernames )";
            echo $sql;
            $result2 = mysqli_query($connection, $sql);
            if ($result2) 
            {
                echo " NEW ANSWER Inserted";
            } 
            else {
                echo " NEW ANSWER Not Inserted";
            }
                }
            }
        }
    }
}


?>