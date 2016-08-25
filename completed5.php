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
        	$empid = $_POST[employeeid];

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

<?php
      $rowcount = count($_POST[product]);
      $i = 0;

      $SQL = "DELETE FROM tblPodAccess WHERE EmployeeID = '$_POST[employeeid]'";
      $result=mysql_query($SQL); 

      for($i; $i<$rowcount; $i++){
	   $product = mysql_real_escape_string($_POST[product][$i]);
	   $username = mysql_real_escape_string($_POST[username][$i]);
	   $url = mysql_real_escape_string($_POST[url][$i]);
   }
		
	// Inserting values Pod Access
	   $SQL = "INSERT INTO tblPodAccess (EmployeeID, Product, Username, URL) VALUES ('$_POST[employeeid]', '$product', '$username', '$url')";
	   $result=mysql_query($SQL);

	echo "<br />Thank you for adding the neccessary information.<br /><br />";
	echo "<a href='podaccess.php?EmployeeID=".$_POST[employeeid]."'>Click Here</a> to add Pod Specific Access.";
	echo "<br /><br /><p><a href='index.php'>Click Here</a> to go back to the Home Page.</p>";
	echo "<a href='add_new.php'>Click Here</a> to add another new user.";
?>


<br />Your updates have posted. Thank you!
<br /><br /><p><a href="../index.php">Click Here</a> to go back to our Home page.</p>
<a href="update.php">Click Here</a> to update more user information.


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
