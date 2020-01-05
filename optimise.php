<?php include("includes/functions.php"); ?>
<?php include("includes/config.php"); ?>
<?php include("includes/settings.php"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Calendar Optimise</title>
</head>

<body>
	
    <?php
		
		$numOfDeletes=0;
		$searchReminders="SELECT * FROM reminders";
		$queryReminders=mysqli_query($dbconnect,$searchReminders) or die("Could not get reminders from database!");
		
		while($resultReminders=mysqli_fetch_assoc($queryReminders))
		{
			$Times=$resultReminders["Times"];
			
			if($Times!=(-1))
			{
				$reminderID=$resultReminders["ReminderID"];
				$startDay=$resultReminders["Day"];
				$startMonth=$resultReminders["Month"];
				$startYear=$resultReminders["Year"];
				$Occurrence=$resultReminders["Occurrence"];
				
				$today=strtotime("$todayDay-$todayMonth-$todayYear");
				$add=$settings["daysToOptimise"]*24*60*60;
				
				if($Occurrence==2) $Days=365;
				else if($Occurrence==3) $Days=30;
				else if($Occurrence==4) $Days=7;
				else if($Occurrence==5) $Days=1;
				else $Days=0;
				
				$startDate=strtotime("$startDay-$startMonth-$startYear");
				$endDate=strtotime("$startDay-$startMonth-$startYear");
				if($Days>0)
				{
					$difference=$Days*24*60*60;
					$endDate=$startDate+$difference;
				}
				
				if($today-$endDate>=$add)
				{
					$findReminder="DELETE FROM reminders WHERE ReminderID='$reminderID'";
					$deleteReminder=mysqli_query($dbconnect,$findReminder) or die("Could not delete reminder");
					
					$numOfDeletes++;
				}
				
			}
		}
		
		echo "<h1>Number of deletes = $numOfDeletes </h1>";
	?>
    
    <?php
	
		$numOfBirthdays=0;
		$searchBirthdays="SELECT * FROM birthdays ORDER BY PersonName ASC";
		$queryBirthdays=mysqli_query($dbconnect,$searchBirthdays) or die("Could not get birthdays from database to sort");
		
		while($resultBirthdays=mysqli_fetch_assoc($queryBirthdays))
		{
			$number= rand();
			
			$updateBirthday="UPDATE birthdays SET BirthDayID='$number' WHERE BirthDayID='$resultBirthdays[BirthDayID]'";
			$queryUpdateBirthdays=mysqli_query($dbconnect,$updateBirthday) or die("Could not update birthday");
		}
		
		$searchBirthdays="SELECT * FROM birthdays ORDER BY PersonName ASC";
		$queryBirthdays=mysqli_query($dbconnect,$searchBirthdays) or die("Could not get birthdays from database to sort second time");
			
		while($resultBirthdays=mysqli_fetch_assoc($queryBirthdays))
		{
			$numOfBirthdays++;;
			$updateBirthday="UPDATE birthdays SET BirthDayID='$numOfBirthdays' WHERE BirthDayID='$resultBirthdays[BirthDayID]'";
			$queryUpdateBirthdays=mysqli_query($dbconnect,$updateBirthday) or die("Could not update birthday second time / $numOfBirthdays");
		}
		
		
		echo "<br /><h2>Number of birthdays = $numOfBirthdays </h2>";
		
	?>
    
    <?php
	
		$numOfCompanies=0;
		$searchCompanies="SELECT * FROM company ORDER BY CompanyName ASC";
		$queryCompanies=mysqli_query($dbconnect,$searchCompanies) or die("Could not get company from database to sort");
		
		while($resultCompanies=mysqli_fetch_assoc($queryCompanies))
		{
			$number = rand();
			
			$updateCompany="UPDATE company SET CompanyID='$number' WHERE CompanyID='$resultCompanies[CompanyID]'";
			$queryUpdateCompany=mysqli_query($dbconnect,$updateCompany) or die("Could not update company");
			
			$updateWork="UPDATE workdone SET CompanyID='$number' WHERE CompanyID='$resultCompanies[CompanyID]'";
			$queryUpdateWork=mysqli_query($dbconnect,$updateWork) or die("Could not update work done");
		}
		
		$searchCompanies="SELECT * FROM company ORDER BY CompanyName ASC";
		$queryCompanies=mysqli_query($dbconnect,$searchCompanies) or die("Could not get company from database to sort second time");
		
		while($resultCompanies=mysqli_fetch_assoc($queryCompanies))
		{
			$numOfCompanies++;
			
			$updateCompany="UPDATE company SET CompanyID='$numOfCompanies' WHERE CompanyID='$resultCompanies[CompanyID]'";
			$queryUpdateCompany=mysqli_query($dbconnect,$updateCompany) or die("Could not update company second time / $numOfCompanies");
			
			$updateWork="UPDATE workdone SET CompanyID='$numOfCompanies' WHERE CompanyID='$resultCompanies[CompanyID]'";
			$queryUpdateWork=mysqli_query($dbconnect,$updateWork) or die("Could not update work done secondtime / $numOfCompanies");
		}	
		
		$getWorkTotal="SELECT count(*) FROM workdone";
		$queryWorkTotal=mysqli_query($dbconnect,$getWorkTotal) or die("Could not get work total");
		$WorkTotal=mysqli_fetch_row($queryWorkTotal);
		echo "<br /><h2>Number of companies = $numOfCompanies and Number of work = $WorkTotal[0]</h2>";
		
	?>
    
    <?php
	
		$numOfPaymentCategories=0;
		$searchCategories="SELECT * FROM paymentcategories ORDER BY Name ASC";
		$queryCategories=mysqli_query($dbconnect,$searchCategories) or die("Could not get payment categories from database to sort");
		
		while($resultCategories=mysqli_fetch_assoc($queryCategories))
		{
			$number = rand();
			
			$updateCategories="UPDATE paymentcategories SET PaymentCategoryID='$number' WHERE PaymentCategoryID='$resultCategories[PaymentCategoryID]'";
			$queryUpdateCategories=mysqli_query($dbconnect,$updateCategories) or die("Could not update payment category");
			
			$updatePayments="UPDATE payments SET Category='$number' WHERE Category='$resultCategories[PaymentCategoryID]'";
			$queryUpdatePayments=mysqli_query($dbconnect,$updatePayments) or die("Could not update payment");
		}
		
		$searchCategories="SELECT * FROM paymentcategories ORDER BY Name ASC";
		$queryCategories=mysqli_query($dbconnect,$searchCategories) or die("Could not get payment categories from database to sort");
		
		while($resultCategories=mysqli_fetch_assoc($queryCategories))
		{
			$numOfPaymentCategories++;
			
			$updateCategories="UPDATE paymentcategories SET PaymentCategoryID='$numOfPaymentCategories' WHERE PaymentCategoryID='$resultCategories[PaymentCategoryID]'";
			$queryUpdateCategories=mysqli_query($dbconnect,$updateCategories) or die("Could not update payment category second time / $numOfPaymentCategories");
			
			$updatePayments="UPDATE payments SET Category='$numOfPaymentCategories' WHERE Category='$resultCategories[PaymentCategoryID]'";
			$queryUpdatePayments=mysqli_query($dbconnect,$updatePayments) or die("Could not update payment second time / $numOfPaymentCategories");
		}	
		
		$getPaymentsTotal="SELECT count(*) FROM payments";
		$queryPaymentsTotal=mysqli_query($dbconnect,$getPaymentsTotal) or die("Could not get payments total");
		$PaymentTotal=mysqli_fetch_row($queryPaymentsTotal);
		echo "<br /><h2>Number of payment categories = $numOfPaymentCategories and Number of payments = $PaymentTotal[0]</h2>";
		
	?>
    
    <button type="button" onclick="document.location='index.php'">Home</button>
</body>
</html>