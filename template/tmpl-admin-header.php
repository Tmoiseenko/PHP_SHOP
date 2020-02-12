<?php
ini_set('session.gc_maxlifetime', 12000);
ini_set('session.cookie_lifetime', 12000);
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . "/inc/functions.php";
setlocale(LC_ALL, 'ru_RU.UTF-8');
$error_login = 0;

if (isset($_POST['auth'])){
    if(auth($_POST['login'], $_POST['password'])){
        header("Location: /admin/orders");
    }else{
        $error_login = 1;
    }
}

if (!isAuth() && isset($_GET['url']) && $_GET['url'] != 'login'){
    header('HTTP/1.1 200 OK');
    header("Location: /admin/login");
}

if (isAuth() && !isset($_GET['url'])){
    header('HTTP/1.1 200 OK');
    header("Location: /admin/orders");
}

if(isset($_COOKIE['user_login'])){
    setcookie('user_login', $_COOKIE['user_login'], time() + 60 * 20, '/');
}

if(isset($_COOKIE['session_id']) && isset($_SESSION["is_auth"])){
    setcookie('session_id', $_COOKIE['session_id'], time() + 60 * 20, '/');
}

if (isset($_GET["logout"])) {
    logout();
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title><?= get_page_title($_SERVER['REQUEST_URI']) ?></title>

    <meta name="description" content="Fashion - интернет-магазин">
    <meta name="keywords" content="Fashion, интернет-магазин, одежда, аксессуары">

    <meta name="theme-color" content="#393939">

    <link rel="preload" href="/fonts/opensans-400-normal.woff2" as="font">
    <link rel="preload" href="/fonts/roboto-400-normal.woff2" as="font">
    <link rel="preload" href="/fonts/roboto-700-normal.woff2" as="font">

    <link rel="icon" href="/img/favicon.png">
    <link rel="stylesheet" href="/css/style.css">

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="/js/scripts.js" defer=""></script>
    <script src="/js/myscript.js" defer=""></script>
</head>
<body>
<header class="page-header">
    <a class="page-header__logo" href="/">
        <img src="/img/logo.svg" alt="Fashion">
    </a>
    <nav class="page-header__menu">
        <ul class="main-menu main-menu--header">
            <?php if ($_SESSION['user_role'] != "admin"): ?>
                <li>
                    <a class="main-menu__item" href="/">Главная</a>
                </li>
                <li>
                    <a class="main-menu__item" href="/admin/orders">Заказы</a>
                </li>
            <?php else: ?>
                <?= get_menu( true) ?>
            <?php endif; ?>

            <?php
                if(isAuth()){ ?>
                    <li>
                        <a class="main-menu__item" href="/admin/?logout=1">Выйти</a>
                    </li>
               <?php }
            ?>
        </ul>
    </nav>
</header>