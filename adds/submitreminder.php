<?php

include("../includes/config.php");

$today=date("Y-n-j H:i:s");
$savedMonth=$_POST["savedMonth"];
$savedYear=$_POST["savedYear"];
$error=0;

$Comment= trim(htmlentities(strip_tags($_POST["Comment"]), ENT_QUOTES));
$Day=$_POST["Day"];
$Month=$_POST["Month"];
$Year=$_POST["Year"];
$Occurrences=$_POST["Occurrences"];

if($Occurrences==1) $Times=1;
else $Times=$_POST["Times"];

if(empty($Comment))
{
	$error=1;
}

if($error==0)
{
	$query="INSERT INTO reminders VALUES ('','$Comment','$Day','$Month','$Year','$Occurrences','$Times','$today')";
	$send=mysqli_query($dbconnect,$query) or die("Could not add reminder to the database.");
	
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
		header("Location: ../day.php?day=$savedDay&month=$savedMonth&year=$savedYear&type=submitReminder&error=$error&Comment=$Comment&d=$Day&m=$Month&y=$Year&Occurrences=$Occurrences&Times=$Times");
	}
	else
	{
		header("Location: ../month.php?month=$savedMonth&year=$savedYear&type=submitReminder&error=$error&Comment=$Comment&d=$Day&m=$Month&y=$Year&Occurrences=$Occurrences&Times=$Times");
	}
}

?>