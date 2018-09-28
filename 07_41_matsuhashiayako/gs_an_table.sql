-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2018 年 9 月 27 日 16:29
-- サーバのバージョン： 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gs_db`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_an_table`
--

CREATE TABLE IF NOT EXISTS `gs_an_table` (
`id` int(12) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `age` int(3) NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `naiyou` text COLLATE utf8_unicode_ci NOT NULL,
  `indate` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `gs_an_table`
--

INSERT INTO `gs_an_table` (`id`, `name`, `age`, `email`, `naiyou`, `indate`) VALUES
(1, 'ジーズ太郎', 10, 'test1@email.com', 'テスト１', '2018-09-27 16:08:42'),
(2, 'ジーズ次郎', 10, 'test2@email.com', 'テスト２', '2018-09-27 16:13:17'),
(3, 'ジーズ三郎', 20, 'test3@email.com', 'テスト３', '2018-09-27 16:13:17'),
(4, 'ジーズ四郎', 20, 'test4@email.com', 'テスト４', '2018-09-27 16:15:50'),
(5, 'ジーズ五郎', 20, 'test5@email.com', 'テスト５', '2018-09-27 16:15:50'),
(6, 'ジーズ六郎', 30, 'test6@email.com', 'テスト６', '2018-09-27 16:15:50'),
(7, 'ジーズ七郎', 40, 'test7@email.com', 'テスト７', '2018-09-27 16:15:50'),
(8, 'ジーズ八郎', 40, 'test8@email.com', 'テスト８', '2018-09-27 16:15:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gs_an_table`
--
ALTER TABLE `gs_an_table`
 ADD PRIMARY KEY (`id`), ADD KEY `id` (`id`), ADD KEY `id_2` (`id`), ADD KEY `id_3` (`id`), ADD KEY `id_4` (`id`), ADD KEY `id_5` (`id`), ADD KEY `id_6` (`id`), ADD KEY `id_7` (`id`), ADD KEY `id_8` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gs_an_table`
--
ALTER TABLE `gs_an_table`
MODIFY `id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- 
-- 課題
-- 

-- 
-- 1. SELECT文を使って、"id"「1,3,5」だけ抽出するSQLを作る
-- 
SELECT * FROM gs_an_table WHERE id = 1 OR id = 3 OR id = 5;

-- 
-- 2. SELECT文を使って、"id"「4~8」を抽出するSQLを作る
-- 
SELECT * FROM gs_an_table WHERE id >= 4 AND id <=8;

-- 
-- 3. SELECT文を使って、"email"「test1」を抽出するあいまい検索を作る
-- 
SELECT * FROM gs_an_table WHERE email LIKE 'test1%';

-- 
-- 4. SELECT文を使って、"新しい日付順"にソートするるSQLを作る
-- 
SELECT * FROM gs_an_table ORDER BY indate DESC;

-- 
-- 5. SELECT文を使って、"age"「20」で "indate"「2017-05-26%」のデータを抽出するSQLを作る
-- 
SELECT * FROM gs_an_table WHERE age = 20 AND indate LIKE '2018-09-27%';

-- 
-- 6. SELECT文を使って、"新しい日付順"で、「5個」だけ取得するSQLを作る
-- 
SELECT * FROM gs_an_table ORDER BY indate DESC LIMIT 5;

-- 
-- 7. "age"で「GROUP BY」を使い10,20,30,40歳が各何人いるか抽出するSQLを作る
-- 
SELECT age, COUNT(*) FROM gs_an_table GROUP BY age ;