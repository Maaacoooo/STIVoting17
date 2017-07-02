-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2017 at 02:53 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sti_voting`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

CREATE TABLE `candidate` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `course` varchar(255) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL,
  `party` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `candidate`
--

INSERT INTO `candidate` (`id`, `name`, `position`, `course`, `year`, `party`, `img`) VALUES
(2, 'Stephen Tumarong', 'President', 'HRS', 'II', 'STIers League', '13666a9169a1ba0482f396d27a4cdef5.jpg'),
(3, 'Kip Fuego', 'ITP Representative', 'ITP', 'I', 'STIers League', 'ca03e1ab8df05facadae100b7abadfb0.jpg'),
(4, 'Elmer Macalla', 'BSCS Representative', 'BSCS', 'IV', 'STIers League', '3faf18573eb821c892d75a3de1ae086b.jpg'),
(12, 'Maco Cortes', 'President', 'BSCS', 'II', 'Bangon STI', '240d435b741f363bc872924d9d7069f7.jpg'),
(13, 'Dale Bryan Ayuban', 'BSCS Representative', 'BSCS', 'II', 'Bangon STI', '73238817002899d208e3564cd89f2d6f.jpg'),
(14, 'Joshua Clamohoy', 'Vice-President', 'BSCS', 'IV', 'Bangon STI', 'ad6a86f2a4c804b2eab042b51a929253.jpg'),
(15, 'Juren Garing', 'Secretary', 'BSCS', 'IV', 'Bangon STI', 'a84dcc257d30f6d93cba8e562cfb8084.jpg'),
(16, 'Julia Kane', 'HRS  Representative', 'HRS', 'II', 'STIers League', '44043befcabdf59d4e9062871194c799.jpg'),
(17, 'Joizel Bartolome', 'Treasurer', 'HRS', 'II', 'STIers League', '7a3e850c6c78b111225a0f29b641952b.jpg'),
(18, 'Hygen Abad', 'Auditor', 'HRS', 'II', 'Bangon STI', 'e8b56a7ce1117397dc839aefcde7111f.jpg'),
(19, 'Julius Bondaco', 'Senior HS  Representative', 'SHS-CA', 'G11', 'STIers League', 'ed53423bdb53e4b6fff539f88f65de36.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('b3ev12g8fjuvab2014ejpih2a9e3dtop', '::1', 1498825997, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439383832353939373b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('llsgcjv0atl86her8ka9m989ggf4tbta', '::1', 1498826315, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439383832363331353b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('m5c83m0kg6ee160d4fcr17c6m26t9gka', '::1', 1498826645, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439383832363634353b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('011kia39kgjbd49a9jm3o9ngub4sqvg8', '::1', 1498826971, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439383832363937313b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('njkkhalac725lt75k37dh3oneaf0sms2', '::1', 1498827615, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439383832373631353b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('669n6tc80k9ps2k3sbq1mts6km134i5u', '::1', 1498828538, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439383832383533383b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('v1saoq3fvtlhdb00bp0vn034qb6i1894', '::1', 1498828842, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439383832383834323b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('k9ooghun8h23qtjrrrd4k5fpnduqp677', '::1', 1498829197, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439383832393139373b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('len73m9or7vm7f3q489p0chijh78df5m', '::1', 1498829231, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439383832393139373b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('m8597q2duglu661bak5ho8gsu65nfcch', '::1', 1498985063, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439383938353036333b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('dda8vepmrlkh5vrvqqvfl3vd03nt2c9s', '::1', 1498985365, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439383938353336353b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('a9993gjqvjn42lgd0h497flknqj9csge', '::1', 1498985671, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439383938353637313b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('ja3v15hgotoj33gqf363hhlg2vqts8ef', '::1', 1498986090, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439383938363039303b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('gur3q38dt88t7chiri1ri6qirf76fgam', '::1', 1498986467, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439383938363436373b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('i3blcmgbd829ph52srge803ms7633f88', '::1', 1498986769, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439383938363736393b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('dfiht39ibb9cergp17mp1g4ovqht77gt', '::1', 1498987188, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439383938373138383b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('pe5pt7pko5tk17arjiuk875kbtafa3p4', '::1', 1498987490, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439383938373439303b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('qtbfgit2ltdh3crpuajkjnu8s0mkiqmu', '::1', 1498987794, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439383938373739343b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('8fflnamfb9lkjmulj2hl8a66fht01s6l', '::1', 1498990729, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439383939303732393b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('0pp69k10h5u9cna79bfigv2l0ko882sn', '::1', 1498994046, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439383939343034363b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('bh7esg1t42tp0gr72j4evric8i92p2hr', '::1', 1498994351, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439383939343335313b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('ec8ehl66bhkq9lfq1vgp1gvkgmu03ks2', '::1', 1498994704, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439383939343730343b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('hfsp0ekd8v6us6lkggkqnjpspgiq4a84', '::1', 1498995052, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439383939353035323b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('23ps3bdvn7u75log250sdi25q0uihn2i', '::1', 1498995356, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439383939353335363b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('r6gj03qsedkev8js46pu0fvmuuidel1c', '::1', 1498995708, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439383939353730383b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('begt4tpjev5u87uqnu9k77u14fekclpe', '::1', 1498996050, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439383939363035303b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('17mep4pdbgkieljb699020tm4bd4774h', '::1', 1498996459, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439383939363435393b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('tfjkobbtqogt3flor8pbim5vv7m1t2li', '::1', 1498996784, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439383939363738343b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d766f7465725f6c6f676765645f696e7c613a313a7b733a383a22766f746570617373223b733a363a224554376f487a223b7d),
('0v4f4s80jb7dn9356a2n2tdnsq1ifqmk', '::1', 1498997101, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439383939373130313b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d766f7465725f6c6f676765645f696e7c613a313a7b733a383a22766f746570617373223b733a363a224554376f487a223b7d),
('t8pih8ur0imuraf8o4udvm61hj7pq6jq', '::1', 1498997423, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439383939373432333b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d766f7465725f6c6f676765645f696e7c613a313a7b733a383a22766f746570617373223b733a363a224554376f487a223b7d),
('tguevqbt6fkidvvhslnng3cfb7t6ffos', '::1', 1498997745, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439383939373734353b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('9ream3vhjhl2hl45hi2sbo9bre75nbq8', '::1', 1498998051, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439383939383035313b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('rrsfmat2838cl43vrdgigh2omc0kncmr', '::1', 1498998480, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439383939383438303b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('9ja0a8jior0cusn61rbkdhu1m33cp8fl', '::1', 1498999126, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439383939393132363b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d737563636573737c733a32313a22537563636573212050616765205570646174656421223b5f5f63695f766172737c613a313a7b733a373a2273756363657373223b733a333a226f6c64223b7d),
('oav766hmcfmfo1leufqs6tm8364b7g5c', '::1', 1498999521, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439383939393532313b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('3rnv0b2jcg2797t3mtcbi6ttphvl7bur', '::1', 1498999834, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439383939393833343b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d),
('04mn5d4kbtm7efgkdfiuj3k0ths3e3bm', '::1', 1498999996, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439383939393833343b61646d696e5f6c6f676765645f696e7c613a313a7b733a383a22757365726e616d65223b733a343a226d61636f223b7d737563636573737c733a33333a22537563636573732120566f74696e67205061737365732047656e65726174656421223b5f5f63695f766172737c613a313a7b733a373a2273756363657373223b733a333a226f6c64223b7d);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`title`) VALUES
('BSCS'),
('CCE'),
('HRS'),
('ITP'),
('SHS-CA'),
('SHS-HO'),
('SHS-MAWE');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `action` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `user` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `party`
--

CREATE TABLE `party` (
  `title` varchar(255) NOT NULL,
  `color` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `party`
--

INSERT INTO `party` (`title`, `color`, `img`) VALUES
('Bangon STI', 'pink', NULL),
('STIers League', 'green', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `title` varchar(255) NOT NULL,
  `is_multiple` int(11) DEFAULT '0',
  `limit_vote` int(11) DEFAULT NULL,
  `placeorder` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`title`, `is_multiple`, `limit_vote`, `placeorder`) VALUES
('Auditor', 0, NULL, 4),
('BSCS Representative', 0, NULL, 8),
('HRS  Representative', 0, NULL, 7),
('ITP Representative', 0, NULL, 6),
('President', 0, NULL, 1),
('Secretary', 0, NULL, 5),
('Senior HS  Representative', 0, NULL, 9),
('Treasurer', 0, NULL, 3),
('Vice-President', 0, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `key` varchar(255) NOT NULL,
  `value` text,
  `setting_grp` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `hint` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`key`, `value`, `setting_grp`, `title`, `hint`) VALUES
('publish_vote_result', '1', 'vote_setting', 'Publish Vote Results', 'This publishes the Voting Results. If set to FALSE, the system will display censored data.'),
('vote_error', '<p>We are very sorry for this inconvenience! :(</p><p>Please contact the Election Supervisor and/or the Developer, and submit your Voting Pass.</p>', 'vote_page', 'Oops! An Error has Occured', 'The Error Page. Shown when error has occurred.'),
('vote_instruc', '<p>By using the Voting System, please be guided accordingly:</p><ol><li>You must secure your<strong> VOTING PASS.</strong></li><li>You can only choose one candidate per position</li><li>You can only vote <strong>ONCE</strong>.</li><li>You must vote all positions.</li><li>If you wish to vote later, proceed to the lower part of the page and click <strong>Vote Later</strong> or <strong>Submit Later</strong>.</li><li>After selecting your candidate, review the form before submitting. The system will prohibit you from<br />submitting if all candidates are not checked.</li><li>After submitting, please be sure that the system will redirect you into a&nbsp;<strong>Success Page</strong>. If it redirects you to<br />an&nbsp;<strong>Error Page</strong>, please contact the Voting Supervisor or the System Developer with your Voting Pass.</li><li>and Please don&#39;t forget to rate the experience of your voting! :)</li></ol><p>Happy Voting! Please proceed to the Voting Page...</p>', 'vote_page', 'General Instructions', 'The General Instructions of the Voting Page. This is displayed right after the voter has logged in'),
('vote_success', '<p>Thank you for voting! To check the results, please visit the&nbsp;<a href=\"http://localhost/sti_voting/vote/results\">Result Page</a>.</p><p>Are you happy with the new Voting System? Rate us a Five Star!</p>', 'vote_page', 'Your vote is Submitted!', 'The Success Page of the Voting. This is displayed right after the voter has submitted his vote.'),
('voting_status', '0', 'vote_setting', 'Voting Status', 'You can control the Voting Status. If set to FALSE, the system will disable the voting.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `usertype` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `name`, `usertype`, `img`, `created_at`, `updated_at`) VALUES
('maco', '$2y$10$yXXbqfWB.Xi0yZ1QSXoMQeP1vtcwQmafC8ImZ0xE2haP/4SIz7fie', 'Maco Cortes', 'Administrator', NULL, '2017-06-18 11:33:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `usertypes`
--

CREATE TABLE `usertypes` (
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usertypes`
--

INSERT INTO `usertypes` (`title`) VALUES
('Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `candidate_id` varchar(255) DEFAULT NULL,
  `vote_pass` varchar(255) DEFAULT NULL,
  `datetime` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vote_keys`
--

CREATE TABLE `vote_keys` (
  `key` varchar(255) NOT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_used` int(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vote_keys`
--

INSERT INTO `vote_keys` (`key`, `updated_at`, `is_used`) VALUES
('6QSWMb', '2017-07-02 20:53:16', 0),
('aNKxZ2', '2017-07-02 20:53:16', 0),
('AyNb2l', '2017-07-02 20:53:16', 0),
('c3wZE6', '2017-07-02 20:53:16', 0),
('ETefVy', '2017-07-02 20:53:16', 0),
('IW6Cqh', '2017-07-02 20:53:16', 0),
('NoKXUr', '2017-07-02 20:53:16', 0),
('oSZGHm', '2017-07-02 20:53:16', 0),
('rDXbd9', '2017-07-02 20:53:16', 0),
('RGTsAl', '2017-07-02 20:53:16', 0),
('W5P38i', '2017-07-02 20:53:16', 0);

-- --------------------------------------------------------

--
-- Table structure for table `year`
--

CREATE TABLE `year` (
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `year`
--

INSERT INTO `year` (`title`) VALUES
('G11'),
('G12'),
('I'),
('II'),
('III'),
('IV');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidate`
--
ALTER TABLE `candidate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKcourse` (`course`),
  ADD KEY `FKyear` (`year`),
  ADD KEY `FKposition` (`position`),
  ADD KEY `FKparty` (`party`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`title`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKuser` (`user`);

--
-- Indexes for table `party`
--
ALTER TABLE `party`
  ADD PRIMARY KEY (`title`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`title`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD KEY `FKusertype` (`usertype`);

--
-- Indexes for table `usertypes`
--
ALTER TABLE `usertypes`
  ADD PRIMARY KEY (`title`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vote_keys`
--
ALTER TABLE `vote_keys`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `year`
--
ALTER TABLE `year`
  ADD PRIMARY KEY (`title`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidate`
--
ALTER TABLE `candidate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `candidate`
--
ALTER TABLE `candidate`
  ADD CONSTRAINT `FKcourse` FOREIGN KEY (`course`) REFERENCES `course` (`title`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FKparty` FOREIGN KEY (`party`) REFERENCES `party` (`title`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FKposition` FOREIGN KEY (`position`) REFERENCES `position` (`title`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FKyear` FOREIGN KEY (`year`) REFERENCES `year` (`title`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `FKuser` FOREIGN KEY (`user`) REFERENCES `users` (`username`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FKusertype` FOREIGN KEY (`usertype`) REFERENCES `usertypes` (`title`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
