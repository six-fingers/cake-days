# cake-days
PHP | Command Line Utility | Coding Challenge


### Requirements
In our company, we buy cake for each employee’s birthday.

We would like you to build, in PHP, a small command-line utility to enable us to keep track of this.

This utility should receive as an input a text file containing a list of employee dates of birth, in the following format with one entry per line:


[Person Name],[Date of Birth (yyyy-mm-dd)]

For example:
Steve,1992-10-14
Mary,1989-06-21

The utility should output a CSV file detailing the dates we have cake for the current year, in the following format:

Date, Number of Small Cakes, Number of Large Cakes, Names of people getting cake

“Cake Days” are calculated according to the following rules:

* A small cake is provided on the employee’s first working day after their birthday.
* All employees get their birthday off.
* The office is closed on weekends, Christmas Day, Boxing Day and New Year’s Day.
* If the office is closed on an employee’s birthday, they get the next working day off.
* If two or more cakes days coincide, we instead provide one large cake to share.
* If there is to be cake two days in a row, we instead provide one large cake on the second
day.
* For health reasons, the day after each cake must be cake-free. Any cakes due on a cake-free
day are postponed to the next working day.
* There is never more than one cake a day.

### Examples
* Dave’s date of birth is 13th June 1986. He gets a small cake on Monday 16th June 2025.
* Rob’s date of birth is 6th July 1950. He gets Monday off and a small cake on Tuesday 8th July 2025.
* Sam’s birthday is Monday 14th July and Kate’s is Tuesday 15th July. They share a large cake on
Wednesday 16th July 2025.
* Alex, Jen and Pete have birthdays on the 21st, 22nd and 23rd of July. Alex and Jen share a large
cake on Wednesday 23rd, Pete gets a small cake on Friday 25th.

### How to run

Run `composer install` to install the necessary packages and to generate the autoload file.

Basic usage is `php cake-days.php employees_dob.csv`

Test have been created for this to test the examples provided and more.

To run the test `composer test`