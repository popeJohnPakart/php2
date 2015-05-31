<?php
require_once('../class/dbinterface.php');  
require_once('../class/dbmethods.php'); 
require_once('../class/dbinfo.php');

$username = $_POST['username'];
$password = sha1($_POST['password']);



$sql = new UserInfo(new UserDB('localhost','rpg',3306,'root',''));


$result = $sql->searchUser($username,$password);

if($result)
{ 
	setcookie('playerID',$result['ID'],time()+60*60*24);

	?>
	<script>alert("Successful");
	window.location = "intro/index.php"; </script>
<?php }
else{
?>
	<script>alert("Incorrect Username or Password");
	window.location = "login.php"; </script>
<?php } ?>
