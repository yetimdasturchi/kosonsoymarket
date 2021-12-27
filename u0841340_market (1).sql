-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Дек 01 2019 г., 16:39
-- Версия сервера: 5.7.23-24
-- Версия PHP: 5.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `u0841340_market`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `slug` varchar(255) NOT NULL DEFAULT '',
  `name` text NOT NULL,
  `title` text NOT NULL,
  `keywords` text NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `skin` varchar(255) NOT NULL DEFAULT '',
  `post_number` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`category_id`, `parent_id`, `slug`, `name`, `title`, `keywords`, `description`, `image`, `icon`, `skin`, `post_number`, `status`) VALUES
(1, 0, 'ko-chmas-mulk', '{"uzbek_lt":"Ko\\u2018chmas mulk","uzbek_cyr":"\\u041a\\u045e\\u0447\\u043c\\u0430\\u0441 \\u043c\\u0443\\u043b\\u043a"}', '{"uzbek_lt":"Ko\\u2018chmas mulk","uzbek_cyr":"\\u041a\\u045e\\u0447\\u043c\\u0430\\u0441 \\u043c\\u0443\\u043b\\u043a"}', '{"uzbek_lt":"Ko\\u2018chmas mulk","uzbek_cyr":"\\u041a\\u045e\\u0447\\u043c\\u0430\\u0441 \\u043c\\u0443\\u043b\\u043a"}', '{"uzbek_lt":"Ko\\u2018chmas mulk","uzbek_cyr":"\\u041a\\u045e\\u0447\\u043c\\u0430\\u0441 \\u043c\\u0443\\u043b\\u043a"}', '', 'flaticon-home-1', '', 0, 1),
(2, 0, 'transport', '{"uzbek_lt":"Transport","uzbek_cyr":"\\u0422\\u0440\\u0430\\u043d\\u0441\\u043f\\u043e\\u0440\\u0442"}', '{"uzbek_lt":"Transport","uzbek_cyr":"\\u0422\\u0440\\u0430\\u043d\\u0441\\u043f\\u043e\\u0440\\u0442"}', '{"uzbek_lt":"Transport","uzbek_cyr":"\\u0422\\u0440\\u0430\\u043d\\u0441\\u043f\\u043e\\u0440\\u0442"}', '{"uzbek_lt":"Transport","uzbek_cyr":"\\u0422\\u0440\\u0430\\u043d\\u0441\\u043f\\u043e\\u0440\\u0442"}', '', 'flaticon-transport-9', '', 0, 1),
(3, 0, 'ish', '{"uzbek_lt":"Ish","uzbek_cyr":"\\u0418\\u0448"}', '{"uzbek_lt":"Ish","uzbek_cyr":"\\u0418\\u0448"}', '{"uzbek_lt":"Ish","uzbek_cyr":"\\u0418\\u0448"}', '{"uzbek_lt":"Ish","uzbek_cyr":"\\u0418\\u0448"}', '', 'flaticon-suitcase', '', 0, 0),
(4, 0, 'elektronika', '{"uzbek_cyr":"\\u042d\\u043b\\u0435\\u043a\\u0442\\u0440\\u043e\\u043d\\u0438\\u043a\\u0430  \\u0432\\u0430 \\u043a\\u043e\\u043c\\u043f\\u044e\\u0442\\u0435\\u0440","uzbek_lt":"Elektronika va kompyuter"}', '{"uzbek_cyr":"\\u042d\\u043b\\u0435\\u043a\\u0442\\u0440\\u043e\\u043d\\u0438\\u043a\\u0430  \\u0432\\u0430 \\u043a\\u043e\\u043c\\u043f\\u044e\\u0442\\u0435\\u0440","uzbek_lt":"Elektronika va kompyuter"}', '{"uzbek_cyr":"\\u042d\\u043b\\u0435\\u043a\\u0442\\u0440 \\u0436\\u0438\\u04b3\\u043e\\u0437\\u043b\\u0430\\u0440\\u0438","uzbek_lt":"Elektr jihozlari"}', '{"uzbek_cyr":"\\u042d\\u043b\\u0435\\u043a\\u0442\\u0440\\u043e\\u043d\\u0438\\u043a\\u0430  \\u0432\\u0430 \\u043a\\u043e\\u043c\\u043f\\u044e\\u0442\\u0435\\u0440","uzbek_lt":"Elektronika va kompyuter"}', '', 'flaticon-computer-3', '', 0, 1),
(5, 0, 'xizmatlar', '{"uzbek_lt":"Xizmatlar","uzbek_cyr":"\\u0425\\u0438\\u0437\\u043c\\u0430\\u0442\\u043b\\u0430\\u0440"}', '{"uzbek_lt":"Xizmatlar","uzbek_cyr":"\\u0425\\u0438\\u0437\\u043c\\u0430\\u0442\\u043b\\u0430\\u0440"}', '{"uzbek_lt":"Xizmatlar","uzbek_cyr":"\\u0425\\u0438\\u0437\\u043c\\u0430\\u0442\\u043b\\u0430\\u0440"}', '{"uzbek_lt":"Xizmatlar","uzbek_cyr":"\\u0425\\u0438\\u0437\\u043c\\u0430\\u0442\\u043b\\u0430\\u0440"}', '', 'flaticon-wrench', '', 0, 1),
(6, 0, 'bolalar-dunyosi', '{"uzbek_lt":"Bolalar dunyosi","uzbek_cyr":"\\u0411\\u043e\\u043b\\u0430\\u043b\\u0430\\u0440 \\u0434\\u0443\\u043d\\u0451\\u0441\\u0438"}', '{"uzbek_lt":"Bolalar dunyosi","uzbek_cyr":"\\u0411\\u043e\\u043b\\u0430\\u043b\\u0430\\u0440 \\u0434\\u0443\\u043d\\u0451\\u0441\\u0438"}', '{"uzbek_lt":"Bolalar dunyosi","uzbek_cyr":"\\u0411\\u043e\\u043b\\u0430\\u043b\\u0430\\u0440 \\u0434\\u0443\\u043d\\u0451\\u0441\\u0438"}', '{"uzbek_lt":"Bolalar dunyosi","uzbek_cyr":"\\u0411\\u043e\\u043b\\u0430\\u043b\\u0430\\u0440 \\u0434\\u0443\\u043d\\u0451\\u0441\\u0438"}', '', 'flaticon-bonnet', '', 0, 0),
(7, 0, 'jonivorlar', '{"uzbek_lt":"Jonivorlar","uzbek_cyr":"\\u0416\\u043e\\u043d\\u0438\\u0432\\u043e\\u0440\\u043b\\u0430\\u0440"}', '{"uzbek_lt":"Jonivorlar","uzbek_cyr":"\\u0416\\u043e\\u043d\\u0438\\u0432\\u043e\\u0440\\u043b\\u0430\\u0440"}', '{"uzbek_lt":"Jonivorlar","uzbek_cyr":"\\u0416\\u043e\\u043d\\u0438\\u0432\\u043e\\u0440\\u043b\\u0430\\u0440"}', '{"uzbek_lt":"Jonivorlar","uzbek_cyr":"\\u0416\\u043e\\u043d\\u0438\\u0432\\u043e\\u0440\\u043b\\u0430\\u0440"}', '', 'flaticon-dog', '', 0, 1),
(8, 0, 'dokon-bino', '{"uzbek_cyr":"\\u0414\\u045e\\u043a\\u043e\\u043d \\u0432\\u0430 \\u0431\\u0438\\u043d\\u043e","uzbek_lt":"Do`kon va bino"}', '{"uzbek_cyr":"\\u0414\\u045e\\u043a\\u043e\\u043d \\u0432\\u0430 \\u0431\\u0438\\u043d\\u043e","uzbek_lt":"Do`kon va bino"}', '{"uzbek_cyr":"\\u0414\\u045e\\u043a\\u043e\\u043d \\u0432\\u0430 \\u0431\\u0438\\u043d\\u043e","uzbek_lt":"dokon va bino"}', '{"uzbek_cyr":"\\u0414\\u045e\\u043a\\u043e\\u043d \\u0432\\u0430 \\u0431\\u0438\\u043d\\u043e","uzbek_lt":"Dokon va bino"}', '', 'flaticon-signs-2', '', 0, 1),
(9, 0, 'moda-va-stil', '{"uzbek_lt":"Moda va stil","uzbek_cyr":"\\u041c\\u043e\\u0434\\u0430 \\u0432\\u0430 \\u0441\\u0442\\u0438\\u043b"}', '{"uzbek_lt":"Moda va stil","uzbek_cyr":"\\u041c\\u043e\\u0434\\u0430 \\u0432\\u0430 \\u0441\\u0442\\u0438\\u043b"}', '{"uzbek_lt":"Moda va stil","uzbek_cyr":"\\u041c\\u043e\\u0434\\u0430 \\u0432\\u0430 \\u0441\\u0442\\u0438\\u043b"}', '{"uzbek_lt":"Moda va stil","uzbek_cyr":"\\u041c\\u043e\\u0434\\u0430 \\u0432\\u0430 \\u0441\\u0442\\u0438\\u043b"}', '', 'flaticon-clothes', '', 0, 1),
(10, 0, 'ishlab-chiqarish', '{"uzbek_cyr":"\\u0418\\u0448\\u043b\\u0430\\u0431 \\u0447\\u0438\\u049b\\u0430\\u0440\\u0438\\u0448","uzbek_lt":"Ishlab chiqarish"}', '{"uzbek_cyr":"\\u0418\\u0448\\u043b\\u0430\\u0431 \\u0447\\u0438\\u049b\\u0430\\u0440\\u0438\\u0448","uzbek_lt":"Ishlab chiqarish"}', '{"uzbek_cyr":"\\u0418\\u0448\\u043b\\u0430\\u0431 \\u0447\\u0438\\u049b\\u0430\\u0440\\u0438\\u0448","uzbek_lt":"Ishlab chiqarish"}', '{"uzbek_cyr":"\\u0418\\u0448\\u043b\\u0430\\u0431 \\u0447\\u0438\\u049b\\u0430\\u0440\\u0438\\u0448","uzbek_lt":"Ishlab chiqarish"}', '', 'flaticon-clothes-1', '', 0, 1),
(20, 9, 'kosmetika', '{"uzbek_cyr":"\\u041a\\u043e\\u0441\\u043c\\u0435\\u0442\\u0438\\u043a\\u0430","uzbek_lt":"Kosmetika"}', '{"uzbek_cyr":"\\u041a\\u043e\\u0441\\u043c\\u0435\\u0442\\u0438\\u043a\\u0430","uzbek_lt":"Kosmetika"}', '{"uzbek_cyr":"\\u041a\\u043e\\u0441\\u043c\\u0435\\u0442\\u0438\\u043a\\u0430","uzbek_lt":"Kosmetika"}', '{"uzbek_cyr":"\\u041a\\u043e\\u0441\\u043c\\u0435\\u0442\\u0438\\u043a\\u0430 ","uzbek_lt":"Kosmetika"}', '', 'flaticon-medical', '', 0, 1),
(11, 0, 'tekinga-beraman', '{"uzbek_lt":"Tekinga beraman","uzbek_cyr":"\\u0422\\u0435\\u043a\\u0438\\u043d\\u0433\\u0430 \\u0431\\u0435\\u0440\\u0430\\u043c\\u0430\\u043d"}', '{"uzbek_lt":"Tekinga beraman","uzbek_cyr":"\\u0422\\u0435\\u043a\\u0438\\u043d\\u0433\\u0430 \\u0431\\u0435\\u0440\\u0430\\u043c\\u0430\\u043d"}', '{"uzbek_lt":"Tekinga beraman","uzbek_cyr":"\\u0422\\u0435\\u043a\\u0438\\u043d\\u0433\\u0430 \\u0431\\u0435\\u0440\\u0430\\u043c\\u0430\\u043d"}', '{"uzbek_lt":"Tekinga beraman","uzbek_cyr":"\\u0422\\u0435\\u043a\\u0438\\u043d\\u0433\\u0430 \\u0431\\u0435\\u0440\\u0430\\u043c\\u0430\\u043d"}', '', 'flaticon-heart', '', 0, 1),
(12, 0, 'ayirboshlash', '{"uzbek_lt":"Ayirboshlash","uzbek_cyr":"\\u0410\\u0439\\u0438\\u0440\\u0431\\u043e\\u0448\\u043b\\u0430\\u0448"}', '{"uzbek_lt":"Ayirboshlash","uzbek_cyr":"\\u0410\\u0439\\u0438\\u0440\\u0431\\u043e\\u0448\\u043b\\u0430\\u0448"}', '{"uzbek_lt":"Ayirboshlash","uzbek_cyr":"\\u0410\\u0439\\u0438\\u0440\\u0431\\u043e\\u0448\\u043b\\u0430\\u0448"}', '{"uzbek_lt":"Ayirboshlash","uzbek_cyr":"\\u0410\\u0439\\u0438\\u0440\\u0431\\u043e\\u0448\\u043b\\u0430\\u0448"}', '', 'flaticon-business-deal', '', 0, 0),
(16, 1, 'uchastka-boshyer', '{"uzbek_cyr":"\\u0423\\u0447\\u0430\\u0441\\u0442\\u043a\\u0430 (\\u0411\\u045e\\u0448 \\u0435\\u0440) ","uzbek_lt":"Uchaska (Bo\\u2018sh yer) "}', '{"uzbek_cyr":"\\u0423\\u0447\\u0430\\u0441\\u0442\\u043a\\u0430","uzbek_lt":"Uchastka"}', '{"uzbek_cyr":"\\u0423\\u0447\\u0430\\u0441\\u0442\\u043a\\u0430,\\u0411\\u0443\\u0448\\u0435\\u0440","uzbek_lt":"Uchastka boshyer,Boshyer,Uchastka"}', '{"uzbek_cyr":"\\u0423\\u0447\\u0430\\u0441\\u0442\\u043a\\u0430","uzbek_lt":"Uchastka"}', '', 'flaticon-for-sale', '', 0, 1),
(17, 0, 'yoqotmalar', '{"uzbek_cyr":"\\u0419\\u045e\\u049b\\u043e\\u0442\\u043c\\u0430\\u043b\\u0430\\u0440","uzbek_lt":"\\u200bYo`qotmalar"}', '{"uzbek_cyr":"\\u0419\\u045e\\u049b\\u043e\\u043b\\u0433\\u0430\\u043d \\u043d\\u0430\\u0440\\u0441\\u0430\\u043b\\u0430\\u0440","uzbek_lt":"\\u200bYo`qolgan narsalar"}', '{"uzbek_cyr":"\\u0451\\u049b\\u043e\\u0442\\u043c\\u0430\\u043b\\u0430\\u0440 \\u0451\\u049b\\u043e\\u043b\\u0433\\u0430\\u043d","uzbek_lt":"yoqotmalar yoqolgan"}', '{"uzbek_cyr":"\\u0419\\u045e\\u049b\\u043e\\u0442\\u043c\\u0430\\u043b\\u0430\\u0440","uzbek_lt":"\\u200bYo`qotmalar"}', '', 'flaticon-interface-1', '', 0, 0),
(18, 0, 'telefon', '{"uzbek_cyr":"\\u0422\\u0435\\u043b\\u0435\\u0444\\u043e\\u043d\\u043b\\u0430\\u0440","uzbek_lt":"Telefonlar"}', '{"uzbek_cyr":"\\u0422\\u0435\\u043b\\u0435\\u0444\\u043e\\u043d\\u043b\\u0430\\u0440","uzbek_lt":"Telefonlar"}', '{"uzbek_cyr":"\\u0422\\u0435\\u043b\\u0435\\u0444\\u043e\\u043d\\u043b\\u0430\\u0440","uzbek_lt":"Telefonlar"}', '{"uzbek_cyr":"\\u0422\\u0435\\u043b\\u0435\\u0444\\u043e\\u043d\\u043b\\u0430\\u0440","uzbek_lt":"Telefonlar"}', '', 'flaticon-apple', '', 0, 1),
(19, 1, 'kvartira', '{"uzbek_cyr":"\\u041a\\u0432\\u0430\\u0440\\u0442\\u0438\\u0440\\u0430","uzbek_lt":"Kvartira"}', '{"uzbek_cyr":"\\u041a\\u0432\\u0430\\u0440\\u0442\\u0438\\u0440\\u0430","uzbek_lt":"Kvartira"}', '{"uzbek_cyr":"\\u041a\\u0432\\u0430\\u0440\\u0442\\u0438\\u0440\\u0430","uzbek_lt":"Kvartira"}', '{"uzbek_cyr":"\\u041a\\u0432\\u0430\\u0440\\u0442\\u0438\\u0440\\u0430","uzbek_lt":"Kvartira"}', '', 'flaticon-office-1', '', 0, 1),
(21, 9, 'parfumeria', '{"uzbek_cyr":"\\u041f\\u0430\\u0440\\u0444\\u044e\\u043c\\u0435\\u0440\\u0438\\u0430","uzbek_lt":"Parfumeria"}', '{"uzbek_cyr":"\\u041f\\u0430\\u0440\\u0444\\u044e\\u043c\\u0435\\u0440\\u0438\\u0430","uzbek_lt":"Parfumeria"}', '{"uzbek_cyr":"\\u041f\\u0430\\u0440\\u0444\\u044e\\u043c\\u0435\\u0440\\u0438\\u0430,\\u0410\\u0442\\u0438\\u0440","uzbek_lt":"Parfumeria"}', '{"uzbek_cyr":"\\u041f\\u0430\\u0440\\u0444\\u044e\\u043c\\u0435\\u0440\\u0438\\u0430","uzbek_lt":"Parfumeria"}', '', 'flaticon-shapes-1', '', 0, 1),
(22, 9, 'gigiena', '{"uzbek_cyr":"\\u0413\\u0438\\u0433\\u0438\\u0435\\u043d\\u0430 \\u0432\\u043e\\u0441\\u0438\\u0442\\u0430\\u043b\\u0430\\u0440\\u0438","uzbek_lt":"Gigiyena vositalari"}', '{"uzbek_cyr":"\\u0413\\u0438\\u0433\\u0438\\u0435\\u043d\\u0430  \\u0432\\u043e\\u0441\\u0438\\u0442\\u0430\\u043b\\u0430\\u0440\\u0438 ","uzbek_lt":"Gigiyena vositalari "}', '{"uzbek_cyr":"\\u0413\\u0438\\u0433\\u0438\\u0435\\u043d\\u0430 \\u0432\\u043e\\u0441\\u0438\\u0442\\u0430\\u043b\\u0430\\u0440\\u0438","uzbek_lt":"Gigiyena vositalari"}', '{"uzbek_cyr":"\\u0413\\u0438\\u0433\\u0438\\u0435\\u043d\\u0430 \\u0432\\u043e\\u0441\\u0438\\u0442\\u0430\\u043b\\u0430\\u0440\\u0438 ","uzbek_lt":"Gigiyena vositalari"}', '', 'flaticon-buildings', '', 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `contact_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date` bigint(22) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `contacts`
--

INSERT INTO `contacts` (`contact_id`, `name`, `subject`, `email`, `message`, `date`, `status`) VALUES
(1, 'Manuchehr1', 'Test', 'con9799@mail.ru', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution', 1571345051, 1),
(3, 'Manuchehr', 'Test', 'con9799@mail.ru', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution', 1571345051, 1),
(4, 'Manuchehr23', 'Test', 'con9799@mail.ru', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution', 1571141626, 1),
(5, 'Manuchehr', 'Test', 'con9799@mail.ru', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution', 1571345051, 1),
(6, 'Manuchehr23', 'Test', '@iplosvoy', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution', 1571141626, 1),
(7, 'Manuchehr23', 'Test', 'con9799@mail.ru', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution', 1571228026, 1),
(8, 'Manuchehr', 'Test', 'con9799@mail.ru', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution', 1571345051, 1),
(10, 'Manuchehr', 'Test', 'con9799@mail.ru', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution', 1571345051, 1),
(11, 'Manuchehr', 'Test', 'con9799@mail.ru', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution', 1571345051, 1),
(12, 'Manuchehr', 'Test', 'con9799@mail.ru', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution', 1571345051, 1),
(13, 'Manuchehr', 'Test', 'con9799@mail.ru', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution', 1571345051, 1),
(14, 'Manuchehr', 'Test', 'con9799@mail.ru', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution', 1571345051, 1),
(15, 'Manuchehr', 'Test', 'con9799@mail.ru', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution', 1571345051, 1),
(16, 'Manuchehr', 'Test', 'con9799@mail.ru', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution', 1571345051, 1),
(17, 'Manuchehr', 'Test', 'con9799@mail.ru', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution', 1571345051, 1),
(18, 'Manuchehr', 'Test', 'con9799@mail.ru', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution', 1571345051, 1),
(19, 'Manuchehr', 'Test', 'con9799@mail.ru', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution', 1571345051, 1),
(20, 'Manuchehr', 'Test', 'con9799@mail.ru', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution', 1571345051, 1),
(21, 'Manuchehr', 'Test', 'con9799@mail.ru', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution', 1571345051, 1),
(22, 'Manuchehr', 'Test', 'con9799@mail.ru', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution', 1571345051, 1),
(23, 'Manuchehr', 'Test', 'con9799@mail.ru', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution', 1571345051, 1),
(24, 'Manuchehr', 'Test', 'con9799@mail.ru', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution', 1571345051, 1),
(25, 'Manuchehr', 'Test', 'con9799@mail.ru', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution', 1571345051, 1),
(26, 'Manuchehr', 'Test', 'con9799@mail.ru', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution', 1571345051, 1),
(27, 'Manuchehr', 'Test', 'con9799@mail.ru', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution', 1571345051, 1),
(28, 'Manuchehr', 'Test', 'con9799@mail.ru', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution', 1571345051, 1),
(29, 'Manuchehr', 'Test', 'con9799@mail.ru', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution', 1571345051, 1),
(30, 'Manuchehr', 'Test', 'con9799@mail.ru', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution', 1571345051, 1),
(31, 'Manuchehr', 'Test', 'con9799@mail.ru', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution', 1571345051, 1),
(32, 'Manuchehr', 'Test', 'con9799@mail.ru', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution', 1571345051, 1),
(33, 'Manuchehr', 'Test', 'con9799@mail.ru', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution', 1571345051, 1),
(34, 'Manuchehr', 'Test', 'con9799@mail.ru', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution', 1571345051, 1),
(35, 'Manuchehr', 'Test', 'con9799@mail.ru', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution', 1571345051, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `filters`
--

CREATE TABLE IF NOT EXISTS `filters` (
  `filter_id` bigint(22) NOT NULL,
  `filter_name` text NOT NULL,
  `type` varchar(255) NOT NULL,
  `options` text NOT NULL,
  `category_id` bigint(22) NOT NULL,
  `content` text NOT NULL,
  `action` varchar(255) NOT NULL,
  `sort` bigint(22) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `filters`
--

INSERT INTO `filters` (`filter_id`, `filter_name`, `type`, `options`, `category_id`, `content`, `action`, `sort`) VALUES
(10, '{"uzbek_cyr":"\\u049a\\u0430\\u0435\\u0440\\u0434\\u0430?","uzbek_lt":"Qayerda?"}', 'input', 'type|text\nrequired|required', 17, '{"uzbek_cyr":[],"uzbek_lt":[]}', 'equal', 1),
(11, '{"uzbek_cyr":"\\u041a\\u0438\\u043c\\u0433\\u0430 \\u0442\\u0435\\u0433\\u0438\\u0448\\u043b\\u0438?","uzbek_lt":"Kimga tegishli?"}', 'input', 'type|text', 17, '{"uzbek_cyr":[],"uzbek_lt":[]}', 'equal', 2),
(12, '{"uzbek_cyr":"\\u041d\\u043e\\u043c\\u0438","uzbek_lt":"Nomi"}', 'input', 'type|text\nminlength|1\nmaxlength|20\nrequired|required', 2, '{"uzbek_cyr":[],"uzbek_lt":[]}', 'equal', 1),
(16, '{"uzbek_cyr":"\\u041d\\u043e\\u043c\\u0438","uzbek_lt":"Nomi"}', 'input', 'type|text\nminlength|1\nmaxlength|20\nrequired|required', 18, '{"uzbek_cyr":[],"uzbek_lt":[]}', 'equal', 1),
(15, '{"uzbek_cyr":"\\u041c\\u043e\\u0434\\u0435\\u043b","uzbek_lt":"Model"}', 'input', 'type|text\nminlength|1\nmaxlength|20\nrequired|required\nmin|1\nmax|20', 18, '{"uzbek_cyr":[],"uzbek_lt":[]}', 'equal', 2),
(9, '{"uzbek_cyr":"\\u041a\\u043e\\u043c\\u0443\\u043d\\u0430\\u043b \\u0445\\u0438\\u0437\\u043c\\u0430\\u0442\\u043b\\u0430\\u0440\\u0438","uzbek_lt":"Komunal xizmatlar"}', 'input', 'type|text', 1, '{"uzbek_cyr":[],"uzbek_lt":[]}', 'equal', 3),
(17, '{"uzbek_cyr":"\\u0420\\u0430\\u043d\\u0433\\u0438","uzbek_lt":"Rangi"}', 'input', 'minlength|1\nmaxlength|20', 18, '{"uzbek_cyr":[],"uzbek_lt":[]}', 'equal', 3),
(5, '{"uzbek_cyr":"\\u0425\\u043e\\u043d\\u0430\\u043b\\u0430\\u0440\\u0438 \\u0441\\u043e\\u043d\\u0438","uzbek_lt":"Xonalari soni"}', 'input', 'type|number', 1, '{"uzbek_cyr":[],"uzbek_lt":[]}', 'equal', 2),
(8, '{"uzbek_cyr":"\\u041c\\u0430\\u0439\\u0434\\u043e\\u043d\\u0438 (\\u0421\\u043e\\u0442\\u0438\\u04b3) ","uzbek_lt":"Maydoni (Sotih) "}', 'input', 'type|number\nvalue| \nminlength|1\nmaxlength|100\nrequired|required\nmin|1\nmax|999', 1, '{"uzbek_cyr":[],"uzbek_lt":[]}', 'equal', 1),
(18, '{"uzbek_cyr":"\\u0425\\u043e\\u0442\\u0438\\u0440\\u0430","uzbek_lt":"Xotira"}', 'input', 'type|text\nminlength|1\nmaxlength|5', 18, '{"uzbek_cyr":[],"uzbek_lt":[]}', 'equal', 4),
(19, '{"uzbek_cyr":"\\u0425\\u0443\\u0436\\u0436\\u0430\\u0442\\u043b\\u0430\\u0440\\u0438","uzbek_lt":"Xujjatlari"}', 'select', '', 18, '{"uzbek_cyr":[{"label":"\\u0411\\u043e\\u0440","value":"1\\r"},{"label":"\\u0419\\u045e\\u049b","value":"0"}],"uzbek_lt":[{"label":"Bor","value":"1\\r"},{"label":"Yo\\u2018q","value":"0"}]}', 'equal', 4),
(21, '{"uzbek_cyr":"\\u041c\\u043e\\u0434\\u0435\\u043b\\/ \\u041f\\u043e\\u0437\\u0438\\u0442\\u0446\\u0438\\u044f","uzbek_lt":"Model\\/Pozitsiya"}', 'input', 'type|text', 2, '{"uzbek_cyr":[],"uzbek_lt":[]}', 'equal', 2),
(30, '{"uzbek_cyr":"\\u0425\\u043e\\u043d\\u0430\\u043b\\u0430\\u0440\\u0438 \\u0441\\u043e\\u043d\\u0438","uzbek_lt":"Xonalari soni"}', 'input', 'type|number\nminlength|0\nmaxlength|10', 19, '{"uzbek_cyr":[],"uzbek_lt":[]}', 'min', 2),
(23, '{"uzbek_cyr":"\\u041c\\u0430\\u0441\\u043e\\u0444\\u0430 (\\u041f\\u0440\\u043e\\u0431\\u0435\\u0433) ","uzbek_lt":"Masofa (Probeg) "}', 'input', 'type|number', 2, '{"uzbek_cyr":[],"uzbek_lt":[]}', 'equal', 4),
(27, '{"uzbek_cyr":"\\u0420\\u0430\\u043d\\u0433\\u0438","uzbek_lt":"Rangi"}', 'input', 'type|text', 2, '{"uzbek_cyr":[],"uzbek_lt":[]}', 'equal', 5),
(28, '{"uzbek_cyr":"\\u0419\\u043e\\u049b\\u0438\\u043b\\u0493\\u0438","uzbek_lt":"Yoqilg\\u2018i"}', 'input', 'type|text', 2, '{"uzbek_cyr":[],"uzbek_lt":[]}', 'equal', 7),
(29, '{"uzbek_cyr":"\\u0416\\u043e\\u0439\\u043b\\u0430\\u0448\\u0443\\u0432\\u0438 (\\u042d\\u0442\\u0430\\u0436) ","uzbek_lt":"Joylashuvi (Etaj)  "}', 'input', 'type|number', 19, '{"uzbek_cyr":[],"uzbek_lt":[]}', 'min', 1),
(25, '{"uzbek_cyr":"\\u041a\\u0440\\u0430\\u0441\\u043a\\u0430","uzbek_lt":"Kraska"}', 'input', 'type|text', 2, '{"uzbek_cyr":[],"uzbek_lt":[]}', 'equal', 6),
(26, '{"uzbek_cyr":"\\u0418\\u0448\\u043b\\u0430\\u0431 \\u0447\\u0438\\u049b\\u0430\\u0440\\u0438\\u043b\\u0433\\u0430\\u043d \\u0439\\u0438\\u043b\\u0438","uzbek_lt":"Ishlab chiqarilgan yili"}', 'input', 'type|number\nminlength|1\nmaxlength|10', 2, '{"uzbek_cyr":[],"uzbek_lt":[]}', 'min', 3),
(31, '{"uzbek_cyr":"\\u041a\\u043e\\u043c\\u0443\\u043d\\u0430\\u043b \\u0445\\u0438\\u0437\\u043c\\u0430\\u0442\\u043b\\u0430\\u0440","uzbek_lt":"Komunal xizmatlar"}', 'input', 'type|text', 19, '{"uzbek_cyr":[],"uzbek_lt":[]}', 'equal', 3),
(32, '{"uzbek_cyr":"\\u0416\\u043e\\u0439\\u043b\\u0430\\u0448\\u0443\\u0432\\u0438","uzbek_lt":"Joylashuvi"}', 'input', 'type|text', 8, '{"uzbek_cyr":[],"uzbek_lt":[]}', 'min', 1),
(33, '{"uzbek_cyr":"\\u041a\\u0435\\u043d\\u0433\\u043b\\u0438\\u0433\\u0438","uzbek_lt":"Kengligi"}', 'input', 'type|number', 19, '{"uzbek_cyr":[],"uzbek_lt":[]}', 'min', 2),
(34, '{"uzbek_cyr":"\\u041a\\u0435\\u043d\\u0433\\u043b\\u0438\\u0433\\u0438","uzbek_lt":"Kengligi"}', 'input', 'type|text', 8, '{"uzbek_cyr":[],"uzbek_lt":[]}', 'equal', 2),
(35, '{"uzbek_cyr":"\\u041c\\u0430\\u0439\\u0434\\u043e\\u043d\\u0438 (\\u0421\\u043e\\u0442\\u0438\\u04b3)","uzbek_lt":"Maydoni (Sotih)"}', 'input', 'type|number\nrequired|required', 16, '{"uzbek_cyr":[],"uzbek_lt":[]}', 'max', 1),
(36, '{"uzbek_cyr":"\\u0421\\u0443\\u0432","uzbek_lt":"Suv"}', 'input', 'type|text', 16, '{"uzbek_cyr":[],"uzbek_lt":[]}', 'equal', 2),
(38, '{"uzbek_cyr":"\\u041c\\u043e\\u0434\\u0435\\u043b","uzbek_lt":"Model"}', 'input', 'type|text', 4, '{"uzbek_cyr":[],"uzbek_lt":[]}', 'equal', 1),
(39, '{"uzbek_cyr":"\\u04b2\\u043e\\u043b\\u0430\\u0442\\u0438","uzbek_lt":"Holati"}', 'select', '', 4, '{"uzbek_cyr":[{"label":"\\u042f\\u043d\\u0433\\u0438","value":"\\u042f\\u043d\\u0433\\u0438\\r"},{"label":"\\u0418\\u0448\\u043b\\u0430\\u0442\\u0438\\u043b\\u0433\\u0430\\u043d","value":"\\u0418\\u0448\\u043b\\u0430\\u0442\\u0438\\u043b\\u0433\\u0430\\u043d"}],"uzbek_lt":[{"label":"Yangi","value":"Yangi\\r"},{"label":"Ishlatilgan","value":"Ishlatilgan"}]}', 'equal', 2),
(40, '{"uzbek_cyr":"\\u041a\\u043e\\u0440\\u0445\\u043e\\u043d\\u0430 \\u043d\\u043e\\u043c\\u0438","uzbek_lt":"Korxona nomi"}', 'input', 'type|text\nrequired|required', 10, '{"uzbek_cyr":[],"uzbek_lt":[]}', 'equal', 1),
(42, '{"uzbek_cyr":"\\u041d\\u0430\\u0432\\u0430\\u0440\\u043e\\u0442\\u043b\\u0430\\u0440","uzbek_lt":"Navarotlar"}', 'input', 'type|text', 2, '{"uzbek_cyr":[],"uzbek_lt":[]}', 'equal', 8),
(43, '{"uzbek_cyr":"\\u0418\\u0448 \\u0431\\u0435\\u0440\\u0443\\u0432\\u0447\\u0438","uzbek_lt":"Ish beruvchi"}', 'input', 'type|text\nrequired|required', 3, '{"uzbek_cyr":[],"uzbek_lt":[]}', 'min', 1),
(44, '{"uzbek_cyr":"\\u041b\\u0430\\u0432\\u043e\\u0437\\u0438\\u043c","uzbek_lt":"Lavozim"}', 'input', 'type|text', 3, '{"uzbek_cyr":[],"uzbek_lt":[]}', 'min', 2),
(45, '{"uzbek_cyr":"\\u0422\\u0430\\u043b\\u0430\\u0431 \\u044d\\u0442\\u0438\\u043b\\u0430\\u0434\\u0438","uzbek_lt":"Talab etiladi"}', 'input', 'type|text', 3, '{"uzbek_cyr":[],"uzbek_lt":[]}', 'equal', 3),
(46, '{"uzbek_cyr":"\\u041c\\u0430\\u044a\\u043b\\u0443\\u043c\\u043e\\u0442\\u0438","uzbek_lt":"Ma''lumoti"}', 'select', '', 3, '{"uzbek_cyr":[{"label":"\\u041e\\u043b\\u0438\\u0439","value":" \\u041e\\u043b\\u0438\\u0439 \\u043c\\u0430\\u044a\\u043b\\u0443\\u043c\\u043e\\u0442\\u043b\\u0438\\r"},{"label":"\\u040e\\u0440\\u0442\\u0430 \\u043c\\u0430\\u0445\\u0441\\u0443\\u0441","value":"\\u040e\\u0440\\u0442\\u0430 \\u043c\\u0430\\u0445\\u0441\\u0443\\u0441\\r"},{"label":"\\u0410\\u04b3\\u0430\\u043c\\u0438\\u044f\\u0442\\u0441\\u0438\\u0437","value":"\\u0410\\u04b3\\u0430\\u043c\\u0438\\u044f\\u0442\\u0441\\u0438\\u0437"}],"uzbek_lt":[{"label":"Oliy","value":"Oliy ma''lumotli\\r"},{"label":"O''rta Maxsus","value":"O''rta Maxsus\\r"},{"label":"Ahamiyatsiz","value":"Ahamiyatsiz"}]}', 'min', 4),
(47, '{"uzbek_cyr":"\\u0418\\u0448 \\u0432\\u0430\\u0445\\u0442\\u0438","uzbek_lt":"Ish vaxti"}', 'input', 'type|number', 3, '{"uzbek_cyr":[],"uzbek_lt":[]}', 'max', 4),
(48, '{"uzbek_cyr":"\\u041d\\u043e\\u043c\\u0438","uzbek_lt":"Nomi"}', 'input', 'type|text\nrequired|required', 20, '{"uzbek_cyr":[],"uzbek_lt":[]}', 'min', 1),
(49, '{"uzbek_cyr":"\\u0420\\u0430\\u043d\\u0433\\u0438","uzbek_lt":"Rangi"}', 'input', 'type|text', 20, '{"uzbek_cyr":[],"uzbek_lt":[]}', 'max', 2),
(50, '{"uzbek_cyr":"\\u0422\\u0430\\u0440\\u043a\\u0438\\u0431\\u0438","uzbek_lt":"Tarkibi"}', 'input', 'type|text', 9, '{"uzbek_cyr":[],"uzbek_lt":[]}', 'equal', 3),
(51, '{"uzbek_cyr":"\\u0418\\u0448\\u043b\\u0430\\u0431 \\u0447\\u0438\\u049b\\u0430\\u0440\\u0443\\u0432\\u0447\\u0438 ","uzbek_lt":"Ishlab chiqaruvchi"}', 'input', 'type|text', 9, '{"uzbek_cyr":[],"uzbek_lt":[]}', 'min', 4),
(52, '{"uzbek_cyr":"\\u049a\\u045e\\u0448\\u0438\\u043c\\u0447\\u0430 ","uzbek_lt":"Qo\\u2018shimcha "}', 'input', 'type|text', 9, '{"uzbek_cyr":[],"uzbek_lt":[]}', 'equal', 0),
(53, '{"uzbek_cyr":"Qo\\u2018shimcha ","uzbek_lt":"\\u049a\\u045e\\u0448\\u0438\\u043c\\u0447\\u0430 "}', 'input', 'minlength|1\nmaxlength|100', 20, '{"uzbek_cyr":[],"uzbek_lt":[]}', 'min', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `news_id` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `language` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `tags` text NOT NULL,
  `date` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `comment` varchar(3) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keyword` text NOT NULL,
  `meta_description` text NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`news_id`, `slug`, `title`, `language`, `content`, `tags`, `date`, `photo`, `category_id`, `comment`, `meta_title`, `meta_keyword`, `meta_description`) VALUES
(1, 'oltin-va-kumush-tangalar-narxi-qimmatladi', 'Oltin va kumush tangalar narxi qimmatladi', 'uzbek_lt', '<p>Markaziy bank esdalik tangalarning 2019 yil 16 oktyabrdan amalda bo‘ladigan narxlarini<a href="https://t.me/centralbankuzb/697" target="_blank" rel="noopener"> belgiladi.</a></p><p>Unga ko‘ra:</p><p>-1 ta oltin tanga narxi – 14 500 000 so‘m;</p><p>-1 ta kumush tanga narxi – 334 000 so‘mni tashkil etdi.</p><p>Esdalik tangalarning har birini og‘irligi 31,1 grammdan iborat. Metallar probasi 999,9 ga teng.</p><p><img src="https://static.xabaruz.com/uploads/14/720__H0gTXfLPnKxT5PQeGTqrVVkcQyZz6yOu.jpg" alt="" data-verified="redactor"></p>', 'Markaziy bank, Oltin tanga, Kumush tanga', '1571306346', '{base_url}uploads/news/720__H0gTXfLPnKxT5PQeGTqrVVkcQyZz6yOu.jpg', 2, '1', 'Oltin va kumush tangalar narxi qimmatladi', 'Markaziy bank, Oltin tanga, Kumush tanga', 'Markaziy bank esdalik tangalarning 2019 yil 16 oktyabrdan amalda bo‘ladigan narxlarini belgiladi.'),
(8, 'kosonsoymarket-uz-loyihasi-faoliyatini-boshlaydi', 'Kosonsoymarket.uz loyihasi faoliyatini boshlaydi.', 'uzbek_lt', '<div class="ql-editor"><p>Bugungi kunda internet insonlarni eng yaqin yordamchisiga aylangan desak mubolag''a bo''lmaydi. Sababi biz internet orqali yangiliklarni bilamiz, yaqinlarimiz bilan gaplashamiz, o''qiymiz, o''rganamiz, sotamiz va sotib olamiz. Ha biz aynan sizlar uchun maxsulotingizni sotish yoki siz uchun kerakli maxsulot sotib olish imkonini  beramiz.  Bizda hammasi tez va oson. Sababi saytimiz Kosonsoydagi eng yirik ijtimoiy tarmoq kanali Kosonsoyliklar kanali tasarrufida faoliat olib boradi.</p><p><br></p><p>Bizni qulayliklarimiz nimada?</p><p>So''ngi kunlarda Telegramda oldi-sotdiga asoslangan judaham ko''plab kanallar tashkil etildi. Ularda kuniga o''rtacha 50, 60 talab aralash e''lonlar chiqadi. Natijada uy qidirayotgan, yoki avtomobil olmoqchi bo''lgan xaridorda o''zi uchun kerakli mahsulot topish imkoniyati qiyinlashadi. Bizda esa hammasi boshqacha. Ko''chmas mulk, avtomobil, tayyor biznes kabi allohida ruknlarimiz orqali faqatgina o''zingizga kerakli mahsulotni ajratib olishingiz mumkun. Eng asosiysi bizda asosan Kosonsoydagi uy-joy va boshqa tovarlar e''lonini ko''rib borishingiz mumkun.  Bu esa o''z-o''zidan xaridor va sotuvchiga qulaylik yaratadi.</p><p><br></p><p>E''lonlar samaradorligi qanday?</p><p>Saytda o''zining maxsus android telefonlar uchun APK dasturi hamda telegramda @Kosonsoymarketuz kanallari mavjud bo''lib bu xaridorlar uchun yanada qulaylik taqdim etadi. Agarda sizda zudlik bilan maxsulotingizni sotish istagi tug''ilsa 23.000 dan ortiq obunachiga ega @Kosonsoyliklar_Uz kanalidaham e''loningizni joylash imkoniyati paydo bo''ladi.</p><p><br></p><p>Kosonsoymarket.uz sayti hozirda Test rejimida ishlamoqda. Yaqin kunlarda to''la to''lis faoliyatini boshlaydi, yangiliklarimiz hali oldinda! </p><p><br></p><p><br></p><p>Sayt haqidagi fikr va taasurotlaringizni t.me/kosonsoychat guruhida yozib qoldiring</p></div>', 'uchun, kerakli, imkoniyati, kanali, orqali', '1573907709', '{base_url}uploads/news/73115a6aa4af22329c2f47bb9c92e786.jpg', 1, '1', 'Kosonsoymarket.uz loyihasi faoliyatini boshlaydi.', 'uchun, kerakli, imkoniyati, kanali, orqali, bilan, Kosonsoydagi, sotib, avtomobil, Sababi, kunlarda, mumkun, internet, hammasi, qulaylik, maxsulotingizni, sotish, Bizda, maxsus, dasturi', 'Bugungi kunda internet insonlarni eng yaqin yordamchisiga aylangan desak mubolag''a bo''lmaydi. Sababi biz internet orqali yangiliklarni bilamiz, yaqinlarimiz bilan gaplashamiz,'),
(9, 'kosonsoymarket-uz-sayti-faoliyatini-boshlash-arafasida', 'Kosonsoymarket.uz сайти фаолиятини бошлаш арафасида', 'uzbek_cyr', '<div class="ql-editor"><p>Бугунги кунда интернет инсонларни энг яқин ёрдамчисига айланган десак муболаға бўлмайди. Сабаби биз интернет орқали янгиликларни биламиз, яқинларимиз билан гаплашамиз, ўқиймиз, ўрганамиз, сотамиз ва сотиб оламиз. Ҳа биз айнан сизлар учун маҳсулотингизни сотиш ёки сиз учун керакли маҳсулот сотиб олиш имконини берамиз. Бизда ҳаммаси тез ва осон. Сабаби сайтимиз Косонсойдаги энг йирик ижтимоий тармоқ канали Косонсойликлар канали тасарруфида фаолият олиб боради.</p><p>Бизни қулайликларимиз нимада?</p><p>Сўнги кунларда&nbsp;Телеграмда&nbsp;олди-сотдига асосланган жуда ҳам кўплаб каналлар ташкил этилди. Уларда кунига ўртача 50, 60 талаб аралаш эълонлар чиқади. Натижада уй қидираётган, ёки автомобиль олмоқчи бўлган харидорда ўзи учун керакли маҳсулот топиш имконияти қийинлашади. Бизда эса ҳаммаси бошқача. Кўчмас мулк, автомобиль, тайёр бизнес каби аллоҳида рукнларимиз орқали фақатгина ўзингизга керакли маҳсулотни ажратиб олишингиз мумкин. Энг асосийси бизда асосан Косонсойдаги уй-жой ва бошқа товарлар эълонини кўриб боришингиз мумкин. Бу эса ўз-ўзидан харидор ва сотувчига қулайлик яратади.</p><p>Эълонлар самарадорлиги қандай?</p><p>Сайтда ўзининг махсус андроид телефонлар учун АПК дастури ҳамда&nbsp;телеграмда&nbsp;@Косонсоймаркетуз&nbsp;каналлари мавжуд бўлиб бу харидорлар учун яна да қулайлик тақдим этади. Агарда сизда зудлик билан маҳсулотингизни сотиш истаги туғилса 23.000&nbsp;дан&nbsp;ортиқ обуначига эга @Косонсойликлар_Уз&nbsp;каналидаҳам&nbsp;эълонингизни жойлаш имконияти пайдо бўлади.</p><p>Косонсоймаркет.уз сайти ҳозирда Тест режимида ишламоқда. Яқин кунларда тўла&nbsp;тўлис&nbsp;фаолиятини бошлайди, янгиликларимиз ҳали олдинда!</p><p>Сайт ҳақидаги фикр ва&nbsp;тасуротларингизни&nbsp;т.ме/косонсойчат&nbsp;гуруҳида ёзиб қолдиринг</p><p><br></p></div>', 'керакли, қулайлик, сотиб, канали, имконияти', '1573907859', '{base_url}uploads/news/30229f80dbc5693f348b64f2a6340dae.jpg', 3, '1', 'Kosonsoymarket.uz сайти фаолиятини бошлаш арафасида', 'керакли, қулайлик, сотиб, канали, имконияти, автомобиль, сотиш, Бизда, Косонсойдаги, маҳсулот, ҳаммаси, маҳсулотингизни, билан, мумкин, Сабаби, орқали, интернет, кунларда, каналлари, мавжуд', 'Бугунги кунда интернет инсонларни энг яқин ёрдамчисига айланган десак муболаға бўлмайди. Сабаби'),
(6, 'bank-moliya-akademiyasi-o-zmilliybank-tasarrufiga-o-tkazildi', 'Банк-молия академияси Ўзмиллийбанк тасарруфига ўтказилди', 'uzbek_cyr', '<p class="ql-align-justify">«Банк-молия соҳасида кадрлар тайёрлаш тизимини такомиллаштириш чора-тадбирлари тўғрисида» Президент қарори (ПҚ-4503-сон, 31.10.2019 й.) қабул қилинди. Бу ҳақда&nbsp;«Ҳуқуқий ахборот» канали хабар берди.&nbsp;</p><p class="ql-align-justify"><br></p><p class="ql-align-justify">Қарорга мувофиқ, Банк-молия академияси Ўзмиллийбанк тасарруфига ўтказилиб, у Академиянинг таъсисчиси этиб белгиланди.</p><p class="ql-align-justify"><br></p><p class="ql-align-justify">2018 ва 2019 йилларда Академия магистратурасига қабул қилинган шахслар учун магистратура мутахассисликлари бўйича амалдаги таълим дастурларини, шунингдек, Академиянинг сарф-харажатларини магистратурада давлат гранти асосида таълим олаётган шахсларнинг ўқиши тугагунга қадар Давлат бюджети маблағлари ҳисобидан молиялаштириш тартиби сақлаб қолинади.</p><p class="ql-align-justify"><br></p><p class="ql-align-justify">Шунингдек, қарорга кўра 2020 йилнинг 1 февралига қадар&nbsp;2020-2025 йилларда Академияни ривожлантириш концепцияси ишлаб чиқилади.</p><p class="ql-align-justify"><br></p><p class="ql-align-justify">Маълумот учун, Банк-молия академияси Президентнинг 1996 йил 2 майдаги ПФ-1460-сон Фармонига асосан ташкил этилган бўлиб, банк, молия, солиқ тизимлари ва иқтисодиётнинг реал сектори тармоқларининг бошқарув кадрларини тайёрлаш, қайта тайёрлаш ва уларнинг малакасини ошириш, олий малакали илмий ва илмий-педагог кадрлар тайёрлаш бўйича, шунингдек кўрсатиб ўтилган соҳаларда илмий-тадқиқот фаолиятини амалга оширувчи давлат олий таълим муассасаси ҳисобланади.</p><p><br></p>', 'тайёрлаш, молия, таълим, илмий, шунингдек', '1572659361', '{base_url}uploads/news/bf31cd771d3f3f960d45adc26f6df7a2.jpg', 4, '1', 'Банк-молия академияси Ўзмиллийбанк тасарруфига ўтказилди', 'тайёрлаш, молия, таълим, илмий, шунингдек, академияси, кадрлар, давлат, Академиянинг, қабул, йилларда, бўйича, қадар, ташкил, асосан, майдаги, Президентнинг, сақлаб, Фармонига, чиқилади', '«Банк-молия соҳасида кадрлар тайёрлаш тизимини такомиллаштириш чора-тадбирлари тўғрисида»');

-- --------------------------------------------------------

--
-- Структура таблицы `news_category`
--

CREATE TABLE IF NOT EXISTS `news_category` (
  `category_id` int(11) NOT NULL,
  `language` varchar(255) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keyword` text NOT NULL,
  `meta_description` text NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `news_category`
--

INSERT INTO `news_category` (`category_id`, `language`, `category_name`, `meta_title`, `meta_keyword`, `meta_description`) VALUES
(1, 'uzbek_lt', 'Ma''lumotlar', 'Ma''lumotlar', 'Ma''lumotlar', 'Ma''lumotlar'),
(2, 'uzbek_lt', 'Mahalliy', 'Mahalliy', 'Mahalliy', 'Mahalliy'),
(3, 'uzbek_cyr', 'Маълумотлар', 'Маълумотлар', 'Маълумотлар', 'Маълумотлар'),
(4, 'uzbek_cyr', 'Маҳаллий', 'Маҳаллий', 'Маҳаллий', 'Маҳаллий');

-- --------------------------------------------------------

--
-- Структура таблицы `news_comments`
--

CREATE TABLE IF NOT EXISTS `news_comments` (
  `comment_id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `time` bigint(22) NOT NULL,
  `onwer` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `news_replies`
--

CREATE TABLE IF NOT EXISTS `news_replies` (
  `replie_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `time` bigint(22) NOT NULL,
  `onwer` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `partners`
--

CREATE TABLE IF NOT EXISTS `partners` (
  `partner_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `partners`
--

INSERT INTO `partners` (`partner_id`, `name`, `url`, `image`) VALUES
(1, 'DEVCON P/E', 'http://devcon.uz', '/uploads/parners/devcon.jpg'),
(2, 'Payme', 'http://payme.uz', '/uploads/parners/payme.jpg'),
(5, 'O''zbekiston yoshlar ittifoqi', 'http://yi.uz', '/uploads/parners/yi.jpg'),
(7, 'Paynet', 'http://paynet.uz', '/uploads/parners/paynet.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `category_id` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(17,2) unsigned DEFAULT NULL,
  `price_options` text NOT NULL,
  `contact_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` varchar(255) DEFAULT 'default',
  `position_period` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pricing_id` int(10) unsigned DEFAULT NULL,
  `filter` text NOT NULL,
  `template` varchar(255) NOT NULL,
  `visits` bigint(22) unsigned DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=119 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `category_id`, `title`, `content`, `price`, `price_options`, `contact_name`, `email`, `phone`, `address`, `position`, `position_period`, `pricing_id`, `filter`, `template`, `visits`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(36, 1, 16, 'Bo‘sh yer sotiladi', '<p>Xujjatlari 100%, Selxona bo‘yidagi yangi qurilayotgan kotejlar oldida.</p>', 9000.00, '{"currency":"usd","covenant":"1"}', 'UNNAMED', '@KOSONSOYMARKETUZ', '+998906409364', 'Kosonsoy,  O‘rikzor MFY,  Selxona bo‘yidagi kotejlar oldida', 'main', '2019-11-30 13:04:04', 2, '{"filter_35":"8","filter_36":"Bor (Oqava) "}', 'default', 200, '2019-11-13 13:07:20', '2019-11-13 13:07:20', '2019-11-13 13:07:20', 2),
(37, 1, 1, 'Kamunada hovli sotiladi', '<p>Aholi yashash joyida, Mevali daraxtlari bor, Tayyor holatdagi molxona va bostirmasi  mavjud.</p>', 18000.00, '{"currency":"usd","covenant":"1"}', 'Boburjon', '@KosonsoymarketUz', '+998943066982', 'Kosonsoy t, Namuna QFY, Apteka roparasida', 'main', '2019-11-30 04:56:27', 2, '{"filter_8":" 7","filter_5":"0","filter_9":"Elektrga ulasa bo''ladi, oqava suv bor."}', 'default', 183, '2019-11-14 05:01:19', '2019-11-14 05:01:19', '2019-11-14 05:01:19', 2),
(38, 1, 1, 'Hovli sotiladi', '<p>Xujjatlari 100%, Dam olish maskanlari orasida.</p>', 7500.00, '{"currency":"usd","covenant":"1"}', 'Jamoliddin', '@Kosonsoymarketuz', '+998934980294', 'Kosonsoy t, Nodirabegim sihatgohi yaqinida', 'main', '2019-11-30 09:58:20', 2, '{"filter_8":" 3.5","filter_5":"2","filter_9":"Elektro energiya, suv oqava"}', 'default', 224, '2019-11-14 10:01:18', '2019-11-14 10:01:18', '2019-11-14 10:01:18', 2),
(39, 1, 1, 'Jar MFYda Uchaska sotiladi', '', 14000.00, '{"currency":"usd","covenant":"1"}', 'UNNAMED', '@kosonsoymarketuz', '+998995146533', 'Kosonsoy tumani, JAR MFY', 'main', '2019-11-30 11:20:01', 2, '{"filter_8":" 4","filter_5":"4 ta","filter_9":"Elektr bor, gaz ulasa bo`ladi."}', 'default', 207, '2019-11-14 11:25:53', '2019-11-14 11:25:53', '2019-11-14 11:25:53', 2),
(40, 1, 1, 'Jar MFYda yo‘l bo‘yida uchaska sotiladi', '<p>Xujjatlari 100% </p>', 15000.00, '{"currency":"usd","covenant":"1"}', 'Ibrohim', '@kosonsoymarketuz', '+998993169898', 'Kosonsoy,  Jar MFY,  Eski shifoxona yaqinida', 'main', '2019-11-15 09:46:01', 2, '{"filter_8":" 5","filter_5":"0","filter_9":"Gaz ulasa bo\\u2018ladi"}', 'default', 16, '2019-11-15 09:48:46', '2019-11-15 09:48:46', '2019-11-15 09:48:46', 2),
(41, 1, 2, 'Mersedes Sprinter sotiladi', '<p>3.5 tonna yuk oladi</p><p>Gorni tormiz</p><p><br></p><p>Chevrolet avtomobillariga barter bor.</p><p>8000$ bersa qolganini variantga kelishamiz.</p>', 14000.00, '{"currency":"usd","covenant":"0"}', 'Qobilsher', '@Kosonsoymarketuz', '+998942997575', 'Kosonsoy', 'main', '2019-11-30 14:48:58', 2, '{"filter_12":"Mersedes Benz","filter_21":"Sprinter","filter_26":"2011","filter_23":"300000","filter_27":"Oq","filter_25":"Toza","filter_28":"Dizel"}', 'default', 181, '2019-11-15 14:54:10', '2019-11-15 14:54:10', '2019-11-15 14:54:10', 2),
(47, 1, 1, 'JARda 6 sotihli hovli sotiladi', '<p>Zastava hududida</p>', 10000.00, '{"currency":"usd","covenant":"0"}', 'Sohibjon', '', '+998943054499', 'Kosonsoy, JAR MFY, Zastava', 'main', '2019-11-30 08:00:48', 3, '{"filter_8":" 6","filter_5":"2","filter_9":"Elektr energiya bor"}', 'default', 307, '2019-11-16 08:03:26', '2019-11-16 08:03:26', '2019-11-16 08:03:26', 2),
(112, 1, 19, '5A Mikrorayonda kvartira sotiladi', '', 16500.00, '{"currency":"usd","covenant":"1"}', 'UNNAMED', '', '+998936730990', 'Namangan, 5A Mikrorayon,  9-uy, 17-xonadon', 'featured', '2019-12-27 11:19:00', 3, '{"filter_29":"1-qavatda","filter_30":"3","filter_31":"Gaz, Svet, Suv"}', 'default', 30, '2019-11-27 11:22:40', '2019-11-27 11:22:40', '2019-11-27 11:22:40', 2),
(104, 1, 1, 'Molbozor tepasida hovli sotiladi', '<p>Qo''shimcha: Yerto''la, zal uchun fundament tashlangan. Hosilga kirgan mevali daraxtlari bor.</p>', 20000.00, '{"currency":"usd","covenant":"1"}', 'Muminxon', '', '+998939389798', 'Kosonsoy, Guliston MFY, Molbozor tepasida', 'main', '2019-11-30 09:58:23', 3, '{"filter_8":" 8","filter_5":"2","filter_9":"Suv, elektr bor"}', 'default', 40, '2019-11-24 10:01:15', '2019-11-24 10:01:15', '2019-11-24 10:01:15', 2),
(93, 1, 2, 'Velosiped sotiladi ', 'Holati yaxwi rasxoti yoq', 90.00, '{"currency":"usd","covenant":"0"}', 'Oqilxon Usmonov', 'oqilxon02@gmail.com', '+998998433838', 'Kosonsoy tuman', 'default', '2019-11-30 13:25:09', 0, '{"filter_12":"Velosiped","filter_21":"Ural","filter_27":"Qora"}', 'default', 30, '2019-11-19 13:25:09', '2019-11-19 14:48:39', '2019-11-19 13:25:09', 2),
(103, 1, 8, 'Shifoxona oldida bino sotiladi', '<p>Xujjatlari 100%</p>', 40000.00, '{"currency":"usd","covenant":"1"}', 'Unnamed', '', '+998994302323', 'Kosonsoy sh,  Markaziy Shifoxona darvozasi oldida', 'main', '2019-12-31 05:19:29', 3, '{"filter_32":"1-qavatda","filter_34":"56 kvadrat"}', 'default', 46, '2019-11-24 05:24:26', '2019-11-24 05:24:26', '2019-11-24 05:24:26', 2),
(35, 1, 2, 'Lada 2106 sotiladi', '<p>Moshina yangi kapitalkadan chiqarilgan, balonlari yaxshi, chexol, polik, pult qilingan, mator 03. </p>', 30000000.00, '{"currency":"sum","covenant":"1"}', 'Zokirjon', '@KosonsoymarketUz', '+998945035333', 'Kosonsoy sh, Xumxona', 'main', '2019-12-30 11:59:16', 2, '{"filter_12":"Lada Jiguli","filter_21":"VAZ2106","filter_26":"1991","filter_27":"Pudroviy","filter_28":"Gaz Temir 70"}', 'default', 262, '2019-11-12 12:07:42', '2019-11-12 12:15:53', '2019-11-12 12:07:42', 2),
(28, 1, 18, 'On7 Telefoni sotiladi', '<p>Android 8.1, Koreyadan keltirilgan</p>', 650000.00, '{"currency":"sum","covenant":"0"}', 'Ziyodillo', '@Chuqur2001', '+998941553624', 'Kosonsoy', 'main', '2019-12-01 14:41:44', 1, '{"filter_16":"Samsung","filter_15":"Galaxy On7","filter_17":"Gold","filter_18":"16GB","filter_19":"0"}', 'default', 212, '2019-11-11 14:44:16', '2019-11-11 14:44:16', '2019-11-11 14:44:16', 3),
(29, 1, 2, 'Gentra Sotiladi', '<p>Moshina yangi xolatda, xujjatlarida muammo yo‘q.</p>', 12000.00, '{"currency":"usd","covenant":"1"}', 'Qora ko‘z', '@unnamed', '+998934057752', 'Kosonsoy', 'main', '2019-12-01 17:18:18', 2, '{"filter_12":"Ravon Gentra","filter_21":"2 Euro","filter_26":"2017","filter_23":"10 000 km","filter_27":"Oq","filter_25":"Toza","filter_28":"Gaz Temir"}', 'default', 287, '2019-11-11 17:22:59', '2019-11-11 17:22:59', '2019-11-11 17:22:59', 2),
(31, 1, 8, 'Do`kon sotiladi', '<p>Xujjatlarida muammo yo''q.</p>', 0.00, '{"currency":"usd","covenant":"1"}', 'Ilyosxon', '@kosonsoymarketuz', '+998934032202', 'Kosonsoy sh, A.Jomiy MFY, Detski mir oldida', 'main', '2019-11-20 06:37:24', 3, '{"filter_32":"1-Qavatda","filter_34":"100 kv\\/m"}', 'default', 64, '2019-11-12 06:40:50', '2019-11-12 06:40:50', '2019-11-12 06:40:50', 2),
(32, 1, 16, 'Bog` ko`chada uchastka sotiladi', '<p>Aholi yashash  joyida, xujjatlari 100% bor</p>', 15000.00, '{"currency":"usd","covenant":"1"}', 'UNNAMED', '@KosonsoymarketUz', '+998936760074', 'Kosonsoy tumani, Bog` ko`cha MFY,  Juydam yonida', 'main', '2019-11-30 06:46:49', 3, '{"filter_35":"10","filter_36":"Bor"}', 'default', 247, '2019-11-12 06:52:54', '2019-11-12 06:52:54', '2019-11-12 06:52:54', 2),
(33, 1, 16, 'Olmazorda uchastka sotiladi', '<p>Devor olingan, elektr energiya tortsa bo`ladi.</p>', 15000.00, '{"currency":"usd","covenant":"1"}', 'UNNAMED', '@Kosonsoymarket_uz', '+998934021466', 'Kosonsoy, Olmazor MFY,  Kotej oldida', 'main', '2019-11-30 08:35:02', 3, '{"filter_35":"8","filter_36":"Muammosiz"}', 'default', 186, '2019-11-12 08:37:18', '2019-11-12 08:37:18', '2019-11-12 08:37:18', 2),
(34, 1, 18, 'Redmi 7 sotiladi', '<p>Telefon ochilganiga 2 hafta bo`lgan. Zaryadnik, chexol, laminat bor.</p>', 130.00, '{"currency":"usd","covenant":"1"}', 'Jobirxon', '@official_jobirkhan', '+998996904543', 'Kosonsoy sh, A.Jomiy MFY', 'main', '2019-12-12 11:51:12', 0, '{"filter_16":"XIAMOI","filter_15":"REDMI 7","filter_17":"Qora","filter_18":"16","filter_19":"1\\r\\n"}', 'default', 254, '2019-11-12 11:58:49', '2019-11-12 11:58:49', '2019-11-12 11:58:49', 2),
(27, 1, 1, 'Qorasuvda hovli sotiladi', '<p>Rom, Yerto''lasi bor.</p><p>Hujjatlari 100%</p><p>Yashash uchun tayyor holatda! </p><p>Mo''ljal: Maktab oldida</p>', 25000.00, '{"currency":"usd","covenant":"1"}', 'UNNAMED', 'oqilxon97@gmail.com', '+998937763414', 'Kosonsoy tumani, Qorasuv MFY', 'main', '2019-11-15 04:53:02', 2, '{"filter_8":" 8","filter_5":"3","filter_9":"Elektr, Gaz (ulasa bo''ladi)"}', 'default', 65, '2019-11-10 04:58:03', '2019-11-10 04:58:03', '2019-11-10 04:58:03', 2),
(30, 1, 2, 'Lada 2106 sotiladi', '<p>Mator 03, xadavoylari zo‘r,  kuzov yaxshi xolatda. </p>', 25000000.00, '{"currency":"sum","covenant":"1"}', 'Unnamed', '@kosonsoymarket_uz', '+998972530304', 'Kosonsoy', 'featured', '2019-11-15 18:11:17', 3, '{"filter_12":"Lada Jiguli","filter_21":"2106","filter_26":"1988","filter_23":"9999","filter_27":"Jemchug","filter_28":"Gaz 80"}', 'default', 31, '2019-11-11 18:11:17', '2019-11-11 18:24:45', '2019-11-11 18:11:17', 2),
(102, 1, 20, 'Faberlic Lab bo‘yog‘i probnigi', '', 7000.00, '{"currency":"sum","covenant":"0"}', 'Aziza', '', '+998943047610', 'Kosonsoy', 'default', '2019-12-29 19:05:29', 6, '{"filter_48":"\\"3D \\u041f\\u043e\\u0446\\u0435\\u043b\\u0443\\u0439\\"  Skyline","filter_49":"14 xil","filter_53":"5 gram og\\u2018irlikda. "}', 'default', 19, '2019-11-23 19:09:33', '2019-11-23 19:09:33', '2019-11-23 19:09:33', 2),
(101, 1, 20, 'Faberlic Lab qalami', '', 47000.00, '{"currency":"sum","covenant":"0"}', 'Aziza', '', '+998943047610', 'Kosonsoy', 'default', '2019-12-31 18:54:41', 6, '{"filter_48":"Ultramodern","filter_49":"8 xil","filter_53":"Labingizni bo\\u2018yash uchun ideal tanlov.  \\"Halol\\"  sertifikatiga ega. "}', 'default', 10, '2019-11-23 18:58:19', '2019-11-23 18:58:19', '2019-11-23 18:58:19', 2),
(99, 1, 2, 'Jiguli 2106 Sotiladi', '<p>Kamchiliklari yo''q, minish uchun tayyor xolatda!</p>', 3000.00, '{"currency":"usd","covenant":"1"}', 'Ilyosxon', '', '+998942120200', 'Kosonsoy, Xumxona MFY', 'main', '2019-12-12 06:26:59', 3, '{"filter_12":"LADA","filter_21":"VAZ 2106","filter_26":"1989","filter_27":"Oq","filter_25":"100%","filter_28":"Gaz 65 Temir","filter_42":"Magicar pult, Nexia sidena, Koja chexol, yangi polik, Pioner kalonka magnitafon (Bluetooth), 07 Rul, Butilka oyna"}', 'default', 77, '2019-11-23 06:36:34', '2019-11-23 06:37:47', '2019-11-23 06:36:34', 2),
(100, 1, 20, 'Faberlic Lab bo‘yog‘i (Pomada) ', '', 57000.00, '{"currency":"sum","covenant":"0"}', 'Aziza', '', '+998943047610', 'Kosonsoy', 'main', '2019-12-10 18:46:43', 6, '{"filter_48":"\\"Hashamatli bo''sa\\"","filter_49":"11 xil ","filter_53":"Lablaringizga tabassum ba yorqinlik ulasha oladi.  \\"Halol\\"  sertifikatiga ega. "}', 'default', 21, '2019-11-23 18:51:27', '2019-11-23 18:51:27', '2019-11-23 18:51:27', 2),
(78, 1, 19, '6-Mikrayonda kvartira sotiladi', '<p>Holati yaxshi, ta''mirlab o''tirsa bo''ladi. </p><p><br></p>', 22000.00, '{"currency":"usd","covenant":"1"}', 'Naimjon', '', '+998934050987', 'Namangan sh, 6-mik, Koson pitakdan kirganda.', 'main', '2019-11-30 09:12:46', 2, '{"filter_29":"5-Qavatda","filter_30":"4 ","filter_31":"Gaz, Elektr, Suv bor"}', 'default', 180, '2019-11-18 09:16:42', '2019-11-18 09:16:42', '2019-11-18 09:16:42', 2),
(70, 1, 18, 'Samsung Galaxy S10+ sotiladi', '<p> samsung s10 + madein vetnam xolati alo barcha dakumeti bor karobka bor yili2019</p>', 200.00, '{"currency":"usd","covenant":"0"}', 'Turgunov Abdurasul', 'Abdurasuturgunov11@gemail.com', '+79111290820', 'Rossiya', 'default', '2019-11-30 12:10:35', 1, '{"filter_16":"Samsung","filter_15":"Galaxy S10+","filter_17":"Qora","filter_18":"128Gb","filter_19":"null"}', 'default', 45, '2019-11-17 12:10:35', '2019-11-17 17:23:56', '2019-11-17 12:10:35', 2),
(71, 1, 18, 'Redmi NOTE 7 sotiladi', 'Telefon xolati yaxshi', 150.00, '{"currency":"usd","covenant":"0"}', 'Oqilxon Olimxonov', 'olimxonovoqilxon@gmail.com', '+998941707877', 'Kosonso tuman Chorbog'' mfy', 'default', '2019-11-30 13:13:00', 1, '{"filter_16":"Redmi","filter_15":"Note 7","filter_17":"Ko\\u2018k (Blue) ","filter_18":"32Gb","filter_19":"1\\r\\n"}', 'default', 37, '2019-11-17 13:13:00', '2019-11-17 17:25:20', '2019-11-17 13:13:00', 2),
(72, 1, 18, 'Redmi 7 sotiladi', '<p>Telefon yangi zartadchik bor koropkasi yo lekin</p>', 130.00, '{"currency":"usd","covenant":""}', 'Oqilxon Usmonov', 'Oqilxon02@gmail.com', '+998936727139', 'Kosonsoy tuman ', 'default', '2019-11-30 15:41:19', 1, '{"filter_16":"Xiaomi","filter_15":"Redmi 7","filter_18":"32Gb","filter_19":"null"}', 'default', 16, '2019-11-17 15:41:19', '2019-11-17 17:27:55', '2019-11-17 15:41:19', 2),
(74, 1, 1, ' Тайер бизнес сотилади', 'хар хил мевали кучатлар экилган 70 та сигир учун тайер молхона навеси хам бор хужжатлари 100%', 30000.00, '{"currency":"usd","covenant":"1"}', 'Farruxbek', '', '+998998507330', 'Гурмирон телеком рупарасида', 'default', '2019-11-30 17:03:31', 1, '{"filter_8":" 65 sotih","filter_5":"2ta","filter_9":"\\u0441\\u0443\\u0432 \\u044d\\u043b\\u0435\\u043a\\u0442\\u0440 \\u0431\\u043e\\u0440 \\u0433\\u0430\\u0437 \\u0442\\u043e\\u0440\\u0442\\u0441\\u0430 \\u0431\\u0443\\u043b\\u0430\\u0434\\u0438"}', 'default', 23, '2019-11-17 17:03:31', '2019-11-17 17:30:55', '2019-11-17 17:03:31', 2),
(57, 1, 10, 'Xar xil Turdagi Sochiqlar Xarxil Ranglarda ', '<p>Kosonsoy Sochiqlari </p><p>Arzon Narxlarda </p><p>Велюр </p><p>Махровые</p><p>Пакривал 210×180</p><p>Сауна 100×150</p><p>Салфетка 25×25 - 30×30</p><p>Банний 70×140 </p><p>Средний 50×90 </p>', 220000.00, '{"currency":"sum","covenant":"0"}', 'Anvarxon', 'Anvarxon2223@gmail.com', '+998952022223', 'Kosonsoy', 'main', '2019-11-30 13:03:44', 1, '{"filter_40":"Barkas Teks"}', 'default', 193, '2019-11-16 13:03:44', '2019-11-17 08:39:55', '2019-11-16 13:03:44', 2),
(94, 1, 1, 'Buloqda Kotej sotiladi', '<p>Barcha sharoitlarga ega. Katta yo''lga yaqin joyda</p>', 0.00, '{"currency":"","covenant":"1"}', 'UNNAMED', '', '+998934942403', 'Namangan, Buloq MFY.', 'default', '2019-11-20 05:50:36', 1, '{"filter_8":" 6","filter_5":"4","filter_9":"Gaz, Svet, Suv, Kanalizatsiya"}', 'default', 16, '2019-11-20 05:56:17', '2019-11-20 05:56:17', '2019-11-20 05:56:17', 2),
(95, 1, 19, 'Molbozor tepasida hovli sotiladi', '<p>Remontlari yaxshi.</p><p>Qo''shimcha 4 ta xonaga fundament tashalgan.</p><p>Yashash uchun tayyor holatda</p>', 25000.00, '{"currency":"usd","covenant":"1"}', 'UNNAMED', '', '+998939466818', 'Kosonsoy, Guliston-2, Molbozor tepasida', 'main', '2019-11-30 08:23:06', 2, '{"filter_8":" 7","filter_5":"3","filter_9":"Elektr energiya, Suv bor"}', 'default', 187, '2019-11-20 08:34:49', '2019-11-20 11:21:30', '2019-11-20 08:34:49', 2),
(96, 1, 19, 'Kosonsoy. soycha mfy da joylashgan Hovli sotiladi', '<p>2 tarafdan eshigi bor. 30 dan ziyod daraxtlari mavjud. suv bor</p>', 25000.00, '{"currency":"usd","covenant":"1"}', 'Nabijon', 'Nabijon.husanboyev@gmail.com', '+998942727099', 'O''rta kocha ', 'default', '2019-11-25 08:47:48', 1, '{"filter_8":" 6","filter_5":"5","filter_9":"Elektr energiya"}', 'default', 370, '2019-11-20 08:47:48', '2019-11-20 11:21:42', '2019-11-20 08:47:48', 2),
(98, 1, 1, 'Bog‘ishamolda hovli sotiladi', '<p>3 хонани томи ёпилиб шувоқдан чиққан, 4 хона корридори билан пишиқ ғиштдан қурилиб, усти, яъни 2-этажи 3 та 12 метрли кантейнер билан ёпилган. З та хонанининг таги ертўлага мослашган.</p><p>қўшнилар кўчиб борган.</p><p>', 28000.00, '{"currency":"usd","covenant":"0"}', 'Ibodilla', '', '+998972540104', 'Kosonsoy,  Bog‘ishamol,  Issiqxonalar orqasida', 'main', '2019-12-08 12:56:16', 2, '{"filter_8":" 4","filter_5":"7","filter_9":"Gaz,  Elektr,  Suv,  Kanalizatsiya"}', 'default', 504, '2019-11-21 13:00:27', '2019-11-21 13:00:27', '2019-11-21 13:00:27', 2),
(97, 1, 2, 'Jiguli sotiladi', '<p>Moshina yaxshi, yurishi zo''r, akumlyator yangi. Kamchiliklari yo''q. Shumka, Cobalt pult, 07 butilka oyna navarotlari bor. Olasizu minasiz</p>', 2600.00, '{"currency":"usd","covenant":"1"}', 'Alimardon', '', '+998942743837', 'Kosonsoy, Olmazor MFY', 'default', '2019-11-20 11:18:24', 2, '{"filter_12":"Lada","filter_21":"2103","filter_26":"1979","filter_23":"9999999","filter_27":"Oq","filter_25":"Bor","filter_28":"Gaz 65 temir"}', 'default', 384, '2019-11-20 11:18:24', '2019-11-20 11:19:33', '2019-11-20 11:18:24', 2),
(63, 1, 0, 'Telefon', 'Holati yaxshi', 35000.00, '{"currency":"sum","covenant":"1"}', 'Murodjon', '', '+79690864296', 'Kosonsoy', 'default', '2019-11-16 13:16:23', 0, '', 'default', 0, '2019-11-16 13:16:23', '2019-11-16 13:16:23', '2019-11-16 13:16:23', 1),
(64, 1, 18, 'Galaxy A5/16', 'Ofitsialniy Galaxy A5 2016 xolati yaxahi', 750.00, '{"currency":"sum","covenant":"0"}', 'voxidisain', 'voxidisain@gmail.com', '+998939126333', 'Kosonsoy', 'main', '2019-11-30 13:34:08', 3, '{"filter_16":"Samsung","filter_15":"Galaxy A5\\/16","filter_17":"Qora","filter_18":"16","filter_19":"null"}', 'default', 223, '2019-11-16 13:34:08', '2019-11-16 14:26:15', '2019-11-16 13:34:08', 2),
(65, 1, 1, 'Тайёр турар жой зудлик билан сотилади', 'Зудлик билан! ', 14000.00, '{"currency":"sum","covenant":"1"}', 'Ахмадхон', 'axmedabdillaev@mail.ru', '+998943039222', 'КОСОНСОЙ. ЖАР МФЙ', 'default', '2019-11-16 18:58:40', 1, '{"filter_8":" 4","filter_5":"6","filter_9":"Elektr, Suv"}', 'default', 20, '2019-11-16 18:58:40', '2019-11-17 10:11:37', '2019-11-16 18:58:40', 2),
(68, 1, 8, 'Tayyor biznes sotiladi', '<p>&nbsp;Даромад келтириб турган боғ ва ишлаб чиқариш учун мўнжалланган жой сотилади❗️</p><p><br></p><p>', 35000.00, '{"currency":"usd","covenant":"1"}', 'UNNAMED', '@KosonsoymarketUz', '+998917750101', 'Kosonsoy, Tergachi, Koronkul MFY', 'main', '2019-11-30 10:17:18', 3, '{"filter_32":"1-qavat","filter_34":"2.5 Gektar"}', 'default', 193, '2019-11-17 10:19:42', '2019-11-17 10:19:42', '2019-11-17 10:19:42', 2),
(66, 1, 18, 'Sotiladi', '<p>Holati yaxshi</p>', 70.00, '{"currency":"usd","covenant":"1"}', 'Akmaljon', 'Akmaljon', '+998941748551', 'Kosonsoy', 'default', '2019-09-30 04:35:14', 1, '{"filter_16":"Samsung","filter_15":"J3","filter_17":"Qora","filter_18":"16","filter_19":"0"}', 'default', 48, '2019-11-17 04:35:14', '2019-11-17 10:06:29', '2019-11-17 04:35:14', 2),
(67, 1, 4, 'Noutbook sotiladi ', '<p>Noutbook yangi hal umuman Ishlamagan yoqib ko''rilmagan.</p><p><br></p>', 2200000.00, '{"currency":"sum","covenant":"0"}', 'Doctor B', '', '+998994366257', 'Kosonsoy', 'default', '2019-11-30 04:55:56', 1, '{"filter_38":"Acer","filter_39":"Yangi\\r\\n"}', 'default', 42, '2019-11-17 04:55:56', '2019-11-17 07:52:10', '2019-11-17 04:55:56', 2),
(111, 1, 2, 'Nexia 2 sotiladi', '<p>Moshinada kamchiliklari yo''q, realni xaridorlar tel qilsin.</p>', 7500.00, '{"currency":"usd","covenant":"1"}', 'Abdulbosit', '@KosonsoymarketUz', '+998998052655', 'Kosonsoy, Namuna MFY', 'main', '2019-12-27 10:52:12', 3, '{"filter_12":"Chevrolet Nexia","filter_21":"1.6 Super bez kond","filter_26":"2015","filter_23":"84000","filter_27":"Oq","filter_25":"Toza","filter_28":"Gaz Temir 100","filter_42":"Chexol-polik, pult bo''lgan, tayyor xolatda"}', 'default', 17, '2019-11-27 10:59:18', '2019-11-27 10:59:18', '2019-11-27 10:59:18', 2),
(106, 1, 1, 'Bomraha yo''lida bog'' sotiladi', '<p>Xujjatlari bor. Hosilga kirgan Olma, Gilos, shaftoli va yong''oq daraxtlari mavjud. </p>', 8500.00, '{"currency":"usd","covenant":"1"}', 'UNNAMED', '', '+998993993345', 'Kosonsoy, Bomrahaga ketaverishda o''ng qo''lda', 'main', '2019-12-24 11:04:18', 3, '{"filter_8":" 100 ","filter_5":"2","filter_9":"Suv kanaldan"}', 'default', 120, '2019-11-24 11:08:08', '2019-11-24 11:08:08', '2019-11-24 11:08:08', 2),
(107, 1, 20, 'Faberlic Туш', 'Faberlicning sifatli mahsuloti', 65000.00, '{"currency":"sum","covenant":"0"}', 'Азиза', '@faberlickosonsoy', '+998943047610', 'Косонсой', 'default', '2019-11-24 13:49:54', 6, '{"filter_48":" \\u00ab\\u0411\\u0435\\u0441\\u043f\\u043e\\u0434\\u043e\\u0431\\u043d\\u044b\\u0439 \\u0438\\u0437\\u0433\\u0438\\u0431\\u00bb","filter_49":"\\u049a\\u043e\\u0440\\u0430","filter_53":"\\u04b2\\u0430\\u043b\\u043e\\u043b \\u0441\\u0435\\u0440\\u0442\\u0438\\u0444\\u0438\\u043a\\u0430\\u0442 \\u0438\\u0433\\u0430 \\u044d\\u0433\\u0430.  \\u0421\\u0438\\u0444\\u0430\\u0442\\u043b\\u0438 \\u043c\\u0430\\u04b3\\u0441\\u0443\\u043b\\u043e\\u0442 "}', 'default', 0, '2019-11-24 13:49:54', '2019-11-24 13:49:54', '2019-11-24 13:49:54', 1),
(108, 1, 8, 'Tayyor do''kon sotiladi', '<p>Do''kon ishlab turgan, kata yo''l bo''yida. Remontlari zo''r. Ichida 10000$ lik abarotdagi tovarlari bor. Xujjatlari joyida. </p>', 10000.00, '{"currency":"usd","covenant":"0"}', 'UNNAMED', '@KosonsoymarketUz', '+998997276006', 'Kosonsoy shahar', 'main', '2019-12-25 10:23:30', 3, '{"filter_32":"1-Qavatda","filter_34":"10x5"}', 'default', 222, '2019-11-25 10:29:49', '2019-11-25 10:29:49', '2019-11-25 10:29:49', 2),
(109, 1, 2, 'Nissan Minibus sotiladi', '<p>Yurib turgan, Kamchiliklari yo''q.</p>', 3000.00, '{"currency":"usd","covenant":"1"}', 'Sulaymonxon', '@KosonsoymarketUz', '+998941559004', 'Kosonsoy, Tagijar MFY', 'main', '2019-12-26 11:24:03', 3, '{"filter_12":"Nissan","filter_21":"Vanetta","filter_26":"1991","filter_27":"Mokriy Asfalt","filter_25":"Toza","filter_28":"Gaz 80 Temir"}', 'default', 41, '2019-11-26 11:27:46', '2019-11-26 11:27:46', '2019-11-26 11:27:46', 2),
(110, 1, 2, 'Nexia 3 sotiladi', '<p>Moshina yangi, salondan chiqganiga 2 oy bo''lgan, kamchiliklari yo''q.</p>', 9200.00, '{"currency":"usd","covenant":"1"}', 'Olim', '@Kosonsoyliklar_Uz', '+998998009244', 'Kosonsoy', 'default', '2019-12-27 07:01:31', 1, '{"filter_12":"Chevrolet Nexia 3","filter_21":"2","filter_26":"2019","filter_23":"1700","filter_27":"Oq","filter_25":"Toza","filter_28":"Gaz 90 Temir","filter_42":"4 ta yangi balon, Polik bo''lgan"}', 'default', 23, '2019-11-27 07:09:26', '2019-11-27 07:09:26', '2019-11-27 07:09:26', 2),
(113, 1, 2, 'E''lon', 'Tel: +998999762312\r\nKosonsoy', 7500.00, '{"currency":"usd","covenant":"null"}', 'Muhammadyusuf', 'Dj_mix_muxammad93@mail.ru', '+79108551315', 'Bogishamol', 'default', '2019-11-28 05:29:29', 1, '{"filter_12":"Nexia2","filter_21":"4 super salon kond","filter_23":"62000","filter_25":"Tozza","filter_26":"2015","filter_27":"Oq","filter_28":"Benzin gaz temir 100","filter_42":"Majigar pult shinalar Yangi "}', 'default', 0, '2019-11-28 05:29:29', '2019-11-28 05:29:29', '2019-11-28 05:29:29', 1),
(114, 1, 19, 'Obodda kvartira sotiladi', '<p>Remontlari a''lo darajada, yashash uchun tayyot xolatda. Suv uchun qo''shimcha bochkasi bor. MDF eshik va Akfa romlari o''rnatilgan.</p>', 8500.00, '{"currency":"usd","covenant":"1"}', 'Muhammadamin', '', '+998943016110', 'Kosonsoy, Obod MFY,  2-Domda (Yuqoridagi)', 'default', '2019-12-28 07:33:43', 3, '{"filter_29":"3-qavat","filter_30":"3 ta","filter_31":"Elektr enegiya, suv (Ariston)"}', 'default', 31, '2019-11-28 07:37:31', '2019-11-28 07:37:31', '2019-11-28 07:37:31', 2),
(115, 1, 1, 'Bog''ishamol MFY, Bog'' ko''chasida 6,5 sotixli xovli sotiladi', '<p>2019 yili kadastr qilingan bitmagan xovli sotiladi, ikki tomoni ko&#39;chaga qaragan. 2 ta xonasi, 1 ta daxliz, 1 dushevoy, 1 ta xojatxona shlokablok bilan qurilib tomi yopilgan. 8 ta xonaga mostlab yarmini podvalli qilib 85kub.metr beton aralashtirib fundament quyilgan. Xovli aylanasiga pod rashivka shlokablok bilan o&#39;ralgan.&nbsp;</p>', 21000.00, '{"currency":"usd","covenant":"1"}', 'Tolibxon', 'tolibkhonkhusainov@gmail.com', '903351001', 'Bog''ishamol MFY , Bog'' ko''chasi', 'default', '2019-11-28 09:56:45', 6, '{"filter_8":"6.5","filter_5":"10","filter_9":"Elektr, suv"}', 'default', 6, '2019-11-28 09:56:45', '2019-11-28 09:56:45', '2019-11-28 09:56:45', 2),
(116, 1, 2, 'Nexia 2 sotiladi', '<p>Moshina ideal holatda</p>', 7000.00, '{"currency":"usd","covenant":"1"}', 'Muhammadjon', '', '+998999762312', 'Kosonsoy', 'main', '2019-12-28 10:34:14', 3, '{"filter_12":"Nexia-2","filter_21":"1.6 Super Kond","filter_26":"2015","filter_23":"63000","filter_27":"Oq","filter_25":"Toza","filter_28":"Gaz Temir 100 talik","filter_42":"Chexol-polik, Magicar pult, yumshoq yangi balon."}', 'default', 38, '2019-11-28 10:42:23', '2019-11-28 10:42:23', '2019-11-28 10:42:23', 2),
(117, 1, 16, 'Soycha Mfy da joylashgan 6 sotixdan iborat uchasga sotiladi', '<p>Elektr energiya tortilgan suv muamosiz. 30 dan ortiq mevali daraxt bor. 2 tarafdan eshigi bor. 5 honadan iborat padvali bor.</p>', 22000.00, '{"currency":"usd","covenant":"0"}', 'Nabijon', 'Nabijon.husanboyev@gmail.com', '+998942727099', 'Kosonsoy tumami. Soycha MfY', 'default', '2019-11-30 02:56:18', 6, '{"filter_35":"6","filter_36":"Bor"}', 'default', 0, '2019-11-30 02:56:18', '2019-11-30 02:56:18', '2019-11-30 02:56:18', 1),
(118, 1, 16, 'Jar MFYda uchaska sotiladi', '<p>Ikta xonaga fundament quyilgan, Aholi yashash joyida, Xujjatlari 100%</p>', 100000.00, '{"currency":"usd","covenant":"1"}', 'UNNAMED', '@KosonsoymarketUz', '+998943054499', 'Kosonsoy, Jar MFY', 'default', '2019-12-30 10:10:49', 1, '{"filter_35":"9","filter_36":"Bor"}', 'default', 0, '2019-12-01 10:13:30', '2019-12-01 10:13:30', '2019-12-01 10:13:30', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `post_images`
--

CREATE TABLE IF NOT EXISTS `post_images` (
  `image_id` int(11) NOT NULL,
  `post_id` bigint(22) NOT NULL,
  `name` varchar(255) NOT NULL,
  `size` bigint(22) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=158 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `post_images`
--

INSERT INTO `post_images` (`image_id`, `post_id`, `name`, `size`, `filename`, `status`) VALUES
(85, 47, 'photo_2019-11-16_13-02-46.jpg', 158258, 'b39ca8a5bffb4aafd70e18d96cef6cc0.jpg', 1),
(78, 41, 'IMG_20191115_195322_361.jpg', 110091, '1a7743387b91128364670a0e668ea395.jpg', 1),
(79, 41, 'IMG_20191115_195320_502.jpg', 117675, '5a77a0f1b82026071e8132dccbad3ef0.jpg', 1),
(72, 35, 'photo_2019-11-12_17-06-26.jpg', 175524, 'b378a713ecdfc6bd8661e8c5a2ec9faa.jpg', 1),
(73, 36, 'IMG_20191113_180533_025.jpg', 69281, 'b16ec4825a0d7ace68a21d6b532ce06b.jpg', 1),
(74, 37, 'ar137502431253435.jpg', 108402, '9736385531d6fcde32812081b8828022.jpg', 1),
(75, 38, 'Hovli.jpg', 388658, '1fb2f9b7b1c70f459fb2e7cd77bcf2e7.jpg', 1),
(76, 39, 'ar137502431253435.jpg', 108402, '7882da7eb6a0ae5d0bebf1dc11e49e42.jpg', 1),
(77, 40, 'IMG_20191114_151827_636.jpg', 69281, '73b955417354f398e83e326ddd67414b.jpg', 1),
(71, 34, 'photo_2019-11-12_16-56-41.jpg', 114560, '348702aa56e8999da63f2a5feadb1951.jpg', 1),
(70, 34, 'photo_2019-11-12_16-56-43.jpg', 114311, '15897548ca0f216c872f2d44575a8a8f.jpg', 1),
(61, 28, 'IMG_20191111_193053_863.jpg', 31261, '72a76b2387a1844e8267fe5b325f9ac0.jpg', 1),
(62, 29, 'IMG_20191111_221651_135.jpg', 226557, '920add5158679cd6c18a579e5ff62807.jpg', 1),
(63, 30, 'IMG_20191111_230714_289.jpg', 260947, '0efa6a4222407502c40e3a548f3f8ff5.jpg', 1),
(64, 30, 'IMG_20191111_230721_377.jpg', 173169, '9cb73a7dd0f5bbe467a3238d7c38560e.jpg', 1),
(65, 30, 'IMG_20191111_230716_685.jpg', 229113, '4f7b624f25ad61921652f49d5859ad69.jpg', 1),
(66, 30, 'IMG_20191111_230711_922.jpg', 241576, 'c6cae468da88c41a86d5aec519203981.jpg', 1),
(67, 31, 'photo_2019-11-12_11-39-04.jpg', 136824, 'b08e0b2352f4244fed1e342e06be537e.jpg', 1),
(68, 32, 'ar137502431253435.jpg', 108402, 'cbe771efafbd3629593a947acf5c7e75.jpg', 1),
(69, 33, 'ar137502431253435.jpg', 108402, '1dde903dade851f5c26c14648420f1ca.jpg', 1),
(60, 27, 'photo_2019-11-10_09-56-12.jpg', 310287, 'a513d985d28c6d0296d556f3272d5093.jpg', 1),
(86, 47, 'photo_2019-11-16_13-02-45.jpg', 165848, '54ec4ecde2745006288a1541c08991b4.jpg', 1),
(87, 47, 'photo_2019-11-16_13-02-43.jpg', 140052, '17ca2076034bd9ad8abb11eddeaf2c46.jpg', 1),
(131, 94, '4314612.jpg', 128920, 'd75669a9990d7c0c53d65c4d6a7c7f5b.jpg', 1),
(132, 95, 'photo_2019-11-20_13-34-35.jpg', 159049, '69091274a90f340efc84f46075b3f966.jpg', 1),
(115, 78, 'photo_2019-11-18_14-16-36.jpg', 18825, '0869f43425df3c901cd5aebea1d11c62.jpg', 1),
(135, 98, 'IMG_20191121_175912_448.jpg', 292336, 'e2300fb119f7041a88846e4d61f8f74b.jpg', 1),
(107, 68, 'photo_2019-11-17_15-18-47.jpg', 70436, '79cf209b78da5075560350d253da0260.jpg', 1),
(108, 70, 'IMG_20191117_150819_185.jpg', 76003, '83d2d5a407609accb370047285014ef1.jpg', 1),
(109, 71, 'blue (1).png', 579368, '3bf911c8ee80592e7a021088f8572d1a.png', 1),
(97, 57, 'IMG_20191101_091521_260.jpg', 198301, 'c5041248675a93db840d3123d49e4c55.jpg', 1),
(133, 96, 'IMG_20191120_134644_919.jpg', 305952, '4e305a171ba754901eaabc11bec00977.jpg', 1),
(134, 97, 'photo_2019-11-20_16-14-53.jpg', 279399, '3a2bc480ec552da319d428c0e3311be0.jpg', 1),
(136, 99, 'photo_2019-11-23_11-36-15.jpg', 225119, '27b13069acdcba81ba81499b0c9d2383.jpg', 1),
(111, 74, '20180410_154914.jpg', 1233342, 'f97735e47614bf57373b4ab13ecb8555.jpg', 1),
(102, 63, 'IMG_20191114_102458.jpg', 4111789, '06625f88b897916ee56a77a36828897f.jpg', 1),
(103, 64, 'samsung-a510-galaxy-a5-2016-4g-16gb-black.jpg', 111292, 'fcc1a9c6ce93c592fa138b073e64b19b.jpg', 1),
(104, 65, 'IMG_20191116_235102.jpg', 314940, '93baed67c5eb0da42fbcfb5ccd9a9229.jpg', 1),
(105, 66, 'IMG_20191115_210418_331.jpg', 146765, '83569c7bce84712669a88509eaf51306.jpg', 1),
(106, 67, 'temp2.jpg', 42574, 'fc2f21a572b1038ed5d787ec726357c7.jpg', 1),
(137, 100, 'Screenshot_20191123-235028_Faberlic.jpg', 291915, '4cbcea0670dbb97a67b68b2e4dd2885f.jpg', 1),
(138, 101, '20191123_235748.jpg', 137560, '7f9c8bc10333b16138e37b75de3fc9ae.jpg', 1),
(139, 102, '20191124_000906.jpg', 284770, '23b140a454b59df30b35a1287a5b6d44.jpg', 1),
(140, 103, 'WshVeSJG_400x400.jpg', 14421, '56fa3b4940faf6407cd205bbb1925f73.jpg', 1),
(141, 104, 'photo_2019-11-24_15-00-23.jpg', 311743, '4d26ccace1a1c291674515bebcd8fd64.jpg', 1),
(142, 104, 'photo_2019-11-24_15-00-21.jpg', 273769, '0509232a20827ade67a2225dd2bb6afa.jpg', 1),
(150, 111, 'photo_2019-11-27_15-59-06.jpg', 123813, '42bb4a4ab7babcde24127a453f96ea23.jpg', 1),
(144, 106, 'photo_2019-11-24_16-06-41.jpg', 169975, '93769a287fd9134cc05b0acf15b7f50a.jpg', 1),
(130, 93, 'IMG_20191119_133609_025.jpg', 160175, 'd370eb078e3f9e4a242e3433ee2eec9e.jpg', 1),
(145, 107, '1000366659872_15042796461.jpg', 343142, '0d4c6d70a4fc925b952ca5d92b6c120e.jpg', 1),
(146, 108, 'open-uri20150527-11-j5oul2.gif', 466806, '990f6ba9e55db6e40327ecb5d337a331.gif', 1),
(147, 109, 'photo_2019-11-26_16-26-45.jpg', 210217, '319d44c4d344aa1d956c25ab403a4c81.jpg', 1),
(148, 109, 'photo_2019-11-26_16-26-43.jpg', 186243, 'eb3ec10098910d5550d7c6d9e07c8060.jpg', 1),
(149, 110, 'photo_2019-11-27_12-08-33.jpg', 205945, 'b11640f3fd05761e8bd28cf139c887c7.jpg', 1),
(151, 112, 'photo_2019-11-18_14-16-36.jpg', 18825, 'efd903bc7aa8725dc90ffe74241abf0c.jpg', 1),
(152, 114, 'photo_2019-11-18_14-16-36.jpg', 18825, '1e21ce6baea24b5e5de823152f4dc537.jpg', 1),
(153, 115, 'Screenshot_2019-11-28-14-40-34-587_com.google.android.apps.maps.png', 1591964, '27bd469737c944bc6924026a7116da3f.png', 1),
(154, 115, 'Screenshot_2019-11-28-14-41-13-714_com.google.android.apps.maps.png', 902102, '83bc79510aa5874c698a2563b31d88fe.png', 1),
(155, 116, 'photo_2019-11-28_15-39-30.jpg', 149112, 'ef8e4d274ee3e59b788353e98f8f3a0a.jpg', 1),
(156, 117, 'IMG_20191130_075601_011.jpg', 286745, '6446fec7bfc0d49325feb5b4d5dea585.jpg', 1),
(157, 118, 'Boshyer.jpg', 474482, '43edbd03c19a9863c5e9e64cf03f79a1.jpg', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `pricing`
--

CREATE TABLE IF NOT EXISTS `pricing` (
  `price_id` int(11) NOT NULL,
  `price` bigint(22) NOT NULL,
  `name` text NOT NULL,
  `subtitle` text NOT NULL,
  `content` text NOT NULL,
  `featured` varchar(255) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `pricing`
--

INSERT INTO `pricing` (`price_id`, `price`, `name`, `subtitle`, `content`, `featured`) VALUES
(1, 10000, '{"uzbek_cyr":"\\u049a\\u0443\\u043b\\u0430\\u0439","uzbek_lt":"Qulay"}', '{"uzbek_cyr":"\\u049a\\u0443\\u043b\\u0430\\u0439 \\u043d\\u0430\\u0440\\u0445","uzbek_lt":"Qulay narx"}', '{"uzbek_cyr":["\\u041c\\u0430\\u0440\\u043a\\u0435\\u0442 \\u0441\\u0430\\u0439\\u0442\\u0438 \\u0432\\u0430 \\u043a\\u0430\\u043d\\u0430\\u043b\\u0438\\u0433\\u0430 \\u0436\\u043e\\u0439\\u043b\\u0430\\u0448\\r","\\u0422\\u043e\\u043f-\\u044d\\u044a\\u043b\\u043e\\u043d 3 \\u043a\\u0443\\u043d\\u0433\\u0430\\r","\\u0420\\u045e\\u0439\\u0445\\u0430\\u0442 \\u0442\\u0435\\u043f\\u0430\\u0441\\u0438\\u0433\\u0430 \\u043a\\u045e\\u0442\\u0430\\u0440\\u0438\\u0448\\r","\\u0412\\u0418\\u041f-\\u044d\\u044a\\u043b\\u043e\\u043d"],"uzbek_lt":["Market kanali va saytiga joylash\\r","Top-e''lon 3 kunga\\r","Ro''yxat tepasiga ko''tarish\\r","VIP-e''lon\\r"]}', 'notfeatured'),
(2, 60000, '{"uzbek_cyr":"\\u0422\\u0443\\u0440\\u0431\\u043e \\u0441\\u0430\\u0432\\u0434\\u043e","uzbek_lt":"Turbo savdo"}', '{"uzbek_cyr":"\\u0422\\u0443\\u0440\\u0431\\u043e \\u0442\\u0435\\u0437\\u043b\\u0438\\u043a","uzbek_lt":"Turbo tezlik"}', '{"uzbek_cyr":["\\u041c\\u0430\\u0440\\u043a\\u0435\\u0442 \\u043a\\u0430\\u043d\\u0430\\u043b\\u0438 \\u0432\\u0430 \\u0441\\u0430\\u0439\\u0442\\u0438 + \\u041a\\u043e\\u0441\\u043e\\u043d\\u0441\\u043e\\u0439\\u043b\\u0438\\u043a\\u043b\\u0430\\u0440\\u0434\\u0430 24 \\u0441\\u043e\\u0430\\u0442 \\u041f\\u0418\\u041d.\\r","\\u0422\\u043e\\u043f-\\u044d\\u044a\\u043b\\u043e\\u043d 30 \\u043a\\u0443\\u043d\\u0433\\u0430\\r","\\u0420\\u045e\\u0439\\u0445\\u0430\\u0442 \\u0442\\u0435\\u043f\\u0430\\u0441\\u0438\\u0433\\u0430 \\u043a\\u045e\\u0442\\u0430\\u0440\\u0438\\u0448\\r","\\u0412\\u0418\\u041f-\\u044d\\u044a\\u043b\\u043e\\u043d\\r"],"uzbek_lt":["Market kanali hamda sayti + Kosonsoyliklar 24 PINNED\\r","Top-e''lon 30 kunga\\r","Ro''yxat tepasiga ko''tarish\\r","VIP-e''lon\\r"]}', 'featured'),
(3, 40000, '{"uzbek_cyr":"\\u0422\\u0435\\u0437\\u043a\\u043e\\u0440 \\u0441\\u0430\\u0432\\u0434\\u043e","uzbek_lt":"Tezkor savdo"}', '{"uzbek_cyr":"\\u0422\\u0435\\u0437\\u043a\\u043e\\u0440 \\u0438\\u043c\\u043a\\u043e\\u043d\\u0438\\u044f\\u0442","uzbek_lt":"Tezkor imkoniyat"}', '{"uzbek_cyr":["\\u041c\\u0430\\u0440\\u043a\\u0435\\u0442 \\u0441\\u0430\\u0439\\u0442\\u0438 \\u0432\\u0430 \\u043a\\u0430\\u043d\\u0430\\u043b\\u0438 + \\u041a\\u043e\\u0441\\u043e\\u043d\\u0441\\u043e\\u0439\\u043b\\u0438\\u043a\\u043b\\u0430\\u0440\\r","\\u0422\\u043e\\u043f-\\u044d\\u044a\\u043b\\u043e\\u043d 10 \\u043a\\u0443\\u043d\\u0433\\u0430\\r","\\u0420\\u045e\\u0439\\u0445\\u0430\\u0442 \\u0442\\u0435\\u043f\\u0430\\u0441\\u0438\\u0433\\u0430 \\u043a\\u045e\\u0442\\u0430\\u0440\\u0438\\u0448\\r","\\u0412\\u0418\\u041f-\\u044d\\u044a\\u043b\\u043e\\u043d\\r"],"uzbek_lt":["Market kanali va sayti + Kosonsoyliklar\\r","Top-e''lon 3 kunga\\r","Ro''yxat tepasiga ko''tarish\\r","VIP-e''lon\\r"]}', 'notfeatured'),
(6, 0, '{"uzbek_cyr":"\\u0411\\u0435\\u043f\\u0443\\u043b","uzbek_lt":"Bepul"}', '{"uzbek_cyr":"\\u0411\\u0435\\u043f\\u0443\\u043b","uzbek_lt":" Bepul"}', '{"uzbek_cyr":["E''lon berish aksiya doirasida bepul!"],"uzbek_lt":["E''lon berish aksiya doirasida bepul!"]}', 'featured');

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `setting_id` int(11) NOT NULL,
  `key` varchar(255) CHARACTER SET utf8 NOT NULL,
  `value` text CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`setting_id`, `key`, `value`) VALUES
(1, 'style_path', '{base_url}public/'),
(2, 'site_title', 'Kosonsoymarket.Uz - Kosonsoyliklar uchun eng qulay e''lonlar taxtasi'),
(3, 'site_description', 'Kosonsoyliklar uchun eng yirik e''lonlar taxtasi. Ko''chmas mulk, ish, elektronika, transport - tovarlarni sotib olish / sotish, xizmatlar va boshqalar mavzularidagi ulkan e''lonlar bazasi!'),
(4, 'site_keywords', 'elonlar,doskasi,ish,sotish,sotib olish'),
(5, 'default_language', 'uzbek_lt'),
(6, 'contact_address', 'Namangan vil, Kosonsoy tuman'),
(7, 'contact_number', '+998 (94) 277-7797'),
(8, 'contact_email', 'support@kosonsoymarket.uz'),
(9, 'contact_telegram', '@kosonsoyliklar_uz'),
(10, 'social_links', '{"telegram":"http:\\/\\/t.me\\/kosonsoyliklar_uz","facebook":"http:\\/\\/fb.com\\/kosonsoyliklar_uz","instagram":"http:\\/\\/instagram.com\\/kosonsoyliklar_uz","twitter":"http:\\/\\/twitter.com\\/kosonsoyliklar_uz"}'),
(11, 'rules', '{"uzbek_lt":["Saytga tashrif buyurgan barcha foydalanuvchilar saytdan to\\u2018laqonli foydalanish uchun ro\\u2018yxatdan o\\u2018tishlari zarur.","Saytda a\\u2019zolar o\\u2018z harakatlari chog\\u2018ida \\u201cMilliy mentalitetidan\\u201d ayro bo\\u2018lgan, yod g\\u2018oyalarni targ\\u2018ib etuvchi yoki (Qo\\u2018poruvchilikni, Buzg\\u2018unchi, pornografik, odam savdosi, haqorat nomus va qo\\u2018pol so\\u2018zlarni, diniy ekstremistik va missionerlik harakatlarini) anglatuvchi ma''''lumotlarni tarqatishi va izohlar berishi qat''''iyan man etiladi","Saytda a\\u2019zolar O\\u2018z harakatlari chog\\u2018ida boshqa foydalanuvchilarga nisbatan behurmatlik qilsa yoki ahloq qoidalaridan chiqib (so\\u2018kinish, haqorat, qo\\u2018pol so\\u2018zlar) ni ishlatsa va bo\\u2018lar bo\\u2018lmas e''''lonlar, fikrlar bildirsa bunday foydalanuvchilar akkaunti bloklanadi","Saytda a\\u2019zolar tomonidan boshqa saytlarni ataylab reklama qilish va targ\\u2018ibot qilish TAQIQLANADI!","Har doim e''''lonlarni aniq ma''''lumotlar bilan berishga va to''''g''''ri bo''''limga joylashga e''''tibor berish shart.","Bir xil bo''''lgan e''''lonni ikki va undan ko''''p marotaba yuborish taqiqlanadi.","Boshqa-bir e''''lon joylagan foydalanuvchilarni o''''rinsiz murojaatlar bilan bezovta qilmang."],"uzbek_cyr":["\\u0421\\u0430\\u0439\\u0442\\u0433\\u0430 \\u0442\\u0430\\u0448\\u0440\\u0438\\u0444 \\u0431\\u0443\\u044e\\u0440\\u0433\\u0430\\u043d \\u0431\\u0430\\u0440\\u0447\\u0430 \\u0444\\u043e\\u0439\\u0434\\u0430\\u043b\\u0430\\u043d\\u0443\\u0432\\u0447\\u0438\\u043b\\u0430\\u0440 \\u0441\\u0430\\u0439\\u0442\\u0434\\u0430\\u043d \\u0442\\u045e\\u043b\\u0430\\u049b\\u043e\\u043d\\u043b\\u0438 \\u0444\\u043e\\u0439\\u0434\\u0430\\u043b\\u0430\\u043d\\u0438\\u0448 \\u0443\\u0447\\u0443\\u043d \\u0440\\u045e\\u0439\\u0445\\u0430\\u0442\\u0434\\u0430\\u043d \\u045e\\u0442\\u0438\\u0448\\u043b\\u0430\\u0440\\u0438 \\u0437\\u0430\\u0440\\u0443\\u0440.","\\u0421\\u0430\\u0439\\u0442\\u0434\\u0430 \\u0430\\u044a\\u0437\\u043e\\u043b\\u0430\\u0440 \\u045e\\u0437 \\u04b3\\u0430\\u0440\\u0430\\u043a\\u0430\\u0442\\u043b\\u0430\\u0440\\u0438 \\u0447\\u043e\\u0493\\u0438\\u0434\\u0430 \\u00ab\\u041c\\u0438\\u043b\\u043b\\u0438\\u0439 \\u043c\\u0435\\u043d\\u0442\\u0430\\u043b\\u0438\\u0442\\u0435\\u0442\\u0438\\u0434\\u0430\\u043d\\u00bb \\u0430\\u0439\\u0440\\u043e \\u0431\\u045e\\u043b\\u0433\\u0430\\u043d, \\u0451\\u0434 \\u0493\\u043e\\u044f\\u043b\\u0430\\u0440\\u043d\\u0438 \\u0442\\u0430\\u0440\\u0493\\u0438\\u0431 \\u044d\\u0442\\u0443\\u0432\\u0447\\u0438 \\u0451\\u043a\\u0438 (\\u049a\\u045e\\u043f\\u043e\\u0440\\u0443\\u0432\\u0447\\u0438\\u043b\\u0438\\u043a\\u043d\\u0438, \\u0411\\u0443\\u0437\\u0493\\u0443\\u043d\\u0447\\u0438, \\u043f\\u043e\\u0440\\u043d\\u043e\\u0433\\u0440\\u0430\\u0444\\u0438\\u043a, \\u043e\\u0434\\u0430\\u043c \\u0441\\u0430\\u0432\\u0434\\u043e\\u0441\\u0438, \\u04b3\\u0430\\u049b\\u043e\\u0440\\u0430\\u0442 \\u043d\\u043e\\u043c\\u0443\\u0441 \\u0432\\u0430 \\u049b\\u045e\\u043f\\u043e\\u043b \\u0441\\u045e\\u0437\\u043b\\u0430\\u0440\\u043d\\u0438, \\u0434\\u0438\\u043d\\u0438\\u0439 \\u044d\\u043a\\u0441\\u0442\\u0440\\u0435\\u043c\\u0438\\u0441\\u0442\\u0438\\u043a \\u0432\\u0430 \\u043c\\u0438\\u0441\\u0441\\u0438\\u043e\\u043d\\u0435\\u0440\\u043b\\u0438\\u043a \\u04b3\\u0430\\u0440\\u0430\\u043a\\u0430\\u0442\\u043b\\u0430\\u0440\\u0438\\u043d\\u0438) \\u0430\\u043d\\u0433\\u043b\\u0430\\u0442\\u0443\\u0432\\u0447\\u0438 \\u043c\\u0430\\\\\\u044a\\u043b\\u0443\\u043c\\u043e\\u0442\\u043b\\u0430\\u0440\\u043d\\u0438 \\u0442\\u0430\\u0440\\u049b\\u0430\\u0442\\u0438\\u0448\\u0438 \\u0432\\u0430 \\u0438\\u0437\\u043e\\u04b3\\u043b\\u0430\\u0440 \\u0431\\u0435\\u0440\\u0438\\u0448\\u0438 \\u049b\\u0430\\u0442\\u044a\\u0438\\u044f\\u043d \\u043c\\u0430\\u043d \\u044d\\u0442\\u0438\\u043b\\u0430\\u0434\\u0438","\\u0421\\u0430\\u0439\\u0442\\u0434\\u0430 \\u0430\\u044a\\u0437\\u043e\\u043b\\u0430\\u0440 \\u040e\\u0437 \\u04b3\\u0430\\u0440\\u0430\\u043a\\u0430\\u0442\\u043b\\u0430\\u0440\\u0438 \\u0447\\u043e\\u0493\\u0438\\u0434\\u0430 \\u0431\\u043e\\u0448\\u049b\\u0430 \\u0444\\u043e\\u0439\\u0434\\u0430\\u043b\\u0430\\u043d\\u0443\\u0432\\u0447\\u0438\\u043b\\u0430\\u0440\\u0433\\u0430 \\u043d\\u0438\\u0441\\u0431\\u0430\\u0442\\u0430\\u043d \\u0431\\u0435\\u04b3\\u0443\\u0440\\u043c\\u0430\\u0442\\u043b\\u0438\\u043a \\u049b\\u0438\\u043b\\u0441\\u0430 \\u0451\\u043a\\u0438 \\u0430\\u04b3\\u043b\\u043e\\u049b \\u049b\\u043e\\u0438\\u0434\\u0430\\u043b\\u0430\\u0440\\u0438\\u0434\\u0430\\u043d \\u0447\\u0438\\u049b\\u0438\\u0431 (\\u0441\\u045e\\u043a\\u0438\\u043d\\u0438\\u0448, \\u04b3\\u0430\\u049b\\u043e\\u0440\\u0430\\u0442, \\u049b\\u045e\\u043f\\u043e\\u043b \\u0441\\u045e\\u0437\\u043b\\u0430\\u0440) \\u043d\\u0438 \\u0438\\u0448\\u043b\\u0430\\u0442\\u0441\\u0430 \\u0432\\u0430 \\u0431\\u045e\\u043b\\u0430\\u0440 \\u0431\\u045e\\u043b\\u043c\\u0430\\u0441 \\u044d\\u044a\\u043b\\u043e\\u043d\\u043b\\u0430\\u0440, \\u0444\\u0438\\u043a\\u0440\\u043b\\u0430\\u0440 \\u0431\\u0438\\u043b\\u0434\\u0438\\u0440\\u0441\\u0430 \\u0431\\u0443\\u043d\\u0434\\u0430\\u0439 \\u0444\\u043e\\u0439\\u0434\\u0430\\u043b\\u0430\\u043d\\u0443\\u0432\\u0447\\u0438\\u043b\\u0430\\u0440 \\u0430\\u043a\\u043a\\u0430\\u0443\\u043d\\u0442\\u0438 \\u0431\\u043b\\u043e\\u043a\\u043b\\u0430\\u043d\\u0430\\u0434\\u0438","\\u0421\\u0430\\u0439\\u0442\\u0434\\u0430 \\u0430\\u044a\\u0437\\u043e\\u043b\\u0430\\u0440 \\u0442\\u043e\\u043c\\u043e\\u043d\\u0438\\u0434\\u0430\\u043d \\u0431\\u043e\\u0448\\u049b\\u0430 \\u0441\\u0430\\u0439\\u0442\\u043b\\u0430\\u0440\\u043d\\u0438 \\u0430\\u0442\\u0430\\u0439\\u043b\\u0430\\u0431 \\u0440\\u0435\\u043a\\u043b\\u0430\\u043c\\u0430 \\u049b\\u0438\\u043b\\u0438\\u0448 \\u0432\\u0430 \\u0442\\u0430\\u0440\\u0493\\u0438\\u0431\\u043e\\u0442 \\u049b\\u0438\\u043b\\u0438\\u0448 \\u0422\\u0410\\u049a\\u0418\\u049a\\u041b\\u0410\\u041d\\u0410\\u0414\\u0418!","\\u04b2\\u0430\\u0440 \\u0434\\u043e\\u0438\\u043c \\u044d\\\\\\u044a\\u043b\\u043e\\u043d\\u043b\\u0430\\u0440\\u043d\\u0438 \\u0430\\u043d\\u0438\\u049b \\u043c\\u0430\\u044a\\u043b\\u0443\\u043c\\u043e\\u0442\\u043b\\u0430\\u0440 \\u0431\\u0438\\u043b\\u0430\\u043d \\u0431\\u0435\\u0440\\u0438\\u0448\\u0433\\u0430 \\u0432\\u0430 \\u0442\\u045e\\u0493\\u0440\\u0438 \\u0431\\u045e\\u043b\\u0438\\u043c\\u0433\\u0430 \\u0436\\u043e\\u0439\\u043b\\u0430\\u0448\\u0433\\u0430 \\u044d\\u044a\\u0442\\u0438\\u0431\\u043e\\u0440 \\u0431\\u0435\\u0440\\u0438\\u0448 \\u0448\\u0430\\u0440\\u0442.","\\u0411\\u0438\\u0440 \\u0445\\u0438\\u043b \\u0431\\u045e\\u043b\\u0433\\u0430\\u043d \\u044d\\u044a\\u043b\\u043e\\u043d\\u043d\\u0438 \\u0438\\u043a\\u043a\\u0438 \\u0432\\u0430 \\u0443\\u043d\\u0434\\u0430\\u043d \\u043a\\u045e\\u043f \\u043c\\u0430\\u0440\\u043e\\u0442\\u0430\\u0431\\u0430 \\u044e\\u0431\\u043e\\u0440\\u0438\\u0448 \\u0442\\u0430\\u049b\\u0438\\u049b\\u043b\\u0430\\u043d\\u0430\\u0434\\u0438.","\\u0411\\u043e\\u0448\\u049b\\u0430-\\u0431\\u0438\\u0440 \\u044d\\u044a\\u043b\\u043e\\u043d \\u0436\\u043e\\u0439\\u043b\\u0430\\u0433\\u0430\\u043d \\u0444\\u043e\\u0439\\u0434\\u0430\\u043b\\u0430\\u043d\\u0443\\u0432\\u0447\\u0438\\u043b\\u0430\\u0440\\u043d\\u0438 \\u045e\\u0440\\u0438\\u043d\\u0441\\u0438\\u0437 \\u043c\\u0443\\u0440\\u043e\\u0436\\u0430\\u0430\\u0442\\u043b\\u0430\\u0440 \\u0431\\u0438\\u043b\\u0430\\u043d \\u0431\\u0435\\u0437\\u043e\\u0432\\u0442\\u0430 \\u049b\\u0438\\u043b\\u043c\\u0430\\u043d\\u0433."]}'),
(12, 'faq', '{"uzbek_cyr":[{"question":"Xizmat uchun to\\u2019lov turlari qanday?","content":"Naqd pul yoki plastik karta orqali to\\u2019lashingiz yoki bo\\u2019lmasam Mbank, Payme, Paynet, Woy-wo, Upay, Websum xizmatlaridan foydalanishingiz mumkin. "},{"question":"\\u0412\\u0430\\u0448 \\u0445\\u043e\\u0441\\u0442\\u0438\\u043d\\u0433 \\u043d\\u0430\\u0445\\u043e\\u0434\\u0438\\u0442\\u0441\\u044f \\u0432 \\u0441\\u0435\\u0442\\u0438 TAS-IX?","content":"\\u0414\\u0430. \\u041d\\u0430\\u0448 \\u0445\\u043e\\u0441\\u0442\\u0438\\u0438\\u043d\\u0433 \\u043d\\u0430\\u0445\\u043e\\u0434\\u0438\\u0442\\u0441\\u044f \\u0432 \\u0441\\u0435\\u0442\\u0438 TAS-IX."}],"uzbek_lt":[{"question":"Xizmat uchun to\\u2019lov turlari qanday?","content":"Naqd pul yoki plastik karta orqali to\\u2019lashingiz yoki bo\\u2019lmasam Mbank, Payme, Paynet, Woy-wo, Upay, Websum xizmatlaridan foydalanishingiz mumkin. "},{"question":"\\u0412\\u0430\\u0448 \\u0445\\u043e\\u0441\\u0442\\u0438\\u043d\\u0433 \\u043d\\u0430\\u0445\\u043e\\u0434\\u0438\\u0442\\u0441\\u044f \\u0432 \\u0441\\u0435\\u0442\\u0438 TAS-IX?","content":"\\u0414\\u0430. \\u041d\\u0430\\u0448 \\u0445\\u043e\\u0441\\u0442\\u0438\\u0438\\u043d\\u0433 \\u043d\\u0430\\u0445\\u043e\\u0434\\u0438\\u0442\\u0441\\u044f \\u0432 \\u0441\\u0435\\u0442\\u0438 TAS-IX."}]}'),
(13, 'about_site', '{"uzbek_cyr":"<p>Kosonsoymarket.uz \\u0441\\u0430\\u0439\\u0442\\u0438 \\u041a\\u043e\\u0441\\u043e\\u043d\\u0441\\u043e\\u0439\\u0434\\u0430 \\u043e\\u043d\\u043b\\u0430\\u0439\\u043d \\u0441\\u0430\\u0432\\u0434\\u043e \\u0441\\u043e\\u04b3\\u0430\\u0441\\u0438\\u043d\\u0438 \\u0440\\u0438\\u0432\\u043e\\u0436\\u043b\\u0430\\u043d\\u0442\\u0438\\u0440\\u0438\\u0448, \\u0444\\u0443\\u049b\\u0430\\u0440\\u043e\\u043b\\u0430\\u0440\\u0433\\u0430 \\u049b\\u0443\\u043b\\u0430\\u0439\\u043b\\u0438\\u043a \\u044f\\u0440\\u0430\\u0442\\u0438\\u0448\\u0434\\u0430\\u043d \\u0438\\u0431\\u043e\\u0440\\u0430\\u0442.<\\/p><p><br><\\/p><p>\\u041a\\u043e\\u0441\\u043e\\u043d\\u0441\\u043e\\u0439\\u0434\\u0430\\u0433\\u0438 \\u044d\\u043d\\u0433 \\u043a\\u0430\\u0442\\u0442\\u0430 \\u0430\\u0443\\u0434\\u0438\\u043e\\u0442\\u043e\\u0440\\u0438\\u044f\\u0433\\u0430 \\u044d\\u0433\\u0430 \\u0431\\u045e\\u043b\\u0433\\u0430\\u043d \\u0441\\u0430\\u04b3\\u0438\\u0444\\u0430\\u043b\\u0430\\u0440\\u0438\\u043c\\u0438\\u0437\\u0434\\u0430 \\u045e\\u0437 \\u044d\\u044a\\u043b\\u043e\\u043d \\u0432\\u0430 \\u0440\\u0435\\u043a\\u043b\\u0430\\u043c\\u0430\\u043d\\u0433\\u0438\\u0437\\u043d\\u0438 \\u0436\\u043e\\u0439\\u043b\\u0430\\u0448\\u0442\\u0438\\u0440\\u0438\\u0431 \\u0438\\u0448\\u0438\\u043d\\u0438\\u0433\\u0438\\u0437\\u043d\\u0438 \\u043e\\u0441\\u043e\\u043d \\u0431\\u0438\\u0442\\u0438\\u0440\\u0438\\u0448 \\u0438\\u043c\\u043a\\u043e\\u043d\\u0438\\u044f\\u0442\\u0438\\u043d\\u0438 \\u0442\\u0430\\u049b\\u0434\\u0438\\u043c \\u044d\\u0442\\u0430\\u043c\\u0438\\u0437!<\\/p><p><br><\\/p>","uzbek_lt":"<p>Kosonsoymarket.uz sayti Kosonsoyda onlayn savdo sohasini rivojlantirish, fuqarolarga qulaylik yaratishdan iborat.\\u00a0<\\/p><p><br><\\/p><p>Kosonsoydagi eng katta audiotoriyaga ega bo''lgan sahifalarimizda o''z e''lon va reklamangizni joylashtirib ishinigizni oson bitirish imkoniyatini taqdim\\u00a0etamiz!\\u200b<\\/p><p><br><\\/p>"}'),
(14, 'about_site_archive', '{"uzbek_cyr":[{"title":"\\u041d\\u0438\\u043c\\u0430\\u0433\\u0430 \\u0430\\u0439\\u043d\\u0430\\u043d \\u0431\\u0438\\u0437?","content":"\\u0411\\u0438\\u0437\\u043d\\u0438 \\u0438\\u0436\\u0442\\u0438\\u043c\\u043e\\u0438\\u0439 \\u0442\\u0430\\u0440\\u043c\\u043e\\u049b\\u043b\\u0430\\u0440\\u0434\\u0430 20.000 \\u0434\\u0430\\u043d \\u043e\\u0440\\u0442\\u0438\\u049b \\u041a\\u043e\\u0441\\u043e\\u043d\\u0441\\u043e\\u0439\\u043b\\u0438\\u043a \\u043e\\u0431\\u0443\\u043d\\u0430\\u0447\\u0438\\u043b\\u0430\\u0440 \\u043a\\u0443\\u0437\\u0430\\u0442\\u0438\\u0431 \\u0431\\u043e\\u0440\\u0438\\u0448\\u0430\\u0434\\u0438. \\u04b2\\u043e\\u0437\\u0438\\u0440\\u0433\\u0430\\u0447\\u0430 \\u0431\\u0438\\u0437\\u043d\\u0438 \\u043a\\u0430\\u043d\\u0430\\u043b \\u0432\\u0430 \\u0441\\u0430\\u0439\\u0442\\u0438\\u043c\\u0438\\u0437 \\u043e\\u0440\\u049b\\u0430\\u043b\\u0438 \\u044e\\u0437\\u0434\\u0430\\u043d \\u043e\\u0440\\u0442\\u0438\\u049b \\u043c\\u0430\\u04b3\\u0441\\u0443\\u043b\\u043e\\u0442\\u043b\\u0430\\u0440 \\u045e\\u0437\\u043b\\u0430\\u0440\\u0438\\u043d\\u0438\\u043d\\u0433 \\u044f\\u043d\\u0433\\u0438 \\u044d\\u0433\\u0430\\u043b\\u0430\\u0440\\u0438\\u043d\\u0438 \\u0442\\u043e\\u043f\\u0438\\u0448\\u0433\\u0430 \\u0443\\u043b\\u0433\\u0443\\u0440\\u0438\\u0448\\u0433\\u0430\\u043d. \\u0411\\u0438\\u0437\\u0434\\u0430 \\u0442\\u0443\\u0440\\u043b\\u0438-\\u0445\\u0438\\u043b \\u0430\\u043a\\u0446\\u0438\\u044f \\u0432\\u0430 \\u0431\\u043e\\u043d\\u0443\\u0441\\u043b\\u0430\\u0440 \\u04b3\\u0430\\u043c \\u043c\\u0430\\u0432\\u0436\\u0443\\u0434.\\r"},{"title":"\\u041c\\u0430\\u049b\\u0441\\u0430\\u0434\\u0438\\u043c\\u0438\\u0437","content":"\\u041c\\u0438\\u0436\\u043e\\u0437\\u043b\\u0430\\u0440\\u0433\\u0430 \\u0430\\u0440\\u0437\\u043e\\u043d \\u0432\\u0430 \\u0441\\u0438\\u0444\\u0430\\u0442\\u043b\\u0438 \\u0440\\u0435\\u043a\\u043b\\u0430\\u043c\\u0430 \\u0445\\u0438\\u0437\\u043c\\u0430\\u0442\\u0438\\u043d\\u0438 \\u0442\\u0430\\u049b\\u0434\\u0438\\u043c \\u044d\\u0442\\u0438\\u0448. \\u041a\\u043e\\u0441\\u043e\\u043d\\u0441\\u043e\\u0439 \\u0442\\u0443\\u043c\\u0430\\u043d\\u0438\\u0434\\u0430 \\u043e\\u043d\\u043b\\u0430\\u0439\\u043d \\u043c\\u0430\\u0440\\u043a\\u0435\\u0442\\u0438\\u043d\\u0433 \\u04b3\\u0430\\u043c\\u0434\\u0430 \\u0444\\u043e\\u0439\\u0434\\u0430\\u043b\\u0438 \\u0438\\u043d\\u0442\\u0435\\u0440\\u043d\\u0435\\u0442 \\u0445\\u0438\\u0437\\u043c\\u0430\\u0442\\u043b\\u0430\\u0440\\u0438\\u043d\\u0438 \\u044f\\u043d\\u0430\\u0434\\u0430 \\u0440\\u0438\\u0432\\u043e\\u0436\\u043b\\u0430\\u043d\\u0442\\u0438\\u0440\\u0438\\u0448. \\u0422\\u0443\\u043c\\u0430\\u043d\\u0434\\u0430 \\u0431\\u0430\\u043d\\u0434\\u043b\\u0438\\u043a \\u0434\\u0430\\u0440\\u0430\\u0436\\u0430\\u0441\\u0438\\u043d\\u0438 \\u043e\\u0448\\u0438\\u0440\\u0438\\u0448 \\u0432\\u0430 \\u043a\\u045e\\u043f\\u043b\\u0430\\u0431 \\u044f\\u043d\\u0433\\u0438 \\u043b\\u043e\\u0439\\u0438\\u04b3\\u0430\\u043b\\u0430\\u0440\\u043d\\u0438 \\u0442\\u0430\\u049b\\u0434\\u0438\\u043c \\u044d\\u0442\\u0438\\u0448.\\r"},{"title":"\\u0420\\u0435\\u043a\\u043b\\u0430\\u043c\\u0430 \\u0431\\u0443","content":"\\u041c\\u0438\\u043d\\u0433\\u0434\\u0430\\u043d \\u043e\\u0440\\u0442\\u0438\\u049b \\u043c\\u0430\\u04b3\\u0441\\u0443\\u043b\\u043e\\u0442\\u043b\\u0430\\u0440\\u0438 \\u0431\\u045e\\u043b\\u0433\\u0430\\u043d \\u0447\\u0438\\u0440\\u043e\\u049b\\u0441\\u0438\\u0437 \\u0433\\u0438\\u043f\\u0435\\u0440\\u043c\\u0430\\u0440\\u043a\\u0435\\u0442\\u0434\\u0438\\u0440. \\u0414\\u045e\\u043a\\u043e\\u043d\\u0434\\u0430 \\u04b3\\u0430\\u043c\\u043c\\u0430 \\u043d\\u0430\\u0440\\u0441\\u0430 \\u0431\\u043e\\u0440 \\u0430\\u043c\\u043c\\u043e \\u04b3\\u0435\\u0447 \\u043a\\u0438\\u043c \\u043a\\u045e\\u0440\\u0430 \\u043e\\u043b\\u043c\\u0430\\u0439\\u0434\\u0438. \\u041a\\u045e\\u0440\\u043c\\u0430\\u0433\\u0430\\u043d\\u0434\\u0430\\u043d \\u043a\\u0435\\u0439\\u0438\\u043d \\u0430\\u043b\\u0431\\u0430\\u0442\\u0442\\u0430 \\u0441\\u043e\\u0442\\u0438\\u0431 \\u04b3\\u0430\\u043c \\u043e\\u043b\\u043e\\u043b\\u043c\\u0430\\u0439\\u0434\\u0438. \\u0427\\u0438\\u0440\\u043e\\u049b\\u043d\\u0438 \\u0451\\u049b\\u0438\\u043d\\u0433 \\u0432\\u0430 \\u0431\\u0438\\u0437\\u043d\\u0435\\u0441\\u0438\\u043d\\u0433\\u0438\\u0437\\u043d\\u0438 \\u0433\\u0443\\u043b\\u043b\\u0430\\u0431 \\u044f\\u0448\\u043d\\u0430\\u0442\\u0438\\u043d\\u0433."}],"uzbek_lt":[{"title":"Nimaga aynan biz?","content":"Bizni ijtimoiy tarmoqlarda 20.000 dan ortiq Kosonsoylik obunachilar kuzatib borishadi. Hozirgacha bizni kanal va saytimiz orqali yuzdan ortiq mahsulotlar o\\u02bbzlarining yangi egalarini topishga ulgurishgan. Bizda turli-xil aksiya va bonuslar ham mavjud.\\r"},{"title":"Maqsadimiz","content":"Mijozlarga arzon va sifatli reklama xizmatini taqdim etish. Kosonsoy tumanida onlayn marketing hamda foydali internet xizmatlarini yanada rivojlantirish. Tumanda bandlik darajasini oshirish va ko\\u02bbplab yangi loyihalarni taqdim etish.\\r"},{"title":"Reklama bu","content":"Mingdan ortiq mahsulotlari bo\\u02bblgan chiroqsiz gipermarketdir. Do\\u02bbkonda hamma narsa bor ammo hech kim ko\\u02bbra olmaydi. Ko\\u02bbrmagandan keyin albatta sotib ham ololmaydi. Chiroqni yoqing va biznesingizni gullab yashnating."}]}'),
(15, 'advertisement', '{"uzbek_cyr":"<p>\\u00abKosonsoymarket\\u00bb \\u044d\\u044a\\u043b\\u043e\\u043d\\u043b\\u0430\\u0440 \\u0442\\u0430\\u0445\\u0442\\u0430\\u0441\\u0438 \\u043f\\u043e\\u0440\\u0442\\u0430\\u043b\\u0438 \\u0442\\u0430\\u04b3\\u0440\\u0438\\u0440\\u0438\\u044f\\u0442\\u0438 \\u0432\\u0435\\u0431-\\u0441\\u0430\\u0439\\u0442\\u0434\\u0430 \\u0440\\u0435\\u043a\\u043b\\u0430\\u043c\\u0430 \\u0436\\u043e\\u0439\\u043b\\u0430\\u0448\\u0442\\u0438\\u0440\\u0438\\u0448 \\u0438\\u0441\\u0442\\u0430\\u0433\\u0438\\u0434\\u0430 \\u0431\\u045e\\u043b\\u0433\\u0430\\u043d \\u0436\\u0438\\u0441\\u043c\\u043e\\u043d\\u0438\\u0439 \\u0432\\u0430 \\u044e\\u0440\\u0438\\u0434\\u0438\\u043a \\u0448\\u0430\\u0445\\u0441\\u043b\\u0430\\u0440\\u0433\\u0430 \\u045e\\u0437\\u0430\\u0440\\u043e \\u043c\\u0430\\u043d\\u0444\\u0430\\u0430\\u0442\\u043b\\u0438 \\u0448\\u0430\\u0440\\u0442\\u043b\\u0430\\u0440 \\u0430\\u0441\\u043e\\u0441\\u0438\\u0434\\u0430 \\u04b3\\u0430\\u043c\\u043a\\u043e\\u0440\\u043b\\u0438\\u043a\\u043d\\u0438 \\u0442\\u0430\\u043a\\u043b\\u0438\\u0444 \\u044d\\u0442\\u0430\\u0434\\u0438.<\\/p><p>\\u041a\\u045e\\u0440\\u0441\\u0430\\u0442\\u0438\\u043b\\u0430\\u0434\\u0438\\u0433\\u0430\\u043d \\u0440\\u0435\\u043a\\u043b\\u0430\\u043c\\u0430 \\u0445\\u0438\\u0437\\u043c\\u0430\\u0442\\u043b\\u0430\\u0440\\u0438\\u043d\\u0438\\u043d\\u0433 \\u0442\\u0443\\u0440\\u043b\\u0430\\u0440\\u0438 \\u0432\\u0430 \\u043d\\u0430\\u0440\\u0445\\u043b\\u0430\\u0440\\u0438, \\u0448\\u0443\\u043d\\u0438\\u043d\\u0433\\u0434\\u0435\\u043a, \\u0431\\u0443 \\u0431\\u043e\\u0440\\u0430\\u0434\\u0430 \\u045e\\u0437\\u0438\\u043d\\u0433\\u0438\\u0437\\u043d\\u0438 \\u049b\\u0438\\u0437\\u0438\\u049b\\u0442\\u0438\\u0440\\u0433\\u0430\\u043d \\u0431\\u043e\\u0448\\u049b\\u0430 \\u0441\\u0430\\u0432\\u043e\\u043b\\u043b\\u0430\\u0440\\u0433\\u0430\\u00a0<a href=\\"mailto:reklama@xabar.uz\\" target=\\"_blank\\">support@kosonsoymarket.uz<\\/a>\\u00a0\\u044d\\u043b\\u0435\\u043a\\u0442\\u0440\\u043e\\u043d \\u043c\\u0430\\u043d\\u0437\\u0438\\u043b\\u0438\\u0433\\u0430\\u00a0\\u0445\\u0430\\u0442 \\u0451\\u0437\\u0438\\u0431 \\u0451\\u043a\\u0438 (+99894) 277-77-97 \\u0440\\u0430\\u049b\\u0430\\u043c\\u043b\\u0430\\u0440\\u0438\\u0433\\u0430 \\u049b\\u045e\\u043d\\u0493\\u0438\\u0440\\u043e\\u049b \\u049b\\u0438\\u043b\\u0438\\u0431 \\u0436\\u0430\\u0432\\u043e\\u0431 \\u043e\\u043b\\u0438\\u0448\\u0438\\u043d\\u0433\\u0438\\u0437 \\u043c\\u0443\\u043c\\u043a\\u0438\\u043d. \\u0424\\u0430\\u043e\\u043b\\u0438\\u044f\\u0442\\u0438\\u043c\\u0438\\u0437 \\u00ab\\u0420\\u0435\\u043a\\u043b\\u0430\\u043c\\u0430 \\u0442\\u045e\\u0493\\u0440\\u0438\\u0441\\u0438\\u0434\\u0430\\u00bb\\u0433\\u0438 \\u049b\\u043e\\u043d\\u0443\\u043d \\u0432\\u0430 \\u0431\\u043e\\u0448\\u049b\\u0430 \\u043d\\u043e\\u0440\\u043c\\u0430\\u0442\\u0438\\u0432-\\u04b3\\u0443\\u049b\\u0443\\u049b\\u0438\\u0439 \\u04b3\\u0443\\u0436\\u0436\\u0430\\u0442\\u043b\\u0430\\u0440\\u0433\\u0430 \\u0430\\u0441\\u043e\\u0441\\u043b\\u0430\\u043d\\u0433\\u0430\\u043d.<\\/p><p>\\u0414\\u043e\\u0438\\u043c\\u0438\\u0439 \\u043c\\u0438\\u0436\\u043e\\u0437\\u043b\\u0430\\u0440\\u0433\\u0430 \\u0432\\u0430 \\u0443\\u0437\\u043e\\u049b \\u043c\\u0443\\u0434\\u0434\\u0430\\u0442\\u043b\\u0438 \\u0440\\u0435\\u043a\\u043b\\u0430\\u043c\\u0430 \\u0431\\u0435\\u0440\\u0443\\u0432\\u0447\\u0438\\u043b\\u0430\\u0440\\u0433\\u0430 \\u0447\\u0435\\u0433\\u0438\\u0440\\u043c\\u0430\\u043b\\u0430\\u0440 \\u0431\\u0435\\u0440\\u0438\\u043b\\u0430\\u0434\\u0438.<\\/p>","uzbek_lt":"<p>\\u00abKosonsoymarket\\u00bb e\\u2019lonlar taxtasi portali tahririyati veb-saytda reklama joylasahtirish istagida bo\\u2018lgan jismoniy va yuridik shaxslarga o\\u2018zaro manfaatli shartlar asosida hamkorlikni taklif etadi.<\\/p><p>Ko\\u2018rsatiladigan reklama xizmatlarining turlari va narxlari, shuningdek, bu borada o\\u2018zingizni qiziqtirgan boshqa savollarga <a href=\\"mailto:reklama@xabar.uz\\">support@kosonsoymarket.uz<\\/a> elektron manziliga xat yozib yoki (+99894) 277 77-97 raqamlariga qo\\u2018ng\\u2018iroq qilib javob olishingiz mumkin. Faoliyatimiz \\u00abReklama to\\u2018g\\u2018risida\\u00bbgi qonun va boshqa normativ-huquqiy hujjatlarga asoslangan.<\\/p><p>Doimiy mijozlarga va uzoq muddatli reklama beruvchilarga chegirmalar beriladi.<\\/p>"}'),
(16, 'how_it_work', '{"title":{"uzbek_cyr":"\\u0411\\u0443 \\u049b\\u0430\\u043d\\u0434\\u0430\\u0439 \\u0441\\u0430\\u0439\\u0442? ","uzbek_lt":"Bu qanday sayt? "},"subtitle":{"uzbek_cyr":"\\u0421\\u0438\\u0437\\u0433\\u0430 \\u043c\\u0430\\u0445\\u0441\\u0443\\u043b\\u043e\\u0442 \\u0441\\u043e\\u0442\\u0438\\u0448\\u0434\\u0430 \\u0432\\u0430 \\u043e\\u043b\\u0438\\u0448\\u0434\\u0430 \\u043a\\u045e\\u043c\\u0430\\u043a\\u043b\\u0430\\u0448\\u0443\\u0432\\u0447\\u0438 \\u041a\\u043e\\u0441\\u043e\\u043d\\u0441\\u043e\\u0439\\u0434\\u0430\\u0433\\u0438 \\u044d\\u043d\\u0433 \\u0439\\u0438\\u0440\\u0438\\u043a \\u043e\\u043d\\u043b\\u0430\\u0439\\u043d \\u0431\\u043e\\u0437\\u043e\\u0440. ","uzbek_lt":"Sizga maxsulot sotishsa va olishda ko\\u2018maklashuvchi Kosonsoydagi eng yirik onlayn bozor"},"content":{"uzbek_cyr":[{"icon":"flaticon-megaphone","title":"\\u0411\\u0438\\u0437\\u0434\\u0430 \\u044d\\u044a\\u043b\\u043e\\u043d \\u0431\\u0435\\u0440\\u0438\\u0448","subtitle":"\\u0421\\u0430\\u0439\\u0442\\u0434\\u0430\\u0433\\u0438 \\u042d\\u044a\\u043b\\u043e\\u043d \\u0436\\u043e\\u0439\\u043b\\u0430\\u0448 \\u0431\\u045e\\u043b\\u0438\\u043c\\u0438 \\u043e\\u0440\\u049b\\u0430\\u043b\\u0438 \\u043c\\u0443\\u0441\\u0442\\u0430\\u049b\\u0438\\u043b \\u0440\\u0430\\u0432\\u0438\\u0448\\u0434\\u0430 \\u0451\\u043a\\u0438 \\u043e\\u043f\\u0435\\u0440\\u0430\\u0442\\u043e\\u0440\\u043b\\u0430\\u0440\\u0438\\u043c\\u0438\\u0437 \\u0451\\u0440\\u0434\\u0430\\u043c\\u0438\\u0434\\u0430 \\u0443\\u043b\\u0430\\u0440\\u043d\\u0438\\u043d\\u0433 \\u0442\\u0435\\u043b\\u0435\\u0433\\u0440\\u0430\\u043c \\u043f\\u0440\\u043e\\u0444\\u0438\\u043b\\u0438 \\u04b3\\u0430\\u043c\\u0434\\u0430 \\u0442\\u0435\\u043b\\u0435\\u0444\\u043e\\u043d \\u0440\\u0430\\u049b\\u0430\\u043c\\u0438 \\u043e\\u0440\\u049b\\u0430\\u043b\\u0438 \\u0431\\u043e\\u0493\\u043b\\u0430\\u043d\\u0433\\u0430\\u043d \\u04b3\\u043e\\u043b\\u0434\\u0430 \\u0436\\u043e\\u0439\\u043b\\u0430\\u0448\\u0442\\u0438\\u0440\\u0438\\u0448\\u0438\\u043d\\u0438\\u0433\\u0438\\u0437 \\u043c\\u0443\\u043c\\u043a\\u0443\\u043d."},{"icon":"flaticon-internet-1","title":"\\u049a\\u0443\\u043b\\u0430\\u0439\\u043b\\u0438\\u043a\\u043b\\u0430\\u0440\\u0438\\u043c\\u0438\\u0437","subtitle":"\\u0421\\u0438\\u0437\\u0434\\u0430 \\u0438\\u0436\\u0442\\u0438\\u043c\\u043e\\u0438\\u0439 \\u0442\\u0430\\u0440\\u043c\\u043e\\u049b\\u043b\\u0430\\u0440\\u0434\\u0430 20.000 \\u0434\\u0430\\u043d \\u043e\\u0440\\u0442\\u0438\\u049b \\u043e\\u0431\\u0443\\u043d\\u0430\\u0447\\u0438\\u0433\\u0430 \\u044d\\u0433\\u0430 \\u0431\\u045e\\u043b\\u0433\\u0430\\u043d \\u041a\\u043e\\u0441\\u043e\\u043d\\u0441\\u043e\\u0439\\u0434\\u0430\\u0433\\u0438 \\u044d\\u043d\\u0433 \\u0439\\u0438\\u0440\\u0438\\u043a @\\u041a\\u043e\\u0441\\u043e\\u043d\\u0441\\u043e\\u0439\\u043b\\u0438\\u043a\\u043b\\u0430\\u0440_\\u0423\\u0437 \\u04b3\\u0430\\u043c\\u0434\\u0430 @\\u041a\\u043e\\u0441\\u043e\\u043d\\u0441\\u043e\\u0439\\u043c\\u0430\\u0440\\u043a\\u0435\\u0442\\u0443\\u0437 \\u043a\\u0430\\u043d\\u0430\\u043b\\u043b\\u0430\\u0440\\u0438\\u0434\\u0430 \\u044d\\u044a\\u043b\\u043e\\u043d \\u0431\\u0435\\u0440\\u0438\\u0448 \\u0438\\u043c\\u043a\\u043e\\u043d\\u0438\\u044f\\u0442\\u0438 \\u04b3\\u0430\\u043c \\u0431\\u043e\\u0440. \\u0421\\u0430\\u0439\\u0442\\u043d\\u0438\\u043d\\u0433 \\u0430\\u0444\\u0437\\u0430\\u043b\\u043b\\u0438\\u0433\\u0438 \\u044d\\u0441\\u0430 \\u0445\\u0430\\u0440\\u0438\\u0434\\u043e\\u0440\\u043b\\u0430\\u0440 \\u0441\\u043e\\u0442\\u0438\\u0431 \\u043e\\u043b\\u043c\\u043e\\u049b\\u0447\\u0438 \\u0431\\u045e\\u043b\\u0433\\u0430\\u043d \\u043c\\u0430\\u04b3\\u0441\\u0443\\u043b\\u043e\\u0442\\u0438\\u043d\\u0438 \\u043e\\u0441\\u043e\\u043d \\u0442\\u043e\\u043f\\u0430 \\u043e\\u043b\\u0438\\u0448\\u0438\\u0434\\u0430\\u0434\\u0438\\u0440."},{"icon":"flaticon-money","title":"\\u0422\\u045e\\u043b\\u043e\\u0432 \\u0443\\u0441\\u0443\\u043b\\u043b\\u0430\\u0440\\u0438","subtitle":"\\u0421\\u0438\\u0437\\u0434\\u0430 \\u0438\\u0441\\u0442\\u0430\\u043b\\u0433\\u0430\\u043d \\u0443\\u0441\\u0443\\u043b\\u0434\\u0430 \\u0431\\u0438\\u0437\\u0433\\u0430 \\u0442\\u045e\\u043b\\u043e\\u0432 \\u049b\\u0438\\u043b\\u0438\\u0448 \\u0438\\u043c\\u043a\\u043e\\u043d\\u0438\\u044f\\u0442\\u0438 \\u043c\\u0430\\u0432\\u0436\\u0443\\u0434. \\u041e\\u0444\\u0444\\u0438\\u0441\\u0438\\u043c\\u0438\\u0437\\u0433\\u0430 \\u0442\\u0430\\u0448\\u0440\\u0438\\u0444 \\u0431\\u0443\\u044e\\u0440\\u0433\\u0430\\u043d \\u04b3\\u043e\\u043b\\u0434\\u0430 \\u043d\\u0430\\u0445\\u0442 \\u0442\\u045e\\u043b\\u0430\\u0448, \\u0451\\u043a\\u0438 \\u043c\\u0430\\u0441\\u043e\\u0444\\u0430\\u0434\\u0430\\u043d \\u0442\\u0443\\u0440\\u0438\\u0431 c\\u043b\\u0438c\\u043a, \\u043f\\u0430\\u0439\\u043d\\u0435\\u0442 \\u0439\\u045e\\u043b\\u043b\\u0430\\u0440\\u0438 \\u043e\\u0440\\u049b\\u0430\\u043b\\u0438 \\u04b3\\u0430\\u043c \\u0438\\u0448\\u0438\\u043d\\u0433\\u0438\\u0437\\u043d\\u0438 \\u0431\\u0438\\u0442\\u0438\\u0440\\u0438\\u0448 \\u0438\\u043c\\u043a\\u043e\\u043d\\u0438\\u044f\\u0442\\u0438\\u043d\\u0438 \\u0442\\u0430\\u049b\\u0434\\u0438\\u043c \\u044d\\u0442\\u0430\\u043c\\u0438\\u0437."}],"uzbek_lt":[{"icon":"flaticon-megaphone","title":"Bizda e\\u02bclon berish","subtitle":"Saytdagi E\\u02bclon joylash bo\\u02bblimi orqali mustaqil ravishda yoki operatorlarimiz yordamida ularning telegram profili hamda telefon raqami orqali bog\\u02bblangan holda joylashtirishinigiz mumkun."},{"icon":"flaticon-people-2","title":"Qulayliklarimiz","subtitle":"Sizda ijtimoiy tarmoqlarda 20.000 dan ortiq obunachiga ega bo\\u02bblgan Kosonsoydagi eng yirik @Kosonsoyliklar_Uz hamda @Kosonsoymarketuz kanallarida e\\u02bclon berish imkoniyati ham bor. Saytning afzalligi esa xaridorlar sotib olmoqchi bo\\u02bblgan mahsulotini oson topa olishidadir."},{"icon":"flaticon-money","title":"To\\u02bblov usullari","subtitle":"Sizda istalgan usulda bizga to''lov qilish imkoniyati mavjud. Offisimizga tashrif buyurgan holda naxt to''lash, yoki masofadan turib click, paynet yo''llari orqali ham ishingizni bitirish imkoniyatini taqdim etamiz. "}]}}'),
(17, 'bot_settings', '{"bot":{"token":"sizningtokeningiz","username":"@telegrambot"},"channels":[{"name":"Birnarsa market","username":"@birnarsamarketkanal"}]}'),
(18, 'app_token', 'sizningtokeningiz');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `permissions` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `fullname`, `role`, `permissions`, `status`) VALUES
(1, 'Manuchehr', 'f112f1f2a76aa475e0d34b5a3dbc2698dc841c0a', 'Manuchehr Usmonov', 'Superadmin', '["all","contacts","notifications","posts","news","partners","pricing","sections","settings","users","stats"]', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `visitors`
--

CREATE TABLE IF NOT EXISTS `visitors` (
  `visitor_id` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `country_code` varchar(255) NOT NULL,
  `country_name` varchar(255) NOT NULL,
  `region_name` varchar(255) NOT NULL,
  `country` text NOT NULL,
  `location` text NOT NULL,
  `ua_string` text NOT NULL,
  `platform_type` varchar(255) NOT NULL,
  `platform` varchar(255) NOT NULL,
  `device` varchar(255) NOT NULL,
  `device_image` varchar(255) NOT NULL,
  `device_brand` varchar(255) NOT NULL,
  `device_model` varchar(255) NOT NULL,
  `os_image` varchar(255) NOT NULL,
  `os` varchar(255) NOT NULL,
  `os_name` varchar(255) NOT NULL,
  `os_version` varchar(255) NOT NULL,
  `browser_image` varchar(255) NOT NULL,
  `browser` varchar(255) NOT NULL,
  `browser_name` varchar(255) NOT NULL,
  `browser_version` varchar(255) NOT NULL,
  `page` varchar(255) NOT NULL,
  `referrer` text NOT NULL,
  `date` bigint(22) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=19636 DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Индексы таблицы `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`contact_id`);

--
-- Индексы таблицы `filters`
--
ALTER TABLE `filters`
  ADD PRIMARY KEY (`filter_id`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`);

--
-- Индексы таблицы `news_category`
--
ALTER TABLE `news_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Индексы таблицы `news_comments`
--
ALTER TABLE `news_comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Индексы таблицы `news_replies`
--
ALTER TABLE `news_replies`
  ADD PRIMARY KEY (`replie_id`);

--
-- Индексы таблицы `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`partner_id`);

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Индексы таблицы `post_images`
--
ALTER TABLE `post_images`
  ADD PRIMARY KEY (`image_id`);

--
-- Индексы таблицы `pricing`
--
ALTER TABLE `pricing`
  ADD PRIMARY KEY (`price_id`);

--
-- Индексы таблицы `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`setting_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Индексы таблицы `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`visitor_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT для таблицы `contacts`
--
ALTER TABLE `contacts`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT для таблицы `filters`
--
ALTER TABLE `filters`
  MODIFY `filter_id` bigint(22) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `news_category`
--
ALTER TABLE `news_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `news_comments`
--
ALTER TABLE `news_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `news_replies`
--
ALTER TABLE `news_replies`
  MODIFY `replie_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `partners`
--
ALTER TABLE `partners`
  MODIFY `partner_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=119;
--
-- AUTO_INCREMENT для таблицы `post_images`
--
ALTER TABLE `post_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=158;
--
-- AUTO_INCREMENT для таблицы `pricing`
--
ALTER TABLE `pricing`
  MODIFY `price_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `settings`
--
ALTER TABLE `settings`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `visitors`
--
ALTER TABLE `visitors`
  MODIFY `visitor_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19636;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
