<?php
session_start();
if(!isset($_SESSION["session_username"])):
header("location:login.php");
else:
?>
<?php include("includes/header.php"); ?>

<?php
$data = "";
$data .= "
<style>
td,body
{
	font-family: sans-serif;
	font-size: 8pt;
	color: #444444;
}
</style>
	<center>
	 <div style=\"border-bottom:0px #999999 solid;width:480;\"><b>
	   <font size='1' color='#3896CC'>Service Status</font></b>
	 </div>  
   </center>
<br>";
//configure script
$timeout = "1";
//set service checks
/* 
The script will open a socket to the following service to test for connection.
Does not test the fucntionality, just the ability to connect
Each service can have a name, port and the Unix domain it run on (default to localhost)
*/
$services = array();
$services[] = array("port" => "80",       "service" => "Apache",                "ip" => "") ;
$services[] = array("port" => "3306",     "service" => "MYSQL",			"ip" => "") ;
$services[] = array("port" => "22",       "service" => "Open SSH",		"ip" => "") ;
$services[] = array("port" => "80",       "service" => "Internet Connection",   "ip" => "google.com") ;
$services[] = array("port" => "1194",     "service" => "OpenVPN",           	"ip" => "172.16.1.2") ;
//begin table for status
$data .= "<table width='480' border='1' cellspacing='0' cellpadding='3' style='border-collapse:collapse' bordercolor='#333333' align='center'>";
foreach ($services  as $service) {
	if($service['ip']==""){
	   $service['ip'] = "localhost";
	}
	$fp = @fsockopen($service['ip'], $service['port'], $errno, $errstr, $timeout);
	if (!$fp) {
		$data .= "<tr><td>" . $service['service'] . "</td><td bgcolor='#FFC6C6'>Offline </td></tr>";
	  //fclose($fp);
	} else {
		$data .= "<tr><td>" . $service['service'] . "</td><td bgcolor='#D9FFB3'>Online</td></tr>";
		fclose($fp);
	}
}  
$data .= "</table>";
echo $data;
?>
<center><p><a href="intropage.php">Вернуться назад</a></p></center>
<?php include("includes/footer.php"); ?>

<?php endif; ?>
