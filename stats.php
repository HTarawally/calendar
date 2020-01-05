<?php include("includes/functions.php"); ?>
<?php include("includes/config.php"); ?>
<?php include("includes/settings.php"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Calender :: Stats Page</title>
<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript" src="jquery-1.6.4.min.js" ></script>
<script type="text/javascript" src="script.js" ></script>
</head>

<body>

	<div id="main">
    
    	<?php
		
			echo "<h1 class='year'>";
				echo "<a href='stats.php'>Stats Page</a>"; 
			echo "</h1>\n";
			echo "<div style='clear:both'></div>\n\n";
		
		?>
        
        <div id="left">
        
        	<div id="searchInfo">
                <?php
					echo $fullDays[calculateDay($todayDay,$todayMonth,$todayYear)];
					echo " " . $todayDay;
					
					if($todayDay==1 || $todayDay==21 || $todayDay==31)
					{
						echo "<sup>st</sup>\n";
					}
					else if($todayDay==2 || $todayDay==22)
					{
						echo "<sup>nd</sup>\n";
					}
					else if($todayDay==3 || $todayDay==23)
					{
						echo "<sup>rd</sup>\n";
					}
					else
					{
						echo "<sup>th</sup>\n";
					}
					
					echo " " . $months[$todayMonth-1] . " " . $todayYear;
				?>
            
                <br /><button type="button" onclick="document.location='index.php'">Back</button>
            </div>
            
        </div>
        
        <div id="right">
        
        	<div id="stats">
            	<?php
					$birthdayCount="SELECT count(*) FROM birthdays";
					$companyCount="SELECT count(*) FROM company";
					$hourstargetCount="SELECT count(*) FROM hourstarget";
					$categoriesCount="SELECT count(*) FROM paymentcategories";
					$paymentsCount="SELECT count(*) FROM payments";
					$remindersCount="SELECT count(*) FROM reminders";
					$wagetargetCount="SELECT count(*) FROM wagetarget";
					$workdoneCount="SELECT count(*) FROM workdone";
					
					$queryBirthdayCount=mysqli_query($dbconnect,$birthdayCount);
					$resultBirthdayCount=mysqli_fetch_row($queryBirthdayCount);
					
					$queryCompanyCount=mysqli_query($dbconnect,$companyCount);
					$resultCompanyCount=mysqli_fetch_row($queryCompanyCount);
					
					$queryHoursTargetCount=mysqli_query($dbconnect,$hourstargetCount);
					$resultHoursTargetCount=mysqli_fetch_row($queryHoursTargetCount);
					
					$queryCategoriesCount=mysqli_query($dbconnect,$categoriesCount);
					$resultCategoriesCount=mysqli_fetch_row($queryCategoriesCount);
					
					$queryPaymentsCount=mysqli_query($dbconnect,$paymentsCount);
					$resultPaymentsCount=mysqli_fetch_row($queryPaymentsCount);
					
					$queryRemindersCount=mysqli_query($dbconnect,$remindersCount);
					$resultRemindersCount=mysqli_fetch_row($queryRemindersCount);
					
					$queryWageTargetCount=mysqli_query($dbconnect,$wagetargetCount);
					$resultWageTargetCount=mysqli_fetch_row($queryWageTargetCount);
					
					$queryWorkDoneCount=mysqli_query($dbconnect,$workdoneCount);
					$resultWorkDoneCount=mysqli_fetch_row($queryWorkDoneCount);
				?>
            	
            	<table class="count">
                <tr><th colspan="2">Counts</th></tr>
                <tr>
                	<td><b>Birthdays:</b></td>
                    <td><?php echo $resultBirthdayCount[0]; ?></td>
                </tr>
                <tr>
                	<td><b>Reminders:</b></td>
                    <td><?php echo $resultRemindersCount[0]; ?></td>
                </tr>
                <tr><td></td></tr>
                <tr><td></td></tr>
                <tr>
                	<td><b>Companies:</b></td>
                    <td><?php echo $resultCompanyCount[0]; ?></td>
                </tr>
                <tr>
                	<td><b>Workdone:</b></td>
                    <td><?php echo $resultWorkDoneCount[0]; ?></td>
                </tr>
                <tr><td></td></tr>
                <tr><td></td></tr>
                <tr>
                	<td><b>Payment Categories:</b></td>
                    <td><?php echo $resultCategoriesCount[0]; ?></td>
                </tr>
                <tr>
                	<td><b>Payments:</b></td>
                    <td><?php echo $resultPaymentsCount[0]; ?></td>
                </tr>
                <tr><td></td></tr>
                <tr><td></td></tr>
                <tr>
                	<td><b>Number of Hour Targets:</b></td>
                    <td><?php echo $resultHoursTargetCount[0]; ?></td>
                </tr>
                <tr>
                	<td><b>Number of Wage Targets:</b></td>
                    <td><?php echo $resultWageTargetCount[0]; ?></td>
                </tr>
                </table>
                
                <?php
					$totalReceived=0; $totalSpent=0; $regular=0; $overtime=0; $hours=0; $minutes=0;
					$overtimeHours=0; $overtimeMinutes=0; $wagetarget=0; $hourstarget=0; 
					$getPayments="SELECT * FROM payments";
					$queryPayments=mysqli_query($dbconnect,$getPayments);
					
					while($resultPayments=mysqli_fetch_assoc($queryPayments))
					{
						if($resultPayments["Type"]==1) $totalReceived+=$resultPayments["Amount"];
						else $totalSpent+=$resultPayments["Amount"];
					}
					
					$getWorkDone="SELECT * FROM workdone";
					$queryWorkDone=mysqli_query($dbconnect,$getWorkDone);
					
					while($resultWorkDone=mysqli_fetch_assoc($queryWorkDone))
					{
						$hours=$resultWorkDone["Hours"];
						$minutes=$resultWorkDone["Minutes"]/60;
						$regular+=$resultWorkDone["Wage"]*($hours+$minutes);
						
						$overtimeHours=$resultWorkDone["OvertimeHours"];
						$overtimeMinutes=$resultWorkDone["OvertimeMinutes"]/60;
						$overtime+=$resultWorkDone["OvertimeWage"]*($overtimeHours+$overtimeMinutes);
					}
					
					$getWageTarget="SELECT * FROM wagetarget";
					$queryWageTarget=mysqli_query($dbconnect,$getWageTarget);
					
					while($resultWageTarget=mysqli_fetch_assoc($queryWageTarget)) $wagetarget+=$resultWageTarget["TotalTarget"];
					
					$getHoursTarget="SELECT * FROM hourstarget";
					$queryHoursTarget=mysqli_query($dbconnect,$getHoursTarget);
					
					while($resultHoursTarget=mysqli_fetch_assoc($queryHoursTarget))
					{
						$hourstarget+=$resultHoursTarget["HoursTarget"]+($resultHoursTarget["MinutesTarget"]/60);
					}
					
					$targetHours=floor($hourstarget);
					$targetMinutes=($hourstarget-$targetHours)*60;
					
				?>
                
                <table class="total">
                <tr>
                	<th>Total Received</th>
                    <th>Total Spent</th>
                    <th>Profit</th>
                </tr>
                <tr>
                	<td style="color:blue;">£<?php echo $totalReceived ?></td>
                    <td style="color:red;">£<?php echo $totalSpent ?></td>
                    <td style="color:<?php if($totalReceived-$totalSpent>=0) echo 'blue'; else echo 'red'?>">£<?php printf("%.2f",($totalReceived-$totalSpent)*(-1)) ?></td>
                </tr>
                </table>
                
                <table class="total">
                <tr>
                	<th>Regular Earnings</th>
                    <th>Overtime Earnings</th>
                    <th>Total</th>
                </tr>
                <tr>
                	<td>£<?php printf("%.2f", $regular); ?></td>
                    <td>£<?php printf("%.2f", $overtime); ?></td>
                    <td>£<?php printf("%.2f", $regular+$overtime); ?></td>
                </tr>
                </table>
                
                <table class="total">
                <tr>
                    <th>Hours Target</th>
                    <th>Wage Target</th>
                </tr>
                <tr>
                    <td><?php echo $targetHours . " hours and " . $targetMinutes . " minutes"; ?></td>
                    <td>£<?php printf("%.2f", $wagetarget); ?></td>
                </tr>
                </table>
                
            </div>
        
        </div>
        
    </div>

</body>
</html>