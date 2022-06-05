-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Июн 05 2022 г., 23:43
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `medicalcard`
--

-- --------------------------------------------------------

--
-- Структура таблицы `anamnesis`
--

CREATE TABLE IF NOT EXISTS `anamnesis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `anamnesis_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `anamnesis`
--

INSERT INTO `anamnesis` (`id`, `anamnesis_name`) VALUES
(1, 'Снижение остроты зрения с детства');

-- --------------------------------------------------------

--
-- Структура таблицы `complaints`
--

CREATE TABLE IF NOT EXISTS `complaints` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'номер жалобы',
  `complaint` varchar(255) NOT NULL COMMENT 'жалоба',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `complaints`
--

INSERT INTO `complaints` (`id`, `complaint`) VALUES
(1, 'Снижение остроты зрения'),
(2, 'Помутнение роговицы (косметический дефект)');

-- --------------------------------------------------------

--
-- Структура таблицы `conclusions`
--

CREATE TABLE IF NOT EXISTS `conclusions` (
  `id_conclusion` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `filepath` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  PRIMARY KEY (`id_conclusion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `diagnoses`
--

CREATE TABLE IF NOT EXISTS `diagnoses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `diagnosis` varchar(255) NOT NULL,
  `code` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `diagnoses`
--

INSERT INTO `diagnoses` (`id`, `diagnosis`, `code`) VALUES
(1, 'Гиперметропия', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `disease_code`
--

CREATE TABLE IF NOT EXISTS `disease_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `disease_code`
--

INSERT INTO `disease_code` (`id`, `code`) VALUES
(1, 'T.85.2'),
(2, 'H.26.2');

-- --------------------------------------------------------

--
-- Структура таблицы `histories`
--

CREATE TABLE IF NOT EXISTS `histories` (
  `id_patient` int(11) NOT NULL AUTO_INCREMENT,
  `id_conclusion` int(11) NOT NULL,
  PRIMARY KEY (`id_patient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `patients`
--

CREATE TABLE IF NOT EXISTS `patients` (
  `id_patient` int(11) NOT NULL AUTO_INCREMENT,
  `FIO` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  PRIMARY KEY (`id_patient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `relations`
--

CREATE TABLE IF NOT EXISTS `relations` (
  `id_anamnesis` int(11) NOT NULL,
  `id_complain` int(11) NOT NULL,
  `id_diagnoses` int(11) NOT NULL,
  KEY `id_anamnesis` (`id_anamnesis`),
  KEY `id_complain` (`id_complain`),
  KEY `id_diagnoses` (`id_diagnoses`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `relations`
--

INSERT INTO `relations` (`id_anamnesis`, `id_complain`, `id_diagnoses`) VALUES
(1, 1, 1),
(1, 2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `somatic_diag`
--

CREATE TABLE IF NOT EXISTS `somatic_diag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `diagnosis` varchar(255) NOT NULL,
  `code` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `somatic_diag`
--

INSERT INTO `somatic_diag` (`id`, `diagnosis`, `code`) VALUES
(1, 'Сахарный диабет инсулиннезависимый', 2);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `diagnoses`
--
ALTER TABLE `diagnoses`
  ADD CONSTRAINT `diagnoses_ibfk_1` FOREIGN KEY (`code`) REFERENCES `disease_code` (`id`);

--
-- Ограничения внешнего ключа таблицы `relations`
--
ALTER TABLE `relations`
  ADD CONSTRAINT `relations_ibfk_1` FOREIGN KEY (`id_anamnesis`) REFERENCES `anamnesis` (`id`),
  ADD CONSTRAINT `relations_ibfk_2` FOREIGN KEY (`id_complain`) REFERENCES `complaints` (`id`),
  ADD CONSTRAINT `relations_ibfk_3` FOREIGN KEY (`id_diagnoses`) REFERENCES `diagnoses` (`id`);

--
-- Ограничения внешнего ключа таблицы `somatic_diag`
--
ALTER TABLE `somatic_diag`
  ADD CONSTRAINT `somatic_diag_ibfk_1` FOREIGN KEY (`code`) REFERENCES `disease_code` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
