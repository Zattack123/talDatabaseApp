# TAL Database Web Application

This is a web application used to interface with the TAL Database, created by Zach Dilliha for CS-351 Database Management Systems I

## Requirements

This application requires access and familiartity with phpmyadmin through [XAMPP](https://www.apachefriends.org/index.html) or a similar app.

## Installation

To install, place the talDatabaseApp folder in your xampp/htdocs folder, or the equivalent to whatever app you use, then import tal.sql into your phpmyadmin. To start, run localhost/talDatabaseApp/php/index.php , [(this)](http://localhost/talDatabaseApp/php/index.php).
## Usage

The interface is simple and easy to understand. When first installing the application, it will start you on the login screen.
Each representative has their own login, which is their first name and last name concatenated, and their password is their City, each are case sensitive, like so:

Username: FirstNameLastName

Password: City

There is also a general Admin account, with Username and Password both: admin

When logged in, the user has access to 4 operations, they can add a new Representative, update the Credit Limit of a Customer, view a report that lists the number of customers each Representative has as well as the average balance of their customers, and view a report that displays the Total Quoted Price of all the orders a given Customer has.

There is also a button in the Header for going back to the home page, as well as to logout.

Error reporting is done in the url. If something does not work, check the url and the type of error will be listed there, so you can fix accordingly. If it is an sql error, please check your connection to phpmyadmin. Restarting Apache and MySQL could help.
