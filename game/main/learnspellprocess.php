<?php
require_once('../../class/dbinterface.php');  
require_once('../../class/dbmethods.php'); 
require_once('../../class/dbinfo.php');

$sql = new UserInfo(new UserDB('localhost','rpg',3306,'root',''));


$id = $_COOKIE['playerID'];
$result = $sql->getStats($id);


$SpellName=$_POST['name'];
$power=$_POST['power'];
$Worth=$_POST['price'];


$userspell = $sql->getLearnSpell($SpellName,$result['ID']);


if($result['Gold']<$Worth)
{
  print "Click <a href='learnspell.php'>here</a> to go back.";
  die("Not enough gold!");
}


  $addItems = $sql->getSpellInfo($result['ID'],$SpellName,$power);
  $id = $sql->addSpell();


$updateGold = $sql->updateUserGold($Worth,$id);

?><script>alert("Thank you for buying");
window.location = "learnspell.php"; </script>
