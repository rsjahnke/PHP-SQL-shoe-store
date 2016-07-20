 <?php
session_start();
//print_r($_SESSION);

// Create a cart array if needed
if (empty($_SESSION['cart13'])) { $_SESSION['cart13'] = array(); }
//print_r($_SESSION);

// Create a table of shoes
$shoes = array();
$shoes['shoe1'] = array('name' => 'Runway Wedge', 'cost' => '275.00', 'id' => '1');
$shoes['shoe2'] = array('name' => 'Lace-Up Sandal', 'cost' => '138.00', 'id' => '2');
$shoes['shoe3'] = array('name' => 'Proto Pump', 'cost' => '79.98', 'id' => '3');
$shoes['shoe4'] = array('name' => 'Mary Jane Pump', 'cost' => '119.95', 'id' => '4');
$shoes['shoe5'] = array('name' => 'Fringe Boot', 'cost' => '368.00', 'id' => '5');
$shoes['shoe6'] = array('name' => 'Riding Boot', 'cost' => '448.00', 'id' => '6');


// Include cart functions
require_once('cart.php');
require('../model/database.php');
require_once('../model/online_orders.php');
require_once('../model/shoe_db.php');

// Get the sort key
$sort_key = filter_input(INPUT_POST, 'sortkey');
if ($sort_key === NULL) { $sort_key = 'name'; }

// Get the action to perform
$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'show_add_item';
    }
}

// Add or update cart as needed, and other cases 
switch($action) {
    case 'add':
        $key = filter_input(INPUT_POST, 'shoekey');
        $quantity  = filter_input(INPUT_POST, 'itemqty');
        cart\add_item($key, $quantity);
        include('cart_view.php');
        break;
    case 'update':
        $key = filter_input(INPUT_POST, 'cartAction');
        //print_r ($key);
        if ($key == 'Update Cart'){
        $new_qty_list = filter_input(INPUT_POST, 'newqty', 
                FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        foreach($new_qty_list as $key => $qty) {
            if ($_SESSION['cart13'][$key]['qty'] != $qty) {
                cart\update_item($key, $qty);
            }
        }
        cart\sort($sort_key);
        include('cart_view.php');
        break;}
        else {
            $customerOrderID = $_SESSION['customerID'];
            $session_items = $_SESSION['cart13'];
            //print_r($session_items);

            foreach ($session_items as $item) {
                // Get shoe data from db
                $shoe_id = $item['id'];
                $quantity = $item['qty'];
                $stock = get_stock($shoe_id);
                $halt = '';
                if ($quantity > $stock) {
                    //echo 'quantity ' . $quantity;
                    //echo 'stock'.$stock;
                    echo 'WARNING: Not enough of shoe with ID ' . $shoe_id . ' in stock! Update your cart.';
                    $halt = 'true'; // variable to use to use for later if condition....
                    break;
                }
                else {
                    $order_id = $customerOrderID;
                    add_order_item($shoe_id, $order_id, $quantity);
                    adjust_quantity($shoe_id, $quantity);
                }
                /* this variable and condition stops the site from automatically clearing cart and displaying 
                header if the order wasn't placed due to customer trying to backorder */
                if ('halt' != 'true'){ 
                    clear_cart(); // empty cart after order completed 
                    header("Location: " . 'http://localhost/CS602/CS602_FinalProject_Jahnke/');
                    break;
                }
            }
        }
    /* Code below provides same functionality as foreach loop in else of above case, but without 
        displaying warning message if a customer tries to backorder... 

            foreach ($session_items as $item) {
            // Get shoe data from db
            $shoe_id = $item['id'];
            $quantity = $item['qty'];
            $order_id = $customerOrderID;
            add_order_item($shoe_id, $order_id, $quantity);
            adjust_quantity($shoe_id, $quantity);
            }
            clear_cart(); // empty cart after order completed 
            //unset($_SESSION['cart13']); (Could do this as opposed to clear_cart method)
            header("Location: " . 'http://localhost/CS602/CS602_FinalProject_Jahnke/');
            break;
        }*/
    case 'show_cart':
        cart\sort($sort_key);
        include('cart_view.php');
        break;
    case 'show_add_item':
        include('add_item_view.php');
        break;
    case 'empty_cart':
        unset($_SESSION['cart13']);
        include('cart_view.php');
        break; 
}
?>