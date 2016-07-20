<?php include '../view/header.php'; ?>
<main>
    <aside>
        <h1>Brands</h1>
        <nav>
            <ul>
                <!-- display links for all brands -->
                <?php foreach($brands as $brand) : ?>
                <li>
                    <a href="?action=list_shoes1&?brand_id=<?php 
                              echo $brand['brandID']; ?>">
                        <?php echo $brand['brandName']; ?>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </nav>
    </aside>
    <section>
        <h1><?php echo $name; ?></h1>
         <!--<?php print_r($_SESSION); ?>-->
        <!--selected_customer = <?php echo $_SESSION['customerID'];?>-->
        <div id="left_column">
            <p>
                <img src="<?php echo $image_filename; ?>"
                    alt="<?php echo $image_alt; ?>" />
            </p>
        </div>

        <div id="right_column">
            <p><b>List Price:</b> $<?php echo $list_price; ?></p>
          <form action="<?php echo '../cart' ?>" method="post">
                <input type="hidden" name="action" value="add">
                <input type="hidden" name="shoe_id"
                       value="<?php echo $shoe_id; ?>">
                <input type="submit" value="Place Order">
            </form>
        </div>
    </section>
</main>
<?php include '../view/footer.php'; ?>