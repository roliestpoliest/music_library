-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 08, 2024 at 02:37 AM
-- Server version: 5.7.39
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `music_library`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `account_id` int(10) UNSIGNED NOT NULL,
  `user_role` enum('User','Artist','Admin') NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `bio` text,
  `gender` char(1) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_id`, `user_role`, `fname`, `lname`, `username`, `bio`, `gender`, `DOB`, `region`, `email`, `password`, `image_path`) VALUES
(1, 'Artist', 'Mr. Beast', 'LOL', 'lol', 'I didn\'t know laughter until I heard about City Pop', 'M', '2005-04-08', 'Foreing', 'beat@boot.com', '123456', '1712541928NowShowing-A4-210x222.jpg'),
(2, 'Artist', 'Lucas', 'Comegalletas', 'lucas', 'I like cookies', 'M', '2024-03-04', 'SW', 'lucas@boing.com', '123456', NULL),
(3, 'Artist', 'Mikie', 'Jackson', 'ff', 'oj jduiygsd d', 'O', '2024-03-06', 'SW', 'llkjd@kjjhf.cc', '123456', NULL),
(4, 'Artist', 'Winnie', 'Poo', 'poo', 'poo', 'M', '2024-03-04', NULL, 'Comp#re.com', '123456', 'Buzz.jpg'),
(9, 'Artist', 'asdasd', 'dsdf', 'asdfaa', 'casdca', 'O', '2024-03-05', 'SE', 'dsacs@ed.cc', '123456', NULL),
(10, 'Artist', 'coco', 'loco', 'coco', 'loco bolo coco', 'F', '2024-03-07', 'MW', 'pet@oo.com', '123456', NULL),
(11, 'Artist', 'asda', 'axasxa', 'asxasxas', 'asxasx', 'M', '2024-03-01', 'SE', 'asxasxa', '123456', '171116517620150307-SP6A7738.jpg'),
(12, 'Artist', 'Coto', 'Loto', 'coto', 'DJ KK was my teacher', 'F', '2024-03-01', 'SW', 'coto@foo.com', '123456', NULL),
(13, 'Artist', 'Nana', 'Land', 'nana', 'nana land', 'F', '2024-03-01', 'W', 'nana@lala.com', '123456', NULL),
(14, 'Artist', 'Pepe', 'El Toro', 'pepe', 'I like Toros', 'O', '2024-03-02', 'SE', 'pepe@lala.com', '123456', NULL),
(15, 'Artist', 'aas', 'asasdasd', 'adasdasda', 'asdasda', 'M', '2024-03-09', 'SW', 'asdasdasd', '123456', NULL),
(16, 'User', 'Matko', 'lolo', 'matko', 'lollllo', 'M', '2024-04-25', 'Southeast', 'matko@lolo.com', '123456', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(10) UNSIGNED NOT NULL,
  `account_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `album_id` int(10) UNSIGNED NOT NULL,
  `record_label` varchar(255) DEFAULT NULL,
  `artist_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(255) DEFAULT 'Untitled Album',
  `format` enum('Album','Single','EP','LP','SP') NOT NULL,
  `release_date` date DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`album_id`, `record_label`, `artist_id`, `title`, `format`, `release_date`, `rating`, `image_path`) VALUES
(1, 'Pocoloco', 1, 'El Mero Mero', 'Album', '2024-03-01', 0, NULL),
(2, 'Pocoloco', 8, 'El Mero Jefe', 'Album', '2024-03-01', 0, '1711228782A-Passing-View-Nicholas-Moegly-Cropped.jpg'),
(3, 'Pocoloco', 8, 'El Mero Jefe 2', 'Album', '2024-03-01', 0, '1711228835An-Escape-Plan-Nicholas-Moegly.jpg'),
(4, 'Pocoloco', 4, 'WP', 'Album', '2024-03-01', 0, '1711228884datsun-240z-rb26-by-wheelsbywovka-15-1200x800.jpg'),
(5, 'Last Try', 3, 'Ok Ok', 'Album', '2024-03-01', 0, '1711232406datsun-240z-rb26-by-wheelsbywovka-4-1200x800.jpg'),
(6, 'Last Try', 1, 'Ok Ok', 'Album', '2024-03-01', 0, NULL),
(7, 'Last Try', 3, 'Ok Ok', 'Album', '2024-03-01', 0, '1711232712datsun-240z-rb26-by-wheelsbywovka-4-1200x800.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

CREATE TABLE `artists` (
  `artist_id` int(10) UNSIGNED NOT NULL,
  `account_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`artist_id`, `account_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 9),
(6, 10),
(7, 11),
(8, 12),
(9, 13),
(10, 14),
(11, 15);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `region` varchar(255) DEFAULT NULL,
  `artist_id` int(10) UNSIGNED NOT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `followed_artists`
--

CREATE TABLE `followed_artists` (
  `account_id` int(10) UNSIGNED NOT NULL,
  `artist_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `genre_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`genre_id`, `title`) VALUES
(1, 'Rock'),
(2, 'Salsa'),
(3, 'Country'),
(4, 'Cumbia');

-- --------------------------------------------------------

--
-- Table structure for table `playlists`
--

CREATE TABLE `playlists` (
  `playlist_id` int(10) UNSIGNED NOT NULL,
  `account_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(255) DEFAULT 'Unititled Playlist',
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `playlists`
--

INSERT INTO `playlists` (`playlist_id`, `account_id`, `title`, `image_path`) VALUES
(1, 1, 'YO YO YO', '17125297354121271-QYGBPMWA-6.jpg'),
(2, 1, '23 and Me!', 'Buzz.jpg'),
(15, 1, 'Play OK', NULL),
(16, 1, 'Play Bonito', '1711210738Road-Trip.jpeg'),
(17, 1, 'Play More', '17112250178lslm.jpg'),
(18, 1, 'Play it Again', '17112251508lslm.jpg'),
(19, 1, 'Play Much More', '17112251778lslm.jpg'),
(20, 1, 'No image Playlist', NULL),
(43, 1, 'No one like you', '1712523978EP1.png'),
(47, 1, 'Cats 4', '17125270514121271-QYGBPMWA-6.jpg'),
(48, 1, 'Cats and More', '17125271863013331-HSC00001-6.jpg'),
(49, 1, 'More Cats', '17125275068104531-IGXITIHP-6.jpg'),
(50, 1, '4 cats can fly', NULL),
(51, 1, '1 cat and 2 hearts', '1712541901Cy-Twombly-at-the-Tate-Modern-by-Michelle-Aldredge.jpg'),
(52, 1, 'Anyone can Gato', '17125281027056556-HSC00001-6.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE `songs` (
  `song_id` int(10) UNSIGNED NOT NULL,
  `artist_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(255) DEFAULT 'Untitled Song',
  `duration` int(11) DEFAULT NULL,
  `listens` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `genre_id` int(10) UNSIGNED DEFAULT NULL,
  `audio_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`song_id`, `artist_id`, `title`, `duration`, `listens`, `rating`, `genre_id`, `audio_path`) VALUES
(7, 7, 'Mt awesome title', 0, 0, 0, 4, '171121960401 Breeze.mp3'),
(8, 4, 'Song 1', 0, 0, 0, 3, '171121970002 Adrenaline.mp3'),
(9, 4, 'Song 2', 0, 0, 0, 4, '171121972303 Shrimp Dance.mp3'),
(10, 4, 'Song 3', 0, 0, 0, 2, '171121974005 Qualia.mp3'),
(11, 4, 'Song 4', 0, 0, 0, 2, '171121981006 Sweet Tears.mp3'),
(12, 4, 'Song 5', 0, 0, 0, 4, '171121986204 - Sonatine en trio_ III. Animé.mp3'),
(16, 6, 'My favorite dream', 0, 0, 0, 1, NULL),
(17, 1, 'Mr Song', 0, 0, 0, 4, '171122309701-03- Trumpet Concerto in E-flat major (Hob VIIe 1) iii Allegro.mp3'),
(18, 8, 'Pic pic', 0, 0, 0, 4, '171122616906 - Piano Trio_ II. Pantoum. Assez vif.mp3');

-- --------------------------------------------------------

--
-- Table structure for table `songs_in_album`
--

CREATE TABLE `songs_in_album` (
  `song_id` int(10) UNSIGNED NOT NULL,
  `album_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `songs_in_playlist`
--

CREATE TABLE `songs_in_playlist` (
  `song_id` int(10) UNSIGNED NOT NULL,
  `playlist_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `songs_in_playlist`
--

INSERT INTO `songs_in_playlist` (`song_id`, `playlist_id`) VALUES
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(7, 16),
(16, 16),
(18, 16),
(16, 19),
(17, 19),
(11, 20),
(12, 20);

-- --------------------------------------------------------

--
-- Table structure for table `song_ratings`
--

CREATE TABLE `song_ratings` (
  `account_id` int(11) NOT NULL,
  `song_id` int(11) NOT NULL,
  `user_rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `song_ratings`
--

INSERT INTO `song_ratings` (`account_id`, `song_id`, `user_rating`) VALUES
(2, 1, 5),
(2, 17, 4),
(3, 17, 1),
(1, 16, 4),
(1, 18, 4),
(1, 7, 1),
(1, 8, 5);

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `subscription_id` int(10) UNSIGNED NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `length` enum('1 Month','6 Months','1 Year') NOT NULL,
  `price` float NOT NULL,
  `account_id` int(10) UNSIGNED DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `token_storage`
--

CREATE TABLE `token_storage` (
  `account_id` int(10) UNSIGNED NOT NULL,
  `token` varchar(555) NOT NULL,
  `createdDate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `token_storage`
--

INSERT INTO `token_storage` (`account_id`, `token`, `createdDate`) VALUES
(1, 'dcb19365d864e557e82f0b01b94fb3ca', '1712428311'),
(2, '2a750d6c10ccb2a5ea5d025dfe314f97', '1711239529'),
(4, '4a25c66a46b4cf2209547c9a981e652e', '1711175722');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(10) UNSIGNED NOT NULL,
  `account_id` int(10) UNSIGNED DEFAULT NULL,
  `payment_date` datetime NOT NULL,
  `payment_source` varchar(16) NOT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `fk_admins_accounts` (`account_id`);

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`album_id`),
  ADD KEY `fk_albums_artists` (`artist_id`);

--
-- Indexes for table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`artist_id`),
  ADD KEY `fk_artists_accounts` (`account_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `fk_events_artists` (`artist_id`);

--
-- Indexes for table `followed_artists`
--
ALTER TABLE `followed_artists`
  ADD PRIMARY KEY (`account_id`,`artist_id`),
  ADD KEY `fk_followed_artists_artists` (`artist_id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`genre_id`);

--
-- Indexes for table `playlists`
--
ALTER TABLE `playlists`
  ADD PRIMARY KEY (`playlist_id`),
  ADD KEY `fk_playlists_accounts` (`account_id`);

--
-- Indexes for table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`song_id`),
  ADD KEY `fk_songs_genre` (`genre_id`),
  ADD KEY `fk_songs_artists` (`artist_id`);

--
-- Indexes for table `songs_in_album`
--
ALTER TABLE `songs_in_album`
  ADD PRIMARY KEY (`song_id`,`album_id`),
  ADD KEY `fk_songs_in_album_album` (`album_id`);

--
-- Indexes for table `songs_in_playlist`
--
ALTER TABLE `songs_in_playlist`
  ADD PRIMARY KEY (`song_id`,`playlist_id`),
  ADD KEY `fk_songs_in_playlist_playlist` (`playlist_id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`subscription_id`),
  ADD KEY `fk_subscriptions_accounts` (`account_id`);

--
-- Indexes for table `token_storage`
--
ALTER TABLE `token_storage`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `fk_transactions_accounts` (`account_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `account_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `album_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `artists`
--
ALTER TABLE `artists`
  MODIFY `artist_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `genre_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `playlists`
--
ALTER TABLE `playlists`
  MODIFY `playlist_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `songs`
--
ALTER TABLE `songs`
  MODIFY `song_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `subscription_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `fk_admins_accounts` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`);

--
-- Constraints for table `albums`
--
ALTER TABLE `albums`
  ADD CONSTRAINT `fk_albums_artists` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`artist_id`);

--
-- Constraints for table `artists`
--
ALTER TABLE `artists`
  ADD CONSTRAINT `fk_artists_accounts` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`);

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `fk_events_artists` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`artist_id`);

--
-- Constraints for table `followed_artists`
--
ALTER TABLE `followed_artists`
  ADD CONSTRAINT `fk_followed_artists_accounts` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`),
  ADD CONSTRAINT `fk_followed_artists_artists` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`account_id`);

--
-- Constraints for table `playlists`
--
ALTER TABLE `playlists`
  ADD CONSTRAINT `fk_playlists_accounts` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`);

--
-- Constraints for table `songs`
--
ALTER TABLE `songs`
  ADD CONSTRAINT `fk_songs_artists` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`artist_id`),
  ADD CONSTRAINT `fk_songs_genre` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`genre_id`);

--
-- Constraints for table `songs_in_album`
--
ALTER TABLE `songs_in_album`
  ADD CONSTRAINT `fk_songs_in_album_album` FOREIGN KEY (`album_id`) REFERENCES `albums` (`album_id`),
  ADD CONSTRAINT `fk_songs_in_album_song` FOREIGN KEY (`song_id`) REFERENCES `songs` (`song_id`);

--
-- Constraints for table `songs_in_playlist`
--
ALTER TABLE `songs_in_playlist`
  ADD CONSTRAINT `fk_songs_in_playlist_playlist` FOREIGN KEY (`playlist_id`) REFERENCES `playlists` (`playlist_id`),
  ADD CONSTRAINT `fk_songs_in_playlist_song` FOREIGN KEY (`song_id`) REFERENCES `songs` (`song_id`);

--
-- Constraints for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `fk_subscriptions_accounts` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`);

--
-- Constraints for table `token_storage`
--
ALTER TABLE `token_storage`
  ADD CONSTRAINT `fk_token_storage_accounts` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `fk_transactions_accounts` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
