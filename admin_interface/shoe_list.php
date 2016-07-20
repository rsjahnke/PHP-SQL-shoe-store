<?php include '../view/header.php'; ?>
<main>
    
    <h1>Shoe List</h1>

    <aside>
        <!-- display a list of brands -->
        <h2>Brands</h2>
        <nav>
        <ul>
        <?php foreach ($brands as $brand) : ?>
            <li>
            <a href="?brand_id=<?php echo $brand['brandID']; ?>">
                <?php echo $brand['brandName']; ?>
            </a>
            </li>
        <?php endforeach; ?>
        </ul>
        </nav>
    </aside>

    <section>
        <!-- display a table of shoes -->
        <h2><?php echo $brand_name; ?></h2>
        <table>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th class="right">Price</th>
                <th>Stock</th>
                <th>Delete</th>
                <th>Edit</th>
            </tr>
            <?php foreach ($shoes as $shoe) : ?>
            <tr>
                <td><?php echo $shoe['shoeCode']; ?></td>
                <td><?php echo $shoe['shoeName']; ?></td>
                <td class="right"><?php echo $shoe['listPrice']; ?></td>
                <td><?php echo $shoe['quantity_in_stock']; ?></td>
                <td><form action="." method="post">
                    <input type="hidden" name="action"
                           value="delete_shoe">
                    <input type="hidden" name="shoe_id"
                           value="<?php echo $shoe['shoeID']; ?>">
                    <input type="hidden" name="brand_id"
                           value="<?php echo $shoe['brandID']; ?>">
                    <input type="submit" value="Delete">
                </form></td> 
               <td><form action="." method="post">
                    <input type="hidden" name ="action" 
                           value="show_add_edit_form">
                    <input type="hidden" name="shoe_id" 
                           value="<?php echo $shoe['shoeID']; ?>">
                    <input type="hidden" name="brand_id" 
                           value="<?php echo $shoe['brandID']; ?>">
                    <input type="submit" value="Edit">
                </form></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <p class="last_paragraph">
            <a href="?action=show_add_edit_form">Add Shoe</a>
        </p>
        <p class="last_paragraph">
            <a href="?action=customer_list"> See Customer List </a>
        </p>
    </section>

</main>
<?php include '../view/footer.php'; ?>

