<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/settings.php";

/**
 * @return PDO - return new connection link;
 */
function connect()
{
    $opt = array(
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::FETCH_OBJ
    );
    return new PDO(DB_DSN,DB_USER,DB_PASSWORD, $opt);
}

/**
 * @param $class - string,
 * @param bool $admin
 * @return false|string
 */
function get_menu($admin=false){
    $conn = connect();
    if($admin){
        $stmt = $conn->query("SELECT name, url from menu where name = 'Главная' or admin = 1");
    }else{
        $stmt = $conn->query("SELECT name, url from menu where admin = 0");
    }
    $menuItems = $stmt->fetchAll();

    ob_start();
    include $_SERVER['DOCUMENT_ROOT'] . '/template/tmpl-menu.php';
    $menuList = ob_get_contents();
    ob_end_clean();

    return $menuList;

}

/**
 * @param $path - takes the current path
 * @return bool - compares the received url with the current url and returns a Boolean
 */
function compare_url($path){
    return $_SERVER['REQUEST_URI'] == $path ? true : false;
}

/**
 * @return bool - checks whether the user has been authorized and returns a Boolean
 */
function isAuth() {
    if (isset($_SESSION["is_auth"])) {
        return $_SESSION["is_auth"];
    }
    else {
        return false;
    }
}

function get_user_role($login){
    $conn = connect();
    $stmt = $conn->prepare("select r.name from users u left join users_role ur on u.id = ur.user_id left join role r on ur.role_id = r.id where u.login =  :login");
    $stmt->bindParam(':login', $login);
    $stmt->execute();
    $userRole = $stmt->fetchAll()[0]['name'];
    return $userRole;
}

/**
 * @param $login - takes user login (email)
 * @param $password - takes user password
 * @return bool - checks login & password and returns a Boolean
 */
function auth($login, $password){
    $conn = connect();
    $stmt = $conn->prepare("select login, password from users where login = :login");
    $stmt->bindParam(':login', $login);
    $stmt->execute();
    $userLogin = $stmt->fetchAll()[0];
    if($userLogin){
        $_SESSION["user_info"] = $userLogin;
        if(password_verify($password, $_SESSION["user_info"]['password'])){
            $_SESSION["is_auth"] = true;
            $_SESSION["login"] = $login;
            $_SESSION['user_role'] = get_user_role($login);
            unset($_SESSION["logon_error"]);
            setcookie('user_login', $login, time()+60*20, '/');
            return true;
        }
    }else {
        $_SESSION["is_auth"] = false;
        $_SESSION["logon_error"] = true;
        return false;
    }
}

/**
 *  logout user
 */
function logout() {
    if ($_GET["logout"] == 1) {
        $_SESSION["is_auth"] = false;
        unset($_SESSION['login']);
        header("Location: /admin/");
    }

}

/**
 * @return array - returns all product categories
 */
function get_all_categories(){
    $conn = connect();
    $stmt = $conn->query("select * from categories");
    $stmt->execute();
    $res = $stmt->fetchAll();
    if($res){
        return $res;
    }else{
        return [];
    }
}

/**
 * @return int - returns the minimum price of the product
 */
function get_min_price(){
    $conn = connect();
    $stmt = $conn->query("select min(price) as min_price from products");
    $stmt->execute();
    $res = $stmt->fetchAll()[0]['min_price'];
    if($res){
        return $res;
    }else{
        return 0;
    }
}

/**
 * @return int - returns the maximum price of the product
 */
function get_max_price(){
    $conn = connect();
    $stmt = $conn->query("select max(price) as max_price from products");
    $stmt->execute();
    $res = $stmt->fetchAll()[0]['max_price'];
    if($res){
        return $res;
    }else{
        return 0;
    }
}

/**
 * @param array $option
 * @return int - returns the number of products in the request
 */
function get_count_products($option=[]){
    $conn = connect();
    $where_tmp = "";
    $order = "";
    $sql = "select count( distinct p.id) as total from products as p left join product_categories as pg on p.id = pg.product_id ";

    if($option['cat_id'] && $option['cat_id'] != 'all'){
        $where_tmp = addFilterCondition($where_tmp, "pg.cat_id = " . htmlspecialchars($option['cat_id']));
    }
    if($option['min-price']){
        $where_tmp = addFilterCondition($where_tmp, "p.price >= " . htmlspecialchars($option['min-price']));
    }
    if($option['max-price']){
        $where_tmp = addFilterCondition($where_tmp, " p.price <= " . htmlspecialchars($option['max-price']));
    }
    if($option['new']){
        $where_tmp = addFilterCondition($where_tmp, "p.new = " . htmlspecialchars($option['new']));
    }
    if($option['sale']){
        $where_tmp = addFilterCondition($where_tmp, "p.sale = " . htmlspecialchars($option['sale']));
    }

    $sql .= $where_tmp != "" ? "WHERE $where_tmp" : "";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll()[0]['total'];
    if($res){
        return $res;
    }else{
        return 0;
    }
}

/**
 * @param $where - empty string
 * @param $add - expression to check
 * @param bool $and - if it is necessary to replace "and" with " or " is exposed "falce"
 * @return string - return ready string
 */
function addFilterCondition($where, $add, $and = true) {
    if ($where) {
        if ($and) $where .= " AND $add";
        else $where .= " OR $add";
    }
    else $where = $add;
    return $where;
}

/**
 * @param $active - current page
 * @param $per_page - number of products displayed on the page
 * @param array $option - the values of the additional parameters to filter the product
 * @return array - returns an array of items with id, name, price, image url
 */
function get_all_products($active, $per_page, $option=[]){
    $conn = connect();
    $where_tmp = "";
    $order = "";
    $sql = "select DISTINCT p.id, p.name, p.price, p.image, p.new, p.sale from products as p left join product_categories as pg on p.id = pg.product_id ";

    if(isset($option['cat_id']) && $option['cat_id'] != 'all' && $option['cat_id']){
        $where_tmp = addFilterCondition($where_tmp, "pg.cat_id = " . htmlspecialchars($option['cat_id']));
    }
    if(isset($option['min-price']) && $option['min-price']){
        $where_tmp = addFilterCondition($where_tmp, "p.price >= " . htmlspecialchars($option['min-price']));
    }
    if(isset($option['max-price']) && $option['max-price']){
        $where_tmp = addFilterCondition($where_tmp, " p.price <= " . htmlspecialchars($option['max-price']));
    }
    if(isset($option['new']) && $option['new']){
        $where_tmp = addFilterCondition($where_tmp, "p.new = " . htmlspecialchars($option['new']));
    }
    if(isset($option['sale']) && $option['sale']){
        $where_tmp = addFilterCondition($where_tmp, "p.sale = " . htmlspecialchars($option['sale']));
    }
    if(isset($option['order_by']) && $option['order_by'] && $option['order'] && isset($option['order'])){
        $order = " ORDER BY " . htmlspecialchars($option['order_by']) . "  " . htmlspecialchars($option['order']);
    }

    $where = $where_tmp != "" ? "WHERE $where_tmp" : "";

    $sql .= $where . $order ." LIMIT :limit OFFSET :offset";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':limit', (int)$per_page, PDO::PARAM_INT);
    $stmt->bindValue(':offset', (int)$active, PDO::PARAM_INT);
    $stmt->execute();
    $res = $stmt->fetchAll();
    if($res){
        return $res;
    }else{
        return [];
    }
}

function get_all_product_admin(){
    $conn = connect();
    $sql = "select p.id, p.name, p.price, p.image, p.new, p.sale from products as p";
    $res = $conn->query($sql);
    $res = $res->fetchAll();
    if($res){
        return $res;
    }else{
        return [];
    }
}

function get_product_categories($id){
    $conn = connect();
    $sql = "select c.name as category from products as p left join product_categories as pg on p.id = pg.product_id
              left join categories as c on c.id = pg.cat_id where p.id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    $res = $stmt->fetchALL();
    $cat = [];
    foreach ($res as $key => $val){
        $cat[] = $val['category'];
    }
    if($res){
        $sep = ",<br>";
        return implode($sep, $cat);
    }else{
        return "";
    }
}

function get_prod_for_edit($id){
    $conn = connect();
    $sql = "select p.* from products as p where p.id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    $res = $stmt->fetch();
    if($res){
        return $res;
    }else{
        return [];
    }

}

function product_categories($id){
    $conn = connect();
    $sql = "select cat_id from product_categories where product_id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    $res = $stmt->fetchAll();
    $cat = [];
    foreach ($res as $key => $val){
        $cat[] = $val['cat_id'];
    }
    if($res){
        return $cat;
    }else{
        return [];
    }

}

function last_priduct_id(){
    $conn = connect();
    $res = $conn->query('SELECT id FROM products ORDER BY id DESC LIMIT 1');
    $id = $res->fetch();
    if($id){
        return $id['id'];
    }
}

function add_product_categorys($arr_cat, $id){
    $conn = connect();
    $sql = "insert into product_categories (product_id, cat_id) ";
    $forRowPlaces = [];
    $insertValues = [];
    foreach ($arr_cat as $k => $v){
        $forRowPlaces[] = [$id, $v];
    }
    foreach ($arr_cat as $k => $v){
        $insertValues[] = $id;
        $insertValues[] = $v;
    }
    $rowPlaces = '';
    foreach ($forRowPlaces as $val){
        $rowPlaces .= '(' . implode(', ', array_fill(0, count($val), '?')) . '),';
    }
    $rowPlaces = substr($rowPlaces,0,-1);
    $sql .= 'values ' . $rowPlaces;
    $stmt = $conn->prepare($sql);
    $stmt->execute($insertValues);
    if($stmt){
        return true;
    }else{
        return false;
    }
}

function update_product_categorys($arr_cat, $id){
    $conn = connect();
    $sql = "insert into product_categories (product_id, cat_id) ";
    $forRowPlaces = [];
    $insertValues = [];
    foreach ($arr_cat as $k => $v){
        $forRowPlaces[] = [$id, $v];
    }
    foreach ($arr_cat as $k => $v){
        $insertValues[] = $id;
        $insertValues[] = $v;
    }
    $rowPlaces = '';
    foreach ($forRowPlaces as $val){
        $rowPlaces .= '(' . implode(', ', array_fill(0, count($val), '?')) . '),';
    }
    $rowPlaces = substr($rowPlaces,0,-1);
    $sql .= 'values ' . $rowPlaces . '  on duplicate key update  cat_id=values(cat_id);';
    $stmt = $conn->prepare($sql);
    $stmt->execute($insertValues);
    if($stmt){
        return true;
    }else{
        return false;
    }
}

function save_image($imgName, $imgData){
    $uploadPath = $_SERVER["DOCUMENT_ROOT"] . '/upload/products/'. date("Y-m-d-") . $imgName;
    $savePath = '/upload/products/'. date("Y-m-d-") . $imgName;
    $base64_decode = base64_decode ($imgData, true);
    if($base64_decode){
        $error = file_put_contents($uploadPath, $base64_decode, LOCK_EX);
        if($error){
            return $savePath;
        }
    }else{
        return false;
    }


}

function create_product($name, $price, $new, $sale, $imgName, $imgData, $category){
    $url = save_image($imgName, $imgData);
    if(!$url){
        $url = "/img/nopic.jpg";
    }
    $conn = connect();
    $sql = "insert into products (name, price, new, sale, image) values (:name, :price, :new, :sale, :img)";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array('name' => $name,
                        'price' => $price,
                        'new' => $new,
                        'sale' => $sale,
                        'img' => $url));
    $add_prod_cat = true;
    if($category != ""){
        $new_id = last_priduct_id();
        $add_prod_cat =  add_product_categorys($category, $new_id);
    }
    if($stmt && $add_prod_cat){
        return true;
    }else{
        return false;
    }
}

function update_product($id, $name, $price, $new, $sale, $imgName, $imgData, $category){
    $conn = connect();
    $url = save_image($imgName, $imgData);
    $sql = "update products set name=:name, price=:price, new=:new, sale=:sale ";
    $prop = array(
        'name' => $name,
        'price' => $price,
        'new' => $new,
        'sale' => $sale);
    if($url){
        $prop['url'] = $url;
        $sql .= ", image=:url";
    }
    $prop['id'] = $id;
    $sql .= " where id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute($prop);
    $update_prod_cat = true;
    if($category != ""){
        $update_prod_cat =  update_product_categorys($category, $id);
    }
    if($stmt && $update_prod_cat){
        return true;
    }else{
        return false;
    }
}

function delete_product($id){
    $conn = connect();
    $sql = "delete from products where id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    if($stmt){
        return true;
    }else{
        return false;
    }
}

function get_all_shipping_method(){
    $conn = connect();
    $sql = "select * from shipping_method";
    $stmt = $conn->query($sql);
    $stmt = $stmt->fetchAll();
    if($stmt){
        return $stmt;
    }else{
        return [];
    }
}


function get_all_payment_method(){
    $conn = connect();
    $sql = "select * from payment_method";
    $stmt = $conn->query($sql);
    $stmt = $stmt->fetchAll();
    if($stmt){
        return $stmt;
    }else{
        return [];
    }
}

function create_order($args){
    if(gettype($args) == "array"){
        $keys = '(' . implode(', ',array_keys($args)) . ')';
        $values = array_values($args);
        $values_str = '(' . implode(', ', array_fill(0, count($values), '?')) . ')';
        $conn = connect();
        $sql = "insert into orders $keys values $values_str";
        $stmt = $conn->prepare($sql);
        $stmt->execute($values);
        if($stmt){
            return true;
        }else{
            return false;
        }
    }


}

function get_shipping_options($method){
    $conn = connect();
    $sql = "select coast, max_order from shipping_method where name = :method;";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':method', $method);
    $stmt->execute();
    $stmt = $stmt->fetchAll()[0];
    if($stmt){
        return $stmt;
    }else{
        return [];
    }
}

function get_all_orders(){
    $conn = connect();
    $sql = "select * from orders order by status ASC, create_date ASC;";
    $stmt = $conn->query($sql);
    $stmt = $stmt->fetchAll();
    if($stmt){
        return $stmt;
    }else{
        return [];
    }
}

function change_order_status($id){
    $conn = connect();
    $sql = "update orders set status=1 where id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    if($stmt){
        return true;
    }else{
        return false;
    }
}

function get_page_title($uri){
    if( preg_match("/^.[?].*/", $_SERVER['REQUEST_URI']) && !preg_match("/^.[?]new=true$/", $_SERVER['REQUEST_URI']) && !preg_match("/^.[?]sale=true$/", $_SERVER['REQUEST_URI'])){
        return "Главная";
    }elseif ( preg_match("/^.*admin./", $_SERVER['REQUEST_URI']) && !preg_match("/^.*(admin).*[a-z]/", $_SERVER['REQUEST_URI']) ){
        return "Авторизация";
    }elseif (preg_match("/^.*admin.*add$/", $_SERVER['REQUEST_URI'])){
        return "Добавить товар";
    }elseif (preg_match("/^.*admin.*add[?].*/", $_SERVER['REQUEST_URI'])){
        return "Изменить товар";
    }else{
        $conn = connect();
        $sql = "select name from menu where url = :uri";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':uri', $uri);
        $stmt->execute();
        return $stmt->fetch()["name"];
    }

}

