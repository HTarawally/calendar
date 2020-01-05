<?php

include("../includes/config.php");

$today=date("Y-n-j H:i:s");
$savedMonth=$_POST["savedMonth"];
$savedYear=$_POST["savedYear"];
$error=0;

$HoursTarget=$_POST["Hours"];
$MinutesTarget=$_POST["Minutes"];
$Month=$_POST["Month"];
$Year=$_POST["Year"];

$queryHoursTarget="SELECT * FROM hourstarget WHERE Year='$Year'";
$sendHoursTarget=mysqli_query($dbconnect,$queryHoursTarget);

while($resultHoursTarget=mysqli_fetch_assoc($sendHoursTarget))
{
	if($resultHoursTarget["Month"]==$Month) $error=1;
}

if($error==0)
{
	$query="INSERT INTO hourstarget VALUES ('','$HoursTarget','$MinutesTarget','$Month','$Year','$today')";
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
		header("Location: ../day.php?day=$savedDay&month=$savedMonth&year=$savedYear&type=addHoursTarget&error=$error&HoursTarget=$HoursTarget&MinutesTarget=$MinutesTarget&m=$Month&y=$Year");
	}
	else
	{
		header("Location: ../month.php?month=$savedMonth&year=$savedYear&&type=addHoursTarget&error=$error&HoursTarget=$HoursTarget&MinutesTarget=$MinutesTarget&m=$Month&y=$Year");
	}
}

?>