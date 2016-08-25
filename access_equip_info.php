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
      <a class="smitem" href="access_equip_info.php">Access info</a>
      <a class="smitem" href="pod_info.php">Pod info</a>
      <a class="smitem" href="personal_data.php">Personnel Data</a>
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
<form action="completed.php" method="post">

<div><fieldset><p><b>Please list the numbers needed for this agents hardware information:</b>

      <label for="computername">Computer Name:
      <input name="computername" class="label-container" type="text"></label>

      <label for="desktopmodel">Desktop Model:
      <input name="desktopmodel" class="label-container" type="text"></label>

      <label for="desktopserial">Desktop Serial Number:
      <input name="desktopserial" class="label-container" type="text"></label>

      <label for="monitor1serial">Monitor 1 Serial:
      <input name="monitor1serial" class="label-container" type="text"></label>

      <label for="monitor2serial">Monitor 2 Serial:
      <input name="monitor2serial" class="label-container" type="text"></label>

</p></fieldset></div>

<p><INPUT type="button" value="Add Row" onclick="addRow('dataTable')" />
   <INPUT type="button" value="Delete Row" onclick="deleteRow('dataTable')" />
   <table id="dataTable" class="table table-striped">
   <thead>
   <tr>
    <th><a>Product</a></th>
    <th><a>Username</a></th>
    <th><a>URL</a></th>
   </tr>
   </thead>
   <tbody>
   <tr>
    <td><input type="text" name="product[]"></td>
    <td><input type="text" name="username[]"></td>
    <td><input type="text" name="url[]"></td>
   </tr>
   </tbody>
   </table>
</p>

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
