<?php

include("../includes/config.php");

$today=date("Y-n-j H:i:s");
$savedMonth=$_POST["savedMonth"];
$savedYear=$_POST["savedYear"];
$error=0;

$personName=trim(strip_tags($_POST["personName"]));
$Day=$_POST["Day"];
$Month=$_POST["Month"];

if(empty($personName))
{
	$error=1;
}

if($error==0)
{
	$query="INSERT INTO birthdays VALUES ('','$personName','$Day','$Month','$today')";
	$send=mysqli_query($dbconnect,$query) or die("Could not add birthday to the database.");
	
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
		header("Location: ../day.php?day=$savedDay&month=$savedMonth&year=$savedYear&type=submitBirthday&error=$error&personName=$personName&d=$Day&m=$Month");
	}
	else
	{
		header("Location: ../month.php?month=$savedMonth&year=$savedYear&type=submitBirthday&error=$error&personName=$personName&d=$Day&m=$Month");
	}
}

?>