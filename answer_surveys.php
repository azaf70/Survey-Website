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
    echo "Welcome ", $_SESSION['username'];

    if ($_SESSION['username'] == "admin") {
     $usernames = $_SESSION['username'];

        $query = "SELECT * FROM surveyQuestions WHERE survey_id = '{$_GET['survey_id']}' ";
        //echo $query;
        $result = mysqli_query($connection, $query);
        $n = mysqli_num_rows($result);
	 
	   //$n = mysqli_num_rows($result);
	 
	 
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
        echo "<tr><th>Question</th><th>Answer</th></tr>";
        $query1 = "SELECT * FROM surveyQuestions WHERE survey_id = '{$_GET['survey_id']}' ";
        $ansQuery = "SELECT * FROM answers WHERE survey_id = '{$_GET['survey_id']}' ";
        //echo $query;
        $result1 = mysqli_query($connection, $query1);
        $ansResult = mysqli_query($connection, $ansQuery);
        $nn = mysqli_num_rows($result);
	 
		// loop over all rows, adding them into the table:
        for ($i = 0; $i < $nn; $i++) 
        {
            $rows1 = mysqli_fetch_assoc($ansResult);
            // fetch one row as an associative array (elements named after columns):
            $row = mysqli_fetch_assoc($result);
           // $usernames = $row['answer_id'];
            // add it as a row in our table:
            echo "<tr>";
            echo "<td>{$row['question']}</td> <td> {$rows1['answer']} </td>";
            echo "</tr>";
        }
        echo "<form action = 'answer_surveys.php?survey_id={$_GET['survey_id']}&survey_name={$_GET['survey_name']}&number_of_questions={$_GET['number_of_questions']}' method = 'POST' >";
        echo "</table>";

           echo<<<_END
            <h3> Survey Questions</h3>
          
_END;
        
        for($i = 0; $i < $nn; $i++)
        {
            $row =  mysqli_fetch_assoc($result1);


           // echo "QuestionNumber:" . $row["question_no"] . "<br>";
            echo "Question: " . $row["question"] . "<br>";
           
            //echo"<br>";
           if ($row['question_type'] == 'Text Box')
                {
                  //echo "{$row['question']}";
                
                  echo "<input name='{$row['question_id']}' type='text'>";
                  echo"<br>";
                  echo"<br>";
                }

        elseif ($row['question_type'] == 'Numbers')
                {
                    
                  //echo "{$row['question']}";
                  echo "<input name='{$row['question_id']}' type='number'>";
                  echo"<br>";
                  echo"<br>";
                }

                elseif ($row['question_type'] == 'Date')
                {
                   
                  //echo "{$row['question']}";
                  echo "<input name='{$row['question_id']}' type='date'>";
                  echo"<br>";
                  echo"<br>";
                }

                elseif ($row['question_type'] == 'Radio Buttons')
                {
                    
                  //echo "{$row['question']}";
                  $explode = explode ('-', $row['response']);
                    for($j=0; $j< sizeof($explode); $j++)
                    {
                    echo  "<br>";
                    echo "<input name='{$row['question_id']}' value = '$explode[$j]' type='radio'> {$explode[$j]}";
                    echo "<br>";
                    }
                }
        }
    }

            echo "<input type = 'submit' name = 'submit_answers'>";
            echo "</form>";
	  // if we got some results then show them in a table:
        
             echo "</table>";
      
            if (isset($_POST['submit_answers'])) 
            {
                //echo "Button is pressed";

                //$newAnswer = $row['answer'];
            
                echo $query = "SELECT * FROM surveyQuestions WHERE survey_id = '{$_GET['survey_id']}';";
                echo $query . "<br>";
                $result2 = mysqli_query($connection, $query);
                $r = mysqli_num_rows($result2);
                if ($n > 0) 
                {
                    for($i = 0; $i < $n; $i++)
                    { 
                        $rows1 = mysqli_fetch_assoc($result2);

                        $questionsID = $rows1['question_id'];
                        $postID = $_POST[$questionsID];

                       $sql = "INSERT INTO answers (answer, survey_id, question_id, username) VALUES ('{$postID}' , '{$_GET['survey_id']}', '{$questionsID}', '$usernames' )";
                       
                        $result = mysqli_query($connection, $sql);

                        if ($result)
                        {
                            echo " ANSWER Inserted";
                        } else
                         {
                          echo "ANSWER Not Inserted";
                        }
                    }
                }
            }
        }
    
    else 
    {
        $usernames = $_SESSION['username'];

        $query = "SELECT * FROM surveyQuestions WHERE survey_id = '{$_GET['survey_id']}' ";
        //echo $query;
        $result = mysqli_query($connection, $query);
        $n = mysqli_num_rows($result);
	 
	   //$n = mysqli_num_rows($result);
	 
	 
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
        echo "<tr><th>Question</th><th>Answer</th></tr>";
        $query1 = "SELECT * FROM surveyQuestions WHERE survey_id = '{$_GET['survey_id']}' ";
        $ansQuery = "SELECT * FROM answers WHERE survey_id = '{$_GET['survey_id']}' ";
        //echo $query;
        $result1 = mysqli_query($connection, $query1);
        $ansResult = mysqli_query($connection, $ansQuery);
        $nn = mysqli_num_rows($result);
	 
		// loop over all rows, adding them into the table:
        for ($i = 0; $i < $nn; $i++) 
        {
            $rows1 = mysqli_fetch_assoc($ansResult);
            // fetch one row as an associative array (elements named after columns):
            $row = mysqli_fetch_assoc($result);
           // $usernames = $row['answer_id'];
            // add it as a row in our table:
            echo "<tr>";
            echo "<td>{$row['question']}</td> <td> {$rows1['answer']} </td>";
            echo "</tr>";
        }
        echo "<form action = 'answer_surveys.php?survey_id={$_GET['survey_id']}&survey_name={$_GET['survey_name']}&number_of_questions={$_GET['number_of_questions']}' method = 'POST' >";
        echo "</table>";

           echo<<<_END
            <h3> Survey Questions</h3>
          
_END;
        
        for($i = 0; $i < $nn; $i++)
        {
            $row =  mysqli_fetch_assoc($result1);


           // echo "QuestionNumber:" . $row["question_no"] . "<br>";
            echo "Question: " . $row["question"] . "<br>";
           
            //echo"<br>";
           if ($row['question_type'] == 'Text Box')
                {
                  //echo "{$row['question']}";
                
                  echo "<input name='{$row['question_id']}' type='text'>";
                  echo"<br>";
                  echo"<br>";
                }

        elseif ($row['question_type'] == 'Numbers')
                {
                    
                  //echo "{$row['question']}";
                  echo "<input name='{$row['question_id']}' type='number'>";
                  echo"<br>";
                  echo"<br>";
                }

                elseif ($row['question_type'] == 'Date')
                {
                   
                  //echo "{$row['question']}";
                  echo "<input name='{$row['question_id']}' type='date'>";
                  echo"<br>";
                  echo"<br>";
                }

                elseif ($row['question_type'] == 'Radio Buttons')
                {
                    
                  //echo "{$row['question']}";
                  $explode = explode ('-', $row['response']);
                    for($j=0; $j< sizeof($explode); $j++)
                    {
                    echo  "<br>";
                    echo "<input name='{$row['question_id']}' value = '$explode[$j]' type='radio'> {$explode[$j]}";
                    echo "<br>";
                    }
                }
        }
    }
		

            echo "<input type = 'submit' name = 'submit_answers'>";
            echo "</form>";
	  // if we got some results then show them in a table:
        
             echo "</table>";
      
            if (isset($_POST['submit_answers'])) 
            {
                //echo "Button is pressed";;
            
                echo $query = "SELECT * FROM surveyQuestions WHERE survey_id = '{$_GET['survey_id']}';";
                echo $query . "<br>";
                $result2 = mysqli_query($connection, $query);
                $r = mysqli_num_rows($result2);
                if ($n > 0) 
                {
                    for($i = 0; $i < $n; $i++)
                    { 
                        $rows1 = mysqli_fetch_assoc($result2);

                        $questionsID = $rows1['question_id'];
                        $postID = $_POST[$questionsID];

                       echo $sql = "INSERT INTO answers (answer, survey_id, question_id, username) VALUES ('{$postID}' , '{$_GET['survey_id']}', '{$questionsID}', '$usernames' )";
                       
                        $result = mysqli_query($connection, $sql);

                        if ($result)
                        {
                            echo " ANSWER Inserted";
                        } else
                         {
                          echo "ANSWER Not Inserted";
                        }
                    }
                }
            }
        }
    }

?>