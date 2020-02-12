<main class="page-order">
    <h1 class="h h--1">Список заказов</h1>
    <ul class="page-order__list">
        <?php foreach ($orders as $order):?>
        <li class="order-item page-order__item">
            <div class="order-item__wrapper">
                <div class="order-item__group order-item__group--id">
                    <span class="order-item__title">Номер заказа</span>
                    <span class="order-item__info order-item__info--id"><?= $order['id'] ?></span>
                </div>
                <div class="order-item__group">
                    <span class="order-item__title">Сумма заказа</span>
                    <?= $order['coast'] ?> руб.
                </div>
                <div class="order-item__group">
                    <span class="order-item__title">Дата заказа</span>
                    <? echo strftime('%d %b %G', strtotime($order['create_date']));?>
                </div>
                <button class="order-item__toggle"></button>
            </div>
            <div class="order-item__wrapper">
                <div class="order-item__group order-item__group--margin">
                    <span class="order-item__title">Заказчик</span>
                    <span class="order-item__info"><?= $order['surname'] ?> <?= $order['name'] ?> <?= $order['third_name'] ?></span>
                </div>
                <div class="order-item__group">
                    <span class="order-item__title">Номер телефона</span>
                    <span class="order-item__info"><?= $order['phone'] ?></span>
                </div>
                <div class="order-item__group">
                    <span class="order-item__title">Способ доставки</span>
                    <span class="order-item__info"><?= DELIVERY[$order['shipping_method']]['name'] ?></span>
                </div>
                <div class="order-item__group">
                    <span class="order-item__title">Способ оплаты</span>
                    <span class="order-item__info"><?= $order['payment_method'] ?></span>
                </div>
                <div class="order-item__group order-item__group--status">
                    <span class="order-item__title">Статус заказа</span>
                    <?php if($order['status']): ?>
                        <span class="order-item__info order-item__info--yes">Выполнено</span>
                    <?php else: ?>
                        <span class="order-item__info order-item__info--no">Не выполнено</span>
                        <?php if ($_SESSION['user_role'] == "admin"): ?>
                        <button class="order-item__btn" data-order_id="<?= $order['id'] ?>">Изменить</button>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="order-item__wrapper">
                <div class="order-item__group">
                    <span class="order-item__title">Адрес доставки</span>
                    <span class="order-item__info"> г. <?= $order['city'] ?>, ул. <?= $order['street'] ?>, <?= $order['home'] ?>, <?= $order['apartament'] ?></span>
                </div>
            </div>
            <div class="order-item__wrapper">
                <div class="order-item__group">
                    <span class="order-item__title">Комментарий к заказу</span>
                    <span class="order-item__info"><?= $order['comment'] ?></span>
                </div>
            </div>
        </li>
        <?php endforeach; ?>
    </ul>
</main>