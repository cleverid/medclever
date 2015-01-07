-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Янв 06 2015 г., 16:06
-- Версия сервера: 5.5.38-0+wheezy1
-- Версия PHP: 5.4.36-0+deb7u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `physiolab`
--

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1420401840),
('m130524_201442_init', 1420401850),
('m141228_105237_create_rubric_table', 1420403355);

-- --------------------------------------------------------

--
-- Структура таблицы `rubric`
--

CREATE TABLE IF NOT EXISTS `rubric` (
`id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Имя',
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'URL адрес страницы',
  `description` text COLLATE utf8_unicode_ci COMMENT 'Описание',
  `meta_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'SEO заголовок (title)',
  `meta_description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'SEO описание (meta description)',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Время создания',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Время обновления'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `rubric`
--

INSERT INTO `rubric` (`id`, `name`, `url`, `description`, `meta_title`, `meta_description`, `created_at`, `updated_at`) VALUES
(1, 'Проекты', 'projects', 'Проекты', 'Проекты', 'Проекты', '2015-01-04 20:32:01', '2015-01-04 20:32:01'),
(2, 'Публикации', 'publikacii', '', 'Публикации', 'Публикации', '2015-01-04 20:33:19', '2015-01-04 20:33:32'),
(3, 'Интеллектуальная собственность', 'intellektualnaja-sobstvennost', '', 'Интеллектуальная собственность', 'Интеллектуальная собственность', '2015-01-04 20:35:03', '2015-01-04 20:35:03'),
(4, 'Наши успехи', 'nashi-uspehi', '', 'Наши успехи', 'Наши успехи', '2015-01-04 20:35:47', '2015-01-04 20:35:47'),
(5, 'Оборудование', 'oborudovanie', '', 'Оборудование', 'Оборудование', '2015-01-04 20:36:54', '2015-01-04 20:36:54'),
(6, 'О нас', 'o-nas', '', 'О нас', 'О нас', '2015-01-04 20:37:18', '2015-01-04 20:37:18'),
(7, 'Контакты', 'kontakty', '', 'Контакты', 'Контакты', '2015-01-04 20:37:49', '2015-01-04 20:37:49');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` smallint(6) NOT NULL DEFAULT '10',
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `role`, `status`, `created_at`, `updated_at`) VALUES
(1, 'eawapownikov', 'puy2MWlaQaLZc8OEEkD54HuEN-q2lWxo', '$2y$13$bGloUnqJNIQYYDSgMmlxFu2pQ1xFtBrerTSR9doqUtw.7.K5Rs5FW', NULL, 'eawapownikov@gmail.com', 10, 10, 1419761131, 1419761131);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
 ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `rubric`
--
ALTER TABLE `rubric`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `rubric`
--
ALTER TABLE `rubric`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
