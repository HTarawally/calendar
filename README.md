# Calendar

<p align="center">
  <img src="../media/app_screenshot.png?raw=true" width="500" />
</p>

## About

A simple organiser system used to track birthdays, reminders, income & expenditure, and work hours & expected pay, all wrapped up in a simple calendar format.

## Requirements

PHP version 5.0.0+, compiled with support for the MySQLi extension will be
needed to run the project. MySQL version 4.1.13 or newer is also needed.

As for front-end requirements, any modern browser with JavaScript enabled
will do, including Internet Explore 8+.

## Installation

Clone this repository and upload the contents of the calendar-v2 folder to your web root.

Open the includes/config.php file with a text editor of your choice.

<img src="../media/config_php_top_screenshot.png?raw=true" width="500" />

Search for `define("DBHOST", "localhost");` and edit this line and three lines
that follow to complete the database details setup. Make sure that these details
are correct and the database has already been created in MySQL before proceeding.

Now scroll down to the bottom of the page and uncomment the lines that are
commented out.

<img src="../media/config_php_bottom_screenshot.png?raw=true" width="500" />

Open a web browser and visit the url you uploaded the project to complete the
database setup. Return back to your code edit and comment out the code you
previously uncommented out and you are ready to go.

## Usage

Visiting the home route of the project brings you into the calendar view of
the current year.

<img />

From here, clicking on the "Next Year" and "Previous Year" buttons on the top
banner will navigate through the years of the calendar.

### Adding content

For the real fun, click on month or day value on the calendar to be brought to
a view of that month or day. From there, you can begin to add content to the
calendar.

<img />

The simplest content to add is a birthday reminder. Click on the "Add Birthday"
button to add a birthday. You are then able to enter the person's name and
their day and month of birth.

<img />

The next simplest to add would be a generic reminder. Click on the "Set Reminder"
button to add a generic reminder. You are then able to enter the reminder comment,
the date of the reminder, how often this reminder should occur and optionally
how many times this reminder should be repeated.

<img />

Adding a payment is a little bit more involved. Click on the "Add Payment"
button to add a payment. You are able to enter the payment date, amount, whether
it was spent or received, and the category this payment belongs to.

You can only select a payment category after you have added it already, via the
"Add Payment Category" form displayed below the "Add Payment" form.

<img />

Adding work done is similar. Click on the "Add Work" button to enter the
date, the company, the number of hours worked and pay per hour, and optionally
any overtime work and wage.

You can only select a company after you have added it already, via the
"Add Company" form displayed below the "Add Work Done" form.

<img />

You can also add hours worked and wage earned targets for a specific month by
clicking on the "Add Target" or "Add Wage Target" buttons respectively and
filling in the forms.

<img />

<img />
