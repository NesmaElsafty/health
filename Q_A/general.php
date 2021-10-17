<?php 
	// session_start();
	error_reporting(0);
	require_once '../config/functions.php';
	require_once '../config/db.php';

$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';

// Include and initialize DB class
$db = new DB();

// Fetch the users data
$questions = $db->getRows('questions');
$drData = getData('doctors','dr_email',$_SESSION['auth']);
// print_r($drData);
?>

	<?php if(!isset($_SESSION['auth'])){ ?>
		<h4 style="color: red;">You have to sign up first to Ask a Question</h4>
	<?php } ?>
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

		</article>


		<?php } }else{ ?>
			<h4>No Articles found...</h4>
<?php } ?>
	</section>
