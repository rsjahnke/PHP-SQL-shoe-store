<?php
require('../model/database.php');
require('../model/shoe_db.php');
require('../model/brand_db.php');
require('../model/online_orders.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'select_customer';
    }
}  

// cases for various actions
if ($action == 'list_shoes1'){
    session_start();
    $customer_id = filter_input(INPUT_POST, 'customer_id', 
            FILTER_VALIDATE_INT);
    if ($customer_id == NULL || $customer_id == FALSE) {
        $customer_id = $_SESSION['customerID'];
    }
    $_SESSION['customerID'] = $customer_id;
    
   $brand_id = filter_input(INPUT_GET, 'brand_id', 
            FILTER_VALIDATE_INT);
    if ($brand_id == NULL || $brand_id == FALSE) {
        $brand_id = 1;
    }
    $brands = get_brands();
    $brand_name = get_brand_name($brand_id);
    $shoes = get_shoes_by_brand($brand_id);
    include('shoe_list.php');
}else if ($action == 'select_customer') {
    $customers = get_customerIDs();
    include('customer_select.php');
} else if ($action == 'view_shoe') {
    $shoe_id = filter_input(INPUT_GET, 'shoe_id', 
            FILTER_VALIDATE_INT);   
    if ($shoe_id == NULL || $shoe_id == FALSE) {
        $error = 'Missing or incorrect shoe id.';
        include('../errors/error.php');
    } else {
        $brands = get_brands();
        $shoe = get_shoe($shoe_id);

        // Get shoe data
        $code = $shoe['shoeCode'];
        $name = $shoe['shoeName'];
        $list_price = $shoe['listPrice'];

        // Get image URL and alternate text
        $image_filename = '../images/' . $code . '.png';
        $image_alt = 'Image: ' . $code . '.png';

        include('shoe_view.php');
    }
}
?>