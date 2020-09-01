<?php

$first_question = $_GET['first_q'];
echo "Your favourite subject is high school is ".$first_question.".";

echo <<<_END
<form method = "POST">
  <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
</head>
<body>
  <h1>A Short Survey!</h1>
</header>
<article id="mainContent">
  <h1>Please answer all the questions.</h1>
      <form method="post">
            <h2>Q 1/5</h2>
            <p>What were your favourite subject(s) in high school? <br>
              (Check as many as you like.)</p>
            <div class="column">
              <p>
                <label>
                  <input name="interests_" type="checkbox" id="interests_0" value="Mathematics" />
                  Mathematics</label>
              </p>
              <p>
                <label>
                  <input name="interests_" type="checkbox" id="interests_1" value="Science"/ >
                  Science</label>
              </p>
              <p>
                <label>
                  <input name="interests_" type="checkbox" id="interests_2" value="English" / >
                  English</label>
              </p>
              <p>
                <label>
                  <input name="interests_" type="checkbox" id="interests_3" value="Geography" />
                  Geography</label>
              </p>
              <p>
                <label>
                  <input name="interests_" type="checkbox" id="interests_4" value="Graphic Design" />
                  Graphic Design</label>
              </p>
              <p>
                <label>
                  <input name="interests_" type="checkbox" class="interests" id="interests_5" value="Arts" />
                  Arts</label>
              </p>
              <p>
                <label>
                  <input name="interests_" type="checkbox" class="interests" id="interests_6" value="Religious Eductaion" />
                  Religious Eductaion</label>
              </p>
              <p>
                <label>
                  <input name="interests_" type="checkbox" class="interests" id="interests_7" value="Language">
                  Language</label>
              </p>
              <p>
                <label>
                  <input name="interests_" type="checkbox" class="interests" id="interests_8" value="Photography" />
                  Photography</label>
              </p>
              <p>
                <label>
                  <input name="interests_" type="checkbox" class="interests" id="interests_9" value="Textiles" />
                  Textiles</label>
              </p>
             <p>
                <label>
                  <input name="interests_" type="checkbox" class="interests" id="interests_9" value="NOT STATED:(" />
                  NOT STATED:(</label>
              </p>
            </div>
            
          </div>      
          
          <div>
            <h2>Q 2/5</h2>
            <p>Please type in the name of your favourite football team</p>
            <p>
              <input id="desiredTeam" type="text" placeholder="Manchester United" /></p>
          </div>
        </div>
  
            <h2>Q 3/5</h2>
            <p>How long have you been watching football for?</p>
            <p>
              <input type="radio" id="artistLength1" name="artistLength" value="Since I was a kid" />
              <label>Since I was a kid.</label>
            </p>
            <p>
              <input type="radio" id="artistLength2" name="artistLength" value="Since high school" />
              <label>Since high school.</label>
            </p>
            <p>
              <input type="radio" id="artistLength3" name="artistLength" value="Less than a year" />
              <label>Less than a year.</label>
            </p>
            <p>
              <input type="radio" id="artistLength4" name="artistLength" value="All my life" />
              <label>All my life.</label>
            </p>
            <p>
              <input type="radio" id="artistLength5" name="artistLength" value="I don't" />
              <label>I don't.</label>
            </p>
          </div>
        </div>
            <h2>Q 4/5</h2>
            <p>How many hours a day do you practise footbal?</p>
            <p>
              <input type="range" min="0" max="24" value="0" id="hoursPractice" onchange="printValue('hoursPractice','hoursPracticeValue')" />
            </p>
            <p>
              <input type="text" id="hoursPracticeValue" placeholder="Move slider from 0 to 24 hours" />
            </p>
          </div>
        </div>

            <h2>Q 5/5</h2>
            <p>Who have you shown your art too?<br>
              (Check all that apply.)</p>
            <p>
              <label>
                <input class="shared" type="checkbox" name="viewers_" value="Family" id="viewers_0" />
                Family</label>
            </p>
            <p>
              <label>
                <input class="shared" type="checkbox" name="viewers_" value="Friends" id="viewers_0" />
                Friends</label>
            </p>
            <p>
              <label>
                <input class="shared" type="checkbox" name="viewers_" value="Teachers and classmates" id="viewers_0" />
                Teachers and classmates</label>
            </p>
            <p>
              <label>
                <input class="shared" type="checkbox" name="viewers_" value="Public showing" id="viewers_0" />
                The public in a showing</label>
            </p>
            <p>
              <label>
                <input class="shared" type="checkbox" name="viewers_" value="No one" id="viewers_0" />
                No one</label>
            </p>
          </div>
        </div>
            
            <p>Please review your responses below and click the related Change button to make any updates. When you're satisfied with your responses, click Submit.</p>
            <p class="show-buttons">
              <input type="submit" name="surveryResponse" value="Submit" />
            </p>
          
      </form>
   
<br>
</form>
_END;

if (isset($_POST['surveryResponse'])) {
   
        echo "Thank you for your time. Your response has been submitted.";


}

?>