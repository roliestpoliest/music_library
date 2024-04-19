-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 17, 2024 at 07:07 AM
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
  `member_since` datetime DEFAULT CURRENT_TIMESTAMP,
  `new_notifications` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_id`, `user_role`, `fname`, `lname`, `username`, `bio`, `gender`, `DOB`, `region`, `email`, `password`, `image_path`, `member_since`, `new_notifications`) VALUES
(1, 'Artist', 'Mr. Beats', 'Badaboom', 'lol', 'I didn\'t know happiness until I heard about City Pop', 'M', '2005-04-08', 'Foreing', 'beat@boot.com', '123456', '1712541928NowShowing-A4-210x222.jpg', '2024-04-13 12:39:21', 0),
(2, 'Admin', 'Lucas', 'Comegalletas', 'lucas', 'I like cookies', 'M', '2024-03-04', 'SW', 'lucas@boing.com', '123456', '1712799499ef01676872a6c6970b-800wi.jpeg', '2024-04-13 12:39:21', 1),
(3, 'Artist', 'Al', 'Coholic', 'al', 'One more for the road!', 'F', '2024-03-06', 'SW', 'llkjd@kjjhf.cc', '123456', '171280805320150307-bns2.jpg', '2024-04-13 12:39:21', 0),
(4, 'Artist', 'Bea', 'O\'Problem', 'poo', 'pooh baby', 'F', '2024-03-04', NULL, 'Comp#re.com', '123456', 'Buzz.jpg', '2024-04-13 12:39:21', 1),
(9, 'Artist', 'Delirious', 'Dreamz', 'asdfaa', 'Hit da snooze button again!', 'F', '2024-03-05', 'SE', 'dsacs@ed.cc', '123456', '171296970701-sp12.jpg', '2024-04-13 12:39:21', 0),
(10, 'Artist', 'Amanda', 'Hugginkiss', 'aaa', 'My car isn\'t old... It\'s vintage', 'F', '2024-03-07', 'MW', 'pet@oo.com', '123456', '171280805320150307-johansen.jpg', '2024-04-13 12:39:21', 0),
(11, 'Artist', 'Armando', 'Legos', 'armand', 'I said I wanted to be firefighter only once', 'M', '2024-03-01', 'SE', 'asxasxa', '123456', '171116517620150307-SP6A7738.jpg', '2024-04-13 12:39:21', 2),
(12, 'Artist', 'Anita', 'Bath', 'anita', 'DJ KK was my teacher', 'F', '2024-03-01', 'SW', 'coto@foo.com', '123456', '1711210738ef0176166785e6970c-800wi.jpeg', '2024-04-13 12:39:21', 0),
(13, 'Artist', 'U', 'Kuddulmee', 'uk', 'Just Do It!', 'F', '2024-03-01', 'W', 'nana@lala.com', '123456', '17127988421001qearggo1_500.png', '2024-04-13 12:39:21', 0),
(14, 'Artist', 'Ura', 'Snotball', 'ura', 'Just be like that', 'F', '2024-03-02', 'SE', 'pepe@lala.com', '123456', '17125275068104531-am5.jpg', '2024-04-13 12:39:21', 0),
(15, 'Artist', 'Drew P', 'Wiener', 'drew', 'Everyone has their own problems', 'M', '2024-03-09', 'SW', 'asdasdasd', '123456', '171279884210001b6051a7bf7.jpg', '2024-04-13 12:39:21', 6),
(16, 'User', 'Moe', 'Ron', 'moe', 'lollllo', 'M', '2024-04-25', 'Southeast', 'matko@lolo.com', '123456', '171280805320150307banksy-robot.jpg', '2024-04-13 12:39:21', 0),
(17, 'Artist', 'Marcus', 'P.', 'marcusp', 'Back to the future!', 'M', '1993-11-04', 'Northeast', 'marcus@email.com', '123456', '1713251138A2CRO.webp', '2024-04-15 23:06:30', 0),
(18, 'Artist', 'Benjamin', 'Tissot', 'benjamintissot', 'Benedict eggs on Sunday morning', 'M', '1994-09-20', 'Midwest', 'tissot@email.com', '123456', '1713251260JELC3M.jpg', '2024-04-15 23:16:48', 0),
(19, 'Artist', 'Lunar', 'Years', 'lunaryears', 'Year of the Dragon', 'F', '1976-01-01', 'Midwest', 'lunaryears@email.com', '123456', '1713251199BARM3BR.jpg', '2024-04-15 23:19:04', 1),
(21, 'Artist', 'Diffie', 'Bosman', 'diffie', 'What\'s shakin, bacon?', 'F', '2024-04-01', 'West', 'diffie@email.com', '123456', '1713251237BB3LOVE.webp', '2024-04-15 23:21:24', 0),
(22, 'Artist', 'Vital', 'Vitals', 'vital', 'Lavender Haze Latte, please', 'F', '2018-06-05', 'West', 'vital@email.com', '123456', '1713251173A2TP.jpg', '2024-04-15 23:22:20', 1),
(23, 'Artist', 'Evert', 'Zeevalkink', 'evert', 'Solar Eclipse', 'F', '2024-02-18', 'Midwest', 'evert@email.com', '123456', '1713251214BAS3B.jpg', '2024-04-15 23:24:36', 0),
(24, 'Artist', 'Andriy', 'Mashtalir', 'andriy', 'Pure imagination', 'M', '2024-04-01', 'Midwest', 'andriy@email.com', '123456', '1713251280SMG2F.webp', '2024-04-15 23:25:41', 0),
(25, 'Artist', 'Andy', 'Bird', 'andybird', 'Two birds on a wire', 'M', '2024-04-01', 'Southwest', 'andybird@email.com', '123456', '1713251312SWM4S.webp', '2024-04-15 23:26:20', 0),
(26, 'Artist', 'Veace', 'D', 'veaced', 'missing the point', 'M', '2024-01-20', 'Southeast', 'veaced@email.com', '123456', '1713251157A2DIR.jpg', '2024-04-15 23:31:04', 0);

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
DELIMITER $$
CREATE TRIGGER `send_welcome_message` AFTER INSERT ON `accounts` FOR EACH ROW INSERT INTO notifications (account_id, message)
VALUES
(NEW.account_id, ' Welcom to our music library!')
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

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `account_id`) VALUES
(1, 2);

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
(55, NULL, 3, 'Campfire Chronicles', 'Album', '2024-04-01', NULL),
(56, NULL, 18, 'Aural Illusion', 'Album', '2024-04-01', '1713242507flight.png'),
(57, NULL, 18, 'Flight', 'SP', '2024-03-05', '1713242929diggingupsecrets.png'),
(58, NULL, 18, 'Night Rider', 'Single', '2024-03-02', '1713242838nightrider.png'),
(59, NULL, 19, 'Gravity', 'Album', '2024-04-08', '1713243769gravity.png'),
(60, NULL, 13, 'Dreams', 'Single', '2024-01-15', '1713244078dreams.png'),
(61, NULL, 15, 'Winterbeams', 'Album', '2019-04-10', '1713244137winterbeams.png'),
(62, NULL, 17, 'Sad', 'Album', '2024-04-04', '1713244531sad.png'),
(63, NULL, 17, 'Dreaming of Tomorrow', 'SP', '2024-04-01', '1713244515dreamingoftomorrow.png'),
(64, NULL, 17, 'Zeevalkink', 'Album', '2024-03-12', '1713244570zeevalkink.png'),
(65, NULL, 14, 'Digging Up Secrets', 'Album', '2024-04-08', '1713249261diggingupsecrets.png'),
(66, NULL, 12, 'Warm Memory', 'SP', '2024-04-02', '1713249515warmmemory.png'),
(67, NULL, 12, 'Marcus', 'Album', '2023-09-12', '1713249674marcus.png'),
(68, NULL, 20, 'Cinema', 'SP', '2023-12-05', '1713249944cinema.png'),
(69, NULL, 20, 'Breath', 'Single', '2019-04-02', '1713250043breath.png'),
(70, NULL, 16, 'Vital', 'Album', '2023-06-19', '1713250776vital.png'),
(71, NULL, 16, 'Morning Coffee', 'Single', '2023-04-29', '1713250813morningcoffee.png');

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
(1, 6, 3),
(24, 57, 2),
(24, 56, 5),
(24, 58, 5);

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
(2, 2, 1),
(3, 3, 1),
(4, 4, 2),
(5, 9, 0),
(6, 10, 1),
(7, 11, 1),
(8, 12, 0),
(9, 13, 0),
(10, 14, 1),
(11, 15, 1),
(12, 18, 1),
(13, 18, 1),
(14, 19, 0),
(15, 21, 0),
(16, 22, 1),
(17, 23, 0),
(18, 24, 0),
(19, 25, 0),
(20, 26, 0);

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
(2, 20),
(2, 16),
(2, 13),
(2, 4),
(2, 11),
(15, 2),
(15, 6),
(15, 16),
(15, 7),
(15, 3);

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
CREATE TRIGGER `increase_notification_counter` AFTER INSERT ON `followed_artists` FOR EACH ROW UPDATE accounts SET new_notifications = new_notifications + 1
                WHERE account_id = (SELECT ar.account_id FROM artists AS ar 
                    WHERE ar.artist_id = NEW.artist_id)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `new_follower_notification` AFTER INSERT ON `followed_artists` FOR EACH ROW INSERT INTO notifications (account_id, message)
                    VALUES
                    ((SELECT ar.account_id FROM artists AS ar 
                    WHERE ar.artist_id = NEW.artist_id),

                    (SELECT
                    CONCAT(ac.fname, ' ', ac.lname, ' has started following you!')
                    FROM accounts AS ac
                    WHERE ac.account_id = NEW.account_id))
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `reduce_follower_count` AFTER DELETE ON `followed_artists` FOR EACH ROW UPDATE artists a
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
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `has_been_seen` tinyint(4) NOT NULL DEFAULT '0',
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `account_id`, `date_created`, `has_been_seen`, `message`) VALUES
(3, 25, '2024-04-16 20:10:34', 1, 'Lucas Comegalletas has started following you!'),
(5, 14, '2024-04-16 20:10:50', 0, 'Lucas Comegalletas has started following you!'),
(9, 18, '2024-04-17 00:15:15', 0, 'Lucas Comegalletas has started following you!'),
(10, 4, '2024-04-17 00:16:24', 0, 'Lucas Comegalletas has started following you!'),
(11, 15, '2024-04-17 00:16:46', 0, 'Lucas Comegalletas has started following you!'),
(12, 3, '2024-04-17 00:22:41', 1, 'Drew P Wiener has started following you!'),
(13, 2, '2024-04-17 00:22:44', 0, 'Drew P Wiener has started following you!'),
(18, 2, '2024-04-17 00:30:08', 0, 'Drew P Wiener has started following you!'),
(19, 10, '2024-04-17 00:30:13', 0, 'Drew P Wiener has started following you!'),
(20, 22, '2024-04-17 00:30:18', 1, 'Drew P Wiener has started following you!'),
(21, 11, '2024-04-17 00:31:01', 0, 'Drew P Wiener has started following you!'),
(22, 11, '2024-04-17 00:31:24', 0, 'Drew P Wiener has started following you!'),
(23, 11, '2024-04-17 00:31:44', 0, 'Drew P Wiener has started following you!'),
(24, 11, '2024-04-17 00:33:46', 0, 'Drew P Wiener has started following you!'),
(25, 3, '2024-04-17 00:34:08', 1, 'Drew P Wiener has started following you!'),
(26, 22, '2024-04-17 01:47:15', 1, 'Your song Progress just reached 100 listens!'),
(27, 22, '2024-04-17 01:48:12', 1, 'Your song Stomp just reached 100 listens!'),
(28, 22, '2024-04-17 01:51:03', 1, 'Your song Morning Coffee just reached 100 listens!'),
(29, 22, '2024-04-17 01:53:35', 0, 'Your song Easy just reached 100 listens!'),
(30, 24, '2024-04-17 01:58:05', 1, 'Your song Night Rider just reached 100 listens!'),
(31, 4, '2024-04-17 02:00:21', 0, 'Your song Song 3 just reached 100 listens!'),
(32, 19, '2024-04-17 02:00:21', 0, 'Your song Event Horizon just reached 100 listens!'),
(33, 11, '2024-04-17 02:06:46', 0, 'Your song Mt awesome title just reached 10 listens!');

--
-- Triggers `notifications`
--
DELIMITER $$
CREATE TRIGGER `reset_notification_counter` AFTER UPDATE ON `notifications` FOR EACH ROW UPDATE accounts SET new_notifications = 0
                WHERE account_id = OLD.account_id
$$
DELIMITER ;

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
(15, 1, 'Play OK', '1713131283kirbyIMG1783.JPG'),
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
(51, 1, '1 cat and 2 hearts', '1713130669DemasRusli_05.jpg'),
(52, 1, 'Anyone can Gato', '17125281027056556-HSC00001-6.jpg'),
(59, 2, 'play play play', '17131423246517458935_1b9bf2249e_o.jpg'),
(60, 18, 'Para Pedro', '17132379896a00d8341ca70953ef01761667849c970c-800wi.jpeg');

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
(7, 7, 'Mt awesome title', 0, 19, 0, 4, '171121960401 Breeze.mp3', '2024-04-13 12:34:56'),
(8, 4, 'Song 1', 0, 95, 0, 3, '171121970002 Adrenaline.mp3', '2024-04-13 12:34:56'),
(9, 4, 'Song 2', 0, 95, 0, 4, '171121972303 Shrimp Dance.mp3', '2024-04-13 12:34:56'),
(10, 4, 'Song 3', 0, 95, 0, 2, '171121974005 Qualia.mp3', '2024-04-13 12:34:56'),
(11, 4, 'Song 4', 0, 95, 0, 2, '171121981006 Sweet Tears.mp3', '2024-04-13 12:34:56'),
(12, 4, 'Song 5', 0, 95, 0, 4, '171121986204 - Sonatine en trio_ III. Animé.mp3', '2024-04-13 12:34:56'),
(17, 1, 'Mr Song', 0, 95, 0, 4, '171122309701-03- Trumpet Concerto in E-flat major (Hob VIIe 1) iii Allegro.mp3', '2024-04-13 12:34:56'),
(18, 8, 'Pic pic', 0, 95, 0, 4, '171122616906 - Piano Trio_ II. Pantoum. Assez vif.mp3', '2024-04-13 12:34:56'),
(38, 1, '123 abc', 0, 95, 0, 3, '1712798842100 - Andante Spianato et Grand Polonaise Brillante, Op. 22_ II. Grande Polonaise Br.mp3', '2024-04-13 12:34:56'),
(39, 1, 'Cumbia Loca', 0, 95, 0, 4, '171279890697 - Piano Sonata No. 2 in B-Flat Minor, Op. 35_ III. Marche Funébre - Lento.mp3', '2024-04-13 12:34:56'),
(40, 1, 'Cumbia Locochona', 0, 95, 0, 3, '171296960519 - Sonata for Violin and Cello_ IV. Vif, avec entrain.mp3', '2024-04-13 12:34:56'),
(41, 1, 'Cambiada', 0, 95, 0, 3, '171296964340 - Romance in C Major for Violin and Orchestra, Op. 48.mp3', '2024-04-13 12:34:56'),
(42, 1, 'jjuudjCambiada', 0, 95, 0, 3, '171296968031 - Partita No. 3 in E Major for Solo Violin, BWV 1006_ I. Preludio.mp3', '2024-04-13 12:34:56'),
(43, 1, 'Cambiada 123', 0, 95, 0, 3, '171296970701-27- Quartet No 54 in B-flat Minor, Op 71, No 1 (Hob III 69) iii Menuetto.mp3', '2024-04-13 12:34:56'),
(44, 1, 'da GOAT single', 0, 95, 0, 1, '171279955927 - The Well-Tempered Clavier, Book 2_ Prelude and Fugue No. 3 in C-Sharp Major, BWV 872.mp3', '2024-04-13 12:34:56'),
(57, 3, 'Rhythm of the Night', NULL, 95, NULL, 56, NULL, '2020-05-08 00:00:00'),
(58, 3, 'Chasing Rainbows', NULL, 95, NULL, 57, NULL, '2020-05-08 00:00:00'),
(59, 3, 'Soulful Symphony', NULL, 95, NULL, 58, NULL, '2020-05-08 00:00:00'),
(60, 3, 'Echoes of the Past', NULL, 95, NULL, 59, NULL, '2020-05-08 00:00:00'),
(61, 3, 'Neon Heartbeat', NULL, 95, NULL, 60, NULL, '2020-05-08 00:00:00'),
(62, 3, 'Whispers in the Wind', NULL, 95, NULL, 61, NULL, '2020-05-08 00:00:00'),
(63, 3, 'Rebel Yell', NULL, 95, NULL, 62, NULL, '2020-05-08 00:00:00'),
(64, 3, 'Stardust Memories', NULL, 95, NULL, 63, NULL, '2020-05-08 00:00:00'),
(65, 3, 'Liquid Gold', NULL, 95, NULL, 64, NULL, '2020-05-08 00:00:00'),
(66, 3, 'Timeless Melodies', NULL, 95, NULL, 65, NULL, '2020-05-08 00:00:00'),
(67, 3, 'Midnight Rendezvous', NULL, 95, NULL, 66, NULL, '2020-05-08 00:00:00'),
(68, 3, 'Euphoric Escape', NULL, 95, NULL, 67, NULL, '2020-05-08 00:00:00'),
(69, 18, 'Aural Illusion', 0, 95, 0, 61, '1713242535auralillusion.mp3', '2024-04-15 23:42:15'),
(70, 18, 'Imagination', 0, 95, 0, 61, '1713242597imagination.mp3', '2024-04-15 23:43:17'),
(71, 18, 'Darkness', 0, 95, 0, 3, '1713242613darkness.mp3', '2024-04-15 23:43:33'),
(72, 18, 'Take My Hand', 0, 95, 0, 65, '1713242635takemyhand.mp3', '2024-04-15 23:43:55'),
(73, 18, 'Ciribay', 0, 95, 0, 65, '1713242656ciribay.mp3', '2024-04-15 23:44:16'),
(74, 18, 'Ilhabela', 0, 95, 0, 61, '1713242673ilhabela.mp3', '2024-04-15 23:44:33'),
(75, 18, 'Harmony', 0, 95, 0, 61, '1713242686harmony.mp3', '2024-04-15 23:44:46'),
(76, 18, 'Flight Across The Serene Waters', 0, 95, 0, 3, '1713242740flightacrosstheserenewaters.mp3', '2024-04-15 23:45:40'),
(77, 18, 'Seawalk', 0, 95, 0, 61, '1713242750seawalk.mp3', '2024-04-15 23:45:50'),
(78, 18, 'Night Rider', 0, 95, 0, 63, '1713242772nightrider.mp3', '2024-04-15 23:46:12'),
(79, 19, 'Part of Me', 0, 95, 0, 61, '1713243854partofme.mp3', '2024-04-16 00:04:14'),
(80, 19, 'Kaleidoscope', 0, 95, 0, 57, '1713243876kaleidoscope.mp3', '2024-04-16 00:04:36'),
(81, 19, 'After Light', 0, 95, 0, 57, '1713243889afterlight.mp3', '2024-04-16 00:04:49'),
(82, 19, 'World on Fire', 0, 95, 0, 73, '1713243905worldonfire.mp3', '2024-04-16 00:05:05'),
(83, 8, 'Gravity', 0, 95, 0, 73, '1713243983intothenight.mp3', '2024-04-16 00:06:23'),
(84, 13, 'Dreams', 0, 95, 0, 66, '1713244097dreams.mp3', '2024-04-16 00:08:17'),
(85, 15, 'Winterbeams', 0, 95, 0, 56, '1713244177winterbeams.mp3', '2024-04-16 00:09:37'),
(86, 15, 'Sleepless', 0, 95, 0, 59, '1713244192sleepless.mp3', '2024-04-16 00:09:52'),
(87, 15, 'Serene Discovery', 0, 95, 0, 3, '1713244302closertothesun.mp3', '2024-04-16 00:11:34'),
(88, 15, 'Ghost Town', 0, 95, 0, 64, '1713244337ghosttown.mp3', '2024-04-16 00:12:17'),
(89, 15, 'Nova Scotia', 0, 95, 0, 56, '1713244351novascotia.mp3', '2024-04-16 00:12:31'),
(90, 15, 'Merchurochrome', 0, 95, 0, 76, '1713244368merchurochrome.mp3', '2024-04-16 00:12:48'),
(91, 17, 'Hallow', 0, 95, 0, 3, '1713244589hollow.mp3', '2024-04-16 00:16:29'),
(92, 17, 'Flow Like A River', 0, 95, 0, 65, '1713244610flowlikeariver.mp3', '2024-04-16 00:16:50'),
(93, 17, 'Don\'t Leave', 0, 95, 0, 56, '1713246174dontleave.mp3', '2024-04-16 00:42:54'),
(94, 17, 'Day of the Sun', 0, 95, 0, 56, '1713246212smoothmoves.mp3', '2024-04-16 00:43:32'),
(95, 17, 'Aftermath', 0, 95, 0, 76, '1713246227aftermath.mp3', '2024-04-16 00:43:47'),
(96, 17, 'The Thirteenth Day', 0, 95, 0, 57, '1713246243thethirteenthday.mp3', '2024-04-16 00:44:03'),
(97, 17, 'The Girl and the Tree', 0, 95, 0, 73, NULL, '2024-04-16 00:44:52'),
(98, 17, 'Don\'t Look Behind', 0, 95, 0, 59, '1713246337dontlookbehind.mp3', '2024-04-16 00:45:37'),
(99, 17, 'Long Road', 0, 95, 0, 3, '1713246352longroad.mp3', '2024-04-16 00:45:52'),
(100, 17, 'I\'m Ready', 0, 95, 0, 3, '1713246365imready.mp3', '2024-04-16 00:46:05'),
(101, 17, 'Window to The World', 0, 95, 0, 64, '1713246390windowtotheworld.mp3', '2024-04-16 00:46:30'),
(102, 17, 'Outlaws of the Old West', 0, 95, 0, 3, '1713246405outlawsoftheoldwest.mp3', '2024-04-16 00:46:45'),
(103, 14, 'A Glipse Of Truth', 0, 95, 0, 63, '1713249360flightacrosstheserenewaters.mp3', '2024-04-16 01:36:00'),
(104, 14, 'Event Horizon', 0, 95, 0, 63, '1713249376eventhorizon.mp3', '2024-04-16 01:36:16'),
(105, 14, 'Age of Machines', 0, 95, 0, 70, '1713249396ageofmachines.mp3', '2024-04-16 01:36:36'),
(106, 14, 'Unbreakable Reslove', 0, 95, 0, 57, '1713249415unbreakableresolve.mp3', '2024-04-16 01:36:55'),
(107, 14, 'Digging Up Secrets', 0, 95, 0, 64, '1713249435diggingupsecrets.mp3', '2024-04-16 01:37:15'),
(108, 14, 'A Moment To Cherish', 0, 95, 0, 56, '1713249455amomenttocherish.mp3', '2024-04-16 01:37:35'),
(109, 12, 'Warm Memory', 0, 95, 0, 63, '1713249697outlawsoftheoldwest.mp3', '2024-04-16 01:41:37'),
(110, 12, 'On Repeat', 0, 95, 0, 69, '1713249714onrepeat.mp3', '2024-04-16 01:41:54'),
(111, 12, 'Smooth Moves', 0, 95, 0, 74, '1713249724onrepeat.mp3', '2024-04-16 01:42:04'),
(112, 12, 'Shine Up', 0, 95, 0, 60, '1713249751shineup.mp3', '2024-04-16 01:42:31'),
(113, 12, 'Back to the Future', 0, 95, 0, 60, '1713249764backtothefuture.mp3', '2024-04-16 01:42:44'),
(114, 12, 'Moving Way Up', 0, 95, 0, 76, '1713249775backtothefuture.mp3', '2024-04-16 01:42:55'),
(115, 12, 'Sunny Evening', 0, 95, 0, 75, '1713249789backtothefuture.mp3', '2024-04-16 01:43:09'),
(116, 12, 'Good Vibes', 0, 95, 0, 57, '1713249803goodvibes.mp3', '2024-04-16 01:43:23'),
(117, 12, 'Last Night', 0, 95, 0, 60, '1713249815lastnight.mp3', '2024-04-16 01:43:35'),
(118, 20, 'Closer to the Sun', 0, 95, 0, 67, '1713250111closertothesun.mp3', '2024-04-16 01:48:31'),
(119, 20, 'Oblivion', 0, 95, 0, 72, '1713250124oblivion.mp3', '2024-04-16 01:48:44'),
(120, 20, 'Elevation', 0, 95, 0, 74, '1713250147elevation.mp3', '2024-04-16 01:49:07'),
(121, 20, 'Breath', 0, 95, 0, 2, '1713250162breath.mp3', '2024-04-16 01:49:22'),
(122, 16, 'Stomp', 0, 95, 0, 65, '1713250835windowtotheworld.mp3', '2024-04-16 02:00:35'),
(123, 16, 'Easy', 0, 95, 0, 72, NULL, '2024-04-16 02:00:48'),
(124, 16, 'Progress', 0, 95, 0, 56, '1713250867partofme.mp3', '2024-04-16 02:01:07'),
(125, 16, 'Morning Coffee', 0, 95, 0, 1, '1713250888novascotia.mp3', '2024-04-16 02:01:28');

--
-- Triggers `songs`
--
DELIMITER $$
CREATE TRIGGER `one hundred` AFTER UPDATE ON `songs` FOR EACH ROW BEGIN
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
$$
DELIMITER ;

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
(68, 11),
(69, 56),
(70, 56),
(71, 56),
(72, 56),
(73, 56),
(74, 56),
(75, 57),
(76, 57),
(77, 57),
(78, 58),
(79, 59),
(80, 59),
(81, 59),
(82, 59),
(84, 60),
(85, 61),
(86, 61),
(87, 61),
(88, 61),
(89, 61),
(90, 61),
(93, 62),
(94, 62),
(95, 62),
(96, 62),
(97, 62),
(91, 63),
(92, 63),
(96, 64),
(97, 64),
(98, 64),
(99, 64),
(101, 64),
(103, 65),
(104, 65),
(105, 65),
(106, 65),
(107, 65),
(108, 65),
(109, 66),
(110, 66),
(111, 66),
(111, 67),
(112, 67),
(113, 67),
(114, 67),
(115, 67),
(116, 67),
(117, 67),
(118, 68),
(119, 68),
(120, 68),
(121, 69),
(122, 70),
(123, 70),
(124, 70),
(125, 71);

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
(38, 53),
(38, 54);

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
(38, 2, '2024-04-13 13:29:44'),
(7, 1, '2024-04-14 16:22:19'),
(7, 1, '2024-04-14 16:22:23'),
(8, 1, '2024-04-14 16:22:26'),
(9, 1, '2024-04-14 16:22:32'),
(7, 1, '2024-04-14 16:22:37'),
(7, 1, '2024-04-14 16:22:40'),
(9, 1, '2024-04-14 16:22:42'),
(10, 1, '2024-04-14 16:22:44'),
(8, 1, '2024-04-14 16:22:48'),
(7, 1, '2024-04-14 16:22:52'),
(9, 1, '2024-04-14 16:22:54'),
(11, 1, '2024-04-14 16:23:03'),
(12, 1, '2024-04-14 16:23:06'),
(10, 1, '2024-04-15 12:05:12'),
(9, 1, '2024-04-15 12:05:17'),
(8, 1, '2024-04-15 12:05:23'),
(7, 1, '2024-04-15 12:05:30'),
(11, 1, '2024-04-15 12:05:35'),
(11, 1, '2024-04-15 12:05:39'),
(11, 1, '2024-04-15 12:05:42'),
(11, 1, '2024-04-15 12:05:42'),
(11, 1, '2024-04-15 12:05:43'),
(11, 1, '2024-04-15 12:05:43'),
(125, 2, '2024-04-17 01:45:22'),
(125, 2, '2024-04-17 01:45:43'),
(124, 22, '2024-04-17 01:47:11'),
(124, 22, '2024-04-17 01:47:14'),
(124, 22, '2024-04-17 01:47:15'),
(122, 22, '2024-04-17 01:48:09'),
(122, 22, '2024-04-17 01:48:10'),
(122, 22, '2024-04-17 01:48:12'),
(125, 22, '2024-04-17 01:51:36'),
(125, 22, '2024-04-17 01:51:38'),
(124, 22, '2024-04-17 01:51:41'),
(124, 22, '2024-04-17 01:51:43'),
(125, 22, '2024-04-17 01:53:12'),
(125, 22, '2024-04-17 01:53:13'),
(125, 22, '2024-04-17 01:53:13'),
(125, 22, '2024-04-17 01:53:14'),
(124, 22, '2024-04-17 01:53:15'),
(124, 22, '2024-04-17 01:53:15'),
(124, 22, '2024-04-17 01:53:16'),
(123, 22, '2024-04-17 01:53:34'),
(123, 22, '2024-04-17 01:53:34'),
(123, 22, '2024-04-17 01:53:35'),
(123, 22, '2024-04-17 01:53:35'),
(104, 22, '2024-04-17 01:54:22'),
(104, 22, '2024-04-17 01:55:04'),
(78, 22, '2024-04-17 01:55:09'),
(78, 22, '2024-04-17 01:55:13'),
(78, 24, '2024-04-17 01:58:05'),
(78, 24, '2024-04-17 01:58:07'),
(78, 24, '2024-04-17 01:58:09'),
(7, 24, '2024-04-17 02:03:28'),
(7, 24, '2024-04-17 02:06:41'),
(7, 24, '2024-04-17 02:06:43'),
(7, 24, '2024-04-17 02:06:44'),
(7, 24, '2024-04-17 02:06:46'),
(7, 24, '2024-04-17 02:06:46'),
(7, 24, '2024-04-17 02:06:47'),
(7, 24, '2024-04-17 02:06:47'),
(7, 24, '2024-04-17 02:06:47'),
(7, 24, '2024-04-17 02:06:48'),
(7, 24, '2024-04-17 02:06:48'),
(7, 24, '2024-04-17 02:06:48'),
(7, 24, '2024-04-17 02:06:49');

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
(1, '3837b93dfc9f35387e136cd21e3a357e', '1713327568'),
(4, '4a25c66a46b4cf2209547c9a981e652e', '1711175722'),
(24, '5e25005c6c7437fe9e067da3be0941ed', '1713337035'),
(25, '16697104f2f56d0c288cf1aaa09ffbbe', '1713327142');

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
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`genre_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`);

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
  MODIFY `account_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `album_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `artists`
--
ALTER TABLE `artists`
  MODIFY `artist_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `playlists`
--
ALTER TABLE `playlists`
  MODIFY `playlist_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `songs`
--
ALTER TABLE `songs`
  MODIFY `song_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
