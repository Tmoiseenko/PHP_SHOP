<main class="page-add">
    <h1 class="h h--1">Изменение товара</h1>
    <form class="custom-form" action="/admin/ajax.php" method="post">
        <input type="text" hidden id="product-id" name="product-id" value="<?= $_GET['prod_id'] ?> ">
        <fieldset class="page-add__group custom-form__group">
            <legend class="page-add__small-title custom-form__title">Данные о товаре</legend>
            <label for="product-name" class="custom-form__input-wrapper page-add__first-wrapper">
                <input type="text" class="custom-form__input" name="product-name" id="product-name" value="<?= $prod['name'] ?>">
            </label>
            <label for="product-price" class="custom-form__input-wrapper">
                <input type="text" class="custom-form__input" name="product-price" id="product-price"  value="<?= $prod['price'] ?>">
            </label>
        </fieldset>
        <div class="photo-container">
            <fieldset class="page-add__group custom-form__group">
                <legend class="page-add__small-title custom-form__title">Новая фотография товара</legend>
                <ul class="add-list">
                    <li class="add-list__item add-list__item--add">
                        <input type="file" name="product-photo" id="product-photo" hidden="hidden">
                        <label for="product-photo">Добавить фотографию</label>
                    </li>
                </ul>
            </fieldset>
            <fieldset class="page-add__group custom-form__group">
                <legend class="page-add__small-title custom-form__title">Текущая фотография товара</legend>
                <ul class="add-list">
                    <li class="add-list__item"><img id="old-photo" src="<?= $prod['image'] ?>"></li>
                </ul>
            </fieldset>
        </div>

        <fieldset class="page-add__group custom-form__group">
            <legend class="page-add__small-title custom-form__title">Раздел</legend>
            <div class="page-add__select">
                <select id="product-category" name="category[]" class="custom-form__select" multiple="multiple">
                    <option hidden="">Название раздела</option>
                    <?php foreach ($all_categories as $cat): ?>
                        <option value="<?= $cat['id'] ?>" <?= in_array($cat['id'], $prod_categories) ? "selected " : ""  ?>><?= $cat['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <input type="checkbox" name="new" id="new" <?= $prod['new'] ? "checked" : "" ?> class="custom-form__checkbox">
            <label for="new" class="custom-form__checkbox-label">Новинка</label>
            <input type="checkbox" name="sale" id="sale" <?= $prod['sale'] ? "checked" : "" ?> class="custom-form__checkbox">
            <label for="sale" class="custom-form__checkbox-label">Распродажа</label>
        </fieldset>
        <button class="button" type="submit">Изменить товар</button>
    </form>
    <section class="shop-page__popup-end page-add__popup-end" hidden="">
        <div class="shop-page__wrapper shop-page__wrapper--popup-end">
            <h2 class="h h--1 h--icon shop-page__end-title">Товар успешно обновлен</h2>
        </div>
        <a class="page-products__button button" href="/admin/add.php">Добавить еще товар</a>
        <a class="page-products__button button" href="/">На гланую</a>
    </section>
</main>