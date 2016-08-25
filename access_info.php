<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
 <title>Access Information</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width">

  <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/bootstrap.css">
  <link rel="stylesheet" href="../css/main.css">
  <script src="../js/vendor/modernizr-2.6.2.min.js"></script>
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
	echo "<a class='smitem'href='pod_info.php?EmployeeID=$empid'>Pod info</a>";
	echo "<a class='smitem'href='personal_data.php?EmployeeID=$empid'>Personnel Data</a>";

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

<?php  $SQL = "SELECT * FROM tblAccessInfo WHERE EmployeeID='$_GET[EmployeeID]'";
	$result = mysql_query($SQL);
	$SQL = "SELECT * FROM tblEquipmentInfo WHERE EmployeeID='$_GET[EmployeeID]'";
	$result2 = mysql_query($SQL);
	
	while($access = mysql_fetch_assoc($result) AND $equip = mysql_fetch_assoc($result2)){
echo "<form action='completed6.php' method='post'>

<div><fieldset><p><b>Please list the agents access information and numbers:</b>

      <label for='victoriaun'>Victoria Username:
      <input name='victoriaun' class='label-container' type='text' value='$access[VictoriaUsername]'></label>

      <label for='victoriapw'>Victoria Password:
      <input name='victoriapw' class='label-container' type='text' value='$access[VictoriaPassword]'></label>

      <label for='networkun'>Network Username:
      <input name='networkun' class='label-container' type='text' value='$access[NetworkUsername]'></label>

      <label for='jiraprojects'>JIRA Projects:
      <input name='jiraprojects' class='label-container' type='text' value='$access[JiraAssignments]'></label>

      <label for='victoriaqu'>Victoria Queues:
      <input name='victoriaqu' class='label-container' type='text' value='$access[VictoriaPodAssignments]'></label>

      <label for='computername'>Computer Name:
      <input name='computername' class='label-container' type='text' value='$equip[ComputerName]'></label>

      <label for='desktopmodel'>Desktop Model:
      <input name='desktopmodel' class='label-container' type='text' value='$equip[DesktopModel]'></label>

      <label for='desktopserial'>Desktop Serial Number:
      <input name='desktopserial' class='label-container' type='text' value='$equip[DesktopSerialNumber]'></label>

      <label for='monitor1serial'>Monitor 1 Serial:
      <input name='monitor1serial' class='label-container' type='text' value='$equip[MonitorSerialNumber1]'></label>

      <label for='monitor2serial'>Monitor 2 Serial:
      <input name='monitor2serial' class='label-container' type='text' value='$equip[MonitorSerialNumber2]'></label>";
}
?>
</p></fieldset></div>

<?php

	$SQL = "SELECT * FROM tblPodInfo WHERE EmployeeID = '$_GET[EmployeeID]'";
	$result = mysql_query($SQL);

	while($row = mysql_fetch_assoc($result)){
		extract($row);
		echo "Cross Trained In: <br />";
    if(stripos($CrossTrainedPods,"N2G") !== FALSE){
	echo "<input name='crosstrained[]' type='checkbox' value='N2G' checked />&nbsp;N2G &nbsp;";
    }
    else {
	echo "<input name='crosstrained[]' type='checkbox' value='N2G' />&nbsp;N2G &nbsp;";
    }
    if(stripos($CrossTrainedPods, "Skillnet") !== FALSE){
      echo "<input name='crosstrained[]' type='checkbox' value='Skillnet' checked />&nbsp;Skillnet &nbsp;";
    }
    else {
      echo "<input name='crosstrained[]' type='checkbox' value='Skillnet' />&nbsp;Skillnet &nbsp;";
    }
    if(stripos($CrossTrainedPods, "LMS") !== FALSE){
      echo "<input name='crosstrained[]' type='checkbox' value='LMS' checked />&nbsp;LMS &nbsp;";
    }
    else { 
      echo "<input name='crosstrained[]' type='checkbox' value='LMS' />&nbsp;LMS &nbsp;";
    }
    if(stripos($CrossTrainedPods, "Focus") !==FALSE){
      echo "<input name='crosstrained[]' type='checkbox' value='Focus' checked />&nbsp;FOCUS &nbsp;";
    }
    else {
      echo "<input name='crosstrained[]' type='checkbox' value='Focus' />&nbsp;FOCUS &nbsp;";
    }
    if(stripos($CrossTrainedPods, "CourseCare") !==FALSE){
      echo "<input name='crosstrained[]' type='checkbox' value='CourseCare' checked />&nbsp;CourseCare &nbsp;";
    }
    else {
      echo "<input name='crosstrained[]' type='checkbox' value='CourseCare' />&nbsp;CourseCare &nbsp;";
    }
}
?>

<?php

  $SQL = "SELECT * FROM tblOnboard WHERE EmployeeID = '$_GET[EmployeeID]'";
  $result = mysql_query($SQL);

  while($row = mysql_fetch_assoc($result)){
	extract($row);
	echo "Cross Trained In: <br />";
	if($OLR == "checked"){
  		echo "<input name='olr' type='checkbox' value='checked' checked />&nbsp;OLR &nbsp;";
    	}
    	else {
  		echo "<input name='olr' type='checkbox' value='checked' />&nbsp;OLR &nbsp;";
    	}
if($ACMS == "checked"){
      echo "<input name='acms' type='checkbox' value='checked' checked />&nbsp;ACMS &nbsp;";
    }
    else {
      echo "<input name='acms' type='checkbox' value='checked' />&nbsp;ACMS &nbsp;";
    }
	if($SSO == "checked"){
      echo "<input name='sso' type='checkbox' value='checked' checked />&nbsp;SSO &nbsp;";
    }
    else { 
      echo "<input name='sso' type='checkbox' value='checked' />&nbsp;SSO &nbsp;";
    }
	if($Confluence == "checked"){
      echo "<input name='confluence' type='checkbox' value='checked' checked />&nbsp;Confluence &nbsp;";
    }
    else {
      echo "<input name='confluence' type='checkbox' value='checked' />&nbsp;Confluence &nbsp;";
    }
	if($DataWarehouse == "checked"){
      echo "<input name='datawarehouse' type='checkbox' value='checked' checked />&nbsp;DataWarehouse &nbsp;";
    }
    else {
      echo "<input name='datawarehouse' type='checkbox' value='checked' />&nbsp;DataWarehouse &nbsp;";
    }
	if($E1 == "checked"){
      echo "<input name='e1' type='checkbox' value='checked' checked />&nbsp;E1 &nbsp;";
    }
    else {
      echo "<input name='e1' type='checkbox' value='checked' />&nbsp;E1 &nbsp;";
    }
	if($CMS == "checked"){
      echo "<input name='cms' type='checkbox' value='checked' checked />&nbsp;CMS &nbsp;";
    }
    else {
      echo "<input name='cms' type='checkbox' value='checked' />&nbsp;CMS &nbsp;";
    }
	if($Impact360 == "checked"){
      echo "<input name='impact360' type='checkbox' value='checked' checked />&nbsp;Impact360 &nbsp;";
    }
    else {
      echo "<input name='impact360' type='checkbox' value='checked' />&nbsp;Impact360 &nbsp;"; 
    } 
	if($Witness == "checked"){
      echo "<input name='witness' type='checkbox' value='checked' checked />&nbsp;Witness &nbsp;";
    }
    else {
      echo "<input name='witness' type='checkbox' value='checked' />&nbsp;Witness &nbsp;"; 
    }  
	if($CCEBackend == "checked"){
      echo "<input name='ccebackend' type='checkbox' value='checked' checked />&nbsp;CCEBackend &nbsp;";
    }
    else {
      echo "<input name='ccebackend' type='checkbox' value='checked' />&nbsp;CCEBackend &nbsp;"; 
    } 
	if($RDIVPNAccess == "checked"){
      echo "<input name='rdivpn' type='checkbox' value='checked' checked />&nbsp;RDIVPN &nbsp;";
    }
    else {
      echo "<input name='rdivpn' type='checkbox' value='checked' />&nbsp;RDIVPN &nbsp;"; 
    } 	
}  
?>

</p>
</p>

</p>
<input type="hidden" id="page" name="page" value="AccessInfo" />
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
