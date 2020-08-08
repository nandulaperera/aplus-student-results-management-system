-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2020 at 11:56 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myapp`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `getStudentResults` (IN `studentID` VARCHAR(15), IN `year` INT, IN `semester` INT)  BEGIN

IF(year='') THEN
SELECT (sum(g.gpa*(sub.lecture_credits+sub.practical_credits)))/sum(sub.lecture_credits+sub.practical_credits) AS gpa, d.class
FROM student AS stu, grades AS g, subject AS sub, student_marks AS m, degree_class AS d
WHERE m.grade=g.grade AND m.student_id=stu.student_id AND m.student_id=studentID AND sub.subject_code=m.subject_code AND sub.semester=m.semester AND (GPA BETWEEN d.gpa_min and d.gpa_max);

ELSE
IF(semester='') THEN
SELECT (sum(g.gpa*(sub.lecture_credits+sub.practical_credits)))/sum(sub.lecture_credits+sub.practical_credits) AS gpa, d.class
FROM student AS stu, grades AS g, subject AS sub, student_marks AS m, degree_class AS d
WHERE m.grade=g.grade AND m.student_id=stu.student_id AND m.student_id=studentID AND sub.subject_code=m.subject_code AND sub.semester=m.semester AND (GPA BETWEEN d.gpa_min and d.gpa_max) AND m.year=year;

ELSE

SELECT (sum(g.gpa*(sub.lecture_credits+sub.practical_credits)))/sum(sub.lecture_credits+sub.practical_credits) AS gpa, d.class
FROM student AS stu, grades AS g, subject AS sub, student_marks AS m, degree_class AS d
WHERE m.grade=g.grade AND m.student_id=stu.student_id AND m.student_id=studentID AND sub.subject_code=m.subject_code AND sub.semester=m.semester AND (GPA BETWEEN d.gpa_min and d.gpa_max) AND m.year=year AND m.semester=semester;

END IF;
END IF;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `degree_class`
--

CREATE TABLE `degree_class` (
  `class` varchar(255) NOT NULL,
  `gpa_min` float NOT NULL,
  `gpa_max` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `degree_class`
--

INSERT INTO `degree_class` (`class`, `gpa_min`, `gpa_max`) VALUES
('FC', 3.7, 4),
('NM', 2, 2.9),
('SL', 3, 3.29),
('SU', 3.3, 3.69);

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `grade` char(5) NOT NULL,
  `low` int(11) NOT NULL,
  `high` int(11) NOT NULL,
  `gpa` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`grade`, `low`, `high`, `gpa`) VALUES
('A', 70, 84, 4),
('A+', 85, 100, 4),
('A-', 65, 69, 3.7),
('B', 55, 59, 3),
('B+', 60, 64, 3.3),
('B-', 50, 54, 2.7),
('C', 40, 44, 2),
('C+', 45, 49, 2.3),
('C-', 35, 39, 1.7),
('D', 25, 29, 1),
('D+', 30, 34, 1.3),
('E', 0, 24, 0);

-- --------------------------------------------------------

--
-- Table structure for table `lecturer`
--

CREATE TABLE `lecturer` (
  `lecturer_code` varchar(10) NOT NULL,
  `lecturer_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_no` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` varchar(15) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `student_name`, `year`, `email`) VALUES
('18121069', 'D.E.F Fernando', 2, 'def.fernando@gmail.com'),
('18121173', 'A.B.C Perera', 2, 'abc.perera@gmail.com'),
('19141313', 'B.C.De Silva', 1, 'bc.desilva@gmail.com'),
('19145210', 'W.B.A Perera', 1, 'wba.perera@gmail.com');

-- --------------------------------------------------------

--
-- Stand-in structure for view `student_marks`
-- (See below for the actual view)
--
CREATE TABLE `student_marks` (
`subject_code` varchar(10)
,`subject_name` varchar(255)
,`year` int(11)
,`semester` int(11)
,`student_id` varchar(15)
,`student_name` varchar(255)
,`marks` float
,`grade` char(5)
);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subject_id` varchar(255) NOT NULL,
  `subject_code` varchar(10) NOT NULL,
  `subject_name` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `lecture_credits` int(11) NOT NULL,
  `practical_credits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_id`, `subject_code`, `subject_name`, `year`, `semester`, `lecture_credits`, `practical_credits`) VALUES
('SCS 12011', 'SCS 1201', 'Data Structures and Algorithms I', 1, 1, 2, 1),
('SCS 12021', 'SCS 1202', 'Programming I', 1, 1, 2, 1),
('SCS 12031', 'SCS 1203', 'Database I', 1, 1, 2, 1),
('SCS 12041', 'SCS 1204', 'Discrete Mathematics I', 1, 1, 2, 0),
('SCS 12051', 'SCS 1205', 'Computer Systems', 1, 1, 2, 0),
('SCS 12061', 'SCS 1206', 'Laboratory I', 1, 1, 1, 1),
('SCS 12071', 'SCS 1207', 'Software Engineering I', 1, 1, 2, 0),
('SCS 12082', 'SCS 1208', 'Data Structures and Algorithms I', 1, 2, 2, 1),
('SCS 12092', 'SCS 1209', 'Object Oriented Programming', 1, 2, 2, 1),
('SCS 12102', 'SCS 1210', 'Software Engineering II', 1, 2, 2, 0),
('SCS 12112', 'SCS 1211', 'Mathematical Methods I', 1, 2, 2, 0),
('SCS 12122', 'SCS 1212', 'Foundations of Computer Science', 1, 2, 2, 0),
('SCS 12132', 'SCS 1213', 'Probability and Statistics', 1, 2, 2, 0),
('SCS 12142', 'SCS 1214', 'Operating Systems I', 1, 2, 2, 1),
('SCS 22011', 'SCS 2201', 'Data Structures and Algorithms III', 2, 1, 2, 1),
('SCS 22021', 'SCS 2202', 'Group Project I', 2, 1, 4, 0),
('SCS 22022', 'SCS 2202', 'Group Project I', 2, 2, 4, 0),
('SCS 22031', 'SCS 2203', 'Software Engineering III', 2, 1, 2, 0),
('SCS 22041', 'SCS 2204', 'Functional Programming', 2, 1, 2, 1),
('SCS 22051', 'SCS 2205', 'Computer Networks I', 2, 1, 2, 1),
('SCS 22061', 'SCS 2206', 'Mathematical Methods II', 2, 1, 2, 0),
('SCS 22071', 'SCS 2207', 'Programming Language Concepts', 2, 1, 2, 0),
('SCS 22081', 'SCS 2208', 'Rapid Application Development', 2, 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subject_marks`
--

CREATE TABLE `subject_marks` (
  `subject_id` varchar(255) NOT NULL,
  `student_id` varchar(15) NOT NULL,
  `marks` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subject_marks`
--

INSERT INTO `subject_marks` (`subject_id`, `student_id`, `marks`) VALUES
('SCS 12011', '18121069', 75),
('SCS 12011', '18121173', 90),
('SCS 12011', '19141313', 58),
('SCS 12021', '18121069', 80),
('SCS 12021', '18121173', 100),
('SCS 12021', '19141313', 85),
('SCS 12031', '18121069', 85),
('SCS 12031', '18121173', 75),
('SCS 12031', '19141313', 64),
('SCS 12041', '18121069', 60),
('SCS 12041', '18121173', 85),
('SCS 12041', '19141313', 70),
('SCS 12051', '18121069', 90),
('SCS 12051', '18121173', 80),
('SCS 12051', '19141313', 50),
('SCS 12061', '18121069', 100),
('SCS 12061', '18121173', 90),
('SCS 12061', '19141313', 68),
('SCS 12071', '18121069', 80),
('SCS 12071', '18121173', 95),
('SCS 12071', '19141313', 74),
('SCS 22011', '18121069', 64),
('SCS 22011', '18121173', 85),
('SCS 22021', '18121173', 95);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `fullName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `privilege` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`fullName`, `email`, `password`, `privilege`) VALUES
('A.B.C Perera', 'abc.perera@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Student'),
('B.C De Silva', 'bc.desilva@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Student'),
('D.E.F Fernando', 'def.fernando@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Student'),
('Lecturer', 'lecturer@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Admin'),
('Nandula Perera', 'nandulaperera@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Admin'),
('Nandula Perera', 'pereranandula1999@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Admin');

-- --------------------------------------------------------

--
-- Structure for view `student_marks`
--
DROP TABLE IF EXISTS `student_marks`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `student_marks`  AS  select `sub`.`subject_code` AS `subject_code`,`sub`.`subject_name` AS `subject_name`,`sub`.`year` AS `year`,`sub`.`semester` AS `semester`,`stu`.`student_id` AS `student_id`,`stu`.`student_name` AS `student_name`,`m`.`marks` AS `marks`,`g`.`grade` AS `grade` from (((`student` `stu` join `subject` `sub`) join `subject_marks` `m`) join `grades` `g`) where ((`sub`.`subject_id` = `m`.`subject_id`) and (`stu`.`student_id` = `m`.`student_id`) and (`m`.`marks` between `g`.`low` and `g`.`high`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `degree_class`
--
ALTER TABLE `degree_class`
  ADD PRIMARY KEY (`class`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`grade`);

--
-- Indexes for table `lecturer`
--
ALTER TABLE `lecturer`
  ADD PRIMARY KEY (`lecturer_code`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `subject_marks`
--
ALTER TABLE `subject_marks`
  ADD PRIMARY KEY (`subject_id`,`student_id`),
  ADD KEY `FK2` (`student_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `subject_marks`
--
ALTER TABLE `subject_marks`
  ADD CONSTRAINT `FK1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK2` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
