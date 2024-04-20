# Project Title

Music Library

# Introduction

This project is music library web application capable of storing, organizing, and playing songs via a web interface. This platform allows Users to listen and rate songs, add songs to playlists, and follow artist. This platform allows Artist to upload their music and make it readily available to users, search songs, create playlist and listen to music. Finally, this platform allows Admin roles the ability to do what a user does but also can generate reports to show progress about how the application is running and important business statistics.

Users are clasified under 3 roles: User, Artist, Admin. Each role has its privileges and limitations.

* User
  * Search songs
  * Create playlist and add music to them
  * Rate Songs
  * Rate Albums
  * Listen to music
  * Login as:
    * username: bobby
    * password: 123456
* Artist
  * Everything under the "User" role plus
  * Upload Songs
  * Create Albums under you artist name
  * Organize songs into albums
  * Login as:
    * username: andybird
    * password: 123456
* Admin
    * Everithing under the "User" and "Artist" roles plus
    * View Reports
    * Login as:
      * username: lucas
      * password: 123456

# Getting Started

## Installation Requirements

* PHP 8.2
* MySQL 5.7

## Installation process

1. Upload Repository to the public root of the server. There is no need to compile.
2. Use the provided SQL dump to create the database
3. Change the Database credentials in the file /model/db.php to the new MySQL credentials on your server

        'public function __construct() {
            $dbhost = 'your-mysql-server';
            $dbuser = 'your_database_user';
            $dbpass = 'your_database_password';
            $dbname = 'your_database_name';
            $charset = 'utf8';'

4. By default, A user can be created without permission by filling the form in index.php

## Dependencies
  
* PHP 8.1
* MySQL 5.7
* moment JS
* Materialize CSS
* Google Fonts

# Project Document

## Types of data that can be added, modified, and deleted

* Albums
* Songs
* Accounts
* Playlists

## Types of user roles in your application

* User
* Artist
* Admin

## The semantic constraints which are implemented as triggers

1. Notify Artist when a user starts following
```sql
INSERT INTO notifications (account_id, message)
VALUES
((SELECT ar.account_id FROM artists AS ar 
WHERE ar.artist_id = NEW.artist_id),

(SELECT
CONCAT(ac.fname, ' ', ac.lname, ' has started following you!')
FROM accounts AS ac
  WHERE ac.account_id = NEW.account_id))
```

2. Send welcome message after creating account
```sql
CREATE TRIGGER send_welcome_message
AFTER INSERT ON accounts FOR EACH ROW
    BEGIN
    INSERT INTO notifications (account_id, message)
    VALUES
    (NEW.account_id, ' Welcome to our music library!')
    END;
```

3. when a song reaches 10 plays send notification to artist
```sql
BEGIN
    IF OLD.listens = 10 THEN
        INSERT INTO notifications (account_id, message)
        VALUES (
            (SELECT ar.account_id FROM artists AS ar WHERE ar.artist_id = OLD.artist_id),
            CONCAT('Your song ', OLD.title, ' just reached 10 listens!')
        );
        UPDATE accounts SET new_notifications = new_notifications + 1
        WHERE account_id = (SELECT ar.account_id FROM artists AS ar 
        WHERE ar.artist_id = OLD.artist_id);
    END IF;
END
```
## Types of queries in your application

* SQL Queries via RESTFul API 
* Javascript Queries for sorting an organizing data without having to perform another HTTP Request

## Reports available in your application.

* Search For Songs _available for All Roles_
* Artist Albums _available for Artist Role_
* Artist Songs _available for Artist Role_
* All Users Report with search filters _available for Admin Role_
* Artist Report _available for Admin Role_
* Songs Report wiith filters  _available for Admin Role_
* Album Reports with filters _available for Admin Role_

# Deployment
* http://bfh.gheron.com/

# Contributors

* Carolyn Heron
* Madison Emshousen
* Larry Nguyen
