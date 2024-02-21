CREATE TABLE `users` (
  `user_id` SERIAL PRIMARY KEY,
  `user_role` ENUM ('User', 'Artist', 'Admin'),
  `name` VARCHAR(255),
  `bio` TEXT,
  `age` INT,
  `gender` INT,
  `DOB` DATE,
  `country` Countries,
  `region` Regions,
  `email` VARCHAR(255) UNIQUE,
  `password` VARCHAR(255)
);

CREATE TABLE `artists` (
  `user_id` INT PRIMARY KEY,
  `listens` INT
);

CREATE TABLE `admins` (
  `user_id` INT PRIMARY KEY,
  `projects` VARCHAR
);

CREATE TABLE `record_labels` (
  `record_label_id` SERIAL PRIMARY KEY,
  `name` VARCHAR(255),
  `description` TEXT
);

CREATE TABLE `albums` (
  `album_id` SERIAL PRIMARY KEY,
  `title` VARCHAR(255),
  `format` ENUM ('Album', 'Single', 'EP', 'LP', 'SP'),
  `release_date` DATE,
  `rating` INT,
  `artist_id` INT,
  `record_label_id` INT
);

CREATE TABLE `songs` (
  `song_id` SERIAL PRIMARY KEY,
  `title` VARCHAR(255),
  `audio_format` ENUM ('MP3', 'M4A', 'WAV'),
  `duration` INT,
  `listens` INT,
  `rating` INT,
  `album_id` INT
);

CREATE TABLE `song_artists` (
  `song_artist_id` SERIAL PRIMARY KEY,
  `song_id` INT,
  `artist_id` INT
);

CREATE TABLE `genres` (
  `genre_id` SERIAL PRIMARY KEY,
  `title` VARCHAR(255),
  `description` TEXT
);

CREATE TABLE `song_genres` (
  `song_genre_id` SERIAL PRIMARY KEY,
  `song_id` INT,
  `genre_id` INT
);

CREATE TABLE `subscription_plans` (
  `subscription_plan_id` SERIAL PRIMARY KEY,
  `subscription_plan_type` ENUM ('Free', 'Individual', 'Student'),
  `description` TEXT,
  `term_length` INT,
  `price` FLOAT
);

CREATE TABLE `playlists` (
  `playlist_id` SERIAL PRIMARY KEY,
  `user_id` INT,
  `title` VARCHAR(255)
);

CREATE TABLE `playlist_songs` (
  `playlist_id` INT,
  `song_id` INT,
  `order` INT UNIQUE,
  PRIMARY KEY (`playlist_id`, `song_id`)
);

CREATE TABLE `listening_histories` (
  `listening_history_id` SERIAL PRIMARY KEY,
  `timestamp` TIMESTAMP,
  `user_id` INT,
  `song_id` INT
);

CREATE TABLE `transactions` (
  `transaction_id` SERIAL PRIMARY KEY,
  `payment_date` TIMESTAMP,
  `payment_source` INT,
  `total` FLOAT,
  `user_id` INT,
  `subscription_plan_id` INT
);

ALTER TABLE `users` ADD FOREIGN KEY (`user_id`) REFERENCES `artists` (`user_id`);

ALTER TABLE `users` ADD FOREIGN KEY (`user_id`) REFERENCES `albums` (`artist_id`);

ALTER TABLE `record_labels` ADD FOREIGN KEY (`record_label_id`) REFERENCES `albums` (`record_label_id`);

ALTER TABLE `albums` ADD FOREIGN KEY (`album_id`) REFERENCES `songs` (`album_id`);

ALTER TABLE `songs` ADD FOREIGN KEY (`song_id`) REFERENCES `song_artists` (`song_id`);

ALTER TABLE `users` ADD FOREIGN KEY (`user_id`) REFERENCES `song_artists` (`artist_id`);

ALTER TABLE `songs` ADD FOREIGN KEY (`song_id`) REFERENCES `song_genres` (`song_id`);

ALTER TABLE `genres` ADD FOREIGN KEY (`genre_id`) REFERENCES `song_genres` (`genre_id`);

ALTER TABLE `users` ADD FOREIGN KEY (`user_id`) REFERENCES `playlists` (`user_id`);

ALTER TABLE `playlists` ADD FOREIGN KEY (`playlist_id`) REFERENCES `playlist_songs` (`playlist_id`);

ALTER TABLE `songs` ADD FOREIGN KEY (`song_id`) REFERENCES `playlist_songs` (`song_id`);

ALTER TABLE `users` ADD FOREIGN KEY (`user_id`) REFERENCES `listening_histories` (`user_id`);

ALTER TABLE `songs` ADD FOREIGN KEY (`song_id`) REFERENCES `listening_histories` (`song_id`);

ALTER TABLE `users` ADD FOREIGN KEY (`user_id`) REFERENCES `transactions` (`user_id`);

ALTER TABLE `subscription_plans` ADD FOREIGN KEY (`subscription_plan_id`) REFERENCES `transactions` (`subscription_plan_id`);

ALTER TABLE `admins` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
