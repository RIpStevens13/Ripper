<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/main.css">
    <script src="../js/vendor/modernizr-2.6.2.min.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/plugins.js"></script>
    <script src="../js/main.js"></script>
    <link rel="stylesheet" href="../resources/demos/style.css" />
    <script src="../js/addTableInput.js" language="Javascript" type="text/javascript"></script>
    <script>
    $(function() {
    $( "#datepicker" ).datepicker();
   });
  </script>
  <script>
    $(function() {
    $( "#datepicker2" ).datepicker();
   });
  </script>
</head>
<body>
  <!--[if lt IE 7]>
        <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
  <![endif]-->

<div class="container-fluid">
 <div class="row-fluid">
  <div class="span12">
  <header>
  <div class="cengagebrand"><img src="http://cdn.cengage.com/images/sites/cengage/headerfooter/CengageLogo.png" alt="Cengage Learning Logo"></div>
  <h1>AID</h1>
  <h3>Agent Information Dashboard</h3>
  </header>
 </div>
</div>

<div class="row-fluid">
 <div class="span2">
  <nav>
   <ul class="nav nav-pills nav-stacked">
    <li><a href="../index.php">Home</a></li>
    <li><a href="add_new.php">Add</a></li>
    <li class="submenu">
      <a class="smheader" href="update.php">Update</a>
	<?php
        	$empid = $_GET["EmployeeID"];

	echo "<a class='smitem' href='access_info.php?EmployeeID=$empid'>Access info</a>";
	echo "<a class='smitem' href='pod_info.php?EmployeeID=$empid'>Pod info</a>";
	echo "<a class='smitem' href='personal_data.php?EmployeeID=$empid'>Personnel Data</a>";

	?>
    </li>
    <li><a href="../search.php">Search</a></li>
    <li><a href="../HEDAgent.php">HED Agents</a></li>
    <li><a href="../RDIAgent.php">RDI Agents</a></li>
    <li><a href="../hardware/hardware.php">Equipment Request</a></li>
    <li><a href="../redalert/redalert.php">Red Alert</a></li>
    <li><a href="../reporting/report.php">Reporting</a></li>
   </ul>
 </nav>
</div>

<div class="span10">

<div class="account span3 offset9">

<?php
session_start();
if(!isset($_SESSION['loggedin']))
{
  header( 'location:../login.php' );
}
else
{
  echo "<p>Welcome ".$_SESSION['name']."! <a href='../myaccount.php'>My Account</a> <a href='../logout.php'>Logout</a></p>";
}

?>
</div>

<?php require_once('dbconnect.inc'); ?>

<?php 
    $SQL = "SELECT * FROM tblPhoneInfo WHERE EmployeeID = '$_GET[EmployeeID]'";
    $result = mysql_query($SQL);
    $SQL = "SELECT * FROM tblEmergencyContact WHERE EmployeeID = '$_GET[EmployeeID]'";
    $result2 = mysql_query($SQL);
    $SQL = "SELECT * FROM tblPersonnelData WHERE EmployeeID = '$_GET[EmployeeID]'";
    $result3 = mysql_query($SQL);

    while($phone = mysql_fetch_assoc($result) AND $emergency = mysql_fetch_assoc($result2) AND $personnel = mysql_fetch_assoc($result3)){
        echo "<form action='completed6.php' method='post'>

<div><p><b>Please list the numbers needed for this agents hardware information:</b><br />

<br />Please select which support group this agent is a member of:
   <select name='supportgroup'>";
	if($personnel[SupportGroup] == "hed"){
       	echo "<option value='hed' selected='selected'>HED</option><option value='rdi'>RDI</option>";
	}
	else {
       	echo "<option value='hed'>HED</option><option value='rdi' selected='selected'>RDI</option>";
	}
echo "</select>
   <br />Please select if this agent is active or inactive:
   <select name='active'>";
  if($personnel[Active] == "Active"){
        echo "<option value='Active' selected='selected'>Active</option><option value='Inactive'>Inactive</option>";
  }
  else {
        echo "<option value='Active'>Active</option><option value='Inactive' selected='selected'>Inactive</option>";
  }
echo "</select>
   
   <label for='firstname'>First Name:
   <input name='firstname' class='label-container' type='text' value='$personnel[FirstName]'></label>

   <label for='lastname'>Last Name:
   <input name='lastname' class='label-container' type='text' value='$personnel[LastName]'></label>

   <label for='emailaddress'>Email Address:
   <input name='emailaddress' class='label-container' type='text' value='$personnel[EmailAddress]'></label>

   <label for='employeeid'>Employee ID:
   <input name='employeeid' class='label-container' type='text' value='$phone[EmployeeID]' readOnly='true'></label>

   <label for='rdiagentnumber'>RDI Agent Number:
   <input name='rdiagentnumber' class='label-container' type='text' value='$personnel[RDIAgentNumber]'></label>	

   <label for='ext'>Phone Extension:
   <input name='ext' class='label-container' type='text' value='$phone[Extension]'></label>

   <label for='cms'>CMS Login:
   <input name='cms' class='label-container' type='text' value='$phone[CMSLogin]'></label>

   <label for='emergeconname'>Emergency Contact Name:
   <input name='emergeconname' class='label-container' type='text' value='$emergency[EmergencyName]'></label>

   <label for='emergeconnumber'>Emergency Contact Number:
   <input name='emergeconnumber' class='label-container' type='text' value='$emergency[EmergencyNumber]'></label>

   <label for='backupemergeconname'>Backup Emergency Contact Name:
   <input name='backupemergeconname' class='label-container' type='text' value='$emergency[BackupName]'></label>

   <label for='backupemergeconnumber'>BackupEmergency Contact Number:
   <input name='backupemergeconnumber' class='label-container' type='text' value='$emergency[BackupNumber]'></label>

   <label for='backupemergeconnumber'>Home Phone Number:
   <input name='homephonenumber' class='label-container' type='text' value='$emergency[HomePhoneNumber]'></label>

   <label for='backupemergeconnumber'>Cell Phone Number:
   <input name='cellphonenumber' class='label-container' type='text' value='$emergency[CellPhoneNumber]'></label>

   <label for='backupemergeconnumber'>Personal Email Address:
   <input name='personalemailaddress' class='label-container' type='text' value='$emergency[PersonalEmailAddress]'></label>";

echo "<p>Offical Start Date: <input type='text' id='datepicker' name='datepicker' value='$personnel[OfficialStartDate]' /></p>";
echo "<p>Offical End Date: <input type='text' id='datepicker2' name='datepicker2' value='$personnel[OfficialEndDate]' /></p>";

}
?>   

</p></div>
<input type="hidden" id="page" name="page" value="PersonnelData" />
<input type="hidden" id="employeeid" name="employeeid" value="<?php echo "$_GET[EmployeeID]"; ?>" />
<p><input type="submit" id="submit" name="submit" value="Update" />
<input type="reset" value="Reset" /></p></form>

</div>
</div>

<div class="row-fluid">
 <div class="span12">
   <footer>&copy; 2013 Cengage Learning Technical Support</footer>
  </div>
 </div>
</div>

   <!-- <script src="../js/vendor/jquery-1.9.1.min.js"></script> -->
   <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
    <script>
      var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
      (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
      g.src='//www.google-analytics.com/ga.js';
      s.parentNode.insertBefore(g,s)}(document,'script'));
    </script>
  </body>
</html>
