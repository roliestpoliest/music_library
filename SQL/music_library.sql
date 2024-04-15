-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 14, 2024 at 09:17 PM
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
  `image_path` varchar(255) DEFAULT NULL,
  `member_since` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_id`, `user_role`, `fname`, `lname`, `username`, `bio`, `gender`, `DOB`, `region`, `email`, `password`, `image_path`, `member_since`) VALUES
(1, 'Artist', 'Mr. Beats', 'Badaboom', 'lol', 'I didn\'t know happiness until I heard about City Pop', 'M', '2005-04-08', 'Foreing', 'beat@boot.com', '123456', '1712541928NowShowing-A4-210x222.jpg', '2024-04-13 12:39:21'),
(2, 'Admin', 'Lucas', 'Comegalletas', 'lucas', 'I like cookies', 'M', '2024-03-04', 'SW', 'lucas@boing.com', '123456', '1712799499ef01676872a6c6970b-800wi.jpeg', '2024-04-13 12:39:21'),
(3, 'Artist', 'Al', 'Coholic', 'al', 'One more for the road!', 'F', '2024-03-06', 'SW', 'llkjd@kjjhf.cc', '123456', '171280805320150307-bns2.jpg', '2024-04-13 12:39:21'),
(4, 'Artist', 'Bea', 'O\'Problem', 'poo', 'pooh baby', 'F', '2024-03-04', NULL, 'Comp#re.com', '123456', 'Buzz.jpg', '2024-04-13 12:39:21'),
(9, 'Artist', 'Delirious', 'Dreamz', 'asdfaa', 'Hit da snooze button again!', 'F', '2024-03-05', 'SE', 'dsacs@ed.cc', '123456', '171296970701-sp12.jpg', '2024-04-13 12:39:21'),
(10, 'Artist', 'Amanda', 'Hugginkiss', 'aaa', 'My car isn\'t old... It\'s vintage', 'F', '2024-03-07', 'MW', 'pet@oo.com', '123456', '171280805320150307-johansen.jpg', '2024-04-13 12:39:21'),
(11, 'Artist', 'Armando', 'Legos', 'armand', 'I said I wanted to be firefighter only once', 'M', '2024-03-01', 'SE', 'asxasxa', '123456', '171116517620150307-SP6A7738.jpg', '2024-04-13 12:39:21'),
(12, 'Artist', 'Anita', 'Bath', 'anita', 'DJ KK was my teacher', 'F', '2024-03-01', 'SW', 'coto@foo.com', '123456', '1711210738ef0176166785e6970c-800wi.jpeg', '2024-04-13 12:39:21'),
(13, 'Artist', 'U', 'Kuddulmee', 'uk', 'Just Do It!', 'F', '2024-03-01', 'W', 'nana@lala.com', '123456', '17127988421001qearggo1_500.png', '2024-04-13 12:39:21'),
(14, 'Artist', 'Ura', 'Snotball', 'ura', 'Just be like that', 'F', '2024-03-02', 'SE', 'pepe@lala.com', '123456', '17125275068104531-am5.jpg', '2024-04-13 12:39:21'),
(15, 'Artist', 'Drew P', 'Wiener', 'drew', 'Everyone has their own problems', 'M', '2024-03-09', 'SW', 'asdasdasd', '123456', '171279884210001b6051a7bf7.jpg', '2024-04-13 12:39:21'),
(16, 'User', 'Moe', 'Ron', 'moe', 'lollllo', 'M', '2024-04-25', 'Southeast', 'matko@lolo.com', '123456', '171280805320150307banksy-robot.jpg', '2024-04-13 12:39:21');

--
-- Triggers `accounts`
--
DELIMITER $$
CREATE TRIGGER `add_account_to_admins` AFTER INSERT ON `accounts` FOR EACH ROW IF NEW.user_role = 'Admin' THEN
        INSERT INTO `admins` (`account_id`)
        VALUES (NEW.account_id);
    END IF
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `add_account_to_artists` AFTER INSERT ON `accounts` FOR EACH ROW IF NEW.user_role = 'Artist' THEN
        INSERT INTO `artists` (`account_id`)
        VALUES (NEW.account_id);
    END IF
$$
DELIMITER ;

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
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`album_id`, `record_label`, `artist_id`, `title`, `format`, `release_date`, `image_path`) VALUES
(1, 'Pocoloco', 1, 'El Mero Mero Remix 2', 'SP', '2024-03-01', '1712969871DemasRusli_06.jpg'),
(2, 'Pocoloco', 8, 'El Mero Jefe', 'Album', '2024-03-01', '1711228782A-Passing-View-Nicholas-Moegly-Cropped.jpg'),
(3, 'Pocoloco', 8, 'El Mero Jefe 2', 'Album', '2024-03-01', '1711228835An-Escape-Plan-Nicholas-Moegly.jpg'),
(4, 'Pocoloco', 4, 'WP', 'Album', '2024-03-01', '1711228884datsun-240z-rb26-by-wheelsbywovka-15-1200x800.jpg'),
(5, 'Last Try', 3, 'Ok Ok', 'Album', '2024-03-01', '1711232406datsun-240z-rb26-by-wheelsbywovka-4-1200x800.jpg'),
(8, NULL, 1, 'Mira La', 'LP', '2024-04-26', '1712632652RideJournal2.jpg'),
(9, NULL, 1, 'Da GOAT', 'Single', '2024-04-05', '1712799499images.jpeg'),
(10, NULL, 2, 'My Name is Lucas', 'Album', '2024-04-09', '171280686020150311-IMG_1784.jpg'),
(11, NULL, 3, 'Neon Nights', 'Album', '2020-05-08', NULL),
(12, NULL, 3, 'Euphoric Beats', 'LP', '2021-08-02', NULL),
(13, NULL, 3, 'Synth Odyssey', 'Album', '2022-06-18', NULL),
(14, NULL, 3, 'Cosmic Vibrations', 'LP', '2023-07-04', NULL),
(15, NULL, 3, 'Pulsing Rhythms', 'Album', '2024-04-01', NULL),
(16, NULL, 6, 'Daydream Believer', 'Album', '2020-03-25', NULL),
(17, NULL, 6, 'Kaleidoscope Heart', 'Album', '2021-08-02', NULL),
(18, NULL, 6, 'Whispers in the Wind', 'Album', '2022-06-15', NULL),
(19, NULL, 6, 'Echoes of the Evergreen', 'Album', '2023-07-04', NULL),
(20, NULL, 6, 'Velvet Revolutions', 'Album', '2024-04-01', NULL),
(21, NULL, 8, 'Soulful Serenades', 'Album', '2020-03-25', NULL),
(22, NULL, 8, 'Midnight Melodies', 'Album', '2021-08-02', NULL),
(23, NULL, 8, 'Velvet Emotions', 'Album', '2022-06-15', NULL),
(24, NULL, 8, 'Rhythm & Revelations', 'Album', '2023-07-04', NULL),
(25, NULL, 8, 'Silky Smooth', 'Album', '2024-04-01', NULL),
(26, NULL, 7, 'Timeless Traditions', 'Album', '2020-03-25', NULL),
(27, NULL, 7, 'Wanderlust Songbook', 'Album', '2021-08-02', NULL),
(28, NULL, 7, 'Rustic Reveries', 'Album', '2022-06-15', NULL),
(29, NULL, 7, 'Acoustic Anthology', 'Album', '2023-07-04', NULL),
(30, NULL, 7, 'Thunderous Anthems', 'Album', '2024-04-01', NULL),
(31, NULL, 4, 'Riffs & Rebellion', 'Album', '2020-03-25', NULL),
(32, NULL, 4, 'Sonic Odyssey', 'Album', '2021-08-02', NULL),
(33, NULL, 4, 'Shredding the Silence', 'Album', '2022-06-15', NULL),
(34, NULL, 4, 'Amplified Ascension', 'Album', '2023-07-04', NULL),
(35, NULL, 4, 'Symphonic Splendor', 'Album', '2024-04-01', NULL),
(36, NULL, 5, 'Concerto Crescendos', 'Album', '2020-03-25', NULL),
(37, NULL, 5, 'Ethereal Elegance', 'Album', '2021-08-02', NULL),
(38, NULL, 5, 'Philharmonic Fantasies', 'Album', '2022-06-15', NULL),
(39, NULL, 5, 'Orchestral Odyssey', 'Album', '2023-07-04', NULL),
(40, NULL, 5, 'Soulful Strains', 'Album', '2024-04-01', NULL),
(41, NULL, 11, 'Improvisational Interludes', 'Album', '2020-03-25', NULL),
(42, NULL, 11, 'Bebop Brilliance', 'Album', '2021-08-02', NULL),
(43, NULL, 11, 'Sultry Serenades', 'Album', '2022-06-15', NULL),
(44, NULL, 11, 'Jazzy Journeys', 'Album', '2023-07-04', NULL),
(45, NULL, 11, 'Metallic Mayhem', 'Album', '2024-04-01', NULL),
(46, NULL, 9, 'Riffs of Rage', 'Album', '2020-03-25', NULL),
(47, NULL, 9, 'Symphonic Steel', 'Album', '2021-08-02', NULL),
(48, NULL, 9, 'Headbanging Havoc', 'Album', '2022-06-15', NULL),
(49, NULL, 9, 'Crushing Catharsis', 'Album', '2023-07-04', NULL),
(50, NULL, 9, 'Ethereal Echoes', 'Album', '2024-04-01', NULL),
(51, NULL, 10, 'Sonic Serenity', 'Album', '2020-10-25', NULL),
(52, NULL, 10, 'Ambient Atmospheres', 'Album', '2021-08-02', NULL),
(53, NULL, 2, 'Textural Tapestries', 'Album', '2022-06-15', NULL),
(54, NULL, 2, 'Dreamscape Drifts', 'Album', '2023-07-04', NULL),
(55, NULL, 3, 'Campfire Chronicles', 'Album', '2024-04-01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `album_ratings`
--

CREATE TABLE `album_ratings` (
  `account_id` int(11) NOT NULL,
  `album_id` int(11) NOT NULL,
  `user_rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `album_ratings`
--

INSERT INTO `album_ratings` (`account_id`, `album_id`, `user_rating`) VALUES
(1, 6, 3);

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

CREATE TABLE `artists` (
  `artist_id` int(10) UNSIGNED NOT NULL,
  `account_id` int(10) UNSIGNED NOT NULL,
  `followers` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`artist_id`, `account_id`, `followers`) VALUES
(1, 1, 0),
(2, 2, 0),
(3, 3, 0),
(4, 4, 1),
(5, 9, 0),
(6, 10, 0),
(7, 11, 0),
(8, 12, 0),
(9, 13, 0),
(10, 14, 0),
(11, 15, 0);

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

--
-- Dumping data for table `followed_artists`
--

INSERT INTO `followed_artists` (`account_id`, `artist_id`) VALUES
(2, 4);

--
-- Triggers `followed_artists`
--
DELIMITER $$
CREATE TRIGGER `increase_follower_count` AFTER INSERT ON `followed_artists` FOR EACH ROW UPDATE artists a
    SET a.followers = a.followers + 1
    WHERE a.artist_id = NEW.artist_id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `reduce_follower_count` BEFORE DELETE ON `followed_artists` FOR EACH ROW UPDATE artists a
    SET a.followers = a.followers - 1
    WHERE a.artist_id = OLD.artist_id
$$
DELIMITER ;

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
(4, 'Cumbia'),
(56, 'Dance Pop'),
(57, 'Indie Pop '),
(58, 'R&B'),
(59, 'Folk'),
(60, 'Synthwave'),
(61, 'Ambient'),
(62, 'Punk Rock'),
(63, 'Dream Pop'),
(64, 'Disco'),
(65, 'Classical'),
(66, 'Jazz'),
(67, 'Trance'),
(68, 'Folk Rock'),
(69, 'New Age'),
(70, 'Hard Rock'),
(72, 'Space Rock'),
(73, 'Grunge'),
(74, 'Symphonic Metal'),
(75, 'Rockabilly'),
(76, 'Heavy Metal');

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
(47, 1, 'Con Cat and Nation', '17125270514121271-QYGBPMWA-6.jpg'),
(48, 1, 'Cats and More', '17125271863013331-HSC00001-6.jpg'),
(49, 1, 'More Cats', '17125275068104531-IGXITIHP-6.jpg'),
(50, 1, '4 cat owners', '1712961832Nicholas-Moegly-A-Sudden-Rustle.jpg'),
(51, 1, '1 cat and 2 hearts', '1712541901Cy-Twombly-at-the-Tate-Modern-by-Michelle-Aldredge.jpg'),
(52, 1, 'Anyone can Gato', '17125281027056556-HSC00001-6.jpg'),
(53, 2, 'My first playlist', '171280805320150307-SP6A7738.jpg');

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
  `audio_path` varchar(255) DEFAULT NULL,
  `release_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`song_id`, `artist_id`, `title`, `duration`, `listens`, `rating`, `genre_id`, `audio_path`, `release_date`) VALUES
(7, 7, 'Mt awesome title', 0, 0, 0, 4, '171121960401 Breeze.mp3', '2024-04-13 12:34:56'),
(8, 4, 'Song 1', 0, 0, 0, 3, '171121970002 Adrenaline.mp3', '2024-04-13 12:34:56'),
(9, 4, 'Song 2', 0, 0, 0, 4, '171121972303 Shrimp Dance.mp3', '2024-04-13 12:34:56'),
(10, 4, 'Song 3', 0, 0, 0, 2, '171121974005 Qualia.mp3', '2024-04-13 12:34:56'),
(11, 4, 'Song 4', 0, 0, 0, 2, '171121981006 Sweet Tears.mp3', '2024-04-13 12:34:56'),
(12, 4, 'Song 5', 0, 0, 0, 4, '171121986204 - Sonatine en trio_ III. Animé.mp3', '2024-04-13 12:34:56'),
(17, 1, 'Mr Song', 0, 0, 0, 4, '171122309701-03- Trumpet Concerto in E-flat major (Hob VIIe 1) iii Allegro.mp3', '2024-04-13 12:34:56'),
(18, 8, 'Pic pic', 0, 0, 0, 4, '171122616906 - Piano Trio_ II. Pantoum. Assez vif.mp3', '2024-04-13 12:34:56'),
(38, 1, '123 abc', 0, 7, 0, 3, '1712798842100 - Andante Spianato et Grand Polonaise Brillante, Op. 22_ II. Grande Polonaise Br.mp3', '2024-04-13 12:34:56'),
(39, 1, 'Cumbia Loca', 0, 0, 0, 4, '171279890697 - Piano Sonata No. 2 in B-Flat Minor, Op. 35_ III. Marche Funébre - Lento.mp3', '2024-04-13 12:34:56'),
(40, 1, 'Cumbia Locochona', 0, 0, 0, 3, '171296960519 - Sonata for Violin and Cello_ IV. Vif, avec entrain.mp3', '2024-04-13 12:34:56'),
(41, 1, 'Cambiada', 0, 0, 0, 3, '171296964340 - Romance in C Major for Violin and Orchestra, Op. 48.mp3', '2024-04-13 12:34:56'),
(42, 1, 'jjuudjCambiada', 0, 0, 0, 3, '171296968031 - Partita No. 3 in E Major for Solo Violin, BWV 1006_ I. Preludio.mp3', '2024-04-13 12:34:56'),
(43, 1, 'Cambiada 123', 0, 1, 0, 3, '171296970701-27- Quartet No 54 in B-flat Minor, Op 71, No 1 (Hob III 69) iii Menuetto.mp3', '2024-04-13 12:34:56'),
(44, 1, 'da GOAT single', 0, 0, 0, 1, '171279955927 - The Well-Tempered Clavier, Book 2_ Prelude and Fugue No. 3 in C-Sharp Major, BWV 872.mp3', '2024-04-13 12:34:56'),
(57, 3, 'Rhythm of the Night', NULL, NULL, NULL, 56, NULL, '2020-05-08 00:00:00'),
(58, 3, 'Chasing Rainbows', NULL, NULL, NULL, 57, NULL, '2020-05-08 00:00:00'),
(59, 3, 'Soulful Symphony', NULL, NULL, NULL, 58, NULL, '2020-05-08 00:00:00'),
(60, 3, 'Echoes of the Past', NULL, NULL, NULL, 59, NULL, '2020-05-08 00:00:00'),
(61, 3, 'Neon Heartbeat', NULL, NULL, NULL, 60, NULL, '2020-05-08 00:00:00'),
(62, 3, 'Whispers in the Wind', NULL, NULL, NULL, 61, NULL, '2020-05-08 00:00:00'),
(63, 3, 'Rebel Yell', NULL, NULL, NULL, 62, NULL, '2020-05-08 00:00:00'),
(64, 3, 'Stardust Memories', NULL, NULL, NULL, 63, NULL, '2020-05-08 00:00:00'),
(65, 3, 'Liquid Gold', NULL, NULL, NULL, 64, NULL, '2020-05-08 00:00:00'),
(66, 3, 'Timeless Melodies', NULL, NULL, NULL, 65, NULL, '2020-05-08 00:00:00'),
(67, 3, 'Midnight Rendezvous', NULL, NULL, NULL, 66, NULL, '2020-05-08 00:00:00'),
(68, 3, 'Euphoric Escape', NULL, NULL, NULL, 67, NULL, '2020-05-08 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `songs_in_album`
--

CREATE TABLE `songs_in_album` (
  `song_id` int(10) UNSIGNED NOT NULL,
  `album_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `songs_in_album`
--

INSERT INTO `songs_in_album` (`song_id`, `album_id`) VALUES
(42, 8),
(17, 9),
(38, 9),
(40, 9),
(41, 9),
(42, 9),
(44, 9),
(57, 11),
(58, 11),
(59, 11),
(60, 11),
(61, 11),
(62, 11),
(63, 11),
(64, 11),
(65, 11),
(66, 11),
(67, 11),
(68, 11);

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
(18, 16),
(17, 19),
(11, 20),
(12, 20),
(38, 53);

-- --------------------------------------------------------

--
-- Table structure for table `song_play_count`
--

CREATE TABLE `song_play_count` (
  `song_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `event_time` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `song_play_count`
--

INSERT INTO `song_play_count` (`song_id`, `account_id`, `event_time`) VALUES
(38, 2, '2024-04-12 19:07:02'),
(38, 2, '2024-04-12 19:07:21'),
(38, 2, '2024-04-13 11:39:05'),
(38, 2, '2024-04-13 11:39:12'),
(38, 2, '2024-04-13 12:22:06'),
(38, 2, '2024-04-13 12:22:17'),
(43, 2, '2024-04-13 12:22:35'),
(38, 2, '2024-04-13 13:29:44');

--
-- Triggers `song_play_count`
--
DELIMITER $$
CREATE TRIGGER `update_listens_count` AFTER INSERT ON `song_play_count` FOR EACH ROW UPDATE songs c 
    SET `listens` = (
    SELECT COUNT(1) FROM `song_play_count` AS s
        WHERE s.event_time <= LAST_DAY(CURRENT_TIMESTAMP)
        AND s.event_time >= CAST(DATE_FORMAT(NOW() ,'%Y-%m-01') as DATE)
        AND s.song_id = NEW.song_id)
    WHERE c.song_id = NEW.song_id
$$
DELIMITER ;

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
(2, '7b1408258c2b30cf9900448532faf73f', '1713112138'),
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
  ADD PRIMARY KEY (`album_id`);

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
  MODIFY `album_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

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
  MODIFY `genre_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `playlists`
--
ALTER TABLE `playlists`
  MODIFY `playlist_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `songs`
--
ALTER TABLE `songs`
  MODIFY `song_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

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
