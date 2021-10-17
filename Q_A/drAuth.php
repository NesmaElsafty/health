<?php 
	// session_start();
	require_once '../config/functions.php';
	// require_once '../config/header.php';
	require_once '../config/db.php';

$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';

// Include and initialize DB class
$db = new DB();

// Fetch the users data
$questions = $db->getRows('questions');
$drData = getData('doctors','dr_email',$_SESSION['auth']);
// print_r($drData);
?>

<div id="main">
	<section class="posts">
		<?php if(!empty($questions)){ $count = 0; foreach($questions as $row){ $count++; ?>
		<article>
			<header>
				<span class="date"><?php echo $row['created']; ?></span>
				<h2><?php echo $row['question']; ?></h2>
			</header>
			<!-- Answer -->
			<?php 
				$sql = "SELECT * FROM answers where question_id = '".$row['id']."'";
				// die($sql);
				$result = mysqli_query($connect, $sql);

				$answers = mysqli_fetch_all($result,MYSQLI_ASSOC);
				$Arows = mysqli_num_rows($result); 
				// print_r($answers);				
				
				// echo $getID['dr_id']; //>>>>>>15
				$sql2 = "SELECT dr_name FROM doctors WHERE id = '".$answers[0]['dr_id']."'";
				$result2 = mysqli_query($connect, $sql2);
				$getName = mysqli_fetch_assoc($result2);

				

				for ($i=0; $i < $Arows; $i++) {
			?>			

						<h4>Dr/ <?php echo $getName['dr_name'];?> </h4>
						<p><?php echo $answers[$i]['answer']; ?></p>
						<h7><?php echo $answers[$i]['created']; ?></h7>
			<?php
				}			
			?>
			 
			
			<!-- Dr.form to answer -->
			<form action="actions.php" method="POST">
				<input type="text" name="reply" placeholder="Answer">
				<input type="hidden" name="question_id" value="<?php echo $row['id']; ?>">
				<input type="hidden" name="dr_id" value="<?php echo $drData['id']; ?>">
				<input type="hidden" name="created" value="<?php echo date("Y-m-d h:i:sa"); ?>">
				<ul class="actions special">
					<button type="submit" name="answer">Answer</button>
				</ul>
			</form>

		</article>


		<?php } }else{ ?>
			<h4>No Doctors(s) found...</h4>
<?php } ?>
	</section>
</div>
<?php 
	
	// require_once '../config/footer.php';
?>