-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 28 2022 г., 09:26
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
  `lastname` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `authors`
--

INSERT INTO `authors` (`id`, `firstName`, `lastname`) VALUES
(1, 'Николай', 'Носов'),
(2, 'Артур Конан', 'Дойль'),
(3, 'Александр Сергеевич', 'Пушкин'),
(4, 'Николай', 'Носов'),
(5, 'Артур Конан', 'Дойль'),
(6, 'Александр Сергеевич', 'Пушкин');

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
(3, 2),
(2, 3),
(3, 3),
(2, 4),
(2, 5);

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
(7, 'Сказка о рыбаке и рыбке', '2022-11-15', NULL, '616096028.jpg');

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
(3, '2022-11-26 10:18:25.000', 'sdasdad', 1, 2);

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
(1, 1),
(1, 2);

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
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `status` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `usermodel`
--

INSERT INTO `usermodel` (`id`, `email`, `login`, `password`, `image`, `role`, `status`) VALUES
(1, 'sadas', 'sadasd', '', '1704536109.jpg', 'user', NULL),
(2, 'sadasasd', 'sadasd', 'ad7efb125807448a39050565293061b7', NULL, 'user', NULL),
(3, 'damur2004@gmail.com', 'admin', '9cdfb439c7876e703e307864c9167a15', NULL, 'admin', NULL),
(4, 'asd@gmail.com', 'asd', '7815696ecbf1c96e6894b779456d330e', NULL, 'user', NULL),
(5, 'asdgmail.com', 'asd', '7815696ecbf1c96e6894b779456d330e', NULL, 'user', NULL),
(6, 'asds@gmail.com', 'asd', '9cdfb439c7876e703e307864c9167a15', NULL, 'user', NULL),
(7, 'asdsgmail.com', 'asd', '9cdfb439c7876e703e307864c9167a15', NULL, 'user', NULL);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `authorsonbook`
--
ALTER TABLE `authorsonbook`
  ADD CONSTRAINT `AuthorsOnBook_authorsId_fkey` FOREIGN KEY (`authorsId`) REFERENCES `authors` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `AuthorsOnBook_bookId_fkey` FOREIGN KEY (`bookId`) REFERENCES `book` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `Comment_bookId_fkey` FOREIGN KEY (`bookId`) REFERENCES `book` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `Comment_writtenById_fkey` FOREIGN KEY (`writtenById`) REFERENCES `usermodel` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `genresonbook`
--
ALTER TABLE `genresonbook`
  ADD CONSTRAINT `GenresOnBook_bookId_fkey` FOREIGN KEY (`bookId`) REFERENCES `book` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `GenresOnBook_genresId_fkey` FOREIGN KEY (`genresId`) REFERENCES `genres` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `Rating_authorId_fkey` FOREIGN KEY (`authorId`) REFERENCES `usermodel` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `Rating_bookId_fkey` FOREIGN KEY (`bookId`) REFERENCES `book` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
