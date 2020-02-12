<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/template/tmpl-admin-header.php";

if($_SESSION['user_role'] != "admin" && isset($_GET['url']) && $_GET['url'] != "orders"){
    include_once $_SERVER['DOCUMENT_ROOT'] . "/template/tmpl-error-role.php";
}

if (isset($_GET['url']) && $_GET['url'] == "login" || !isset($_GET['url'])){
        include_once $_SERVER['DOCUMENT_ROOT'] . "/admin/login.php";
}

if(isset($_GET['url']) && $_GET['url'] == "products" && $_SESSION['user_role'] == "admin"){
    if(isAuth()){
        include_once $_SERVER['DOCUMENT_ROOT'] . "/admin/products.php";
    }else{
        include_once $_SERVER['DOCUMENT_ROOT'] . "/admin/login.php";
    }
}

if(isset($_GET['url']) && $_GET['url'] == "add" && $_SESSION['user_role'] == "admin"){
    if(isAuth()){
        include_once $_SERVER['DOCUMENT_ROOT'] . "/admin/add.php";
    }else{
        include_once $_SERVER['DOCUMENT_ROOT'] . "/admin/login.php";
    }
}

if(isset($_GET['url']) && $_GET['url'] == "orders"){
    if(isAuth()){
        include_once $_SERVER['DOCUMENT_ROOT'] . "/admin/orders.php";
    }else{
        include_once $_SERVER['DOCUMENT_ROOT'] . "/admin/login.php";
    }
}



include_once $_SERVER['DOCUMENT_ROOT'] . "/template/tmpl-admin-footer.php";