<?php
//changestatus inserts name, status and any comment associated into the studentInfo database
function changestatus($f_name, $f_status, $f_comment) {
    $query = "SELECT time FROM studentInfo WHERE name = '$f_name' ORDER BY time DESC LIMIT 1";
    $result = mysql_query($query)
        or die ('Error querying database 2.');
    $rowdata = mysql_fetch_array($result);   
    $last = new DateTime($rowdata[0]);
    
    $now = new DateTime();
    $nowstamp = $now->getTimestamp();
    $laststamp = $last->getTimestamp();
    $minutes = round(($nowstamp - $laststamp)/60);

    
    
    $query = "UPDATE studentInfo SET elapsed = '$minutes' WHERE name = '$f_name' AND time = '$rowdata[0]'";
    $result = mysql_query($query);

$query = "INSERT INTO studentInfo (name, status, comments)
    VALUES ('$f_name', '$f_status', '$f_comment')";
	$result = mysql_query($query)
		or die('Error querying database.');    

}

//defines valid time entries for time text boxes
//only allows integers and colons
function validTime($inTime) {
$pattern   =   "/^(([0-9])|([0-1][0-9])|([2][0-3])):?([0-5][0-9])$/";
 if(preg_match($pattern,$inTime)){
   return true;
 }
}

//checks if you've hit any of the submit buttons that are a part of the top form
function isPost(){
if (in_array("Present", $_POST)) {
    return true;
} elseif (in_array("Offsite", $_POST)){
    return true;
} elseif (in_array("Field Trip", $_POST)){
    return true;
} elseif (in_array("Sign Out", $_POST)){
    return true;
} else {
return false;
}
}

?>