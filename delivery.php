<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/template/tmpl-header.php"; ?>
<main class="page-delivery">
    <h1 class="h h--1">Доставка</h1>
    <p class="page-delivery__desc">
        Способы доставки могут изменяться в зависимости от адреса доставки, времени осуществления покупки и наличия товаров.
    </p>
    <p class="page-delivery__desc page-delivery__desc--strong">
        <b>При оформлении покупки мы проинформируем вас о доступных способах доставки, стоимости и дате доставки вашего заказа.</b>
    </p>
    <section class="page-delivery__info">
        <header class="page-delivery__desc">
            <b class="page-delivery__variant">Возможные варианты доставки:</b>
        </header>
        <ul class="page-delivery__list">
            <?php foreach (DELIVERY as $method): ?>
            <li>
                <b class="page-delivery__item-title"><?= $method['name'] ?> - <? echo $method['discount'] ? $method['discount'] . " РУБ" : "Бесплатно"; ?> <?php if($method['min_order_value']) : ?> / БЕСПЛАТНО (ДЛЯ ЗАКАЗОВ ОТ <?= $method['min_order_value'] ?> РУБ) <?php endif; ?></b>
                <p class="page-delivery__item-desc">
                    <?= $method['desc'] ?>
                </p>
            </li>
            <?php endforeach; ?>
        </ul>
        <p class="page-delivery__desc">
            Мы свяжемся с вами, чтобы подтвердить дату и время доставки. Кроме того, вы будете получать уведомления по электронной почте и SMS с информацией о номере заказа, его стоимости, а также с информацией о том, что заказ готов к выдаче. В день доставки заказа мы отправим вам SMS-уведомлениес номером телефона сотрудника службы доставки.
        </p>
        <a class="page-delivery__button button" href="/">Продолжить покупки</a>
    </section>
</main>
<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/template/tmpl-footer.php"; ?>