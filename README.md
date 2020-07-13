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
