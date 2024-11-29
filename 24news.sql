-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 10, 2024 lúc 12:30 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `24news`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`username`, `password`, `status`) VALUES
('imahomebody', '123', 1),
('nguyenthuyanhthu', '2004', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `slug` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name`, `status`, `slug`) VALUES
(1, 'Video Game', 1, 'video-game'),
(2, 'Anime', 1, 'anime'),
(3, 'Movie', 1, 'movie'),
(4, 'Music', 0, 'music');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `subject`, `message`) VALUES
(1, 'Thư', 'thu@gmail.com', 'Tôi muốn liên hệ', 'Tôi cần biết thêm thông tin chi tiết'),
(2, 'Thư', '0306221078@caothang.edu.vn', 'Tôi test liên hệ', 'Tôi test liên hệ thành công');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2024_10_19_073430_add_slug_column_to_news_table', 1),
(2, '2024_10_19_090512_add_slug_column_to_category_table', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(255) NOT NULL,
  `category` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `view` int(11) NOT NULL DEFAULT 0,
  `added` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime NOT NULL DEFAULT current_timestamp(),
  `slug` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `news`
--

INSERT INTO `news` (`id`, `image`, `title`, `content`, `author`, `category`, `status`, `view`, `added`, `modified`, `slug`) VALUES
(1, 'Detention.jpg', 'Detention', '<p>Detention is an atmospheric horror game set in 1960s Taiwan under martial law. Incorporated religious elements based in Taiwanese/Chinese culture and mythology, the game provided players with unique graphics and gaming experience.</p>', 'imahomebody', 1, 1, 73, '2024-10-08 01:00:00', '2024-10-08 01:00:00', 'detention'),
(2, 'CubeEscapeCollection.jpg', 'Cube Escape Collection', '<p>In this classic point-and-click adventure anthology you follow the path of Dale and Laura and other famous Rusty lake characters such as Mr. Crow and Mr. Owl. The series will be updated, preserved and bundled to survive the end of the Flash Games era.</p>', 'imahomebody', 1, 1, 55, '2024-10-08 02:00:00', '2024-10-08 02:00:00', 'cube-escape-collection'),
(3, 'OMORI.jpg', 'OMORI', '<p>Explore a strange world full of colorful friends and foes. When the time comes, the path you’ve chosen will determine your fate... and perhaps the fate of others as well.</p>', 'imahomebody', 1, 1, 90, '2024-10-08 03:00:00', '2024-10-08 03:00:00', 'omori'),
(4, 'WORLDOFHORROR.jpg', 'WORLD OF HORROR', '<p>Experience the quiet terror of this 1-bit love letter to Junji Ito and H.P. Lovecraft. Navigate a hellish roguelite reality with turn-based combat and unforgiving choices. Experiment with your deck of event cards to discover new forms of cosmic horror in every playthrough. The inevitable awaits...</p>', 'imahomebody', 1, 1, 95, '2024-10-08 04:00:00', '2024-10-08 04:00:00', 'world-of-horror'),
(5, 'Overcooked!AllYouCanEat.jpg', 'Overcooked! All You Can Eat', '<p>Experience all the Onion Kingdom has to offer, Overcooked! 1 &amp; 2 infused with 4k goodness running at a smooth 60 FPS. Fully remastered and cooked up from scratch. Enjoy 200+ levels (22 new) and 80+ chefs (3 new), this is the ultimate Overcooked! experience.</p>', 'imahomebody', 1, 1, 97, '2024-10-08 05:00:00', '2024-10-08 05:00:00', 'overcooked-all-you-can-eat'),
(6, 'Melatonin.jpg', 'Melatonin', '<p>Melatonin is a rhythm game about dreams and reality merging together. It uses animations and sound cues to keep you on beat without any intimidating overlays or interfaces. Harmonize through a variety of dreamy levels containing surprising challenges, hand-drawn art, and vibrant music.</p>', 'imahomebody', 1, 1, 67, '2024-10-08 06:00:00', '2024-10-08 06:00:00', 'melatonin'),
(7, 'LifeGallery.jpg', 'Life Gallery', 'Life Gallery is a puzzle game with a unique, illustration-style art design that leads the players into a world of profound horror.', 'imahomebody', 1, 1, 32, '2024-10-08 07:00:00', '2024-10-08 07:00:00', 'life-gallery'),
(8, 'InsomniaTheaterintheHead.jpg', 'Insomnia: Theater in the Head', '<p>Hickory dickory dock. The city\'s deep in sleep. The clock\'s ticking. The sheep\'s bouncing. Hickory dickory dock. The girl tosses again, only with more things swarming into her head... In this Point &amp; Click puzzle game \"Insomnia\", the show in the head is rolling on again. Alas, any sleep tonight...</p>', 'imahomebody', 1, 1, 64, '2024-10-08 08:00:00', '2024-10-08 08:00:00', 'insomnia-theater-in-the-head'),
(9, 'Hoa.jpg', 'Hoa', '<p>Hoa is a beautiful puzzle-platforming game that features breathtaking hand-painted art, lovely music, and a peaceful, relaxing atmosphere.</p>', 'imahomebody', 1, 1, 1, '2024-10-08 09:00:00', '2024-10-08 09:00:00', 'hoa'),
(10, 'Melan.jpg', 'Melan', '<p>In Melan, the player as An will go everywhere and collect memories, thereby revealing some of what is happening in the game. The game is built in a storytelling format with situations that the player gradually discovers through interacting with the environment and NPCs.</p>', 'imahomebody', 1, 1, 37, '2024-10-08 10:00:00', '2024-10-08 10:00:00', 'melan'),
(11, 'NeonGenesisEvangelion.jpg', 'Neon Genesis Evangelion', '<p>A teenage boy finds himself recruited as a member of an elite team of pilots by his father.</p>', 'imahomebody', 2, 1, 73, '2024-10-08 11:00:00', '2024-10-08 11:00:00', 'neon-genesis-evangelion'),
(12, 'DevilmanCrybaby.jpg', 'Devilman: Crybaby', '<p>With demons reawakened and humanity in turmoil, a sensitive demon-boy is led into a brutal, degenerate war against evil by his mysterious friend, Ryo.</p>', 'imahomebody', 2, 1, 33, '2024-10-08 12:00:00', '2024-10-08 12:00:00', 'devilman-crybaby'),
(13, 'TokyoGhoul.jpg', 'Tokyo Ghoul', '<p>A Tokyo college student is attacked by a ghoul, a superpowered human who feeds on human flesh. He survives, but has become part ghoul and becomes a fugitive on the run.</p>', 'imahomebody', 2, 1, 52, '2024-10-08 13:00:00', '2024-10-08 13:00:00', 'tokyo-ghoul'),
(14, 'ChainsawMan.jpg', 'Chainsaw Man', '<p>Following a betrayal, a young man left for dead is reborn as a powerful devil-human hybrid after merging with his pet devil and is soon enlisted into an organization dedicated to hunting devils.</p>', 'imahomebody', 2, 1, 14, '2024-10-08 14:00:00', '2024-10-08 14:00:00', 'chainsaw-man'),
(15, 'DeathNote.jpg', 'Death Note', '<p>An intelligent high school student goes on a secret crusade to eliminate criminals from the world after discovering a notebook capable of killing anyone whose name is written into it.</p>', 'imahomebody', 2, 1, 78, '2024-10-08 15:00:00', '2024-10-08 15:00:00', 'death-note'),
(16, 'DarkGathering.jpg', 'Dark Gathering', '<p>A withdrawn college kid with psychic powers teams up with a strange little girl who\'s searching for her dead mother\'s abducted soul.</p>', 'nguyenthuyanhthu', 2, 0, 92, '2024-10-08 16:00:00', '2024-10-08 16:00:00', 'dark-gathering'),
(17, 'JunjiItoKorekushon.jpg', 'Junji Ito: Korekushon', '<p>A collection of animated horror stories based on the works of Japanese artist Junji Ito.</p>', 'nguyenthuyanhthu', 2, 0, 77, '2024-10-08 17:00:00', '2024-10-08 17:00:00', 'junji-ito-korekushon'),
(18, 'Kakegurui.jpg', 'Kakegurui', '<p>A gambling prodigy comes to an elite school run by games and turns the order upside down.</p>', 'nguyenthuyanhthu', 2, 0, 12, '2024-10-08 18:00:00', '2024-10-08 18:00:00', 'kakegurui'),
(19, 'Migi&Dali.jpg', 'Migi & Dali', '<p>Identical twins get adopted into a wealthy family and assume the identity of one child while pursuing a hidden agenda to uncover a past incident.</p>', 'nguyenthuyanhthu', 2, 0, 46, '2024-10-08 19:00:00', '2024-10-08 19:00:00', 'migi-dali'),
(20, 'HighRiseInvasion.jpg', 'High-Rise Invasion', '<p>High schooler Yuri finds herself atop a skyscraper in a strange world, where she must survive against masked assailants bent on killing their prey.</p>', 'nguyenthuyanhthu', 2, 0, 63, '2024-10-08 20:00:00', '2024-10-08 20:00:00', 'high-rise-invasion'),
(21, 'TheYinyangMaster.jpg', 'The Yinyang Master', '<p>Adaption of the phenomenon-level mobile game \"Onmyoji\" - film version with the same name that will bring the magnificent oriental fantasy world to life.</p>', 'nguyenthuyanhthu', 3, 0, 34, '2024-10-08 21:00:00', '2024-10-08 21:00:00', 'the-yinyang-master'),
(22, 'FaceOff6TheTicketOfDestiny.jpg', 'Face Off 6: The Ticket Of Destiny', '<p>A friend group bought a lottery ticket and won the jackpot but the ticket holder of the ticket accidentally died. Some of the surviving friends intended to unravel their friend and retrieve the winning ticket, some don\'t.</p>', 'nguyenthuyanhthu', 3, 0, 15, '2024-10-08 22:00:00', '2024-10-08 22:00:00', 'face-off-6-the-ticket-of-destiny'),
(23, 'Mai.jpg', 'Mai', '<p>Restlessly haunted by the past, Mai is greeted by a new dawn when she reluctantly befriends the neighborhood ladies\' man. But when her yesterday catches up to her today, what will become of her tomorrow?</p>', 'nguyenthuyanhthu', 3, 0, 51, '2024-10-08 23:00:00', '2024-10-08 23:00:00', 'mai'),
(24, 'BloodMoonParty.jpg', 'Blood Moon Party', '<p>In a group meeting of close friends, a member suddenly proposed a game of sharing the phone to increase the spirit of \"solidarity\".</p>', 'nguyenthuyanhthu', 3, 0, 13, '2024-10-09 00:00:00', '2024-10-09 00:00:00', 'blood-moon-party'),
(25, 'Tarot.jpg', 'Tarot', '<p>When a group of friends recklessly violates the sacred rule of Tarot readings, they unknowingly unleash an unspeakable evil trapped within the cursed cards. One by one, they come face to face with fate and end up in a race against death.</p>', 'nguyenthuyanhthu', 3, 0, 72, '2024-10-09 01:00:00', '2024-10-09 01:00:00', 'tarot'),
(26, 'TheCall.jpg', 'The Call', '<p>Two people live in different times. Seo-Yeon lives in the present and Young-Sook lives in the past. One phone call connects the two, and their lives are changed irrevocably.</p>', 'nguyenthuyanhthu', 3, 0, 50, '2024-10-09 02:00:00', '2024-10-09 02:00:00', 'the-call'),
(27, 'Forgotten.jpg', 'Forgotten', '<p>Jin-seok, 21-year-old, moves into a new house with his family. One night, his beloved brother is kidnapped before his eyes. After long silence of 19 days, suddenly Yu-seok returns home. And soon Jin-seok feels Yu-seok is a total stranger.</p>', 'nguyenthuyanhthu', 3, 0, 91, '2024-10-09 03:00:00', '2024-10-09 03:00:00', 'forgotten'),
(28, 'KillBokSoon.jpg', 'Kill Bok Soon', '<p>A single mother who is a renowned hired killer finds it difficult to achieve a balance between her personal and work life.</p>', 'nguyenthuyanhthu', 3, 0, 44, '2024-10-09 04:00:00', '2024-10-09 04:00:00', 'kill-bok-soon'),
(29, 'Believer.jpg', 'Believer', '<p>A police detective determined to catch the unseen boss of Asia\'s biggest drug cartel joins hands with a revenge-thirsty member of the gang.</p>', 'nguyenthuyanhthu', 3, 0, 33, '2024-10-09 05:00:00', '2024-10-09 05:00:00', 'believer'),
(30, '6Underground.jpg', '6 Underground', '<p>It follows a group of people who fake their deaths and decide to form a vigilante team in order to stage a coup d\'état against a ruthless dictator.</p>', 'nguyenthuyanhthu', 3, 0, 47, '2024-10-09 06:00:00', '2024-10-09 06:00:00', '6-underground'),
(31, 'Homebody.png', 'pH-1 - Homebody', '<p>I don’t wanna meet, I don’t wanna see<br>I just wanna be free as a bird<br>Yeah, I’m prolly the best you ever heard<br>I don’t need to cheat, but always coming first<br>Yes, I’m a nerd, but I’ll still school you<br>Crazy is normal, do what the loons do<br>Busy being home, I’m busy being lonely<br>My life is on the line, please never ever call me</p>', 'imahomebody', 4, 0, 10, '2024-10-09 07:00:00', '2024-10-09 07:00:00', 'ph-1-homebody'),
(32, 'Gemini.jpg', 'Ethan Low - Gemini', '<p>I know that you got a side<br>That you tryna hide from me<br>But you cannot deny that<br>I can still read your mind<br>Two wrongs don\'t make it right, but<br>I\'m still out here doing the same thing<br>You\'re still out there moving the same way<br>We both have two sides that no one knows</p>', 'imahomebody', 4, 0, 12, '2024-10-09 08:00:00', '2024-10-09 08:00:00', 'ethan-low-gemini');


-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `subcriber`
--

CREATE TABLE `subcriber` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `subcriber`
--

INSERT INTO `subcriber` (`id`, `email`) VALUES
(1, 'thu@gmail.com'),
(2, '0306221078@caothang.edu.vn');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`username`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `news_slug_unique` (`slug`),
  ADD KEY `category` (`category`),
  ADD KEY `author` (`author`);

--
-- Chỉ mục cho bảng `subcriber`
--
ALTER TABLE `subcriber`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `subcriber`
--
ALTER TABLE `subcriber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `fk_news_account` FOREIGN KEY (`author`) REFERENCES `account` (`username`),
  ADD CONSTRAINT `fk_news_category` FOREIGN KEY (`category`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
