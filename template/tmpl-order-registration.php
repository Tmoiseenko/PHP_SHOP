<section class="shop-page__order" hidden="">
    <div class="shop-page__wrapper">
        <h2 class="h h--1">Оформление заказа</h2>
        <form action="/admin/ajax.php" method="post" class="custom-form js-order">
            <fieldset class="custom-form__group">
                <legend class="custom-form__title">Укажите свои личные данные</legend>
                <p class="custom-form__info">
                    <span class="req">*</span> поля обязательные для заполнения
                </p>
                <div class="custom-form__column">
                    <input id="action" class="custom-form__input" type="text" name="action" hidden required="" value="create-order">
                    <input id="prodId" class="custom-form__input" type="text" name="product_id" hidden required="">
                    <input id="prodPrice" class="custom-form__input" type="text" name="product_price" hidden required="">
                    <label class="custom-form__input-wrapper" for="surname">
                        <input id="surname" class="custom-form__input" type="text" name="surname" required="">
                        <p class="custom-form__input-label">Фамилия <span class="req">*</span></p>
                    </label>
                    <label class="custom-form__input-wrapper" for="name">
                        <input id="name" class="custom-form__input" type="text" name="name" required="">
                        <p class="custom-form__input-label">Имя <span class="req">*</span></p>
                    </label>
                    <label class="custom-form__input-wrapper" for="thirdName">
                        <input id="thirdName" class="custom-form__input" type="text" name="third_name">
                        <p class="custom-form__input-label">Отчество</p>
                    </label>
                    <label class="custom-form__input-wrapper" for="phone">
                        <input id="phone" class="custom-form__input" type="tel" name="phone" required="">
                        <p class="custom-form__input-label">Телефон <span class="req">*</span></p>
                    </label>
                    <label class="custom-form__input-wrapper" for="email">
                        <input id="email" class="custom-form__input" type="email" name="email" required="">
                        <p class="custom-form__input-label">Почта <span class="req">*</span></p>
                    </label>
                </div>
            </fieldset>
            <fieldset class="custom-form__group js-radio">
                <legend class="custom-form__title custom-form__title--radio">Способ доставки</legend>
<!--                <input id="dev-no" class="custom-form__radio" type="radio" name="shipping_method" value="Самовывоз" checked="">-->
<!--                <label for="dev-no" class="custom-form__radio-label">Самовывоз</label>-->

                <?php foreach (DELIVERY as $key => $method):
                    $cheked = $key == 'method_0' ? 'checked=""' : '' ; ?>

                    <input id="dev-<?= $key != 'method_0' ? $key : "no" ?>" class="custom-form__radio" type="radio" name="shipping_method" <?= $cheked ?>  value="<?= $key ?>">
                    <label for="dev-<?= $key != 'method_0' ? $key : "no" ?>" class="custom-form__radio-label"><?= $method['name'] ?></label>
                <?php endforeach; ?>
            </fieldset>
            <div class="shop-page__delivery shop-page__delivery--no">
                <table class="custom-table">
                    <caption class="custom-table__title">Пункт самовывоза</caption>
                    <tr>
                        <td class="custom-table__head">Адрес:</td>
                        <td>Москва г, Тверская ул,<br> 4 Метро «Охотный ряд»</td>
                    </tr>
                    <tr>
                        <td class="custom-table__head">Время работы:</td>
                        <td>пн-вс 09:00-22:00</td>
                    </tr>
                    <tr>
                        <td class="custom-table__head">Оплата:</td>
                        <td>Наличными или банковской картой</td>
                    </tr>
                    <tr>
                        <td class="custom-table__head">Срок доставки: </td>
                        <td class="date">13 декабря—15 декабря</td>
                    </tr>
                </table>
            </div>
            <div class="shop-page__delivery shop-page__delivery--yes" hidden="">
                <fieldset class="custom-form__group">
                    <legend class="custom-form__title">Адрес</legend>
                    <p class="custom-form__info">
                        <span class="req">*</span> поля обязательные для заполнения
                    </p>
                    <div class="custom-form__row">
                        <label class="custom-form__input-wrapper" for="city">
                            <input id="city" class="custom-form__input" type="text" name="city">
                            <p class="custom-form__input-label">Город <span class="req">*</span></p>
                        </label>
                        <label class="custom-form__input-wrapper" for="street">
                            <input id="street" class="custom-form__input" type="text" name="street">
                            <p class="custom-form__input-label">Улица <span class="req">*</span></p>
                        </label>
                        <label class="custom-form__input-wrapper" for="home">
                            <input id="home" class="custom-form__input custom-form__input--small" type="text" name="home">
                            <p class="custom-form__input-label">Дом <span class="req">*</span></p>
                        </label>
                        <label class="custom-form__input-wrapper" for="apartament">
                            <input id="aprt" class="custom-form__input custom-form__input--small" type="text" name="apartament">
                            <p class="custom-form__input-label">Квартира <span class="req">*</span></p>
                        </label>
                    </div>
                </fieldset>
            </div>
            <fieldset class="custom-form__group shop-page__pay">
                <legend class="custom-form__title custom-form__title--radio">Способ оплаты</legend>
                <?php foreach ($payments as $key => $payment): ?>
                    <input id="pay-<?= $payment['id'] ?>" class="custom-form__radio" type="radio" name="payment_method" value="<?= $payment['name'] ?>" <?= $key == 0 ? 'checked=""' : ""?>>
                    <label for="pay-<?= $payment['id'] ?>" class="custom-form__radio-label"><?= $payment['name'] ?> </label>
                <?php endforeach; ?>
            </fieldset>
            <fieldset class="custom-form__group shop-page__comment">
                <legend class="custom-form__title custom-form__title--comment">Комментарии к заказу</legend>
                <textarea class="custom-form__textarea" name="comment"></textarea>
            </fieldset>
            <button class="button" type="submit">Отправить заказ</button>
        </form>
    </div>
</section>