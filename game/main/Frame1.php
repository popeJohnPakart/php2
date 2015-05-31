<?php

error_reporting(E_PARSE|| E_ERROR);


require_once('../../class/dbinterface.php');  
require_once('../../class/dbmethods.php'); 
require_once('../../class/dbinfo.php');

$sql = new UserInfo(new UserDB('localhost','rpg',3306,'root',''));

$id = $_COOKIE['playerID'];

$User = $sql->getStats($id);

if($User['Items']>=20)
{
  echo "<b>Inventory full</b>";

?><script>alert("Successful !");
  window.location = "inventory.php"; </script>
<?php }

else
{
  $Name=$_POST['Name'];
  $Owner=$_POST['Owner'];
  $Worth=$_POST['Worth'];
  $ItemClass=$_POST['Class'];
  $Strength=$_POST['Strength'];
  $Constitution=$_POST['Constitution'];
  $Dexterity=$_POST['Dexterity'];
  $Intelligence=$_POST['Intelligence'];


  $addItems = $sql->getItemInfo6($id,$Name,$ItemClass,$Strength,$Constitution,$Dexterity,$Intelligence,$Worth);
  $id = $sql->addItems6();

  $updateUserItem = $sql->updateUserItem($id);
  $User['Items']+=1;
  $CheckItemSlot=20-$User['Items'];
  echo $CheckItemSlot." item slots remaining";

?><script>alert("Successful !");
  window.location = "inventory.php"; </script>
<?php } ?>