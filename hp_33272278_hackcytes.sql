-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql306.hyperphp.com
-- Generation Time: Dec 30, 2022 at 09:53 AM
-- Server version: 10.3.27-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hp_33272278_hackcytes`
--

-- --------------------------------------------------------

--
-- Table structure for table `category_list`
--

CREATE TABLE `category_list` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category_list`
--

INSERT INTO `category_list` (`id`, `name`, `description`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 'PHP', 'PHP is an open-source server-side scripting language that many devs use for web development. It is also a general-purpose language that you can use to make lots of projects, including Graphical User Interfaces (GUIs).', 1, 0, '2022-05-16 10:02:41', '2022-05-16 10:02:41'),
(2, 'VB.NET', 'Visual Basic, originally called Visual Basic .NET, is a multi-paradigm, object-oriented programming language, implemented on .NET, Mono, and the .NET Framework. Microsoft launched VB.NET in 2002 as the successor to its original Visual Basic language.', 1, 0, '2022-05-16 10:03:27', '2022-05-16 10:03:27'),
(3, 'Python', 'Python is a high-level, interpreted, general-purpose programming language. Its design philosophy emphasizes code readability with the use of significant indentation. Python is dynamically-typed and garbage-collected.', 1, 0, '2022-05-16 10:03:48', '2022-05-16 10:03:48'),
(4, 'JavaScript', 'JavaScript, often abbreviated JS, is a programming language that is one of the core technologies of the World Wide Web, alongside HTML and CSS. Over 97% of websites use JavaScript on the client side for web page behavior, often incorporating third-party libraries.', 1, 0, '2022-05-16 10:04:11', '2022-05-16 10:04:11'),
(5, 'test', 'test', 1, 1, '2022-05-16 10:04:54', '2022-05-16 10:04:59'),
(6, 'Other', 'Other', 1, 0, '2022-12-28 09:39:40', '2022-12-28 23:15:44'),
(7, 'Test Category', 'test', 1, 1, '2022-12-28 11:31:08', '2022-12-28 23:15:55');

-- --------------------------------------------------------

--
-- Table structure for table `comment_list`
--

CREATE TABLE `comment_list` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment_list`
--

INSERT INTO `comment_list` (`id`, `user_id`, `post_id`, `comment`, `date_created`) VALUES
(1, 4, 2, 'Test Comment 123', '2022-05-16 12:05:21'),
(2, 4, 2, '<p>This is a sample comment only</p>', '2022-05-16 13:00:42'),
(4, 4, 3, '<p>test 123</p>', '2022-05-16 13:54:01'),
(14, 6, 5, '<p>Thank You!</p>', '2022-12-28 09:44:49'),
(10, 6, 6, '<p><font color=\"#000000\" style=\"background-color: rgb(255, 255, 0);\">comment</font></p>', '2022-12-23 12:51:26'),
(11, 6, 6, '<p>My first comment</p>', '2022-12-23 13:38:38'),
(13, 1, 5, '<p>Cross-Site Scripting (XSS) is a type of vulnerability that allows attackers to inject malicious code into a website or web application. This can allow the attacker to steal sensitive information, such as login credentials or personal data, or to manipulate the website or application in some way.</p><p>There are several ways to find XSS vulnerabilities in a website or web application:</p><p>1. Manual testing: One way to find XSS vulnerabilities is to manually test the website or application by attempting to inject various types of malicious code into input fields and seeing if the code is executed. This can be done manually or with the use of automated tools that help to identify potential vulnerabilities.</p><p>2. Scanning tools: There are also a variety of tools available that can scan a website or web application for XSS vulnerabilities. These tools can be run on demand or as part of a regular security audit.</p><p>3. Penetration testing: Another option is to hire a professional to conduct a penetration test, which is a simulated cyber attack that is designed to identify vulnerabilities in a system. This can include testing for XSS vulnerabilities.</p><p>It\'s important to note that finding XSS vulnerabilities is just the first step in addressing them. Once vulnerabilities are identified, they should be properly addressed and fixed to ensure the security of the website or web application.</p>', '2022-12-28 09:43:34'),
(15, 6, 2, '<p>Can you ellaborate your question</p>', '2022-12-28 10:57:17');

-- --------------------------------------------------------

--
-- Table structure for table `df_users`
--

CREATE TABLE `df_users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `middlename` text DEFAULT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `df_users`
--

INSERT INTO `df_users` (`id`, `firstname`, `middlename`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`) VALUES
(1, 'Adminstrator', '', 'Admin', 'admin', '0192023a7bbd73250516f069df18b500', 'uploads/avatars/1.png?v=1649834664', NULL, 1, '2021-01-20 14:02:37', '2022-05-16 14:17:49'),
(4, 'Mark', 'D', 'Cooper', 'mcooper', 'c7162ff89c647f444fcaa5c635dac8c3', 'uploads/avatars/4.png?v=1652667135', NULL, 2, '2022-05-16 10:12:15', '2022-05-16 13:44:49'),
(5, 'John', 'D', 'Smith', 'jsmith', '1254737c076cf867dc53d60a0364f38e', NULL, NULL, 2, '2022-05-16 14:19:03', '2022-05-16 14:19:03'),
(6, 'Dummy', 'Dummy', 'Dum', 'dummy', '21232f297a57a5a743894a0e4a801fc3', NULL, NULL, 2, '2022-12-22 10:53:48', '2022-12-22 10:53:48'),
(7, 'Abhijeet', 'A', 'Biswas', 'abhijeet', '1cb8addc27cb14b8e41facb41ceed9c9', NULL, NULL, 2, '2022-12-27 09:46:56', '2022-12-27 09:46:56');

-- --------------------------------------------------------

--
-- Table structure for table `guestbook`
--

CREATE TABLE `guestbook` (
  `comment_id` smallint(5) UNSIGNED NOT NULL,
  `comment` varchar(300) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `post_list`
--

CREATE TABLE `post_list` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post_list`
--

INSERT INTO `post_list` (`id`, `user_id`, `category_id`, `title`, `content`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 4, 1, 'Sample Topic Title', '<p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur fringilla bibendum urna ac eleifend. Quisque in est eu ipsum blandit accumsan ultrices nec tortor. Aliquam lacinia, ex sit amet iaculis sollicitudin, urna odio tempor nulla, eu lacinia augue mi a felis. Quisque finibus in arcu sed ultricies. Duis eleifend metus consectetur vulputate bibendum. Interdum et malesuada fames ac ante ipsum primis in faucibus. Ut interdum libero vitae nisi finibus, non varius quam volutpat. Cras non iaculis neque. Integer bibendum sagittis dignissim. Ut aliquet suscipit velit sit amet hendrerit. Sed mattis pellentesque augue id bibendum. Phasellus quis justo ornare, faucibus arcu at, ullamcorper lectus.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px;\">Nulla a nisl quis tellus volutpat lacinia. Nullam et eros ac mi dapibus ornare. Suspendisse sit amet purus mattis, ullamcorper nulla sit amet, euismod urna. Fusce ac pulvinar velit. Vivamus tellus nibh, pretium eu consectetur et, hendrerit eu elit. Proin et augue ultricies, euismod augue a, varius nibh. Donec condimentum justo erat, non cursus mi pharetra vel. Cras pretium nulla quis justo venenatis, vitae aliquet justo dapibus. Maecenas efficitur viverra tellus, vestibulum pharetra est dictum at. Aenean mauris tellus, luctus vitae odio sit amet, sagittis faucibus nisl. Aliquam in dignissim sapien, nec sagittis lorem. Donec facilisis vulputate purus vitae congue. Nunc eros risus, congue id nisi nec, hendrerit tristique sem. Phasellus sodales nunc arcu, nec ultricies tellus tincidunt et.</p>', 1, 1, '2022-05-16 11:13:02', '2022-12-28 09:40:43'),
(2, 4, 6, 'CSRF', '<p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\">What is CSRF?</p>', 1, 0, '2022-05-16 11:25:21', '2022-12-28 09:41:23'),
(7, 6, 6, 'New post', '<p>This is a dummmy post</p><p><br></p><p>edit: Published</p>', 1, 1, '2022-12-28 10:55:40', '2022-12-28 10:58:33'),
(8, 6, 6, 'New post', '<p>This is a sample post</p>', 1, 1, '2022-12-28 11:28:51', '2022-12-28 11:30:18'),
(3, 4, 2, 'test', '<p>Data to delete</p>', 1, 1, '2022-05-16 13:52:36', '2022-05-16 13:54:05'),
(4, 1, 1, 'test', '<p>test</p>', 1, 1, '2022-05-16 14:11:24', '2022-05-16 14:12:10'),
(5, 6, 6, 'Cross Site Scripting', '<p>How to find XSS?</p>', 1, 0, '2022-12-22 13:03:50', '2022-12-28 09:40:28'),
(6, 1, 3, 'Message from admin', '<p>Python bootcamp course, zero to hero starts from 35 Jan</p>', 1, 0, '2022-12-22 23:07:41', '2022-12-22 23:07:41');

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(11) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'Hackcytes Discussion Forum'),
(6, 'short_name', 'Discussion Forum'),
(11, 'logo', 'uploads/logo.png?v=1652665183'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/cover.png?v=1672152694');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(15) DEFAULT NULL,
  `last_name` varchar(15) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `avatar` varchar(70) DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `failed_login` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `user`, `password`, `avatar`, `last_login`, `failed_login`) VALUES
(1, 'admin', 'admin', 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', '/hackable/users/admin.jpg', '2022-10-05 10:57:53', 0),
(10, 'Abhijeet', 'Biswas', 'abhijeet@gmail.com', '1cb8addc27cb14b8e41facb41ceed9c9', NULL, NULL, NULL),
(11, 'sameer', 'shaikh', '201900398@vupune.ac.in', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, NULL, NULL),
(12, 'Yash', 'Oswal', 'yash@mail.com', '3fc0a7acf087f549ac2b266baf94b8b1', NULL, NULL, NULL),
(13, 'Neeta', 'Doshi', 'nitadoshi@gmail.com', '5e522db7e59ed0cf41b659b245f3787d', NULL, NULL, NULL),
(14, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'Abhijeet', 'Biswas', 'diogenesinthebarrel@yopmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, NULL, NULL),
(16, 'Abhijeet', 'Biswas', 'diogenesinthebarrel@yopmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, NULL, NULL),
(17, 'Abhijeet', 'Biswas', 'abhijeet@yopmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, NULL, NULL),
(18, 'Abhijeet', 'Biswas', 'abhi@yopmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, NULL, NULL),
(19, 'Abhijeet', 'Biswas', 'abhi1@yopmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category_list`
--
ALTER TABLE `category_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment_list`
--
ALTER TABLE `comment_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `df_users`
--
ALTER TABLE `df_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guestbook`
--
ALTER TABLE `guestbook`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `post_list`
--
ALTER TABLE `post_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category_list`
--
ALTER TABLE `category_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `comment_list`
--
ALTER TABLE `comment_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `df_users`
--
ALTER TABLE `df_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `guestbook`
--
ALTER TABLE `guestbook`
  MODIFY `comment_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_list`
--
ALTER TABLE `post_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
