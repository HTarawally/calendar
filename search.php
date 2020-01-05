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
	$fromDay=$_POST["fromDay"];
	$fromMonth=$_POST["fromMonth"];
	$fromYear=trim(strip_tags($_POST["fromYear"]));
	
	$toDay=$_POST["toDay"];
	$toMonth=$_POST["toMonth"];
	$toYear=trim(strip_tags($_POST["toYear"]));
	
	$searchTerm=$_POST["searchTerm"];
	$searchArray=array("All","Payments","Work Done","Targets");
	
	if(strlen($fromYear)!=4 || strlen($toYear)!=4) $error=1;
	else if(!is_numeric($fromYear) || !is_numeric($toYear)) $error=2;
	
	if($toYear<$fromYear) $error=3;
	else if($toYear==$fromYear)
	{
		if($toMonth<$fromMonth) $error=3;
		else if($toMonth==$fromMonth)
		{
			if($toDay<$fromDay) $error=3;
		}
	}
	
	if($fromMonth==2)
	{
		if(isLeapYear($fromYear))
		{
			if($fromDay==30 || $fromDay==31)
			{
				$error=4;
			}
		}
		else
		{
			if($fromDay==29 || $fromDay==30 || $fromDay==31)
			{
				$error=4;
			}
		}
	}
	else if(($fromMonth==4) || ($fromMonth==6) || ($fromMonth==9) || ($fromMonth==11))
	{
		if($fromDay==31)
		{
			$error=4;
		}
	}
	
	if($toMonth==2)
	{
		if(isLeapYear($toYear))
		{
			if($toDay==30 || $toDay==31)
			{
				$error=4;
			}
		}
		else
		{
			if($toDay==29 || $toDay==30 || $toDay==31)
			{
				$error=4;
			}
		}
	}
	else if(($toMonth==4) || ($toMonth==6) || ($toMonth==9) || ($toMonth==11))
	{
		if($toDay==31)
		{
			$error=4;
		}
	}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>
	Calendar Search :: 
    	<?php
			if($fromDay<10) echo "0";
			echo "$fromDay/";
			
			if($fromMonth<10) echo "0";
			echo "$fromMonth/$fromYear";
			
			echo " - ";
			
			if($toDay<10) echo "0";
			echo "$toDay/";
			
			if($toMonth<10) echo "0";
			echo "$toMonth/$toYear";
			
			echo " for ";
			echo $searchArray[$searchTerm-1];
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
					if($fromDay<10) echo "0";
					echo "$fromDay/";
					
					if($fromMonth<10) echo "0";
					echo "$fromMonth/$fromYear";
					
					echo " - ";
					
					if($toDay<10) echo "0";
					echo "$toDay/";
					
					if($toMonth<10) echo "0";
					echo "$toMonth/$toYear";
					
					echo " for ";
					echo $searchArray[$searchTerm-1];
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
            
            <div id="searchBox">
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
									if($n==$fromDay) echo "selected='selected'";
								echo ">$n</option>\n";
							}
						?>
                     </select>
                     <select name="fromMonth">
                     	<?php
							for($n=1; $n<=12; $n++)
							{
								echo "<option value='$n'";
									if($n==$fromMonth) echo "selected='selected'";
								echo ">";
									echo $months[$n-1];
								echo "</option>\n";
							}
						?>
                     </select>
                     <input type="text" value="<?php echo $fromYear; ?>" name="fromYear" size="1" maxlength="4" />
                     
                    <br />&nbsp;&nbsp;To &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     <select name="toDay">
                     	<?php 
							for($n=1; $n<=31; $n++)
							{
								echo "<option value='$n'";
									if($n==$toDay) echo "selected='selected'";
								echo ">$n</option>\n";
							}
						?>
                     </select>
                     <select name="toMonth">
                     	<?php
							for($n=1; $n<=12; $n++)
							{
								echo "<option value='$n'";
									if($n==$toMonth) echo "selected='selected'";
								echo ">";
									echo $months[$n-1];
								echo "</option>\n";
							}
						?>
                     </select>
                     <input type="text" value="<?php echo $toYear; ?>" name="toYear" size="1" maxlength="4" />
                     
                    <br />&nbsp;&nbsp;For &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     <select name="searchTerm">
                     	<option value="1">All</option>
                        
                        <option value="2"
                        	<?php if($searchTerm==2) echo "selected='selected'"; ?>
                        >Payments</option>
                        
                        <option value="3"
                        	<?php if($searchTerm==3) echo "selected='selected'"; ?>
                        >Work Done</option>
                        
                        <option value="4"
                        	<?php if($searchTerm==4) echo "selected='selected'"; ?>
                        >Targets</option>
                        
                     </select>
                     
                    <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Search" />
                    <button type="button" id="nextSearch" style="float:right; margin-right:50px;">Next search</button>
                </form>
            </div>
            
            <div id="searchBox2">
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
                    <input type="text" name="searchText" /> <br />
                    &nbsp;&nbsp;In &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <select name="searchTerm">
                        <option value="1">All</option>
                        <option value="2">Birthdays</option>
                        <option value="3">Reminders</option>
                        <option value="4">Payments</option>
                        <option value="5">Work Done</option>
                    </select>
                	<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Search" />
                    <button type="button" id="PrevSearch" style="float:right; margin-right:50px;">Prev search</button>
                </form>
                
            </div>
            
        </div>
        
        <div id="right">            
            <?php
				if($searchTerm==1 || $searchTerm==2)
				{
			?>
            	<div id="payments">
                	<h3>Payments:</h3>
                    
                    <?php
						
						if($fromYear==$toYear)
						{
							if($fromMonth==$toMonth)
							{
								$findPayments="SELECT * FROM payments WHERE Month='$fromMonth' AND Year='$fromYear' ORDER BY Day ASC";
								$queryPayments=mysqli_query($dbconnect,$findPayments) or die("Could not get payments from the database!");
								
								$selectedDay=$fromDay;
								$selectedMonth=$fromMonth;
								$selectedYear=$fromYear;
								
								while($resultsPayments=mysqli_fetch_assoc($queryPayments))
								{
									$getCategories="SELECT * FROM paymentcategories WHERE PaymentCategoryID=$resultsPayments[Category]";
									$queryCategories=mysqli_query($dbconnect,$getCategories) or die("Could not get categories from database!");
									$selectedDay=$resultsPayments["Day"];
									
									while($resultsCategories=mysqli_fetch_assoc($queryCategories))
									{
										if($resultsPayments["Day"]>=$fromDay && $resultsPayments["Day"]<=$toDay)
										{
											showPaymentSearch();
										}
									}
								}
							}
							else
							{
								$findPayments="SELECT * FROM payments WHERE Year='$fromYear' ORDER BY Month ASC";
								$queryPayments=mysqli_query($dbconnect,$findPayments) or die("Could not get payments from the database!");
								
								$selectedDay=$fromDay;
								$selectedMonth=$fromMonth;
								$selectedYear=$fromYear;
								
								while($resultsPayments=mysqli_fetch_assoc($queryPayments))
								{
									$getCategories="SELECT * FROM paymentcategories WHERE PaymentCategoryID=$resultsPayments[Category]";
									$queryCategories=mysqli_query($dbconnect,$getCategories) or die("Could not get categories from database!");
									
									$selectedDay=$resultsPayments["Day"];
									$selectedMonth=$resultsPayments["Month"];
									
									while($resultsCategories=mysqli_fetch_assoc($queryCategories))
									{
										if($resultsPayments["Month"]==$fromMonth)
										{
											if($resultsPayments["Day"]>=$fromDay)
											{
												showPaymentSearch();
											}
										}
										else if($resultsPayments["Month"]==$toMonth)
										{
											if($resultsPayments["Day"]<=$toDay)
											{
												showPaymentSearch();
											}
										}
										else if(($resultsPayments["Month"]>$fromMonth) && ($resultsPayments["Month"]<$toMonth))
										{
											showPaymentSearch();
										}
									}
								}
							}
						}
						else
						{
							for($n=$fromYear; $n<=$toYear; $n++)
							{
								$findPayments="SELECT * FROM payments WHERE Year='$n' ORDER BY Month ASC";
								$queryPayments=mysqli_query($dbconnect,$findPayments) or die("Could not get payments from the database!");
								
								$selectedDay=$fromDay;
								$selectedMonth=$fromMonth;
								$selectedYear=$fromYear;
								
								while($resultsPayments=mysqli_fetch_assoc($queryPayments))
								{
									$getCategories="SELECT * FROM paymentcategories WHERE PaymentCategoryID=$resultsPayments[Category]";
									$queryCategories=mysqli_query($dbconnect,$getCategories) or die("Could not get categories from database!");
									
									$selectedDay=$resultsPayments["Day"];
									$selectedMonth=$resultsPayments["Month"];
									$selectedYear=$resultsPayments["Year"];
									
									while($resultsCategories=mysqli_fetch_assoc($queryCategories))
									{
										if($n==$fromYear)
										{
											if($fromMonth==$selectedMonth)
											{
												if($fromDay<=$selectedDay)
												{
													showPaymentSearch();
												}
											}
											else if($fromMonth<$selectedMonth)
											{
												showPaymentSearch();
											}
										}
										else if($n==$toYear)
										{
											if($toMonth==$selectedMonth)
											{
												if($toDay>=$selectedDay)
												{
													showPaymentSearch();
												}
											}
											else if($toMonth>$selectedMonth)
											{
												showPaymentSearch();
											}
										}
										else if(($n>$fromYear) && ($n<$toYear))
										{
											showPaymentSearch();
										}
									}
								}
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
                        
                            $getPaymentCategories="SELECT * FROM paymentcategories ORDER BY Name ASC";
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
							
							if($fromYear==$toYear)
							{
								if($fromMonth==$toMonth)
								{
									$getPayments="SELECT * FROM payments WHERE Month='$fromMonth' AND Year='$fromYear' ORDER BY Category ASC";
									$queryPayments=mysqli_query($dbconnect,$getPayments) or die("Could not get payments from database");
									
									while($resultPayments=mysqli_fetch_assoc($queryPayments))
									{
										$getPaymentCategories="SELECT * FROM paymentcategories WHERE PaymentCategoryID='$resultPayments[Category]'";
										$queryPaymentCategories=mysqli_query($dbconnect,$getPaymentCategories) or die("Could not get payment categories from database!");
										$resultPaymentCategories=mysqli_fetch_assoc($queryPaymentCategories);
										
										if($resultPayments["Day"]>=$fromDay && $resultPayments["Day"]<=$toDay)
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

								}
								else
								{
									$getPayments="SELECT * FROM payments WHERE Year='$fromYear' ORDER BY Category ASC";
									$queryPayments=mysqli_query($dbconnect,$getPayments) or die("Could not get payments from database");
									
									while($resultPayments=mysqli_fetch_assoc($queryPayments))
									{
										$getPaymentCategories="SELECT * FROM paymentcategories WHERE PaymentCategoryID='$resultPayments[Category]'";
										$queryPaymentCategories=mysqli_query($dbconnect,$getPaymentCategories) or die("Could not get payment categories from database!");
										$resultPaymentCategories=mysqli_fetch_assoc($queryPaymentCategories);
										
										if($resultPayments["Month"]==$fromMonth)
										{
											if($resultPayments["Day"]>=$fromDay)
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
										else if($resultPayments["Month"]==$toMonth)
										{
											if($resultPayments["Day"]<=$toDay)
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
										else if(($resultPayments["Month"]>$fromMonth) && ($resultPayments["Month"]<$toMonth))
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
								}
							}
							else
							{
								$getPayments="SELECT * FROM payments ORDER BY Category ASC";
								$queryPayments=mysqli_query($dbconnect,$getPayments) or die("Could not get payments from database");
								
								while($resultPayments=mysqli_fetch_assoc($queryPayments))
								{
									$getPaymentCategories="SELECT * FROM paymentcategories WHERE PaymentCategoryID='$resultPayments[Category]'";
									$queryPaymentCategories=mysqli_query($dbconnect,$getPaymentCategories) or die("Could not get payment categories from database!");
									$resultPaymentCategories=mysqli_fetch_assoc($queryPaymentCategories);
									
									if($resultPayments["Year"]==$fromYear)
									{
										if($resultPayments["Month"]==$fromMonth)
										{
											if($resultPayments["Day"]>=$fromDay)
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
										else if($resultPayments["Month"]>$fromMonth)
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
									else if($resultPayments["Year"]==$toYear)
									{
										if($resultPayments["Month"]==$toMonth)
										{
											if($resultPayments["Day"]<=$toDay)
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
										else if($resultPayments["Month"]<$toMonth)
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
									else if(($resultPayments["Year"]>$fromYear) && ($resultPayments["Year"]<$toYear))
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
				if($searchTerm==1 || $searchTerm==3)
				{
			?>
            	<div id="workDone">
                	<h3>Work Done:</h3>
                    
                    <?php
						if(isset($_POST["savedDay"]))
						{
							$saved=$_POST["savedDay"];
						}
						else $saved=0;
						
						if($fromYear==$toYear)
						{
							if($fromMonth==$toMonth)
							{
								$findWorkDone="SELECT * FROM workdone WHERE Month='$fromMonth' AND Year='$fromYear' ORDER BY Day ASC";
								$queryWorkDone=mysqli_query($dbconnect,$findWorkDone) or die("Could not get work done from database.");
								
								while($resultWorkDone=mysqli_fetch_assoc($queryWorkDone))
								{
									if(($resultWorkDone["Day"]>=$fromDay) && $resultWorkDone["Day"]<=$toDay)
									{
										$getCompanies="SELECT * FROM company WHERE CompanyID=$resultWorkDone[CompanyID]";
										$queryCompanies=mysqli_query($dbconnect,$getCompanies) or die("Could not get companies from database!");
										
										while($resultsCompanies=mysqli_fetch_assoc($queryCompanies))
										{
											showWorkDoneSearch();
										}
									}
								}
								
							}
							else
							{
								$findWorkDone="SELECT * FROM workdone WHERE Year='$fromYear' ORDER BY Month ASC";
								$queryWorkDone=mysqli_query($dbconnect,$findWorkDone) or die("Could not get work done from database.");
								
								while($resultWorkDone=mysqli_fetch_assoc($queryWorkDone))
								{
									$getCompanies="SELECT * FROM company WHERE CompanyID=$resultWorkDone[CompanyID]";
									$queryCompanies=mysqli_query($dbconnect,$getCompanies) or die("Could not get companies from database!");
									
									if($resultWorkDone["Month"]==$fromMonth)
									{
										if($resultWorkDone["Day"]>=$fromDay)
										{
											while($resultsCompanies=mysqli_fetch_assoc($queryCompanies))
											{
												showWorkDoneSearch();
											}
										}
									}
									else if($resultWorkDone["Month"]==$toMonth)
									{
										if($resultWorkDone["Day"]<=$toDay)
										{
											while($resultsCompanies=mysqli_fetch_assoc($queryCompanies))
											{
												showWorkDoneSearch();
											}
										}
									}
									else if(($resultWorkDone["Month"]>$fromMonth) && ($resultWorkDone["Month"]<$toMonth))
									{
										while($resultsCompanies=mysqli_fetch_assoc($queryCompanies))
										{
											showWorkDoneSearch();
										}
									}
								}
							}
						}
						else
						{
							for($n=$fromYear; $n<=$toYear; $n++)
							{
								$findWorkDone="SELECT * FROM workdone WHERE Year='$n' ORDER BY Month ASC";
								$queryWorkDone=mysqli_query($dbconnect,$findWorkDone) or die("Could not get work done from database.");
								
								while($resultWorkDone=mysqli_fetch_assoc($queryWorkDone))
								{
									$getCompanies="SELECT * FROM company WHERE CompanyID=$resultWorkDone[CompanyID]";
									$queryCompanies=mysqli_query($dbconnect,$getCompanies) or die("Could not get companies from database!");
									
									if($n==$fromYear)
									{
										if($resultWorkDone["Month"]==$fromMonth)
										{
											if($resultWorkDone["Day"]>=$fromDay)
											{
												while($resultsCompanies=mysqli_fetch_assoc($queryCompanies))
												{
													showWorkDoneSearch();
												}
											}
										}
										else if($resultWorkDone["Month"]>$fromMonth)
										{
											while($resultsCompanies=mysqli_fetch_assoc($queryCompanies))
											{
												showWorkDoneSearch();
											}
										}
									}
									else if($n==$toYear)
									{
										if($resultWorkDone["Month"]==$toMonth)
										{
											if($resultWorkDone["Day"]<=$toDay)
											{
												while($resultsCompanies=mysqli_fetch_assoc($queryCompanies))
												{
													showWorkDoneSearch();
												}
											}
										}
										else if($resultWorkDone["Month"]<$toMonth)
										{
											while($resultsCompanies=mysqli_fetch_assoc($queryCompanies))
											{
												showWorkDoneSearch();
											}
										}
									}
									else
									{
										while($resultsCompanies=mysqli_fetch_assoc($queryCompanies))
										{
											showWorkDoneSearch();
										}
									}
								}
								
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
                        
                            $getCompanies="SELECT * FROM company ORDER BY companyName ASC";
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
							
							if($fromYear==$toYear)
							{
								if($fromMonth==$toMonth)
								{
									$getWorkDone="SELECT * FROM workdone WHERE Month='$fromMonth' AND Year='$fromYear' ORDER BY CompanyID ASC";
									$queryWorkDone=mysqli_query($dbconnect,$getWorkDone) or die("Could not get work done from database!");
									
									while($resultWorkDone=mysqli_fetch_assoc($queryWorkDone))
									{
										$getCompanies="SELECT * FROM company WHERE CompanyID='$resultWorkDone[CompanyID]'";
										$queryCompanies=mysqli_query($dbconnect,$getCompanies) or die("Could not get companies from database!");
										$resultCompanies=mysqli_fetch_assoc($queryCompanies);
										
										if(($resultWorkDone["Day"]>=$fromDay) && ($resultWorkDone["Day"]<=$toDay))
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
										
								}
								else
								{
									$getWorkDone="SELECT * FROM workdone WHERE Year='$fromYear' ORDER BY CompanyID ASC";
									$queryWorkDone=mysqli_query($dbconnect,$getWorkDone) or die("Could not get work done from database!");
									
									while($resultWorkDone=mysqli_fetch_assoc($queryWorkDone))
									{
										$getCompanies="SELECT * FROM company WHERE CompanyID='$resultWorkDone[CompanyID]'";
										$queryCompanies=mysqli_query($dbconnect,$getCompanies) or die("Could not get companies from database!");
										$resultCompanies=mysqli_fetch_assoc($queryCompanies);
										
										if($resultWorkDone["Month"]==$fromMonth)
										{
											if($resultWorkDone["Day"]>=$fromDay)
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
										else if($resultWorkDone["Month"]==$toMonth)
										{
											if($resultWorkDone["Day"]<=$toDay)
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
										else if(($resultWorkDone["Month"]>$fromMonth) && ($resultWorkDone["Month"]<$toMonth))
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
								}
							}
							else
							{
								$getWorkDone="SELECT * FROM workdone ORDER BY CompanyID ASC";
								$queryWorkDone=mysqli_query($dbconnect,$getWorkDone) or die("Could not get work done from database!");
								
								while($resultWorkDone=mysqli_fetch_assoc($queryWorkDone))
								{
									$getCompanies="SELECT * FROM company WHERE CompanyID='$resultWorkDone[CompanyID]'";
									$queryCompanies=mysqli_query($dbconnect,$getCompanies) or die("Could not get companies from database!");
									$resultCompanies=mysqli_fetch_assoc($queryCompanies);
									
									if($resultWorkDone["Year"]==$fromYear)
									{
										if($resultWorkDone["Month"]==$fromMonth)
										{
											if($resultWorkDone["Day"]>=$fromDay)
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
										else if($resultWorkDone["Month"]>$fromMonth)
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
									else if($resultWorkDone["Year"]==$toYear)
									{
										if($resultWorkDone["Month"]==$toMonth)
										{
											if($resultWorkDone["Day"]<=$toDay)
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
										else if($resultWorkDone["Month"]<$toMonth)
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
									else if(($resultWorkDone["Year"]>$fromYear) && ($resultWorkDone["Year"]<$toYear))
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
            
            <?php
				if($searchTerm==1 || $searchTerm==4)
				{
			?>
            
            	<div id="targetsSet">
                	<h3>Targets:</h3>
                    
                    <?php
						$totalRegularHours=0;
						$totalRegularMinutes=0;
						$totalOvertimeHours=0;
						$totalOvertimeMinutes=0;
						
						$totalRegularWage=0;
						$totalOvertimeWage=0;
						
						$daysDiff=(calculateDaysDiff($fromYear, $fromMonth, $fromDay, $toYear, $toMonth, $toDay))*(-1)+1;
						$daysDiff=(int)$daysDiff;
						$monthDays=0;
						
						$actualHours=0; $actualMinutes=0; $actualWage=0; $actualTime=0;
						$minutes=0; $hours=0; $totalHours=0; $averageTime=0; $averageWage=0;
						
						if($fromYear==$toYear)
						{
							if($fromMonth==$toMonth)
							{
								if($fromMonth==2)
								{
									if(isLeapYear($fromYear)) $monthDays=29;
									else $monthDays=28;
								}
								else if($fromMonth==4 || $fromMonth==6 || $fromMonth==9 || $fromMonth==11) $monthDays=30;
								else $monthDays=31;
								
								$findHoursTarget="SELECT * FROM hourstarget WHERE Month='$fromMonth' AND Year='$fromYear'";
								$queryHoursTargets=mysqli_query($dbconnect,$findHoursTarget) or die("Could get get hours targets from database!");
								
								while($resultHoursTargets=mysqli_fetch_assoc($queryHoursTargets))
								{
									$minutes=$resultHoursTargets["MinutesTarget"]/60;
									$hours=$resultHoursTargets["HoursTarget"];
									$totalHours=$hours+$minutes;
									
									$averageTime=$totalHours/$monthDays;
									$actualTime=$averageTime*$daysDiff;
									$actualHours=floor($actualTime);
									$actualMinutes=($actualTime-$actualHours)*60;
									
									$findHoursWorked="SELECT * FROM workdone WHERE Month='$fromMonth' AND Year='$fromYear' ORDER BY Day ASC";
									$queryHoursWorked=mysqli_query($dbconnect, $findHoursWorked) or die("Could not get workdone from database!");
									
									while($resultHoursWorked=mysqli_fetch_assoc($queryHoursWorked))
									{
										if(($resultHoursWorked["Day"]>=$fromDay) && ($resultHoursWorked["Day"]<=$toDay))
										{
											$totalRegularHours+=$resultHoursWorked["Hours"];
											$totalRegularMinutes+=($resultHoursWorked["Minutes"]/60);
											$totalOvertimeHours+=$resultHoursWorked["OvertimeHours"];
											$totalOvertimeMinutes+=($resultHoursWorked["OvertimeMinutes"]/60);
											
											if($totalRegularMinutes>=1)
											{
												$totalRegularMinutes-=1;
												$totalRegularHours+=1;
											}
											
											if($totalOvertimeMinutes>=1)
											{
												$totalOvertimeMinutes-=1;
												$totalOvertimeHours+=1;
											}
										}
									}
								}
								
								$findWagesTarget="SELECT * FROM wagetarget WHERE Month='$fromMonth' AND Year='$fromYear'";
								$queryWagesTargets=mysqli_query($dbconnect,$findWagesTarget) or die("Could get get wages targets from database!");
								
								while($resultWagesTargets=mysqli_fetch_assoc($queryWagesTargets))
								{
									$wage=$resultWagesTargets["TotalTarget"];
									$averageWage=$wage/$monthDays;
									$actualWage=$averageWage*$daysDiff;
									
									$findWagesEarned="SELECT * FROM workdone WHERE Month='$fromMonth' AND Year='$fromYear' ORDER BY Day ASC";
									$queryWagesEarned=mysqli_query($dbconnect, $findWagesEarned) or die("Could not get workdone from database!");
									
									while($resultWagesEarned=mysqli_fetch_assoc($queryWagesEarned))
									{
										if(($resultWagesEarned["Day"]>=$fromDay) && ($resultWagesEarned["Day"]<=$toDay))
										{
											$hours=$resultWagesEarned["Hours"];
											$minutes=$resultWagesEarned["Minutes"]/60;
											$totalHours=$hours+$minutes;
											$regularWage=$resultWagesEarned["Wage"];
											$totalRegularWage+=($regularWage*$totalHours);
											
											$OvertimeHours=$resultWagesEarned["OvertimeHours"];
											$OvertimeMinutes=$resultWagesEarned["OvertimeMinutes"]/60;
											$totalOvertimeHours=$OvertimeHours+$OvertimeMinutes;
											$overtimeWage=$resultWagesEarned["OvertimeWage"];
											$totalOvertimeWage+=($overtimeWage*$totalOvertimeHours);
										}
									}
								}
							}
							else
							{
								for($n=$fromMonth; $n<=$toMonth; $n++)
								{
									$findHoursTarget="SELECT * FROM hourstarget WHERE Month='$n' AND Year='$fromYear'";
									$queryHoursTargets=mysqli_query($dbconnect,$findHoursTarget) or die("Could get get hours targets from database!");
									
									$findHoursWorked="SELECT * FROM workdone WHERE Month='$n' AND Year='$fromYear' ORDER BY Day ASC";
									$queryHoursWorked=mysqli_query($dbconnect, $findHoursWorked) or die("Could not get workdone from database!");
									
									$findWagesEarned="SELECT * FROM workdone WHERE Month='$n' AND Year='$fromYear' ORDER BY Day ASC";
									$queryWagesEarned=mysqli_query($dbconnect, $findWagesEarned) or die("Could not get workdone from database!");
									
									$findWagesTarget="SELECT * FROM wagetarget WHERE Month='$n' AND Year='$fromYear'";
									$queryWagesTargets=mysqli_query($dbconnect,$findWagesTarget) or die("Could get get wages targets from database!");
									
									if($n==2)
									{
										if(isLeapYear($fromYear)) $monthDays=29;
										else $monthDays=28;
									}
									else if($n==4 || $n==6 || $n==9 || $n==11) $monthDays=30;
									else $monthDays=31;
									
									if($n==$fromMonth)
									{
										$actualDiff=(calculateDaysDiff($fromYear, $fromMonth, $fromDay, $fromYear, $fromMonth, $monthDays))*(-1)+1;
										$actualDiff=(int)$actualDiff;
										
										while($resultHoursTargets=mysqli_fetch_assoc($queryHoursTargets))
										{
											$minutes=$resultHoursTargets["MinutesTarget"]/60;
											$hours=$resultHoursTargets["HoursTarget"];
											$totalHours=$hours+$minutes;
											$averageTime=$totalHours/$monthDays;
											
											$actualTime=$averageTime*$actualDiff;
											$actualHours=floor($actualTime);
											$actualMinutes=($actualTime-$actualHours)*60;
											
											while($resultHoursWorked=mysqli_fetch_assoc($queryHoursWorked))
											{
												if($resultHoursWorked["Day"]>=$fromDay)
												{
													$totalRegularHours+=$resultHoursWorked["Hours"];
													$totalRegularMinutes+=($resultHoursWorked["Minutes"]/60);
													$totalOvertimeHours+=$resultHoursWorked["OvertimeHours"];
													$totalOvertimeMinutes+=($resultHoursWorked["OvertimeMinutes"]/60);
													
													if($totalRegularMinutes>=1)
													{
														$totalRegularMinutes-=1;
														$totalRegularHours+=1;
													}
													
													if($totalOvertimeMinutes>=1)
													{
														$totalOvertimeMinutes-=1;
														$totalOvertimeHours+=1;
													}
												}
											}
										}
										
										while($resultWagesTargets=mysqli_fetch_assoc($queryWagesTargets))
										{
											$wage=$resultWagesTargets["TotalTarget"];
											$averageWage=$wage/$monthDays;
											$actualWage=$averageWage*$actualDiff;
											
											while($resultWagesEarned=mysqli_fetch_assoc($queryWagesEarned))
											{
												if($resultWagesEarned["Day"]>=$fromDay)
												{
													$hours=$resultWagesEarned["Hours"];
													$minutes=$resultWagesEarned["Minutes"]/60;
													$totalHours=$hours+$minutes;
													$regularWage=$resultWagesEarned["Wage"];
													$totalRegularWage+=($regularWage*$totalHours);
													
													$OvertimeHours=$resultWagesEarned["OvertimeHours"];
													$OvertimeMinutes=$resultWagesEarned["OvertimeMinutes"]/60;
													$totalOvertimeHours=$OvertimeHours+$OvertimeMinutes;
													$overtimeWage=$resultWagesEarned["OvertimeWage"];
													$totalOvertimeWage+=($overtimeWage*$totalOvertimeHours);
												}
											}
										}
									}
									else if($n==$toMonth)
									{
										$actualDiff=(calculateDaysDiff($toYear, $toMonth, 1, $toYear, $toMonth, $toDay))*(-1)+1;
										$actualDiff=(int)$actualDiff;
										
										while($resultHoursTargets=mysqli_fetch_assoc($queryHoursTargets))
										{
											$minutes=$resultHoursTargets["MinutesTarget"]/60;
											$hours=$resultHoursTargets["HoursTarget"];
											$totalHours=$hours+$minutes;
											$averageTime=$totalHours/$monthDays;
											
											$actualTime+=($averageTime*$actualDiff);
											$actualHours=floor($actualTime);
											$actualMinutes=($actualTime-$actualHours)*60;
											$actualMinutes=round($actualMinutes);
											
											while($resultHoursWorked=mysqli_fetch_assoc($queryHoursWorked))
											{
												if($resultHoursWorked["Day"]<=$toDay)
												{
													$totalRegularHours+=$resultHoursWorked["Hours"];
													$totalRegularMinutes+=($resultHoursWorked["Minutes"]/60);
													$totalOvertimeHours+=$resultHoursWorked["OvertimeHours"];
													$totalOvertimeMinutes+=($resultHoursWorked["OvertimeMinutes"]/60);
													
													if($totalRegularMinutes>=1)
													{
														$totalRegularMinutes-=1;
														$totalRegularHours+=1;
													}
													
													if($totalOvertimeMinutes>=1)
													{
														$totalOvertimeMinutes-=1;
														$totalOvertimeHours+=1;
													}
												}
											}
										}
										
										while($resultWagesTargets=mysqli_fetch_assoc($queryWagesTargets))
										{
											$wage=$resultWagesTargets["TotalTarget"];
											$averageWage=$wage/$monthDays;
											$actualWage+=($averageWage*$actualDiff);
											
											while($resultWagesEarned=mysqli_fetch_assoc($queryWagesEarned))
											{
												if($resultWagesEarned["Day"]<=$toDay)
												{
													$hours=$resultWagesEarned["Hours"];
													$minutes=$resultWagesEarned["Minutes"]/60;
													$totalHours=$hours+$minutes;
													$regularWage=$resultWagesEarned["Wage"];
													$totalRegularWage+=($regularWage*$totalHours);
													
													$OvertimeHours=$resultWagesEarned["OvertimeHours"];
													$OvertimeMinutes=$resultWagesEarned["OvertimeMinutes"]/60;
													$totalOvertimeHours=$OvertimeHours+$OvertimeMinutes;
													$overtimeWage=$resultWagesEarned["OvertimeWage"];
													$totalOvertimeWage+=($overtimeWage*$totalOvertimeHours);
												}
											}
										}
									}
									else
									{
										while($resultHoursTargets=mysqli_fetch_assoc($queryHoursTargets))
										{
											$minutes=($actualMinutes+$resultHoursTargets["MinutesTarget"])/60;
											if($minutes>=1)
											{
												$actualHours++; $minutes--;
											}
											$hours=$actualHours+($resultHoursTargets["HoursTarget"]);
											$totalHours=($hours+$minutes);
											
											$actualTime=$totalHours;
											$actualHours=floor($actualTime);
											$actualMinutes=($actualTime-$actualHours)*60;
																						
											while($resultHoursWorked=mysqli_fetch_assoc($queryHoursWorked))
											{
												$totalRegularHours+=$resultHoursWorked["Hours"];
												$totalRegularMinutes+=($resultHoursWorked["Minutes"]/60);
												$totalOvertimeHours+=$resultHoursWorked["OvertimeHours"];
												$totalOvertimeMinutes+=($resultHoursWorked["OvertimeMinutes"]/60);
												
												if($totalRegularMinutes>=1)
												{
													$totalRegularMinutes-=1;
													$totalRegularHours+=1;
												}
												
												if($totalOvertimeMinutes>=1)
												{
													$totalOvertimeMinutes-=1;
													$totalOvertimeHours+=1;
												}
											}
										}
										
										while($resultWagesTargets=mysqli_fetch_assoc($queryWagesTargets))
										{
											$actualWage+=$resultWagesTargets["TotalTarget"];
											
											while($resultWagesEarned=mysqli_fetch_assoc($queryWagesEarned))
											{
												$hours=$resultWagesEarned["Hours"];
												$minutes=$resultWagesEarned["Minutes"]/60;
												$totalHours=$hours+$minutes;
												$regularWage=$resultWagesEarned["Wage"];
												$totalRegularWage+=($regularWage*$totalHours);
												
												$OvertimeHours=$resultWagesEarned["OvertimeHours"];
												$OvertimeMinutes=$resultWagesEarned["OvertimeMinutes"]/60;
												$totalOvertimeHours=$OvertimeHours+$OvertimeMinutes;
												$overtimeWage=$resultWagesEarned["OvertimeWage"];
												$totalOvertimeWage+=($overtimeWage*$totalOvertimeHours);
											}
										}
									}
								}

							}
						}
						else
						{
							for($k=$fromYear; $k<=$toYear; $k++)
							{
								if($k==$fromYear)
								{
									for($n=$fromMonth; $n<=12; $n++)
									{
										$findHoursTarget="SELECT * FROM hourstarget WHERE Month='$n' AND Year='$k'";
										$queryHoursTargets=mysqli_query($dbconnect,$findHoursTarget) or die("Could get get hours targets from database!");
									
										$findHoursWorked="SELECT * FROM workdone WHERE Month='$n' AND Year='$k' ORDER BY Day ASC";
										$queryHoursWorked=mysqli_query($dbconnect, $findHoursWorked) or die("Could not get workdone from database!");
										
										$findWagesEarned="SELECT * FROM workdone WHERE Month='$n' AND Year='$k' ORDER BY Day ASC";
										$queryWagesEarned=mysqli_query($dbconnect, $findWagesEarned) or die("Could not get workdone from database!");
										
										$findWagesTarget="SELECT * FROM wagetarget WHERE Month='$n' AND Year='$k'";
										$queryWagesTargets=mysqli_query($dbconnect,$findWagesTarget) or die("Could get get wages targets from database!");
										
										if($n==2)
										{
											if(isLeapYear($k)) $monthDays=29;
											else $monthDays=28;
										}
										else if($n==4 || $n==6 || $n==9 || $n==11) $monthDays=30;
										else $monthDays=31;
										
										if($n==$fromMonth)
										{
											$actualDiff=(calculateDaysDiff($fromYear, $fromMonth, $fromDay, $fromYear, $fromMonth, $monthDays))*(-1)+1;
											$actualDiff=(int)$actualDiff;
											
											while($resultHoursTargets=mysqli_fetch_assoc($queryHoursTargets))
											{
												$minutes=$resultHoursTargets["MinutesTarget"]/60;
												$hours=$resultHoursTargets["HoursTarget"];
												$totalHours=$hours+$minutes;
												$averageTime=$totalHours/$monthDays;
												
												$actualTime=$averageTime*$actualDiff;
												$actualHours=floor($actualTime);
												$actualMinutes=($actualTime-$actualHours)*60;
												
												while($resultHoursWorked=mysqli_fetch_assoc($queryHoursWorked))
												{
													if($resultHoursWorked["Day"]>=$fromDay)
													{
														$totalRegularHours+=$resultHoursWorked["Hours"];
														$totalRegularMinutes+=($resultHoursWorked["Minutes"]/60);
														$totalOvertimeHours+=$resultHoursWorked["OvertimeHours"];
														$totalOvertimeMinutes+=($resultHoursWorked["OvertimeMinutes"]/60);
														
														if($totalRegularMinutes>=1)
														{
															$totalRegularMinutes-=1;
															$totalRegularHours+=1;
														}
														
														if($totalOvertimeMinutes>=1)
														{
															$totalOvertimeMinutes-=1;
															$totalOvertimeHours+=1;
														}
													}
												}
											}
											
											while($resultWagesTargets=mysqli_fetch_assoc($queryWagesTargets))
											{
												$wage=$resultWagesTargets["TotalTarget"];
												$averageWage=$wage/$monthDays;
												$actualWage=$averageWage*$actualDiff;
												
												while($resultWagesEarned=mysqli_fetch_assoc($queryWagesEarned))
												{
													if($resultWagesEarned["Day"]>=$fromDay)
													{
														$hours=$resultWagesEarned["Hours"];
														$minutes=$resultWagesEarned["Minutes"]/60;
														$totalHours=$hours+$minutes;
														$regularWage=$resultWagesEarned["Wage"];
														$totalRegularWage+=($regularWage*$totalHours);
														
														$OvertimeHours=$resultWagesEarned["OvertimeHours"];
														$OvertimeMinutes=$resultWagesEarned["OvertimeMinutes"]/60;
														$totalOvertimeHours=$OvertimeHours+$OvertimeMinutes;
														$overtimeWage=$resultWagesEarned["OvertimeWage"];
														$totalOvertimeWage+=($overtimeWage*$totalOvertimeHours);
													}
												}
											}
										}
										else
										{
											while($resultHoursTargets=mysqli_fetch_assoc($queryHoursTargets))
											{
												$minutes=($actualMinutes+$resultHoursTargets["MinutesTarget"])/60;
												if($minutes>=1)
												{
													$actualHours++; $minutes--;
												}
												$hours=$actualHours+($resultHoursTargets["HoursTarget"]);
												$totalHours=($hours+$minutes);
												
												$actualTime=$totalHours;
												$actualHours=floor($actualTime);
												$actualMinutes=($actualTime-$actualHours)*60;
																							
												while($resultHoursWorked=mysqli_fetch_assoc($queryHoursWorked))
												{
													$totalRegularHours+=$resultHoursWorked["Hours"];
													$totalRegularMinutes+=($resultHoursWorked["Minutes"]/60);
													$totalOvertimeHours+=$resultHoursWorked["OvertimeHours"];
													$totalOvertimeMinutes+=($resultHoursWorked["OvertimeMinutes"]/60);
													
													if($totalRegularMinutes>=1)
													{
														$totalRegularMinutes-=1;
														$totalRegularHours+=1;
													}
													
													if($totalOvertimeMinutes>=1)
													{
														$totalOvertimeMinutes-=1;
														$totalOvertimeHours+=1;
													}
												}
											}
											
											while($resultWagesTargets=mysqli_fetch_assoc($queryWagesTargets))
											{
												$actualWage+=$resultWagesTargets["TotalTarget"];
												
												while($resultWagesEarned=mysqli_fetch_assoc($queryWagesEarned))
												{
													$hours=$resultWagesEarned["Hours"];
													$minutes=$resultWagesEarned["Minutes"]/60;
													$totalHours=$hours+$minutes;
													$regularWage=$resultWagesEarned["Wage"];
													$totalRegularWage+=($regularWage*$totalHours);
													
													$OvertimeHours=$resultWagesEarned["OvertimeHours"];
													$OvertimeMinutes=$resultWagesEarned["OvertimeMinutes"]/60;
													$totalOvertimeHours=$OvertimeHours+$OvertimeMinutes;
													$overtimeWage=$resultWagesEarned["OvertimeWage"];
													$totalOvertimeWage+=($overtimeWage*$totalOvertimeHours);
												}
											}
										}
									}
								}
								else if($k==$toYear)
								{
									for($n=1; $n<=$toMonth; $n++)
									{
										$findHoursTarget="SELECT * FROM hourstarget WHERE Month='$n' AND Year='$k'";
										$queryHoursTargets=mysqli_query($dbconnect,$findHoursTarget) or die("Could get get hours targets from database!");
									
										$findHoursWorked="SELECT * FROM workdone WHERE Month='$n' AND Year='$k' ORDER BY Day ASC";
										$queryHoursWorked=mysqli_query($dbconnect, $findHoursWorked) or die("Could not get workdone from database!");
										
										$findWagesEarned="SELECT * FROM workdone WHERE Month='$n' AND Year='$k' ORDER BY Day ASC";
										$queryWagesEarned=mysqli_query($dbconnect, $findWagesEarned) or die("Could not get workdone from database!");
										
										$findWagesTarget="SELECT * FROM wagetarget WHERE Month='$n' AND Year='$k'";
										$queryWagesTargets=mysqli_query($dbconnect,$findWagesTarget) or die("Could get get wages targets from database!");
										
										if($n==$toMonth)
										{
											$actualDiff=(calculateDaysDiff($toYear, $toMonth, 1, $toYear, $toMonth, $toDay))*(-1)+1;
											$actualDiff=(int)$actualDiff;
											
											while($resultHoursTargets=mysqli_fetch_assoc($queryHoursTargets))
											{
												$minutes=$resultHoursTargets["MinutesTarget"]/60;
												$hours=$resultHoursTargets["HoursTarget"];
												$totalHours=$hours+$minutes;
												$averageTime=$totalHours/$monthDays;
												
												$actualTime+=($averageTime*$actualDiff);
												$actualHours=floor($actualTime);
												$actualMinutes=($actualTime-$actualHours)*60;
												$actualMinutes=round($actualMinutes);
												
												while($resultHoursWorked=mysqli_fetch_assoc($queryHoursWorked))
												{
													if($resultHoursWorked["Day"]<=$toDay)
													{
														$totalRegularHours+=$resultHoursWorked["Hours"];
														$totalRegularMinutes+=($resultHoursWorked["Minutes"]/60);
														$totalOvertimeHours+=$resultHoursWorked["OvertimeHours"];
														$totalOvertimeMinutes+=($resultHoursWorked["OvertimeMinutes"]/60);
														
														if($totalRegularMinutes>=1)
														{
															$totalRegularMinutes-=1;
															$totalRegularHours+=1;
														}
														
														if($totalOvertimeMinutes>=1)
														{
															$totalOvertimeMinutes-=1;
															$totalOvertimeHours+=1;
														}
													}
												}
											}
											
											while($resultWagesTargets=mysqli_fetch_assoc($queryWagesTargets))
											{
												$wage=$resultWagesTargets["TotalTarget"];
												$averageWage=$wage/$monthDays;
												$actualWage+=($averageWage*$actualDiff);
												
												while($resultWagesEarned=mysqli_fetch_assoc($queryWagesEarned))
												{
													if($resultWagesEarned["Day"]<=$toDay)
													{
														$hours=$resultWagesEarned["Hours"];
														$minutes=$resultWagesEarned["Minutes"]/60;
														$totalHours=$hours+$minutes;
														$regularWage=$resultWagesEarned["Wage"];
														$totalRegularWage+=($regularWage*$totalHours);
														
														$OvertimeHours=$resultWagesEarned["OvertimeHours"];
														$OvertimeMinutes=$resultWagesEarned["OvertimeMinutes"]/60;
														$totalOvertimeHours=$OvertimeHours+$OvertimeMinutes;
														$overtimeWage=$resultWagesEarned["OvertimeWage"];
														$totalOvertimeWage+=($overtimeWage*$totalOvertimeHours);
													}
												}
											}
										}
										else
										{
											while($resultHoursTargets=mysqli_fetch_assoc($queryHoursTargets))
											{
												$minutes=($actualMinutes+$resultHoursTargets["MinutesTarget"])/60;
												if($minutes>=1)
												{
													$actualHours++; $minutes--;
												}
												$hours=$actualHours+($resultHoursTargets["HoursTarget"]);
												$totalHours=($hours+$minutes);
												
												$actualTime=$totalHours;
												$actualHours=floor($actualTime);
												$actualMinutes=($actualTime-$actualHours)*60;
																							
												while($resultHoursWorked=mysqli_fetch_assoc($queryHoursWorked))
												{
													$totalRegularHours+=$resultHoursWorked["Hours"];
													$totalRegularMinutes+=($resultHoursWorked["Minutes"]/60);
													$totalOvertimeHours+=$resultHoursWorked["OvertimeHours"];
													$totalOvertimeMinutes+=($resultHoursWorked["OvertimeMinutes"]/60);
													
													if($totalRegularMinutes>=1)
													{
														$totalRegularMinutes-=1;
														$totalRegularHours+=1;
													}
													
													if($totalOvertimeMinutes>=1)
													{
														$totalOvertimeMinutes-=1;
														$totalOvertimeHours+=1;
													}
												}
											}
											
											while($resultWagesTargets=mysqli_fetch_assoc($queryWagesTargets))
											{
												$actualWage+=$resultWagesTargets["TotalTarget"];
												
												while($resultWagesEarned=mysqli_fetch_assoc($queryWagesEarned))
												{
													$hours=$resultWagesEarned["Hours"];
													$minutes=$resultWagesEarned["Minutes"]/60;
													$totalHours=$hours+$minutes;
													$regularWage=$resultWagesEarned["Wage"];
													$totalRegularWage+=($regularWage*$totalHours);
													
													$OvertimeHours=$resultWagesEarned["OvertimeHours"];
													$OvertimeMinutes=$resultWagesEarned["OvertimeMinutes"]/60;
													$totalOvertimeHours=$OvertimeHours+$OvertimeMinutes;
													$overtimeWage=$resultWagesEarned["OvertimeWage"];
													$totalOvertimeWage+=($overtimeWage*$totalOvertimeHours);
												}
											}
										}
									}
								}
								else
								{
									$findHoursTarget="SELECT * FROM hourstarget WHERE Year='$k'";
									$queryHoursTargets=mysqli_query($dbconnect,$findHoursTarget) or die("Could get get hours targets from database!");
								
									$findHoursWorked="SELECT * FROM workdone WHERE Year='$k' ORDER BY Day ASC";
									$queryHoursWorked=mysqli_query($dbconnect, $findHoursWorked) or die("Could not get workdone from database!");
									
									$findWagesEarned="SELECT * FROM workdone WHERE Year='$k' ORDER BY Day ASC";
									$queryWagesEarned=mysqli_query($dbconnect, $findWagesEarned) or die("Could not get workdone from database!");
									
									$findWagesTarget="SELECT * FROM wagetarget WHERE Year='$k'";
									$queryWagesTargets=mysqli_query($dbconnect,$findWagesTarget) or die("Could get get wages targets from database!");
									
									while($resultHoursTargets=mysqli_fetch_assoc($queryHoursTargets))
									{
										$minutes=($actualMinutes+$resultHoursTargets["MinutesTarget"])/60;
										if($minutes>=1)
										{
											$actualHours++; $minutes--;
										}
										$hours=$actualHours+($resultHoursTargets["HoursTarget"]);
										$totalHours=($hours+$minutes);
										
										$actualTime=$totalHours;
										$actualHours=floor($actualTime);
										$actualMinutes=($actualTime-$actualHours)*60;
																					
										while($resultHoursWorked=mysqli_fetch_assoc($queryHoursWorked))
										{
											$totalRegularHours+=$resultHoursWorked["Hours"];
											$totalRegularMinutes+=($resultHoursWorked["Minutes"]/60);
											$totalOvertimeHours+=$resultHoursWorked["OvertimeHours"];
											$totalOvertimeMinutes+=($resultHoursWorked["OvertimeMinutes"]/60);
											
											if($totalRegularMinutes>=1)
											{
												$totalRegularMinutes-=1;
												$totalRegularHours+=1;
											}
											
											if($totalOvertimeMinutes>=1)
											{
												$totalOvertimeMinutes-=1;
												$totalOvertimeHours+=1;
											}
										}
									}
									
									while($resultWagesTargets=mysqli_fetch_assoc($queryWagesTargets))
									{
										$actualWage+=$resultWagesTargets["TotalTarget"];
										
										while($resultWagesEarned=mysqli_fetch_assoc($queryWagesEarned))
										{
											$hours=$resultWagesEarned["Hours"];
											$minutes=$resultWagesEarned["Minutes"]/60;
											$totalHours=$hours+$minutes;
											$regularWage=$resultWagesEarned["Wage"];
											$totalRegularWage+=($regularWage*$totalHours);
											
											$OvertimeHours=$resultWagesEarned["OvertimeHours"];
											$OvertimeMinutes=$resultWagesEarned["OvertimeMinutes"]/60;
											$totalOvertimeHours=$OvertimeHours+$OvertimeMinutes;
											$overtimeWage=$resultWagesEarned["OvertimeWage"];
											$totalOvertimeWage+=($overtimeWage*$totalOvertimeHours);
										}
									}
								}
							}
						}
						
						echo "<div id='birth'>";
						echo "<table style='width:750px;'>";
							echo "<tr>";
							echo "<td style='width:620px;'>";
								echo "A target of " . $actualHours . " hours";
								if($actualMinutes!=0)
								{
									echo " and " . $actualMinutes . " minutes";
								}
								echo ".";
								
								$totalWorkedHours=$totalRegularHours+$totalRegularMinutes+$totalOvertimeHours+$totalOvertimeMinutes;
								
								$difference=$actualTime-$totalWorkedHours;
								
								if($difference>0)
								{
									$flooredDiff=floor($difference);
									$minutesDiff=$difference-$flooredDiff;
									echo " You have " . $flooredDiff . " hours and " . (round($minutesDiff*60)) . " minutes hours to go";
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
									echo " You have done " . $flooredDiff . " hours and " . (round($minutesDiff*60)) . " minutes more than your target";
								}
								echo ", including overtime.";
								
							echo "</td>";
							echo "</tr>";
						echo "</table>";
						echo "</div>\n";
						
						echo "<br />";
						echo "<div id='birth'>";
						echo "<table style='width:750px;'>";
							echo "<tr>";
							echo "<td style='width:620px;'>";
								echo "A target of £";
									printf("%.2f", $actualWage);
								echo "!";

								$wageDiff=$actualWage-($totalRegularWage+$totalOvertimeWage);
								
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
					
					?>
                    
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
		header("Location: day.php?day=$savedDay&month=$savedMonth&year=$savedYear&type=search&error=$error&fromDay=$fromDay&fromMonth=$fromMonth&fromYear=$fromYear&toDay=$toDay&toMonth=$toMonth&toYear=$toYear&searchTerm=$searchTerm");
	}
	else
	{
		header("Location: month.php?month=$savedMonth&year=$savedYear&type=search&error=$error&fromDay=$fromDay&fromMonth=$fromMonth&fromYear=$fromYear&toDay=$toDay&toMonth=$toMonth&toYear=$toYear&searchTerm=$searchTerm");
	}
}

?>