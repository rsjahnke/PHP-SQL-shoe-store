<?php
require_once('shoe_db.php');

function get_customerIDs() {
    global $db;
    $query = 'SELECT customerID FROM online_orders
              ORDER BY customerID';
    $statement = $db->prepare($query);
    $statement->execute();
    return $statement;    
}

function getCustomerOrderID($customer_id) {
    global $db;
    $query = 'SELECT orderID FROM online_orders 
    		  WHERE customerID = :customer_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':customer_id', $customer_id);
    $statement->execute();
    $customerOrder_id = $statement->fetch();
    $statement->closeCursor();
    return $customerOrder_id;
}

// Get an array of items for the cart
function cart_get_items($order_id, $session_items) {
    $items = array();
    print_r($session_items);
    foreach ($session_items as $item) {
        // Get shoe data from db
        $shoe_id = $item['id'];
        $quantity = $item['qty'];

        // Store data in items array
        $items[$shoe_id]['shoe_id'] = $shoe['id'];
        $items[$shoe_id]['quantity'] = $quantity;
    }
    return $items;
}

// add items in cart to database items_in_order table 
function add_order_item($shoe_id, $order_id, $quantity){
    //echo $shoe_id . $order_id . $quantity;
    global $db;
    $query = '
        INSERT INTO items_in_order (shoeID, orderID, item_quantity)
        VALUES (:shoe_id, :order_id, :quantity)';
    $statement = $db->prepare($query);
    $statement->bindValue(':shoe_id', $shoe_id);
    $statement->bindValue(':order_id', $order_id);
    $statement->bindValue(':quantity', $quantity);
    $statement->execute();
    $statement->closeCursor();
}

// Remove all items from the cart
function clear_cart() {
    $_SESSION['cart13'] = array();
}

function get_orders_by_customer_id($customer_id) {
    global $db;
    $query = 'SELECT * FROM items_in_order WHERE orderID = :customer_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':customer_id', $customer_id);
    $statement->execute();
    $order = $statement->fetchAll();
    $statement->closeCursor();
    return $order;
}

//adjust the quantity in the shoe table after the items are stored in the db, called before clearing the cart
function adjust_quantity($shoe_id, $quantity) {
    global $db;
    $query = 'SELECT quantity_in_stock FROM shoes WHERE shoeID = :shoe_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':shoe_id', $shoe_id);
    $statement->execute();
    $current_quantity = $statement->fetchColumn();
    $current_quantity = intval($current_quantity);
    echo 'current quantity: ' . $current_quantity;
    $query = 'UPDATE shoes SET quantity_in_stock=:quantity WHERE shoeID = :shoe_id';
    $statement = $db->prepare($query);
    $new_quantity = $current_quantity - intval($quantity);
    $statement->bindValue(':quantity', $new_quantity);
    $statement->bindValue(':shoe_id', $shoe_id);
    $statement->execute();
    $statement->closeCursor();
}
?>