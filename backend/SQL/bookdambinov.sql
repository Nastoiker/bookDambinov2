-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 02 2022 г., 19:43
-- Версия сервера: 8.0.24
-- Версия PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `bookdambinov`
--

-- --------------------------------------------------------

--
-- Структура таблицы `authors`
--

CREATE TABLE `authors` (
  `id` int NOT NULL,
  `firstName` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar_author` varchar(600) COLLATE utf8mb4_unicode_ci DEFAULT 'author.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `authors`
--

INSERT INTO `authors` (`id`, `firstName`, `lastname`, `avatar_author`) VALUES
(1, 'Николай', 'Носов', 'author.jpg'),
(2, 'Артур Конан', 'Дойль', 'author.jpg'),
(3, 'Александр Сергеевич', 'Пушкин', 'author.jpg'),
(4, 'Николай', 'Носов', 'author.jpg'),
(5, 'Артур Конан', 'Дойль', 'author.jpg'),
(6, 'Александр Сергеевич', 'Пушкин', 'author.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `authorsonbook`
--

CREATE TABLE `authorsonbook` (
  `authorsId` int NOT NULL,
  `bookId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `authorsonbook`
--

INSERT INTO `authorsonbook` (`authorsId`, `bookId`) VALUES
(3, 1),
(5, 2),
(2, 3),
(6, 3),
(4, 4),
(1, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `book`
--

CREATE TABLE `book` (
  `id` int NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `releseYear` date NOT NULL,
  `description` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `book`
--

INSERT INTO `book` (`id`, `name`, `releseYear`, `description`, `img`) VALUES
(1, 'Незнайка учится', '2022-11-15', NULL, '956121980.jpg'),
(2, 'Незнайка-путешественник', '2022-11-15', NULL, '905914212.png'),
(3, 'Винтик, Шпунтик и пылесос', '2022-11-15', NULL, '1527999604.jpg'),
(4, 'Затерянный мир', '2022-11-15', NULL, '1452542747.jpg'),
(5, 'Шерлок Холмс', '2022-11-15', NULL, '872108512.jpg'),
(6, 'Руслан и Людмила', '2022-11-15', NULL, '229931457.jpg'),
(7, 'Сказка о рыбаке и рыбке', '2022-11-15', NULL, '616096028.jpg'),
(8, 'sadasdasd', '2022-11-15', 'sadasdasd', '198711939.jpg'),
(12, 'sadasdasd3123', '2022-11-15', 'sadasdasdjgfj', '85022080.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `comment`
--

CREATE TABLE `comment` (
  `id` int NOT NULL,
  `createdAt` datetime(3) NOT NULL DEFAULT CURRENT_TIMESTAMP(3),
  `comment` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `writtenById` int NOT NULL,
  `bookId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `comment`
--

INSERT INTO `comment` (`id`, `createdAt`, `comment`, `writtenById`, `bookId`) VALUES
(2, '2022-11-26 10:17:06.000', 'sdasdad', 1, 1),
(3, '2022-11-26 10:18:25.000', 'sdasdad', 1, 2),
(5, '2022-11-28 12:25:38.000', 'comment1', 1, 1),
(6, '2022-11-28 12:26:19.000', 'comment1', 1, 1),
(7, '2022-11-28 12:45:45.000', 'comment1', 2, 1),
(8, '2022-11-30 12:05:17.000', 'comment1', 16, 1),
(9, '2022-11-30 12:21:06.000', 'asdasdasdasd', 16, 1),
(10, '2022-11-30 12:22:14.000', 'asdasdadasd', 16, 1),
(11, '2022-11-30 12:22:30.000', 'asdasd', 16, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `genres`
--

CREATE TABLE `genres` (
  `id` int NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `genres`
--

INSERT INTO `genres` (`id`, `name`) VALUES
(4, 'Детектив'),
(2, 'Драмма'),
(1, 'Мистика'),
(5, 'Приключения'),
(3, 'Фантастика');

-- --------------------------------------------------------

--
-- Структура таблицы `genresonbook`
--

CREATE TABLE `genresonbook` (
  `genresId` int NOT NULL,
  `bookId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `genresonbook`
--

INSERT INTO `genresonbook` (`genresId`, `bookId`) VALUES
(1, 2),
(2, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `rating`
--

CREATE TABLE `rating` (
  `id` int NOT NULL,
  `createdAt` datetime(3) NOT NULL DEFAULT CURRENT_TIMESTAMP(3),
  `updatedAt` datetime(3) NOT NULL,
  `bookId` int NOT NULL,
  `authorId` int NOT NULL,
  `rating` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `rating`
--

INSERT INTO `rating` (`id`, `createdAt`, `updatedAt`, `bookId`, `authorId`, `rating`) VALUES
(1, '2022-11-26 16:21:28.000', '2022-11-26 16:21:28.000', 1, 1, 4),
(2, '2022-11-26 16:22:20.000', '2022-11-26 16:22:20.000', 1, 1, 4),
(3, '2022-11-26 16:23:05.000', '2022-11-26 16:23:05.000', 1, 1, 4),
(4, '2022-11-26 23:11:33.000', '2022-11-26 23:11:33.000', 3, 1, 5),
(5, '2022-11-27 16:00:13.000', '2022-11-27 16:00:13.000', 2, 1, 5),
(6, '2022-11-27 17:18:37.000', '2022-11-27 17:18:37.000', 1, 1, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `usermodel`
--

CREATE TABLE `usermodel` (
  `id` int NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `login` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'avatar.jpg',
  `role` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `status` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'allow'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `usermodel`
--

INSERT INTO `usermodel` (`id`, `email`, `login`, `password`, `image`, `role`, `status`) VALUES
(1, 'sadas', 'sadasd', '', '1704536109.jpg', 'user', NULL),
(2, 'sadasasd', 'sadasd', 'ad7efb125807448a39050565293061b7', NULL, 'user', NULL),
(3, 'damur2004@gmail.com', 'admin', '9cdfb439c7876e703e307864c9167a15', NULL, 'admin', NULL),
(4, 'asd@gmail.com', 'asd', '7815696ecbf1c96e6894b779456d330e', NULL, 'user', NULL),
(5, 'asdgmail.com', 'asd', '7815696ecbf1c96e6894b779456d330e', NULL, 'user', 'banned'),
(6, 'asds@gmail.com', 'asd', '9cdfb439c7876e703e307864c9167a15', NULL, 'user', 'banned'),
(7, 'asdsgmail.com', 'asd', '9cdfb439c7876e703e307864c9167a15', NULL, 'user', 'banned'),
(8, '', '', 'd41d8cd98f00b204e9800998ecf8427e', NULL, 'user', 'allow'),
(9, 'noob@gmail.com', 'noob', '9cdfb439c7876e703e307864c9167a15', NULL, 'user', 'allow'),
(10, 'sad@asd.asd', 'lol', '7815696ecbf1c96e6894b779456d330e', '1085911935.png', 'user', 'allow'),
(11, 'sad@asd.asdsadasd', 'lol', '9cdfb439c7876e703e307864c9167a15', '969402447.png', 'user', 'allow'),
(12, 'asd@gmail.comasdasd', 'lol', '202cb962ac59075b964b07152d234b70', '2053959905.jpg', 'user', 'allow'),
(13, 'asd@gsadasdmail.com', 'asd', '7815696ecbf1c96e6894b779456d330e', 'avatar.jpg', 'user', 'allow'),
(14, 'asd@gmailasdsad.com', 'asd', '7815696ecbf1c96e6894b779456d330e', 'avatar.jpg', 'user', 'allow'),
(15, 'as1212dasd@asd.sad', 'asd', '7815696ecbf1c96e6894b779456d330e', '395358184.png', 'user', 'allow'),
(16, 'asd@213123gmail.com', 'asdasd', '7815696ecbf1c96e6894b779456d330e', '2068265150.png', 'user', 'allow'),
(17, 'noob123123@gmail.com', 'noobsadasd', '94182a87e6d8862e86271775668c40ab', 'avatar.jpg', 'user', 'allow'),
(18, 'damur20ewrsdf04@gmail.com', 'tyforhate', '7815696ecbf1c96e6894b779456d330e', '1626023227.jpg', 'user', 'allow'),
(19, 'aasdasdsdas@gmail.com', 'asdasd', '202cb962ac59075b964b07152d234b70', '1622184508.jpg', 'user', 'allow'),
(20, 'damur200dsads4@gmail.com', 'asd', '7815696ecbf1c96e6894b779456d330e', '1742393811.jpg', 'user', 'allow'),
(21, 'damur2004@asdasgmail.com', 'aasd', '7815696ecbf1c96e6894b779456d330e', '835482214.jpg', 'user', 'allow'),
(22, 'asdasdaasd@gmail.com', 'asd', '7815696ecbf1c96e6894b779456d330e', '1631657236.jpg', 'user', 'allow'),
(23, 'damur2asdasd004@gmail.com', 'asd', '7815696ecbf1c96e6894b779456d330e', 'avatar.jpg', 'user', 'allow'),
(24, 'asddamur2004@gmail.com', 'asd', '7815696ecbf1c96e6894b779456d330e', 'avatar.jpg', 'user', 'allow'),
(25, '12damur2004@gmail.com', '12', 'c20ad4d76fe97759aa27a0c99bff6710', 'avatar.jpg', 'user', 'allow'),
(26, 'damur2004@gmail.comasdasd', '12312asd', '7815696ecbf1c96e6894b779456d330e', '1725132673.jpg', 'user', 'allow'),
(27, 'damur200asd4@gmail.com', '123', '202cb962ac59075b964b07152d234b70', '1632408794.jpg', 'user', 'allow'),
(28, 'damur221312004@gmail.com', 'asd', '7815696ecbf1c96e6894b779456d330e', '1868641450.jpg', 'user', 'allow'),
(29, 'damur2004123123@gmail.com', 'asd', '7815696ecbf1c96e6894b779456d330e', 'avatar.jpg', 'user', 'allow'),
(30, 'damur1232004@gmail.comdasda', 'asd', '7815696ecbf1c96e6894b779456d330e', '340774874.jpg', 'user', 'allow'),
(31, 'damur200123124@gmail.com', 'asd', '7815696ecbf1c96e6894b779456d330e', '743006157.jpg', 'user', 'allow'),
(32, 'damur2312313004@gmail.com', 'asd', '7815696ecbf1c96e6894b779456d330e', '1842886812.jpg', 'user', 'allow'),
(33, 'd123amur2004@gmail.com', 'asd', '7815696ecbf1c96e6894b779456d330e', '13578051.jpg', 'user', 'allow');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `authorsonbook`
--
ALTER TABLE `authorsonbook`
  ADD PRIMARY KEY (`authorsId`,`bookId`),
  ADD KEY `AuthorsOnBook_bookId_fkey` (`bookId`);

--
-- Индексы таблицы `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Book_name_key` (`name`);

--
-- Индексы таблицы `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Comment_writtenById_fkey` (`writtenById`),
  ADD KEY `Comment_bookId_fkey` (`bookId`);

--
-- Индексы таблицы `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Genres_name_key` (`name`);

--
-- Индексы таблицы `genresonbook`
--
ALTER TABLE `genresonbook`
  ADD PRIMARY KEY (`genresId`,`bookId`),
  ADD KEY `GenresOnBook_bookId_fkey` (`bookId`);

--
-- Индексы таблицы `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Rating_authorId_fkey` (`authorId`),
  ADD KEY `Rating_bookId_fkey` (`bookId`);

--
-- Индексы таблицы `usermodel`
--
ALTER TABLE `usermodel`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `book`
--
ALTER TABLE `book`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `usermodel`
--
ALTER TABLE `usermodel`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `authorsonbook`
--
ALTER TABLE `authorsonbook`
  ADD CONSTRAINT `AuthorsOnBook_authorsId_fkey` FOREIGN KEY (`authorsId`) REFERENCES `authors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `AuthorsOnBook_bookId_fkey` FOREIGN KEY (`bookId`) REFERENCES `book` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `Comment_bookId_fkey` FOREIGN KEY (`bookId`) REFERENCES `book` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Comment_writtenById_fkey` FOREIGN KEY (`writtenById`) REFERENCES `usermodel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `genresonbook`
--
ALTER TABLE `genresonbook`
  ADD CONSTRAINT `GenresOnBook_bookId_fkey` FOREIGN KEY (`bookId`) REFERENCES `book` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `GenresOnBook_genresId_fkey` FOREIGN KEY (`genresId`) REFERENCES `genres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `Rating_authorId_fkey` FOREIGN KEY (`authorId`) REFERENCES `usermodel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Rating_bookId_fkey` FOREIGN KEY (`bookId`) REFERENCES `book` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
