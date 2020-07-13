<?php

include("../includes/config.php");

$savedMonth=$_GET["month"];
$savedYear=$_GET["year"];
$error=0;

$ID=$_GET["ID"];

$findCompany="SELECT * FROM workdone WHERE CompanyID='$ID'";
$queryCompany=mysqli_query($dbconnect,$findCompany);

while($resultCompany=mysqli_fetch_assoc($queryCompany))
{
	if($resultCompany["CompanyID"]==$ID)
	{
		$error=1;
	}
}

if($error==0)
{
	$query="DELETE FROM company WHERE CompanyID='$ID'";
	$send=mysqli_query($dbconnect,$query) or die("Could not delete company from the database.");
	
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
		header("Location: ../day.php?day=$savedDay&month=$savedMonth&year=$savedYear&type=deleteCompany&error=$error&ID=$ID");
	}
	else
	{
		header("Location: ../month.php?month=$savedMonth&year=$savedYear&type=deleteCompany&error=$error&ID=$ID");
	}
}

?>