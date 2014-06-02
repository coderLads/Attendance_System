<html>
<head>
<title>Admin: Edit Globals Table</title>
<link rel='stylesheet' href='style.css'/>
<link rel='stylesheet' href="css/pikaday.css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>
<link rel="stylesheet" type="text/css" href="css/jquery.timepicker.css">    
<script src="js/jquery.timepicker.min.js" type="text/javascript"></script>
     <script type="text/javascript">
	    $(document).ready(function(){
	    $('#starttimepicker').timepicker({ 'scrollDefaultNow': true, 'minTime': '8:00am', 'maxTime': '4:30pm', 'timeFormat': 'g:i', 'step': 5 });
	    $('#endtimepicker').timepicker({ 'scrollDefaultNow': true, 'minTime': '8:00am', 'maxTime': '4:30pm', 'timeFormat': 'g:i', 'step': 5 });
		});
    </script>
     
</head>
<body>
<h1>Edit Globals</h1>
<?php
	session_start();

	$_SESSION['prevURL'] = $_SERVER['REQUEST_URI'];
	
	//make this $_SESSION['adminSet'] if it's an admin-only page
	if(!$_SESSION['adminSet'])
	{
		header("location: main_login.php");
	}
?>
<?php
// set up mysql connection
	require_once("../connection.php");
//function document
	require_once("function.php");

// EDIT (UPDATE) GLOBALS
if (isset($_POST['save'])) {
 $editstartdate = strtotime($_POST['editstartdate']);
 $editenddate = strtotime($_POST['editenddate']);
 $stmt = $db_server->prepare("UPDATE globals SET startdate = FROM_UNIXTIME(?) , enddate = FROM_UNIXTIME(?) , starttime = ? , endtime = ? WHERE id = ?");
	  $stmt->bind_param('ssssi', $editstartdate, $editenddate, $_POST['starttime'], $_POST['endtime'], $_POST['id']); 
	  $stmt->execute(); 
	  $stmt->close();
	} 

	

// GET THE LIST OF GLOBALS
	$result = $db_server->query("SELECT * FROM globals ORDER BY startdate");

?>	

	 <style> 
.textbox { 
    background-color: #BDD7F1; 
    border: solid 1px #646464; 
    outline: none; 
    padding: 2px 2px; 
} 
tr:nth-child(odd)
{
background:#E7E7FF;
}
tr:nth-child(even)
{
background:#F7F7F7;
}
table
{
border-spacing:0px;
}
</style>
<table style="width:500px">
    
   <tr>
      <th style="text-align:left">Start Date</th>
      <th style="text-align:left">End Date</th>
      <th style="text-align:left">Start Time</th>
      <th style="text-align:left">End Time</th>
	  <th style="text-align:left">Edit</th>
   </tr>
<?php
// loop through list of names 
while ($list = mysqli_fetch_assoc($result)) { ?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<input type="hidden" name="id" value="<?php echo $list['id']; ?>">
	<tr>
		<?php $editme = "edit-" . $list['id'];
			if (isset($_POST[$editme])) { 
			$adjustedstartdate = new DateTime($list['startdate']);
			$adjustedenddate = new DateTime($list['enddate']);
		?> 
		<td><input type="text" name="editstartdate" id="editstartdate" value="<?php echo $adjustedstartdate->format('m d Y'); ?>" required></td>
		<td><input type="text" name="editenddate" id="editenddate" value="<?php echo $adjustedenddate->format('m d Y'); ?>" required></td>
		<td><input type="text" name="starttime" id="starttimepicker" value="<?php echo $list['starttime']; ?>" required></td>
                <td><input type="text" name="endtime" id="endtimepicker" value="<?php echo $list['endtime']; ?>" required></td>
		<td><button type="submit" name="save" value="<?php echo $list['id']; ?>">Save</button></td>
		<?php } else { ?>
		<td><?php echo $list['startdate']; ?></td>
		<td><?php echo $list['enddate']; ?></td>
                <td><?php echo $list['starttime']; ?></td>
		<td><?php echo $list['endtime']; ?></td>
		
		<td><input type="submit" name="edit-<?php echo $list['id']; ?>" value="Edit"></td>
		<?php } ?>
	</tr>
</form>
<?php 
} // end while
?>
</table>
            
  <!-- date picker javascript -->          
<script src="js/pikaday.js"></script>
<script>
    var picker = new Pikaday({ field: document.getElementById('editstartdate') });
</script>
<script src="js/pikaday.js"></script>
<script>
    var picker = new Pikaday({ field: document.getElementById('editenddate') });
</script>
</body>
</html>