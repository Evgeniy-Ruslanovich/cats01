-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 06 2018 г., 21:47
-- Версия сервера: 5.7.16
-- Версия PHP: 5.6.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `cats2`
--
CREATE DATABASE IF NOT EXISTS `cats2` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `cats2`;

-- --------------------------------------------------------

--
-- Структура таблицы `cats_photos`
--

CREATE TABLE `cats_photos` (
  `id` smallint(6) UNSIGNED NOT NULL,
  `title` char(45) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `photo` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cats_photos`
--

INSERT INTO `cats_photos` (`id`, `title`, `description`, `photo`) VALUES
(1, 'Шуганутый кот', 'Мы не знаем точно, что сделал этот милый котик. Может, увидел приведение (а ведь коты выдят приведений!), увидел леящий в него тапок, или услышал голос хозяина \"Барсик, тепе капец!\" - в любом случае, он очень мило шуганулся', 'cat1.jpg'),
(2, 'Кот-спектик', 'У этого кота такой взгляд, будто он бесконечно устал от жизни. Он видит тебя насквозь. и все тавои глупые попытки умиляться, или что-то из себя строить, или вообще любые твои попытки - он примет с изрядной долей уничтожающего скепсиса', 'cat2.jpg'),
(3, 'Кот - Собчак', 'Мнение редакции может не совпадать с мнением пользователей, но наши пользователи однозначно уверены, что эта наглая кошара - вылитая Ксения Собчак', 'cat3.jpg'),
(4, 'Вомущенный котяра', 'Именно так выглядит кот, когда кто-то нарушает его конституционные права, напремер ест из его миски. Но он настолько ленив, что не может подняться с места. Его гражданского гнева хватает только на то, чтобы возмущенно мяукать и таращить глаза', 'cat4.jpg'),
(5, 'Кот-инопланетянин', 'Мы тоже сначала подумали, что это фотошоп. Однако, дальнейшие исследования показали - инфа 100% - что этот кот, как, впрочем и большинство других, является агентом иной цивилизации, которая строит свои коварные планы по порабощению земли. И это, кстати говоря. им удается - они уже напрочь захватили информационное пространство и зазомбировали всех пользователей интернета. Даже наш сайт не стал исключением и поддался котогипнозу.', 'foureyes.jpg'),
(6, 'Милейший котёночек', 'Если ты не умиляешься при виде этого милого создания - у тебя просто нет сердца. Тебе не место в наших рядах. Отправляйся обратно в свой холодный ад.', 'kitty.jpg'),
(7, 'Рыжая и Чёрный', 'Посмотри на эту сладкую парочку! Сколько расслабленности и нжности сочится из этой фотографии! Каждая влюбленная пара переживает такой период в жизни, когда они могут беззаботно лежать вот так, обнявшись, и ни о чем не думать', 'red-and-black.jpg'),
(8, 'Песчаная кошка', 'ВОзможно, ты думаешь - что кошки - это исключительно обитатели душных квартир мегаполиса. А вот и нет! Кошки обитают в самых разных местах. от заснеженной тундры до знойных пустынь. Эта песчаная кошка является ловким охотников и настоящей грозой пустыни. Но сейчас она просто сладко зевает, проснувшись после ночной охоты', 'sandcat.jpg'),
(10, 'Интроверт в отпуске', 'Описание интроверт в отпуске', 'a926a37c1c9cd01a0d194227507b688458.jpg'),
(13, 'Ну охренеть! А мы тут ежей доедаем', 'Ну охренеть! А мы тут ежей доедаем! Уже последнего доели', '44b405710026795938adf451d1c212db70.jpg'),
(14, 'Банхаммер', 'Священный Банхаммер.\r\nОпасайся того, в чьих он руках', 'f6d6b7a5a6c8f60b8a48206a24cbce1218.jpg'),
(16, 'Самолет', 'Самолет, самолет, отправляется в полет', '827f3b172df9e135f68a93679cd7ef925.jpg'),
(18, 'Ждун', 'Перемен! Мы ждем перемен! Перемен!', '0dbbe9ee9f782e623408d525421d547769.jpg'),
(19, 'Ящерица', 'Как мы видим, PNG тоже обрабатывается корректно', '3a432f5a03f0fd6949cfbc6e534ff5b343.png'),
(22, 'Слабоумие и отвага', 'Слабоумие и отвага. Нашивка с Чипом и Дейлом фвыафвыа', 'e286612c8238adb35e67fa168d57e90463.jpg'),
(23, 'Хрень', 'Какая-то хрень', 'e8f2119ed8204642987ed7f535201c4c60.jpg'),
(24, 'Танец', 'Какая-то картина. Кто-то танцует. В каком-то кабаке.', '08349bd62a1f6c0f8e182c9b2e38b80b79.jpg'),
(25, 'Безумный Маркс', 'Возможен ли коммунизм в отдельно взятой пустыне?', '41e412600edee40e822a298d00e1e33038.jpg');

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
  MODIFY `id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
