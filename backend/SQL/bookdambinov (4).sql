-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 05 2022 г., 09:35
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
  `avatar_author` varchar(600) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'author.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `authors`
--

INSERT INTO `authors` (`id`, `firstName`, `lastname`, `avatar_author`) VALUES
(12, 'Стивен', 'Кинг', '1571405945.jpg'),
(13, 'Максим', 'Дорофеев', '140620797.jpg'),
(14, 'Роберт', 'Мартин', '1840414293.jpg'),
(15, 'Рэй ', 'Брэдбери', '346187464.jpg'),
(16, 'Шарлотта', 'Бронте', '1863190172.jpg'),
(17, 'Стругацкий', 'Аркадий ', '1646278195.jpg'),
(18, 'Борис', 'Стругацкий', '1038875789.jpg'),
(19, 'Марк', 'Мэнсон ', '1953587807.jpg'),
(20, 'Александр', 'Пушкин', '1543646607.jpg');

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
(12, 37),
(13, 38),
(14, 39),
(15, 40),
(16, 41),
(12, 42),
(17, 43),
(18, 43),
(19, 44),
(12, 45),
(12, 56),
(12, 57),
(12, 58),
(20, 59),
(20, 60);

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
(37, 'Долгая Прогулка', '2022-01-01', 'Это была страшная игра — игра на выживание. Это была Долгая Прогулка. Прогулка со Смертью, ибо смерть ожидала каждого упавшего. Дорога к счастью — потому что победивший в игре получал все.  На долгую прогулку вышли многие — но закончит ее только один. Остальные лягут мертвыми на дороге — потому что дорога к счастью для одного станет последней дорогой для многих.', '1856363250.jpg'),
(38, 'Джедайские техники', '2022-01-01', 'Автор простым языком объясняет, как устроено наше мышление и память; почему мы неэкономно тратим ресурсы нашего мозга; как их сохранять, как правильно концентрироваться, формулировать задачи и восстанавливаться для продуктивной работы.', '171881602.jpg'),
(39, 'Чистый код', '2021-01-01', 'Бестселлер от эксперта в области разработки ПО Роберта Мартина по рефакторингу: искусству исправления и очистки программного кода.', '1616355163.jpg'),
(40, '451 по Фаренгейту', '2022-01-01', '451° по Фаренгейту — температура, при которой воспламеняется и горит бумага. Философская антиутопия Брэдбери рисует беспросветную картину развития постиндустриального общества: это мир будущего, в котором все письменные издания безжалостно уничтожаются специальным отрядом пожарных, а хранение книг преследуется по закону, интерактивное телевидение успешно служит всеобщему оболваниванию, карательная психиатрия решительно разбирается с редкими инакомыслящими, а на охоту за неисправимыми диссидентами выходит электрический пес…  Роман, принесший своему творцу мировую известность.  Сенсационным было заявление Брэдбери в 2007 году, что «451° по Фаренгейту» понимают неправильно. Эта книга не о правительственной цензуре, это история о том, как телевидение уничтожает интерес к чтению книг.  В начале 1950-х большинство американцев в глаза не видело телевизора, однако Брэдбери предсказал наступление новой эры свободы, достатка и развлечений, когда желание быть счастливым, помноженное на политкорре', '1833386333.jpg'),
(41, 'Джейн Эйр', '2022-01-01', 'Даже не читая этого романа, вы наверняка слышали про Джейн Эйр. Скорее всего, вы смотрели фильм по этому роману. Надо сказать, что экранизаций &quot;Джейн Эйр&quot; очень много, одна из них — с Шарлоттой Генсбур в главной роли (режиссер – Франко Дзефирелли). Джейн Эйр давным-давно переросла свою героиню и стала почти что именем нарицательным. Многие девушки, наверное, мечтали бы повторить ее судьбу. Да, детство у нее было настоящим кошмаром. Да и молодость выдалась тяжелой. Пусть Джейн не так уж хороша собой, и жизнь ее вовсе не балует, но в конечном итоге она обретет свое счастье. Полный загадок, порой трагических поворотов сюжета, этот роман был и остается символом веры, надежды и любви.  Цитаты', '2028845903.jpg'),
(42, 'Клатбище домашних жывотных', '2022-01-01', 'Роман, который сам Кинг, считая &quot;слишком страшным&quot;, долго не хотел отдавать в печать, но только за первый год было продано 657 000 экземпляров! Также роман лег в основу одноименного фильма Мэри Ламберт (где Кинг, кстати, сыграл небольшую роль).  Казалось бы, семейство Крид — это настоящее воплощение &quot;американской мечты&quot;: отец — преуспевающий врач, красавица мать, прелестные дети. Для полной идиллии им не хватает лишь большого старинного дома, куда они вскоре и переезжают.  Но идиллия вдруг стала превращаться в кошмар. Потому что в окружающих их новое жилище вековых лесах скрывается НЕЧТО, более ужасное, чем сама смерть и… более могущественное.  Читайте легендарный роман Стивена Кинга &quot;КлаТбище домашних жЫвотных&quot; — в новом переводе и впервые без сокращений!', '1913677485.jpg'),
(43, 'Пикник на обочине', '2022-01-01', 'Пожалуй, в истории современной мировой фантастики найдется не так много произведений, которые оставались бы популярными столь долгое время. Повесть послужила основой культового фильма Тарковского &quot;Сталкер&quot;; через три десятилетия появились не менее культовая компьютерная игра с тем же названием и целая серия повестей и романов, написанных с использованием мира &quot;Пикника&quot;.', '1857290167.jpg'),
(44, 'Тонкое искусство пофигизма', '2018-01-01', 'Современное общество пропагандирует культ успеха: будь умнее, богаче, продуктивнее — будь лучше всех. Соцсети изобилуют историями на тему, как какой-то малец придумал приложение и заработал кучу денег, статьями в духе &quot;Тысяча и один способ быть счастливым&quot;, а фото во френдленте создают впечатление, что окружающие живут лучше и интереснее, чем мы. Однако наша зацикленность на позитиве и успехе лишь напоминает о том, чего мы не достигли, о мечтах, которые не сбылись. Как же стать по-настоящему счастливым? Популярный блогер Марк Мэнсон в книге &quot;Тонкое искусство пофигизма&quot; предлагает свой, оригинальный подход к этому вопросу. Его жизненная философия проста — необходимо научиться искусству пофигизма. Определив то, до чего вам действительно есть дело, нужно уметь наплевать на все второстепенное, забить на трудности, послать к черту чужое мнение и быть готовым взглянуть в лицо неудачам и показать им средний палец.', '427411701.jpg'),
(45, 'Институт', '2022-01-01', 'Один из самых ярких романов Стивена Кинга за последние 10 лет — теперь в стильном коллекционном оформлении Андрея Фереза.  Для всех поклонников культового бестселлера «Оно» и телесериала «Очень странные дела».', '1403212361.jpg'),
(56, 'Последнее дело Гвенди', '2022-01-01', 'Впервые на русском языке!  Долгожданное завершение трилогии о Гвенди. Продолжение книг «Гвенди и её шкатулка» и «Гвенди и волшебное пёрышко».  Обязательно к прочтению всем фанатам романа «Оно» и цикла «Тёмная башня»  Трилогия Стивена Кинга, написанная им в соавторстве со своим преданным фанатом — писателем, редактором и издателем Ричардом Чизмаром.', '1065924961.jpg'),
(57, 'Тьма, - и больше ничего', '2022-01-01', 'Впервые на русском языке!  Долгожданное завершение трилогии о Гвенди. Продолжение книг «Гвенди и её шкатулка» и «Гвенди и волшебное пёрышко».  Обязательно к прочтению всем фанатам романа «Оно» и цикла «Тёмная башня»  Трилогия Стивена Кинга, написанная им в соавторстве со своим преданным фанатом — писателем, редактором и издателем Ричардом Чизмаром.', '2124956453.jpg'),
(58, 'Ветер сквозь замочную скважину', '2022-01-01', 'Ветер сквозь замочную скважину', '522626781.jpg'),
(59, 'Капитанская дочка', '2022-01-01', '&quot;Повести Белкина&quot; – цикл из пяти повестей. Временами – трагические, временами – забавные, а порой даже мистические, они рассказывают нам истории о любви, мести, одиночестве, о поиске смысла жизни. &quot;Дубровский&quot; – увлекательный роман-повесть о внезапно вспыхнувшем чувстве между потомками двух враждующих семейств. &quot;Капитанская дочка&quot; – исторический роман, в котором на фоне крестьянского восстания Емельяна Пугачева разворачивается трогательная история любви. И наконец, неоконченное произведение &quot;Арап Петра Великого&quot; – первая попытка наиболее полно описать время правления Петра I, а также рассказ о судьбе предка Пушкина Абрама Петровича Ганнибала.', '1688541995.jpg'),
(60, 'Евгений Онегин', '2022-01-01', '&quot;Евгений Онегин&quot; (1823-1831) – одно из самых значительных произведений русской литературы.  Пронзительная любовная история, драматические повороты сюжета, тонкий психологизм персонажей, детальное описание быта и нравов той эпохи (не случайно Белинский назвал роман &quot;энциклопедией русской жизни&quot;) – в этом произведении, как в зеркале, отразилась вся русская жизнь. &quot;Евгений Онегин&quot; никогда не утратит своей актуальности, и даже спустя два века мы поражаемся точности и верности &quot;ума холодных наблюдений и сердца горестных замет&quot; великого русского поэта.', '2110510232.jpg');

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
(18, '2022-12-04 20:21:15.000', 'Лучшая книга', 38, 37),
(22, '2022-12-04 20:27:01.000', 'неплохо', 38, 37),
(23, '2022-12-04 21:03:18.000', 'мне понравилось!)', 39, 38),
(24, '2022-12-04 21:26:40.000', 'Норм', 40, 37);

-- --------------------------------------------------------

--
-- Структура таблицы `genres`
--

CREATE TABLE `genres` (
  `id` int NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'genre.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `genres`
--

INSERT INTO `genres` (`id`, `name`, `img`) VALUES
(7, 'Фантастика', '1976042140.jpg'),
(8, 'Детектив', '1827734747.jpg'),
(9, 'Психология личности', '1967736249.jpg'),
(10, 'Программирование', '545647456.jpg'),
(11, 'Классическая литература', '398420979.jpg');

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
(7, 37),
(8, 37),
(9, 38),
(10, 39),
(7, 40),
(11, 41),
(7, 42),
(7, 43),
(9, 44),
(7, 45),
(7, 56),
(8, 57),
(8, 58),
(11, 59),
(11, 60);

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
  `rating` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `rating`
--

INSERT INTO `rating` (`id`, `createdAt`, `updatedAt`, `bookId`, `authorId`, `rating`) VALUES
(10, '2022-12-04 20:27:07.000', '2022-12-04 20:27:07.000', 37, 38, 4.5),
(11, '2022-12-04 21:02:54.000', '2022-12-04 21:02:54.000', 38, 39, 5),
(12, '2022-12-04 21:26:45.000', '2022-12-04 21:26:45.000', 37, 40, 3);

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
(35, 'damur2004@gmail.com', 'admin', '9cdfb439c7876e703e307864c9167a15', '930330859.jpg', 'admin', 'allow'),
(36, 'samatnurzhanov2003@gmail.com', 'samat', '03d59e663c1af9ac33a9949d1193505a', '1172199627.jpg', 'user', 'banned'),
(37, 'damu123r2004@gmail.com', 'admsdin', '9cdfb439c7876e703e307864c9167a15', 'avatar.jpg', 'user', 'allow'),
(38, 'samatnurzhanov2004@gmail.com', 'samat', '74db120f0a8e5646ef5a30154e9f6deb', '401000981.jpg', 'user', 'allow'),
(39, 'rufat2004@gmail.com', 'rufat', 'd8578edf8458ce06fbc5bb76a58c5ca4', '1438310.png', 'user', 'banned'),
(40, 'valentintelkunov@gmail.com', 'adminDiscord', '202cb962ac59075b964b07152d234b70', '791216138.jpg', 'user', 'allow');

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `book`
--
ALTER TABLE `book`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT для таблицы `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `usermodel`
--
ALTER TABLE `usermodel`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

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
