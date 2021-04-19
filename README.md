# Kerry's K9's
Here at Kerry's K9's, we like to give you, the customer the best experience we can. Therefore, please email us with any suggestions or improvements we can do for you!

## Admin Default Account
* Username: admin
* Password: AdminDefault123

*For first use please make a new account for yourself, mark the new account as an admin via the default admin account and delete the default admin account afterwards*

## Using the `dbconnect.php` file
In the circumstance of changing the host of where the website is hosted upon, it's important that the details inside of the `inc/dbconnect.php` is adapted to fit the new MySQLi Database Connection Information so that the site can connect to the database.

```php
$serverhost = "localhost";
$username = "u898383871_root";
$password = "DatabasePassword123!";
$dbname = "u898383871_uni";

$conn = mysqli_connect("$serverhost", "$username", "$password", "$dbname");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}
```
Ensure that the `$serverhost`, `$username`, `$password` and `$dbname` are changed to match the new host. In most circumstances `$serverhost` will usually remain as `localhost` however, some hosts may have you use a Host URL. If the database connection does fail to connect, contact your host provider.

If you're unsure whether or not the `dbconnect.php` file is working or not, go to your web browser and type in the location of the dbconnect.php file in your browser's URL bar, in this circumstance the current url is https://kerrysk9.xyz, to check if the file is connecting, go to https://kerrysk9.xyz/inc/dbconnect.php - if it comes with an error, it failed to connect to the database, if it's just a blank white page, the connection is successful.

## Re-installation Instructions
In order to re-install the website into working use, first of all you will want to download all the files of the website and upload them to your server. This will ensure that you have every single page necessary to run the website in fully working order. 

Next, you will want to import the sql file found in "SQL_imports" folder onto phpMyAdmin. Note this file only holds the structure of each table and not the data (excluding the forum category tables) and as a result you will need to re-register for your account and set your account as an admin.

## Setting your account as an admin manually on the database.
You can do this in one of two ways.

```
First method:
1. Click on SQL and type the following: (replace username_here with the username of your account)
    UPDATE `accounts` SET `admin_id` = '2' WHERE `username` = 'username_here'
 ```

```
Second method:
1. Click on the accounts table.
2. Find the username you want to make an admin.
3. Double click on the admin_id column on your username row
4. Change the value to 2 then press enter.
```

By following these instructions you **should** be able to fully re-install the website to your server.

## Contributors 
*_Name (GitHub Username)_*
* Nathan Watters *(Central120)*
* Shaun Lawlor *(shaunlawlor)*
* Shon Sunny *(shonsunny)*
* Matthew Celik *(matthewcelik)*
* Vitalijus Kasparavicius *(WhySoSerious4)*
