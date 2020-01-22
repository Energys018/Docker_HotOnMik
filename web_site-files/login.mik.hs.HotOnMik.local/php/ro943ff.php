<?php
include_once('adjiwdso.php');
$mobileNumber = $_POST['username'];
$code = rand(1001,9999);

if (!preg_match("/^[0-9]{11}+$/",$mobileNumber))
{
	echo "Неправильно набран номер<br>";
}
else
{
	$result = mysqli_query($conn, "SELECT * FROM radcheck WHERE username ='$mobileNumber'");
	if (mysqli_num_rows($result) > 0)
	{
		mysqli_query($conn, "UPDATE radcheck SET value='$code' WHERE username='$mobileNumber'");
		echo "Ваш код доступа обновлен, и отправлен.";
	}
	else
	{

		mysqli_query($conn, "INSERT INTO radcheck (username, attribute, op, value) VALUES ('$mobileNumber', 'Cleartext-Password', ':=', '$code')");
		echo "Регистрация успешна, код доступа отправлен.";

	}
	$smstext = "http://sms.ru/sms/send?api_id=2CC2A0AD-E270-F660-A75D-73C979348E33&to=$mobileNumber&text=$code";
	file_get_contents($smstext);
}
?>
