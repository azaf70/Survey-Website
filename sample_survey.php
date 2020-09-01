<?php

require_once "header.php";


$username = $_SESSION['username'];
$samplesurvey_name = "Games";
$custom_messages= "";
$question[] = "Which one of these games have you heard of?";
$answer = "";
$question[] = "Please choose one these features you like the most about the game?";
$question[] = "How many hours a day do you play it?";
$question[] = "How many hours do you spend playing games a month?";
$question[] = "Why do you like it?";
$numberquestion = "5";



if (isset($_SESSION['loggedInSkeleton'])) {
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	// user isn't logged in, display a message saying they must be:


// show the form that allows users to sign up
// Note we use an HTTP POST request to avoid their password appearing in the URL:

    echo "Welcome ", $_SESSION['username'];


    echo <<<_END
<form action="sample_survey.php?survey_id=5 " method="POST">
 <b> Survey name: </b> <input type="text" style="font-weight: bold"; centre name="survey_name" value= "Games"  maxlength="32"  readonly>
 <br>
 <br>
  <b> Answer the followings:</b><br>
  Question 1: $question[0]<br>
<select name="answer0"> 
  <option value="Choose one" selected>Choose one</option>
  <option value="Fortnite" >Firtnite</option>
  <option value="Black Ops 4" >Black Ops 4</option>
  <option value="Devil May Cry 5" >Devil May Cry 5</option>
  <option value="Tekken 7" >Tekken 7</option>
  <option value="Spyro" >Spyro</option>
  <option value="Rocket League" >Rocket League</option>
  <option value="FIFA 19" >FIFA 19</option>
  <option value="God Of WAR" >God Of WAR</option>
  <option value="Sims 5" >Sims 5</option>
</select>


  <br>
  <br>
  <br>
  Question 2: $question[1]<br>
  
  <div>
  <input type="radio" id="scales" name="answer1" value="Great Visuals"
         unchecked>
  <label for="answer1">Great Visuals</label>
</div>
<div>
  <input type="radio" id="scales" name="answer1" value="Ultimate Graphics"
         unchecked>
  <label for="answer1">Ultimate Graphics</label>
</div>
<div>
  <input type="radio" id="scales" name="answer1" value="Custom Binding"
         unchecked>
  <label for="answer1">Custom Binding</label>
</div>
<div>
  <input type="radio" id="scales" name="answer1" value="Compatibility"
         unchecked>
  <label for="answer2">Compatibility</label>
</div>
<div>
  <input type="radio" id="scales" name="answer1" value="Multiplayer Mode"
         unchecked>
  <label for="answer1">Multiplayer Mode</label>
</div>
<div>
  <input type="radio" id="scales" name="answer1" value="Building Mechanism"
         unchecked>
  <label for="answer1">Building Mechanism</label>
</div>
<div>
  <input type="radio" id="scales" name="answer1" value="Smoothness"
         unchecked>
  <label for="answer1">Smoothness</label>
</div>
<div>
  <input type="radio" id="scales" name="answer1" value="Rapid Updates"
         unchecked>
  <label for="answer1">Rapid Updates</label>
</div>


 <br>
  Question 3: $question[2]<br>
 <select name="answer2"> 
  <option value="Choose one" >Choose one</option>
  <option value="1" >1</option>
  <option value="2" >2</option>
  <option value="3" >3</option>
  <option value="4" >4</option>
  <option value="5" >5</option>
  <option value="6" >6</option>
  <option value="7" >7</option>
  <option value="8" >8</option>
  <option value="9" >9</option>
  <option value="10" >10</option>
  <option value="11" >11</option>
  <option value="12+" >12+</option>
</select>
<br>
<br>
  

  Question 4: $question[3]<br>
 <select name="answer3"> 
  <option value="Choose one" >Choose one</option>
  <option value="0-5" >0-5</option>
  <option value="5-10" >5-10</option>
  <option value="10-15" >10-15</option>
  <option value="15-20" >15-20</option>
  <option value="20+" >20+</option>
 
</select>
<br>
<br>

  Question 5: $question[4]<br>
  Answer: <input type="text" name="answer4" maxlength="32"> 
  <br>
  <br>
  
  <input name = "submit_survey" type="submit" value="Submit survey">
  
  

</form>	

_END;
//Answer: <input list= "question_2" name="answer2" maxlength="32"> 

//<datalist id="question_2"> <option>Science fiction</option> <option>Drama</option> <option>Comedy</option> <option>Non-fiction</option> <option>Fairy tale</option> <option>Fantasy</option> <option>Adventure</option> </datalist>


    if (isset($_POST['submit_survey'])) 
    {
        if ($_POST['answer3'] == 'Choose one' || $_POST['answer4'] == 'Choose one' || $_POST['answer1'] == 'Choose one') 
        {
            echo "Please select an answer";
        } 
        else 
        {

            for ($i = 0; $i < 5; $i++) 
            {
                $answer = (String)"answer" . $i;
                echo "<br>";
                //echo $_POST[$answer];
                //echo $_POST['survey_name'] . "<br>";
                //$number_question = $i + 1;
                $query = "INSERT INTO sampleQuestions (survey_id,  sample_question, sample_answer , username) VALUES ('5', '$question[$i]', '{$_POST[$answer]}' , '{$username}')";
                if (mysqli_query($connection, $query)) 
                {
                // show a successful signup message:
                   
                    $custom_messages = "Survey completed";
                    $message = $custom_messages;
               } 
                else 
                {
                    $message = "Survey Incompleted. Please try again.";
                    die("Error inserting row for sample questions: " . mysqli_error($connection));
                }
            }
            if ($message = $custom_messages)
            {
                echo $message;
                //echo $custom_messages;
                echo <<<_END
                <a href="sample_answers.php?survey_id=5"> View Results </a>
_END;
            }
        
        }
		// we're finished with the database, close the connection:
        mysqli_close($connection);
    }
}
// display our message to the user:


// finish off the HTML for this page:
require_once "footer.php";


?>