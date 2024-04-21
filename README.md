# Project Title

Music Library - COSC3380, Section: 12651, Team 11

# Introduction

This project is music library web application capable of storing, organizing, and playing songs via a web interface. This platform allows Users to listen and rate songs, add songs to playlists, and follow artist. This platform allows Artist to upload their music and make it readily available to users, search songs, create playlist and listen to music. Finally, this platform allows Admin roles the ability to do what a user does but also can generate reports to show progress about how the application is running and important business statistics.

Users are clasified under 3 roles: User, Artist, Admin. Each role has its privileges and limitations.


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
By default, A user can be created without permission by filling the form in index.php

## Dependencies
  
* PHP 8.1
* MySQL 5.7
* moment JS
* Materialize CSS
* Google Fonts

## Technologies used

* PHP
* MySQL
* HTML, CSS, JavaScript

# Deployment
* http://bfh.gheron.com/

# Contributors

* Carolyn Heron
* Madison Emshousen
* Larry Nguyen
