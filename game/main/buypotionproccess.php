<?php
require_once('../../class/dbinterface.php');  
require_once('../../class/dbmethods.php'); 
require_once('../../class/dbinfo.php');

$sql = new UserInfo(new UserDB('localhost','rpg',3306,'root',''));


$id = $_COOKIE['playerID'];
$result = $sql->getStats($id);

$Amount=$_POST['amount'];
$Worth=$_POST['worth']*$Amount;
$itemName=$_POST['name'];
$Life=$_POST['life'];
$Mana=$_POST['mana'];


$items = $sql->getItems($itemName,$id);


 if($result['Gold']<$Worth)
  {
    print "Click <a href='buypotion.php'>here</a> to go back.";
    die("Not enough gold!");
  }
  if($Amount<=0)
  {
    print "Click <a href='buypotion.php'>here</a> to go back.";
    die("Invalid Input");
  } 

  if($items['ID'])
  {
        $updateItems = $sql->updateItems($Amount,$Worth,$items['ID']);
  }
  else
  {
        $addItems = $sql->getItemInfo($result['ID'],$itemName,'Potion',$Life,$Mana,$Worth,$Amount);
        $id = $sql->addItems();
  }
  $updateGold = $sql->updateUserGold($Worth,$id);


?><script>alert("Thank you for buying");
  window.location = "buypotion.php"; </script>
