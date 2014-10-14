<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset='utf-8'>
	<title>Delete A Course</title>
	<link rel="stylesheet" type="text/css" href="/assets/style_destroy.css">
</head>
<body>
	<div id='confirm'>
		<h3>Are you sure you want to delete this product?</h3>
		<?php 
			foreach($items as $item)
			{
				if($item['id'] == $id)
				{
					echo "<p>Name: {$item['name']}</p>";
					echo "<p>Description: {$item['description']}</p>";
				}
			}
		?>
		<button><a class='button' href='/users/admin'>No</a></button>
		<form action='/items/remove/<?= $id?>' method='post'>
			<input type='submit' value='Yes! I want do delete this product.'>
		</form>
	</div>
</body>
</html>