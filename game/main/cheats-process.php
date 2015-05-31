<?php
require_once('../../class/dbinterface.php');  
require_once('../../class/dbmethods.php'); 
require_once('../../class/dbinfo.php');

$cheat = $_POST['cheatname'];

$sql = new UserInfo(new UserDB('localhost','rpg',3306,'root',''));

$id = $_COOKIE['playerID'];


if($cheat == "aspirine")
{ 
	
	 $updateCheatHP = $sql->updateCheatHP($id);

	?>
	<script>alert("Cheat Enabled");
	window.location = "cheats.php"; </script>
<?php }



elseif($cheat == "pancer")
{ 
	
	 $updateCheatStrength = $sql->updateCheatStrength($id);

	?>
	<script>alert("Cheat Enabled");
	window.location = "cheats.php"; </script>
<?php }



elseif($cheat == "helloladies")
{ 
	
	 $updateCheatConstitution = $sql->updateCheatConstitution($id);

	?>
	<script>alert("Cheat Enabled");
	window.location = "cheats.php"; </script>
<?php }



elseif($cheat == "iwantbigtits")
{ 
	
	 $updateCheatGold = $sql->updateCheatGold($id);

	?>
	<script>alert("Cheat Enabled");
	window.location = "cheats.php"; </script>
<?php }



else{
?>
	<script>alert("Invalid Cheat");
	window.location = "cheats.php"; </script>
<?php } ?>
