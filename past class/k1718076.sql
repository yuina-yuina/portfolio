-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2020 年 7 月 27 日 06:02
-- サーバのバージョン： 10.4.11-MariaDB
-- PHP のバージョン: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `webpro`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `k1718076`
--

CREATE TABLE `k1718076` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `cat` varchar(10) NOT NULL,
  `title` varchar(30) NOT NULL,
  `text` varchar(200) NOT NULL,
  `img` varchar(100) NOT NULL,
  `cdate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `k1718076`
--

INSERT INTO `k1718076` (`id`, `date`, `cat`, `title`, `text`, `img`, `cdate`) VALUES
(2, '2020-07-20', '', '大変、、、', '先週は就活関連をサボりすぎたから今週から！と思ってたら、月曜日にして大きめの課題が3つもある（ ;  ; ）\r\n今週は課題をする週です！！！！！', '', '2020-07-25 18:24:05'),
(4, '2020-07-25', '悲しい', '初期化', 'iphoneのパスコードを忘れてしまい、朝から夜まで携帯とにらめっこでした。。。\r\n課題が全然できてないのに\r\nもう泣いちゃう', '', '2020-07-25 18:24:05'),
(5, '2020-07-26', '嬉しい', '突如！！', '携帯の初期化の悲しみも少し癒えたところで、この授業の課題を再開していました。\r\nですが、何から始めたら良いのか分からず無駄な時間を過ごしていました。\r\nしかし、さっき急に検索機能を実行できて携帯を初期化したことなんて気にならなくなりました！\r\n幸せ♡', '', '2020-07-25 18:24:05'),
(6, '2020-07-26', '嬉しい', '楽しみ！', 'さっきインスタグラムの広告に出てきたサイトが可愛くて飛んでみたら、一目惚れしたピアスがあったから２つ買っちゃった♡\r\n届くのが楽しみです！！！！', '', '2020-07-26 02:46:51'),
(8, '2020-07-27', '悲しい', 'テスト', 'なんで上手くいかんのや', '', '2020-07-27 00:38:53'),
(13, '2020-07-27', '悲しい', 'あ', 'あ', '1000000', '2020-07-27 01:54:07'),
(14, '2020-07-27', '嬉しい', 'a', 'あ', '1000000', '2020-07-27 01:58:00'),
(15, '2020-07-27', '怒り', 'できない', 'どうして', '1000000', '2020-07-27 01:58:35'),
(16, '2020-07-27', '怒り', 'これで', 'どうだ', '1000000', '2020-07-27 02:15:20'),
(17, '2020-07-27', '悲しい', 'あ', 'あ', '1000000', '2020-07-27 02:19:08'),
(24, '2020-07-27', '嬉しい', 'あ', 'あ', '1000000', '2020-07-27 02:33:24'),
(25, '2020-07-27', '嬉しい', 'あああ', 'あああ', 'http://localhost/php/kadai/img/aaa.png', '2020-07-27 03:59:46');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `k1718076`
--
ALTER TABLE `k1718076`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `k1718076`
--
ALTER TABLE `k1718076`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
