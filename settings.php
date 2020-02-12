<?php
define('DB_DSN', 'mysql:host=localhost;dbname=skill_shop;charset=utf8');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DELIVERY', [
    'method_0' => [
        'name' => 'Самовывоз',
        'discount' => 0,
        'min_order_value' => 0,
        'desc' => 'Вы сможете забрать покупки с нашего склада по адресу: Москва г, Тверская ул, 4 Метро «Охотный ряд»',
    ],
    'method_1' => [
        'name' => 'Стандартная доставка',
        'discount' => 280,
        'min_order_value' => 2000,
        'desc' => 'Примерный срок доставки составит около 2-7 рабочих дней, в зависимости от адреса доставки.',
    ],
    'method_2' => [
        'name' => 'В день покупки',
        'discount' => 560,
        'min_order_value' => 0,
        'desc' => 'Доступна для жителей г. Москва в пределах МКАД. Заказы, оформленныес понедельника по пятницу до 14:00 
        будут доставлены в тот же день с 19:00до 23:00. Изменение адреса доставки после оформления заказа невозможно.',
    ],
    'method_3' => [
        'name' => 'Доставка с примеркой',
        'discount' => 740,
        'min_order_value' => 5000,
        'desc' => 'Доставка возможна только по Москве (в пределах МКАД) в течение 2-3 дней. Воспользовавшись услугой 
        «Примерка перед покупкой», вы можете получить свой заказ и примерить заказанные товары. Вы оплачиваете только то, 
        что вам подошло. Максимальное количество позиций в заказе, при котором доступна примерка, составляет 10 вещей. 
        Время на примерку одного заказа – 15 минут.',
    ]
]);