DROP TABLE IF EXISTS `accounts`;
CREATE TABLE `accounts` (
  `user_id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `user_role` ENUM('User', 'Artist', 'Admin') NOT NULL DEFAULT 'User',
  `name` VARCHAR(255) NOT NULL,
  `bio` TEXT,
  `gender` TINYINT,
  `DOB` DATE,
  `region` VARCHAR(255),
  `email` VARCHAR(255) UNIQUE NOT NULL,
  `password` VARCHAR(255) NOT NULL
);

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `user_id` INT UNSIGNED NOT NULL,
  `audit_trail` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `fk_admins_accounts` FOREIGN KEY (`user_id`) REFERENCES `accounts` (`user_id`)
);

DROP TABLE IF EXISTS `artists`;
CREATE TABLE `artists` (
  `user_id` INT UNSIGNED NOT NULL,
  `listens` INT UNSIGNED,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `fk_artists_accounts` FOREIGN KEY (`user_id`) REFERENCES `accounts` (`user_id`)
);

DROP TABLE IF EXISTS `genres`;
CREATE TABLE `genres` (
  `genre_id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255),
  `description` TEXT
);

DROP TABLE IF EXISTS `record_labels`;
CREATE TABLE `record_labels` (
  `record_label_id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `description` TEXT NOT NULL
);

DROP TABLE IF EXISTS `albums`;
CREATE TABLE `albums` (
  `album_id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL DEFAULT "Untitled Album",
  `format` ENUM('Album', 'Single', 'EP', 'LP', 'SP'),
  `release_date` DATE,
  `rating` INT,
  `artist_id` INT UNSIGNED,
  `record_label_id` INT UNSIGNED,
  --new song keys
  `song_id_1` INT UNSIGNED,
  `song_id_2` INT UNSIGNED,
  `song_id_3` INT UNSIGNED,
  `song_id_4` INT UNSIGNED,
  `song_id_5` INT UNSIGNED,
  `song_id_6` INT UNSIGNED,
  `song_id_7` INT UNSIGNED,
  `song_id_8` INT UNSIGNED,
  `song_id_9` INT UNSIGNED,
  `song_id_10` INT UNSIGNED,
  CONSTRAINT `fk_albums_artists` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`user_id`),
  CONSTRAINT `fk_albums_record_labels` FOREIGN KEY (`record_label_id`) REFERENCES `record_labels` (`record_label_id`)
  --new constraints
  CONSTRAINT `fk_albums_songs_1` FOREIGN KEY (`song_id_1`) REFERENCES `songs` (`song_id`),
  CONSTRAINT `fk_albums_songs_2` FOREIGN KEY (`song_id_2`) REFERENCES `songs` (`song_id`),
  CONSTRAINT `fk_albums_songs_3` FOREIGN KEY (`song_id_3`) REFERENCES `songs` (`song_id`),
  CONSTRAINT `fk_albums_songs_4` FOREIGN KEY (`song_id_4`) REFERENCES `songs` (`song_id`),
  CONSTRAINT `fk_albums_songs_5` FOREIGN KEY (`song_id_5`) REFERENCES `songs` (`song_id`),
  CONSTRAINT `fk_albums_songs_6` FOREIGN KEY (`song_id_6`) REFERENCES `songs` (`song_id`),
  CONSTRAINT `fk_albums_songs_7` FOREIGN KEY (`song_id_7`) REFERENCES `songs` (`song_id`),
  CONSTRAINT `fk_albums_songs_8` FOREIGN KEY (`song_id_8`) REFERENCES `songs` (`song_id`),
  CONSTRAINT `fk_albums_songs_9` FOREIGN KEY (`song_id_9`) REFERENCES `songs` (`song_id`),
  CONSTRAINT `fk_albums_songs_10` FOREIGN KEY (`song_id_10`) REFERENCES `songs` (`song_id`)
);

DROP TABLE IF EXISTS `songs`;
CREATE TABLE `songs` (
  `song_id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL DEFAULT "Untitled Song",
  `audio_format` ENUM('MP3', 'M4A', 'WAV') NOT NULL,
  `duration` INT,
  `listens` INT,
  `rating` INT,
  `album_id` INT UNSIGNED,
  `genre_id` INT UNSIGNED,
  CONSTRAINT `fk_songs_albums` FOREIGN KEY (`album_id`) REFERENCES `albums` (`album_id`),
  CONSTRAINT `fk_songs_genre` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`genre_id`)
);

DROP TABLE IF EXISTS `song_associations`;
CREATE TABLE `song_associations` (
  `song_association_id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `song_id` INT UNSIGNED,
  `artist_id` INT UNSIGNED,
  CONSTRAINT `fk_song_associations_song` FOREIGN KEY (`song_id`) REFERENCES `songs` (`song_id`),
  CONSTRAINT `fk_song_associations_artist` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`user_id`)
);

DROP TABLE IF EXISTS `playlists`;
CREATE TABLE `playlists` (
  `playlist_id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT UNSIGNED,
  `title` VARCHAR(255) DEFAULT "Unititled Playlist",
  --new song keys
  `song_id_1` INT UNSIGNED,
  `song_id_2` INT UNSIGNED,
  `song_id_3` INT UNSIGNED,
  `song_id_4` INT UNSIGNED,
  `song_id_5` INT UNSIGNED,
  `song_id_6` INT UNSIGNED,
  `song_id_7` INT UNSIGNED,
  `song_id_8` INT UNSIGNED,
  `song_id_9` INT UNSIGNED,
  `song_id_10` INT UNSIGNED,
  CONSTRAINT `fk_playlists_accounts` FOREIGN KEY (`user_id`) REFERENCES `accounts` (`user_id`)
  --new constraints
  CONSTRAINT `fk_playlists_songs_1` FOREIGN KEY (`song_id_1`) REFERENCES `songs` (`song_id`),
  CONSTRAINT `fk_playlists_songs_2` FOREIGN KEY (`song_id_2`) REFERENCES `songs` (`song_id`),
  CONSTRAINT `fk_playlists_songs_3` FOREIGN KEY (`song_id_3`) REFERENCES `songs` (`song_id`),
  CONSTRAINT `fk_playlists_songs_4` FOREIGN KEY (`song_id_4`) REFERENCES `songs` (`song_id`),
  CONSTRAINT `fk_playlists_songs_5` FOREIGN KEY (`song_id_5`) REFERENCES `songs` (`song_id`),
  CONSTRAINT `fk_playlists_songs_6` FOREIGN KEY (`song_id_6`) REFERENCES `songs` (`song_id`),
  CONSTRAINT `fk_playlists_songs_7` FOREIGN KEY (`song_id_7`) REFERENCES `songs` (`song_id`),
  CONSTRAINT `fk_playlists_songs_8` FOREIGN KEY (`song_id_8`) REFERENCES `songs` (`song_id`),
  CONSTRAINT `fk_playlists_songs_9` FOREIGN KEY (`song_id_9`) REFERENCES `songs` (`song_id`),
  CONSTRAINT `fk_playlists_songs_10` FOREIGN KEY (`song_id_10`) REFERENCES `songs` (`song_id`)
);

-- DROP TABLE IF EXISTS `playlist_songs`;
-- CREATE TABLE `playlist_songs` (
--   `playlist_id` INT UNSIGNED,
--   `song_id` INT UNSIGNED,
--   `order` INT,
--   PRIMARY KEY (`playlist_id`, `song_id`),
--   CONSTRAINT `fk_playlist_songs_playlists` FOREIGN KEY (`playlist_id`) REFERENCES `playlists` (`playlist_id`),
--   CONSTRAINT `fk_playlist_songs_songs` FOREIGN KEY (`song_id`) REFERENCES `songs` (`song_id`)
-- );

DROP TABLE IF EXISTS `subscription_plans`;
CREATE TABLE `subscription_plans` (
  `subscription_plan_id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `subscription_plan_type` ENUM('Free', 'Individual', 'Student') DEFAULT 'Free',
  `description` TEXT,
  `term_length` INT DEFAULT 0,
  `price` FLOAT DEFAULT 0
);

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions` (
  `transaction_id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `payment_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `payment_source` VARCHAR(16) NOT NULL,
  `total` FLOAT NOT NULL,
  `user_id` INT UNSIGNED,
  `subscription_plan_id` INT UNSIGNED,
  CONSTRAINT `fk_transactions_accounts` FOREIGN KEY (`user_id`) REFERENCES `accounts` (`user_id`),
  CONSTRAINT `fk_transactions_subscription_plans` FOREIGN KEY (`subscription_plan_id`) REFERENCES `subscription_plans` (`subscription_plan_id`)
);
