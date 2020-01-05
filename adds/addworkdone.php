<?php

include("../includes/config.php");

$today=date("Y-n-j H:i:s");
$savedMonth=$_POST["savedMonth"];
$savedYear=$_POST["savedYear"];
$error=0;

$Day=$_POST["Day"];
$Month=$_POST["Month"];
$Year=$_POST["Year"];
$CompanyID=$_POST["Company"];
$Hours=$_POST["Hours"];
$Minutes=$_POST["Minutes"];
$WagePound=trim(strip_tags($_POST["WagePound"]));
$WagePence=trim(strip_tags($_POST["WagePence"]));
$OvertimeHours=$_POST["OvertimeHours"];
$OvertimeMinutes=$_POST["OvertimeMinutes"];
$OvertimeWagePound=trim(strip_tags($_POST["OvertimeWagePound"]));
$OvertimeWagePence=trim(strip_tags($_POST["OvertimeWagePence"]));

$Wage=$WagePound . "." . $WagePence;
$OvertimeWage=$OvertimeWagePound . "." . $OvertimeWagePence;

$queryWorkDone="SELECT * FROM workdone WHERE CompanyID='$CompanyID'";
$sendWorkDone=mysqli_query($dbconnect,$queryWorkDone);

while($resultWorkDone=mysqli_fetch_assoc($sendWorkDone))
{
	if($resultWorkDone["Day"]==$Day && $resultWorkDone["Month"]==$Month && $resultWorkDone["Year"]==$Year)
	{
		$error=1;
	}
}

if($Hours==0 && $Minutes==0) $error=2;
else if($Wage==0) $error=3;
else if(($OvertimeHours!=0 || $OvertimeMinutes!=0) && ($OvertimeWage==0)) $error=4;
else if(($OvertimeWage!=0) && ($OvertimeHours==0 && $OvertimeMinutes==0)) $error=5;

if($error==0)
{
	$query="INSERT INTO workdone VALUES ('','$Day','$Month','$Year','$CompanyID','$Hours','$Minutes','$Wage','$OvertimeHours','$OvertimeMinutes','$OvertimeWage','$today')";
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
		header("Location: ../day.php?day=$savedDay&month=$savedMonth&year=$savedYear&type=addWorkDone&error=$error&d=$Day&m=$Month&y=$Year&CompanyID=$CompanyID&Hours=$Hours&Minutes=$Minutes&WagePound=$WagePound&WagePence=$WagePence&OvertimeHours=$OvertimeHours&OvertimeMinutes=$OvertimeMinutes&OvertimeWagePound=$OvertimeWagePound&OvertimeWagePence=$OvertimeWagePence");
	}
	else
	{
		header("Location: ../month.php?month=$savedMonth&year=$savedYear&type=addWorkDone&error=$error&d=$Day&m=$Month&y=$Year&CompanyID=$CompanyID&Hours=$Hours&Minutes=$Minutes&WagePound=$WagePound&WagePence=$WagePence&OvertimeHours=$OvertimeHours&OvertimeMinutes=$OvertimeMinutes&OvertimeWagePound=$OvertimeWagePound&OvertimeWagePence=$OvertimeWagePence");
	}
}

?>