<?php
	session_start();
	if(!isset($_SESSION["session_username"])):
		header("location:login.php");
	else:
?>
<?php include("includes/header.php"); ?>
	<div id="Welcome to HotOnMik">
		<h2>Панель управления</h2>
		<h2>Привет, <span><?php echo $_SESSION['session_username'];?>! </span></h2>
			<p><a href="view.php">Посмотреть статистику</a></p>
			<p><a href="testing.php">Посмотреть статистику</a></p>
			<p><a href="service.php">Состояние системы</a></p>
			<p><a href="logout.php">Выйти</a> из системы</p>
	</div>
<?php include("includes/footer.php"); ?>
<?php endif; ?>
