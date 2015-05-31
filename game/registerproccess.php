<?php
require_once('../class/dbinterface.php');  
require_once('../class/dbmethods.php'); 
require_once('../class/dbinfo.php');

session_start();

$fname = $_POST['firstname'];
$lname = $_POST['lastname'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = sha1($_POST['password']);


$hp = "100";
$maxhp = "100";
$mp = "100";
$maxmp = "100";

$str = '2';
$cons = '2';
$dex = '2';
$int = '2';

$gold = '500';
$items = '0';
$fight = '0';

$newUser = new UserInfo(new UserDB('localhost','rpg',3306,'root',''));
$newUser->getUserInfo("",$fname,$lname,$email,$username,$password,$hp,$maxhp,$mp,$maxmp,$str,$cons,$dex,$int,$gold,$items,$fight);

if($id = $newUser->addUser() > 0){
?><script>alert("Thank you for joining us !");
	window.location = "login.php"; </script>
<?php } ?>

