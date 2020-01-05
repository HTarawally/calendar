<?php
	date_default_timezone_set("Europe/London");

	$fullDays = Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
	$dayLetters = Array("Su","Mo","Tu","We","Th","Fr","Sa");
	$months = Array("January","February","March","April","May","June","July","August","September","October","November","December");
	
	$todayYear=date("Y");
	$todayMonth=date("n");
	$todayDay=date("j");
	
	function isLeapYear($year)
	{
		if(($year%400)==0)
		{
			return 1;
		}
		else if(($year%4)==0 && ($year%100)!=0)
		{
			return 1;
		}
		else return 0;
	}
	
	function calculateDay($day, $month, $year)
	{
		$d=$day;
		$m=(($month+9)%12)+1;
		
		switch($month)
		{
			case 1:
				$Y=($year-1);
				break;
			case 2:
				$Y=($year-1);
				break;
			default:
				$Y=$year;
		}
		
		$c=substr($Y,-4,2);
		$y=substr($Y,2);
		
		$w=($d + floor((2.6*$m) -0.2) + $y + floor($y/4) + floor($c/4) - (2*$c)) % 7;
		
		if($w<0) $w+=7;

		return $w;
	}
	
	function printDate($month, $year)
	{	
		$w=calculateDay(1, $month, $year);
		
		switch($month)
		{
			case 1:
				january($w);
				break;
			case 2:
				february($w);
				break;
			case 3:
				march($w);
				break;
			case 4:
				april($w);
				break;
			case 5:
				may($w);
				break;
			case 6:
				june($w);
				break;
			case 7:
				july($w);
				break;
			case 8:
				august($w);
				break;
			case 9:
				september($w);
				break;
			case 10:
				october($w);
				break;
			case 11:
				november($w);
				break;
			case 12:
				december($w);
				break;
			default:
				die("Could not populate calendar. Month number wrong.");
		}
	}
	
	function january($startDay)
	{
		global $year, $previousYear, $todayDay, $todayMonth, $todayYear;
		
		switch($startDay)
		{
			case 0:
				for($m=1; $m<32; $m++)
				{
					echo "<a href='day.php?day=$m&month=1&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==1) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:30px;  border:1px solid black; height:10px; font-size:0.8;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=11; $m++)
				{
					echo "<a href='day.php?day=$m&month=2&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 1:
				for($m=31; $m<=31; $m++)
				{
					echo "<a href='day.php?day=$m&month=12&year=$previousYear' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<32; $m++)
				{
					echo "<a href='day.php?day=$m&month=1&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==1) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=10; $m++)
				{
					echo "<a href='day.php?day=$m&month=2&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 2:
				for($m=30; $m<=31; $m++)
				{
					echo "<a href='day.php?day=$m&month=12&year=$previousYear' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<32; $m++)
				{
					echo "<a href='day.php?day=$m&month=1&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==1) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=9; $m++)
				{
					echo "<a href='day.php?day=$m&month=2&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 3:
				for($m=29; $m<=31; $m++)
				{
					echo "<a href='day.php?day=$m&month=12&year=$previousYear' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<32; $m++)
				{
					echo "<a href='day.php?day=$m&month=1&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==1) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=8; $m++)
				{
					echo "<a href='day.php?day=$m&month=2&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";			
				}
				break;
				
			case 4:
				for($m=28; $m<=31; $m++)
				{
					echo "<a href='day.php?day=$m&month=12&year=$previousYear' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<32; $m++)
				{
					echo "<a href='day.php?day=$m&month=1&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==1) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=8; $m++)
				{
					echo "<a href='day.php?day=$m&month=2&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";				
				}
				break;
				
			case 5:
				for($m=27; $m<=31; $m++)
				{
					echo "<a href='day.php?day=$m&month=12&year=$previousYear' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<32; $m++)
				{
					echo "<a href='day.php?day=$m&month=1&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==1) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=7; $m++)
				{
					echo "<a href='day.php?day=$m&month=2&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 6:
				for($m=26; $m<=31; $m++)
				{
					echo "<a href='day.php?day=$m&month=12&year=$previousYear' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<32; $m++)
				{
					echo "<a href='day.php?day=$m&month=1&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==1) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=6; $m++)
				{
					echo "<a href='day.php?day=$m&month=2&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";				
				}
				break;
				
			default:
				die("Could not populate calender. Day number is wrong.");
		}
	}
	
	function february($startDay)
	{
		global $leapYear, $year, $todayDay, $todayMonth, $todayYear;
		
		if($leapYear==1) $end=30;
		else $end=29;
		
		switch($startDay)
		{
			case 0:
				for($m=1; $m<$end; $m++)
				{
					echo "<a href='day.php?day=$m&month=2&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==2) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				
				if($leapYear==1)
				{
					for($m=1; $m<=13; $m++)
					{
						echo "<a href='day.php?day=$m&month=3&year=$year' id='letters2'>";
							echo $m;
						echo "</a>\n";
					}
				}
				else 
				{
					for($m=1; $m<=14; $m++)
					{
						echo "<a href='day.php?day=$m&month=3&year=$year' id='letters2'>";
							echo $m;
						echo "</a>\n";
					}
				}
				break;
				
			case 1:
				for($m=31; $m<=31; $m++)
				{
					echo "<a href='day.php?day=$m&month=1&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<$end; $m++)
				{
					echo "<a href='day.php?day=$m&month=2&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==2) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				
				if($leapYear==1)
				{
					for($m=1; $m<=12; $m++)
					{
						echo "<a href='day.php?day=$m&month=3&year=$year' id='letters2'>";
							echo $m;
						echo "</a>\n";
					}
				}
				else 
				{
					for($m=1; $m<=13; $m++)
					{
						echo "<a href='day.php?day=$m&month=3&year=$year' id='letters2'>";
							echo $m;
						echo "</a>\n";
					}
				}
				break;
				
			case 2:
				for($m=30; $m<=31; $m++)
				{
					echo "<a href='day.php?day=$m&month=1&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<$end; $m++)
				{
					echo "<a href='day.php?day=$m&month=2&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==2) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				
				if($leapYear==1)
				{
					for($m=1; $m<=11; $m++)
					{
						echo "<a href='day.php?day=$m&month=3&year=$year' id='letters2'>";
							echo $m;
						echo "</a>\n";
					}
				}
				else 
				{
					for($m=1; $m<=12; $m++)
					{
						echo "<a href='day.php?day=$m&month=3&year=$year' id='letters2'>";
							echo $m;
						echo "</a>\n";
					}
				}
				break;
				
			case 3:
				for($m=29; $m<=31; $m++)
				{
					echo "<a href='day.php?day=$m&month=1&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<$end; $m++)
				{
					echo "<a href='day.php?day=$m&month=2&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==2) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				
				if($leapYear==1)
				{
					for($m=1; $m<=10; $m++)
					{
						echo "<a href='day.php?day=$m&month=3&year=$year' id='letters2'>";
							echo $m;
						echo "</a>\n";
					}
				}
				else 
				{
					for($m=1; $m<=11; $m++)
					{
						echo "<a href='day.php?day=$m&month=3&year=$year' id='letters2'>";
							echo $m;
						echo "</a>\n";
					}
				}
				break;
				
			case 4:
				for($m=28; $m<=31; $m++)
				{
					echo "<a href='day.php?day=$m&month=1&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<$end; $m++)
				{
					echo "<a href='day.php?day=$m&month=2&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==2) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				
				if($leapYear==1)
				{
					for($m=1; $m<=9; $m++)
					{
						echo "<a href='day.php?day=$m&month=3&year=$year' id='letters2'>";
							echo $m;
						echo "</a>\n";
					}
				}
				else 
				{
					for($m=1; $m<=10; $m++)
					{
						echo "<a href='day.php?day=$m&month=3&year=$year' id='letters2'>";
							echo $m;
						echo "</a>\n";
					}
				}
				break;
				
			case 5:
				for($m=27; $m<=31; $m++)
				{
					echo "<a href='day.php?day=$m&month=1&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<$end; $m++)
				{
					echo "<a href='day.php?day=$m&month=2&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==2) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				
				if($leapYear==1)
				{
					for($m=1; $m<=8; $m++)
					{
						echo "<a href='day.php?day=$m&month=3&year=$year' id='letters2'>";
							echo $m;
						echo "</a>\n";
					}
				}
				else 
				{
					for($m=1; $m<=9; $m++)
					{
						echo "<a href='day.php?day=$m&month=3&year=$year' id='letters2'>";
							echo $m;
						echo "</a>\n";
					}
				}
				break;
				
			case 6:
				for($m=26; $m<=31; $m++)
				{
					echo "<a href='day.php?day=$m&month=1&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<$end; $m++)
				{
					echo "<a href='day.php?day=$m&month=2&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==2) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				
				if($leapYear==1)
				{
					for($m=1; $m<=7; $m++)
					{
						echo "<a href='day.php?day=$m&month=3&year=$year' id='letters2'>";
							echo $m;
						echo "</a>\n";
					}
				}
				else 
				{
					for($m=1; $m<=8; $m++)
					{
						echo "<a href='day.php?day=$m&month=3&year=$year' id='letters2'>";
							echo $m;
						echo "</a>\n";
					}
				}
				break;
				
			default:
				die("Could not populate calender. Day number is wrong.");
		}
	}
	
	function march($startDay)
	{
		global $leapYear, $year, $todayDay, $todayMonth, $todayYear;
		
		if($leapYear==1) $end=30;
		else $end=29;
		
		switch($startDay)
		{
			case 0:
				for($m=1; $m<32; $m++)
				{
					echo "<a href='day.php?day=$m&month=3&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==3) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=11; $m++)
				{
					echo "<a href='day.php?day=$m&month=4&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 1:
				if($leapYear==1)
				{
					for($m=29; $m<$end; $m++)
					{
						echo "<a href='day.php?day=$m&month=2&year=$year' id='letters2'>";
							echo $m;
						echo "</a>\n";
					}
				}
				else
				{
					for($m=28; $m<$end; $m++)
					{
						echo "<a href='day.php?day=$m&month=2&year=$year' id='letters2'>";
							echo $m;
						echo "</a>\n";
					}
				}
				
				for($m=1; $m<32; $m++)
				{
					echo "<a href='day.php?day=$m&month=3&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==3) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=11; $m++)
				{
					echo "<a href='day.php?day=$m&month=4&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 2:
				if($leapYear==1)
				{
					for($m=28; $m<$end; $m++)
					{
						echo "<a href='day.php?day=$m&month=2&year=$year' id='letters2'>";
							echo $m;
						echo "</a>\n";
					}
				}
				else
				{
					for($m=27; $m<$end; $m++)
					{
						echo "<a href='day.php?day=$m&month=2&year=$year' id='letters2'>";
							echo $m;
						echo "</a>\n";
					}
				}
				
				for($m=1; $m<32; $m++)
				{
					echo "<a href='day.php?day=$m&month=3&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==3) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=10; $m++)
				{
					echo "<a href='day.php?day=$m&month=4&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 3:
				if($leapYear==1)
				{
					for($m=27; $m<$end; $m++)
					{
						echo "<a href='day.php?day=$m&month=2&year=$year' id='letters2'>";
							echo $m;
						echo "</a>\n";
					}
				}
				else
				{
					for($m=26; $m<$end; $m++)
					{
						echo "<a href='day.php?day=$m&month=2&year=$year' id='letters2'>";
							echo $m;
						echo "</a>\n";
					}
				}
				
				for($m=1; $m<32; $m++)
				{
					echo "<a href='day.php?day=$m&month=3&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==3) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=9; $m++)
				{
					echo "<a href='day.php?day=$m&month=4&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 4:
				if($leapYear==1)
				{
					for($m=26; $m<$end; $m++)
					{
						echo "<a href='day.php?day=$m&month=2&year=$year' id='letters2'>";
							echo $m;
						echo "</a>\n";
					}
				}
				else
				{
					for($m=25; $m<$end; $m++)
					{
						echo "<a href='day.php?day=$m&month=2&year=$year' id='letters2'>";
							echo $m;
						echo "</a>\n";
					}
				}
				
				for($m=1; $m<32; $m++)
				{
					echo "<a href='day.php?day=$m&month=3&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==3) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=8; $m++)
				{
					echo "<a href='day.php?day=$m&month=4&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 5:
				if($leapYear==1)
				{
					for($m=25; $m<$end; $m++)
					{
						echo "<a href='day.php?day=$m&month=2&year=$year' id='letters2'>";
							echo $m;
						echo "</a>\n";
					}
				}
				else
				{
					for($m=24; $m<$end; $m++)
					{
						echo "<a href='day.php?day=$m&month=2&year=$year' id='letters2'>";
							echo $m;
						echo "</a>\n";
					}
				}
				
				for($m=1; $m<32; $m++)
				{
					echo "<a href='day.php?day=$m&month=3&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==3) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=7; $m++)
				{
					echo "<a href='day.php?day=$m&month=4&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 6:
				if($leapYear==1)
				{
					for($m=24; $m<$end; $m++)
					{
						echo "<a href='day.php?day=$m&month=2&year=$year' id='letters2'>";
							echo $m;
						echo "</a>\n";
					}
				}
				else
				{
					for($m=23; $m<$end; $m++)
					{
						echo "<a href='day.php?day=$m&month=2&year=$year' id='letters2'>";
							echo $m;
						echo "</a>\n";
					}
				}
				
				for($m=1; $m<32; $m++)
				{
					echo "<a href='day.php?day=$m&month=3&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==3) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=6; $m++)
				{
					echo "<a href='day.php?day=$m&month=4&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
			
			default:
				die("Could not populate calender. Day number is wrong.");
		}
	}
	
	function april($startDay)
	{
		global $year, $todayDay, $todayMonth, $todayYear;
		
		switch($startDay)
		{
			case 0:
				for($m=1; $m<31; $m++)
				{
					echo "<a href='day.php?day=$m&month=4&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==4) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=12; $m++)
				{
					echo "<a href='day.php?day=$m&month=5&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 1:
				for($m=31; $m<=31; $m++)
				{
					echo "<a href='day.php?day=$m&month=3&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<31; $m++)
				{
					echo "<a href='day.php?day=$m&month=4&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==4) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=11; $m++)
				{
					echo "<a href='day.php?day=$m&month=5&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 2:
				for($m=30; $m<=31; $m++)
				{
					echo "<a href='day.php?day=$m&month=3&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<31; $m++)
				{
					echo "<a href='day.php?day=$m&month=4&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==4) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=10; $m++)
				{
					echo "<a href='day.php?day=$m&month=5&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
			
			case 3:
				for($m=29; $m<=31; $m++)
				{
					echo "<a href='day.php?day=$m&month=3&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<31; $m++)
				{
					echo "<a href='day.php?day=$m&month=4&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==4) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=9; $m++)
				{
					echo "<a href='day.php?day=$m&month=5&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 4:
				for($m=28; $m<=31; $m++)
				{
					echo "<a href='day.php?day=$m&month=3&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<31; $m++)
				{
					echo "<a href='day.php?day=$m&month=4&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==4) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=8; $m++)
				{
					echo "<a href='day.php?day=$m&month=5&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 5:
				for($m=27; $m<=31; $m++)
				{
					echo "<a href='day.php?day=$m&month=3&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<31; $m++)
				{
					echo "<a href='day.php?day=$m&month=4&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==4) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=7; $m++)
				{
					echo "<a href='day.php?day=$m&month=5&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 6:
				for($m=26; $m<=31; $m++)
				{
					echo "<a href='day.php?day=$m&month=3&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<31; $m++)
				{
					echo "<a href='day.php?day=$m&month=4&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==4) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=6; $m++)
				{
					echo "<a href='day.php?day=$m&month=5&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			default:
				die("Could not populate calender. Day number is wrong.");
		}
	}
	
	function may($startDay)
	{
		global $year, $todayDay, $todayMonth, $todayYear;
		
		switch($startDay)
		{
			case 0:
				for($m=1; $m<32; $m++)
				{
					echo "<a href='day.php?day=$m&month=5&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==5) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=11; $m++)
				{
					echo "<a href='day.php?day=$m&month=6&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 1:
				for($m=30; $m<=30; $m++)
				{
					echo "<a href='day.php?day=$m&month=4&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<32; $m++)
				{
					echo "<a href='day.php?day=$m&month=5&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==5) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=10; $m++)
				{
					echo "<a href='day.php?day=$m&month=6&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 2:
				for($m=29; $m<=30; $m++)
				{
					echo "<a href='day.php?day=$m&month=4&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<32; $m++)
				{
					echo "<a href='day.php?day=$m&month=5&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==5) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=9; $m++)
				{
					echo "<a href='day.php?day=$m&month=6&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 3:
				for($m=28; $m<=30; $m++)
				{
					echo "<a href='day.php?day=$m&month=4&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<32; $m++)
				{
					echo "<a href='day.php?day=$m&month=5&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==5) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=8; $m++)
				{
					echo "<a href='day.php?day=$m&month=6&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 4:
				for($m=27; $m<=30; $m++)
				{
					echo "<a href='day.php?day=$m&month=4&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<32; $m++)
				{
					echo "<a href='day.php?day=$m&month=5&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==5) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=7; $m++)
				{
					echo "<a href='day.php?day=$m&month=6&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 5:
				for($m=26; $m<=30; $m++)
				{
					echo "<a href='day.php?day=$m&month=4&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<32; $m++)
				{
					echo "<a href='day.php?day=$m&month=5&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==5) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=6; $m++)
				{
					echo "<a href='day.php?day=$m&month=6&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 6:
				for($m=25; $m<=30; $m++)
				{
					echo "<a href='day.php?day=$m&month=4&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<32; $m++)
				{
					echo "<a href='day.php?day=$m&month=5&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==5) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=5; $m++)
				{
					echo "<a href='day.php?day=$m&month=6&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			default:
				die("Could not populate calender. Day number is wrong.");
		}
	}
	
	function june($startDay)
	{
		global $year, $todayDay, $todayMonth, $todayYear;
		
		switch($startDay)
		{
			case 0:
				for($m=1; $m<31; $m++)
				{
					echo "<a href='day.php?day=$m&month=6&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==6) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=12; $m++)
				{
					echo "<a href='day.php?day=$m&month=7&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 1:
				for($m=31; $m<=31; $m++)
				{
					echo "<a href='day.php?day=$m&month=5&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<31; $m++)
				{
					echo "<a href='day.php?day=$m&month=6&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==6) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=11; $m++)
				{
					echo "<a href='day.php?day=$m&month=7&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 2:
				for($m=30; $m<=31; $m++)
				{
					echo "<a href='day.php?day=$m&month=5&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<31; $m++)
				{
					echo "<a href='day.php?day=$m&month=6&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==6) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=10; $m++)
				{
					echo "<a href='day.php?day=$m&month=7&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 3:
				for($m=29; $m<=31; $m++)
				{
					echo "<a href='day.php?day=$m&month=5&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<31; $m++)
				{
					echo "<a href='day.php?day=$m&month=6&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==6) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=9; $m++)
				{
					echo "<a href='day.php?day=$m&month=7&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 4:
				for($m=28; $m<=31; $m++)
				{
					echo "<a href='day.php?day=$m&month=5&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<31; $m++)
				{
					echo "<a href='day.php?day=$m&month=6&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==6) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=8; $m++)
				{
					echo "<a href='day.php?day=$m&month=7&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 5:
				for($m=27; $m<=31; $m++)
				{
					echo "<a href='day.php?day=$m&month=5&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<31; $m++)
				{
					echo "<a href='day.php?day=$m&month=6&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==6) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=7; $m++)
				{
					echo "<a href='day.php?day=$m&month=7&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 6:
				for($m=26; $m<=31; $m++)
				{
					echo "<a href='day.php?day=$m&month=5&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<31; $m++)
				{
					echo "<a href='day.php?day=$m&month=6&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==6) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=6; $m++)
				{
					echo "<a href='day.php?day=$m&month=7&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			default:
				die("Could not populate calender. Day number is wrong.");
		}
	}
	
	function july($startDay)
	{
		global $year, $todayDay, $todayMonth, $todayYear;
		
		switch($startDay)
		{
			case 0:
				for($m=1; $m<32; $m++)
				{
					echo "<a href='day.php?day=$m&month=7&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==7) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=11; $m++)
				{
					echo "<a href='day.php?day=$m&month=8&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
			
			case 1:
				for($m=30; $m<=30; $m++)
				{
					echo "<a href='day.php?day=$m&month=6&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<32; $m++)
				{
					echo "<a href='day.php?day=$m&month=7&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==7) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=10; $m++)
				{
					echo "<a href='day.php?day=$m&month=8&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 2:
				for($m=29; $m<=30; $m++)
				{
					echo "<a href='day.php?day=$m&month=6&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<32; $m++)
				{
					echo "<a href='day.php?day=$m&month=7&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==7) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=9; $m++)
				{
					echo "<a href='day.php?day=$m&month=8&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 3:
				for($m=28; $m<=30; $m++)
				{
					echo "<a href='day.php?day=$m&month=6&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<32; $m++)
				{
					echo "<a href='day.php?day=$m&month=7&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==7) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=8; $m++)
				{
					echo "<a href='day.php?day=$m&month=8&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 4:
				for($m=27; $m<=30; $m++)
				{
					echo "<a href='day.php?day=$m&month=6&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<32; $m++)
				{
					echo "<a href='day.php?day=$m&month=7&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==7) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=7; $m++)
				{
					echo "<a href='day.php?day=$m&month=8&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 5:
				for($m=26; $m<=30; $m++)
				{
					echo "<a href='day.php?day=$m&month=6&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<32; $m++)
				{
					echo "<a href='day.php?day=$m&month=7&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==7) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=6; $m++)
				{
					echo "<a href='day.php?day=$m&month=8&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 6:
				for($m=25; $m<=30; $m++)
				{
					echo "<a href='day.php?day=$m&month=6&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<32; $m++)
				{
					echo "<a href='day.php?day=$m&month=7&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==7) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=5; $m++)
				{
					echo "<a href='day.php?day=$m&month=8&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			default:
				die("Could not populate calender. Day number is wrong.");
		}
	}
	
	function august($startDay)
	{
		global $year, $todayDay, $todayMonth, $todayYear;
		
		switch($startDay)
		{
			case 0:
				for($m=1; $m<32; $m++)
				{
					echo "<a href='day.php?day=$m&month=8&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==8) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=11; $m++)
				{
					echo "<a href='day.php?day=$m&month=9&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 1:
				for($m=31; $m<=31; $m++)
				{
					echo "<a href='day.php?day=$m&month=7&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<32; $m++)
				{
					echo "<a href='day.php?day=$m&month=8&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==8) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=10; $m++)
				{
					echo "<a href='day.php?day=$m&month=9&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 2:
				for($m=30; $m<=31; $m++)
				{
					echo "<a href='day.php?day=$m&month=7&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<32; $m++)
				{
					echo "<a href='day.php?day=$m&month=8&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==8) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=9; $m++)
				{
					echo "<a href='day.php?day=$m&month=9&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 3:
				for($m=29; $m<=31; $m++)
				{
					echo "<a href='day.php?day=$m&month=7&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<32; $m++)
				{
					echo "<a href='day.php?day=$m&month=8&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==8) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=8; $m++)
				{
					echo "<a href='day.php?day=$m&month=9&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 4:
				for($m=28; $m<=31; $m++)
				{
					echo "<a href='day.php?day=$m&month=7&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<32; $m++)
				{
					echo "<a href='day.php?day=$m&month=8&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==8) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=7; $m++)
				{
					echo "<a href='day.php?day=$m&month=9&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 5:
				for($m=27; $m<=31; $m++)
				{
					echo "<a href='day.php?day=$m&month=7&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<32; $m++)
				{
					echo "<a href='day.php?day=$m&month=8&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==8) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=6; $m++)
				{
					echo "<a href='day.php?day=$m&month=9&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 6:
				for($m=26; $m<=31; $m++)
				{
					echo "<a href='day.php?day=$m&month=7&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<32; $m++)
				{
					echo "<a href='day.php?day=$m&month=8&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==8) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=5; $m++)
				{
					echo "<a href='day.php?day=$m&month=9&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			default:
				die("Could not populate calender. Day number is wrong.");
		}
	}
	
	function september($startDay)
	{
		global $year, $todayDay, $todayMonth, $todayYear;
		
		switch($startDay)
		{
			case 0:
				for($m=1; $m<31; $m++)
				{
					echo "<a href='day.php?day=$m&month=9&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==9) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=12; $m++)
				{
					echo "<a href='day.php?day=$m&month=10&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 1:
				for($m=31; $m<=31; $m++)
				{
					echo "<a href='day.php?day=$m&month=8&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<31; $m++)
				{
					echo "<a href='day.php?day=$m&month=9&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==9) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=11; $m++)
				{
					echo "<a href='day.php?day=$m&month=10&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 2:
				for($m=30; $m<=31; $m++)
				{
					echo "<a href='day.php?day=$m&month=8&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<31; $m++)
				{
					echo "<a href='day.php?day=$m&month=9&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==9) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=10; $m++)
				{
					echo "<a href='day.php?day=$m&month=10&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 3:
				for($m=29; $m<=31; $m++)
				{
					echo "<a href='day.php?day=$m&month=8&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<31; $m++)
				{
					echo "<a href='day.php?day=$m&month=9&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==9) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=9; $m++)
				{
					echo "<a href='day.php?day=$m&month=10&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 4:
				for($m=28; $m<=31; $m++)
				{
					echo "<a href='day.php?day=$m&month=8&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<31; $m++)
				{
					echo "<a href='day.php?day=$m&month=9&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==9) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=8; $m++)
				{
					echo "<a href='day.php?day=$m&month=10&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 5:
				for($m=27; $m<=31; $m++)
				{
					echo "<a href='day.php?day=$m&month=8&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<31; $m++)
				{
					echo "<a href='day.php?day=$m&month=9&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==9) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=7; $m++)
				{
					echo "<a href='day.php?day=$m&month=10&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 6:
				for($m=26; $m<=31; $m++)
				{
					echo "<a href='day.php?day=$m&month=8&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<31; $m++)
				{
					echo "<a href='day.php?day=$m&month=9&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==9) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=6; $m++)
				{
					echo "<a href='day.php?day=$m&month=10&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;

			default:
				die("Could not populate calender. Day number is wrong.");
		}
	}
	
	function october($startDay)
	{
		global $year, $todayDay, $todayMonth, $todayYear;
		
		switch($startDay)
		{
			case 0:
				for($m=1; $m<32; $m++)
				{
					echo "<a href='day.php?day=$m&month=10&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==10) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=11; $m++)
				{
					echo "<a href='day.php?day=$m&month=11&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 1:
				for($m=30; $m<=30; $m++)
				{
					echo "<a href='day.php?day=$m&month=9&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<32; $m++)
				{
					echo "<a href='day.php?day=$m&month=10&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==10) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=10; $m++)
				{
					echo "<a href='day.php?day=$m&month=11&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 2:
				for($m=29; $m<=30; $m++)
				{
					echo "<a href='day.php?day=$m&month=9&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<32; $m++)
				{
					echo "<a href='day.php?day=$m&month=10&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==10) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=9; $m++)
				{
					echo "<a href='day.php?day=$m&month=11&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 3:
				for($m=28; $m<=30; $m++)
				{
					echo "<a href='day.php?day=$m&month=9&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<32; $m++)
				{
					echo "<a href='day.php?day=$m&month=10&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==10) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=8; $m++)
				{
					echo "<a href='day.php?day=$m&month=11&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 4:
				for($m=27; $m<=30; $m++)
				{
					echo "<a href='day.php?day=$m&month=9&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<32; $m++)
				{
					echo "<a href='day.php?day=$m&month=10&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==10) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=7; $m++)
				{
					echo "<a href='day.php?day=$m&month=11&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 5:
				for($m=26; $m<=30; $m++)
				{
					echo "<a href='day.php?day=$m&month=9&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<32; $m++)
				{
					echo "<a href='day.php?day=$m&month=10&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==10) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=6; $m++)
				{
					echo "<a href='day.php?day=$m&month=11&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 6:
				for($m=25; $m<=30; $m++)
				{
					echo "<a href='day.php?day=$m&month=9&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<32; $m++)
				{
					echo "<a href='day.php?day=$m&month=10&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==10) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=5; $m++)
				{
					echo "<a href='day.php?day=$m&month=11&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			default:
				die("Could not populate calender. Day number is wrong.");
		}
	}
	
	function november($startDay)
	{
		global $year, $todayDay, $todayMonth, $todayYear;
		
		switch($startDay)
		{
			case 0:
				for($m=1; $m<31; $m++)
				{
					echo "<a href='day.php?day=$m&month=11&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==11) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:30px;  border:1px solid black; height:10px; font-size:0.8;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=12; $m++)
				{
					echo "<a href='day.php?day=$m&month=12&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 1:
				for($m=31; $m<=31; $m++)
				{
					echo "<a href='day.php?day=$m&month=10&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<31; $m++)
				{
					echo "<a href='day.php?day=$m&month=11&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==11) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:30px;  border:1px solid black; height:10px; font-size:0.8;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=11; $m++)
				{
					echo "<a href='day.php?day=$m&month=12&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 2:
				for($m=30; $m<=31; $m++)
				{
					echo "<a href='day.php?day=$m&month=10&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<31; $m++)
				{
					echo "<a href='day.php?day=$m&month=11&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==11) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:30px;  border:1px solid black; height:10px; font-size:0.8;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=10; $m++)
				{
					echo "<a href='day.php?day=$m&month=12&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 3:
				for($m=29; $m<=31; $m++)
				{
					echo "<a href='day.php?day=$m&month=10&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<31; $m++)
				{
					echo "<a href='day.php?day=$m&month=11&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==11) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:30px;  border:1px solid black; height:10px; font-size:0.8;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=9; $m++)
				{
					echo "<a href='day.php?day=$m&month=12&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 4:
				for($m=28; $m<=31; $m++)
				{
					echo "<a href='day.php?day=$m&month=10&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<31; $m++)
				{
					echo "<a href='day.php?day=$m&month=11&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==11) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:30px;  border:1px solid black; height:10px; font-size:0.8;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=8; $m++)
				{
					echo "<a href='day.php?day=$m&month=12&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 5:
				for($m=27; $m<=31; $m++)
				{
					echo "<a href='day.php?day=$m&month=10&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<31; $m++)
				{
					echo "<a href='day.php?day=$m&month=11&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==11) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:30px;  border:1px solid black; height:10px; font-size:0.8;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=7; $m++)
				{
					echo "<a href='day.php?day=$m&month=12&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 6:
				for($m=26; $m<=31; $m++)
				{
					echo "<a href='day.php?day=$m&month=10&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<31; $m++)
				{
					echo "<a href='day.php?day=$m&month=11&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==11) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:30px;  border:1px solid black; height:10px; font-size:0.8;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=6; $m++)
				{
					echo "<a href='day.php?day=$m&month=12&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			default:
				die("Could not populate calender. Day number is wrong.");
		}
	}
	
	function december($startDay)
	{
		global $year, $todayDay, $todayMonth, $todayYear, $nextYear;
		
		switch($startDay)
		{
			case 0:
				for($m=1; $m<32; $m++)
				{
					echo "<a href='day.php?day=$m&month=12&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==12) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=11; $m++)
				{
					echo "<a href='day.php?day=$m&month=1&year=$nextYear' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 1:
				for($m=30; $m<=30; $m++)
				{
					echo "<a href='day.php?day=$m&month=11&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<32; $m++)
				{
					echo "<a href='day.php?day=$m&month=12&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==12) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=10; $m++)
				{
					echo "<a href='day.php?day=$m&month=1&year=$nextYear' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 2:
				for($m=29; $m<=30; $m++)
				{
					echo "<a href='day.php?day=$m&month=11&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<32; $m++)
				{
					echo "<a href='day.php?day=$m&month=12&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==12) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=9; $m++)
				{
					echo "<a href='day.php?day=$m&month=1&year=$nextYear' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 3:
				for($m=28; $m<=30; $m++)
				{
					echo "<a href='day.php?day=$m&month=11&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<32; $m++)
				{
					echo "<a href='day.php?day=$m&month=12&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==12) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=8; $m++)
				{
					echo "<a href='day.php?day=$m&month=1&year=$nextYear' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 4:
				for($m=27; $m<=30; $m++)
				{
					echo "<a href='day.php?day=$m&month=11&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<32; $m++)
				{
					echo "<a href='day.php?day=$m&month=12&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==12) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=7; $m++)
				{
					echo "<a href='day.php?day=$m&month=1&year=$nextYear' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 5:
				for($m=26; $m<=30; $m++)
				{
					echo "<a href='day.php?day=$m&month=11&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<32; $m++)
				{
					echo "<a href='day.php?day=$m&month=12&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==12) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=6; $m++)
				{
					echo "<a href='day.php?day=$m&month=1&year=$nextYear' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			case 6:
				for($m=25; $m<=30; $m++)
				{
					echo "<a href='day.php?day=$m&month=11&year=$year' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<32; $m++)
				{
					echo "<a href='day.php?day=$m&month=12&year=$year' id='letters'";
						if(($m==$todayDay) && ($todayMonth==12) && ($year==$todayYear))
						{
							echo "style='background:lightgrey; width:43px;  border:1px solid black; height:12px; font-size:11px;'";
						}
					echo ">";
						echo $m;
					echo "</a>\n";
				}
				for($m=1; $m<=5; $m++)
				{
					echo "<a href='day.php?day=$m&month=1&year=$nextYear' id='letters2'>";
						echo $m;
					echo "</a>\n";
				}
				break;
				
			default:
				die("Could not populate calender. Day number is wrong.");
		}
	}
	
	function showBirthday()
	{
		global $resultBirthDays, $month, $year, $fullDays;
		
		echo "<div id='birth'>";
							echo "<table style='width:750px;'>\n";
							echo "<tr><td style='width:620px;'>\n";
							echo "$resultBirthDays[PersonName]'s :: ";
							echo $fullDays[calculateDay($resultBirthDays["Day"],$month, $year)];
							echo " the $resultBirthDays[Day]";
							
							if($resultBirthDays["Day"]==1 || $resultBirthDays["Day"]==21 || $resultBirthDays["Day"]==31)
							{
								echo "<sup>st</sup>\n";
							}
							else if($resultBirthDays["Day"]==2 || $resultBirthDays["Day"]==22)
							{
								echo "<sup>nd</sup>\n";
							}
							else if($resultBirthDays["Day"]==3 || $resultBirthDays["Day"]==23)
							{
								echo "<sup>rd</sup>\n";
							}
							else
							{
								echo "<sup>th</sup>\n";
							}
							
							echo "</td>";
							echo "<td><button type='button' id='viewEditBirthday' onclick='viewEditBirthday($resultBirthDays[BirthDayID], \"$resultBirthDays[PersonName]\", $resultBirthDays[Day], $resultBirthDays[Month])'>Edit</button><td>\n";
							echo "<td><button type='button' id='deleteBirthday' onclick='deleteBirthday($resultBirthDays[BirthDayID], 0, $month, $year)'>Delete</birthday><td>\n";
							echo "</tr>";
							echo "</table>\n";
						echo "</div>\n\n";
	}
	
	function showReminder()
	{
		global $resultReminders, $fullDays, $month, $year, $beginning;
		
		echo "<div id='birth'>";
		echo "<table style='width:750px;'>\n";
		echo "<tr><td style='width:620px;'>\n";
			echo $fullDays[calculateDay($resultReminders["Day"], $month, $year)];
			echo " the ";
			echo $resultReminders["Day"];
										
			if($resultReminders["Day"]==1 || $resultReminders["Day"]==21 || $resultReminders["Day"]==31)
			{
				echo "<sup>st</sup>\n";
			}
			else if($resultReminders["Day"]==2 || $resultReminders["Day"]==22)
			{
				echo "<sup>nd</sup>\n";
			}
			else if($resultReminders["Day"]==3 || $resultReminders["Day"]==23)
			{
				echo "<sup>rd</sup>\n";
			}
			else
			{
				echo "<sup>th</sup>\n";
			}
										
			echo " :: ";
			echo html_entity_decode($resultReminders["Comment"], ENT_QUOTES);
		echo "</td>";
		echo "<td>";
			echo "<button type='button' onclick='viewEditReminder($resultReminders[ReminderID], \"$resultReminders[Comment]\",";
			if($beginning!=0)
			{
				echo $beginning;
			}
			else
			{
			 	$resultReminders["Day"];
			}
			 echo ", $resultReminders[Month], $resultReminders[Year], $resultReminders[Occurrence], $resultReminders[Times])'>Edit</button>";
		echo "</td>";
		echo "<td>";
			echo "<button type='button' onclick='deleteReminder($resultReminders[ReminderID], 0, $month, $year)'>Delete</button>";
		echo "</td>";
		echo "</tr>";
		echo "</table>";
		echo "</div>\n\n";
	}
	
	function showReminderEachDay($startDay, $endDay)
	{
		global $resultReminders, $fullDays, $month, $year, $beginning;
		
		echo "<div id='birth'>";
		echo "<table style='width:750px;'>\n";
		echo "<tr><td style='width:620px;'>\n";
			echo $fullDays[calculateDay($startDay, $month, $year)];
			echo " the ";
			echo $startDay;
										
			if($startDay==1 || $startDay==21 || $startDay==31)
			{
				echo "<sup>st</sup>\n";
			}
			else if($startDay==2 || $startDay==22)
			{
				echo "<sup>nd</sup>\n";
			}
			else if($startDay==3 || $startDay==23)
			{
				echo "<sup>rd</sup>\n";
			}
			else
			{
				echo "<sup>th</sup>\n";
			}
			
			echo " to ";
			echo $fullDays[calculateDay($endDay, $month, $year)];
			echo " the ";
			echo $endDay;
			
			if($endDay==1 || $endDay==21 || $endDay==31)
			{
				echo "<sup>st</sup>\n";
			}
			else if($endDay==2 || $endDay==22)
			{
				echo "<sup>nd</sup>\n";
			}
			else if($endDay==3 || $endDay==23)
			{
				echo "<sup>rd</sup>\n";
			}
			else
			{
				echo "<sup>th</sup>\n";
			}
										
			echo " :: ";
			echo html_entity_decode($resultReminders["Comment"], ENT_QUOTES);
		echo "</td>";
		echo "<td>";
			echo "<button type='button' onclick='viewEditReminder($resultReminders[ReminderID], \"$resultReminders[Comment]\",";
			if($beginning!=0)
			{
				echo $beginning;
			}
			else
			{
			 	$resultReminders["Day"];
			}
			 echo ", $resultReminders[Month], $resultReminders[Year], $resultReminders[Occurrence], $resultReminders[Times])'>Edit</button>";
		echo "</td>";
		echo "<td>";
			echo "<button type='button' onclick='deleteReminder($resultReminders[ReminderID], 0, $month, $year)'>Delete</button>";
		echo "</td>";
		echo "</tr>";
		echo "</table>";
		echo "</div>\n\n";
	}
	
	function showPayment()
	{
		global $resultsPayments, $fullDays, $month, $year, $resultsCategories;
		
		echo "<div id='birth'>";
							echo "<table style='width:750px;'>";
							echo "<tr>";
								echo "<td style='width:620px;'>";
								
									echo $fullDays[calculateDay($resultsPayments["Day"],$month, $year)];
									echo " the $resultsPayments[Day]";
							
									if($resultsPayments["Day"]==1 || $resultsPayments["Day"]==21 || $resultsPayments["Day"]==31)
									{
										echo "<sup>st</sup>\n";
									}
									else if($resultsPayments["Day"]==2 || $resultsPayments["Day"]==22)
									{
										echo "<sup>nd</sup>\n";
									}
									else if($resultsPayments["Day"]==3 || $resultsPayments["Day"]==23)
									{
										echo "<sup>rd</sup>\n";
									}
									else
									{
										echo "<sup>th</sup>\n";
									}
									
									echo " :: ";
									
									echo "£$resultsPayments[Amount]";
									
									if($resultsPayments["Type"]==1) echo " from ";
									else echo " to ";
									
									echo "$resultsCategories[Name]";
									
								echo "<td>";
									echo "<button type='button' id='viewEditPayment' onclick='viewEditPayment($resultsPayments[PaymentID], $resultsPayments[Day], $resultsPayments[Month], $resultsPayments[Year], \"$resultsPayments[Amount]\", $resultsPayments[Type], $resultsPayments[Category])'>Edit</button>";
								echo "</td>";
								
								echo "<td>";
									echo "<button type='button' id='deletePayment' onclick='deletePayment($resultsPayments[PaymentID], 0, $resultsPayments[Month], $resultsPayments[Year])'>Delete</birthday>";
								echo "</td>";

							echo "</tr>";
							echo "</table>\n";
							echo "</div>\n\n";
	}
	
	function showPaymentCategories()
	{
		global $resultPaymentCategories, $month, $year;
		
		echo "<tr>";
			echo "<td><input type='text' value='$resultPaymentCategories[Name]' disabled='disabled' id='value$resultPaymentCategories[PaymentCategoryID]' /></td>";
			echo "<td><button type='button' id='edit$resultPaymentCategories[PaymentCategoryID]' onclick='enableCategory($resultPaymentCategories[PaymentCategoryID])'>Edit</button>";
			echo "<button type='button' id='submit$resultPaymentCategories[PaymentCategoryID]' style='display:none;' onclick='submitCategory($resultPaymentCategories[PaymentCategoryID], 0, $month, $year)'>Submit</button></td>";
			echo "<td><button type='button' onclick='deleteCategory($resultPaymentCategories[PaymentCategoryID], 0, $month, $year)'>Delete</button></td>";
		echo "</tr>\n";
	}
	
	function doSetRM()
	{
		global $setRM;
		
		if($setRM<1)
		{ 
			echo "<h3>Reminders This Month:</h3><br />\n";
			$setRM++;
		}
	}
	
	function doSetRMDay()
	{
		global $setRM;
		
		if($setRM<1)
		{ 
			echo "<h3>Reminders Today:</h3><br />\n";
			$setRM++;
		}
	}
	
	function calculateDaysDiff($startYear, $startMonth, $startDay, $endYear, $endMonth, $endDay)
	{
		$daysDiff = (strtotime(date("$startYear-$startMonth-$startDay")) - strtotime("$endYear-$endMonth-$endDay")) / (60 * 60 * 24);
		
		return $daysDiff;
	}
	
	function showBirthdayDay()
	{
		global $resultBirthDays, $month, $year, $fullDays, $day;
		
		echo "<div id='birth'>";
							echo "<table style='width:750px;'>\n";
							echo "<tr><td style='width:620px;'>\n";
							echo "$resultBirthDays[PersonName]'s";
							
							echo "</td>";
							echo "<td><button type='button' id='viewEditBirthday' onclick='viewEditBirthday($resultBirthDays[BirthDayID], \"$resultBirthDays[PersonName]\", $resultBirthDays[Day], $resultBirthDays[Month])'>Edit</button><td>\n";
							echo "<td><button type='button' id='deleteBirthday' onclick='deleteBirthday($resultBirthDays[BirthDayID], $day, $month, $year)'>Delete</birthday><td>\n";
							echo "</tr>";
							echo "</table>\n";
						echo "</div>\n\n";
	}
	
	function showPaymentDay()
	{
		global $resultsPayments, $fullDays, $month, $year, $resultsCategories, $day;
		
		echo "<div id='birth'>";
							echo "<table style='width:750px;'>";
							echo "<tr>";
								echo "<td style='width:620px;'>";
									
									echo "£$resultsPayments[Amount]";
									
									if($resultsPayments["Type"]==1) echo " from ";
									else echo " to ";
									
									echo "$resultsCategories[Name]";
									
								echo "<td>";
									echo "<button type='button' id='viewEditPayment' onclick='viewEditPayment($resultsPayments[PaymentID], $resultsPayments[Day], $resultsPayments[Month], $resultsPayments[Year], \"$resultsPayments[Amount]\", $resultsPayments[Type], $resultsPayments[Category])'>Edit</button>";
								echo "</td>";
								
								echo "<td>";
									echo "<button type='button' id='deletePayment' onclick='deletePayment($resultsPayments[PaymentID], $day, $resultsPayments[Month], $resultsPayments[Year])'>Delete</birthday>";
								echo "</td>";

							echo "</tr>";
							echo "</table>\n";
							echo "</div>\n\n";
	}
	
	function showPaymentCategoriesDay()
	{
		global $resultPaymentCategories, $month, $year, $day;
		
		echo "<tr>";
			echo "<td><input type='text' value='$resultPaymentCategories[Name]' disabled='disabled' id='value$resultPaymentCategories[PaymentCategoryID]' /></td>";
			echo "<td><button type='button' id='edit$resultPaymentCategories[PaymentCategoryID]' onclick='enableCategory($resultPaymentCategories[PaymentCategoryID])'>Edit</button>";
			echo "<button type='button' id='submit$resultPaymentCategories[PaymentCategoryID]' style='display:none;' onclick='submitCategory($resultPaymentCategories[PaymentCategoryID], $day, $month, $year)'>Submit</button></td>";
			echo "<td><button type='button' onclick='deleteCategory($resultPaymentCategories[PaymentCategoryID], $day, $month, $year)'>Delete</button></td>";
		echo "</tr>\n";
	}
	
	function showReminderDay()
	{
		global $resultReminders, $fullDays, $month, $year, $day;
		
		echo "<div id='birth'>";
		echo "<table style='width:750px;'>\n";
		echo "<tr><td style='width:620px;'>\n";
			echo html_entity_decode($resultReminders["Comment"], ENT_QUOTES);
		echo "</td>";
		echo "<td>";
			echo "<button type='button' onclick='viewEditReminder($resultReminders[ReminderID], \"$resultReminders[Comment]\",$resultReminders[Day], $resultReminders[Month], $resultReminders[Year], $resultReminders[Occurrence], $resultReminders[Times])'>Edit</button>";
		echo "</td>";
		echo "<td>";
			echo "<button type='button' onclick='deleteReminder($resultReminders[ReminderID], $day, $month, $year)'>Delete</button>";
		echo "</td>";
		echo "</tr>";
		echo "</table>";
		echo "</div>\n\n";
	}
	
	function showWorkDone()
	{
		global $resultWorkDone, $resultsCompanies, $fullDays, $day, $month, $year;
		
		echo "<div id='birth'>";
		echo "<table style='width:750px;'>\n";
		echo "<tr><td style='width:620px;'>\n";
			echo $fullDays[calculateDay($resultWorkDone["Day"],$month, $year)];
			echo " the $resultWorkDone[Day]";
			
			if($resultWorkDone["Day"]==1 || $resultWorkDone["Day"]==21 || $resultWorkDone["Day"]==31)
			{
				echo "<sup>st</sup>";
			}
			else if($resultWorkDone["Day"]==2 || $resultWorkDone["Day"]==22)
			{
				echo "<sup>nd</sup>";
			}
			else if($resultWorkDone["Day"]==3 || $resultWorkDone["Day"]==23)
			{
				echo "<sup>rd</sup>";
			}
			else 
			{
				echo "<sup>th</sup>";
			}
			
			echo " :: ";
			
			echo $resultWorkDone["Hours"] . " hours " . $resultWorkDone["Minutes"] . " minutes for ";
			echo $resultsCompanies["CompanyName"];
			echo " at £" . $resultWorkDone["Wage"] . " per hour.";
			
			if($resultWorkDone["OvertimeWage"]!=0)
			{
				echo "<br /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Overtime: ";
				echo $resultWorkDone["OvertimeHours"] . " hours " . $resultWorkDone["OvertimeMinutes"] . " minutes at £";
				echo $resultWorkDone["OvertimeWage"] . " per hour.";
			}
			
		echo "</td>";
		
		echo "<td>";
			echo "<button type='button' onclick='viewEditWorkDone($resultWorkDone[WorkID], $resultWorkDone[Day], $resultWorkDone[Month], $resultWorkDone[Year], $resultWorkDone[CompanyID], $resultWorkDone[Hours], $resultWorkDone[Minutes], $resultWorkDone[Wage], $resultWorkDone[OvertimeHours], $resultWorkDone[OvertimeMinutes], $resultWorkDone[OvertimeWage])'>Edit</button>";
		echo "</td>";
		
		echo "<td>";
			echo "<button type='button' onclick='deleteWorkDone($resultWorkDone[WorkID], 0, $resultWorkDone[Month], $resultWorkDone[Year])'>Delete</button>";
		echo "</td>";
		
		echo "</tr>";
		echo "</table>";
		echo "</div>\n\n";
	}
	
	function showCompanies()
	{
		global $resultCompanies, $month, $year;
		
		echo "<tr>";
			echo "<td><input type='text' value='$resultCompanies[CompanyName]' disabled='disabled' id='company$resultCompanies[CompanyID]' /></td>";
			echo "<td><button type='button' id='editCompany$resultCompanies[CompanyID]' onclick='enableCompany($resultCompanies[CompanyID])'>Edit</button>";
			echo "<button type='button' id='submitCompany$resultCompanies[CompanyID]' style='display:none;' onclick='submitCompany($resultCompanies[CompanyID], 0, $month, $year)'>Submit</button></td>";
			echo "<td><button type='button' onclick='deleteCompany($resultCompanies[CompanyID], 0, $month, $year)'>Delete</button></td>";
		echo "</tr>\n";
	}
	
	function showWorkDoneDay()
	{
		global $resultWorkDone, $resultsCompanies, $fullDays, $day, $month, $year;
		
		echo "<div id='birth'>";
		echo "<table style='width:750px;'>\n";
		echo "<tr><td style='width:620px;'>\n";
		
			echo $resultWorkDone["Hours"] . " hours " . $resultWorkDone["Minutes"] . " minutes for ";
			echo $resultsCompanies["CompanyName"];
			echo " at £" . $resultWorkDone["Wage"] . " per hour.";
			
			if($resultWorkDone["OvertimeWage"]!=0)
			{
				echo "<br /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Overtime: ";
				echo $resultWorkDone["OvertimeHours"] . " hours " . $resultWorkDone["OvertimeMinutes"] . " minutes at £";
				echo $resultWorkDone["OvertimeWage"] . " per hour.";
			}
			
		echo "</td>";
		
		echo "<td>";
			echo "<button type='button' onclick='viewEditWorkDone($resultWorkDone[WorkID], $resultWorkDone[Day], $resultWorkDone[Month], $resultWorkDone[Year], $resultWorkDone[CompanyID], $resultWorkDone[Hours], $resultWorkDone[Minutes], $resultWorkDone[Wage], $resultWorkDone[OvertimeHours], $resultWorkDone[OvertimeMinutes], $resultWorkDone[OvertimeWage])'>Edit</button>";
		echo "</td>";
		
		echo "<td>";
			echo "<button type='button' onclick='deleteWorkDone($resultWorkDone[WorkID], $day, $resultWorkDone[Month], $resultWorkDone[Year])'>Delete</button>";
		echo "</td>";
		
		echo "</tr>";
		echo "</table>";
		echo "</div>\n\n";
	}
	
	function showCompaniesDay()
	{
		global $resultCompanies, $day, $month, $year;
		
		echo "<tr>";
			echo "<td><input type='text' value='$resultCompanies[CompanyName]' disabled='disabled' id='company$resultCompanies[CompanyID]' /></td>";
			echo "<td><button type='button' id='editCompany$resultCompanies[CompanyID]' onclick='enableCompany($resultCompanies[CompanyID])'>Edit</button>";
			echo "<button type='button' id='submitCompany$resultCompanies[CompanyID]' style='display:none;' onclick='submitCompany($resultCompanies[CompanyID], $day, $month, $year)'>Submit</button></td>";
			echo "<td><button type='button' onclick='deleteCompany($resultCompanies[CompanyID], $day, $month, $year)'>Delete</button></td>";
		echo "</tr>\n";
	}
	
	function showPaymentSearch()
	{
		global $resultsPayments, $fullDays, $resultsCategories, $selectedDay, $selectedMonth, $selectedYear, $saved, $months, $savedMonth, $savedYear;
		
		echo "<div id='birth'>";
			echo "<table style='width:750px;'>";
			echo "<tr>";
				echo "<td style='width:620px;'>";
				
					echo $fullDays[calculateDay($resultsPayments["Day"], $selectedMonth, $selectedYear)];
					echo " the $resultsPayments[Day]";
			
					if($resultsPayments["Day"]==1 || $resultsPayments["Day"]==21 || $resultsPayments["Day"]==31)
					{
						echo "<sup>st</sup>\n";
					}
					else if($resultsPayments["Day"]==2 || $resultsPayments["Day"]==22)
					{
						echo "<sup>nd</sup>\n";
					}
					else if($resultsPayments["Day"]==3 || $resultsPayments["Day"]==23)
					{
						echo "<sup>rd</sup>\n";
					}
					else
					{
						echo "<sup>th</sup>\n";
					}
					
					echo " of " . $months[$selectedMonth-1] . " " . $selectedYear;
					
					echo " :: ";
					
					echo "£$resultsPayments[Amount]";
					
					if($resultsPayments["Type"]==1) echo " from ";
					else echo " to ";
					
					echo "$resultsCategories[Name]";
					
				echo "<td>";
					echo "<button type='button' id='viewEditPayment' onclick='viewEditPayment($resultsPayments[PaymentID], $resultsPayments[Day], $resultsPayments[Month], $resultsPayments[Year], \"$resultsPayments[Amount]\", $resultsPayments[Type], $resultsPayments[Category])'>Edit</button>";
				echo "</td>";
				
				echo "<td>";
					echo "<button type='button' id='deletePayment' onclick='deletePayment($resultsPayments[PaymentID], $saved, $savedMonth, $savedYear)'>Delete</birthday>";
				echo "</td>";

			echo "</tr>";
			echo "</table>\n";
			echo "</div>\n\n";
	}
	
	function showPaymentCategoriesSearch()
	{
		global $resultPaymentCategories, $savedMonth, $savedYear, $saved;
		
		echo "<tr>";
			echo "<td><input type='text' value='$resultPaymentCategories[Name]' disabled='disabled' id='value$resultPaymentCategories[PaymentCategoryID]' /></td>";
			echo "<td><button type='button' id='edit$resultPaymentCategories[PaymentCategoryID]' onclick='enableCategory($resultPaymentCategories[PaymentCategoryID])'>Edit</button>";
			echo "<button type='button' id='submit$resultPaymentCategories[PaymentCategoryID]' style='display:none;' onclick='submitCategory($resultPaymentCategories[PaymentCategoryID], $saved, $savedMonth, $savedYear)'>Submit</button></td>";
			echo "<td><button type='button' onclick='deleteCategory($resultPaymentCategories[PaymentCategoryID], $saved, $savedMonth, $savedYear)'>Delete</button></td>";
		echo "</tr>\n";
	}
	
	function showWorkDoneSearch()
	{
		global $resultWorkDone, $resultsCompanies, $fullDays, $saved, $savedMonth, $savedYear, $months;
		
		echo "<div id='birth'>";
		echo "<table style='width:750px;'>\n";
		echo "<tr><td style='width:620px;'>\n";
			echo $fullDays[calculateDay($resultWorkDone["Day"], $resultWorkDone["Month"], $resultWorkDone["Year"])];
			echo " the $resultWorkDone[Day]";
			
			if($resultWorkDone["Day"]==1 || $resultWorkDone["Day"]==21 || $resultWorkDone["Day"]==31)
			{
				echo "<sup>st</sup>";
			}
			else if($resultWorkDone["Day"]==2 || $resultWorkDone["Day"]==22)
			{
				echo "<sup>nd</sup>";
			}
			else if($resultWorkDone["Day"]==3 || $resultWorkDone["Day"]==23)
			{
				echo "<sup>rd</sup>";
			}
			else 
			{
				echo "<sup>th</sup>";
			}
			
			echo " of ";
			echo $months[($resultWorkDone["Month"])-1];
			echo " " . $resultWorkDone["Year"];
			
			echo " :: ";
			
			echo $resultWorkDone["Hours"] . " hours " . $resultWorkDone["Minutes"] . " minutes for ";
			echo $resultsCompanies["CompanyName"];
			echo " at £" . $resultWorkDone["Wage"] . " per hour.";
			
			if($resultWorkDone["OvertimeWage"]!=0)
			{
				echo "<br /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Overtime: ";
				echo $resultWorkDone["OvertimeHours"] . " hours " . $resultWorkDone["OvertimeMinutes"] . " minutes at £";
				echo $resultWorkDone["OvertimeWage"] . " per hour.";
			}
			
		echo "</td>";
		
		echo "<td>";
			echo "<button type='button' onclick='viewEditWorkDone($resultWorkDone[WorkID], $resultWorkDone[Day], $resultWorkDone[Month], $resultWorkDone[Year], $resultWorkDone[CompanyID], $resultWorkDone[Hours], $resultWorkDone[Minutes], $resultWorkDone[Wage], $resultWorkDone[OvertimeHours], $resultWorkDone[OvertimeMinutes], $resultWorkDone[OvertimeWage])'>Edit</button>";
		echo "</td>";
		
		echo "<td>";
			echo "<button type='button' onclick='deleteWorkDone($resultWorkDone[WorkID], $saved, $savedMonth, $savedYear)'>Delete</button>";
		echo "</td>";
		
		echo "</tr>";
		echo "</table>";
		echo "</div>\n\n";
	}
	
	function showCompaniesSearch()
	{
		global $resultCompanies, $saved, $savedMonth, $savedYear;
		echo "<tr>";
			echo "<td><input type='text' value='$resultCompanies[CompanyName]' disabled='disabled' id='company$resultCompanies[CompanyID]' /></td>";
			echo "<td><button type='button' id='editCompany$resultCompanies[CompanyID]' onclick='enableCompany($resultCompanies[CompanyID])'>Edit</button>";
			echo "<button type='button' id='submitCompany$resultCompanies[CompanyID]' style='display:none;' onclick='submitCompany($resultCompanies[CompanyID], $saved, $savedMonth, $savedYear)'>Submit</button></td>";
			echo "<td><button type='button' onclick='deleteCompany($resultCompanies[CompanyID], $saved, $savedMonth, $savedYear)'>Delete</button></td>";
		echo "</tr>\n";
	}
	
	function showBirthdaySearch()
	{
		global $resultBirthDays, $month, $year, $fullDays, $saved, $months, $savedMonth, $savedYear;
		
		echo "<div id='birth'>";
							echo "<table style='width:750px;'>\n";
							echo "<tr><td style='width:620px;'>\n";
							echo "$resultBirthDays[PersonName]'s :: ";
							echo "$resultBirthDays[Day]";
							
							if($resultBirthDays["Day"]==1 || $resultBirthDays["Day"]==21 || $resultBirthDays["Day"]==31)
							{
								echo "<sup>st</sup>\n";
							}
							else if($resultBirthDays["Day"]==2 || $resultBirthDays["Day"]==22)
							{
								echo "<sup>nd</sup>\n";
							}
							else if($resultBirthDays["Day"]==3 || $resultBirthDays["Day"]==23)
							{
								echo "<sup>rd</sup>\n";
							}
							else
							{
								echo "<sup>th</sup>\n";
							}
							
							echo " of ";
							echo $months[$resultBirthDays["Month"]-1];
							
							echo "</td>";
							echo "<td><button type='button' id='viewEditBirthday' onclick='viewEditBirthday($resultBirthDays[BirthDayID], \"$resultBirthDays[PersonName]\", $resultBirthDays[Day], $resultBirthDays[Month])'>Edit</button><td>\n";
							echo "<td><button type='button' id='deleteBirthday' onclick='deleteBirthday($resultBirthDays[BirthDayID], $saved, $savedMonth, $savedYear)'>Delete</birthday><td>\n";
							echo "</tr>";
							echo "</table>\n";
						echo "</div>\n\n";
	}
	
	function showReminderSearch()
	{
		global $resultReminders, $fullDays, $savedMonth, $savedYear, $saved, $months;
		
		echo "<div id='birth'>";
		echo "<table style='width:750px;'>\n";
		echo "<tr><td style='width:620px;'>\n";
			echo $fullDays[calculateDay($resultReminders["Day"], $resultReminders["Month"], $resultReminders["Year"])];
			echo " the ";
			echo $resultReminders["Day"];
										
			if($resultReminders["Day"]==1 || $resultReminders["Day"]==21 || $resultReminders["Day"]==31)
			{
				echo "<sup>st</sup>\n";
			}
			else if($resultReminders["Day"]==2 || $resultReminders["Day"]==22)
			{
				echo "<sup>nd</sup>\n";
			}
			else if($resultReminders["Day"]==3 || $resultReminders["Day"]==23)
			{
				echo "<sup>rd</sup>\n";
			}
			else
			{
				echo "<sup>th</sup>\n";
			}
			
			echo " of ";
			echo $months[$resultReminders["Month"]-1];
			echo " " . $resultReminders["Year"];
										
			echo " :: ";
			echo html_entity_decode($resultReminders["Comment"], ENT_QUOTES);
		echo "</td>";
		echo "<td>";
			echo "<button type='button' onclick='viewEditReminder($resultReminders[ReminderID], \"$resultReminders[Comment]\",$resultReminders[Day]";
			 echo ", $resultReminders[Month], $resultReminders[Year], $resultReminders[Occurrence], $resultReminders[Times])'>Edit</button>";
		echo "</td>";
		echo "<td>";
			echo "<button type='button' onclick='deleteReminder($resultReminders[ReminderID], $saved, $savedMonth, $savedYear)'>Delete</button>";
		echo "</td>";
		echo "</tr>";
		echo "</table>";
		echo "</div>\n\n";
	}
	
	function showPaymentSearch2()
	{
		global $resultsPayments, $fullDays, $saved, $savedMonth, $savedYear, $resultsCategories, $months;
		
		echo "<div id='birth'>";
							echo "<table style='width:750px;'>";
							echo "<tr>";
								echo "<td style='width:620px;'>";
								
									echo $fullDays[calculateDay($resultsPayments["Day"],$resultsPayments["Month"],$resultsPayments["Year"])];
									echo " the $resultsPayments[Day]";
							
									if($resultsPayments["Day"]==1 || $resultsPayments["Day"]==21 || $resultsPayments["Day"]==31)
									{
										echo "<sup>st</sup>\n";
									}
									else if($resultsPayments["Day"]==2 || $resultsPayments["Day"]==22)
									{
										echo "<sup>nd</sup>\n";
									}
									else if($resultsPayments["Day"]==3 || $resultsPayments["Day"]==23)
									{
										echo "<sup>rd</sup>\n";
									}
									else
									{
										echo "<sup>th</sup>\n";
									}
									
									echo " of ";
									echo $months[$resultsPayments["Month"]-1];
									echo " " . $resultsPayments["Year"];
									
									echo " :: ";
									
									echo "£$resultsPayments[Amount]";
									
									if($resultsPayments["Type"]==1) echo " from ";
									else echo " to ";
									
									echo "$resultsCategories[Name]";
									
								echo "<td>";
									echo "<button type='button' id='viewEditPayment' onclick='viewEditPayment($resultsPayments[PaymentID], $resultsPayments[Day], $resultsPayments[Month], $resultsPayments[Year], \"$resultsPayments[Amount]\", $resultsPayments[Type], $resultsPayments[Category])'>Edit</button>";
								echo "</td>";
								
								echo "<td>";
									echo "<button type='button' id='deletePayment' onclick='deletePayment($resultsPayments[PaymentID], $saved, $savedMonth, $savedYear)'>Delete</birthday>";
								echo "</td>";

							echo "</tr>";
							echo "</table>\n";
							echo "</div>\n\n";
	}
	
?>