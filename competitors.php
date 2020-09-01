<?php

// Things to notice:
// You need to add your Analysis and Design element of the coursework to this script
// There are lots of web-based survey tools out there already.
// It’s a great idea to create trial accounts so that you can research these systems. 
// This will help you to shape your own designs and functionality. 
// Your analysis of competitor sites should follow an approach that you can decide for yourself. 
// Examining each site and evaluating it against a common set of criteria will make it easier for you to draw comparisons between them. 
// You should use client-side code (i.e., HTML5/JavaScript/jQuery) to help you organise and present your information and analysis 
// For example, using tables, bullet point lists, images, hyperlinking to relevant materials, etc.

// execute the header script:
require_once "header.php";

if (!isset($_SESSION['loggedInSkeleton']))
{
	// user isn't logged in, display a message saying they must be:
	echo "You must be logged in to view this page.<br>";
}
else
{
echo <<<_END
<h1 style="color:red;">SURVEY MONKEY</h1>

<h1>• Layout/presentation of surveys</h1>

<p>The first website I am analysing is Survey Monkey. As soon as you go on the website; everything is clearly shown in an organised manner. All the essential information is shown directly to all the users.</p>
 
<p>A survey button is evidently shown to the users which is the main purpose of the website. Animations and perfect colour contrasts are used throughout which goes on to show how much they prioritise the usability and accessibility. As soon as the survey button is clicked; a page with a sign-in/sign-up form is shown with a rhetorical question which makes the user intrigued as to what will happen when you sign-in or sign-up. This is a wonderful strategy.</p>

<p>Once a user has finally clicked on the create survey button; immediately the website displays them sections where they can look at the most popular surveys. This section also gives a user an option to just have a glance on others’ surveys or they can explore that particular survey to the extent where the website shows the user total number of questions, the amount of times the template was used, average time and the sample result. This is an extremely helpful feature as this gives the user more ideas and widens their imagination plus boosts their motivation. On the other hand, more templates are shown to the user which are categorised.</p>

<p>If a user chooses a template; they are shown with the sample questions and possible answers. Users still have endless amount of options even when they are using the template as the website allows them to generate any question, any option to the point where they can even add logic according to their survey needs. Thus, giving a user infinite opportunity to make their survey perfect for their target audience.</p>

<p>Each question in the template has an animation where all the quick toggles are displayed, to take away all the stress away from the user as the website wants to assure a user is creating their survey/surveys with ease. In my opinion, this feature is absolutely necessary as this makes the overall experience more enjoyable and creating last minute surveys an absolute hassle-free experience.</p>

<p>On the contrary, if a user did not choose an option to go with the built-in templates, they can start from scratch where they have control over each and every little thing. First thing you are shown with is the option to name your survey and choose its type. A simple input field is shown after you have named your survey and given it a category with a drop-down menu where each option is clearly mentioned with a small picture making it clear how the format of your question will be like. The moment you create a question and choose its type, you can immediately preview it and answer it. This feature allows a user to check realistically how the question will be displayed to their audience.</p>



<h1>• User account set-up/login process</h1>
<p>Creating an account on this website is as easy as it gets. A user has to do minimum effort to create their account as they can sign-in using their current Google account, Facebook, Microsoft account and LinkedIn in which results in no need of sign-up at all; thus, hassle free experience.</p>
 
<p>On the sign-up page they have shown logos of the major companies to satisfy the user by confirming that their details will be stored securely. This is an essential part as online security is a major problem and having seen all these logos and confirmation in their terms and conditions clearly makes the user at ease knowing that their data is saved and is secured. </p>

<p>Coming back to the website is a pleasant experience too as the cookies are well used to show your details and a rhetorical question is asked to ensure that the user is actually you. If not, then you always have the option to sign-in or sign-up using the ordinary methods mentioned above. Again, a picture with some interesting facts are shown to make the website fun to use.</p>

<h1>• Ease of use </h1>

<p>Throughout the website colour contrasts are kept consistent. The main colours used are green and white to ensure that visibility is not a problem. This is very important for people who have colour blindness or any other disability which restricts them from seeing the information clearly as they can use the website without any hesitation.</p>

<p>Also, the colours chosen for the website are very pleasing to the naked eye and gives the user this general vibe of calmness as the makers are confident that the user will not have to worry about the features as everything is provided.</p>

<p>Users are always shown their personalised dashboards where they can edit, delete, share and send their own created survey. This provides a user more flexibility at any time if they make a mistake or are uncertain about anything, they have contentment that the survey can be edited any time giving them excellent ease of use and satisfaction. Moreover, they can make a copy of their survey which can come in handy if they want to create multiple surveys with similar format. Thus, creating templates etc are a button away.</p>

<p>The dashboard also displays things like the last time you edited a survey and the average response time etc. This live feed feature comes in handy as you do not have to open a survey. The makers have also implemented a survey tips column to help you if you are unsure of something. The survey tips section is well organised and is completed by professionals to assure users don’t have to compromise on their surveys and the surveys done by them are professional and accurate to their needs.</p>


<p>Furthermore, you can send your survey immediately to anyone using email, website implementation, social-media and many more options. This gives the owner of the survey many ways to deliver their survey and receive results. 

Survey Monkey can also help you find a perfect audience for your survey in case you don’t have enough data to come up with the accurate result.</p>

<h1>• Question types </h1>

<p>As expected SurveyMonkey absolutely shines in this department too mainly as this is the most important thing on their website and mainly this is what the users come to their website for and there is no disappointment at all.</p>

<p>Users have control over everything pretty much. After naming the survey users are shown a separate dashboard where they can generate their question according to their needs.</p>
Creating questions is absolutely easy. You are given a field and a question type where you can choose from 14 different options giving the user all the chances to get the best out of their survey.</p>

<p>A question bank is always given on the left so you never run out of ideas; this allows a user to search for questions which other have created and get key information from them and put it in their own questions. Moreover, they are given the option to create complex surveys which helps the user get accurate results.</p>

<h1>• Analysis tools</h1>

<p>Manual entry is also enabled for the survey as the user can create dummy data for their survey to see how the results are generated back from their survey. </p>


<p>The data is displayed in a bar chart showing useful information; allowing the user to take a glance at response time and other info such as Average Number, Total Number and Total Responses. Admin is also able to see who responded to their survey and at what time allowing them to come to a conclusion with more accurate data.</p>

<p>Finally, all the data and responses can be downloaded in csv file format. </p>

<h1>• Conclusion</h1>

<p>Overall this website is one of the best options for the users who would like to create hassle free surveys with thousands of templates and endless customisation for free. You are restricted to only having 10 questions in your survey but with the paid plan number of questions become a number not a restriction which professional use is perfect, and you do get extra features like downloading your surveys in multiple formats and much more.<p>

<h1 style="color:red;">Google Forms 
<h1>• Layout/presentation of surveys </h1>

<p>The next website that I am analysing is Google Forms where users can create surveys and get results but in a much easier way. Signing up/ signing-in takes you to the main page where they show you different templates which you can acquire. Each template as expected, can be edited. You have the option to edit the question, question type and general info etc.</p>

<p>The whole layout of the website is simple but very effective in what it does. For example, dashboard is updated when you work on a survey and it shows you the most recent survey every time you log-in. The developers have kept the layout simple but informative. Most importantly the website has all the fundamental features required to create a beautiful yet professional survey.</p>

<p>The whole experience of creating a survey is very sufficient which is what a typical user would require who hasn’t created a survey before. All this is achieved by the simplistic layout. </p>


<h1>• Ease of use </h1>

<p>One thing I love about google forms is just how simple it is to use. It is designed perfectly for both the beginners and the professionals. The simplicity is achieved because of the beautiful colour contrasts which complement each other very well. They are neither too bright nor too dull.</p>

<p>On the main page users are shown their recent forms that they were working on. There are two main ways of creating the surveys on google forms; either work on the templates or create your own survey from scratch where everything is done according to your needs.</p>

<p>If a user decides to create a survey from scratch, they are shown a form name which they can change to whatever they want and a small description field to make the survey a bit more descriptive to the target audience.</p>

<p>Just underneath it they are shown a question field called Untitled question which makes it apparent to the user that you are creating your question in this field. A question type is also visible all the time which allows the user to create questions with multiple question types. Although these question types are mandatory, Google forms allows you to upload images. This makes the surveys unique, beautiful and more appealing to the creator’s target audience. This feature can work out to be extremely helpful especially when you want to make your audience see something and then answer the questions.</p>

<h1>• User account set-up/login process </h1>

<p>Sign-up and Log-in is very simple yet 100% secure. All you need is a google account and you are good to go. No other questions are asked apart from your sign-in info and you are few clicks away from creating the surveys.</p>

<p>Signing-up creates a google account where you can use other applications which are part of google as well as Google Forms. Sign-up of google is probably the most secure as users are given options to enable two factor authentications as well as the option to add any recovery email address in case they forget their password or username.</p>

<p>On the other hand, log-in system of google forms is easy and convenient and in any case of inevitable data breach users are assured that their data is safe. </p>



<h1>• Question types </h1>

<p>As many other websites, google forms allow users to create text boxes, multiple-choice, drop-downs and many more different ways of asking a question. Everything is displayed with the icons next to them which is perfect for Spatial. Users are also given the option to choose their own theme colour, change font and even the background colour. This gives them more flexibility as to how they would like the website to look like.</p>

<p>Questions and their possible options appear according to the question type. For example, if you choose a Multiple-Choice-Grid as your question type, Google forms will execute rows and columns where you can just name them. This makes creating questions a very easy procedure as all the hard work is done by the program. </p>

<p>Copying and deleting a question is just a button away too, again the developers are trying to maintain the theme of simplicity.</p>

<p>Users are also able to preview their survey. This gives the realistic representation of what their survey will look like to their user.</p>

<p>Google forms also allows users to implement a video in their survey with the ease of just a button. This feature can come in handy if you are trying to make your audience watch a video and then answer as it can result in far more accurate data because the audience is more aware of the gist of the survey.</p>

<p>A main feature of Google Forms is immediate saving so nothing you type in gets lost. So, if an incident occurs and you close the tab or turn off your machine by accident; all your data is saved and will be available on any other device as long as you have the account details. This gives the user a relief while using Google Forms as they know everything is stored on the online workspace and will be accessible from any device at any time.</p>

<h1>• Analysis tools</h1>

<p>Once a survey is created the user can email, share the URL and even embed it in their html script. Also, they are given the option to share it on their socials. As soon as the user gets the response from their audience; the response is displayed in a bar chart. Moreover, the creator of the survey is also given the option to see individual responses.</p>

 
<p>The users are also allowed to download the response of their survey and select response destination etc as shown below. This allows the user to view results in a table format and send to other people if they want.</p>
 

<h1 style="color:red;">Survey Planet </h1>

<h1>• Layout/presentation of surveys</h1>

<p>Finally, the last website is Survey Planet which allows you to create unlimited surveys, questions and responses. The layout is simple and easy to navigate. </p>

<p>Clicking on create a survey displays a form where you give your survey a title and a welcome message etc; same as the other two websites. </p>

<p>Questions template can be used from a drop-down menu which is fully categorised and displays a title and the question type. You can also take the sample template which is a great feature as it gives the user a general idea on how theirs might look like. So far this has been the cleanest and the most organised website I have analysed out of the other two. Everything is simple and easy to use meaning even a beginner can produce a survey which is good enough. </p>

<h1>• Ease of use </h1>

This website is well optimised for multiple devices and allows the user to see how their surveys will operate on different devices. Everything is well displayed and laid out making navigation easy and all the necessary information is only displayed to the user.

Customisation is endless on Survey Planet; a user can edit all the questions, options, colours and can even choose themes which gives them flexibility and complete control over their survey.

Unlike SurveyMonkey users are given the option to choose their own themes which results in better accessibility and usability than the competitors. This also results in better long time effects due to a much better overall experience.

<h1>• User account set-up/login process </h1>

<p>Out of all the websites I have analysed; Survey Planet is the only website on which you have to sign up using your email and there is no other option of logging-in using your google account or social accounts. Once you click on sign up the website requires you to verify the email address. This may seem like a long procedure and less efficient; however, they want to ensure that they don’t have dummy data and fake accounts stored in their database.</p>

<p>Logging back in hassle free which means users don’t have to go through a validation process. </p>

<h1>• Question types </h1>

<p>Creating a question on Survey Planet is as easy as it gets. Users are provided with one of the best tools to ensure their surveys are professional and to the industry standards. The way users can create questions is probably the most convenient and the most fun way of doing it if compared to Survey Monkey and Google Forms.</p>

<p>A user can also select the order of the question as well as the layout which results in complete control over the behaviour of surveys.</p>

<h1>• Analysis tools</h1>
 

<p>The results are shown very professionally with all the important information displayed neatly which makes reading the answers very easy. Users also have the option to generate the results in different formats such as pie charts etc. This is essential as surveys recorded can be shown in different tables according to the needs.</p>


_END;
}

// finish off the HTML for this page:
require_once "footer.php";
?>