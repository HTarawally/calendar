<?php

include("../includes/config.php");

$today=date("Y-n-j H:i:s");
$savedMonth=$_POST["savedMonth"];
$savedYear=$_POST["savedYear"];
$error=0;

$ID=$_POST["hoursTargetID"];
$HoursTarget=$_POST["hoursTargetHours"];
$MinutesTarget=$_POST["hoursTargetMinutes"];
$Month=$_POST["hoursTargetMonth"];
$Year=$_POST["hoursTargetYear"];

if($error==0)
{
	$query="UPDATE hourstarget SET HoursTarget='$HoursTarget', MinutesTarget='$MinutesTarget', Month='$Month', Year='$Year', lastUpdated='$today' WHERE TargetID='$ID'";
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
		header("Location: ../day.php?day=$savedDay&month=$savedMonth&year=$savedYear&type=editHoursTarget&error=$error&ID=$ID&HoursTarget=$HoursTarget&MinutesTarget=$MinutesTarget&m=$Month&y=$Year");
	}
	else
	{
		header("Location: ../month.php?month=$savedMonth&year=$savedYear&type=editHoursTarget&error=$error&ID=$ID&HoursTarget=$HoursTarget&MinutesTarget=$MinutesTarget&m=$Month&y=$Year");
	}
}

?>