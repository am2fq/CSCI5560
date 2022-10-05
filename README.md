# CSCI5560

## Group members:

Matthew Radice

Adel

Christine

Zernab

## Purpose:

Purpose of project.

## TL;DR:

To run this code you will need...

1. Download Telegram application in your laptop or mobile.

2. Open Telegram and create an account. Go to the search bar and search for @adelmtsubot. You will see "Adel mtsu" in the result.

3. Select "Adel mtsu" and push "start" at the bottom to opt in to our system. This means that you are giving your consent to the bot send messages to you.

4. Install mysql
```
https://dev.mysql.com/downloads/mysql/
```

5. Login to mysql server and run Project_db.sql script.
This will create a database named as project and all the required tables for the application.

6. Install Xampp server.
```
https://www.apachefriends.org/download.html
```

7. After installing, open xampp and click the 'Start' button under 'Actions' aside to Apache. This will turn on webserver in your machine.

8. Paste the folder from github named "AD" inside htdocs under xampp directory. Typically this will be in "C:\xampp\htdocs"

9. Open config.php under AD folder and replace with your server credentials. This a very small file with 3 lines and holds:
```
$mysqlhost=<your server name>;
$user=<username>;
$password=<password>;
```

10. Now as mysql and webserver is running and you have the php program in htdocs folder, Execute below url in browser.
```
http://localhost/AD/update_chatid.php
```

This program will go into database and scan for all the users whose chat_id is not yet updated. It will then inturn
go to Telegram BOT, collect the chat_ids and update the database accordingly.


Checking:
As we are in process to build a front end, if you want to check if everything is working as of now please follow below steps.
1. Go to mysql server and paste the mysql cmd given below. Replace first two fields i.e. 'Name' and '615----' with your name and phone number that you used to create Telegram account.
insert into project.users values('Name','615----',NULL,'testapp','testgroup');
Note: This testapp and testgroup is already created for you when running the Project_db.sql script.
2. Go to browser and hit the url to scan for your id.
```
http://localhost/AD/update_chatid.php
```

3. Go back to mysql server and paste the below cmd to check if your chat id is populated.
select * from project.users;
