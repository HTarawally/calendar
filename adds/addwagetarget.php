<?php

include("../includes/config.php");

$today=date("Y-n-j H:i:s");
$savedMonth=$_POST["savedMonth"];
$savedYear=$_POST["savedYear"];
$error=0;

$TargetPound=trim(strip_tags($_POST["TargetPound"]));
$TargetPence=trim(strip_tags($_POST["TargetPence"]));
$Month=$_POST["Month"];
$Year=$_POST["Year"];

$TotalTarget=$TargetPound . "." . $TargetPence;

$queryWageTarget="SELECT * FROM wagetarget WHERE Year='$Year'";
$sendWageTarget=mysqli_query($dbconnect,$queryWageTarget);

while($resultWageTarget=mysqli_fetch_assoc($sendWageTarget))
{
	if($resultWageTarget["Month"]==$Month) $error=1;
}

if($TotalTarget==0) $error=2;

if($error==0)
{
	$query="INSERT INTO wagetarget VALUES ('','$TotalTarget','$Month','$Year','$today')";
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
		header("Location: ../day.php?day=$savedDay&month=$savedMonth&year=$savedYear&type=addWageTarget&error=$error&TargetPound=$TargetPound&TargetPence=$TargetPence&m=$Month&y=$Year");
	}
	else
	{
		header("Location: ../month.php?month=$savedMonth&year=$savedYear&type=addWageTarget&error=$error&TargetPound=$TargetPound&TargetPence=$TargetPence&m=$Month&y=$Year");
	}
}

?>