<?php include("includes/functions.php"); ?>
<?php include("includes/config.php"); ?>
<?php include("includes/settings.php"); ?>

<?php
	$savedMonth=$_POST["savedMonth"];
	$savedYear=$_POST["savedYear"];
	
	if(isset($_POST["savedDay"]))
	{
		$saved=$_POST["savedDay"];
	}
	else $saved=0;
	
	$error=0;
?>

<?php
	$searchText=trim(strip_tags($_POST["searchText"]));
	
	if(empty($searchText)) $error=1;
	
	$searchTerm=$_POST["searchTerm"];
	$terms=array("All","Birthdays","Reminders","Payments","Work Done");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>
	Calendar Search :: 
    <?php
		echo $searchText . " in ";
		echo $terms[$searchTerm-1];
	?>
</title>
<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript" src="jquery-1.6.4.min.js" ></script>
<script type="text/javascript" src="script.js" ></script>
</head>

<body>

	<div id="main">
    
    	<?php
		
			echo "<h1 class='year'>";
				echo "<a href='#'>Search Page</a>";
			echo "</h1>\n";
			echo "<div style='clear:both'></div>\n\n";
		
		?>
        
        <div id="left">
        
        	<div id="searchInfo">
            	<?php
					echo $searchText . " in ";
					echo $terms[$searchTerm-1];
				?>
                <br /><button type="button"
                	onclick="document.location='<?php
						if(isset($_POST["savedDay"]))
						{
							$savedDay=$_POST["savedDay"];
							echo "day.php?day=$savedDay&month=$savedMonth&year=$savedYear";
						}
						else echo "month.php?month=$savedMonth&year=$savedYear";
					?>'";
                >Back</button>
            </div>
            
            <div id="searchBox2" style="display:block;">
            	<h3>Search Again:</h3><br />
                
                <form method="post" action="search2.php">
                
                <?php
					if(isset($_POST["savedDay"]))
					{
						$savedDay=$_POST["savedDay"];
						echo "<input type='hidden' name='savedDay' value='$savedDay' />";
					}
				?>
                
                <input type="hidden" name="savedMonth" value="<?php echo $savedMonth; ?>" />
                <input type="hidden" name="savedYear" value="<?php echo $savedYear; ?>" />
                    &nbsp;&nbsp;For &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text" name="searchText" value="<?php echo $searchText; ?>" /> <br />
                    &nbsp;&nbsp;In &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <select name="searchTerm">
                        <option value="1">All</option>
                        <option value="2"
                        	<?php
								if($searchTerm==2) echo "selected='selected'";
							?>
                        >Birthdays</option>
                        <option value="3"
                        	<?php
								if($searchTerm==3) echo "selected='selected'";
							?>
                        >Reminders</option>
                        <option value="4"
                        	<?php
								if($searchTerm==4) echo "selected='selected'";
							?>
                        >Payments</option>
                        <option value="5"
                        	<?php
								if($searchTerm==5) echo "selected='selected'";
							?>
                        >Work Done</option>
                    </select>
                	<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Search" />
                    <button type="button" id="PrevSearch" style="float:right; margin-right:50px;">Next search</button>
                </form>
                
            </div>
            
            <div id="searchBox" style="display:none;">
            	<h3>Search Again:</h3><br />
                <form method="post" action="search.php">
                
                <?php
					if(isset($_POST["savedDay"]))
					{
						$savedDay=$_POST["savedDay"];
						echo "<input type='hidden' name='savedDay' value='$savedDay' />";
					}
				?>
                
                <input type="hidden" name="savedMonth" value="<?php echo $savedMonth; ?>" />
                <input type="hidden" name="savedYear" value="<?php echo $savedYear; ?>" />
                	&nbsp;&nbsp;From &nbsp;&nbsp;&nbsp;
                     <select name="fromDay">
                     	<?php 
							for($n=1; $n<=31; $n++)
							{
								echo "<option value='$n'";
									if($n==$saved) echo "selected='selected'";
								echo ">$n</option>\n";
							}
						?>
                     </select>
                     <select name="fromMonth">
                     	<?php
							for($n=1; $n<=12; $n++)
							{
								echo "<option value='$n'";
									if($n==$savedMonth) echo "selected='selected'";
								echo ">";
									echo $months[$n-1];
								echo "</option>\n";
							}
						?>
                     </select>
                     <input type="text" 
                     	value="<?php echo $savedYear; ?>" 
                     name="fromYear" size="1" maxlength="4" />
                     
                    <br />&nbsp;&nbsp;To &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     <select name="toDay">
                     	<?php 
							for($n=1; $n<=31; $n++)
							{
								echo "<option value='$n'";
									if($n==$saved) echo "selected='selected'";
								echo ">$n</option>\n";
							}
						?>
                     </select>
                     <select name="toMonth">
                     	<?php
							for($n=1; $n<=12; $n++)
							{
								echo "<option value='$n'";
									if(($savedMonth+1)==$n) echo "selected='selected'";
								echo ">";
									echo $months[$n-1];
								echo "</option>\n";
							}
						?>
                     </select>
                     <input type="text" 
                     	value="<?php 
							if($savedMonth==12)
							{
								echo $savedYear+1;
							}
							else echo $savedYear;
						?>" 
                     name="toYear" size="1" maxlength="4" />
                     
                    <br />&nbsp;&nbsp;For &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     <select name="searchTerm">
                     	<option value="1">All</option>
                        <option value="2">Payments</option>
                        <option value="3" >Work Done</option>
                        <option value="4">Targets</option>
                     </select>
                     
                    <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Search" />
                    <button type="button" id="nextSearch" style="float:right; margin-right:50px;">Prev search</button>
                </form>
            </div>
            
        </div>
        
        <div id="right">            
            <?php
				if($searchTerm==1 || $searchTerm==2)
				{
			?>
            	<div id="birthdays">
                	<h3>Birthdays:</h3>
                    
                    <?php
						$findBirthDays="SELECT * FROM birthdays WHERE PersonName LIKE '%$searchText%'";
						$queryBirthDays=mysqli_query($dbconnect,$findBirthDays) or die("Could not get birthdays from database!");
						
						while($resultBirthDays=mysqli_fetch_assoc($queryBirthDays))
						{
							showBirthdaySearch();
						}
					
					?>
                    
                    <form method="post" action="edits/editbirthday.php">
						<?php
							if(isset($_POST["savedDay"]))
							{
								$savedDay=$_POST["savedDay"];
								echo "<input type='hidden' name='savedDay' value='$savedDay' />";
							}
						?>
                    <input type="hidden" name="savedMonth" value="<?php echo $savedMonth ?>" />
                    <input type="hidden" name="savedYear" value="<?php echo $savedYear ?>" />
                    <table id="editBirthday">
                    <tr>
                        <td><input type="hidden" name="birthDayID" id="birthDayID" /></td>
                        <td><label for="birthDayPersonName">Person Name:</label><input type="text" name="birthDayPersonName" id="birthDayPersonName" /></td>
                        <td><label for="birthDayDay">Day:</label>
                            <select name="birthDayDay" id="birthDayDay">
                                <?php
                                
                                    for($n=1; $n<=31; $n++)
                                    {
                                        echo "<option value='$n'>$n</option>\n";
                                    }
                                
                                ?>
                            </select>
                        </td>
                        <td><label for="birthDayMonth">Month:</label>
                            <select name="birthDayMonth" id="birthDayMonth">
                                <?php
                                
                                    for($n=1; $n<=12; $n++)
                                    {
                                        echo "<option value='$n'>" . $months[$n-1] . "</option>\n";
                                    }
                                
                                ?>
                            </select>
                        </td>
                        <td><input type="submit" /></td>
                    </tr>
                    </table>
                    </form>
                    
                    <br />
                </div>
                
            <?php } ?>
            
            <?php
				if($searchTerm==1 || $searchTerm==3)
				{
			?>
            
            	<div id="reminders">
                	<h3>Reminders:</h3>
            
					<?php
                        $findReminders="SELECT * FROM reminders WHERE Comment LIKE '%$searchText%'";
                        $queryReminders=mysqli_query($dbconnect,$findReminders) or die("Could not get reminders from the database!");
						
						while($resultReminders=mysqli_fetch_assoc($queryReminders))
						{
							showReminderSearch();
						}
                    ?>
                    
                    <form method="post" action="edits/editreminder.php">
                    	<?php
							if(isset($_POST["savedDay"]))
							{
								$savedDay=$_POST["savedDay"];
								echo "<input type='hidden' name='savedDay' value='$savedDay' />";
							}
						?>
                    <input type="hidden" name="savedMonth" value="<?php echo $savedMonth ?>" />
                    <input type="hidden" name="savedYear" value="<?php echo $savedYear ?>" />
                    <table id="editReminder">
                    <tr>
                        <td><input type="hidden" name="reminderID" id="reminderID" /></td>
                        <td><label for="reminderComment">Comment:</label><input type="text" name="reminderComment" id="reminderComment" /></td>
                        <td><label for="reminderDay">Day:</label>
                            <select name="reminderDay" id="reminderDay">
                                <?php
                                
                                    for($n=1; $n<=31; $n++)
                                    {
                                        echo "<option value='$n'>$n</option>\n";
                                    }
                                    
                                ?>
                            </select>
                        </td>
                        <td><label for="reminderMonth">Month:</label>
                            <select name="reminderMonth" id="reminderMonth">
                                <?php
                                
                                    for($n=1; $n<=12; $n++)
                                    {
                                        echo "<option value='$n'>" . $months[$n-1] . "</option>\n";
                                    }
                                    
                                ?>
                            </select>
                        </td>
                        <td><label for="reminderYear">Year:</label>
                            <select name="reminderYear" id="reminderYear">
                                <?php
                                
                                    $startYear=$savedYear-10; $endYear=$savedYear+10;
                                
                                    for($n=$startYear; $n<=$endYear; $n++)
                                    {
                                        echo "<option id='selected$n' value='$n'>$n</option>\n";
                                    }
                                    
                                ?>
                            </select>
                        </td>
                        <td><label for="reminderOccurrence">Occurrence:</label>
                            <select id="reminderOccurrence" name="reminderOccurrence" onchange="OccurrenceChange()">
                                <option value="1">Once Only</option>
                                <option value="2">Yearly</option>
                                <option value="3">Monthly</option>
                                <option value="4">Weekly</option>
                                <option value="5">Daily</option>
                            </select>
                        </td>
                        <td id="tdTimes" style="display:none;"><label for="reminderTimes">Number of Repeats:</label>
                            <select name="reminderTimes" id="reminderTimes">
                                <option value="-1">Forever</option>
                                <?php
                                
                                    for($n=2; $n<=52; $n++)
                                    {
                                        echo "<option value='$n'>$n</option>\n";
                                    }
                                
                                ?>
                            </select>
                        </td>
                        <td><input type="submit" /></td>
                    </tr>
                    </table>
                    </form>
                
                
            		<br />
                </div>	
            
            <?php } ?>
            
            <?php
				if($searchTerm==1 || $searchTerm==4)
				{
			?>
            
            	<div id="payments">
                	<h3>Payments:</h3>
                    
                    <?php
						$findPaymentCategories="SELECT * FROM paymentcategories WHERE Name LIKE '%$searchText%'";
						$queryPaymentCategories=mysqli_query($dbconnect,$findPaymentCategories) or die("Could not get payment categories from the database!");
						
						while($resultsCategories=mysqli_fetch_assoc($queryPaymentCategories))
						{
							$findPayments="SELECT * FROM payments WHERE Category='$resultsCategories[PaymentCategoryID]' ORDER BY Year ASC";
							$queryPayments=mysqli_query($dbconnect,$findPayments) or die("Could not get payments from the database!");
							
							while($resultsPayments=mysqli_fetch_assoc($queryPayments))
							{
								showPaymentSearch2();
							}
						}
					?>
                    
                    <form method="post" action="edits/editpayment.php">
                    	<?php
							if(isset($_POST["savedDay"]))
							{
								$savedDay=$_POST["savedDay"];
								echo "<input type='hidden' name='savedDay' value='$savedDay' />";
							}
						?>
                    <input type="hidden" name="savedMonth" value="<?php echo $savedMonth ?>" />
                    <input type="hidden" name="savedYear" value="<?php echo $savedYear ?>" />
                    <table id="editPayment">
                    <tr>
                        <td><input type="hidden" name="paymentID" id="paymentID" /></td>
                        <td><label for="paymentDay">Day:</label>
                            <select name="paymentDay" id="paymentDay">
                                <?php
                                
                                    for($n=1; $n<=31; $n++)
                                    {
                                        echo "<option value='$n'>$n</option>\n";
                                    }
                                    
                                ?>
                            </select>
                        </td>
                        <td><label for="paymentMonth">Month:</label>
                            <select name="paymentMonth" id="paymentMonth">
                                <?php
                                
                                    for($n=1; $n<=12; $n++)
                                    {
                                        echo "<option value='$n'>" . $months[$n-1] . "</option>\n";
                                    }
                                    
                                ?>
                            </select>
                        </td>
                        <td>
                            <label for="paymentYear">Year:</label>
                            <select name="paymentYear" id="paymentYear">
                                <?php
                                
                                    $startYear=$savedYear-10; $endYear=$savedYear+10;
                                
                                    for($n=$startYear; $n<=$endYear; $n++)
                                    {
                                        echo "<option value='$n'>$n</option>\n";
                                    }
                                    
                                ?>
                            </select>
                        </td>
                        <td width="120px"><label>Amount (£):</label><br />
                            <input type="text" name="paymentAmountPound" id="paymentAmountPound" size="1" />.
                            <input type="text" name="paymentAmountPence" id="paymentAmountPence" size="1" />
                        </td>
                        <td><label for="paymentType">Type:</label>
                            <select name="paymentType" id="paymentType">
                                <option value="1">Received</option>
                                <option value="2">Spent</option>
                            </select>
                        </td>
                        <td><label for="paymentCategory">Category:</label>
                            <select name="paymentCategory" id="paymentCategory">
                                <?php
                                
                                    $queryPaymentCategories="SELECT * FROM paymentcategories ORDER BY Name ASC";
                                    $sendPaymentCategories=mysqli_query($dbconnect,$queryPaymentCategories) or die("Could not get payment categories from database.");
                                
                                    while($results=mysqli_fetch_assoc($sendPaymentCategories))
                                    {
                                        echo "<option value='$results[PaymentCategoryID]'>";
                                            echo $results["Name"];
                                        echo "</option>\n";
                                    }
                                    
                                ?>							
                            </select>
                        </td>
                        <td><input type="submit" /></td>
                    </tr>
                    </table>
                    </form>
                    
                    <table id="categories">
                    <tr><th>Payment Categories:</th></tr>
                        <?php
                        
                            $getPaymentCategories="SELECT * FROM paymentcategories WHERE Name LIKE '%$searchText%' ORDER BY Name ASC";
                            $queryPaymentCateogies=mysqli_query($dbconnect,$getPaymentCategories) or die("Could not get payment categories from database!");
                            
                            while($resultPaymentCategories=mysqli_fetch_assoc($queryPaymentCateogies))
                            {
                                showPaymentCategoriesSearch();
                            }
                        
                        ?>
                    </table>
                    
                    <table id="paymentsummary">
                    <tr><th colspan="4">Payment Summary:</th></tr>
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

                            $ready=0;
                            $index=-1;
                            
                            $cats=array();
                            $received=array();
                            
							$getPayments="SELECT * FROM payments ORDER BY Category ASC";
                            $queryPayments=mysqli_query($dbconnect,$getPayments) or die("Could not get payments from database");
							
                            while($resultPayments=mysqli_fetch_assoc($queryPayments))
                            {
                                $getPaymentCategories="SELECT * FROM paymentcategories WHERE PaymentCategoryID='$resultPayments[Category]'";
                                $queryPaymentCategories=mysqli_query($dbconnect,$getPaymentCategories) or die("Could not get payment categories from database!");
                                $resultPaymentCategories=mysqli_fetch_assoc($queryPaymentCategories);
								
                                if (strlen(stristr($resultPaymentCategories["Name"],$searchText))>0)
								{
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
                                    printf("%.2f",$profit);
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
                                
                                printf("%.2f",$profit);
                                
                            ?>
                        </td>
                    </tr>
                    </table>
                    
                    <br />
                </div>
            
            <?php } ?>
            
            <?php
				if($searchTerm==1 || $searchTerm==5)
				{
			?>
            	
                <div id="workDone">
                	<h3>Work Done:</h3>
                    
                    <?php
						$getCompanies="SELECT * FROM company WHERE CompanyName LIKE '%$searchText%'";
						$queryCompanies=mysqli_query($dbconnect,$getCompanies) or die("Could not get companies from database!");
						
						while($resultsCompanies=mysqli_fetch_assoc($queryCompanies))
						{
							$findWorkDone="SELECT * FROM workdone WHERE CompanyID='$resultsCompanies[CompanyID]' ORDER BY Year ASC";
							$queryWorkDone=mysqli_query($dbconnect,$findWorkDone) or die("Could not get work done from database.");
							
							while($resultWorkDone=mysqli_fetch_assoc($queryWorkDone))
							{
								showWorkDoneSearch();
							}
						}
					?>
                    
                    <form method="post" action="edits/editworkdone.php">
                    	<?php
							if(isset($_POST["savedDay"]))
							{
								$savedDay=$_POST["savedDay"];
								echo "<input type='hidden' name='savedDay' value='$savedDay' />";
							}
						?>
                    <input type="hidden" name="savedMonth" value="<?php echo $savedMonth ?>" />
                    <input type="hidden" name="savedYear" value="<?php echo $savedYear ?>" />
                    <table id="editWorkDone">
                    <tr>
                        <td><input type="hidden" name="workDoneID" id="workDoneID" /></td>
                        <td><label for="workDoneDay">Day:</label>
                            <select name="workDoneDay" id="workDoneDay">
                                <?php
                                    for($n=1; $n<=31; $n++)
                                    {
                                        echo "<option value='$n'>$n</option>\n";
                                    }
                                ?>
                            </select>
                        </td>
                        <td><label for="workDoneMonth">Month:</label>
                            <select name="workDoneMonth" id="workDoneMonth">
                                <?php
                                    for($n=1; $n<=12; $n++)
                                    {
                                        echo "<option value='$n'>" . $months[$n-1] . "</option>\n";
                                    }
                                ?>
                            </select>
                        </td>
                        <td><label for="workDoneYear">Year:</label>
                            <select name="workDoneYear" id="workDoneYear">
                                <?php
                                
                                    $startYear=$savedYear-10; $endYear=$savedYear+10;
                                
                                    for($n=$startYear; $n<=$endYear; $n++)
                                    {
                                        echo "<option value='$n'>$n</option>\n";
                                    }
                                    
                                ?>
                            </select>
                        </td>
                        <td><label for="workDoneCompany">Company:</label>
                            <select name="workDoneCompany" id="workDoneCompany">
                                <?php
                                    $findCompanies="SELECT * FROM company ORDER BY CompanyName ASC";
                                    $queryCompanies=mysqli_query($dbconnect,$findCompanies) or die("Could not get companies from database!");
                                    
                                    while($resultCompanies=mysqli_fetch_assoc($queryCompanies))
                                    {
                                        echo "<option value='$resultCompanies[CompanyID]'>";
                                            echo $resultCompanies["CompanyName"];
                                        echo "</option>\n";
                                    }
                                ?>
                            </select>
                        </td>
                        <td><label for="workDoneHours">Hours:</label>
                            <select name="workDoneHours" id="workDoneHours">
                                <?php
                                    for($n=0; $n<=14; $n++)
                                    {
                                        echo "<option value='$n'>$n</option>\n";
                                    }
                                ?>
                            </select>
                        </td>
                        <td><label for="workDoneMinutes">Minutes:</label>
                            <select name="workDoneMinutes" id="workDoneMinutes">
                                <option value="0">0</option>
                                <option value="15">15</option>
                                <option value="30">30</option>
                                <option value="45">45</option>
                            </select>
                        </td>
                        <td><label>Normal Wage:</label>
                            £<input type="text" value="0" size="1" name="workDoneWagePound" id="workDoneWagePound" />.<input type="text" value="00" size="1" name="workDoneWagePence" id="workDoneWagePence" />
                        </td>
                        <td><label for="workDoneOvertimeHours">Overtime Hours:</label>
                            <select name="workDoneOvertimeHours" id="workDoneOvertimeHours">
                                <?php
                                    for($n=0; $n<=14; $n++)
                                    {
                                        echo "<option value='$n'>$n</option>\n";
                                    }
                                ?>
                            </select>
                        </td>
                        <td><label for="workDoneOvertimeMinutes">Overtime Minutes:</label>
                            <select name="workDoneOvertimeMinutes" id="workDoneOvertimeMinutes">
                                <option value="0">0</option>
                                <option value="15">15</option>
                                <option value="30">30</option>
                                <option value="45">45</option>
                            </select>
                        </td>
                        <td><label>Overtime Wage:</label>
                            £<input type="text" value="0" size="1" name="workDoneOvertimeWagePound" id="workDoneOvertimeWagePound" />.<input type="text" value="00" size="1" name="workDoneOvertimeWagePence" id="workDoneOvertimeWagePence" />
                        </td>
                        <td><input type="submit" /></td>
                    </tr>
                    </table>
                    </form>
                    
                    <table id="companies">
                    <tr><th>Companies:</th></tr>
                        <?php
                        
                            $getCompanies="SELECT * FROM company WHERE CompanyName LIKE '%$searchText%' ORDER BY companyName ASC";
                            $queryCompanies=mysqli_query($dbconnect,$getCompanies) or die("Could not get companies from database!");
                            
                            while($resultCompanies=mysqli_fetch_assoc($queryCompanies))
                            {
                                showCompaniesSearch();
                            }
                        
                        ?>
                    </table>
                    
                    <table id="companysummary">
                    <tr><th colspan="8">Work Done Summary:</th></tr>
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
                            
                            $ready=0;
                            $index=-1;
                            
                            $companies=array();
                            
                            $regularHours=array();
                            $regularMinutes=array();
                            $regularWage=array();
                            
                            $overtimeHours=array();
                            $overtimeMinutes=array();
                            $overtimeWage=array();
							
							$getWorkDone="SELECT * FROM workdone ORDER BY CompanyID ASC";
                            $queryWorkDone=mysqli_query($dbconnect,$getWorkDone) or die("Could not get work done from database!");
                            
                            while($resultWorkDone=mysqli_fetch_assoc($queryWorkDone))
                            {
                                $getCompanies="SELECT * FROM company WHERE CompanyID='$resultWorkDone[CompanyID]'";
                                $queryCompanies=mysqli_query($dbconnect,$getCompanies) or die("Could not get companies from database!");
                                $resultCompanies=mysqli_fetch_assoc($queryCompanies);
                                
								if (strlen(stristr($resultCompanies["CompanyName"],$searchText))>0)
								{
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
                    
                    <br />
                </div>
            
            <?php } ?>
        </div>
        
    </div>
    
</body>
</html>

<?php

if($error!=0)
{
	if(isset($_POST["savedDay"]))
	{
		$savedDay=$_POST["savedDay"];
		header("Location: day.php?day=$savedDay&month=$savedMonth&year=$savedYear&type=search2&error=$error&searchText=$searchText&searchTerm=$searchTerm");
	}
	else
	{
		header("Location: month.php?month=$savedMonth&year=$savedYear&type=search2&error=$error&searchText=$searchText&searchTerm=$searchTerm");
	}
}

?>