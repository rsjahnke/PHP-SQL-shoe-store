<?php include '../view/header.php'; ?>
<main>
    <aside>
        <h1>Brands</h1>
        <!--<?php print_r($_SESSION); ?>-->
        <nav>
        <ul>
            <!-- display links for all brands -->
            <?php foreach($brands as $brand) : ?>
            <li>
                <a href="?action=list_shoes1&brand_id=<?php 
                            echo $brand['brandID']; ?>">
                    <?php echo $brand['brandName']; ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
        </nav>
    </aside>
    <section>
        <h1><?php echo $brand_name; ?></h1>
        <!--selected_customer = <?php echo $_SESSION['customerID'];?>-->
        <nav>
        <ul>
            <!-- display links for shoes in selected brand -->
            <?php foreach ($shoes as $shoe) : ?>
            <li>
                <a href="?action=view_shoe&amp;shoe_id=<?php 
                          echo $shoe['shoeID']; ?>">
                    <?php echo $shoe['shoeName']; ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
        </nav>
        <?php $IDToGetOrders = $_SESSION['customerID']; ?>
        <?php $orders = get_orders_by_customer_id($IDToGetOrders); ?>

        <?php if (count($orders) > 0 ) : ?>
        <h1> My Past Orders </h1>
        <!--selected_customer = <?php echo $_SESSION['customerID'];?>-->
        <!--<?php print_r($orders) ?>-->
        <?php foreach ($orders as $order) :
           $shoe_id = $order['shoeID']; 
           $order_id = $order['orderID'];
           $quantity_num = $order['item_quantity'];
        ?>
        <?php echo 'You ordered shoe with ID ' . $shoe_id . '.'; ?><br>
        <?php echo 'Your order and customer ID is ' . $order_id . '.'; ?><br>
        <?php echo 'You ordered ' . $quantity_num . ' of this shoe.'; ?><br><br>
      <?php endforeach; ?> 
      <?php endif; ?>
    </section>
</main>
<?php include '../view/footer.php'; ?>