<?php

include("../includes/config.php");

$today=date("Y-n-j H:i:s");
$savedMonth=$_GET["month"];
$savedYear=$_GET["year"];
$error=0;

$ID=$_GET["ID"];
$phrase=trim(strip_tags($_GET["phrase"]));

if(empty($phrase))
{
	$error=1;
}

if($error==0)
{
	$query="UPDATE paymentcategories SET Name='$phrase', lastUpdated='$today' WHERE PaymentCategoryID='$ID'";
	$send=mysqli_query($dbconnect,$query) or die("Could not edit payment category in the database.");
	
	if(isset($_GET["day"]))
	{
		$savedDay=$_GET["day"];
		header("Location: ../day.php?day=$savedDay&month=$savedMonth&year=$savedYear&confirm=1");
	}
	else
	{
		header("Location: ../month.php?month=$savedMonth&year=$savedYear&confirm=1");
	}
}
else
{
	if(isset($_GET["day"]))
	{
		$savedDay=$_GET["day"];
		header("Location: ../day.php?day=$savedDay&month=$savedMonth&year=$savedYear&type=editCategory&error=$error&phrase=$phrase");
	}
	else
	{
		header("Location: ../month.php?month=$savedMonth&year=$savedYear&type=editCategory&error=$error&phrase=$phrase");
	}
}

?>