-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 07 2022 г., 05:04
-- Версия сервера: 8.0.24
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `medical_card`
--

-- --------------------------------------------------------

--
-- Структура таблицы `anamnesis`
--

CREATE TABLE `anamnesis` (
  `id` int NOT NULL,
  `anamnesis_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `anamnesis`
--

INSERT INTO `anamnesis` (`id`, `anamnesis_name`) VALUES
(1, 'Снижение остроты зрения с детства'),
(4, 'Диплопия'),
(6, 'Роговица прозрачная'),
(7, 'Радужка субатрофична'),
(8, 'Атрофия зрачковой каймы'),
(9, 'Роговица с потемнениями'),
(10, 'Движение глаз ограничено'),
(11, 'Движение глаз в полном объёме'),
(12, 'Веки спокойные'),
(13, 'Веки гиперемированы');

-- --------------------------------------------------------

--
-- Структура таблицы `complaints`
--

CREATE TABLE `complaints` (
  `id` int NOT NULL COMMENT 'номер жалобы',
  `complaint` varchar(255) NOT NULL COMMENT 'жалоба'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `complaints`
--

INSERT INTO `complaints` (`id`, `complaint`) VALUES
(1, 'Снижение остроты зрения'),
(2, 'Помутнение роговицы (косметический дефект)'),
(3, 'Диплопия'),
(4, 'Светобоязнь'),
(5, 'Обильноё слёзоотделение'),
(6, 'Метаморфопсия'),
(7, 'Мерцательная скотома'),
(8, 'Нарушение цветового зрения'),
(9, 'Фотопсия');

-- --------------------------------------------------------

--
-- Структура таблицы `conclusions`
--

CREATE TABLE `conclusions` (
  `id_conclusion` int NOT NULL,
  `date` date NOT NULL,
  `filepath` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `diagnoses`
--

CREATE TABLE `diagnoses` (
  `id` int NOT NULL,
  `diagnosis` varchar(255) NOT NULL,
  `code` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='диагнозы';

--
-- Дамп данных таблицы `diagnoses`
--

INSERT INTO `diagnoses` (`id`, `diagnosis`, `code`) VALUES
(1, 'Гиперметропия', 1),
(2, 'Астигматизм', 3),
(3, 'Атрофия зрительного нерва', 4),
(4, 'Кератоконъюнктивит', 5),
(5, 'Эписклерит', 6),
(6, 'Дальтонизм', 11),
(7, 'Болезнь радужной оболочки и цилиарного тела неуточненная', 13),
(8, 'Деформация глазницы', 12),
(9, 'Миопия', 14);

-- --------------------------------------------------------

--
-- Структура таблицы `disease_code`
--

CREATE TABLE `disease_code` (
  `id` int NOT NULL,
  `code` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `disease_code`
--

INSERT INTO `disease_code` (`id`, `code`) VALUES
(1, 'T.85.2'),
(2, 'H.26.2'),
(3, 'H52.2'),
(4, 'Н47.2'),
(5, 'H16.2'),
(6, 'H15.1'),
(7, 'I10'),
(8, 'I11.0'),
(9, 'E83.0'),
(10, 'I11.9'),
(11, 'H53.5'),
(12, 'H05.3'),
(13, 'H21.9'),
(14, 'H52.1');

-- --------------------------------------------------------

--
-- Структура таблицы `histories`
--

CREATE TABLE `histories` (
  `id_patient` int NOT NULL,
  `id_conclusion` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `patients`
--

CREATE TABLE `patients` (
  `id_patient` int NOT NULL,
  `FIO` varchar(255) NOT NULL,
  `birthdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `patients`
--

INSERT INTO `patients` (`id_patient`, `FIO`, `birthdate`) VALUES
(1, 'Носачёв Давид Егорович', '1976-08-03'),
(2, 'Ярыгин Аркадий Михайлович', '1962-10-22'),
(3, 'Шалимова Вероника Ивановна', '1979-01-15'),
(4, 'Немцев Георгий Семенович', '1984-08-04'),
(5, 'Хромова Ульяна Ивановна', '1982-01-24'),
(6, 'Сталин Георгий Геннадьевич', '1974-06-05');

-- --------------------------------------------------------

--
-- Структура таблицы `relations`
--

CREATE TABLE `relations` (
  `id_anamnesis` int NOT NULL,
  `id_complain` int NOT NULL,
  `id_diagnoses` int NOT NULL
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

CREATE TABLE `somatic_diag` (
  `id` int NOT NULL,
  `diagnosis` varchar(255) NOT NULL,
  `code` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `somatic_diag`
--

INSERT INTO `somatic_diag` (`id`, `diagnosis`, `code`) VALUES
(1, 'Сахарный диабет инсулиннезависимый', 2),
(2, 'Эссенциальная [первичная] гипертензия', 7),
(3, 'Гипертензивная [гипертоническая] болезнь с преимущественным поражением сердца с (застойной) сердечной недостаточностью', 8),
(4, 'Гипертензивная [гипертоническая] болезнь с преимущественным поражением сердца с (застойной) сердечной недостаточностью', 10),
(5, 'Болезнь Вильсона', 9);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `anamnesis`
--
ALTER TABLE `anamnesis`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `conclusions`
--
ALTER TABLE `conclusions`
  ADD PRIMARY KEY (`id_conclusion`);

--
-- Индексы таблицы `diagnoses`
--
ALTER TABLE `diagnoses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `code` (`code`);

--
-- Индексы таблицы `disease_code`
--
ALTER TABLE `disease_code`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `histories`
--
ALTER TABLE `histories`
  ADD KEY `id_conclusion` (`id_conclusion`),
  ADD KEY `id_patient` (`id_patient`) USING BTREE;

--
-- Индексы таблицы `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id_patient`);

--
-- Индексы таблицы `relations`
--
ALTER TABLE `relations`
  ADD KEY `id_anamnesis` (`id_anamnesis`),
  ADD KEY `id_complain` (`id_complain`),
  ADD KEY `id_diagnoses` (`id_diagnoses`);

--
-- Индексы таблицы `somatic_diag`
--
ALTER TABLE `somatic_diag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `code` (`code`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `anamnesis`
--
ALTER TABLE `anamnesis`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'номер жалобы', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `conclusions`
--
ALTER TABLE `conclusions`
  MODIFY `id_conclusion` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `diagnoses`
--
ALTER TABLE `diagnoses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `disease_code`
--
ALTER TABLE `disease_code`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `histories`
--
ALTER TABLE `histories`
  MODIFY `id_patient` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `patients`
--
ALTER TABLE `patients`
  MODIFY `id_patient` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `somatic_diag`
--
ALTER TABLE `somatic_diag`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `diagnoses`
--
ALTER TABLE `diagnoses`
  ADD CONSTRAINT `diagnoses_ibfk_1` FOREIGN KEY (`code`) REFERENCES `disease_code` (`id`);

--
-- Ограничения внешнего ключа таблицы `histories`
--
ALTER TABLE `histories`
  ADD CONSTRAINT `histories_ibfk_1` FOREIGN KEY (`id_patient`) REFERENCES `patients` (`id_patient`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `histories_ibfk_2` FOREIGN KEY (`id_conclusion`) REFERENCES `conclusions` (`id_conclusion`) ON DELETE RESTRICT ON UPDATE RESTRICT;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
