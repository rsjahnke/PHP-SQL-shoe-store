<?php
require('../model/database.php');
require('../model/shoe_db.php');
require('../model/brand_db.php');
require('../model/online_orders.php');
require_once 'file_util.php';  // the get_file_list function
require_once 'image_util.php'; // the process_image function

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_shoes';
    }
}
//cases for each action 
//echo $action;
if ($action == 'list_shoes') {
    $brand_id = filter_input(INPUT_GET, 'brand_id', 
            FILTER_VALIDATE_INT);
    if ($brand_id == NULL || $brand_id == FALSE) {
        $brand_id = 1;
    }
    $brand_name = get_brand_name($brand_id);
    $brands = get_brands();
    $shoes = get_shoes_by_brand($brand_id);
    include('shoe_list.php');
} else if ($action == 'delete_shoe') {
    $shoe_id = filter_input(INPUT_POST, 'shoe_id', 
            FILTER_VALIDATE_INT);
    $brand_id = filter_input(INPUT_POST, 'brand_id', 
            FILTER_VALIDATE_INT);
    if ($brand_id == NULL || $brand_id == FALSE ||
            $shoe_id == NULL || $shoe_id == FALSE) {
        $error = "Missing or incorrect shoe id or brand id.";
        include('../errors/error.php');
    } else { 
        delete_shoe($shoe_id);
        header("Location: .?brand_id=$brand_id");
    }
} else if ($action == 'show_add_edit_form') {
    $shoe_id = filter_input(INPUT_GET, 'shoe_id', 
            FILTER_VALIDATE_INT);
    if ($shoe_id == NULL) {
        $shoe_id = filter_input(INPUT_POST, 'shoe_id', 
            FILTER_VALIDATE_INT);
    }
    $shoe = get_shoe($shoe_id);
    $brands = get_brands();
    //print_r($shoe);
    include('shoe_add_edit.php');
} else if ($action == 'update_shoe') {
    $shoe_id = filter_input(INPUT_POST, 'shoe_id', 
            FILTER_VALIDATE_INT);
    $brand_id = filter_input(INPUT_POST, 'brand_id', 
            FILTER_VALIDATE_INT);
    $code = filter_input(INPUT_POST, 'code');
    $name = filter_input(INPUT_POST, 'name');
    $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
    $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);
    //echo $shoe_id . $brand_id . $code . $name . $price . $quantity;  
    if ($shoe_id === FALSE || $brand_id === FALSE || $code === NULL || $name === NULL || 
        $price === FALSE || $quantity === FALSE) {
        $error = "Invalid shoe data. Check all fields and try again.";
        include('../errors/error.php');
    } else {
        $brands = get_brands();
        update_shoe($shoe_id, $code, $name, $price, $quantity, $brand_id);
        header("Location: .?brand_id=$brand_id");
    } 
} else if ($action == 'add_shoe') {
    $brand_id = filter_input(INPUT_POST, 'brand_id', 
            FILTER_VALIDATE_INT);
    $code = filter_input(INPUT_POST, 'code');
    $name = filter_input(INPUT_POST, 'name');
    $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
    $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_FLOAT);

    if ($brand_id === FALSE || $code == NULL ||  $name == NULL || $price == FALSE 
         || $quantity == FALSE) {
        $error = "Invalid shoe data. Check all fields and try again.";
        include('../errors/error.php');
    } else{
        $brands = get_brands();
        $shoe_id = add_shoe($brand_id, $code, $name, $price, $quantity);
        $shoe = get_shoe($shoe_id);
        header("Location: .?brand_id=$brand_id");
    }
} else if ($action == 'customer_list') {
     // get customers
     $customers = get_customerIDs(); 
     include('customer_list.php');
} else if ($action == 'view_customer') {
    // get order for customer
    $order_id = filter_input(INPUT_GET, 'customer_id', FILTER_VALIDATE_INT);
    $orders = get_orders_by_customer_id($order_id);

    if (count($orders) > 0 ) { 
    include('../view/header.php');
     echo "<h1> Customer's Order Information</h1>"; 
     echo "<br>";

        foreach ($orders as $order) :
           //echo print_r($orders);
           $shoe_id = $order['shoeID']; 
           $quantity_num = $order['item_quantity'];
           echo 'Order ID: ' . $order_id;
           echo ' Shoe ID: ' .$shoe_id; 
           echo ' Quantity Ordered: ' . $quantity_num . ' '; 
        include('customer_view.php');
        endforeach;
        include('../view/footer.php');  
    }
    else{
        $error = "Customer hasn't placed an order.";
        include('../errors/error.php');
    }    
}
   
?>

