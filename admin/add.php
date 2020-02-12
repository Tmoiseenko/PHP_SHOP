<?php

$all_categories = get_all_categories();
if(isset($_GET['prod_id'])){
    $prod = get_prod_for_edit($_GET['prod_id']);
    $prod_categories = product_categories($_GET['prod_id']);
    if($prod){
        include_once $_SERVER['DOCUMENT_ROOT'] . "/template/tmpl-edit.php";
    }else{
        include_once $_SERVER['DOCUMENT_ROOT'] . "/template/tmpl-error.php";
    }

}else{
    include_once $_SERVER['DOCUMENT_ROOT'] . "/template/tmpl-add.php";
}


