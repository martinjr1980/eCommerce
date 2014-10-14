<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset='utf-8'>
	<title>Items Home Page</title>
	<link rel="stylesheet" type="text/css" href="/assets/style_items.css">
</head>
<body>
	<div id='wrapper'>
		<h1 class='center'>Checkout</h1>
		<p class='right'><a href='/items'>Go Back</a></p>
		<?php
			$total=0;
			foreach($items as $item)
			{
				$temp = $item['price'] * $this->session->userdata($item['id']);
				$total += $temp;
				if ($this->session->userdata($item['id']) > 0)
				{
					echo "<div class='item'>
						<div class='description'>
							<p>Name: {$item['name']}</p>
							<p>Price: \${$item['price']}</p>
							<p>Quantity: {$this->session->userdata($item['id'])}</p>
							<form action='/items/removecart/{$item['id']}' method='post'>
								<select name='qty'>";		
								for ($i=1; $i<=$this->session->userdata($item['id']); $i++)
								{
									echo "<option>{$i}</option>";
								}
								echo "</select>
								<input type='submit' value='Remove'>
							</form>
						</div>
					</div>";
				}
			}
			echo "<h3 class='border_top'>Total Price: \${$total}</h3>"
		?>
		<form action="/items/process" method="POST">
		  <script
		    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
		    data-key="pk_test_6pRNASCoBOKtIshFeQd4XMUh"
		    data-amount="2000"
		    data-name="Demo Site"
		    data-description="2 widgets ($20.00)"
		    data-image="/128x128.png">
		  </script>
		</form>
	</div>
</body>
</html>