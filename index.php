<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Home Page</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/main.css">
    <script src="js/vendor/modernizr-2.6.2.min.js"></script>
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
		<?php require_once('agents/dbconnect.inc'); ?>
		<?php
			session_start();
			if($_SESSION['group'] == "Admin"){
				echo "<li class='submenu'>";
      				echo "<a class='smheader' href='#'>Admin</a>";
      				echo "<a class='smitem' href='admin/add_new_user.php'>Add User</a>";
		  		echo "<a class='smitem' href='admin/edit_user_admin.php'>Edit User</a>";
              		echo "<a class='smitem' href='admin/bulk.php'>Bulk Upload</a>";

				$SQL = "SELECT * FROM tblNotification WHERE Username = '$_SESSION[name]' AND Viewed = 'false'";
				$result = mysql_query($SQL);
				$num = mysql_num_rows($result);
				if($num > 0){
					echo "<a class='smitem' href='admin/notification.php'><b>Notification ($num)</b></a>";
				}
				else {
					echo "<a class='smitem' href='admin/notification.php'>Notification</a>";
				}
    		    	echo "</li>";
			}
		?>
              <li><a href="index.php">Home</a></li>
              <li><a href="agents/add_new.php">Add</a></li>

              <li><a href="agents/update.php">Update</a></li>
              <li><a href="search.php">Search</a></li>
              <li><a href="HEDAgent.php">HED Agents</a></li>
              <li><a href="RDIAgent.php">RDI Agents</a></li>
		          <li><a href="hardware/hardware.php">Equipment Request</a></li>
              <li class="submenu">
              <a class="smheader" href="#">Training</a>
              <a class="smitem" href="training/add_training.php">Add Training</a>
              <a class="smitem" href="training/search_training.php">Search Training</a>
              </li>
		          <li><a href="redalert/redalert.php">Red Alert</a></li>
		          <li><a href="reporting/report.php">Reporting</a></li>
            </ul>
          </nav>
        </div>

        <div class="span10">

<div class="account span3 offset9">
<?php
session_start();
if(!isset($_SESSION['loggedin']))
{
	header( 'location:login.php' );
}
else
{
  echo "<p>Welcome ".$_SESSION['name']."! <a href='myaccount.php'>My Account</a> <a href='logout.php'>Logout</a></p>";
}

?>
</div>

<p><b>Welcome to AID</b></p>
<p>This is a multi-functional site designed to assist you with keeping better track of your agents and there information. This site is able to be used for both new and old employees and will show to be very useful in your day to day work and will also help to make sure we are keeping as good of track on the agents and their information as we can. It is our goal to make this site a one stop shop for all your agent information needs. Also with this site all the agent information will be centerlized in one location, this will not require you to open and go through many different spreadsheets.</p>









<!--marquee is able to be changed with changing the behavior to: slide, scroll and direction up, down-->
<br /><marquee behavior="alternate"><b>This is version 1.0 and we are working to update with our next release.</b></marquee>

<br /><p>If you would like to submit a feature request, please <a href="request.php">Click Here</a>.</p>

</div>
  </div>

      <div class="row-fluid">
        <div class="span12">
          <footer>&copy; 2013 Cengage Learning Technical Support</footer>
        </div>
      </div>
    </div>

    <script src="js/vendor/jquery-1.9.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>

    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
    <script>
      var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
      (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
      g.src='//www.google-analytics.com/ga.js';
      s.parentNode.insertBefore(g,s)}(document,'script'));
    </script>
  </body>
</html>