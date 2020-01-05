<?php

include("../includes/config.php");

$today=date("Y-n-j H:i:s");
$savedMonth=$_POST["savedMonth"];
$savedYear=$_POST["savedYear"];
$error=0;

$ID=$_POST["wageTargetID"];
$WageTargetPound=trim(strip_tags($_POST["wageTargetPound"]));
$WageTargetPence=trim(strip_tags($_POST["wageTargetPence"]));
$Month=$_POST["wageTargetMonth"];
$Year=$_POST["wageTargetYear"];

$TotalTarget=$WageTargetPound . "." . $WageTargetPence;

if(empty($TotalTarget) || $TotalTarget==0)
{
	$error=1;
}

if($error==0)
{
	$query="UPDATE wagetarget SET TotalTarget='$TotalTarget', Month='$Month', Year='$Year', lastUpdated='$today' WHERE TargetID='$ID'";
	$send=mysqli_query($dbconnect,$query);
	
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
		header("Location: ../day.php?day=$savedDay&month=$savedMonth&year=$savedYear&type=editWageTarget&error=$error&ID=$ID&WagePound=$WageTargetPound&WagePence=$WageTargetPence&m=$Month&y=$Year");
	}
	else
	{
		header("Location: ../month.php?month=$savedMonth&year=$savedYear&type=editWageTarget&error=$error&ID=$ID&WagePound=$WageTargetPound&WagePence=$WageTargetPence&m=$Month&y=$Year");
	}
}

?>