<?php

include("../includes/config.php");

$today=date("Y-n-j H:i:s");
$savedMonth=$_POST["savedMonth"];
$savedYear=$_POST["savedYear"];
$error=0;

$Day=$_POST["Day"];
$Month=$_POST["Month"];
$Year=$_POST["Year"];
$AmountPound=trim(strip_tags($_POST["AmountPound"]));
$AmountPence=trim(strip_tags($_POST["AmountPence"]));
$Type=$_POST["Type"];
$Category=$_POST["Category"];

$Amount=$AmountPound . "." . $AmountPence;

if(empty($Amount) || $Amount<=0)
{
	$error=1;
}

if($error==0)
{
	$query="INSERT INTO payments VALUES ('','$Day','$Month','$Year','$Amount','$Type','$Category','$today')";
	$send=mysqli_query($dbconnect,$query) or die("Could not add payment to the database.");
	
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
		header("Location: ../day.php?day=$savedDay&month=$savedMonth&year=$savedYear&type=addPayment&error=$error&d=$Day&m=$Month&y=$Year&AmountPound=$AmountPound&AmountPence=$AmountPence&Type=$Type&Category=$Category");
	}
	else
	{
		header("Location: ../month.php?month=$savedMonth&year=$savedYear&type=addPayment&error=$error&d=$Day&m=$Month&y=$Year&AmountPound=$AmountPound&AmountPence=$AmountPence&Type=$Type&Category=$Category");
	}
}

?>