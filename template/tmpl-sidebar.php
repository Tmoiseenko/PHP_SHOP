    <section class="shop__filter filter">
        <form id="options">
            <div class="filter__wrapper">
                <b class="filter__title">Категории</b>
                <ul class="filter__list">
                    <li>
                        <a class="filter__list-item <?= !isset($_GET['cat_id']) || $_GET['cat_id'] == 'all' ? "active" : "" ?>" href="?cat_id=all">Все</a>
                    </li>
                    <?php foreach (get_all_categories() as $cat): ?>
                    <li>
                        <a class="filter__list-item <?= $_GET['cat_id'] == $cat['id'] ? "active" : "" ?>" href="?cat_id=<?= $cat['id'] ?>"><?= $cat['name'] ?></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="filter__wrapper">
                <b class="filter__title">Фильтры</b>
                <div class="filter__range range">
                    <span class="range__info">Цена</span>
                    <input type="text" hidden name="min-prce" id="min-price" data-min_price="<?= get_min_price() ?>" value="<?= $_GET['min-price'] ?? get_min_price() ?>">
                    <input type="text" hidden name="max-price" id="max-price" data-max_price="<?= get_max_price() ?>" value="<?= $_GET['max-price'] ?? get_max_price() ?>">
                    <div class="range__line" aria-label="Range Line"></div>
                    <div class="range__res">
                        <span class="range__res-item ">
                            <span class="min-price"><?= $_GET['min-price'] ?? get_min_price() ?></span> руб.
                        </span>
                        <span class="range__res-item ">
                            <span class="max-price"><?= $_GET['max-price'] ?? get_max_price() ?></span> руб.
                        </span>
                    </div>
                </div>
            </div>

            <fieldset class="custom-form__group">
                <input type="checkbox" name="new" id="new" class="custom-form__checkbox">
                <label for="new" class="custom-form__checkbox-label custom-form__info" style="display: block;">Новинка</label>
                <input type="checkbox" name="sale" id="sale" class="custom-form__checkbox">
                <label for="sale" class="custom-form__checkbox-label custom-form__info" style="display: block;">Распродажа</label>
            </fieldset>
            <button class="button" type="submit" name="filter" style="width: 100%">Применить</button>
        </form>
    </section>

