<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
 <title>Pod Information</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width">

  <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/bootstrap.css">
  <link rel="stylesheet" href="../css/main.css">
  <script src="../js/vendor/modernizr-2.6.2.min.js"></script>
  <script src="../js/addTableInput.js" language="Javascript" type="text/javascript"></script>
  <script src="../js/tableinput.js" language="Javascript" type="text/javascript"></script>
  <script src="../js/podinput.js" language="Javascript" type="text/javascript"></script>
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

<form action="completed5.php" method="post">

<?php require_once('dbconnect.inc'); ?>
<b>Current Access:</b> <br />
<?php
        $SQL = "SELECT * FROM tblPodAccess WHERE EmployeeID = '$_GET[EmployeeID]'";
        $result7 = mysql_query($SQL);

          echo "<table id='tableName' class='tablesorter table table-striped'><thead><tr><th><a>Product</a></th><th><a>Username</a></th><th><a>URL</a></th></tr></thead><tbody>";

        while($podaccess = mysql_fetch_assoc($result7)){

          echo "<tr><td>$podaccess[Product]</td><td>$podaccess[Username]</td><td>$podaccess[URL]</td></tr>"; 
        }
          echo "</table>";
?>

<hr>
<br />
<INPUT type="button" value="Add Row" onclick="addRow('dataTable')" />
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
	<?php
        $SQL = "SELECT * FROM tblPodAccess WHERE EmployeeID = '$_GET[EmployeeID]'";
        $result7 = mysql_query($SQL);

        while($podaccess = mysql_fetch_assoc($result7)){
		$SQL2 = "SELECT * FROM tblProductListing ORDER BY ProductName";
        	$result=mysql_query($SQL2);

        	$num=mysql_numrows($result);
        	$i=0;

		echo "<tr><td><select name='product[]'>";
        	while($i<$num) {
          		$fieldname2 = mysql_result($result,$i, "ProductName");
			if($fieldname2 == $podaccess[Product]){
          			echo "<option selected='selected' value='$fieldname2'>$fieldname2</option>";
			}
			else{
          			echo "<option value='$fieldname2'>$fieldname2</option>";
			}
          		$i++;
        	}
          	echo "</select></td><td><input type='text' name='username[]' value='$podaccess[Username]'></td><td><input type='text' name='url[]' value='$podaccess[URL]'></td></tr>"; 
        }
	?>
        <tr>
          <td>
    <select name="product[]">
      <?php
        $SQL = "SELECT * FROM tblProductListing ORDER BY ProductName";
        $result=mysql_query($SQL);

        $num=mysql_numrows($result);
        $i=0;
        while($i<$num) {
          $fieldname2 = mysql_result($result,$i, "ProductName");
          echo "<option value='$fieldname2'>$fieldname2</option>";
          $i++;
        }


      ?>
    </select>

     </td>
          <td><input type="text" name="username[]"></td>
          <td><input type="text" name="url[]"></td>
        </tr>
      </tbody>
    </table>

<input type="hidden" id="employeeid" name="employeeid" value="<?php echo "$_GET[EmployeeID]"; ?>" />
<input type="submit" id="submit" name="submit" value="submit" />
</form>

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
