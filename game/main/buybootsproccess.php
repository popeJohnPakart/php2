<?php
require_once('../../class/dbinterface.php');  
require_once('../../class/dbmethods.php'); 
require_once('../../class/dbinfo.php');

$sql = new UserInfo(new UserDB('localhost','rpg',3306,'root',''));


$id = $_COOKIE['playerID'];
$result = $sql->getStats($id);

$Amount='0';
$Worth=$_POST['price'];
$itemName=$_POST['name'];
$itemClass=$_POST['class'];
$str=$_POST['str'];
$const=$_POST['const'];


$items = $sql->getItems($itemName,$id);


 if($result['Gold']<$Worth)
  {
    print "Click <a href='buyboots.php'>here</a> to go back.";
    die("Not enough gold!");
  }

  if($items['ID'])
  {
        $updateItems = $sql->updateItems($Amount,$Worth,$items['ID']);
  }
  else
  {
        $addItems = $sql->getItemInfo4($result['ID'],$itemName,$itemClass,$str,$const,$Worth,$Amount);
        $id = $sql->addItems4();
        $updateUserItem = $sql->updateUserItem($id);
  }
  $updateGold = $sql->updateUserGold($Worth,$id);


?><script>alert("Thank you for buying");
  window.location = "buyboots.php"; </script>
