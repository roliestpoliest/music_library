# Project Title

Music Library

# Introduction

This project is music library music library web applications capable of storing, organizing, and playing songs via web interface. I this platform Users can upload their music and make it readyly available to users, search songs, create playlist and listen to music.

Users are clasified under 3 roles: User, Artist, Admin. Each role has its preveligies and limitations.

* User
  * Search songs
  * Create playlist
  * Rate Songs
  * Rate Albums
  * Listen to music
* Artist
  * Everithing under the "User" role plus
  * Upload Songs
  * Create Albums under you artist name
  * Organize songs into albums
* Admin
    * Everithing under the "User" role plus
    * View Reports

# Getting Started

## Installation Requirements

* PHP 8.2
* MySQL 5.7

## Installation process

1. Upload Repository to the public root of the server. There is no need to compile.
2. Use the privided SQL dump to create the database
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
* AngularJS
* moment JS
* Materialize CSS
* Google Fonts

# Project Document

## Types of data that can be added, modified, and edited

## Types of user roles in your application

* User
* Artist
* Admin

## The semantic constraints which are implemented as triggers

1. Update monthly play count after a song is played

        CREATE TRIGGER Calc_Recent_Ratings
          AFTER INSERT ON song_play_count FOR EACH ROW 
          BEGIN
          UPDATE songs c 
          SET `listens` = (
          SELECT COUNT(1) FROM `song_play_count` AS s
              WHERE s.event_time <= LAST_DAY(CURRENT_TIMESTAMP)
              AND s.event_time >= CAST(DATE_FORMAT(NOW() ,'%Y-%m-01') as DATE)
              AND s.song_id = NEW.song_id)
          WHERE c.song_id = NEW.song_id
          END;

2. Create Artitst relationship when new account is created with an Artist role

          CREATE TRIGGER `add_account_to_artists`
          AFTER INSERT ON `accounts`
          FOR EACH ROW
          BEGIN
              IF NEW.user_role = 'Artist' THEN
                  INSERT INTO `artists` (`account_id`)
                  VALUES (NEW.account_id);
              END IF;
          END

3. Create Admin relationship when new account is created with an Admin role

          CREATE TRIGGER `add_account_to_admins`
          AFTER INSERT ON `accounts`
          FOR EACH ROW
          BEGIN
              IF NEW.user_role = 'Admin' THEN
                  INSERT INTO `admins` (`account_id`)
                  VALUES (NEW.account_id);
              END IF;
          END

4. Automatically increse the number of follower when a user follows an artist

          CREATE TRIGGER increase_follower_count
              AFTER INSERT ON followed_artists FOR EACH ROW
              BEGIN
              UPDATE artists a
              SET a.followers = a.followers + 1
              WHERE a.artist_id = NEW.artist_id
              END;

f. Automatically decrese the number of follower when a user follows an artist

          CREATE TRIGGER reduce_follower_count
              AFTER DELETE ON followed_artists FOR EACH ROW
              BEGIN
              UPDATE artists a
              SET a.followers = a.followers - 1
              WHERE a.artist_id = OLD.artist_id
              END;

## Types of queries in your application

* SQL Queries via RESTFul API 
* Javascript Queries for sorting an organizing data without having to perform another HTTP Request

## Reports available in your application.

* Search For Songs _abailable for All Roles_
* Artist Albums _abailable for Artist Role_
* Artist Songs _abailable for Artist Role_
* All Users Report with search filters _abailable for Admin Role_
* Artist Report _abailable for Admin Role_
* Songs Report wiith filters  _abailable for Admin Role_
* Album Reports with filters _abailable for Admin Role_

# Contribute

This is a private project and only members of the team ca contribute .
