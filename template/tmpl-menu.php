<?php foreach ($menuItems as $item): ?>
    <li>
        <a class="main-menu__item <?= compare_url($item['url']) ? "active" : "" ?>" href="<?= $item['url'] ?>"><?= $item['name'] ?></a>
    </li>
<?php endforeach; ?>
