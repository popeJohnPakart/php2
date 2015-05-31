<?php 
require_once('../../class/dbinterface.php');  
require_once('../../class/dbmethods.php'); 
require_once('../../class/dbinfo.php');

$sql = new UserInfo(new UserDB('localhost','rpg',3306,'root',''));

$id = $_COOKIE['playerID'];
$result = $sql->getStats($id);

$itemID=$_POST['ItemId'];
$sell = $sql->getSell($itemID);

  if($result['Items']==0)
    $items=0;
  else
    $items=$result['Items']-1;

  if($sell['Equipped']=="yes")
  {
    $Strength=$sell['Strength'];
    $Constitution=$sell['Constitution'];
    $Dexterity=$sell['Dexterity'];
    $Intelligence=$sell['Intelligence'];

    $updateSellUser = $sql->updateSellUser($Strength,$Constitution,$Dexterity,$Intelligence,$id);
    $updateSellItem = $sql->updateSellItem('no',$itemID);
    $updateSellGold = $sql->updateSellGold($sell['Worth'],$items,$id);
    $deleteSellItem = $sql->deleteSellItem($itemID);
?><script>alert("Successful");
  window.location = "sellshop.php"; </script>
<?php }

 else
  {
     $updateSellGold = $sql->updateSellGold($sell['Worth'],$items,$id);
     $deleteSellItem = $sql->deleteSellItem($itemID);

?><script>alert("Successful");
  window.location = "sellshop.php"; </script>
<?php } ?>