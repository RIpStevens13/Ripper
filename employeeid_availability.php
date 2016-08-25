<?php
//  Developed by Roshan Bhattarai 
//  Visit http://roshanbh.com.np for this script and more.
//  This notice MUST stay intact for legal use

//this varible contains the array of existing users

require_once('dbconnect.inc');

	// Get All Employee IDs for all HED Agents
	$SQL = "SELECT * FROM tblPersonnelData WHERE SupportGroup = 'hed'";
	$result = mysql_query($SQL);
	
	// Put Employee IDs into an Array so we can get all info based on it.
	$num=mysql_numrows($result);
	$i=0;
	while($i<$num) {
	$fieldname2 = mysql_result($result,$i, "EmployeeID");
	$existing_employeeid[] .= $fieldname2;
	$i++;
	}	

// $existing_users=array('roshan','mike','jason'); 

//value got from the get metho
$employeeid=$_POST['employeeid'];
//checking weather employee id exists or not in $existing_employeeid array
if (in_array($employeeid, $existing_employeeid))
{
	//employeeid is not availble
	echo "no";
} 
else
{
	//employeeid is available
	echo "yes";
}
?>