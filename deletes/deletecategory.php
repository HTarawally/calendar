<?php

include("../includes/config.php");

$savedMonth=$_GET["month"];
$savedYear=$_GET["year"];
$error=0;

$ID=$_GET["ID"];

$secQuery="SELECT Category FROM payments WHERE Category='$ID'";
$secSend=mysqli_query($dbconnect,$secQuery) or die("Could not get payment from the database!");
$secResult=mysqli_fetch_assoc($secSend);

if($secResult["Category"]==$ID)
{
	$error=1;
}

if($error==0)
{
	$query="DELETE FROM paymentcategories WHERE PaymentCategoryID='$ID'";
	$send=mysqli_query($dbconnect,$query) or die("Could not delete payment category in the database.");
	
	if(isset($_GET["day"]))
	{
		$savedDay=$_GET["day"];
		header("Location: ../day.php?day=$savedDay&month=$savedMonth&year=$savedYear&confirm=1");
	}
	else
	{
		header("Location: ../month.php?month=$savedMonth&year=$savedYear&confirm=1");
	}
}
else
{
	if(isset($_GET["day"]))
	{
		$savedDay=$_GET["day"];
		header("Location: ../day.php?day=$savedDay&month=$savedMonth&year=$savedYear&type=deleteCategory&error=$error&ID=$ID");
	}
	else
	{
		header("Location: ../month.php?month=$savedMonth&year=$savedYear&type=deleteCategory&error=$error&ID=$ID");
	}
}

?>