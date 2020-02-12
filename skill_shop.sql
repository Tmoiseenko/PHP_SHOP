-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 12 2020 г., 20:59
-- Версия сервера: 10.3.13-MariaDB-log
-- Версия PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `skill_shop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Женщины'),
(2, 'Мужчины'),
(3, 'Дети'),
(4, 'Сумки'),
(5, 'Аксессуары');

-- --------------------------------------------------------

--
-- Структура таблицы `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `admin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `menu`
--

INSERT INTO `menu` (`id`, `name`, `url`, `admin`) VALUES
(1, 'Главная', '/', 0),
(2, 'Новинки', '/?new=true', 0),
(3, 'Sale', '/?sale=true', 0),
(4, 'Доставка', '/delivery', 0),
(5, 'Товары', '/admin/products', 1),
(6, 'Заказы', '/admin/orders', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `coast` int(11) NOT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `third_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `shipping_method` varchar(255) NOT NULL,
  `city` varchar(255) DEFAULT NULL,
  `street` varchar(255) NOT NULL,
  `home` varchar(255) NOT NULL,
  `apartament` varchar(255) DEFAULT NULL,
  `payment_method` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `status` tinyint(1) DEFAULT 0,
  `create_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `product_id`, `coast`, `surname`, `name`, `third_name`, `phone`, `email`, `shipping_method`, `city`, `street`, `home`, `apartament`, `payment_method`, `comment`, `status`, `create_date`) VALUES
(1, 66, 4850, 'Моисеенко', 'Тимур', 'Fsretyumb', '+9989846846', 'tim@mail.ru', 'method_1', 'NY', 'рапр', '45', '543', 'Кредитной картой', '2890oiuyhgf', 1, '2019-12-15 20:03:34'),
(10, 73, 63000, 'Gross', 'павпвкпк', 'Fsretyumb', '+9989846846', 'tim@mail.ru', 'method_0', '', '', '', '', 'Наличные', '', 1, '2020-01-01 20:03:34'),
(13, 74, 18600, 'Gross', 'павпвкпк', 'Fsretyumb', '+9989846846', 'tim@mail.ru', 'method_0', '', '', '', '', 'Кредитной картой', '', 0, '2020-01-02 20:03:34'),
(14, 73, 63000, 'Gross', 'Моисеенко', 'Fsretyumb', '+9989846846', 'tim@mail.ru', 'method_0', '', '', '', '', 'Наличные', '', 1, '2019-01-12 20:03:34'),
(18, 66, 4850, 'Gross', 'Моисеенко', 'Fsretyumb', '+9989846846', 'tim@mail.ru', 'method_0', '', '', '', '', 'Наличные', '', 1, '2019-07-28 20:03:34'),
(19, 66, 4850, 'аппва', 'Моисеенко', 'Fsretyumb', '+9989846846', 'angr@ydex.ru', 'method_1', 'NY', 'lasvega', '45', '543', 'Кредитной картой', 'jhgfdsa345678', 0, '2020-01-03 20:03:34'),
(20, 76, 4000, 'аппва', 'wetyui', '', '+9989846846', 'angrav-6@yandex.ru', 'method_0', '', '', '', '', 'Банковский перевод', '', 0, '2020-01-09 20:03:34'),
(21, 73, 63000, 'аппва', '345678uytgfdsdf', '', '+9989846846', 'angrav-6@yandex.ru', 'method_0', '', '', '', '', 'Кредитной картой', '', 0, '2020-01-12 20:03:34'),
(22, 73, 63000, 'Моисеенко', 'Моисеенко', '', '+9989846846', 'angrav-6@yandex.ru', 'method_2', 'Ташкент', '24 Амир Темур шоҳ кўчаси', '345', '32', 'Банковский перевод', '', 1, '2019-11-26 20:03:34'),
(23, 74, 18600, 'аппва', 'павпвкпк', '', '69985216574', 'tim@mail.ru', 'method_0', '', '', '', '', 'Кредитной картой', '', 0, '2020-01-11 20:03:34'),
(24, 73, 63000, 'аппва', 'павпвкпк', 'Fsretyumb', '+9989846846', 'angrav-6@yandex.ru', 'method_3', 'NY', 'рапр', '45', '543', 'Наличные', '', 0, '2020-01-12 20:03:34'),
(25, 73, 63000, 'аппва', 'павпвкпк', 'Fsretyumb', '+9989846846', 'angrav-6@yandex.ru', 'method_3', 'NY', 'рапр', '45', '543', 'Наличные', '', 0, '2019-12-28 20:03:34'),
(26, 69, 8755, 'аппва', 'павпвкпк', '', '+9989846846', 'tim@mail.ru', 'method_1', 'NY', 'lasvega', '45', '32', 'Кредитной картой', '234567890зщшгнкцйфывапроьбь234567890зщшгнкцйфывапроьбь234567890зщшгнкцйфывапроьбь', 1, '2019-10-26 20:03:34'),
(27, 5, 10000, 'проверка ', 'нового ', 'методаДоставки', '69985216574', 'tim@mail.ru', 'method_1', 'NY', 'lasvega', '15', '52', 'Наличные', '12345678щшгнек', 0, '2020-01-12 20:03:34'),
(28, 5, 10000, 'проверка ', 'нового ', 'методаДоставки', '69985216574', 'tim@mail.ru', 'method_1', 'NY', 'lasvega', '15', '52', 'Наличные', '12345678щшгнек', 0, '2019-10-12 20:03:34'),
(29, 3, 2950, 'еще ', 'одна ', 'проверка', '69985216574', 'tim@mail.ru', 'method_3', 'Ташкент', '24 Амир Темур шоҳ кўчаси', '45', '543', 'Банковский перевод', '2345678зщшгнекуцывапрбьтим', 0, '2020-01-12 20:03:34'),
(30, 3, 3690, 'проверка', 'нового', 'методаДоставки', '69985216574', 'tim@mail.ru', 'method_3', 'jfg', 'lasvega', 'арп', '543', 'Наличные', '', 0, '2020-01-12 20:03:34'),
(31, 4, 4960, 'Gross', 'павпвкпк', 'проверка', '69985216574', 'tim@mail.ru', 'method_0', '', '', '', '', 'Кредитной картой', '', 0, '2020-01-12 20:03:34'),
(32, 4, 4960, 'Gross', 'павпвкпк', 'проверка', '69985216574', 'tim@mail.ru', 'method_0', '', '', '', '', 'Кредитной картой', '', 0, '2020-01-12 20:03:34'),
(33, 4, 4960, 'Gross', 'павпвкпк', 'проверка', '69985216574', 'tim@mail.ru', 'method_0', '', '', '', '', 'Кредитной картой', '', 0, '2020-01-12 20:03:34');

-- --------------------------------------------------------

--
-- Структура таблицы `payment_method`
--

CREATE TABLE `payment_method` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `payment_method`
--

INSERT INTO `payment_method` (`id`, `name`) VALUES
(1, 'Наличные'),
(2, 'Кредитной картой'),
(3, 'Банковский перевод');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` float DEFAULT NULL,
  `new` tinyint(1) DEFAULT NULL,
  `sale` tinyint(1) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `new`, `sale`, `image`) VALUES
(1, 'Платье со складками', 13700, 1, NULL, '/upload/products/product-1.jpg'),
(2, 'Рубашка', 5815, NULL, 1, '/upload/products/product-2.jpg'),
(3, 'Часы', 2950, NULL, NULL, '/upload/products/product-3.jpg'),
(4, 'Брюки', 4960, NULL, NULL, '/upload/products/product-4.jpg'),
(5, 'Красное платье', 10000, 1, 1, '/upload/products/product-6.jpg'),
(6, 'Розовое пальто', 35030, NULL, NULL, '/upload/products/product-7.jpg'),
(7, 'Джинсы', 9779, NULL, NULL, '/upload/products/product-8.jpg'),
(8, 'Ботинки', 3100, NULL, 1, '/upload/products/product-9.jpg'),
(9, 'Туфли', 2500, 1, NULL, '/upload/products/product-9.jpg'),
(10, 'Платье коктельное', 15050, NULL, NULL, '/upload/products/product-6.jpg'),
(11, 'Шорты', 1400, NULL, 1, '/upload/products/product-2.jpg'),
(12, 'Часы', 500, NULL, NULL, '/upload/products/product-3.jpg'),
(14, 'Пальто белое', 27000, NULL, NULL, '/upload/products/product-5.jpg'),
(17, 'Блузка', 2450, NULL, NULL, '/upload/products/product-8.jpg'),
(18, 'NewProd', 9584, 1, 0, '/upload/products/product-1.jpg'),
(64, 'Обновленный продукт', 70575, 0, 1, '/upload/products/2019-12-18product-3.jpg'),
(65, 'Платье', 12500, 1, 0, '/upload/products/2019-12-18-product-6.jpg'),
(66, 'Джинсы', 4850, 0, 1, '/upload/products/2019-12-18-product-8.jpg'),
(67, 'Блузка', 3540, 0, 1, '/upload/products/2019-12-18-product-2.jpg'),
(68, 'Брюки', 5482, 0, 0, '/upload/products/2019-12-18-product-4.jpg'),
(69, 'Новый товар', 8755, 0, 0, '/upload/products/2019-12-18-product-9.jpg'),
(70, 'Пальто', 45000, 1, 1, '/upload/products/2019-12-18-product-7.jpg'),
(71, 'Сумка', 2598, 0, 0, '/upload/products/2019-12-18-product-5.jpg'),
(72, 'Сумка маленькая', 2150, 0, 0, '/upload/products/2019-12-18-product-7.jpg'),
(74, 'Коктельное платье', 18600, 0, 1, '/upload/products/2019-12-18-product-6.jpg'),
(75, 'Рубашка', 5482, 0, 0, '/upload/products/2019-12-18-product-2.jpg'),
(76, 'Товар 272', 4000, 1, 0, '/upload/products/2019-12-19-product-8.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `product_categories`
--

CREATE TABLE `product_categories` (
  `product_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `product_categories`
--

INSERT INTO `product_categories` (`product_id`, `cat_id`) VALUES
(1, 1),
(1, 3),
(1, 5),
(2, 1),
(2, 2),
(2, 4),
(3, 2),
(4, 1),
(5, 5),
(6, 3),
(7, 1),
(8, 2),
(9, 3),
(10, 4),
(11, 5),
(12, 2),
(14, 5),
(18, 2),
(18, 4),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 3),
(69, 5),
(70, 1),
(70, 5),
(71, 2),
(71, 3),
(71, 4),
(72, 5),
(74, 2),
(75, 3),
(76, 1),
(76, 2),
(76, 3),
(76, 4),
(76, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'operator');

-- --------------------------------------------------------

--
-- Структура таблицы `shipping_method`
--

CREATE TABLE `shipping_method` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `coast` int(11) NOT NULL,
  `max_order` int(11) DEFAULT NULL,
  `desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shipping_method`
--

INSERT INTO `shipping_method` (`id`, `name`, `coast`, `max_order`, `desc`) VALUES
(1, 'Стандартная доставка', 280, 2000, 'Примерный срок доставки составит около 2-7 рабочих дней, в зависимости от адреса доставки.'),
(2, 'В день покупки', 560, NULL, 'Доступна для жителей г. Москва в пределах МКАД. Заказы, оформленныес понедельника по пятницу до 14:00 будут доставлены в тот же день с 19:00до 23:00. Изменение адреса доставки после оформления заказа невозможно.'),
(3, 'Доставка с примеркой', 740, 5000, 'Доставка возможна только по Москве (в пределах МКАД) в течение 2-3 дней. Воспользовавшись услугой «Примерка перед покупкой», вы можете получить свой заказ и примерить заказанные товары. Вы оплачиваете только то, что вам подошло. Максимальное количество позиций в заказе, при котором доступна примерка, составляет 10 вещей. Время на примерку одного заказа – 15 минут.');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `name`) VALUES
(1, 'email@mail.ru', '$2y$10$Ee2CmNSlEHOG3zdXxgkh3.Yb1RibAYePt3AhQKwMulvWa2xlLMUzO', 'Моисеенко Тимур'),
(2, 'email@yandex.ru', '$2y$10$Ee2CmNSlEHOG3zdXxgkh3.Yb1RibAYePt3AhQKwMulvWa2xlLMUzO', 'Лагутенко Илья'),
(3, 'email@google.ru', '$2y$10$Ee2CmNSlEHOG3zdXxgkh3.Yb1RibAYePt3AhQKwMulvWa2xlLMUzO', 'Еще кто то');

-- --------------------------------------------------------

--
-- Структура таблицы `users_role`
--

CREATE TABLE `users_role` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users_role`
--

INSERT INTO `users_role` (`user_id`, `role_id`) VALUES
(1, 2),
(2, 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`product_id`,`cat_id`),
  ADD KEY `product_gategories_categories_id_fk` (`cat_id`);

--
-- Индексы таблицы `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `shipping_method`
--
ALTER TABLE `shipping_method`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users_role`
--
ALTER TABLE `users_role`
  ADD PRIMARY KEY (`role_id`),
  ADD KEY `users_role_users_id_fk` (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT для таблицы `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT для таблицы `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `shipping_method`
--
ALTER TABLE `shipping_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `product_categories`
--
ALTER TABLE `product_categories`
  ADD CONSTRAINT `product_gategories_categories_id_fk` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_gategories_products_id_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users_role`
--
ALTER TABLE `users_role`
  ADD CONSTRAINT `users_role_role_id_fk` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_role_users_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
