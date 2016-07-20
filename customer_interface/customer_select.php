<?php include '../view/header.php'; ?>
	<section>
		<h1> Select A Customer By ID </h1>
		
		<form action="index.php" method="post" id="customer_select_form" >
			
			<input type="hidden" name="action" value="list_shoes1" />
			  
		<label> Customer </label>
		<select name="customer_id">
			<?php foreach ($customers as $customer) :
				if (True){
					$selected = 'selected';
				} else{
					$selected ='';
				}
			?>
				<option value="<?php echo $customer['customerID']; ?>"
					<?php echo $selected ?>>
					<?php echo $customer['customerID'];?>
				</option>
			<?php endforeach; ?> 
		</select> <br>

		<label>&nbsp;</label>
		<input type="submit" value="Submit">
	</form>

	</section>

<?php include '../view/footer.php'; ?>

