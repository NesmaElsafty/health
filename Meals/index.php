<?php 
	session_start();
	require_once '../config/functions.php';
	require_once '../config/header.php';
	require_once '../config/db.php';

$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';

// Include and initialize DB class
$db = new DB();

// Fetch the users data
$users = $db->getRows('menu');
?>

<div id="main">
<h3>Meals</h3>
<?php if(!empty($users)){ $count = 0; foreach($users as $row){ $count++; ?>
	<article>
		<header>
			<span class="date"><?php echo $row['meal_cat']; ?></span>
			<h2><?php echo $row['meal_name']; ?></h2>
		</header>
		<a href="#" class="image fit"><img src="../admin/menu/images/<?php echo $row['image']; ?>" alt="" /></a>
		<p>
			<strong>Ingredients: </strong><?php echo $row['ingredients']; ?><br>
			<strong>Recipes: </strong><?php echo $row['recipe']; ?><br>
		</p>
		
	</article>
<?php } }else{ ?>
			<h4>No Meals found...</h4>
<?php } ?>
</div>
<?php 
	
	require_once '../config/footer.php';
?>