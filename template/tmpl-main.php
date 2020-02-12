<main class="shop-page">
    <header class="intro">
        <div class="intro__wrapper">
            <h1 class=" intro__title">COATS</h1>
            <p class="intro__info">Collection 2018</p>
        </div>
    </header>
    <section class="shop container">
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/template/tmpl-sidebar.php"; ?>

        <div class="shop__wrapper">
            <section class="shop__sorting">
                <div class="shop__sorting-item custom-form__select-wrapper">
                    <select class="custom-form__select" name="order_by">
                        <option hidden="">Сортировка</option>
                        <option value="price1" data-value="price" data-direction="ASC">По цене по возрастанию</option>
                        <option value="price2" data-value="price" data-direction="DESC">По цене по убыванию</option>
                        <option value="name1" data-value="name" data-direction="ASC">По названию по возрастанию</option>
                        <option value="name2" data-value="name" data-direction="DESC">По названию по убыванию</option>
                    </select>
                </div>
                <p class="shop__sorting-res">Найдено <span class="res-sort"><?= $rows ?></span> моделей</p>
            </section>
            <section class="shop__list">
                <?php
                foreach ($products as $product):?>
                    <article class="shop__item product" data-prodId="<?= $product['id'] ?>">
                        <div class="product__image">
                            <img src="<?= $product['image'] ?>" alt="product-name">
                        </div>
                        <p class="product__name"><?= $product['name'] ?></p>
                        <span class="product__price" data-price="<?= $product['price'] ?>"><?= $product['price'] ?> руб.</span>
                    </article>
                <?php endforeach; ?>
            </section>
            <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/template/tmpl-pagination.php"; ?>
        </div>
    </section>

    <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/template/tmpl-order-registration.php"; ?>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/template/tmpl-thanks.php"; ?>

</main>

