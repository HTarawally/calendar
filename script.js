// JavaScript Document
var set=setInterval(function(){ready()},5000);

function startTime()
{
	var set2=setInterval(function(){clear(set2)},45000);
}

function ready()
{
	var error=document.getElementById("error");
	$(error).fadeOut(1000);
	clearInterval(set);
}

function clear(set2)
{
	var addBirthday=document.getElementById("addBirthday");
	var setReminder=document.getElementById("setReminder");
	var addPayment=document.getElementById("addPayment");
	var addWorkDone=document.getElementById("addWorkDone");
	var addHoursTarget=document.getElementById("addHoursTarget");
	var addWageTarget=document.getElementById("addWageTarget");
	
	$(addBirthday).hide(1000);
	$(setReminder).hide(1000);
	$(addPayment).hide(1000);
	$(addWorkDone).hide(1000);
	$(addHoursTarget).hide(1000);
	$(addWageTarget).hide(1000);
	$("#searchBox2").show(500);
	
	clearInterval(set2); 
}

function hideWait()
{
	var x=document.getElementById("Occurrences").selectedIndex;
	var y=document.getElementById("wait");
	
	if(x==0)
	{
		$(y).fadeOut(1000);
	}
	else
	{
		$(y).fadeIn(1000);
	}
}

function deleteBirthday(ID, day, month, year)
{
	if(day==0)
	{
		document.location="deletes/deletebirthday.php?ID=" + ID + "&month=" + month + "&year=" + year;
	}
	else
	{
		document.location="deletes/deletebirthday.php?ID=" + ID + "&day=" + day + "&month=" + month + "&year=" + year;
	}
}

function viewEditBirthday( ID, name, day, month)
{
	var birthDayID=document.getElementById("birthDayID");
	var birthDayPersonName=document.getElementById("birthDayPersonName");
	var birthDayDay=document.getElementById("birthDayDay");
	var birthDayMonth=document.getElementById("birthDayMonth");
	
	birthDayID.setAttribute("value",ID);
	birthDayPersonName.setAttribute("value",name);
	birthDayDay.selectedIndex=day-1;
	birthDayMonth.selectedIndex=month-1;
	
	$("#editBirthday").fadeIn(1000);
}

function deletePayment(ID, day, month, year)
{
	if(day==0)
	{
		document.location="deletes/deletepayment.php?ID=" + ID + "&month=" + month + "&year=" + year;
	}
	else
	{
		document.location="deletes/deletepayment.php?ID=" + ID + "&day=" + day + "&month=" + month + "&year=" + year;
	}
}

function viewEditPayment( ID, day, month, year, amount, type, category)
{
	var paymentID=document.getElementById("paymentID");
	var paymentDay=document.getElementById("paymentDay");
	var paymentMonth=document.getElementById("paymentMonth");
	var paymentYear=document.getElementById("paymentYear");
	var paymentAmountPound=document.getElementById("paymentAmountPound");
	var paymentAmountPence=document.getElementById("paymentAmountPence");
	var paymentType=document.getElementById("paymentType");
	var paymentCategory=document.getElementById("paymentCategory");
	
	var amountPound=Math.floor(amount);
	var amountPence=(amount-amountPound);
	
	amountPence=(amountPence.toFixed(2))*100;
	
	if(amountPence<10)
	{
		amountPence="0" + amountPence;
	}
	
	paymentID.setAttribute("value",ID);
	paymentDay.selectedIndex=day-1;
	paymentMonth.selectedIndex=month-1;
	paymentYear.selectedIndex=10;
	paymentAmountPound.setAttribute("value",amountPound);
	paymentAmountPence.setAttribute("value",amountPence);
	paymentType.selectedIndex=type-1;
	
	var length=paymentCategory.options.length;
	
	for(n=0; n<length; n++)
	{
		if((paymentCategory.options[n].value)==category)
		{
			paymentCategory.selectedIndex=n;
		}
	}
	
	$("#editPayment").fadeIn(1000);
}

function enableCategory(ID)
{
	savedValue="value" + ID;
	savedEdit="edit" + ID;
	savedSubmit="submit" + ID;
	
	value=document.getElementById(savedValue);
	edit=document.getElementById(savedEdit);
	gsubmit=document.getElementById(savedSubmit);
	
	value.disabled=false;
	$(edit).hide(500);
	$(gsubmit).show(500);
}

function deleteCategory(ID, day, month, year)
{
	if(day==0)
	{
		document.location="deletes/deletecategory.php?ID=" + ID + "&month=" + month + "&year=" + year;
	}
	else
	{
		document.location="deletes/deletecategory.php?ID=" + ID + "&day=" + day + "&month=" + month + "&year=" + year;
	}
}

function submitCategory(ID, day, month, year)
{
	button="value" + ID;
	phraseButton=document.getElementById(button);
	
	phrase=phraseButton.value;
	
	if(day==0)
	{
		document.location="edits/editcategory.php?ID=" + ID + "&month=" + month + "&year=" + year + "&phrase=" + phrase;
	}
	else
	{
		document.location="edits/editcategory.php?ID=" + ID + "&day=" + day + "&month=" + month + "&year=" + year + "&phrase=" + phrase;
	}
}

function viewEditReminder(ID, comment, day, month, year, occurrence, times)
{
	var reminderID=document.getElementById("reminderID");
	var reminderComment=document.getElementById("reminderComment");
	var reminderDay=document.getElementById("reminderDay");
	var reminderMonth=document.getElementById("reminderMonth");
	var reminderYear=document.getElementById("reminderYear");
	var reminderOccurrence=document.getElementById("reminderOccurrence");
	var reminderTimes=document.getElementById("reminderTimes");
	var tdTimes=document.getElementById("tdTimes");
	
	var startYear=year-10;
	
	reminderYear.innerHTML="<option value='" + startYear + "'>" + startYear + "</option>\
	<option value='" + (startYear+1) + "'>" + (startYear+1) + "</option>\
	<option value='" + (startYear+2) + "'>" + (startYear+2) + "</option>\
	<option value='" + (startYear+3) + "'>" + (startYear+3) + "</option>\
	<option value='" + (startYear+4) + "'>" + (startYear+4) + "</option>\
	<option value='" + (startYear+5) + "'>" + (startYear+5) + "</option>\
	<option value='" + (startYear+6) + "'>" + (startYear+6) + "</option>\
	<option value='" + (startYear+7) + "'>" + (startYear+7) + "</option>\
	<option value='" + (startYear+8) + "'>" + (startYear+8) + "</option>\
	<option value='" + (startYear+9) + "'>" + (startYear+9) + "</option>\
	<option value='" + (startYear+10) + "'>" + (startYear+10) + "</option>\
	<option value='" + (startYear+11) + "'>" + (startYear+11) + "</option>\
	<option value='" + (startYear+12) + "'>" + (startYear+12) + "</option>\
	<option value='" + (startYear+13) + "'>" + (startYear+13) + "</option>\
	<option value='" + (startYear+14) + "'>" + (startYear+14) + "</option>\
	<option value='" + (startYear+15) + "'>" + (startYear+15) + "</option>\
	<option value='" + (startYear+16) + "'>" + (startYear+16) + "</option>\
	<option value='" + (startYear+17) + "'>" + (startYear+17) + "</option>\
	<option value='" + (startYear+18) + "'>" + (startYear+18) + "</option>\
	<option value='" + (startYear+19) + "'>" + (startYear+19) + "</option>\
	<option value='" + (startYear+20) + "'>" + (startYear+20) + "</option>\
	";
	
	
	reminderID.setAttribute("value", ID);
	reminderComment.setAttribute("value",comment);
	reminderDay.selectedIndex=day-1;
	reminderMonth.selectedIndex=month-1;
	reminderYear.selectedIndex=10;
	reminderOccurrence.selectedIndex=occurrence-1;
	
	if(occurrence==1)
	{
		$(tdTimes).fadeOut(500);
	}
	else
	{
		$(tdTimes).fadeIn(500);
		if(times==(-1))
		{
			reminderTimes.selectedIndex=0;
		}
		else
		{
			reminderTimes.selectedIndex=times-1;
		}
	}
	
	$("#editReminder").fadeIn(1000);
}

function deleteReminder(ID, day, month, year)
{
	if(day==0)
	{
		document.location="deletes/deletereminder.php?ID=" + ID + "&month=" + month + "&year=" + year;
	}
	else
	{
		document.location="deletes/deletereminder.php?ID=" + ID + "&day=" + day + "&month=" + month + "&year=" + year;
	}
}

function OccurrenceChange()
{
	reminderOccurrence=document.getElementById("reminderOccurrence");
	tdTimes=document.getElementById("tdTimes");
	
	if(reminderOccurrence.selectedIndex==0)
	{
		$(tdTimes).fadeOut(500);
	}
	else
	{
		$(tdTimes).fadeIn(500);
	}
}

function viewEditWorkDone(ID, day, month, year, company, hours, minutes, wage, overtimehours, overtimeminutes, overtimewage)
{
	var storedPound=Math.floor(wage);
	var storedPence=wage-storedPound;
	var storedOvertimePound=Math.floor(overtimewage);
	var storedOvertimePence=overtimewage-storedOvertimePound;
	
	storedPence=(storedPence.toFixed(2))*100;
	storedOvertimePence=(storedOvertimePence.toFixed(2))*100;
	
	if(storedPence<10)
	{
		storedPence="0" + storedPence;
	}
	
	if(storedOvertimePence<10)
	{
		storedOvertimePence="0" + storedOvertimePence;
	}
	
	var workDoneID=document.getElementById("workDoneID");
	var workDoneDay=document.getElementById("workDoneDay");
	var workDoneMonth=document.getElementById("workDoneMonth");
	var workDoneCompany=document.getElementById("workDoneCompany");
	var workDoneHours=document.getElementById("workDoneHours");
	var workDoneMinutes=document.getElementById("workDoneMinutes");
	var workDoneWagePound=document.getElementById("workDoneWagePound");
	var workDoneWagePence=document.getElementById("workDoneWagePence");
	var workDoneOvertimeHours=document.getElementById("workDoneOvertimeHours");
	var workDoneOvertimeMinutes=document.getElementById("workDoneOvertimeMinutes");
	var workDoneOvertimeWagePound=document.getElementById("workDoneOvertimeWagePound");
	var workDoneOvertimeWagePence=document.getElementById("workDoneOvertimeWagePence");
	
	var startYear=year-10;
	
	workDoneYear.innerHTML="<option value='" + startYear + "'>" + startYear + "</option>\
	<option value='" + (startYear+1) + "'>" + (startYear+1) + "</option>\
	<option value='" + (startYear+2) + "'>" + (startYear+2) + "</option>\
	<option value='" + (startYear+3) + "'>" + (startYear+3) + "</option>\
	<option value='" + (startYear+4) + "'>" + (startYear+4) + "</option>\
	<option value='" + (startYear+5) + "'>" + (startYear+5) + "</option>\
	<option value='" + (startYear+6) + "'>" + (startYear+6) + "</option>\
	<option value='" + (startYear+7) + "'>" + (startYear+7) + "</option>\
	<option value='" + (startYear+8) + "'>" + (startYear+8) + "</option>\
	<option value='" + (startYear+9) + "'>" + (startYear+9) + "</option>\
	<option value='" + (startYear+10) + "'>" + (startYear+10) + "</option>\
	<option value='" + (startYear+11) + "'>" + (startYear+11) + "</option>\
	<option value='" + (startYear+12) + "'>" + (startYear+12) + "</option>\
	<option value='" + (startYear+13) + "'>" + (startYear+13) + "</option>\
	<option value='" + (startYear+14) + "'>" + (startYear+14) + "</option>\
	<option value='" + (startYear+15) + "'>" + (startYear+15) + "</option>\
	<option value='" + (startYear+16) + "'>" + (startYear+16) + "</option>\
	<option value='" + (startYear+17) + "'>" + (startYear+17) + "</option>\
	<option value='" + (startYear+18) + "'>" + (startYear+18) + "</option>\
	<option value='" + (startYear+19) + "'>" + (startYear+19) + "</option>\
	<option value='" + (startYear+20) + "'>" + (startYear+20) + "</option>\
	";
	
	workDoneID.setAttribute("value",ID);
	workDoneDay.selectedIndex=day-1;
	workDoneMonth.selectedIndex=month-1;
	workDoneYear.selectedIndex=10;
	workDoneHours.selectedIndex=hours;
	workDoneMinutes.selectedIndex=minutes/15;
	workDoneOvertimeHours.selectedIndex=overtimehours;
	workDoneOvertimeMinutes.selectedIndex=overtimeminutes/15;
	
	workDoneWagePound.setAttribute("value",storedPound);
	workDoneWagePence.setAttribute("value",storedPence);
	workDoneOvertimeWagePound.setAttribute("value",storedOvertimePound);
	workDoneOvertimeWagePence.setAttribute("value",storedOvertimePence);
	
	var length=workDoneCompany.options.length;
	
	for(n=0; n<length; n++)
	{
		if((workDoneCompany.options[n].value)==company)
		{
			workDoneCompany.selectedIndex=n;
		}
	}
	
	$("#editWorkDone").fadeIn(1000);
}

function deleteWorkDone(ID, day, month, year)
{
	if(day==0)
	{
		document.location="deletes/deleteworkdone.php?ID=" + ID + "&month=" + month + "&year=" + year;
	}
	else
	{
		document.location="deletes/deleteworkdone.php?ID=" + ID + "&day=" + day + "&month=" + month + "&year=" + year;
	}
}

function enableCompany(ID)
{
	savedValue="company" + ID;
	savedEdit="editCompany" + ID;
	savedSubmit="submitCompany" + ID;
	
	value=document.getElementById(savedValue);
	edit=document.getElementById(savedEdit);
	gsubmit=document.getElementById(savedSubmit);
	
	value.disabled=false;
	$(edit).hide(500);
	$(gsubmit).show(500);
}

function submitCompany(ID, day, month, year)
{
	button="company" + ID;
	phraseButton=document.getElementById(button);
	
	phrase=phraseButton.value;
	
	if(day==0)
	{
		document.location="edits/editcompany.php?ID=" + ID + "&month=" + month + "&year=" + year + "&phrase=" + phrase;
	}
	else
	{
		document.location="edits/editcompany.php?ID=" + ID + "&day=" + day + "&month=" + month + "&year=" + year + "&phrase=" + phrase;
	}
}

function deleteCompany(ID, day, month, year)
{
	if(day==0)
	{
		document.location="deletes/deletecompany.php?ID=" + ID + "&month=" + month + "&year=" + year;
	}
	else
	{
		document.location="deletes/deletecompany.php?ID=" + ID + "&day=" + day + "&month=" + month + "&year=" + year;
	}
}

function viewEditHoursTarget(ID, hours, minutes, month, year)
{
	var hoursTargetID=document.getElementById("hoursTargetID");
	var hoursTargetHours=document.getElementById("hoursTargetHours");
	var hoursTargetMinutes=document.getElementById("hoursTargetMinutes");
	var hoursTargetMonth=document.getElementById("hoursTargetMonth");
	var hoursTargetYear=document.getElementById("hoursTargetYear");
	
	var startYear=year-10;
	
	hoursTargetYear.innerHTML="<option value='" + startYear + "'>" + startYear + "</option>\
	<option value='" + (startYear+1) + "'>" + (startYear+1) + "</option>\
	<option value='" + (startYear+2) + "'>" + (startYear+2) + "</option>\
	<option value='" + (startYear+3) + "'>" + (startYear+3) + "</option>\
	<option value='" + (startYear+4) + "'>" + (startYear+4) + "</option>\
	<option value='" + (startYear+5) + "'>" + (startYear+5) + "</option>\
	<option value='" + (startYear+6) + "'>" + (startYear+6) + "</option>\
	<option value='" + (startYear+7) + "'>" + (startYear+7) + "</option>\
	<option value='" + (startYear+8) + "'>" + (startYear+8) + "</option>\
	<option value='" + (startYear+9) + "'>" + (startYear+9) + "</option>\
	<option value='" + (startYear+10) + "'>" + (startYear+10) + "</option>\
	<option value='" + (startYear+11) + "'>" + (startYear+11) + "</option>\
	<option value='" + (startYear+12) + "'>" + (startYear+12) + "</option>\
	<option value='" + (startYear+13) + "'>" + (startYear+13) + "</option>\
	<option value='" + (startYear+14) + "'>" + (startYear+14) + "</option>\
	<option value='" + (startYear+15) + "'>" + (startYear+15) + "</option>\
	<option value='" + (startYear+16) + "'>" + (startYear+16) + "</option>\
	<option value='" + (startYear+17) + "'>" + (startYear+17) + "</option>\
	<option value='" + (startYear+18) + "'>" + (startYear+18) + "</option>\
	<option value='" + (startYear+19) + "'>" + (startYear+19) + "</option>\
	<option value='" + (startYear+20) + "'>" + (startYear+20) + "</option>\
	";
	
	hoursTargetID.setAttribute("value",ID);
	hoursTargetHours.selectedIndex=hours-5;
	hoursTargetMinutes.selectedIndex=minutes/15;
	hoursTargetMonth.selectedIndex=month-1;
	hoursTargetYear.selectedIndex=10;
	
	$("#editHoursTarget").fadeIn(1000);
}

function viewEditWageTarget(ID, total, month, year)
{
	wageTargetID=document.getElementById("wageTargetID");
	wageTargetPound=document.getElementById("wageTargetPound");
	wageTargetPence=document.getElementById("wageTargetPence");
	wageTargetMonth=document.getElementById("wageTargetMonth");
	wageTargetYear=document.getElementById("wageTargetYear");
	
	var startYear=year-10;
	
	wageTargetYear.innerHTML="<option value='" + startYear + "'>" + startYear + "</option>\
	<option value='" + (startYear+1) + "'>" + (startYear+1) + "</option>\
	<option value='" + (startYear+2) + "'>" + (startYear+2) + "</option>\
	<option value='" + (startYear+3) + "'>" + (startYear+3) + "</option>\
	<option value='" + (startYear+4) + "'>" + (startYear+4) + "</option>\
	<option value='" + (startYear+5) + "'>" + (startYear+5) + "</option>\
	<option value='" + (startYear+6) + "'>" + (startYear+6) + "</option>\
	<option value='" + (startYear+7) + "'>" + (startYear+7) + "</option>\
	<option value='" + (startYear+8) + "'>" + (startYear+8) + "</option>\
	<option value='" + (startYear+9) + "'>" + (startYear+9) + "</option>\
	<option value='" + (startYear+10) + "'>" + (startYear+10) + "</option>\
	<option value='" + (startYear+11) + "'>" + (startYear+11) + "</option>\
	<option value='" + (startYear+12) + "'>" + (startYear+12) + "</option>\
	<option value='" + (startYear+13) + "'>" + (startYear+13) + "</option>\
	<option value='" + (startYear+14) + "'>" + (startYear+14) + "</option>\
	<option value='" + (startYear+15) + "'>" + (startYear+15) + "</option>\
	<option value='" + (startYear+16) + "'>" + (startYear+16) + "</option>\
	<option value='" + (startYear+17) + "'>" + (startYear+17) + "</option>\
	<option value='" + (startYear+18) + "'>" + (startYear+18) + "</option>\
	<option value='" + (startYear+19) + "'>" + (startYear+19) + "</option>\
	<option value='" + (startYear+20) + "'>" + (startYear+20) + "</option>\
	";
	
	var flooredTotal=Math.floor(total);	
	var saved=(total-flooredTotal)*100;
	
	if(saved<10)
	{
		saved="0" + saved;
	}
	
	wageTargetID.setAttribute("value",ID);
	wageTargetMonth.selectedIndex=month-1;
	wageTargetPound.setAttribute("value",flooredTotal);
	wageTargetPence.setAttribute("value",saved);
	wageTargetYear.selectedIndex=10;
	
	$("#editWageTarget").fadeIn(1000);
}

function deleteHoursTarget(ID, day, month, year)
{
	if(day==0)
	{
		document.location="deletes/deletehourstarget.php?ID=" + ID + "&month=" + month + "&year=" + year;
	}
	else
	{
		document.location="deletes/deletehourstarget.php?ID=" + ID + "&day=" + day + "&month=" + month + "&year=" + year;
	}
}

function deleteWageTarget(ID, day, month, year)
{
	if(day==0)
	{
		document.location="deletes/deletewagetarget.php?ID=" + ID + "&month=" + month + "&year=" + year;
	}
	else
	{
		document.location="deletes/deletewagetarget.php?ID=" + ID + "&day=" + day + "&month=" + month + "&year=" + year;
	}
}

$(document).ready(function(){
	$(".addBirthday").click(function(){
		$("#addBirthday").slideDown(500);
		$("#setReminder").slideUp(500);
		$("#addPayment").slideUp(500);
		$("#addWorkDone").slideUp(500);
		$("#addHoursTarget").slideUp(500);
		$("#addWageTarget").slideUp(500);
	});
	
	$(".setReminder").click(function(){
		$("#addBirthday").slideUp(500);
		$("#setReminder").slideDown(500);
		$("#addPayment").slideUp(500);
		$("#addWorkDone").slideUp(500);
		$("#addHoursTarget").slideUp(500);
		$("#addWageTarget").slideUp(500);
	});
	
	$(".addPayment").click(function(){
		$("#addBirthday").slideUp(500);
		$("#setReminder").slideUp(500);
		$("#addWorkDone").slideUp(500);
		$("#addHoursTarget").slideUp(500);
		$("#addWageTarget").slideUp(500);
		$("#searchBox2").hide(750, function(){
			$("#addPayment").slideDown(750);
		});
	});
	
	$(".addWorkDone").click(function(){
		$("#addBirthday").slideUp(500);
		$("#setReminder").slideUp(500);
		$("#addPayment").slideUp(500);
		$("#addHoursTarget").slideUp(500);
		$("#addWageTarget").slideUp(500);
		$("#searchBox2").hide(750, function(){
			$("#addWorkDone").slideDown(500);
		});
	});
	
	$(".addHoursTarget").click(function(){
		$("#addBirthday").slideUp(500);
		$("#setReminder").slideUp(500);
		$("#addPayment").slideUp(500);
		$("#addWorkDone").slideUp(500);
		$("#addHoursTarget").slideDown(500);
		$("#addWageTarget").slideUp(500);
	});
	
	$(".addWageTarget").click(function(){
		$("#addBirthday").slideUp(500);
		$("#setReminder").slideUp(500);
		$("#addPayment").slideUp(500);
		$("#addWorkDone").slideUp(500);
		$("#addHoursTarget").slideUp(500);
		$("#addWageTarget").slideDown(500);
	});
	
	$("#more").click(function(){
		$("#black").fadeIn(750);
		$("#bold").fadeIn(750);
		$("#paymentsummary").slideDown(750);
		$("#paymentsummary2").slideDown(750);
		$("#companysummary").fadeIn(750);
		$("#companysummary2").fadeIn(750);
		$("#targetsSet").slideDown(1000);
		$("#targetsSet2").slideDown(1000);
		$("#more").fadeOut(500);
		$("#boldHead").fadeIn(500);
	});
	
	$("#boldHead").click(function(){
		$("#paymentsummary").slideUp(1250);
		$("#paymentsummary2").slideUp(1250);
		$("#companysummary").slideUp(1250);
		$("#companysummary2").slideUp(1250);
		$("#targetsSet").slideUp(1250);
		$("#targetsSet2").slideUp(1250);
		$("#black").fadeOut(750);
		$("#bold").fadeOut(750);
		$("#more").fadeIn(500);
		$("#boldHead").fadeOut(500);
	});
	
	$("#nextSearch").click(function(){
		$("#searchBox").slideUp(750,function(){
			$("#searchBox2").slideDown(750);
		});
	});
	
	$("#PrevSearch").click(function(){
		$("#searchBox2").slideUp(750,function(){
			$("#searchBox").slideDown(750);
		});
	});
	
});