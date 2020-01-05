<?php

include("../includes/config.php");

$today=date("Y-n-j H:i:s");
$savedMonth=$_POST["savedMonth"];
$savedYear=$_POST["savedYear"];
$error=0;

$Name = trim(htmlentities(strip_tags($_POST["Name"]), ENT_QUOTES));

$findPaymentCategory="SELECT * FROM paymentcategories WHERE Name='$Name'";
$queryPaymentCategory=mysqli_query($dbconnect,$findPaymentCategory);

while($resultPaymentCategory=mysqli_fetch_assoc($queryPaymentCategory))
{
	if($resultPaymentCategory["Name"]=="$Name")
	{
		$error=1;
	}
}

if(empty($Name))
{
	$error=2;
}

if($error==0)
{
	$query="INSERT INTO paymentcategories VALUES ('','$Name', '$today')";
	$send=mysqli_query($dbconnect,$query) or die("Could not add payment category to the database.");
	
	if(isset($_POST["savedDay"]))
	{
		$savedDay=$_POST["savedDay"];
		header("Location: ../day.php?day=$savedDay&month=$savedMonth&year=$savedYear&confirm=1");
	}
	else
	{
		header("Location: ../month.php?month=$savedMonth&year=$savedYear&confirm=1");
	}
}
else
{
	if(isset($_POST["savedDay"]))
	{
		$savedDay=$_POST["savedDay"];
		header("Location: ../day.php?day=$savedDay&month=$savedMonth&year=$savedYear&type=addPaymentCategory&error=$error&Name=$Name");
	}
	else
	{
		header("Location: ../month.php?month=$savedMonth&year=$savedYear&type=addPaymentCategory&error=$error&Name=$Name");
	}
}

?>