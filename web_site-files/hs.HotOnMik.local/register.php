<?php require_once("includes/connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php
	
	if(isset($_POST["register"]))	{
		if(!empty($_POST['username']) && !empty($_POST['password']))	{
	 	$username=htmlspecialchars($_POST['username']);
		$password= md5(md5(trim($_POST['password'])));
		$query=mysqli_query($link,"SELECT * FROM usertbl WHERE username='".$username."'");
		$numrows=mysqli_num_rows($query);
			if (strlen($_POST['username']) < 5 or strlen($_POST['username']) > 100)
				{$err = "длина имени должна быть от 4х символов!"; }
			if (!preg_match("/^[a-zA-Z0-9]+$/",$_POST['username']))		//Проверка на русски символы.
				{$err = "только английские символы и цифры."; }
			if (count($err) == 0) {						//Если не найдены русские символы.
			if($numrows == 0) {						//Если найдено совпадение логина то 1.
				$sql_add="INSERT INTO usertbl (username,password) VALUES('$username', '$password')";
				$result=mysqli_query($link,$sql_add);			//Добавляем учетную запись
					if($result){ $message_notify = "аккаунт зарегистрирован"; } 
						else { $message_error = "аккаунт не создан! Пожалуйста сообщите нам об этом!"; } }
				else { $message_error = "это имя пользователя уже занято"; } }
			else { $message_notify = "$err"; } }					//Ошибка формата символов
		else { $message_error = "все поля должны быть заполнены!"; } }
?>

<?php if (!empty($message_error)) {echo "<p class=\"message_error\">" . "Ошибка: ". $message_error . "</p>";} ?>
<?php if (!empty($message_notify)) {echo "<p class=\"message_notify\">" . "Уведомление: ". $message_notify . "</p>";} ?>

<!DOCTYPE html>
<body>
<html>
	<div class="container mregister">
	<div id="login">
		<h1>Регистрация</h1>
		<form action="register.php" id="registerform" method="post"name="registerform">
			<p><label for="user_pass">Имя пользователя<br>
			<input class="input" id="username" name="username"size="20" type="text" value=""></label></p>
			<p><label for="user_pass">Пароль<br>
			<input class="input" id="password" name="password"size="32"   type="password" value=""></label></p>
			<p class="submit"><input class="button" id="register" name= "register" type="submit" value="Зарегистрироваться"></p>
			<p class="regtext">Уже зарегистрированы? <a href= "login.php">Войти</a></p>
		</form>
	</div>
	</div>

<?php include("includes/footer.php"); ?>

</body>
</html>
