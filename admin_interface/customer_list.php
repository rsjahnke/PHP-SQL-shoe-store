<?php include '../view/header.php'; ?>
<main>
	<h1> Customer List </h1>

	<section>
	  <ul>	
		<?php foreach ($customers as $customer) : 
			$customer_id = $customer['customerID'];
			
			$url = 'http://localhost/CS602/CS602_FinalProject_Jahnke/admin_interface/' . 
					'?action=view_customer&amp;customer_id=' . $customer_id;
		?>
		<li> <a href ="<?php echo $url; ?>"Customer ID
		<?php echo $customer_id; ?> </a>  
		<?php echo 'Customer ' . $customer_id; ?> 
		</li>
		<?php endforeach ?>
	   </ul>
	</section>

</main>
<?php include '../view/footer.php'; ?>
			

