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
$const=$_POST['const'];
$dex=$_POST['dex'];

$items = $sql->getItems($itemName,$id);


 if($result['Gold']<$Worth)
  {
    print "Click <a href='buylegarmor.php'>here</a> to go back.";
    die("Not enough gold!");
  }

  if($items['ID'])
  {
        $updateItems = $sql->updateItems($Amount,$Worth,$items['ID']);
  }
  else
  {
        $addItems = $sql->getItemInfo2($result['ID'],$itemName,$itemClass,$const,$dex,$Worth,$Amount);
        $id = $sql->addItems2();
        $updateUserItem = $sql->updateUserItem($id);
  }
  $updateGold = $sql->updateUserGold($Worth,$id);


?><script>alert("Thank you for buying");
  window.location = "buylegarmor.php"; </script>
