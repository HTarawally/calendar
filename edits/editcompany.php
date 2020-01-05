<?php

include("../includes/config.php");

$today=date("Y-n-j H:i:s");
$savedMonth=$_GET["month"];
$savedYear=$_GET["year"];
$error=0;

$ID=$_GET["ID"];
$Month=$_GET["month"];
$Year=$_GET["year"];
$Phrase=trim(strip_tags($_GET["phrase"]));

if(empty($Phrase))
{
	$error=1;
}

if($error==0)
{
	$query="UPDATE company SET CompanyName='$Phrase', lastUpdated='$today' WHERE CompanyID='$ID'";
	$send=mysqli_query($dbconnect,$query);
	
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
		header("Location: ../day.php?day=$savedDay&month=$savedMonth&year=$savedYear&type=editCompany&error=$error&ID=$ID&CompanyName=$Phrase&d=$Day&m=$Month&y=$Year");
	}
	else
	{
		header("Location: ../month.php?month=$savedMonth&year=$savedYear&type=editCompany&error=$error&ID=$ID&CompanyName=$Phrase&d=$Day&m=$Month&y=$Year");
	}
}

?>