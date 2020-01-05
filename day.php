<?php include("includes/functions.php"); ?>
<?php include("includes/config.php"); ?>
<?php include("includes/settings.php"); ?>

<?php

	if(isset($_GET["year"])) $year=$_GET["year"];
	else $year=date("Y");
	
	if(isset($_GET["month"])) $month=$_GET["month"];
	else $month=date("n");
	
	if(isset($_GET["day"])) $day=$_GET["day"];
	else $day=date("j");
	
	if($day!=1)
	{
		$previousDay=$day-1;
		$bMonth=$month;
		$bYear=$year;
	}
	else
	{
		$bMonth=$month-1;
		$bYear=$year;
		
		switch($month)
		{
			case 1:
				$previousDay=31;
				$bMonth=12;
				$bYear=$year-1;
				break;
			case 2:
			case 4:
			case 6:
			case 8:
			case 9:
			case 11:
				$previousDay=31;
				break;
			case 3:
				if(isLeapYear($year)==1)
				{
					$previousDay=29;
				}
				else
				{
					$previousDay=28;
				}
				break;
			case 5:
			case 7:
			case 10:
			case 12:
				$previousDay=30;
				break;
			default:
				die("This is not a correct month.");
		}
	}
	
	if($month==1 || $month==3 || $month==5 || $month==7 || $month==8 || $month==10 || $month==12) $last=31;
	else if($month==2)
	{
		if(isLeapYear($year)) $last=29;
		else $last=28; 
	}
	else $last=30;
	
	$nextDay=$day+1;
	$cMonth=$month;
	$cYear=$year;
	
	if($day==$last)
	{
		$nextDay=1;
		$cMonth=$month+1;
		if($month==12)
		{
			$cMonth=1;
			$cYear=$year+1;
		}
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Calendar :: <?php echo $fullDays[calculateDay($day,$month, $year)] . " " . $day . " " . $months[$month-1] . " " . $year ?></title>
<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript" src="jquery-1.6.4.min.js" ></script>
<script type="text/javascript" src="script.js" ></script>
</head>

<body>

	<div id="main">
    
    	<?php
		
			echo "<h1 class='year'>";
				echo "<a href='day.php?day=$previousDay&month=$bMonth&year=$bYear' class='prev'>Previous Day</a>";
				echo "<a href='day.php?day=$day&month=$month&year=$year'>";
				echo $fullDays[calculateDay($day, $month, $year)];
				echo " $day";
				
					if($day==1 || $day==21 || $day==31)
					{
						echo "<sup>st</sup>";
					}
					else if($day==2 || $day==22)
					{
						echo "<sup>nd</sup>";
					}
					else if($day==3 || $day==23)
					{
						echo "<sup>rd</sup>";
					}
					else
					{
						echo "<sup>th</sup>";
					}
				
				echo "</a> ";
				echo "<a href='month.php?month=$month&year=$year'>" . $months[$month-1] . "</a> ";
				echo "<a href='index.php?year=$year'>$year</a>"; 
				echo "<a href='day.php?day=$nextDay&month=$cMonth&year=$cYear' class='next'>Next Day</a>";
			echo "</h1>\n";
			echo "<div style='clear:both'></div>\n\n";
		
		?>
        
        <div id="left">
        	
            <div id="add">
        		<input type="button" value="Add Birthday" class="addBirthday" onclick="startTime()" />
            	<input type="button" value="Set Reminder" class="setReminder" onclick="startTime()" />
            	<input type="button" value="Add Payment" class="addPayment" onclick="startTime()" />
                <input type="button" value="Add Work" class="addWorkDone" onclick="startTime()" />
                <input type="button" value="Add Target" class="addHoursTarget" onclick="startTime()" />
                <input type="button" value="Add Wage Target" class="addWageTarget" onclick="startTime()" />
        	</div>
            
            <div id="searchBox">
            	<h3>Search:</h3><br />
                <form method="post" action="search.php">
                <input type="hidden" name="savedDay" value="<?php echo $day; ?>" />
                <input type="hidden" name="savedMonth" value="<?php echo $month; ?>" />
                <input type="hidden" name="savedYear" value="<?php echo $year; ?>" />
                	&nbsp;&nbsp;From &nbsp;&nbsp;&nbsp;
                     <select name="fromDay">
                     	<?php 
							for($n=1; $n<=31; $n++)
							{
								echo "<option value='$n'";
								
									if(isset($_GET["type"]))
									{
										if($_GET["type"]=="search")
										{
											if($n==$_GET["fromDay"]) echo "selected=selected";
										}
										else if($n==$day) echo "selected='selected'";
									}
									else if($n==$day) echo "selected='selected'";
								
								echo ">$n</option>\n";
							}
						?>
                     </select>
                     <select name="fromMonth">
                     	<?php
							for($n=1; $n<=12; $n++)
							{
								echo "<option value='$n'";
									if(isset($_GET["type"]))
									{
										if($_GET["type"]=="search")
										{
											if($n==$_GET["fromMonth"]) echo "selected=selected";
										}
										else if($month==$n)
										{
											echo "selected='selected'";
										}
									}
									else if($month==$n)
									{
										echo "selected='selected'";
									}
								echo ">";
									echo $months[$n-1];
								echo "</option>\n";
							}
						?>
                     </select>
                     <input type="text" 
                     	value="<?php 
							if(isset($_GET["type"]))
							{
								if($_GET["type"]=="search")
								{
									echo $_GET["fromYear"];
								}
								else echo $year;
							}
							else echo $year;
							
						?>" 
                     name="fromYear" size="1" maxlength="4" />
                     
                    <br />&nbsp;&nbsp;To &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     <select name="toDay">
                     	<?php 
							for($n=1; $n<=31; $n++)
							{
								echo "<option value='$n'";
								
									if(isset($_GET["type"]))
									{
										if($_GET["type"]=="search")
										{
											if($n==$_GET["toDay"]) echo "selected=selected";
										}
										else if($n==$day) echo "selected='selected'";
									}
									else if($n==$day) echo "selected='selected'";
								
								echo ">$n</option>\n";
							}
						?>
                     </select>
                     <select name="toMonth">
                     	<?php
							for($n=1; $n<=12; $n++)
							{
								echo "<option value='$n'";
									if(isset($_GET["type"]))
									{
										if($_GET["type"]=="search")
										{
											if($n==$_GET["toMonth"]) echo "selected=selected";
										}
										else if(($month+1)==$n)
										{
											echo "selected='selected'";
										}
									}
									else if(($month+1)==$n)
									{
										echo "selected='selected'";
									}
								echo ">";
									echo $months[$n-1];
								echo "</option>\n";
							}
						?>
                     </select>
                     <input type="text" 
                     	value="<?php 
							if(isset($_GET["type"]))
							{
								if($_GET["type"]=="search")
								{
									echo $_GET["toYear"];
								}
								else
								{
									if($month==12)
									{
										echo $year+1;
									}
									else echo $year;
								}
							}
							else
							{
								if($month==12)
								{
									echo $year+1;
								}
								else echo $year;
							}
						?>" 
                     name="toYear" size="1" maxlength="4" />
                     
                    <br />&nbsp;&nbsp;For &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     <select name="searchTerm">
                     	<option value="1">All</option>
                        <option value="2"
                        	<?php
								if(isset($_GET["type"]))
								{
									if($_GET["type"]=="search")
									{
										if($_GET["searchTerm"]==2) echo "selected='selected'";
									}
								}
							?>
                        >Payments</option>
                        <option value="3"
                        	<?php
								if(isset($_GET["type"]))
								{
									if($_GET["type"]=="search")
									{
										if($_GET["searchTerm"]==3) echo "selected='selected'";
									}
								}
							?>
                        >Work Done</option>
                        <option value="4"
                        	<?php
								if(isset($_GET["type"]))
								{
									if($_GET["type"]=="search")
									{
										if($_GET["searchTerm"]==4) echo "selected='selected'";
									}
								}
							?>
                        >Targets</option>
                     </select>
                     
                    <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Search" />
                    <button type="button" id="nextSearch" style="float:right; margin-right:50px;">Next search</button>
                </form>
            </div>
            
            <div id="searchBox2">
            	<h3>Search:</h3><br />
                
                <form method="post" action="search2.php">
                <input type="hidden" name="savedDay" value="<?php echo $day; ?>" />
                <input type="hidden" name="savedMonth" value="<?php echo $month; ?>" />
                <input type="hidden" name="savedYear" value="<?php echo $year; ?>" />
                    &nbsp;&nbsp;For &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text" name="searchText" 
                    	<?php
							if(isset($_GET["type"]))
							{
								if($_GET["type"]=="search2")
								{
									if(!empty($_GET["searchText"])) echo $_GET["searchText"];
								}
							}
						?>
                    /> <br />
                    &nbsp;&nbsp;In &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <select name="searchTerm">
                        <option value="1">All</option>
                        <option value="2"
                        	<?php
								if(isset($_GET["type"]))
								{
									if($_GET["type"]=="search2")
									{
										if($_GET["searchTerm"]==2) echo "selected='selected'";
									}
								}
							?>
                        >Birthdays</option>
                        <option value="3"
                        	<?php
								if(isset($_GET["type"]))
								{
									if($_GET["type"]=="search2")
									{
										if($_GET["searchTerm"]==3) echo "selected='selected'";
									}
								}
							?>
                        >Reminders</option>
                        <option value="4"
                        	<?php
								if(isset($_GET["type"]))
								{
									if($_GET["type"]=="search2")
									{
										if($_GET["searchTerm"]==4) echo "selected='selected'";
									}
								}
							?>
                        >Payments</option>
                        <option value="5"
                        	<?php
								if(isset($_GET["type"]))
								{
									if($_GET["type"]=="search2")
									{
										if($_GET["searchTerm"]==5) echo "selected='selected'";
									}
								}
							?>
                        >Work Done</option>
                    </select>
                	<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Search" />
                    <button type="button" id="PrevSearch" style="float:right; margin-right:50px;">Prev search</button>
                </form>
                
            </div>
            
            <?php
				if(isset($_GET["type"]))
				{
					if($_GET["type"]=="search2")
					{
						echo "<script type='text/javascript'>";
							echo "$('#searchBox2').slideDown(1500)";
						echo "</script>\n";
						
						echo "<script type='text/javascript'>";
							echo "$('#searchBox').slideUp(1500)";
						echo "</script>\n";
					}
				}
			?>
            
            <div id="error"
            	<?php
				
					if(isset($_GET["confirm"]))
					{
						echo " style='background:lightblue'";
					}
					
				?>
            >
            	<?php
					if(isset($_GET["confirm"]))
					{
						echo "Confirmed! Your process has been done.";
					}
					if(isset($_GET["type"]))
					{
						if($_GET["type"]=="addCompany")
						{
							if($_GET["error"]==1)
							{
								echo "Sorry that company name already exists in the database. Please try again!";
							}
							else if($_GET["error"]==2)
							{
								echo "You didn't enter a name for the company. Please try again!";
							}
						}
						else if($_GET["type"]=="addWorkDone")
						{
							if($_GET["error"]==1)
							{
								echo "There already exists work done for this day from the same company. Please try again!";
							}
							else if($_GET["error"]==2)
							{
								echo "You did not enter the normal hours worked. Please try again!";
							}
							else if($_GET["error"]==3)
							{
								echo "You did not enter the amount you earn per hour. Please try again!";
							}
							else if($_GET["error"]==4)
							{
								echo "You entered your overtime hours but did not enter overtime wages. Please try again!";
							}
							else if($_GET["error"]==5)
							{
								echo "You entered your overtime wage but did not enter hour many hours you worked overtime. Please try again!";
							}
						}
						else if($_GET["type"]=="addHoursTarget")
						{
							if($_GET["error"]==1)
							{
								echo "Hours target for this date already exists in the database. Please try again!";
							}
						}
						else if($_GET["type"]=="addWageTarget")
						{
							if($_GET["error"]==1)
							{
								echo "Wage target for this date already exists in the database. Please try again!";
							}
							else if($_GET["error"]==2)
							{
								echo "You did not enter a wage amount. Please try again!";
							}
						}
						else if($_GET["type"]=="deleteCompany")
						{
							if($_GET["error"]==1)
							{
								echo "Sorry this company is already being using by work done in the database. Please try again!";
							}
						}
						else if($_GET["type"]=="deleteCategory")
						{
							if($_GET["error"]==1)
							{
								echo "Sorry this category is already being usd by a payment set in the database. Please try again!";
							}
						}
						else if($_GET["type"]=="addPayment")
						{
							if($_GET["error"]==1)
							{
								echo "You did not enter a valid payment amount. Please try again!";
							}
						}
						else if($_GET["type"]=="addPaymentCategory")
						{
							if($_GET["error"]==1)
							{
								echo "This payment category already exists in the database. Please try again!";
							}
							else if($_GET["error"]==2)
							{
								echo "You did not enter a value for the payment category name. Please try again!";
							}
						}
						else if($_GET["type"]=="editBirthday")
						{
							if($_GET["error"]==1)
							{
								echo "You did not enter a name for the birthday person when editing the birthday. Please try again!";
							}
						}
						else if($_GET["type"]=="editCategory")
						{
							if($_GET["error"]==1)
							{
								echo "You did not enter a name for the payment category when editing it. Please try again!";
							}
						}
						else if($_GET["type"]=="editPayment")
						{
							if($_GET["error"]==1)
							{
								echo "You did not enter a valid amount when editing the payment. Please try again!";
							}
						}
						else if($_GET["type"]=="editReminder")
						{
							if($_GET["error"]==1)
							{
								echo "You did not enter a comment when editing the reminder. Please try again!";
							}
						}
						else if($_GET["type"]=="submitBirthday")
						{
							if($_GET["error"]==1)
							{
								echo "You did not enter a name for the birthday you was just about to add. Please try again!";
							}
						}
						else if($_GET["type"]=="submitReminder")
						{
							if($_GET["error"]==1)
							{
								echo "You did not enter a comment for the reminder you was just about to add. Please try again!";
							}
						}
						else if($_GET["type"]=="editCompany")
						{
							if($_GET["error"]==1)
							{
								echo "You did not enter a name for the company when edit it. Please try again!";
							}
						}
						else if($_GET["type"]=="editWageTarget")
						{
							if($_GET["error"]==1)
							{
								echo "You did not enter a valid amount for the wage target when editing it. Please try again!";
							}
						}
						else if($_GET["type"]=="editWorkDone")
						{
							if($_GET["error"]==1)
							{
								echo "You did not enter a wage for the work done you was just editing. Please try again!";
							}
							else if($_GET["error"]==2)
							{
								echo "You did not enter the hours worked for the work done you was just editing. Please try again!";
							}
							else if($_GET["error"]==3)
							{
								echo "You did entered the wage but not the overtime ours you worked for the work done you was just editing. Please try again!";
							}
							else if($_GET["error"]==4)
							{
								echo "You entered the overtime hours worked but did not enter the wage you received for the work done you was just editing. Please try again!";
							}
						}
						else if($_GET["type"]=="search")
						{
							if($_GET["error"]==1)
							{
								echo "One of the years is not the correct length. Please try again!";
							}
							else if($_GET["error"]==2)
							{
								echo "One of the years is not in the correct format. Please try again!";
							}
							else if($_GET["error"]==3)
							{
								echo "The end date is before the start date. Please try again!";
							}
							else if($_GET["error"]==4)
							{
								echo "The start date or the end date does not exist. Please try again!";
							}
						}
						else if($_GET["type"]=="search2")
						{
							if($_GET["error"]==1)
							{
								echo "You did not enter any value for the search text. Please try again!";
							}
						}
					}
				?>
            </div>
            
            <?php if(isset($_GET["error"]) || isset($_GET["confirm"])) { ?>

			<script type="text/javascript">
				var error=document.getElementById("error");
				$(error).fadeIn(1000);
			</script>
    
			<?php } ?>
            
            <div id="addBirthday">
            	<form method="post" action="adds/submitbirthday.php">
                <input type="hidden" name="savedDay" value="<?php echo $day ?>" />
                <input type="hidden" name="savedMonth" value="<?php echo $month ?>" />
                <input type="hidden" name="savedYear" value="<?php echo $year ?>" />
                <h2>Add Birthday</h2>
                <table>
                <tr>
                	<td style="width:250px;"><label for="personName">Person Name:</label></td>
                    <td>
                    	<input type="text" name="personName" 
                        	<?php
								if(isset($_GET["type"]))
								{
									if($_GET["type"]=="submitBirthday" && !empty($_GET["personName"]))
									{
										echo "value=" . $_GET["personName"];
									}
								}
							?>
                         />
                    </td>
                </tr>
                <tr>
                	<td><label for="Day">Day:</label></td>
                    <td>
                    	<select name="Day">
                        	<?php
							
								for($n=1; $n<=31; $n++)
								{
									echo "<option value='$n'";
										if(isset($_GET["type"]))
										{
											if($_GET["type"]=="submitBirthday")
											{
												if($n==$_GET["d"]) echo "selected='selected'";
											}
											else if($n==$day) echo "selected='selected'";
										}
										else if($n==$day) echo "selected='selected'";
									echo ">$n</option>\n";
								}
								
							?>
                        </select>
                    </td>
                </tr>
                <tr>
                	<td><label for="Month">Month:</label></td>
                    <td>
                    	<select name="Month">
                        	<?php
							
								for($n=1; $n<=12; $n++)
								{
									echo "<option value='$n'";
										if(isset($_GET["type"]))
										{
											if($_GET["type"]=="submitBirthday")
											{
												if($n==$_GET["m"]) echo "selected='selected'";
											}
											else if($n==$month) echo "selected='selected'";
										}
										else if($n==$month)
										{
											echo "selected='selected'";
										}
									echo ">" . $months[$n-1] . "</option>\n";
								}
								
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                	<td></td>
                    <td><input type="submit"/></td>
                </tr>
                </table>
                </form>
            </div>
            
            <?php 
				if(isset($_GET["type"]))
				{
					if($_GET["type"]=="submitBirthday")
					{
						?>
                        
                        <script type="text/javascript">
							var addBirthday=document.getElementById("addBirthday");
							$(addBirthday).slideDown(2500);
							startTime();
						</script>
                        
                        <?php
					}
				}
			?>
            
            <div id="setReminder">
            	<form action="adds/submitreminder.php" method="post">
                <input type="hidden" name="savedDay" value="<?php echo $day ?>" />
                <input type="hidden" name="savedMonth" value="<?php echo $month ?>" />
                <input type="hidden" name="savedYear" value="<?php echo $year ?>" />
                <h2>Set Reminder</h2>
                <table>
                <tr>
                	<td style="width:250px;"><label for="Comment">Comment:</label></td>
                    <td>
                    	<input type="text" name="Comment"
                        	<?php
								if(isset($_GET["type"]))
								{
									if($_GET["type"]=="submitReminder" && !empty($_GET["Comment"]))
									{
										echo "value=" . $_GET["Comment"];
									}
								}
							?>
                         />
                    </td>
                </tr>
                <tr>
                	<td><label for="Day">Day:</label></td>
                    <td>
                    	<select name="Day">
                        
                        	<?php
							
								for($n=1; $n<=31; $n++)
								{
									echo "<option value='$n'";
										if(isset($_GET["type"]))
										{
											if($_GET["type"]=="submitReminder")
											{
												if($n==$_GET["d"]) echo "selected='selected'";
											}
											else if($n==$day) echo "selected='selected'";
										}
										else if($n==$day)
										{
											echo "selected='selected'";
										}
									echo ">$n</option>\n";
								}
								
							?>
                            
                        </select>
                    </td>
                </tr>
                <tr>
                	<td><label for="Month">Month:</label></td>
                    <td>
                    	<select name="Month">
                        	<?php
							
								for($n=1; $n<=12; $n++)
								{
									echo "<option value='$n'";
										if(isset($_GET["type"]))
										{
											if($_GET["type"]=="submitReminder")
											{
												if($n==$_GET["m"]) echo "selected='selected'";
											}
											else if($n==$month) echo "selected='selected'";
										}
										else if($n==$month)
										{
											echo "selected='selected'";
										}
									echo ">" . $months[$n-1] . "</option>\n";
								}
								
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                	<td><label for="Year">Year:</label></td>
                    <td>
                    	<select name="Year">
                           	<?php
							
								$startYear=$year-10;
								$endYear=$year+10;
								
								for($n=$startYear; $n<=$endYear; $n++)
								{
									echo "<option value='$n'";
										if(isset($_GET["type"]))
										{
											if($_GET["type"]=="submitReminder")
											{
												if($n==$_GET["y"]) echo "selected='selected'";
											}
											else if($n==$year) echo "selected='selected'";
										}
										else if($n==$year)
										{
											echo "selected='selected'";
										}
									echo ">" . $n . "</option>\n";
								}
							
							?>                        
                        </select>
                    </td>
                </tr>
                <tr>
                	<td><label for="Occurrences">Occurrences:</label></td>
                    <td>
                    	<select name="Occurrences" id="Occurrences" onchange="hideWait();">
                        	<option value="1"
                            	<?php
									if(isset($_GET["type"]))
									{
										if($_GET["type"]=="submitReminder")
										{
											if($_GET["Occurrences"]==1) echo "selected='selected'";
										}
									}
								?>
                            >Once Only</option>
                            <option value="2"
                            	<?php
									if(isset($_GET["type"]))
									{
										if($_GET["type"]=="submitReminder")
										{
											if($_GET["Occurrences"]==2) echo "selected='selected'";
										}
									}
								?>
                            >Yearly</option>
                            <option value="3"
                            	<?php
									if(isset($_GET["type"]))
									{
										if($_GET["type"]=="submitReminder")
										{
											if($_GET["Occurrences"]==3) echo "selected='selected'";
										}
									}
								?>
                            >Monthly</option>
                            <option value="4"
                            	<?php
									if(isset($_GET["type"]))
									{
										if($_GET["type"]=="submitReminder")
										{
											if($_GET["Occurrences"]==4) echo "selected='selected'";
										}
									}
								?>
                            >Weekly</option>
                            <option value="5"
                            	<?php
									if(isset($_GET["type"]))
									{
										if($_GET["type"]=="submitReminder")
										{
											if($_GET["Occurrences"]==5) echo "selected='selected'";
										}
									}
								?>
                            >Daily</option>
                        </select>
                    </td>
                </tr>
                <tr id="wait">
                	<td><label for="Times">Number of Repeats:</label></td>
                    <td>
                    	<select name="Times">
                        	<option value="-1">Forever</option>
                        	<?php
							
								for($n=2; $n<=52; $n++)
								{
									echo "<option value='$n'";
										if(isset($_GET["type"]))
										{
											if($_GET["type"]=="submitReminder")
											{
												if($n==$_GET["Times"]) echo "selected='selected'";
											}
										}
									echo ">$n</option>\n";
								}
							?>
                        </select>
                    </td>
                </tr>
                <tr>
                	<td></td>
                    <td><input type="submit" /></td>
                </tr>
                </table>
                </form>
            </div>
            
            <?php 
				if(isset($_GET["type"]))
				{
					if($_GET["type"]=="submitReminder")
					{
						?>
                        
                        <script type="text/javascript">
							var setReminder=document.getElementById("setReminder");
							$(setReminder).slideDown(2500);
							startTime();
						</script>
                        
                        <?php
					}
				}
			?>
            
            <div id="addPayment">
            	<form action="adds/addpayment.php" method="post">
                <input type="hidden" name="savedDay" value="<?php echo $day ?>" />
                <input type="hidden" name="savedMonth" value="<?php echo $month ?>" />
                <input type="hidden" name="savedYear" value="<?php echo $year ?>" />
                <h2>Add Payment</h2>
                <table>
                <tr>
                	<td style="width:250px;"><label for="Day">Day:</label></td>
                    <td>
                    	<select name="Day">
                        
                        	<?php
							
								for($n=1; $n<=31; $n++)
								{
									echo "<option value='$n'";
										if(isset($_GET["type"]))
										{
											if($_GET["type"]=="addPayment")
											{
												if($n==$_GET["d"]) echo "selected='selected'";
											}
											else if($n==$day) echo "selected='selected'";
										}
										else if($n==$day)
										{
											echo "selected='selected'";
										}
									echo ">$n</option>\n";
								}
								
							?>
                            
                        </select>
                    </td>
                </tr>
                <tr>
                	<td><label for="Month">Month:</label></td>
                    <td>
                    	<select name="Month">
                        	<?php
							
								for($n=1; $n<=12; $n++)
								{
									echo "<option value='$n'";
										if(isset($_GET["type"]))
										{
											if($_GET["type"]=="addPayment")
											{
												if($n==$_GET["m"]) echo "selected='selected'";
											}
											else if($n==$month) echo "selected='selected'";
										}
										else if($n==$month)
										{
											echo "selected='selected'";
										}
									echo ">" . $months[$n-1] . "</option>\n";
								}
								
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                	<td><label for="Year">Year:</label></td>
                    <td>
                    	<select name="Year">
                           	<?php
							
								$startYear=$year-10;
								$endYear=$year+10;
								
								for($n=$startYear; $n<=$endYear; $n++)
								{
									echo "<option value='$n'";
										if(isset($_GET["type"]))
										{
											if($_GET["type"]=="addPayment")
											{
												if($n==$_GET["y"]) echo "selected='selected'";
											}
											else if($n==$year) echo "selected='selected'";
										}
										else if($n==$year)
										{
											echo "selected='selected'";
										}
									echo ">" . $n . "</option>\n";
								}
							
							?>                        
                        </select>
                    </td>
                </tr>
                <tr>
                	<td><label>Amount (£):</label></td>
                    <td width="350px">
                    	<input type="text" name="AmountPound" size="1" 
                        	<?php
								if(isset($_GET["type"]))
								{
									if($_GET["type"]=="addPayment" && !empty($_GET["AmountPound"]))
									{
										echo "value=" . $_GET["AmountPound"];
									}
									else echo "value='0'";
								}
								else echo "value='0'";
							?>
                         />.
                         <input type="text" name="AmountPence" size="1" 
                        	<?php
								if(isset($_GET["type"]))
								{
									if($_GET["type"]=="addPayment" && !empty($_GET["AmountPence"]))
									{
										echo "value=" . $_GET["AmountPence"];
									}
									else echo "value='00'";
								}
								else echo "value='00'";
							?>
                         />
                    </td>
                </tr>
                <tr>
                	<td><label for="Type">Type:</label>
                    <td>
                    	<select name="Type">
                        	<option value="1"
                            	<?php
									if(isset($_GET["type"]))
									{
										if($_GET["type"]=="addPayment")
										{
											if($_GET["Type"]==1) echo "selected='selected'";
										}
									}
								?>
                            >Received</option>
                            <option value="2"
                            	<?php
									if(isset($_GET["type"]))
									{
										if($_GET["type"]=="addPayment")
										{
											if($_GET["Type"]==2) echo "selected='selected'";
										}
									}
								?>
                            >Spent</option>
                        </select>
                    </td>
                </tr>
                <tr>
                	<td><label for="Category">Category:</label></td>
                    <td>
                    	<select name="Category">
                        	<?php
							
								$queryPaymentCategories="SELECT * FROM paymentcategories ORDER BY Name ASC";
								$sendPaymentCategories=mysqli_query($dbconnect,$queryPaymentCategories) or die("Could not get payment categories from database.");
								
								while($results=mysqli_fetch_assoc($sendPaymentCategories))
								{
									echo "<option value='$results[PaymentCategoryID]'";
										if(isset($_GET["type"]))
										{
											if($_GET["type"]=="addPayment")
											{
												if($_GET["Category"]==$results["PaymentCategoryID"])
												{
													echo "selected='selected'";
												}
											}
										}
									echo ">";
										echo $results["Name"];
									echo "</option>\n";
								}
							
							?>
                        </select>
                    </td>
                </tr>
                <tr>
                	<td></td>
                    <td><input type="submit" /></td>
                </tr>
                </table>
                </form>
                
                <hr />
                
                <form action="adds/addpaymentcategory.php" method="post">
                <input type="hidden" name="savedDay" value="<?php echo $day ?>" />
                <input type="hidden" name="savedMonth" value="<?php echo $month ?>" />
                <input type="hidden" name="savedYear" value="<?php echo $year ?>" />
                <h2>Add Payment Category</h2>
                <table>
                <tr style="width:250px;">
                	<td><label for="Name">Name:</label></td>
                    <td>
                    <input type="text" name="Name" 
                    	<?php
							if(isset($_GET["type"]))
							{
								if($_GET["type"]=="addPaymentCategory" && !empty($_GET["Name"]))
								{
									echo "value=" . $_GET["Name"];
								}
							}
						?>
                    />
                    </td>
                </tr>
                <tr>
                	<td></td>
                    <td><input type="submit" /></td>
                </tr>
                </table>
                </form>
            </div>
            
            <?php 
				if(isset($_GET["type"]))
				{
					if($_GET["type"]=="addPayment" || $_GET["type"]=="addPaymentCategory")
					{
						?>
                        
                        <script type="text/javascript">
							var addPayment=document.getElementById("addPayment");
							$(addPayment).slideDown(2500);
							startTime();
						</script>
                        
                        <?php
					}
				}
			?>
            
            <div id="addWorkDone">
            	<form action="adds/addworkdone.php" method="post">
                <input type="hidden" name="savedDay" value="<?php echo $day ?>" />
                <input type="hidden" name="savedMonth" value="<?php echo $month ?>" />
                <input type="hidden" name="savedYear" value="<?php echo $year ?>" />
                <h2>Add Work Done</h2>
                <table>
                <tr>
                	<td><label for="Day">Day:</label></td>
                    <td>
                    	<select name="Day">
                        	<?php
							
								for($n=1; $n<=31; $n++)
								{
									echo "<option value='$n'";
									if(isset($_GET["type"]))
									{
										if($_GET["type"]=="addWorkDone")
										{
											if($_GET["d"]=="$n") echo "selected='selected'";
										}
										else if($n==$day) echo "selected='selected'";
									}
									else if($n==$day) echo "selected='selected'";
									echo ">$n</option>\n";
								}
								
							?>
                        </select>
                    </td>
                </tr>
                <tr>
                	<td><label for="Month">Month:</label></td>
                    <td>
                    	<select name="Month">
                        	<?php
							
								for($n=1; $n<=12; $n++)
								{
									echo "<option value='$n'";
									if(isset($_GET["type"]))
									{
										if($_GET["type"]=="addWorkDone")
										{
											if($_GET["m"]=="$n")
											{
												echo "selected='selected'";
											}
										}
										else if($n==$month) echo "selected='selected'";
									}
									else if($n==$month) echo "selected='selected'";
									echo ">" .  $months[$n-1] . "</option>\n";
								}
								
							?>
                        </select>
                    </td>
                </tr>
                <tr>
                	<td><label for="Year">Year:</label></td>
                    <td>
                    	<select name="Year">
                           	<?php
							
								$startYear=$year-10;
								$endYear=$year+10;
								
								for($n=$startYear; $n<=$endYear; $n++)
								{
									echo "<option value='$n'";
										if(isset($_GET["type"]))
										{
											if($_GET["type"]=="addWorkDone")
											{
												if($_GET["y"]=="$n")
												{
													echo "selected='selected'";
												}
											}
											else if($n==$year)
											{
												echo "selected='selected'";
											}
										}
										else if($n==$year)
										{
											echo "selected='selected'";
										}
									echo ">" . $n . "</option>\n";
								}
							
							?>                        
                        </select>
                    </td>
                </tr>
                <tr>
                	<td><label for="Company">Company:</label></td>
                    <td>
                    	<select name="Company">
                        	<?php
							
								$searchCompany="SELECT * FROM company ORDER BY CompanyName ASC";
								$queryCompany=mysqli_query($dbconnect,$searchCompany) or die("Could not get company names from database.");
								
								while($resultCompany=mysqli_fetch_assoc($queryCompany))
								{
									echo "<option value='$resultCompany[CompanyID]'";
										if(isset($_GET["CompanyID"]))
										{
											if($_GET["CompanyID"]==$resultCompany["CompanyID"])
											{
												echo "selected='selected'";
											}
										}
									echo ">";
										echo $resultCompany["CompanyName"];										
									echo "</option>\n";
								}
								
							?>
                        </select>
                    </td>
                </tr>
                <tr>
                	<td><label>Normal</label></td>
                	<td><label for="Hours">Hours:</label>
                    	<select name="Hours">
                        	<?php
							
								for($n=0; $n<=14; $n++)
								{
									echo "<option value='$n'";
										if(isset($_GET["type"]))
										{
											if($_GET["type"]=="addWorkDone")
											{
												if($_GET["Hours"]==$n)
												{
													echo "selected='selected'";
												}
											}
										}
									echo ">$n</option>\n";
								}
							
							?>
                        </select>
                    <label for="Minutes">Mins:</label>
                    	<select name="Minutes">
                        	<option value="0"
                            	<?php
									if(isset($_GET["type"]))
									{
										if($_GET["type"]=="addWorkDone")
										{
											if($_GET["Minutes"]==0)
											{
												echo "selected='selected'";
											}
										}
									}
								?>
                            >0</option>
                            <option value="15"
                            	<?php
									if(isset($_GET["type"]))
									{
										if($_GET["type"]=="addWorkDone")
										{
											if($_GET["Minutes"]==15)
											{
												echo "selected='selected'";
											}
										}
									}
								?>
                            >15</option>
                            <option value="30"
                            	<?php
									if(isset($_GET["type"]))
									{
										if($_GET["type"]=="addWorkDone")
										{
											if($_GET["Minutes"]==30)
											{
												echo "selected='selected'";
											}
										}
									}
								?>
                            >30</option>
                            <option value="45"
                            	<?php
									if(isset($_GET["type"]))
									{
										if($_GET["type"]=="addWorkDone")
										{
											if($_GET["Minutes"]==45)
											{
												echo "selected='selected'";
											}
										}
									}
								?>
                            >45</option>
                        </select>
                    </td>
                </tr>
                <tr>
                	<td><label>Wage:</label></td>
                    <td>
                    	£<input type="text" name="WagePound" size="1" 
                        	<?php
								if(isset($_GET["WagePound"]))
								{
									if(!empty($_GET["WagePound"]))
									{
										echo " value=" . $_GET["WagePound"];
									}
									else echo " value='0'";
								}
								else echo " value='0'";
							?>
                        />.<input type="text" name="WagePence" size="1" 
                        	<?php
								if(isset($_GET["WagePence"]))
								{
									if(!empty($_GET["WagePence"]))
									{
										echo " value=" . $_GET["WagePence"];
									}
									else echo " value='00'";
								}
								else echo " value='00'";
							?>
                        />
                    </td>
                </tr>
                <tr>
                	<td><label>Overtime</label></td>
                	<td><label for="OvertimeHours">Hours:</label>
                    	<select name="OvertimeHours">
                        	<?php
							
								for($n=0; $n<=14; $n++)
								{
									echo "<option value='$n'";
										if(isset($_GET["OvertimeHours"]))
										{
											if($_GET["OvertimeHours"]=="$n")
											{
												echo "selected='selected'";
											}
										}
									echo ">$n</option>\n";
								}
							
							?>
                        </select>
                    <label for="OvertimeMinutes">Mins:</label>
                    	<select name="OvertimeMinutes">
                        	<option value="0"
                            	<?php
									if(isset($_GET["OvertimeMinutes"]))
									{
										if($_GET["OvertimeMinutes"]=="0")
										{
											echo "selected='selected'";
										}
									}
								?>
                            >0</option>
                            <option value="15"
                            	<?php
									if(isset($_GET["OvertimeMinutes"]))
									{
										if($_GET["OvertimeMinutes"]=="15")
										{
											echo "selected='selected'";
										}
									}
								?>
                            >15</option>
                            <option value="30"
                            	<?php
									if(isset($_GET["OvertimeMinutes"]))
									{
										if($_GET["OvertimeMinutes"]=="30")
										{
											echo "selected='selected'";
										}
									}
								?>
                            >30</option>
                            <option value="45"
                            	<?php
									if(isset($_GET["OvertimeMinutes"]))
									{
										if($_GET["OvertimeMinutes"]=="45")
										{
											echo "selected='selected'";
										}
									}
								?>
                            >45</option>
                        </select>
                    </td>
                </tr>
                <tr>
                	<td><label>Overtime Wage:</label></td>
                    <td>
                    	£<input type="text" name="OvertimeWagePound" size="1" 
                        	<?php
								if(isset($_GET["OvertimeWagePound"]))
								{
									if(!empty($_GET["OvertimeWagePound"]))
									{
										echo " value=" . $_GET["OvertimeWagePound"];
									}
									else echo " value='0'";
								}
								else echo " value='0'";
							?>
                        />.<input type="text" name="OvertimeWagePence" size="1" 
                        	<?php
								if(isset($_GET["OvertimeWagePence"]))
								{
									if(!empty($_GET["OvertimeWagePence"]))
									{
										echo " value=" . $_GET["OvertimeWagePence"];
									}
									else echo " value='00'";
								}
								else echo " value='00'";
							?>
                        />
                    </td>
                </tr>
                <tr>
                	<td></td>
                    <td><input type="submit" /></td>
                </tr>
                </table>
                </form>
                
                <hr />
                
                <form action="adds/addcompany.php" method="post">
                <input type="hidden" name="savedDay" value="<?php echo $day ?>" />
                <input type="hidden" name="savedMonth" value="<?php echo $month ?>" />
                <input type="hidden" name="savedYear" value="<?php echo $year ?>" />
                <h2>Add Company</h2>
                <table>
                <tr>
                	<td><label for="Name">Name:</label></td>
                    <td>
                    	<input type="text" name="Name"
                        	<?php
								if(isset($_GET["type"]))
								{
									if($_GET["type"]=="addCompany" && !empty($_GET["Name"]))
									{
										echo "value=" . $_GET["Name"];
									}
								}
							?>
                        />
                    </td>
                </tr>
                <tr>
                	<td></td>
                    <td><input type="submit" /></td>
                </tr>
                </table>
                </form>
       		</div>
            
            <?php 
				if(isset($_GET["type"]))
				{
					if($_GET["type"]=="addCompany" || $_GET["type"]=="addWorkDone")
					{
						?>
                        
                        <script type="text/javascript">
							var addWorkDone=document.getElementById("addWorkDone");
							$(addWorkDone).slideDown(2500);
							startTime();
						</script>
                        
                        <?php
					}
					
					
				}
			?>
            
            <div id="addHoursTarget">
            	<form action="adds/addhourstarget.php" method="post">
                <input type="hidden" name="savedDay" value="<?php echo $day ?>" />
                <input type="hidden" name="savedMonth" value="<?php echo $month ?>" />
                <input type="hidden" name="savedYear" value="<?php echo $year ?>" />
                <h2>Add Hours Target</h2>
                <table>
                <tr>
                	<td><label>Target</label></td>
                    <td>
                    	<label for="Hours">Hours:</label>
                        <select name="Hours">
                        <?php
							for($n=5; $n<=250; $n++)
							{
								echo "<option value='$n'";
									if(isset($_GET["HoursTarget"]))
									{
										if($_GET["HoursTarget"]==$n)
										{
											echo "selected='selected'";
										}
									}
								echo ">$n</option>\n";
							}
						?>
                        </select>
                        
                        <label for="Minutes">Mins:</label>
                        <select name="Minutes">
							<option value="0"
                            	<?php
									if(isset($_GET["MinutesTarget"]))
									{
										if($_GET["MinutesTarget"]==0)
										{
											echo "selected='selected'";
										}
									}
								?>
                            >0</option>
                            <option value="15"
                            	<?php
									if(isset($_GET["MinutesTarget"]))
									{
										if($_GET["MinutesTarget"]==15)
										{
											echo "selected='selected'";
										}
									}
								?>
                            >15</option>
                            <option value="30"
                            	<?php
									if(isset($_GET["MinutesTarget"]))
									{
										if($_GET["MinutesTarget"]==30)
										{
											echo "selected='selected'";
										}
									}
								?>
                            >30</option>
                            <option value="45"
                            	<?php
									if(isset($_GET["MinutesTarget"]))
									{
										if($_GET["MinutesTarget"]==45)
										{
											echo "selected='selected'";
										}
									}
								?>
                            >45</option>
                        </select>
                    </td>
                </tr>
                <tr>
                	<td><label for="Month">Month:</label></td>
                    <td>
                    	<select name="Month">
                        	<?php
							
								for($n=1; $n<=12; $n++)
								{
									echo "<option value='$n'";
									if(isset($_GET["type"]))
									{
										if($_GET["type"]=="addHoursTarget")
										{
											if($_GET["m"]==$n)
											{
												echo "selected='selected'";
											}
										}
										else if($n==$month)
										{
											echo "selected='selected'";
										}
									}
									else if($n==$month)
									{
										echo "selected='selected'";
									}
									echo ">" . $months[$n-1] . "</option>\n";
								}
								
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                	<td><label for="Year">Year:</label></td>
                    <td>
                    	<select name="Year">
                           	<?php
							
								$startYear=$year-10;
								$endYear=$year+10;
								
								for($n=$startYear; $n<=$endYear; $n++)
								{
									echo "<option value='$n'";
										if(isset($_GET["type"]))
										{
											if($_GET["type"]=="addHoursTarget")
											{
												if($_GET["y"]==$n)
												{
													echo "selected='selected'";
												}
											}
											else if($n==$year)
											{
												echo "selected='selected'";
											}
										}
										else if($n==$year)
										{
											echo "selected='selected'";
										}
									echo ">" . $n . "</option>\n";
								}
							
							?>                        
                        </select>
                    </td>
                </tr>
                <tr>
                	<td></td>
                    <td><input type="submit" /></td>
                </tr>
                </table>
         		</form>
         	</div>
            
            <?php 
				if(isset($_GET["type"]))
				{
					if($_GET["type"]=="addHoursTarget")
					{
						?>
                        
                        <script type="text/javascript">
							var addHoursTarget=document.getElementById("addHoursTarget");
							$(addHoursTarget).slideDown(2500);
							startTime();
						</script>
                        
                        <?php
					}
				}
			?>
            
            <div id="addWageTarget">
            	<form action="adds/addwagetarget.php" method="post">
                <input type="hidden" name="savedDay" value="<?php echo $day ?>" />
                <input type="hidden" name="savedMonth" value="<?php echo $month ?>" />
                <input type="hidden" name="savedYear" value="<?php echo $year ?>" />
                <h2>Add Wage Target</h2>
                <table>
                <tr>
                	<td><label>Wage Target:</label></td>
                    <td>
                    	£<input type="text" name="TargetPound" size="1"
                        	<?php
								if(isset($_GET["TargetPound"]))
								{
									if(!empty($_GET["TargetPound"]))
									{
										echo "value=" . $_GET["TargetPound"];
									}
									else echo "value='0'";
								}
								else echo "value='0'";
							?>
                        />.<input type="text" name="TargetPence" size="1"
                        	<?php
								if(isset($_GET["TargetPence"]))
								{
									if(!empty($_GET["TargetPence"]))
									{
										echo "value=" . $_GET["TargetPence"];
									}
									else echo "value='00'";
								}
								else echo "value='00'";
							?>
                        />
                    </td>
                </tr>
                <tr>
                	<td><label for="Month">Month:</label></td>
                    <td>
                    	<select name="Month">
                        	<?php
							
								for($n=1; $n<=12; $n++)
								{
									echo "<option value='$n'";
										if(isset($_GET["type"]))
										{
											if($_GET["type"]=="addWageTarget")
											{
												if($_GET["m"]=="$n") echo "selected='selected'";
											}
											else if($n==$month)
											{
												echo "selected='selected'";
											}
										}
										else if($n==$month)
										{
											echo "selected='selected'";
										}
									echo ">" . $months[$n-1] . "</option>\n";
								}
								
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                	<td><label for="Year">Year:</label></td>
                    <td>
                    	<select name="Year">
                           	<?php
							
								$startYear=$year-10;
								$endYear=$year+10;
								
								for($n=$startYear; $n<=$endYear; $n++)
								{
									echo "<option value='$n'";
										if(isset($_GET["type"]))
										{
											if($_GET["type"]=="addWageTarget")
											{
												if($_GET["y"]=="$n")
												{
													echo "selected='selected'";
												}
											}
											else if($n==$year)
											{
												echo "selected='selected'";
											}
										}
										else if($n==$year)
										{
											echo "selected='selected'";
										}
									echo ">" . $n . "</option>\n";
								}
							
							?>                        
                        </select>
                    </td>
                </tr>
                <tr>
                	<td></td>
                    <td><input type="submit" /></td>
                </tr>
                </table>
                </form>
         	</div>
            
            <?php 
				if(isset($_GET["type"]))
				{
					if($_GET["type"]=="addWageTarget")
					{
						?>
                        
                        <script type="text/javascript">
							var addWageTarget=document.getElementById("addWageTarget");
							$(addWageTarget).slideDown(2500);
							startTime();
						</script>
                        
                        <?php
					}
				}
			?>
            
        </div>
        
        <div id="right">
        
        	<div id="birthdays">
            	<?php
				
					$findBirthDays="SELECT * FROM birthdays WHERE Day='$day' AND Month='$month' ORDER BY Day ASC";
					$queryBirthDays=mysqli_query($dbconnect,$findBirthDays) or die("Could not get birthdays from database!");
					
					$setBD=0;
					while($resultBirthDays=mysqli_fetch_assoc($queryBirthDays))
					{
						if($setBD<1) echo "<h3>Birthdays Today:</h3><br />\n";
						
						showBirthdayDay();
						
						$setBD++;
					}
				
				?>
                
                <form method="post" action="edits/editbirthday.php">
                <input type="hidden" name="savedDay" value="<?php echo $day ?>" />
                <input type="hidden" name="savedMonth" value="<?php echo $month ?>" />
                <input type="hidden" name="savedYear" value="<?php echo $year ?>" />
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
            
            <div id="reminders">
            	<?php
				
					$findReminders="SELECT * FROM reminders";
					$queryReminders=mysqli_query($dbconnect,$findReminders) or die("Could not get reminders from the database!");
					
					$setRM=0;
					
					while($resultReminders=mysqli_fetch_assoc($queryReminders))
					{
						if($resultReminders["Occurrence"]==1 && $resultReminders["Day"]==$day && $resultReminders["Month"]==$month && $resultReminders["Year"]==$year)
						{
							doSetRM();
							showReminderDay();
						}
						else if($resultReminders["Occurrence"]==2 && $resultReminders["Year"]<=$year && $resultReminders["Day"]==$day && $resultReminders["Month"]==$month)
						{
							if($resultReminders["Times"]==(-1))
							{
								doSetRMDay();
								showReminderDay();
							}
							else 
							{
								if(($resultReminders["Year"]+$resultReminders["Times"])>$year)
								{
									doSetRMDay();
									showReminderDay();
								}
							}
						}
						else if($resultReminders["Occurrence"]==3 && $resultReminders["Day"]==$day)
						{
							if($resultReminders["Times"]==(-1))
							{
								if($year>$resultReminders["Year"])
								{
									doSetRMDay();
									showReminderDay();
								}
								else if($year==$resultReminders["Year"] && $month>=$resultReminders["Month"])
								{
									doSetRMDay();
									showReminderDay();
								}
							}
							else
							{
								if($resultReminders["Year"]==$year && $resultReminders["Month"]<=$month && $day==$resultReminders["Day"])
								{
									if(($month-$resultReminders["Month"])<$resultReminders["Times"])
									{
										doSetRMDay();
										showReminderDay();
									}
								}
								else if($resultReminders["Year"]<$year && $day==$resultReminders["Day"])
								{
									$monthDiff=($month-$resultReminders["Month"]);
									$yearDiff=($year-$resultReminders["Year"]);
									$diff=(($yearDiff*12)+$monthDiff);
									
									if($diff<$resultReminders["Times"])
									{
										doSetRMDay();
										showReminderDay();
									}
								}
							}
						}
						else if($resultReminders["Occurrence"]==4)
						{
							if($resultReminders["Times"]==(-1))
							{
								if($resultReminders["Year"]==$year)
								{
									if($resultReminders["Month"]==$month)
									{
										$daysDiff = calculateDaysDiff($year, $month, $day, $resultReminders["Year"], $resultReminders["Month"], $resultReminders["Day"]);
										
										if($daysDiff%7==0 && $day>=$resultReminders["Day"])
										{
											doSetRMDay();
											showReminderDay();
										}
									}
									else if($month>$resultReminders["Month"])
									{
										$daysDiff = calculateDaysDiff($year, $month, $day, $resultReminders["Year"], $resultReminders["Month"], $resultReminders["Day"]);
										
										if($daysDiff%7==0)
										{
											doSetRMDay();
											showReminderDay();
										}
									}
								}
								else if($year>$resultReminders["Year"])
								{
									$daysDiff = calculateDaysDiff($year, $month, $day, $resultReminders["Year"], $resultReminders["Month"], $resultReminders["Day"]);
										
									if($daysDiff%7==0)
									{
										doSetRMDay();
										showReminderDay();
									}
								}
							}
							else
							{
								if($year==$resultReminders["Year"])
								{
									if($month==$resultReminders["Month"])
									{
										$daysDiff = calculateDaysDiff($year, $month, $day, $resultReminders["Year"], $resultReminders["Month"], $resultReminders["Day"]);
										$numOfWeeks=floor($daysDiff/7);
										if($daysDiff%7==0 && $day>=$resultReminders["Day"])
										{
											if($numOfWeeks<$resultReminders["Times"])
											{
												doSetRMDay();
												showReminderDay();
											}
										}
									}
									else if($month>$resultReminders["Month"])
									{
										$daysDiff = calculateDaysDiff($year, $month, $day, $resultReminders["Year"], $resultReminders["Month"], $resultReminders["Day"]);
										$numOfWeeks=floor($daysDiff/7);
										if($daysDiff%7==0)
										{
											if($numOfWeeks<$resultReminders["Times"])
											{
												doSetRMDay();
												showReminderDay();
											}
										}
									}
								}
								else if($year>$resultReminders["Year"])
								{
									$daysDiff = calculateDaysDiff($year, $month, $day, $resultReminders["Year"], $resultReminders["Month"], $resultReminders["Day"]);
									$numOfWeeks=floor($daysDiff/7);
									if($daysDiff%7==0)
									{
										if($numOfWeeks<$resultReminders["Times"])
										{
											doSetRMDay();
											showReminderDay();
										}
									}
								}
							}
						}
						else if($resultReminders["Occurrence"]==5)
						{
							if($resultReminders["Times"]==(-1))
							{
								if(($resultReminders["Year"]==$year && (($month==$resultReminders["Month"] && $day>=$resultReminders["Day"]) || $month>$resultReminders["Month"])) || ($year>$resultReminders["Year"]))
								{
									doSetRMDay();
									showReminderDay();
								}
							}
							else
							{
								if($year==$resultReminders["Year"])
								{
									if($month==$resultReminders["Month"])
									{
										if($day>=$resultReminders["Day"])
										{
											$daysDiff = calculateDaysDiff($year, $month, $day, $resultReminders["Year"], $resultReminders["Month"], $resultReminders["Day"]);
											
											if($daysDiff<$resultReminders["Times"])
											{
												doSetRMDay();
												showReminderDay();
											}
										}
									}
									else if($month>$resultReminders["Month"])
									{
										$daysDiff = calculateDaysDiff($year, $month, $day, $resultReminders["Year"], $resultReminders["Month"], $resultReminders["Day"]);
										if($daysDiff<$resultReminders["Times"])
										{
											doSetRMDay();
											showReminderDay();
										}
									}
								}
								else if($year>$resultReminders["Year"])
								{
									$daysDiff = calculateDaysDiff($year, $month, $day, $resultReminders["Year"], $resultReminders["Month"], $resultReminders["Day"]);
									if($daysDiff<$resultReminders["Times"])
									{
										doSetRMDay();
										showReminderDay();
									}
								}
							}
						}
					}
					
				?>
                
                <form method="post" action="edits/editreminder.php">
                <input type="hidden" name="savedDay" value="<?php echo $day ?>" />
                <input type="hidden" name="savedMonth" value="<?php echo $month ?>" />
                <input type="hidden" name="savedYear" value="<?php echo $year ?>" />
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
							
								$startYear=$year-10; $endYear=$year+10;
							
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
            
            <div id="payments">
            	<?php
				
					$findPayments="SELECT * FROM payments WHERE DAY='$day' AND Month='$month' AND Year='$year' ORDER BY Day ASC";
					$queryPayments=mysqli_query($dbconnect,$findPayments) or die("Could not get payments from the database!");
					
					$setPT=0;
					while($resultsPayments=mysqli_fetch_assoc($queryPayments))
					{
						if($setPT<1) echo "<h3>Payments Today:</h3><br />\n";
						
						$getCategories="SELECT * FROM paymentcategories WHERE PaymentCategoryID=$resultsPayments[Category]";
						$queryCategories=mysqli_query($dbconnect,$getCategories) or die("Could not get categories from database!");
						
						while($resultsCategories=mysqli_fetch_assoc($queryCategories))
						{
							showPaymentDay();
						}
						
						$setPT++;
					}
				?>
                
                <form method="post" action="edits/editpayment.php">
                <input type="hidden" name="savedDay" value="<?php echo $day ?>" />
                <input type="hidden" name="savedMonth" value="<?php echo $month ?>" />
                <input type="hidden" name="savedYear" value="<?php echo $year ?>" />
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
							
								$startYear=$year-10; $endYear=$year+10;
							
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
							showPaymentCategoriesDay();
						}
					
					?>
                </table>
                
                <table id="paymentsummary">
                <tr><th colspan="4">Payment Summary Today:</th></tr>
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
						
						$getPayments="SELECT * FROM payments WHERE Day=$day AND Month=$month AND Year=$year ORDER BY Category ASC";
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
                
                <br />
            </div>
            
            <div id="workDone">
            	<?php
				
					$findWorkDone="SELECT * FROM workdone WHERE Day='$day' AND Month='$month' AND Year='$year' ORDER BY Day ASC";
					$queryWorkDone=mysqli_query($dbconnect,$findWorkDone) or die("Could not get work done from database.");
					
					$setWD=0;
					while($resultWorkDone=mysqli_fetch_assoc($queryWorkDone))
					{
						if($setWD<1) echo "<h3>Work Done Today:</h3><br />\n";
						
						$getCompanies="SELECT * FROM company WHERE CompanyID=$resultWorkDone[CompanyID]";
						$queryCompanies=mysqli_query($dbconnect,$getCompanies) or die("Could not get companies from database!");
						
						while($resultsCompanies=mysqli_fetch_assoc($queryCompanies))
						{
							showWorkDoneDay();
						}
						
						$setWD++;
					}
				
				?>
                
                <form method="post" action="edits/editworkdone.php">
                <input type="hidden" name="savedDay" value="<?php echo $day ?>" />
                <input type="hidden" name="savedMonth" value="<?php echo $month ?>" />
                <input type="hidden" name="savedYear" value="<?php echo $year ?>" />
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
							
								$startYear=$year-10; $endYear=$year+10;
							
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
							showCompaniesDay();
						}
					
					?>
                </table>
                
                <table id="companysummary">
                <tr><th colspan="8">Work Done Summary Today:</th></tr>
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
					
						$getWorkDone="SELECT * FROM workdone WHERE Day='$day' AND Month='$month' AND Year='$year' ORDER BY CompanyID ASC";
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
                
                <br />
            </div>
            
        </div>
    
    </div>
    
</body>
</html>