<?php
date_default_timezone_set("Europe/London");

define("HOST","localhost");
define("USER","root");
define("PASS","");
define("DBNAME","calendar");

$dbconnect = mysqli_connect(HOST,USER,PASS,DBNAME) or die("<script type='text/javascript'>Could not connect to the database.</script>");

$createBirthDays="CREATE TABLE birthdays (
	BirthDayID int(255) NOT NULL auto_increment,
	PersonName varchar(255) NOT NULL,
	Day int(2) NOT NULL,
	Month int(2) NOT NULL,
	lastUpdated datetime NOT NULL,
	Primary Key(BirthDayID)
);";

$createReminders="CREATE TABLE reminders (
	ReminderID int(255) NOT NULL auto_increment,
	Comment varchar(255) NOT NULL,
	Day int(2) NOT NULL,
	Month int(2) NOT NULL,
	Year int(4) NOT NULL,
	Occurrence int(3) NOT NULL,
	Times int(255) NOT NULL,
	lastUpdated datetime NOT NULL,
	Primary Key(ReminderID)
);";

$createPayments="CREATE TABLE payments (
	PaymentID int(255) NOT NULL auto_increment,
	Day int(2) NOT NULL,
	Month int(2) NOT NULL,
	Year int(4) NOT NULL,
	Amount decimal(10,2) NOT NULL,
	Type int(1) NOT NULL,
	Category int(255) NOT NULL,
	lastUpdated datetime NOT NULL,
	Primary Key(PaymentID)
);";

$createPaymentCategories="CREATE TABLE paymentCategories (
	PaymentCategoryID int(255) NOT NULL auto_increment,
	Name varchar(255) NOT NULL,
	lastUpdated datetime NOT NULL,
	Primary Key(PaymentCategoryID)
);";

$createWork="CREATE TABLE workDone (
	WorkID int(255) NOT NULL auto_increment,
	Day int(2) NOT NULL,
	Month int(2) NOT NULL,
	Year int(4) NOT NULL,
	CompanyID int(255) NOT NULL,
	Hours int(2) NOT NULL,
	Minutes int(2) NOT NULL,
	Wage decimal(10,2) NOT NULL,
	OvertimeHours int(2) NOT NULL,
	OvertimeMinutes int(2) NOT NULL,
	OvertimeWage decimal(10,2) NOT NULL,
	lastUpdated datetime NOT NULL,
	Primary Key(WorkID)
);";

$createCompany="CREATE TABLE company (
	CompanyID int(255) NOT NULL auto_increment,
	CompanyName varchar(255) NOT NULL,
	lastUpdated datetime NOT NULL,
	Primary Key(CompanyID)
);";

$createHoursTarget="CREATE TABLE hoursTarget (
	TargetID int(255) NOT NULL auto_increment,
	HoursTarget int(2) NOT NULL,
	MinutesTarget int(2) NOT NULL,
	Month int(2) NOT NULL,
	Year int(4) NOT NULL,
	lastUpdated datetime NOT NULL,
	Primary Key(TargetID)
);";

$createWageTarget="CREATE TABLE wageTarget (
	TargetID int(255) NOT NULL auto_increment,
	TotalTarget decimal(10,2) NOT NULL,
	Month int(2) NOT NULL,
	Year int(4) NOT NULL,
	lastUpdated datetime NOT NULL,
	Primary Key(TargetID)
);";
/*
mysqli_query($dbconnect, $createBirthDays);
mysqli_query($dbconnect, $createReminders);
mysqli_query($dbconnect, $createPayments);
mysqli_query($dbconnect, $createPaymentCategories);
mysqli_query($dbconnect, $createWork);
mysqli_query($dbconnect, $createCompany);
mysqli_query($dbconnect, $createHoursTarget);
mysqli_query($dbconnect, $createWageTarget);
*/
?>