<?php

include("../includes/config.php");

$today=date("Y-n-j H:i:s");
$savedMonth=$_POST["savedMonth"];
$savedYear=$_POST["savedYear"];
$error=0;

$ID=$_POST["workDoneID"];
$Day=$_POST["workDoneDay"];
$Month=$_POST["workDoneMonth"];
$Year=$_POST["workDoneYear"];
$CompanyID=$_POST["workDoneCompany"];
$Hours=$_POST["workDoneHours"];
$Minutes=$_POST["workDoneMinutes"];
$WagePound=trim(strip_tags($_POST["workDoneWagePound"]));
$WagePence=trim(strip_tags($_POST["workDoneWagePence"]));
$OvertimeHours=$_POST["workDoneOvertimeHours"];
$OvertimeMinutes=$_POST["workDoneOvertimeMinutes"];
$OvertimeWagePound=trim(strip_tags($_POST["workDoneOvertimeWagePound"]));
$OvertimeWagePence=trim(strip_tags($_POST["workDoneOvertimeWagePence"]));

$Wage=$WagePound . "." . $WagePence;
$OvertimeWage=$OvertimeWagePound . "." . $OvertimeWagePence;

if($Wage==0) $error=1;
else if($Hours==0 && $Minutes==0) $error=2;
else if(($OvertimeHours==0 && $OvertimeMinutes==0) && $OvertimeWage!=0) $error=3;
else if(($OvertimeHours!=0 || $OvertimeMinutes!=0) && $OvertimeWage==0) $error=4;

if($error==0)
{
	$query="UPDATE workdone SET Day='$Day', Month='$Month', Year='$Year', CompanyID='$CompanyID', Hours='$Hours', Minutes='$Minutes', Wage='$Wage', OvertimeHours='$OvertimeHours', OvertimeMinutes='$OvertimeMinutes', OvertimeWage='$OvertimeWage', lastUpdated='$today' WHERE WorkID='$ID'";
	$send=mysqli_query($dbconnect,$query) or die("Could not edit work done in the database.");
	
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
		header("Location: ../day.php?day=$savedDay&month=$savedMonth&year=$savedYear&type=editWorkDone&error=$error&Name=$Name&Company=$CompanyID&Hours=$Hours&Minutes=$Minutes&WagePound=$WagePound&WagePence=$WagePence&OvertimeHours=$OvertimeHours&OvertimeMinutes=$OvertimeMinutes&OvertimeWagePound=$OvertimeWagePound&OvertimeWagePence=$OvertimeWagePence");
	}
	else
	{
		header("Location: ../month.php?month=$savedMonth&year=$savedYear&type=editWorkDone&error=$error&Name=$Name&Company=$CompanyID&Hours=$Hours&Minutes=$Minutes&WagePound=$WagePound&WagePence=$WagePence&OvertimeHours=$OvertimeHours&OvertimeMinutes=$OvertimeMinutes&OvertimeWagePound=$OvertimeWagePound&OvertimeWagePence=$OvertimeWagePence");
	}
}

?>