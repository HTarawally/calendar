<?php

include("../includes/config.php");

$today=date("Y-n-j H:i:s");
$savedMonth=$_POST["savedMonth"];
$savedYear=$_POST["savedYear"];
$error=0;

$ID=$_POST["paymentID"];
$Day=$_POST["paymentDay"];
$Month=$_POST["paymentMonth"];
$Year=$_POST["paymentYear"];
$AmountPound=trim(strip_tags($_POST["paymentAmountPound"]));
$AmountPence=trim(strip_tags($_POST["paymentAmountPence"]));
$Type=$_POST["paymentType"];
$Category=$_POST["paymentCategory"];

$Amount=$AmountPound . "." . $AmountPence;

if(empty($Amount) || $Amount<=0)
{
	$error=1;
}

if($error==0)
{
	$query="UPDATE payments SET Day='$Day', Month='$Month', Year='$Year', Amount='$Amount', Type='$Type', Category='$Category', lastUpdated='$today' WHERE PaymentID='$ID'";
	$send=mysqli_query($dbconnect,$query) or die("Could not edit payment in the database.");
	
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
		header("Location: ../day.php?day=$savedDay&month=$savedMonth&year=$savedYear&type=editPayment&error=$error&d=$Day&m=$Month&y=$Year&AmountPound=$AmountPound&AmountPence=$AmountPence&Type=$Type&Category=$Category");
	}
	else
	{
		header("Location: ../month.php?month=$savedMonth&year=$savedYear&type=editPayment&error=$error&d=$Day&m=$Month&y=$Year&AmountPound=$AmountPound&AmountPence=$AmountPence&Type=$Type&Category=$Category");
	}
}

?>