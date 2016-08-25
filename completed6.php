<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Complete6</title>
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
        	$empid = $_POST["employeeid"];

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


<?php
if ($_POST['submit']) {
   
	require_once('dbconnect.inc');

	if($_POST[page] == "AccessInfo"){
		$SQL = "UPDATE tblAccessInfo SET VictoriaUsername = '$_POST[victoriaun]', VictoriaPassword = '$_POST[victoriapw]', JiraAssignments = '$_POST[jiraprojects]', NetworkUsername = '$_POST[networkun]', VictoriaPodAssignments = '$_POST[victoriaqu]' WHERE EmployeeID = '$_POST[employeeid]'";  
		$result = mysql_query($SQL);
		$SQL = "UPDATE tblEquipmentInfo SET ComputerName = '$_POST[computername]', DesktopModel = '$_POST[desktopmodel]', DesktopSerialNumber = '$_POST[desktopserial]', MonitorSerialNumber1 = '$_POST[monitor1serial]', MonitorSerialNumber2 = '$_POST[monitor2serial]' WHERE EmployeeID = '$_POST[employeeid]'";
		$result = mysql_query($SQL);

		if(!($_POST['crosstrained'] == "")){
      foreach($_POST['crosstrained'] as $_productType){
                	$producttype2 .= "{$_productType},";
                }
    }

		$SQL = "UPDATE tblPodInfo SET CrossTrainedPods = '$producttype2' WHERE EmployeeID = '$_POST[employeeid]'";
		$result = mysql_query($SQL);

		$SQL = "UPDATE tblOnboard SET OLR = '$_POST[olr]', ACMS = '$_POST[acms]', SSO = '$_POST[sso]', Confluence = '$_POST[confluence]', DataWarehouse = '$_POST[datawarehouse]', E1 = '$_POST[e1]', CMS = '$_POST[cms]', Impact360 = '$_POST[impact360]', Witness = '$_POST[witness]', CCEBackend = '$_POST[ccebackend]', RDIVPNAccess = '$_POST[rdivpn]' WHERE EmployeeID = '$_POST[employeeid]'";
		$result=mysql_query($SQL);

	}
	if($_POST[page] == "PersonnelData"){
		$SQL = "UPDATE tblPersonnelData SET Active = '$_POST[active]', OfficialStartDate = '$_POST[datepicker]', OfficialEndDate = '$_POST[datepicker2]', FirstName = '$_POST[firstname]', LastName = '$_POST[lastname]', EmailAddress = '$_POST[emailaddress]', SupportGroup = '$_POST[supportgroup]', RDIAgentNumber = '$_POST[rdiagentnumber]' WHERE EmployeeID = '$_POST[employeeid]'"; 
		$result = mysql_query($SQL);
		$SQL = "UPDATE tblEmergencyContact SET EmergencyName = '$_POST[emergeconname]', EmergencyNumber = '$_POST[emergeconnumber]', BackupName = '$_POST[backupemergeconname]', BackupNumber = '$_POST[backupemergeconnumber]', HomePhoneNumber = '$_POST[homephonenumber]', CellPhoneNumber = '$_POST[cellphonenumber]', PersonalEmailAddress = '$_POST[personalemailaddress]' WHERE EmployeeID = '$_POST[employeeid]'";
		$result = mysql_query($SQL);
		$SQL = "UPDATE tblPhoneInfo SET Extension = '$_POST[ext]', CMSLogin = '$_POST[cms]' WHERE EmployeeID = '$_POST[employeeid]'";
		$result = mysql_query($SQL);
	}

    mysql_close($dbhandle);
}
?>

<br />Thank you for submitting your enhancement request. This will look into each of these requests very closely and will work our best to make sure we are able to encorporate as many features as we can.
<br /><br /><p><a href="../index.php">Click Here</a> to go back to our Home page.</p>
<a href="add_new.php">Click Here</a> to add another enhancement request.

</form>
</div>
    </div>

      <div class="row-fluid">
        <div class="span12">
          <footer>&copy; 2013 Cengage Learning Technical Support</footer>
        </div>
      </div>
    </div>

    <script src="../js/vendor/jquery-1.9.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/plugins.js"></script>
    <script src="../js/main.js"></script>

    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
    <script>
      var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
      (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
      g.src='//www.google-analytics.com/ga.js';
      s.parentNode.insertBefore(g,s)}(document,'script'));
    </script>
  </body>
</html>
