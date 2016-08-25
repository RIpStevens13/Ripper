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
    <script type="text/javascript" src="../js/jquery.validate.js"></script>
    <link rel="stylesheet" href="../resources/demos/style.css" />
    <script src="../js/addTableInput.js" language="Javascript" type="text/javascript"></script>
    <script src="../js/tableinput.js" language="Javascript" type="text/javascript"></script>
  <script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  function validateForm()
{
var x=document.forms["myForm"]["fname"].value;
if (x==null || x=="")
  {
  alert("First name must be filled out");
  return false;
  }
}
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
              <li><a href="update.php">Update</a></li>
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


<form action="completed.php" method="post">

<p><h4><b>Agent Personal Information</b></h4></p><br />

<fieldset><p><b>Please enter the agents user information below:</b><br />
   First Name: <input type="text" name="firstname"><br>
   Last Name: <input type="text" name="lastname"><br>
   Email Address: <input type="text" name="emailaddress"><br>
<div >
   Employee ID: <input name="employeeid" required type="text" id="employeeid" />
   <span id="msgbox" style="display:none"></span>
</div>

Please select which support group this agent is a member of:
<select name="supportgroup" id="supportgroup" onClick="createRDINumber()" required>
       <option value="">-SELECT-</option>
       <option value="hed">HED</option>
       <option value="rdi">RDI</option>
</select>
<div id="rdiinfo"></div>
   <br /><b>Emergency Contact Name: </b><input type="text" name="emergeconname"><br>
   <b>Emergency Contact Number: </b><input type="text" name="emergeconnumber"><br>
   <b>Backup Emergency Contact Name: </b><input type="text" name="backupemergeconname"><br>
   <b>Backup Emergency Contact Number: </b><input type="text" name="backupemergeconnumber"><br>
   <b>Home Phone Number: </b><input type="text" name="homephonenumber"><br>
   <b>Cell Phone Number: </b><input type="text" name="cellphonenumber"><br>
   <b>Personal Email Address: </b><input type="text" name="personalemailaddress"><br>

</p></fieldset><br />

<!--This is where you are able to input thr agents pod information.-->
<hr><div><fieldset><b>Agent Pod Information</b><br />

<br /><p>Please select which pod this agent will be entering:

<select name="currentpod" id="currentpod" onClick="tableCreate()" onsubmit="validateForm()" required>
    <option value="">-SELECT-</option> 
    <option value="DQT">DQT</option>   
    <option value="LMS">LMS</option>
    <option value="Coursecare">COURSECARE</option>
    <option value="New Hire">NEW HIRE</option>
    <option value="Focus">FOCUS</option>
    <option value="Skillnet">SKILLNET</option>
    <option value="N2G">N2G</option>
    <option value="MGMT">MGMT</option>
</select>

<br>Please select which shift the agent will be working:

<select name="starttime" required>
    <option value="">-SELECT-</option>
    <option value="morning">8:30-4:30</option>
    <option value="mid">10:00-6:00</option>
    <option value="night">1:00-9:00</option>
</select>

<br>Please select the Supervisor this agent will be reporting to:

<select name="supervisor" id="supervisor" required>
    <option value="">-SELECT-</option>
    <option value="Ryan Lother">Ryan Lother</option>
    <option value="David Sansfacon">David Sansfacon</option>
    <option value="Mark Willenbrink">Mark Willenbrink</option>
    <option value="David Schoonover">David Schoonover</option>
    <option value="Bo Barger">Bo Barger</option>
    <option value="Mike Brown">Mike Brown</option>
    <option value="Jud Singleton">Jud Singleton</option>
    <option value="Amy Stanton">Amy Stanton</option>
    <option value="David Schoonover">David Schoonover</option>
</select>

<br />
<div>
  <div class="span4">Select which pods this agent is crossed-trained in:</div>
  <div class="span6">
        <input name="crosstrained[]" type="checkbox" value="N2G" />&nbsp;N2G &nbsp;
        <input name="crosstrained[]" type="checkbox" value="Skillnet" />&nbsp;SKILLNET &nbsp;
        <input name="crosstrained[]" type="checkbox" value="LMS" />&nbsp;LMS &nbsp;
        <input name="crosstrained[]" type="checkbox" value="Focus" />&nbsp;FOCUS &nbsp;
        <input name="crosstrained[]" type="checkbox" value="CourseCare" />&nbsp;COURSECARE &nbsp;
        <br><br>
  </div>
</div>

<div>
  <div class="span4">Please select what onboarding access this agent has:</div>
  <div class="span6">
        <input name="olr" type="checkbox" value="checked" />&nbsp;OLR &nbsp;
        <input name="amcs" type="checkbox" value="checked" />&nbsp;ACMS &nbsp;
        <input name="sso" type="checkbox" value="checked" />&nbsp;SSO &nbsp;
        <input name="confluence" type="checkbox" value="checked" />&nbsp;Confluence &nbsp;
        <input name="datawarehouse" type="checkbox" value="checked" />&nbsp;DataWarehouse &nbsp;
        <input name="e1" type="checkbox" value="checked" />&nbsp;E1 &nbsp;
        <br /><input name="cms" type="checkbox" value="checked" />&nbsp;CMS &nbsp;
        <input name="impact360" type="checkbox" value="checked" />&nbsp;Impact360 &nbsp;
        <input name="witness" type="checkbox" value="checked" />&nbsp;Witness &nbsp;
        <input name="ccebackend" type="checkbox" value="checked" />&nbsp;CCEBackend &nbsp;
        <input name="rdivpn" type="checkbox" value="checked" />&nbsp;RDIVPN &nbsp;
  </div>
</div>
</fieldset></div>

<!--This is the area to add most of the agents network credentails.-->
<hr><div><fieldset><b>Agent Work Information</b><br />

<br /><p><b>Please list the numbers needed for this agents hardware information:</b>

      <label for="computername">Computer Name:
      <input name="computername" class="label-container" type="text"></label>

      <label for="desktopmodel">Desktop Model:
      <input name="desktopmodel" class="label-container" type="text"></label>

      <label for="desktopserial">Desktop Serial Number:
      <input name="desktopserial" class="label-container" type="text"></label>

      <label for="monitor1serial">Monitor 1 Serial:
      <input name="monitor1serial" class="label-container" type="text"></label>

      <label for="monitor2serial">Monitor 2 Serial:
      <input name="monitor2serial" class="label-container" type="text"></label></p>

<p><b>Please list the neccessary information needed for the new agent:</b>

      <label for="ext">Phone Extension:
      <input name="ext" class="label-container" type="text"></label>

      <label for="cms">CMS ID:
      <input name="cms" class="label-container" type="text"></label>

      <label for="networkun">Network Username:
      <input name="networkun" class="label-container" type="text"></label>

      <label for="networkpw">Network Password:
      <input name="networkpw" class="label-container" type="text"></label>

      <label for="victoriaun">Victoria Username:
      <input name="victoriaun" class="label-container" type="text"></label>

      <label for="victoriapw">Victoria Password:
      <input name="victoriapw" class="label-container" type="text"></label>

      <label for="victoriaqu">Victoria Queues:
      <input name="victoriaqu" id="victoriaqu" class="label-container" type="text"></label>

      <label for="jiraprojects">Jira Projects:
      <input name="jiraprojects" id="jiraprojects" class="label-container" type="text"></label>
      
</p></fieldset></div>

<p>Start Date: <input type="text" id="datepicker" name="datepicker" /></p>

<div id="addtable"></div>


<p><input type="submit" id="submit" name="submit" value="Submit" />
<input type="reset" value="Reset" /></p></form>

</div>
  </div>

      <div class="row-fluid">
        <div class="span12">
          <footer>&copy; 2013 Cengage Learning Technical Support</footer>
        </div>
      </div>
    </div>

<script language="javascript">
//<!---------------------------------+
//  Developed by Roshan Bhattarai 
//  Visit http://roshanbh.com.np for this script and more.
//  This notice MUST stay intact for legal use
// --------------------------------->
$(document).ready(function()
{
	$("#employeeid").blur(function()
	{
		//remove all the class add the messagebox classes and start fading
		$("#msgbox").removeClass().addClass('messagebox').text('Checking...').fadeIn("slow");
		//check the employee id exists or not from ajax
		$.post("employeeid_availability.php",{ employeeid:$(this).val() } ,function(data)
        {
		  if(data=='no') //if employee id is not avaiable
		  {
		  	$("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('This Employee ID Already exists').addClass('messageboxerror').fadeTo(900,1);
			});		
          }
		  else
		  {
		  	$("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('Employee ID available to register').addClass('messageboxok').fadeTo(900,1);	
			});
		  }
				
        });
 
	});

  $("#recordClientPhone").mask("(999) 999-9999");
  $("#recordClientPhoneAlt").mask("(999) 999-9999");
  $("#recordClientZip").mask("99999");
  $("#recordPropertyZip").mask("99999");  
  $("#recordPurchaseZip").mask("99999");  

  // add * to required field labels
  $('label.required').append('&nbsp;<strong>*</strong>&nbsp;');

  // accordion functions
  var accordion = $("#stepForm").accordion(); 
  var current = 0;
  
  $.validator.addMethod("pageRequired", function(value, element) {
    var $element = $(element)
    function match(index) {
      return current == index && $(element).parents("#sf" + (index + 1)).length;
    }
    if (match(0) || match(1) || match(2)) {
      return !this.optional(element);
    }
    return "dependency-mismatch";
  }, $.validator.messages.required)
  
  var v = $("#cmaForm").validate({
    errorClass: "warning",
    onkeyup: false,
    onblur: false,
    submitHandler: function() {
      alert("Submitted, thanks!");
    }
  });
  
  // back buttons do not need to run validation
  $("#sf2 .prevbutton").click(function(){
    accordion.accordion("activate", 0);
    current = 0;
  }); 
  $("#sf3 .prevbutton").click(function(){
    accordion.accordion("activate", 1);
    current = 1;
  }); 
});
</script>


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
