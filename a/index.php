<?php
    session_start();

    $_SESSION['prevURL'] = $_SERVER['REQUEST_URI'];
    
    //make this $_SESSION['adminSet'] if it's an admin-only page
    if(!$_SESSION['adminSet'])
	    {
		    header("location: ../../main_login.php");
	    }
?>

<!DOCTYPE html>
    <html>
        <head>
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
            <script src="js/loadtabs.js"></script>
	    <link rel='stylesheet' href="css/pikaday.css" />
        <link rel='stylesheet' href="css/adminpage.css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>

            <title>Admin Page</title>
        </head>
                <body style="background-color: dimgray;">
    <div id="puttheimagehere" style="position: fixed; opacity: 0.5; z-index: -1;">
	<img src="img/mobius.png">
    </div>
		
		
            <?php
         // set up mysql connection
	 error_reporting(0);
	 require_once("../connection.php");
	 require_once("../function.php");
         ?>
	 <div align="center">
         
         <h1 class="headerr">
             Edit PSCS
         </h1>
         
         <div class="options">
              <a href="../" id="goodbye" class="btn">Back to main page</a>
             
             <a href="?p=Students" id="button1" class="button">Students</a>
             <a href="?p=Events" id="button7" disabled class="button">Events</a>
             <a href="?p=Holidays" id="button5" class="button">Holidays</a>
        <a href="?p=Pws" id="button4" class="button">Pws</a >
        <a href="?p=Facilitators" id="button2" class="button">Facilitators</a>
        <a href="?p=Allotted-Hours" id="button3" class="button">Allotted Hours</a>
        <a href="?p=Globals" id="button6" class="button">Pws</a>
             
</div>
	    <?php
//echo htmlspecialchars($_GET["page"]);
if (htmlspecialchars($_GET["p"]) == "Students"){  
    //include_once('edit_students.php');
   include ('JSUrl/studentjs.php');
}
if (htmlspecialchars($_GET["p"]) == "Facilitators"){  
    include_once('JSUrl/facilitatorjs.php');    
}
if (htmlspecialchars($_GET["p"]) == "Allotted-Hours"){  
    include_once('JSUrl/allotted-hoursjs.php');    
}
if (htmlspecialchars($_GET["p"]) == "Pws"){  
    include_once('JSUrl/passwordsjs.php');    
}
if (htmlspecialchars($_GET["p"]) == "Holidays"){  
    include_once('JSUrl/holidaysjs.php');    
}
if (htmlspecialchars($_GET["p"]) == "Globals"){  
    include_once('JSUrl/globalsjs.php');    
}
?>
            
<!----- ALL TABS/PAGES ON ADMIN PAGE ----->


<!----- STUDENTS PAGE ----->
<div id="showdiv1">
<?php
// Get Student Page
    include_once("pages/edit_students.php");	
?>
</div>

<!----- FACILITATORS PAGE ----->
<div id="showdiv2">
<?php
// Get Facilitators page
    include_once("pages/edit_facilitators.php");	
?>
</div>

<!----- ALLOTTED HOURS PAGE ----->
<div id="showdiv3">
<?php
// Get Allotted-Hours page
    include_once("pages/edit_allottedhours.php");	
?>
</div>

<!----- PASSWORDS PAGE ----->
<div id="showdiv4">
<?php
// Get Get Passwords
    include_once("pages/edit_passwords.php");	
?>
</div>

<!----- HOLIDAYS PAGE ----->
<div id="showdiv5">
<?php
// Get Holidays Page
    include_once("pages/edit_holidays.php");	
?>
</div>

<!----- GLOBALS PAGE ----->
<div id="showdiv6">
<?php
// Get Globals
    include_once("pages/edit_globals.php");	
?>
</div>
	 </div>
                </body>
        
    </html>