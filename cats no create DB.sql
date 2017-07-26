-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 17 2017 г., 18:02
-- Версия сервера: 5.5.48
-- Версия PHP: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `cats`
--


-- --------------------------------------------------------

--
-- Структура таблицы `cats_photos`
--

CREATE TABLE IF NOT EXISTS `cats_photos` (
  `id` smallint(6) unsigned NOT NULL,
  `title` char(45) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `photo` char(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cats_photos`
--

INSERT INTO `cats_photos` (`id`, `title`, `description`, `photo`) VALUES
(1, 'Шуганутый кот', 'Мы не знаем точно, что сделал этот милый котик. Может, увидел приведение (а ведь коты выдят приведений!), увидел леящий в него тапок, или услышал голос хозяина "Барсик, тепе капец!" - в любом случае, он очень мило шуганулся', 'cat1'),
(2, 'Кот-спектик', 'У этого кота такой взгляд, будто он бесконечно устал от жизни. Он видит тебя насквозь. и все тавои глупые попытки умиляться, или что-то из себя строить, или вообще любые твои попытки - он примет с изрядной долей уничтожающего скепсиса', 'cat2'),
(3, 'Кот - Собчак', 'Мнение редакции может не совпадать с мнением пользователей, но наши пользователи однозначно уверены, что эта наглая кошара - вылитая Ксения Собчак', 'cat3'),
(4, 'Вомущенный котяра', 'Именно так выглядит кот, когда кто-то нарушает его конституционные права, напремер ест из его миски. Но он настолько ленив, что не может подняться с места. Его гражданского гнева хватает только на то, чтобы возмущенно мяукать и таращить глаза', 'cat4'),
(5, 'Кот-инопланетянин', 'Мы тоже сначала подумали, что это фотошоп. Однако, дальнейшие исследования показали - инфа 100% - что этот кот, как, впрочем и большинство других, является агентом иной цивилизации, которая строит свои коварные планы по порабощению земли. И это, кстати говоря. им удается - они уже напрочь захватили информационное пространство и зазомбировали всех пользователей интернета. Даже наш сайт не стал исключением и поддался котогипнозу.', 'foureyes'),
(6, 'Милейший котёночек', 'Если ты не умиляешься при виде этого милого создания - у тебя просто нет сердца. Тебе не место в наших рядах. Отправляйся обратно в свой холодный ад.', 'kitty'),
(7, 'Рыжая и Чёрный', 'Посмотри на эту сладкую парочку! Сколько расслабленности и нжности сочится из этой фотографии! Каждая влюбленная пара переживает такой период в жизни, когда они могут беззаботно лежать вот так, обнявшись, и ни о чем не думать', 'red-and-black'),
(8, 'Песчаная кошка', 'ВОзможно, ты думаешь - что кошки - это исключительно обитатели душных квартир мегаполиса. А вот и нет! Кошки обитают в самых разных местах. от заснеженной тундры до знойных пустынь. Эта песчаная кошка является ловким охотников и настоящей грозой пустыни. Но сейчас она просто сладко зевает, проснувшись после ночной охоты', 'sandcat');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cats_photos`
--
ALTER TABLE `cats_photos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cats_photos`
--
ALTER TABLE `cats_photos`
  MODIFY `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
