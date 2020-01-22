<?php session_start(); ?>

	<?php require_once("includes/connection.php"); ?>
	<?php include("includes/header.php"); ?>	 
<?php
	
		if(isset($_SESSION["session_username"]))
			{ header("Location: intropage.php"); }

		if(isset($_POST["login"])){
			if(!empty($_POST['username']) && !empty($_POST['password'])) {
				$username=htmlspecialchars($_POST['username']);
				$password=md5(md5($_POST['password']));
				$query=mysqli_query($link, "SELECT * FROM usertbl WHERE username='".$username."' AND password='".$password."'");
				$numrows=mysqli_num_rows($query);
					if($numrows!=0) {
						while($row=mysqli_fetch_assoc($query)) {
							$dbusername=$row['username'];
							$dbpassword=$row['password'];  }
  						if($username == $dbusername && $password == $dbpassword) {
	 						$_SESSION['session_username']=$username;	 
   							header("Location: intropage.php"); }
 							} 
						else { $message_error =  "Неверный логин или пароль!"; }
											} 
						else { $message_notify = "Все поля обязательны к заполнению."; }
		}
?>
<?php if (!empty($message_error)) {echo "<p class=\"message_error\">" . "Ошибка: ". $message_error . "</p>";} ?>
<?php if (!empty($message_notify)) {echo "<p class=\"message_notify\">" . "Уведомление: ". $message_notify . "</p>";} ?>

<!DOCTYPE html>
<body>
<html>
<div class="container mlogin">
<div id="login">
	<h1>Вход</h1>
		<form action="" id="loginform" method="post"name="loginform">
			<p><label for="user_login">Имя пользователя<br>
			<input class="input" id="username" name="username"size="20"
			type="text" value=""></label></p>
			<p><label for="user_pass">Пароль<br>
			<input class="input" id="password" name="password"size="20"
			type="password" value=""></label></p> 
				<p class="submit"><input class="button" name="login"type= "submit" value="Войти"></p>
				<p class="regtext"><a href= "register.php"></a></p>   
		</form>
</div>
</div>
<?php include("includes/footer.php"); ?>
</body>
</html>
