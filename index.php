<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/template/tmpl-header.php";
$shipping = get_all_shipping_method();
if(isset($_GET['url']) && $_GET['url'] == 'delivery'){
    include_once $_SERVER['DOCUMENT_ROOT'] . "/delivery.php";
}else {
    $payments =  get_all_payment_method();
    include_once $_SERVER['DOCUMENT_ROOT'] . "/template/tmpl-main.php";
}
include_once $_SERVER['DOCUMENT_ROOT'] . "/template/tmpl-footer.php";