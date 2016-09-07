-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: May 23, 2016 at 05:51 PM
-- Server version: 5.5.48-cll
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `vivi1931_iehealth`
--

-- --------------------------------------------------------

--
-- Table structure for table `ie_objectives`
--

DROP TABLE IF EXISTS `ie_objectives`;
CREATE TABLE IF NOT EXISTS `ie_objectives` (
  `o_id` int(5) NOT NULL AUTO_INCREMENT,
  `p_id` int(5) NOT NULL,
  `o_name` varchar(100) NOT NULL,
  `o_description` text NOT NULL,
  `o_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`o_id`),
  KEY `p_id` (`p_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `ie_objectives`
--

INSERT INTO `ie_objectives` (`o_id`, `p_id`, `o_name`, `o_description`, `o_date`) VALUES
(2, 1, 'Objective 24', 'Work with int and ext stakeholders', '2016-04-17 07:21:49'),
(4, 3, 'Objective 1', 'Blue Objective 1', '2016-04-17 07:23:05'),
(8, 4, 'sdfdsf', 'sdfdsf', '2016-04-17 08:42:45'),
(9, 5, 'Objective 1', 'Work with internal and external stakeholders to reorient health services for the vulnerable populations in COB 2017', '2016-04-17 09:08:55'),
(10, 1, 'Objective 3s', 'By 2017 there will be an increase in understanding and application of livability indicators', '2016-04-17 09:31:13'),
(11, 1, 'Object 45', 'Do this 45 times111', '2016-04-24 07:00:46'),
(12, 6, 'Objective 5.1', 'Promote healthy activities through a web-enabled database', '2016-05-13 02:10:46'),
(13, 3, 'test', 'Prp', '2016-05-15 09:14:28'),
(14, 5, 'Objective 2', 'Create an environmental prevention program to reduce the harm associated with increased drug and alcohol use by June 2015.', '2016-05-15 09:35:08'),
(15, 5, 'Objective 3', 'Establish community structures which connect the Ashburton, Ashwood and Chadstone communities to support their health and wellbeing by June 2017.', '2016-05-15 09:35:22'),
(16, 1, 'Objective 5', 'Develop and maintain processes internally at iehealth that supports access to healthier food options for staff and clients by June 2016', '2016-05-17 03:22:06'),
(17, 3, 'Objective 5', 'Develop and maintain processes internally at iehealth that supports access to healthier food options for staff and clients by June 2016', '2016-05-17 03:23:10'),
(18, 4, 'test', 'test', '2016-05-17 05:50:14'),
(19, 4, 'Objective 7: Regional Objective', 'Increase the number of organisations in the EMR with gender equitable policies, procedures and practice.', '2016-05-17 05:53:48');

-- --------------------------------------------------------

--
-- Table structure for table `ie_priority`
--

DROP TABLE IF EXISTS `ie_priority`;
CREATE TABLE IF NOT EXISTS `ie_priority` (
  `p_id` int(5) NOT NULL AUTO_INCREMENT,
  `p_name` varchar(50) NOT NULL,
  `p_description` text NOT NULL,
  `p_color` varchar(20) NOT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `ie_priority`
--

INSERT INTO `ie_priority` (`p_id`, `p_name`, `p_description`, `p_color`) VALUES
(1, 'Promoting Mental Health Through Social Inclusion', 'zxzxx', 'FFCC00'),
(3, 'Access To Healthy Food', 'asasasasa', '3420FF'),
(4, 'Preventing Violence Against Women & Gender Equity', 'sdsdddsd', '89FFED'),
(5, 'Reducing Harmful Alcohol & Drug Use', 'sdsds', 'FF7065'),
(6, 'Healthy Australia Club', 'asasas', '43FF57');

-- --------------------------------------------------------

--
-- Table structure for table `ie_strategies`
--

DROP TABLE IF EXISTS `ie_strategies`;
CREATE TABLE IF NOT EXISTS `ie_strategies` (
  `s_id` int(5) NOT NULL AUTO_INCREMENT,
  `o_id` int(5) NOT NULL,
  `s_name` varchar(100) NOT NULL,
  `s_description` text NOT NULL,
  `s_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`s_id`),
  KEY `o_id` (`o_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `ie_strategies`
--

INSERT INTO `ie_strategies` (`s_id`, `o_id`, `s_name`, `s_description`, `s_date`) VALUES
(2, 4, 'Strategy 5.1', 'Something blue', '2016-04-17 09:05:50'),
(3, 9, 'Strategy 5.1', 'DO this do that', '2016-04-17 09:09:18'),
(4, 2, 'Strategy 1.1', 'something yellowsss', '2016-04-17 09:09:57'),
(5, 2, 'Strategy 1.2', 'ssdsds sd', '2016-04-24 07:32:37'),
(6, 10, 'Strategy 3.1', 'Actively contribute to DHHS Livability Demonstration Project by applying local perspective and connection to the community', '2016-05-13 01:22:28'),
(7, 12, 'Strategy 5.1', 'Creation of a healthy activities database, mobile phone application and manual system for a rewards scheme', '2016-05-13 02:11:30'),
(8, 12, 'Strategy 5.2', 'Develop and implement a marketing and recruitment strategy to encourage participation from members and providers', '2016-05-13 02:12:09'),
(9, 13, 'test 2', 'testing 2', '2016-05-15 09:15:03'),
(10, 9, '1.1', 'Coordination of a regular community activity in partnership with local organisations (Community Lunch), to then work towards having community members take over the facilitation.', '2016-05-15 09:37:20'),
(11, 9, '1.2', 'Capture and analysis of baseline data from internal software programs around service accessibility in Ashburton community team.', '2016-05-15 09:56:24'),
(12, 14, '2.1', 'Develop an action plan for the installation of harm reduction methods into the public housing estates in Ashburton.', '2016-05-15 09:58:27'),
(13, 14, '2.2', 'Develop and implementation of a social norming campaign in the public housing estates addressing safe use of alcohol and drugs and access to treatment services.', '2016-05-15 10:03:44'),
(14, 14, '2.3', 'Advocate to local agencies for the establishment of a Needle and Syringe Program to service the Ashburton community. Note: results of advocacy may adjust scope of intervention in future years.', '2016-05-15 10:03:58'),
(15, 14, '2.4', 'Develop a pathway to connect people with AOD treatment services.', '2016-05-15 10:04:13'),
(16, 8, 'sdasas', 'kfdf', '2016-05-15 10:13:02'),
(17, 15, '3.1', 'With MonashLink facilitate an action plan for food access and affordability in Ashburton, Ashwood and Chadstone areas.', '2016-05-15 10:19:21'),
(18, 15, '3.2', 'Assist MonashLink CHS with knowledge transfer, based on experience operating community gardens associated with housing estates', '2016-05-15 10:19:33'),
(19, 15, '3.3', 'Actively participate in CoB reference group around food security', '2016-05-15 10:19:45'),
(20, 17, 'Strategy 5.1', 'Advocate for the uniform application of newly revised healthy food guidelines policy at all iehealth services and programs', '2016-05-17 03:24:18'),
(21, 19, 'Strategy 7.1.1', 'Work with iehealth management team and HR to write a gender equity statement, policy or strategy.', '2016-05-17 05:54:59');

-- --------------------------------------------------------

--
-- Table structure for table `ie_tasks`
--

DROP TABLE IF EXISTS `ie_tasks`;
CREATE TABLE IF NOT EXISTS `ie_tasks` (
  `t_id` int(20) NOT NULL AUTO_INCREMENT,
  `s_id` int(5) NOT NULL,
  `t_short_desc` varchar(200) NOT NULL,
  `t_desc` text NOT NULL,
  `t_status` varchar(20) NOT NULL DEFAULT '0',
  `reason` text NOT NULL,
  `t_owner` varchar(50) NOT NULL,
  `t_member` varchar(200) NOT NULL,
  `t_link_id` int(5) NOT NULL,
  `t_start_date` date NOT NULL,
  `t_end_date` date NOT NULL,
  `t_last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`t_id`),
  KEY `p_id` (`s_id`),
  KEY `s_id` (`s_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `ie_tasks`
--

INSERT INTO `ie_tasks` (`t_id`, `s_id`, `t_short_desc`, `t_desc`, `t_status`, `reason`, `t_owner`, `t_member`, `t_link_id`, `t_start_date`, `t_end_date`, `t_last_updated`) VALUES
(3, 3, 'Staff Consultation', 'Staff Consultations', 'Open', '', 'Vinh Kim', 'Dany Xander', 1, '2016-04-13', '2016-05-12', '2016-04-30 07:51:03'),
(7, 4, 'Documenting staff feedback', 'surveys created for staff feedback', 'Completed', '', 'Vinh Kim', 'Anthony Cooper', 1, '2016-04-13', '2016-05-12', '2016-05-13 03:03:55'),
(8, 4, 'Staff Consultationss', 'Staff consulting', 'Not Started', '', 'Vinh Kim', 'David Towl,Anthony Cooper', 1, '2016-04-30', '2016-04-07', '2016-05-15 14:07:41'),
(10, 4, 'Caterer Consultations', 'Consultation', 'Never Started', '', 'Vinh Kim', 'David Towl', 0, '2016-05-01', '2016-06-02', '2016-05-01 10:05:59'),
(11, 4, 'Attended workshop', 'Workshop', 'Completed', '', 'Vinh Kim', 'ASD ADAS', 0, '2016-06-02', '2016-06-05', '2016-05-01 10:06:57'),
(12, 4, 'Investigate local catering', 'Investigate', 'Open', '', 'Admin Admin', 'Anthony Cooper', 1, '2016-06-01', '2016-06-03', '2016-05-13 01:52:03'),
(13, 4, 'testing', 'dsdsdsd', 'Open', '', 'Vinh Kim', 'Dany Xander,Anthony Cooper', 1, '2016-06-01', '2016-06-05', '2016-05-15 14:07:49'),
(14, 6, 'Create TOR for Livability Steering Committee', 'Create TOR for Livability Steering Committee', 'Open', '', 'Admin Admin', 'David Towl', 1, '2016-05-13', '2016-05-18', '2016-05-13 01:40:57'),
(15, 7, 'Mobile applications quotes', '3 quotes from different suppliers', 'Open', '', 'Admin Admin', 'David Towl', 1, '2016-05-16', '2016-05-31', '2016-05-13 02:15:07'),
(16, 9, 'test', 'a testing task', 'Open', '', 'David Towl', 'David Towl,Admin Admin', 0, '2016-05-17', '2016-06-03', '2016-05-15 14:07:57'),
(17, 10, 'Community Lunch', 'working group to help them', 'Not Started', '', 'David Towl', 'Anthony Cooper', 0, '2016-05-18', '2016-05-24', '2016-05-15 10:54:09'),
(18, 20, 'Draft Guidelines', 'Work closely with the Dietetics team to create Healthy Food Guidelines document', 'Open', '', 'Heather Cole', 'David Towl', 0, '2016-05-17', '2016-06-14', '2016-05-17 03:28:13'),
(19, 21, 'Complete organisational work plan around gender equity', 'Complete organisational work plan around gender equity', 'Not Started', '', 'Daisy Brundell', 'Heather Cole,Daisy Brundel', 0, '2016-05-17', '2016-06-21', '2016-05-17 05:56:21');

-- --------------------------------------------------------

--
-- Table structure for table `ie_update`
--

DROP TABLE IF EXISTS `ie_update`;
CREATE TABLE IF NOT EXISTS `ie_update` (
  `up_id` int(20) NOT NULL AUTO_INCREMENT,
  `t_id` int(20) NOT NULL,
  `up_name` varchar(50) NOT NULL,
  `up_type` varchar(20) NOT NULL,
  `up_desc` varchar(200) NOT NULL,
  `up_file` text NOT NULL,
  `worthy` tinyint(1) NOT NULL DEFAULT '0',
  `ceo_report` tinyint(1) NOT NULL DEFAULT '0',
  `close_date` date NOT NULL,
  `create_date` date NOT NULL,
  `close` tinyint(1) NOT NULL,
  PRIMARY KEY (`up_id`),
  KEY `t_id` (`t_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `ie_update`
--

INSERT INTO `ie_update` (`up_id`, `t_id`, `up_name`, `up_type`, `up_desc`, `up_file`, `worthy`, `ceo_report`, `close_date`, `create_date`, `close`) VALUES
(1, 7, 'Copy Of draft123', 'Issue', 'Copys', '2410062559102.pdf', 1, 1, '2016-05-09', '2016-05-11', 1),
(6, 7, 'Unit Testing', 'Progress', 'Testing', '24100625591021.pdf', 1, 1, '0000-00-00', '2016-05-01', 0),
(7, 7, 'Test', 'Issue', 'Test', '', 1, 0, '0000-00-00', '2016-05-02', 0),
(8, 7, 'Testing', 'Report', 'test', '', 1, 1, '0000-00-00', '2016-05-02', 0),
(9, 14, 'Meeting Agenda', 'Upload', 'Livability Steering Committtee agenda', 'HP_Agenda_IHP_Team_Meeting_20150818.docx', 0, 1, '0000-00-00', '2016-05-13', 0),
(10, 15, 'Stamp Me for Mobile Phone Application', 'Progress', 'Stamp Me has been contracted', '', 1, 0, '0000-00-00', '2016-05-13', 0),
(11, 17, 'Working Group', 'Progress', 'kmdsd', 'adding_a_strategy1.png', 1, 1, '0000-00-00', '2016-05-15', 0),
(12, 17, 'Working Group 1', 'Progress', 'Working Group established with Terms of Reference', 'adding_a_strategy2.png', 1, 1, '0000-00-00', '2016-05-15', 0),
(13, 18, 'Draft Guidelines', 'Upload', 'Copy of the draft guidelines', '', 0, 0, '0000-00-00', '2016-05-17', 0),
(14, 19, 'Work plan staff surveys', 'Progress', 'Staff feedback', '', 0, 0, '0000-00-00', '2016-05-17', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ie_user`
--

DROP TABLE IF EXISTS `ie_user`;
CREATE TABLE IF NOT EXISTS `ie_user` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_name` varchar(20) NOT NULL,
  `u_last_name` varchar(50) NOT NULL,
  `u_email` varchar(150) NOT NULL,
  `u_password` varchar(150) NOT NULL,
  `u_login_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `u_status` tinyint(1) NOT NULL DEFAULT '0',
  `admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `ie_user`
--

INSERT INTO `ie_user` (`u_id`, `u_name`, `u_last_name`, `u_email`, `u_password`, `u_login_time`, `u_status`, `admin`) VALUES
(2, 'vinh', 'kim', 'kvlong88@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2016-03-26 08:16:32', 0, 1),
(5, 'dany', 'Xander', 'dxander@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2016-03-27 04:43:20', 0, 0),
(6, 'ASD', 'aDAS', 'SSS@YAHOO.COM', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2016-04-07 04:27:56', 0, 0),
(7, 'David', 'Towl', 'dtowl@iehealth.org.au', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2016-04-07 09:04:35', 0, 0),
(8, 'Anthony', 'Cooper', 'acooper@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2016-04-30 04:30:23', 0, 0),
(9, 'admin', 'admin', 'admin@iehealth.org.au', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2016-05-01 10:59:16', 0, 1),
(10, 'sara', 'connor', 'sara@connor.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2016-05-17 01:04:50', 1, 0),
(11, 'Heather', 'Cole', 'heather.cole@iehealth.org.au', '149a66e99d6504afc08774d6aa5d6e463a81b293', '2016-05-17 03:10:33', 0, 1),
(12, 'Daisy', 'Brundell', 'daisy.brundell@iechs.org.au', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2016-05-17 04:25:04', 1, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ie_objectives`
--
ALTER TABLE `ie_objectives`
  ADD CONSTRAINT `fk_objectives` FOREIGN KEY (`p_id`) REFERENCES `ie_priority` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ie_strategies`
--
ALTER TABLE `ie_strategies`
  ADD CONSTRAINT `fk_strategy` FOREIGN KEY (`o_id`) REFERENCES `ie_objectives` (`o_id`);

--
-- Constraints for table `ie_tasks`
--
ALTER TABLE `ie_tasks`
  ADD CONSTRAINT `fk_task_strategy` FOREIGN KEY (`s_id`) REFERENCES `ie_strategies` (`s_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ie_update`
--
ALTER TABLE `ie_update`
  ADD CONSTRAINT `fk_update` FOREIGN KEY (`t_id`) REFERENCES `ie_tasks` (`t_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
