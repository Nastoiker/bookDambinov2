-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 24 2022 г., 14:40
-- Версия сервера: 8.0.24
-- Версия PHP: 8.0.14

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
  `description` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `book`
--

INSERT INTO `book` (`id`, `name`, `releseYear`, `description`, `img`) VALUES
(1, 'Незнайка учится', '2022-11-15', NULL, '0'),
(2, 'Незнайка-путешественник', '2022-11-15', NULL, '0'),
(3, 'Винтик, Шпунтик и пылесос', '2022-11-15', NULL, '0'),
(4, 'Затерянный мир', '2022-11-15', NULL, '0'),
(5, 'Шерлок Холмс', '2022-11-15', NULL, '0'),
(6, 'Руслан и Людмила', '2022-11-15', NULL, '0'),
(7, 'Сказка о рыбаке и рыбке', '2022-11-15', NULL, '0');

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

-- --------------------------------------------------------

--
-- Структура таблицы `genres`
--

CREATE TABLE `genres` (
  `id` int NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `genresonbook`
--

CREATE TABLE `genresonbook` (
  `genresId` int NOT NULL,
  `bookId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `rating`
--

CREATE TABLE `rating` (
  `id` int NOT NULL,
  `createdAt` datetime(3) NOT NULL DEFAULT CURRENT_TIMESTAMP(3),
  `updatedAt` datetime(3) NOT NULL,
  `delivered` tinyint(1) NOT NULL DEFAULT '0',
  `bookId` int NOT NULL,
  `authorId` int NOT NULL,
  `rating` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `usermodel`
--

CREATE TABLE `usermodel` (
  `id` int NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `login` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `usermodel`
--
ALTER TABLE `usermodel`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

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
