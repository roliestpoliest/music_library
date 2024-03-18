DROP TABLE IF EXISTS `accounts`;

CREATE TABLE
  `accounts` (
    `account_id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `user_role` ENUM ('User', 'Artist', 'Admin') NOT NULL,
    `fname` VARCHAR(255) NOT NULL,
    `lname` VARCHAR(255) NOT NULL,
    `username` VARCHAR(255) UNIQUE NOT NULL,
    `bio` TEXT,
    `gender` CHAR,
    `DOB` DATE,
    `region` VARCHAR(255),
    `email` VARCHAR(255) UNIQUE NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `image_path` VARCHAR(255)
  );

DROP DATABASE IF EXISTS `token_storage`;

CREATE TABLE
  `token_storage` (
    account_id INT UNSIGNED PRIMARY KEY,
    token VARCHAR(555) NOT NULL,
    createdDate VARCHAR(255) NOT NULL,
    CONSTRAINT `fk_token_storage_accounts` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`)
  );

DROP TABLE IF EXISTS `admins`;

CREATE TABLE
  `admins` (
    `admin_id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `account_id` INT UNSIGNED NOT NULL,
    CONSTRAINT `fk_admins_accounts` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`)
  );

DROP TABLE IF EXISTS `artists`;

CREATE TABLE
  `artists` (
    `artist_id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `account_id` INT UNSIGNED NOT NULL,
    CONSTRAINT `fk_artists_accounts` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`)
  );

DROP TABLE IF EXISTS `events`;

CREATE TABLE
  `events` (
    `event_id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255) NOT NULL,
    `description` TEXT,
    `date` DATE NOT NULL,
    `start_time` TIME NOT NULL,
    `end_time` TIME NOT NULL,
    `region` VARCHAR(255) NOT NULL,
    `artist_id` INT UNSIGNED NOT NULL,
    `image_path` VARCHAR(255) NOT NULL,
    CONSTRAINT `fk_events_artists` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`artist_id`)
  );

DROP TABLE IF EXISTS `genres`;

CREATE TABLE
  `genres` (
    `genre_id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255) NOT NULL
  );

DROP TABLE IF EXISTS `songs`;

CREATE TABLE
  `songs` (
    `song_id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `artist_id` INT UNSIGNED,
    `title` VARCHAR(255) DEFAULT "Untitled Song",
    `duration` INT,
    `listens` INT,
    `rating` INT CHECK (
      rating >= 0
      AND rating <= 5
    ),
    `genre_id` INT UNSIGNED,
    `audio_path` VARCHAR(255) NOT NULL,
    CONSTRAINT `fk_songs_genre` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`genre_id`),
    CONSTRAINT `fk_songs_artists` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`artist_id`)
  );

DROP TABLE IF EXISTS `albums`;

CREATE TABLE
  `albums` (
    `album_id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `record_label` VARCHAR(255),
    `artist_id` INT UNSIGNED,
    `title` VARCHAR(255) DEFAULT "Untitled Album",
    `format` ENUM ('Album', 'Single', 'EP', 'LP', 'SP') NOT NULL,
    `release_date` DATE,
    `rating` INT CHECK (
      rating >= 0
      AND rating <= 5
    ),
    `image_path` VARCHAR(255),
    CONSTRAINT `fk_albums_artists` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`artist_id`)
  );

DROP TABLE IF EXISTS `songs_in_album`;

CREATE TABLE
  `songs_in_album` (
    `song_id` INT UNSIGNED,
    `album_id` INT UNSIGNED,
    PRIMARY KEY (`song_id`, `album_id`),
    CONSTRAINT `fk_songs_in_album_song` FOREIGN KEY (`song_id`) REFERENCES `songs` (`song_id`),
    CONSTRAINT `fk_songs_in_album_album` FOREIGN KEY (`album_id`) REFERENCES `albums` (`album_id`)
  );

DROP TABLE IF EXISTS `followed_artists`;

CREATE TABLE
  `followed_artists` (
    `account_id` INT UNSIGNED,
    `artist_id` INT UNSIGNED,
    PRIMARY KEY (`account_id`, `artist_id`),
    CONSTRAINT `fk_followed_artists_accounts` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`),
    CONSTRAINT `fk_followed_artists_artists` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`account_id`)
  );

DROP TABLE IF EXISTS `playlists`;

CREATE TABLE
  `playlists` (
    `playlist_id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `account_id` INT UNSIGNED,
    `title` VARCHAR(255) DEFAULT "Unititled Playlist",
    `image_path` VARCHAR(255),
    CONSTRAINT `fk_playlists_accounts` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`)
  );

DROP TABLE IF EXISTS `songs_in_playlist`;

CREATE TABLE
  `songs_in_playlist` (
    `song_id` INT UNSIGNED,
    `playlist_id` INT UNSIGNED,
    PRIMARY KEY (`song_id`, `playlist_id`),
    CONSTRAINT `fk_songs_in_playlist_song` FOREIGN KEY (`song_id`) REFERENCES `songs` (`song_id`),
    CONSTRAINT `fk_songs_in_playlist_playlist` FOREIGN KEY (`playlist_id`) REFERENCES `playlists` (`playlist_id`)
  );

DROP TABLE IF EXISTS `subscriptions`;

CREATE TABLE
  `subscriptions` (
    `subscription_id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `start_date` TIMESTAMP NOT NULL,
    `end_date` TIMESTAMP NOT NULL,
    `account_id` INT UNSIGNED,
    `description` TEXT,
    CONSTRAINT `fk_subscriptions_accounts` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`)
  );

DROP TABLE IF EXISTS `transactions`;

CREATE TABLE
  `transactions` (
    `transaction_id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `account_id` INT UNSIGNED,
    `payment_date` TIMESTAMP NOT NULL,
    `payment_source` VARCHAR(16) NOT NULL,
    `total` FLOAT NOT NULL,
    CONSTRAINT `fk_transactions_accounts` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`)
  );