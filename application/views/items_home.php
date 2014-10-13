<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset='utf-8'>
	<title>Items Home Page</title>
	<link rel="stylesheet" type="text/css" href="/assets/style.css">
</head>
<body>
	<div id='wrapper'>
		<?php
			$total = 0;
			foreach($items as $item)
			{
				$temp = $this->session->userdata($item['id']);
				$total += $temp;
			}
		?>
		<h1>J-Mart: Home of the Best Electronics!</h1>
		<p class='right' ><a href='/items/yourcart'>View Cart (<?= $total; ?>)</a></p>
		<?php
			foreach($items as $item)
			{
				echo "<div class='item'>
					<img src='{$item['url']}' alt ='{$item['name']}'>
					<div class='description'>
						<p>Name: {$item['name']}</p>
						<p>Description: {$item['description']}</p>
						<p>Price: \${$item['price']}</p>
						<form action='/items/addCart/{$item['id']}' method='post'>
							<select name='qty'>
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
							</select>
							<input type='submit' value='Add to Cart'>
						</form>
					</div>
				</div>";
			}
		?>
	</div>
</body>
</html>