# Project Title

Music Library - COSC3380, Section: 12651, Team 11

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
2. Use the provided SQL dump of the populated database which is located in SQL/music_library.sql
3. Change the Database credentials in the file /model/db.php to the new MySQL credentials on your server
```
public function __construct() {
    $dbhost = 'your-mysql-server';
    $dbuser = 'your_database_user';
    $dbpass = 'your_database_password';
    $dbname = 'your_database_name';
    $charset = 'utf8';
}
```
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

* Search For Songs available for All Roles where every role can search for any particular song by title, artist, or genre and be able to play that song or even add it to a playlist. 

* Artist Albums available for Artist Role so that Artists are able to access their own albums and change it to how they see fit such as being able to add or delete albums, change what songs are part of the album's track list or even change other aspects of the albums such as their title, release date, cover, and format. 
  
* Artist Songs are available for Artist Role in order for Artists to manage their own songss in the Music Library such as being able to manage what albums their songs go to, delete or add songs, or change something else about their song such as the title, audio file, or genre. 
  
* All Users Report with search filters available for Admin Role where there's multiple purposes of the Users Report. The first purpose is to get better insight onto the demographic of the music library
  by being able to see each user's most played songs and genres and being able to use the region and gender filters to see any connections. The 2nd purpose is to be able to keep track of when a new account is created especially if the account is an Admin/Artist role. And we can use the user-role filters to mainly keep track of artists and admins along with the start and end date filters. Albeit able to filter to users only is nice for the first purpose.   

* Artist Report available for Admin Role where the Artist Report displays the activities of every Artist in the music app ranging from their Latest Album release to the amount of songs/albums they made and their most prominent genre for their songs. There's the artist filter to see specifically an artist and their activites. There's also genres filters to see information of artists who are primarily associated with that genre. And there's also the start and end date filters to analysze artists who made albums during a specific time period. Also be aware that if an artist has N/A for primary genres/ or (MMM, dd, yyyy) for recent alum release, they haven't released albums/songs yet.
  
* Songs Report wiith filters are available for Admin Role so that Admins can get better insight into the popularity of songs such as the amount of listens, the amount of user playlists the songs are a part of, and the rating that the songs have. Admins can also look at the song's popularity among certain groups of people by showing gender preferences and the region where the song is most popular in. There are the Artist, and Genre filters to see if there's more correlations involved in a song's popularity. And there's the filter for ratings to see which songs are most popular.
  
* Album Reports with filters are available for Admin Role to see information about the albums such as the Artist, Ratings, Total amount of listens within the songs of the albums, and the format the Album is in.
The data report can also be filtered by artists to get better statistical analyst of an artist. There's also the format filter in order to be able to compare albums of the same format. Then there's the dates filters and the ratings filter to better see correlations of an album's popularity. 

# Deployment
* http://bfh.gheron.com/

# Contributors

* Carolyn Heron
* Madison Emshousen
* Larry Nguyen
