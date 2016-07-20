<?php include '../view/header.php'; ?>
<?php
if (isset($shoe_id)) {
	$heading_text = 'Edit Shoe';
}else{
	$heading_text = 'Add Shoe';
}
?>
<main>
	<h1> Admin - <?php echo $heading_text; ?> </h1>
	<form action ="index.php" method = "post" id="add_edit_shoe_form" >
		<?php if (isset($shoe_id)) : ?>
			<input type ="hidden" name="action" value="update_shoe" />
			<input type ="hidden" name="shoe_id" value="<?php echo $shoe_id; ?>" />
		<?php else: ?> 
			<input type="hidden" name="action" value="add_shoe" /> 
		<?php endif; ?> 
			<input type="hidden" name="brand_id" value="<?php echo $shoe['brandID']; ?>" />
		
		<label> Brand: </label> 
		<select name="brand_id">
			<?php foreach ($brands as $brand) :
				if ($brand['brandID'] == $shoe['brandID']) {
					$selected = 'selected';
				} else {
					$selected = '';
				}
			?>
				<option value ="<?php echo $brand['brandID']; ?>"<?php
						echo $selected ?>>
					<?php echo $brand['brandName'];?> 
				</option>
			<?php endforeach; ?>
		</select> <br>
		
		<label>Code:</label>
        <input type="text" name="code" value = "<?php echo $shoe['shoeCode']; ?>"/>
        <br>

        <label>Name:</label>
        <input type="text" name="name" value = "<?php echo $shoe['shoeName']; ?>"/>
        <br>
        
        <label>List Price:</label>
        <input type="text" name="price" value = "<?php echo $shoe['listPrice']; ?>"/>
        <br>
        
        <label> Stock Quantity:</label>
        <input type="text" name="quantity" value = "<?php echo $shoe['quantity_in_stock']; ?>" />
        <br>

		<label>&nbsp;</label>
		<input type="submit" value="Submit">
		<br>
	</form><br>

</main>
<?php include '../view/footer.php'; ?>

 