<?php

include("../includes/config.php");

$today=date("Y-n-j H:i:s");
$savedMonth=$_POST["savedMonth"];
$savedYear=$_POST["savedYear"];
$error=0;

$ID=$_POST["birthDayID"];
$PersonName=trim(strip_tags($_POST["birthDayPersonName"]));
$Day=$_POST["birthDayDay"];
$Month=$_POST["birthDayMonth"];

if(empty($PersonName))
{
	$error=1;
}

if($error==0)
{
	$query="UPDATE birthdays SET PersonName='$PersonName', Day='$Day', Month='$Month', lastUpdated='$today' WHERE BirthDayID='$ID'";
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
		header("Location: ../day.php?day=$savedDay&month=$savedMonth&year=$savedYear&type=editBirthday&error=$error&ID=$ID&PersonName=$PersonName&d=$Day&m=$Month");
	}
	else
	{
		header("Location: ../month.php?month=$savedMonth&year=$savedYear&type=editBirthday&error=$error&ID=$ID&PersonName=$PersonName&d=$Day&m=$Month");
	}
}

?>