<?php

include("../includes/config.php");

$today=date("Y-n-j H:i:s");
$savedMonth=$_POST["savedMonth"];
$savedYear=$_POST["savedYear"];
$error=0;

$Name=trim(strip_tags($_POST["Name"]));

$queryCompany="SELECT * FROM company WHERE CompanyName='$Name'";
$sendCompany=mysqli_query($dbconnect,$queryCompany);

while($resultCompany=mysqli_fetch_assoc($sendCompany))
{
	if($resultCompany["CompanyName"]==$Name) $error=1;
}

if(empty($Name))
{
	$error=2;
}

if($error==0)
{
	$query="INSERT INTO company VALUES ('','$Name','$today')";
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
		header("Location: ../day.php?day=$savedDay&month=$savedMonth&year=$savedYear&type=addCompany&error=$error&Name=$Name");
	}
	else
	{
		header("Location: ../month.php?month=$savedMonth&year=$savedYear&type=addCompany&error=$error&Name=$Name");
	}
}

?>