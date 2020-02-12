<?php
$options = [
    'cat_id' => $_GET['cat_id'] ?? false,
    'min-price' => $_GET['min-price'] ?? false,
    'max-price' => $_GET['max-price'] ?? false,
    'new' => isset($_GET['new']) && $_GET['new'] == "true" ? 1 : false,
    'sale' => isset($_GET['sale']) && $_GET['sale'] == "true" ? 1 : false,
    'order_by' => isset($_GET['order_by']) ? $_GET['order_by'] : false,
    'order' => isset($_GET['order']) ? $_GET['order'] : false,
];
$per_page = 6;
$cur_page = 1;
if (isset($_GET['page']) && $_GET['page'] > 0)
{
    $cur_page = $_GET['page'];
}
$start = ($cur_page - 1) * $per_page;
$rows = get_count_products($options);
$num_pages = ceil($rows / $per_page);
$page = 0;


$products = get_all_products($start, $per_page, $options);