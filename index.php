<?php include("includes/functions.php"); ?>
<?php include("includes/config.php"); ?>
<?php include("includes/settings.php"); ?>

<?php

	if(isset($_GET["year"])) $year=$_GET["year"];
	else $year=date("Y");
	
	$previousYear=$year-1;
	$nextYear=$year+1;
	$leapYear=isLeapYear($year);
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Calendar :: <?php echo $year ?></title>
<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript" src="jquery-1.6.4.min.js" ></script>
<script type="text/javascript" src="script.js" ></script>
</head>

<body>

	<div id="main">
    
    	<?php
		
		echo "<h1 class='year'>";
			echo "<a href='index.php?year=$previousYear' class='prev'>Previous Year</a>";
			echo $year; 
			echo "<a href='index.php?year=$nextYear' class='next'>Next Year</a>";
		echo "</h1>\n";
		echo "<div style='clear:both'></div>\n\n";
		
		for($n=0; $n<12; $n++)
		{
			$trans=$n+1;
			echo "<div id='months'";
				if($n==1 || $n==3 || $n==4 || $n==6 || $n==9 || $n==11)
				{
					echo "style='background:#F5D694;'";
				}
				else
				{
					echo "style='background:#FBF3BD;'";
				}
			echo ">";
				echo "<h1 class='head'>";
					echo "<a href='month.php?month=$trans&year=$year'>";
						echo $months[$n];
					echo "</a>";
					echo "<br />";
				echo "</h1>\n";
				for($k=0; $k<7; $k++)
				{
					echo "<div id='letterdays' style='font-weight:bold;'>";
						echo $dayLetters[$k];
					echo "</div>\n";
				}
				
				printDate($n+1, $year);
				
			echo "</div>\n\n";
		}
		
		?>
        
        <button type="button" id="more">More</button>
        <button type="button" onclick="document.location='stats.php'">Stats</button>
        <button type="botton" onclick="document.location='optimise.php'">Optimise</button>
        
        
        <div id="black"></div>
        <div id="boldHead">Hide</div>
        <div id="bold">
        
           <table id="paymentsummary" style="display:none;">
                    <tr><th colspan="4">Payment Summary This Year:</th></tr>
                    <tr>
                        <th width="130px">Category</th>
                        <th width="130px">Total Received</th>
                        <th width="130px">Total Spent</th>
                        <th width="130px">Profit</th>
                    </tr>
                    <tr height="10px"></tr>
                        <?php
                            
                            $totalSpent=0.00;
                            $totalReceived=0.00;
                            
                            $getPayments="SELECT * FROM payments WHERE Year=$year ORDER BY Category ASC";
                            $queryPayments=mysqli_query($dbconnect,$getPayments) or die("Could not get payments from database");
                            
                            $ready=0;
                            $index=-1;
                            
                            $cats=array();
                            $received=array();
                            
                            while($resultPayments=mysqli_fetch_assoc($queryPayments))
                            {
                                $getPaymentCategories="SELECT * FROM paymentcategories WHERE PaymentCategoryID='$resultPayments[Category]'";
                                $queryPaymentCategories=mysqli_query($dbconnect,$getPaymentCategories) or die("Could not get payment categories from database!");
                                $resultPaymentCategories=mysqli_fetch_assoc($queryPaymentCategories);
                                
                                if($ready<1)
                                {
                                    $previousCategory="a";
                                    $savedCategory=$resultPaymentCategories["Name"];
                                }
                                else 
                                {
                                    $previousCategory=$savedCategory;
                                    $savedCategory=$resultPaymentCategories["Name"];
                                }
                                
                                if($previousCategory!=$savedCategory)
                                {
                                    $index++;
                                    
                                    $received[$index]=0;
                                    $spent[$index]=0;
                                    $cats[$index]=$savedCategory;
                                    
                                    if($resultPayments["Type"]==1)
                                    {
                                        $received[$index]=$resultPayments["Amount"];
                                    }
                                    else
                                    {
                                        $spent[$index]=$resultPayments["Amount"];
                                    }
                                }
                                else
                                {
                                    $saved=$resultPayments["Amount"];
                                    
                                    if($resultPayments["Type"]==1)
                                    {
                                        $received[$index]+=$saved;
                                    }
                                    else
                                    {
                                        $spent[$index]+=$saved;
                                    }
                                }
                                
                                
                                $ready++;
                            }
                        
                        for($n=0; $n<=$index; $n++)
                        {
                            $totalReceived+=$received[$n];
                            $totalSpent+=$spent[$n];
                            
                            echo "<tr>";
                                echo "<td align=\"center\">" . $cats[$n] . "</td>\n";
                                echo "<td align=\"center\">£";
                                    printf("%.2f", $received[$n]);
                                echo "</td>\n";
                                echo "<td align=\"center\">£";
                                    printf("%.2f", $spent[$n]);
                                echo "</td>\n";
                                $profit=$received[$n]-$spent[$n];
                                echo "<td align=\"center\"";
                                    if($profit>0)
                                    {
                                        echo "style='color:blue;'";
                                    }
                                    else
                                    {
                                        $profit*=-1;
                                        echo "style='color:red;'";
                                    }
                                echo ">£";
                                    printf("%.2f", $profit);
                                echo "</td>\n";
                            echo "</tr>\n\n";
                        }
                            
                        ?>
                    <tr height="10px"></tr>
                    <tr>
                        <td align="center">Total</td>
                        <td align="center">£<?php printf("%.2f", $totalReceived); ?></td>
                        <td align="center">£<?php printf("%.2f", $totalSpent); ?></td>
                        <td align="center" 
                            <?php 
                                $profit=$totalReceived-$totalSpent; 
                                
                                if($profit>0)
                                {
                                    echo "style='color:blue;'";
                                }
                                else
                                {
                                    $profit*=-1;
                                    echo "style='color:red;'";
                                }
                            ?>
                        >£
                            <?php 
                                
                                printf("%.2f", $profit);
                                
                            ?>
                        </td>
                    </tr>
                    </table>
                    
              <table id="paymentsummary2" style="display:none;">
                    <tr><th colspan="4">Payment Summary All Time:</th></tr>
                    <tr>
                        <th width="130px">Category</th>
                        <th width="130px">Total Received</th>
                        <th width="130px">Total Spent</th>
                        <th width="130px">Profit</th>
                    </tr>
                    <tr height="10px"></tr>
                        <?php
                            
                            $totalSpent=0.00;
                            $totalReceived=0.00;
                            
                            $getPayments="SELECT * FROM payments ORDER BY Category ASC";
                            $queryPayments=mysqli_query($dbconnect,$getPayments) or die("Could not get payments from database");
                            
                            $ready=0;
                            $index=-1;
                            
                            $cats=array();
                            $received=array();
                            
                            while($resultPayments=mysqli_fetch_assoc($queryPayments))
                            {
                                $getPaymentCategories="SELECT * FROM paymentcategories WHERE PaymentCategoryID='$resultPayments[Category]'";
                                $queryPaymentCategories=mysqli_query($dbconnect,$getPaymentCategories) or die("Could not get payment categories from database!");
                                $resultPaymentCategories=mysqli_fetch_assoc($queryPaymentCategories);
                                
                                if($ready<1)
                                {
                                    $previousCategory="a";
                                    $savedCategory=$resultPaymentCategories["Name"];
                                }
                                else 
                                {
                                    $previousCategory=$savedCategory;
                                    $savedCategory=$resultPaymentCategories["Name"];
                                }
                                
                                if($previousCategory!=$savedCategory)
                                {
                                    $index++;
                                    
                                    $received[$index]=0;
                                    $spent[$index]=0;
                                    $cats[$index]=$savedCategory;
                                    
                                    if($resultPayments["Type"]==1)
                                    {
                                        $received[$index]=$resultPayments["Amount"];
                                    }
                                    else
                                    {
                                        $spent[$index]=$resultPayments["Amount"];
                                    }
                                }
                                else
                                {
                                    $saved=$resultPayments["Amount"];
                                    
                                    if($resultPayments["Type"]==1)
                                    {
                                        $received[$index]+=$saved;
                                    }
                                    else
                                    {
                                        $spent[$index]+=$saved;
                                    }
                                }
                                
                                
                                $ready++;
                            }
                        
                        for($n=0; $n<=$index; $n++)
                        {
                            $totalReceived+=$received[$n];
                            $totalSpent+=$spent[$n];
                            
                            echo "<tr>";
                                echo "<td align=\"center\">" . $cats[$n] . "</td>\n";
                                echo "<td align=\"center\">£";
                                    printf("%.2f", $received[$n]);
                                echo "</td>\n";
                                echo "<td align=\"center\">£";
                                    printf("%.2f", $spent[$n]);
                                echo "</td>\n";
                                $profit=$received[$n]-$spent[$n];
                                echo "<td align=\"center\"";
                                    if($profit>0)
                                    {
                                        echo "style='color:blue;'";
                                    }
                                    else
                                    {
                                        $profit*=-1;
                                        echo "style='color:red;'";
                                    }
                                echo ">£";
                                    printf("%.2f", $profit);
                                echo "</td>\n";
                            echo "</tr>\n\n";
                        }
                            
                        ?>
                    <tr height="10px"></tr>
                    <tr>
                        <td align="center">Total</td>
                        <td align="center">£<?php printf("%.2f", $totalReceived); ?></td>
                        <td align="center">£<?php printf("%.2f", $totalSpent); ?></td>
                        <td align="center" 
                            <?php 
                                $profit=$totalReceived-$totalSpent; 
                                
                                if($profit>0)
                                {
                                    echo "style='color:blue;'";
                                }
                                else
                                {
                                    $profit*=-1;
                                    echo "style='color:red;'";
                                }
                            ?>
                        >£
                            <?php 
                                
                                printf("%.2f", $profit);
    
                            ?>
                        </td>
                    </tr>
                    </table>
                    
                    <div style="clear:both"></div>
                    
                    <table id="companysummary" style="display:none;">
                    <tr><th colspan="8">Work Done Summary This Year:</th></tr>
                    <tr>
                        <th width="130px" valign="top">Company</th>
                        <th colspan="3" width="130px">
                            Regular
                            <table>
                            <tr><td width="43px">H</td><td width="43px">M</td><td width="44px">E</td></tr>
                            </table>
                        </th>
                        <th colspan="3" width="130px">
                            Overtime
                            <table>
                            <tr><td width="43px">H</td><td width="43px">M</td><td width="44px">E</td></tr>
                            </table>
                        </th>
                        <th width="130px" valign="top">Total Earned</th>
                    </tr>
                    <tr height="10px"></tr>
                        <?php
                            $totalRegularHoursYear=0.00;
                            $totalRegularMinutesYear=0.00;
                            $totalRegularWageYear=0.00;
                            $totalOvertimeHoursYear=0.00;
                            $totalOvertimeMinutesYear=0.00;
                            $totalOvertimeWageYear=0.00;
                            
                            $getWorkDone="SELECT * FROM workdone WHERE Year='$year' ORDER BY CompanyID ASC";
                            $queryWorkDone=mysqli_query($dbconnect,$getWorkDone) or die("Could not get work done from database!");
                            
                            $ready=0;
                            $index=-1;
                            
                            $companies=array();
                            
                            $regularHours=array();
                            $regularMinutes=array();
                            $regularWage=array();
                            
                            $overtimeHours=array();
                            $overtimeMinutes=array();
                            $overtimeWage=array();
                            
                            while($resultWorkDone=mysqli_fetch_assoc($queryWorkDone))
                            {
                                $getCompanies="SELECT * FROM company WHERE CompanyID='$resultWorkDone[CompanyID]'";
                                $queryCompanies=mysqli_query($dbconnect,$getCompanies) or die("Could not get companies from database!");
                                $resultCompanies=mysqli_fetch_assoc($queryCompanies);
                                
                                if($ready<1)
                                {
                                    $previousCompany="a";
                                    $savedCompany=$resultCompanies["CompanyName"];
                                }
                                else 
                                {
                                    $previousCompany=$savedCompany;
                                    $savedCompany=$resultCompanies["CompanyName"];
                                }
                                
                                if($previousCompany!=$savedCompany)
                                {
                                    $index++;
    
                                    $regularHours[$index]=$resultWorkDone["Hours"];
                                    $regularMinutes[$index]=($resultWorkDone["Minutes"])/60;
                                    $regularWage[$index]=(($resultWorkDone["Wage"]*$regularHours[$index])+($resultWorkDone["Wage"]*$regularMinutes[$index]));
                                    
                                    $overtimeHours[$index]=$resultWorkDone["OvertimeHours"];
                                    $overtimeMinutes[$index]=($resultWorkDone["OvertimeMinutes"])/60;
                                    $overtimeWage[$index]=(($resultWorkDone["OvertimeWage"]*$overtimeHours[$index])+($resultWorkDone["OvertimeWage"]*$overtimeMinutes[$index]));
                                    
                                    $companies[$index]=$savedCompany;
                                }
                                else
                                {
                                    $regularHours[$index]+=$resultWorkDone["Hours"];
                                    $regularMinutes[$index]+=($resultWorkDone["Minutes"])/60;
                                    $regularWage[$index]+=(($resultWorkDone["Wage"]*$resultWorkDone["Hours"])+($resultWorkDone["Wage"]*($resultWorkDone["Minutes"])/60));
                                    
                                    $overtimeHours[$index]+=$resultWorkDone["OvertimeHours"];
                                    $overtimeMinutes[$index]+=($resultWorkDone["OvertimeMinutes"])/60;
                                    $overtimeWage[$index]+=(($resultWorkDone["OvertimeWage"]*$resultWorkDone["OvertimeHours"])+($resultWorkDone["OvertimeWage"]*($resultWorkDone["OvertimeMinutes"])/60));
                                    
                                    if($regularMinutes[$index]>=1)
                                    {
                                        $regularHours[$index]+=1;
                                        $regularMinutes[$index]-=1;
                                    }
                                    
                                    if($overtimeMinutes[$index]>=1)
                                    {
                                        $overtimeHours[$index]+=1;
                                        $overtimeMinutes[$index]-=1;
                                    }
                                }
                                
                                $ready++;
                            }
                            
                            for($n=0; $n<=$index; $n++)
                            {
                                $totalRegularHoursYear+=$regularHours[$n];
                                $totalRegularMinutesYear+=$regularMinutes[$n];
                                $totalRegularWageYear+=$regularWage[$n];
                                $totalOvertimeHoursYear+=$overtimeHours[$n];
                                $totalOvertimeMinutesYear+=$overtimeMinutes[$n];
                                $totalOvertimeWageYear+=$overtimeWage[$n];
                                
                                if($totalRegularMinutesYear>=1)
                                {
                                    $totalRegularHoursYear+=1;
                                    $totalRegularMinutesYear-=1;
                                }
                                
                                if($totalOvertimeMinutesYear>=1)
                                {
                                    $totalOvertimeHoursYear+=1;
                                    $totalOvertimeMinutesYear-=1;
                                }
                                
                                echo "<tr>";
                                    echo "<td align='center' width='130px'>$companies[$n]</td>\n";
                                    echo "<td align='center' width='43px'>$regularHours[$n]</td>\n";
                                    echo "<td align='center' width='43px'>" . $regularMinutes[$n]*60 . "</td>\n";
                                    echo "<td align='center' width='44px'>£";
                                        printf("%.2f",$regularWage[$n]);
                                    echo "</td>\n";
                                    
                                    echo "<td align='center' width='43px'>$overtimeHours[$n]</td>\n";
                                    echo "<td align='center' width='43px'>" . $overtimeMinutes[$n]*60 . "</td>\n";
                                    echo "<td align='center' width='44px'>£";
                                        printf("%.2f",$overtimeWage[$n]) ;
                                    echo "</td>\n";
                                    echo "<td align='center' width='130px'>£";
                                        printf("%.2f",$regularWage[$n]+$overtimeWage[$n]);
                                    echo "</td>\n";
                                echo "</tr>\n\n";
                            }
                            
                        ?>
                    <tr height="10px"></tr>
                    <tr>
                        <td width="130px" align="center">Total</td>
                        <td width="43px" align="center"><?php echo $totalRegularHoursYear; ?></td>
                        <td width="43px" align="center"><?php echo $totalRegularMinutesYear*60; ?></td>
                        <td width="44px" align="center">£<?php printf("%.2f",$totalRegularWageYear); ?></td>
                        <td width="43px" align="center"><?php echo $totalOvertimeHoursYear; ?></td>
                        <td width="43px" align="center"><?php echo $totalOvertimeMinutesYear*60; ?></td>
                        <td width="44px" align="center">£<?php printf("%.2f",$totalOvertimeWageYear); ?></td>
                        <td width="130px" align="center">£<?php printf("%.2f",$totalRegularWageYear+$totalOvertimeWageYear); ?></td>
                    </tr>
                    </table>
                    
                    <table id="companysummary2" style="display:none;">
                    <tr><th colspan="8">Work Done Summary All Time:</th></tr>
                    <tr>
                        <th width="130px" valign="top">Company</th>
                        <th colspan="3" width="130px">
                            Regular
                            <table>
                            <tr><td width="43px">H</td><td width="43px">M</td><td width="44px">E</td></tr>
                            </table>
                        </th>
                        <th colspan="3" width="130px">
                            Overtime
                            <table>
                            <tr><td width="43px">H</td><td width="43px">M</td><td width="44px">E</td></tr>
                            </table>
                        </th>
                        <th width="130px" valign="top">Total Earned</th>
                    </tr>
                    <tr height="10px"></tr>
                        <?php
                            $totalRegularHours=0.00;
                            $totalRegularMinutes=0.00;
                            $totalRegularWage=0.00;
                            $totalOvertimeHours=0.00;
                            $totalOvertimeMinutes=0.00;
                            $totalOvertimeWage=0.00;
                            
                            $getWorkDone="SELECT * FROM workdone ORDER BY CompanyID ASC";
                            $queryWorkDone=mysqli_query($dbconnect,$getWorkDone) or die("Could not get work done from database!");
                            
                            $ready=0;
                            $index=-1;
                            
                            $companies=array();
                            
                            $regularHours=array();
                            $regularMinutes=array();
                            $regularWage=array();
                            
                            $overtimeHours=array();
                            $overtimeMinutes=array();
                            $overtimeWage=array();
                            
                            while($resultWorkDone=mysqli_fetch_assoc($queryWorkDone))
                            {
                                $getCompanies="SELECT * FROM company WHERE CompanyID='$resultWorkDone[CompanyID]'";
                                $queryCompanies=mysqli_query($dbconnect,$getCompanies) or die("Could not get companies from database!");
                                $resultCompanies=mysqli_fetch_assoc($queryCompanies);
                                
                                if($ready<1)
                                {
                                    $previousCompany="a";
                                    $savedCompany=$resultCompanies["CompanyName"];
                                }
                                else 
                                {
                                    $previousCompany=$savedCompany;
                                    $savedCompany=$resultCompanies["CompanyName"];
                                }
                                
                                if($previousCompany!=$savedCompany)
                                {
                                    $index++;
    
                                    $regularHours[$index]=$resultWorkDone["Hours"];
                                    $regularMinutes[$index]=($resultWorkDone["Minutes"])/60;
                                    $regularWage[$index]=(($resultWorkDone["Wage"]*$regularHours[$index])+($resultWorkDone["Wage"]*$regularMinutes[$index]));
                                    
                                    $overtimeHours[$index]=$resultWorkDone["OvertimeHours"];
                                    $overtimeMinutes[$index]=($resultWorkDone["OvertimeMinutes"])/60;
                                    $overtimeWage[$index]=(($resultWorkDone["OvertimeWage"]*$overtimeHours[$index])+($resultWorkDone["OvertimeWage"]*$overtimeMinutes[$index]));
                                    
                                    $companies[$index]=$savedCompany;
                                }
                                else
                                {
                                    $regularHours[$index]+=$resultWorkDone["Hours"];
                                    $regularMinutes[$index]+=($resultWorkDone["Minutes"])/60;
                                    $regularWage[$index]+=(($resultWorkDone["Wage"]*$resultWorkDone["Hours"])+($resultWorkDone["Wage"]*($resultWorkDone["Minutes"])/60));
                                    
                                    $overtimeHours[$index]+=$resultWorkDone["OvertimeHours"];
                                    $overtimeMinutes[$index]+=($resultWorkDone["OvertimeMinutes"])/60;
                                    $overtimeWage[$index]+=(($resultWorkDone["OvertimeWage"]*$resultWorkDone["OvertimeHours"])+($resultWorkDone["OvertimeWage"]*($resultWorkDone["OvertimeMinutes"])/60));
                                    
                                    if($regularMinutes[$index]>=1)
                                    {
                                        $regularHours[$index]+=1;
                                        $regularMinutes[$index]-=1;
                                    }
                                    
                                    if($overtimeMinutes[$index]>=1)
                                    {
                                        $overtimeHours[$index]+=1;
                                        $overtimeMinutes[$index]-=1;
                                    }
                                }
                                
                                $ready++;
                            }
                            
                            for($n=0; $n<=$index; $n++)
                            {
                                $totalRegularHours+=$regularHours[$n];
                                $totalRegularMinutes+=$regularMinutes[$n];
                                $totalRegularWage+=$regularWage[$n];
                                $totalOvertimeHours+=$overtimeHours[$n];
                                $totalOvertimeMinutes+=$overtimeMinutes[$n];
                                $totalOvertimeWage+=$overtimeWage[$n];
                                
                                if($totalRegularMinutes>=1)
                                {
                                    $totalRegularHours+=1;
                                    $totalRegularMinutes-=1;
                                }
                                
                                if($totalOvertimeMinutes>=1)
                                {
                                    $totalOvertimeHours+=1;
                                    $totalOvertimeMinutes-=1;
                                }
                                
                                echo "<tr>";
                                    echo "<td align='center' width='130px'>$companies[$n]</td>\n";
                                    echo "<td align='center' width='43px'>$regularHours[$n]</td>\n";
                                    echo "<td align='center' width='43px'>" . $regularMinutes[$n]*60 . "</td>\n";
                                    echo "<td align='center' width='44px'>£";
                                        printf("%.2f",$regularWage[$n]);
                                    echo "</td>\n";
                                    
                                    echo "<td align='center' width='43px'>$overtimeHours[$n]</td>\n";
                                    echo "<td align='center' width='43px'>" . $overtimeMinutes[$n]*60 . "</td>\n";
                                    echo "<td align='center' width='44px'>£";
                                        printf("%.2f",$overtimeWage[$n]) ;
                                    echo "</td>\n";
                                    echo "<td align='center' width='130px'>£";
                                        printf("%.2f",$regularWage[$n]+$overtimeWage[$n]);
                                    echo "</td>\n";
                                echo "</tr>\n\n";
                            }
                            
                        ?>
                    <tr height="10px"></tr>
                    <tr>
                        <td width="130px" align="center">Total</td>
                        <td width="43px" align="center"><?php echo $totalRegularHours; ?></td>
                        <td width="43px" align="center"><?php echo $totalRegularMinutes*60; ?></td>
                        <td width="44px" align="center">£<?php printf("%.2f",$totalRegularWage); ?></td>
                        <td width="43px" align="center"><?php echo $totalOvertimeHours; ?></td>
                        <td width="43px" align="center"><?php echo $totalOvertimeMinutes*60; ?></td>
                        <td width="44px" align="center">£<?php printf("%.2f",$totalOvertimeWage); ?></td>
                        <td width="130px" align="center">£<?php printf("%.2f",$totalRegularWage+$totalOvertimeWage); ?></td>
                    </tr>
                    </table>
                    
                    <div id="targetsSet" style="display:none; margin-right:140px;">
                    <?php
        
                        $findHoursTarget="SELECT * FROM hourstarget WHERE Year='$year'";
                        $queryHoursTargets=mysqli_query($dbconnect,$findHoursTarget) or die("Could get get hours targets from database!");
                        
                        $setTS=0;
                        
                        $totalHoursTarget=0;
                        $totalMinutesTarget=0;
                        $totalTarget=0;
                        
                        $totalWorkedHoursYear=$totalRegularHoursYear+$totalRegularMinutesYear+$totalOvertimeHoursYear+$totalOvertimeMinutesYear;
                        
                        while($resultHoursTargets=mysqli_fetch_assoc($queryHoursTargets))
                        {						
                            $totalHoursTarget+=$resultHoursTargets["HoursTarget"];
                            $totalMinutesTarget+=($resultHoursTargets["MinutesTarget"]/60);
                        }
                        
                        $totalTarget+=($totalHoursTarget+$totalMinutesTarget);
                        $floorTotalTarget=floor($totalTarget);
                        $TotalTargetMinutes=$totalTarget-$floorTotalTarget;
                        
                        if($totalTarget!=0)
                        {
                            if($setTS<1) echo "<h3>Total Targets This Year:</h3><br />\n";
                            
                            echo "<div id='birth'>";
                            echo "<table style='width:750px;'>";
                                echo "<tr>";
                                echo "<td style='width:620px;'>";
                                    echo "A total target of " . $floorTotalTarget . " hours";
                                    if($TotalTargetMinutes!=0)
                                    {
                                        echo " and " . ($TotalTargetMinutes*60) . " minutes";
                                    }
                                    echo ".";
                                    
                                    $difference=$totalTarget-$totalWorkedHoursYear;
                                    
                                    if($difference>0)
                                    {
                                        $flooredDiff=floor($difference);
                                        $minutesDiff=$difference-$flooredDiff;
                                        echo " You have " . $flooredDiff . " hours and " . ($minutesDiff*60) . " minutes hours to go";
                                    }
                                    else if($difference==0)
                                    {
                                        echo "You met the target perfectly";
                                    }
                                    else
                                    {
                                        $difference*=(-1);
                                        $flooredDiff=floor($difference);
                                        $minutesDiff=$difference-$flooredDiff;
                                        echo " You have done " . $flooredDiff . " hours and " . ($minutesDiff*60) . " minutes more than your target";
                                    }
                                    echo ", including overtime.";
                                    
                                echo "</td>";
                                echo "</tr>";
                            echo "</table>";
                            echo "</div>\n";
                            
                            $setTS++;
                        }
                        
                        $findWageTarget="SELECT * FROM wagetarget WHERE Year='$year'";
                        $queryWageTarget=mysqli_query($dbconnect,$findWageTarget) or die("Could not get wage target from database!");
                        
                        $totalWageTarget=0;
                        
                        while($resultWageTarget=mysqli_fetch_assoc($queryWageTarget))
                        {
                            $totalWageTarget+=$resultWageTarget["TotalTarget"];
                        }
                        
                        if($totalWageTarget!=0)
                        {
                            if($setTS<1) echo "<h3>Total Targets This Year:</h3><br />\n";
                            
                            echo "<br />";
                            echo "<div id='birth'>";
                            echo "<table style='width:750px;'>";
                                echo "<tr>";
                                echo "<td style='width:620px;'>";
                                    echo "A total target of £" . $totalWageTarget;
                                    echo "!";
                                    
                                    $wageDiff=$totalWageTarget-($totalRegularWageYear+$totalOvertimeWageYear);
                                    
                                    if($wageDiff>0)
                                    {
                                        echo " You have £";
                                        printf("%.2f",$wageDiff);
                                        echo " more to earn to meet the target";
                                    }
                                    else if($wageDiff==0)
                                    {
                                        echo " You have met the target perfectly";
                                    }
                                    else
                                    {
                                        $wageDiff*=(-1);
                                        echo " You have earned £";
                                        printf("%.2f",$wageDiff);
                                        echo " more than your target";
                                    }
                                    
                                    echo ", including overtime.";
                            
                                echo "</td>";
                                echo "</tr>";
                            echo "</table>";
                            echo "</div>\n";
                        }
                        
                    ?>
                    
                    <br />
                </div>
                
                <div id="targetsSet2" style="display:none">
                    <?php
        
                        $findHoursTarget="SELECT * FROM hourstarget";
                        $queryHoursTargets=mysqli_query($dbconnect,$findHoursTarget) or die("Could get get hours targets from database!");
                        
                        $setTS1=0;
                        
                        $totalHoursTarget=0;
                        $totalMinutesTarget=0;
                        $totalTarget=0;
                        
                        $totalWorkedHours=$totalRegularHours+$totalRegularMinutes+$totalOvertimeHours+$totalOvertimeMinutes;
                        
                        while($resultHoursTargets=mysqli_fetch_assoc($queryHoursTargets))
                        {						
                            $totalHoursTarget+=$resultHoursTargets["HoursTarget"];
                            $totalMinutesTarget+=($resultHoursTargets["MinutesTarget"]/60);
                        }
                        
                        $totalTarget+=($totalHoursTarget+$totalMinutesTarget);
                        $floorTotalTarget=floor($totalTarget);
                        $TotalTargetMinutes=$totalTarget-$floorTotalTarget;
                        
                        if($totalTarget!=0)
                        {
                            if($setTS1<1) echo "<h3>Total Targets All Time:</h3><br />\n";
                            
                            echo "<div id='birth'>";
                            echo "<table style='width:750px;'>";
                                echo "<tr>";
                                echo "<td style='width:620px;'>";
                                    echo "A total target of " . $floorTotalTarget . " hours";
                                    if($TotalTargetMinutes!=0)
                                    {
                                        echo " and " . ($TotalTargetMinutes*60) . " minutes";
                                    }
                                    echo ".";
                                    
                                    $difference=$totalTarget-$totalWorkedHours;
                                    
                                    if($difference>0)
                                    {
                                        $flooredDiff=floor($difference);
                                        $minutesDiff=$difference-$flooredDiff;
                                        echo " You have " . $flooredDiff . " hours and " . ($minutesDiff*60) . " minutes hours to go";
                                    }
                                    else if($difference==0)
                                    {
                                        echo "You met the target perfectly";
                                    }
                                    else
                                    {
                                        $difference*=(-1);
                                        $flooredDiff=floor($difference);
                                        $minutesDiff=$difference-$flooredDiff;
                                        echo " You have done " . $flooredDiff . " hours and " . ($minutesDiff*60) . " minutes more than your target";
                                    }
                                    echo ", including overtime.";
                                    
                                echo "</td>";
                                echo "</tr>";
                            echo "</table>";
                            echo "</div>\n";
                            
                            $setTS1++;
                        }
                        
                        $findWageTarget="SELECT * FROM wagetarget";
                        $queryWageTarget=mysqli_query($dbconnect,$findWageTarget) or die("Could not get wage target from database!");
                        
                        $totalWageTarget=0;
                        
                        while($resultWageTarget=mysqli_fetch_assoc($queryWageTarget))
                        {
                            $totalWageTarget+=$resultWageTarget["TotalTarget"];
                        }
                        
                        if($totalWageTarget!=0)
                        {
                            if($setTS1<1) echo "<h3>Total Targets All Time:</h3><br />\n";
                            
                            echo "<br />";
                            echo "<div id='birth'>";
                            echo "<table style='width:750px;'>";
                                echo "<tr>";
                                echo "<td style='width:620px;'>";
                                    echo "A total target of £" . $totalWageTarget;
                                    echo "!";
                                    
                                    $wageDiff=$totalWageTarget-($totalRegularWage+$totalOvertimeWage);
                                    
                                    if($wageDiff>0)
                                    {
                                        echo " You have £";
                                        printf("%.2f",$wageDiff);
                                        echo " more to earn to meet the target";
                                    }
                                    else if($wageDiff==0)
                                    {
                                        echo " You have met the target perfectly";
                                    }
                                    else
                                    {
                                        $wageDiff*=(-1);
                                        echo " You have earned £";
                                        printf("%.2f",$wageDiff);
                                        echo " more than your target";
                                    }
                                    
                                    echo ", including overtime.";
                            
                                echo "</td>";
                                echo "</tr>";
                            echo "</table>";
                            echo "</div>\n";
                        }
                        
                    ?>
                    
                    <br />
                </div>
            
            </div>
    </div>
    
</body>
</html>