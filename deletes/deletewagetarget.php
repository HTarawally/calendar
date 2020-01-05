<?php

include("../includes/config.php");

$savedMonth=$_GET["month"];
$savedYear=$_GET["year"];
$error=0;

$ID=$_GET["ID"];

if($error==0)
{
	$query="DELETE FROM wagetarget WHERE TargetID='$ID'";
	$send=mysqli_query($dbconnect,$query) or die("Could not delete wag target in the database.");
	
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
		header("Location: ../day.php?day=$savedDay&month=$savedMonth&year=$savedYear&type=deleteWageTarget&error=$error&ID=$ID");
	}
	else
	{
		header("Location: ../month.php?month=$savedMonth&year=$savedYear&type=deleteWageTarget&error=$error&ID=$ID");
	}
}

?>