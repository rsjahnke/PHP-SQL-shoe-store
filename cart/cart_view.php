<!DOCTYPE html>
<html>
<head>
    <title>Rebecca's Online Store</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
    <header>
        <h1>Rebecca's Online Store</h1>
    </header>
    <main>
        <h1>Your Cart</h1>
        <!--<?php print_r($_SESSION); ?>
        <?php print_r($_POST); ?>-->
        <?php if (empty($_SESSION['cart13']) || 
                  count($_SESSION['cart13']) == 0) : ?>
            <p>There are no items in your cart.</p>
        <?php else: ?>
            <form action="." method="post">
                <input type="hidden" name="action" value="update">
                <table>
                    <tr id="cart_header">
                        <th class="left">
                            Item <input type="radio"
                            <?php if ($sort_key == 'name') : ?>
                                checked
                            <?php endif; ?>
                            name="sortkey" value="name"></th>
                        <th class="right">
                            <input type="radio"
                            <?php if ($sort_key == 'cost') : ?>
                                checked
                            <?php endif; ?>
                                name="sortkey" value="cost">
                            Item Cost</th>
                        <th class="right" >
                            <input type="radio"
                            <?php if ($sort_key == 'qty') : ?>
                                checked
                            <?php endif; ?>
                                name="sortkey" value="qty">
                            Quantity</th>
                        <th class="right">
                            <input type="radio"
                            <?php if ($sort_key == 'total') : ?>
                               checked
                            <?php endif; ?>
                                name="sortkey" value="total">
                        Item Total</th>
                    </tr>
                    <?php foreach( $_SESSION['cart13'] as $key => $item ) :
                        $cost  = number_format($item['cost'],  2);
                        $total = number_format($item['total'], 2);
                    ?>
                    <tr>
                        <td>
                            <?php echo $item['name']; ?>
                        </td>
                        <td class="right">
                            $<?php echo $cost; ?>
                        </td>
                        <td class="right">
                            <input type="text" class="cart_qty"
                                name="newqty[<?php echo $key; ?>]"
                                value="<?php echo $item['qty']; ?>">
                        </td>
                        <td class="right">
                            $<?php echo $total; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <tr id="cart_footer">
                        <td colspan="3"><b>Subtotal</b></td>
                        <td>$<?php echo cart\get_subtotal(); ?></td>
                    </tr>
                    <tr>
                        <td colspan="4" class="right">
                            <input type="submit" name ="cartAction" value="Update Cart">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" class="right">
                            <input type="submit" name ="cartAction" value="Complete Order">
                        </td>
                    </tr>
                </table>
                <p>Click "Update Cart" to update quantities or the sort 
                   sequence in your cart.<br> 
                   Enter a quantity of 0 to remove an item.<br><br>
                   <em>Admin - after completing order, update the stock quantity for items ordered
                   using Add/Edit form in Admin interface.</em> 
                </p>
            </form>
        <?php endif; ?>
        <p><a href=".?action=show_add_item">Add Item</a></p>
        <p><a href=".?action=empty_cart">Empty Cart</a></p>

       <!--<?php print_r(array_values($_SESSION['cart13'])) ?>
      <?php print_r($_SESSION['current_customer']) ?>-->

</main>
</body>
</html>