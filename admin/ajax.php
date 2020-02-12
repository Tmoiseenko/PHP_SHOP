<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/inc/functions.php";
$errors = '';
if($_POST['action'] == "edit-product"){
    $id = $_POST['product-id'];
    $name = $_POST['product-name'];
    $price = $_POST['product-price'];
    $new = $_POST['new'] == "true" ? 1 : 0;
    $sale = $_POST['sale'] == "true" ? 1 : 0;
    $imgName = $_POST['product-image-name'];
    $imgData = $_POST['product-image-data'];
    $category = $_POST['product-category'];
    if(update_product($id, $name, $price, $new, $sale, $imgName, $imgData, $category)){
        echo json_encode(array('error' => $errors));
    }else{
        echo json_encode(array('error' => 'Ошибка записи в БД'));
    }

}

if($_POST['action'] == "add-product"){
    $name = $_POST['product-name'];
    $price = $_POST['product-price'];
    $new = $_POST['new'] == "true" ? 1 : 0;
    $sale = $_POST['sale'] == "true" ? 1 : 0;
    $imgName = $_POST['product-image-name'];
    $imgData = $_POST['product-image-data'];
    $category = $_POST['product-category'];
    if( $name != "" || $price != "" || $img != ""){
        if(create_product($name, $price, $new, $sale, $imgName, $imgData, $category)){
            echo json_encode(array('error' => $errors));
        }else{
            echo json_encode(array('error' => 'Ошибка записи в БД'));
        }
    }else{
        echo json_encode(array('error' => 'Не заполнены обязательные поля'));
    }
}

if ($_POST['action'] == "delete-product"){
    if(delete_product($_POST['product-id'])){
        echo json_encode(array('error' => $errors));
    }else{
        echo json_encode(array('error' => 'Ошибка удаления продукта БД'));
    }
}

if ($_POST['action'] == "create-order"){
    $args = array_slice($_POST, 1);
    $prod_price = (int)$_POST['product_price'];

    $delivery = DELIVERY[$_POST['shipping_method']];
    if ($prod_price < $delivery['min_order_value']){
        $prod_price += $delivery['discount'];
    }
    $prop = [];
    foreach ($args as $key => $val){
        if($key == "product_id"){
            $prop[$key] = (int)$val;
        }elseif ($key == "product_price"){
            $prop['coast'] = $prod_price;
        }else{
            $prop[$key] = $val;
        }
    }

    $errors = create_order($prop);
    if($errors){
        echo json_encode(array('error' => $errors));
    }else{
        echo json_encode(array('error' => 'Ошибка создания заказа'));
    };
}

if ($_POST['action'] == "chenge_order_status"){
    $errors = change_order_status((int)$_POST['orderID']);
    if($errors){
        echo json_encode(array('error' => $errors));
    }else{
        echo json_encode(array('error' => 'Ошибка создания заказа'));
    };
}