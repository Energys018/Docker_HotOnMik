<?php
        session_start();
        if(!isset($_SESSION["session_username"])):
        header("location:login.php");
        else:
?>

<?php
	date_default_timezone_set('Asia/Yakutsk');
	include_once('includes/db.php');
	include("includes/header-table.php");
	include("includes/header.php");
	$date = date('Y-m-d H:i:s');
	$radcheck = mysqli_query($conn, "SELECT * FROM radacct");
	#echo "$date";

?>
<html>
	<center>
<?php echo "<p>Дата и время-$date</p>"?>
  	<p><a href="intropage.php">Вернуться назад</a></p>
		<table class="simple-little-table cellspacinf='0'">
		<tr><td>ID</td><td>Mobile number</td><td>MAC</td><td>Start</td><td>Stop</td><td>Name Mikrotik</td><td>IP Mikrotik</td></tr>

<?php
while(	$row = $radcheck -> fetch_row()) 
{ printf("<tr><td>$row[0]</td><td>$row[3]</td><td>$row[20]</td><td>$row[9]</td><td>$row[11]</td><td>$row[19]</td><td>$row[6]</td></tr>\n"); }
?>

		</table>
	<p><a href="intropage.php">Вернуться назад</a></p>
	</center>
</html> 
<?php
	$radcheck->close();
	$conn->close();
?>

<?php endif; ?>

