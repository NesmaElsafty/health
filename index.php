<?php 
	session_start();
	error_reporting(0);
	require_once 'config/functions.php';
	$ourData = getWeb('ourdata');
	if(isset($_SESSION['auth'])){
	$authData = getData('users','email', $_SESSION['auth']);
	// print_r($authData);
	if (!empty($authData = getData('users','email', $_SESSION['auth']))) {
		$username = $authData['username'];


	}elseif(!empty($authData = getData('doctors','dr_email', $_SESSION['auth']))){
		$username = $authData['dr_name'];
	}else{
		header('location:index.php');
	}
}
?>
<!DOCTYPE HTML>
<!--
	Massively by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Health assential</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="config/assets/css/main.css" />
		<noscript><link rel="stylesheet" href="config/assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper" class="fade-in">

				<!-- Intro -->
					<div id="intro">
						<h1>Health Assential</h1>
						<?php 
							if (isset($_SESSION['type']) && $_SESSION['type'] == 'doctor') { ?>
								<p> Welcome, Dr/<?php echo $username; ?></p>
							<?php }elseif(isset($_SESSION['type']) && $_SESSION['type'] == 'user'){ ?>
								<p> Welcome, <?php echo $username; ?></p>
							<?php }else{ ?>
								<p> Welcome to Health Assential</p>
							<?php }	?>
						<ul class="actions">
							<li><a href="#header" class="button icon solid solo fa-arrow-down scrolly">Continue</a></li>
						</ul>
					</div>

				<!-- Header -->
					<header id="header">
						<a href="index.php" class="logo">Health assential</a>
					</header>

				<!-- Nav -->
					<nav id="nav">
						<ul class="links">
							<li class="active"><a href="index.html">Home</a></li>
							<li><a href="calculator/index.php">Calculator</a></li>
							<li><a href="doctors/index.php">doctors</a></li>
							<li><a href="Meals/index.php">Meals</a></li>
							<li><a href="Q_A/index.php">Q/A</a></li>
						</ul>
						<ul class="icons">
							<li><a href="https://<?php echo $ourData['facebook'];?>" class="icon brands fa-facebook-f"><span class="label" 
								>Facebook</span></a></li>
							<li><a href="https://<?php echo $ourData['insta'];?>" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
						</ul>
					</nav>
</div>
				<!-- Main -->
					<div id="main">

						<!-- Featured Post -->
							<article class="post featured">
								<header class="major">
									<span class="date">Welcome</span>
									<h2><?php echo $ourData['title'];?></h2>
									<p><?php echo $ourData['description'];?></p>
								</header>
								<!-- <a href="#" class="image main"><img src="config/assets/images/pic01.jpg" alt="" /></a> -->
								<ul class="actions special">
								<?php if (!empty($_SESSION['auth'])) { ?>
									
										<li><a href="register/profile.php" class="button large">Profile</a></li>
										<li><a href="register/logout.php" class="button large">logout</a></li>
									
								<?php }else{ ?>
								
									<li><a href="register/signup.php" class="button large">Sign Up</a></li>
									<li><a href="register/signin.php" class="button large">Sign in</a></li>
								</ul>
								<?php } ?>
							</article>

				<!-- Footer -->
					<footer id="footer">
						<section class="split contact">
							
							<section>
								<h3>Phone</h3>
								<p><?php echo $ourData['phone'];?></p>
							</section>
							<section>
								<h3>Email</h3>
								<p><?php echo $ourData['email'];?></p>
							</section>
							<section>
								<h3>Social</h3>
								<ul class="icons alt">
									
									<li><a href="https://<?php echo $ourData['facebook'];?>" class="icon brands alt fa-facebook-f"><span class="label">Facebook</span></a></li>
									<li><a href="https://<?php echo $ourData['insta'];?>" class="icon brands alt fa-instagram"><span class="label">Instagram</span></a></li>
									
								</ul>
							</section>
						</section>
					</footer>

		<!-- Scripts -->
			<script src="config/assets/js/jquery.min.js"></script>
			<script src="config/assets/js/jquery.scrollex.min.js"></script>
			<script src="config/assets/js/jquery.scrolly.min.js"></script>
			<script src="config/assets/js/browser.min.js"></script>
			<script src="config/assets/js/breakpoints.min.js"></script>
			<script src="config/assets/js/util.js"></script>
			<script src="config/assets/js/main.js"></script>

	</body>
</html>