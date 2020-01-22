<?php
   $mac=$_POST['mac'];
   $ip=$_POST['ip'];
   $username=$_POST['username'];
   $linklogin=$_POST['link-login'];
   $linkorig=$_POST['link-orig'];
   $error=$_POST['error'];
   $uptime=$_POST['uptime'];
   $chapid=$_POST['chap-id'];
   $chapchallenge=$_POST['chap-challenge'];
   $linkloginonly=$_POST['link-login-only'];
   $linkorigesc=$_POST['link-orig-esc'];
   $macesc=$_POST['mac-esc'];
#   echo "$mac'<br>'";
#   echo "$ip'<br>'";
#   echo "$username'<br>'";
#   echo "$linklogin'<br>'";
#   echo "$error'<br>'";
#   echo "$uptime<br>";
#   echo "$chapid'<br>'";
#   echo "$chapchallenge'<br>'";
#   echo "$linkloginonly'<br>'";
#   echo "$linkorigesc'<br>'";
#   echo "$macesc'<br>'";
?>

<?php 
   if ($uptime == "0s") {
   }
   else { header ("Location: http://mik.hs.HotOnMik.local"); }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>

<head>
<title>Авторизация</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="pragma" content="no-cache" #/>
<link rel="stylesheet" href="css/set.css" media="(max-device width:480px)">
<link rel="stylesheet" href="css/reset.css">
<link rel="stylesheet" href="css/animate.css">
<link rel="stylesheet" href="css/styles.css">
</head>

<body>
	<form name="sendin" action="<?php echo $linkloginonly; ?>" method="post">
		<input type="hidden" name="username" />
		<input type="hidden" name="password" />
		<input type="hidden" name="dst" value="<?php echo $linkorig; ?>" />
		<input type="hidden" name="popup" value="true" />
	</form>
	<script type="text/javascript" src="./md5.js"></script>
	<script src="js/jquery-1.7.2.js" type="text/javascript"></script>
	<script type="text/javascript">
		function doLogin() {<?php if(strlen($chapid) < 1) echo "return true;\n"; ?>
		document.sendin.username.value = document.login.username.value;
		document.sendin.password.value = hexMD5('<?php echo $chapid; ?>' + document.login.password.value + '<?php echo $chapchallenge; ?>');
		document.sendin.submit();
		return false; }
	</script>
<div id="container">
	<label>Добро пожаловать!</label>
	<form id="tell" action="php/ro943ff.php" method="post" >
		<label for="username">Введите номер телефона:</label>
		<input name="username" class="mirror" placeholder="79xxxxxxxxx" type="username" required/>
        	<input id="tellsub" type="submit" value="SMS"/>
        </form>
	<form name="login" action="<?php echo $linkloginonly; ?>" method="post" onSubmit="return doLogin()" >
		<label for="password">Код доступа из SMS:</label>
		<input type="hidden" name="dst" value="<?php echo $linkorig; ?>" />
		<input type="hidden" name="popup" value="true" />
		<input type="hidden" name="username" value="<?php echo $username;?>" class="mirror"/>
		<input type="password" name="password" placeholder="XXXX" pattern="[0-9]{4,4}" value="" required/>
		<input id="passsub" type="submit" value="Войти" />
		<label id="result"/>
        </form>
</div>
</body>
</html>

<div style="color: #FF8080; font-size: 10px"><?php echo $error; ?></div>
<script type="text/javascript">
	$('.mirror').on('keyup', function() {
	$('.'+$(this).attr('class')).val($(this).val()); });
</script>
<script type="text/javascript">
document.login.username.focus();
</script>
<script src="js/jquery-1.8.1.min.js" type="text/javascript"></script>
<script src="js/jquery.maskedinput.js" type="text/javascript"></script>
<script src="js/itgi438j.js" type="text/javascript"></script>
</body>
</html>
