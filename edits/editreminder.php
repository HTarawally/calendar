<?php

include("../includes/config.php");

$today=date("Y-n-j H:i:s");
$savedMonth=$_POST["savedMonth"];
$savedYear=$_POST["savedYear"];
$error=0;

$ID=$_POST["reminderID"];
$Comment = trim(htmlentities(strip_tags($_POST["reminderComment"]), ENT_QUOTES));
$Day=$_POST["reminderDay"];
$Month=$_POST["reminderMonth"];
$Year=$_POST["reminderYear"];
$Occurrence=$_POST["reminderOccurrence"];
$Times=$_POST["reminderTimes"];

if($Occurrence==1) $Times=1;

if(empty($Comment))
{
	$error=1;
}

if($error==0)
{
	$query="UPDATE reminders SET Comment='$Comment', Day='$Day', Month='$Month', Year='$Year', Occurrence='$Occurrence', Times='$Times', lastUpdated='$today' WHERE reminderID='$ID'";
	$send=mysqli_query($dbconnect,$query) or die("Could not edit reminder in the database.");
	
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
		header("Location: ../day.php?day=$savedDay&month=$savedMonth&year=$savedYear&type=editReminder&error=$error&Comment=$Comment&d=$Day&m=$Month&y=$Year&Occurrence=$Occurrence&Times=$Times");
	}
	else
	{
		header("Location: ../month.php?month=$savedMonth&year=$savedYear&type=editReminder&error=$error&Comment=$Comment&d=$Day&m=$Month&y=$Year&Occurrence=$Occurrence&Times=$Times");
	}
}

?>