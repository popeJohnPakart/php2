
<?php
error_reporting(E_PARSE|| E_ERROR);
/*include 'connect.php';


$Player=1;
$Query="SELECT * from Users where ID='$Player'";
$Query2=mysql_query($Query) or die("Could not get user stats");
$User=mysql_fetch_array($Query2);*/

require_once('../../class/dbinterface.php');  
require_once('../../class/dbmethods.php'); 
require_once('../../class/dbinfo.php');

$sql = new UserInfo(new UserDB('localhost','rpg',3306,'root',''));

$id = $_COOKIE['playerID'];
$User = $sql->getStats($id);


$Equip=$_POST['equip'];
$Unequip=$_POST['unequip'];
$SpellID=$_GET['id'];
$ID=$_POST['ItemId'];



if($Equip)
{
          /*  $Query=mysql_query("Select * from Items where ID='$ID'") or die("Could not get item1");
          $Item=mysql_fetch_array($Query);*/

          $Item = $sql->getEquipItem($ID);


          if($Item['ItemClass']=="Primary")
                $EItem  = $sql->getWeapon1($User['ID']);
          if($Item['ItemClass']=="Secondary")
                $EItem  = $sql->getWeapon2($User['ID']);
          if($Item['ItemClass']=="Helm")
                $EItem  = $sql->getHelm1($User['ID']);

/*          if($Item['ItemClass']=="Chest armour")
            $Query=mysql_query("Select * from Items where Owner='$Player' AND ItemClass='Chest armour' AND Equipped='yes'") or die("Could not get item4");
          if($Item['ItemClass']=="Leg armour")
            $Query=mysql_query("Select * from Items where Owner='$Player' AND ItemClass='Leg armour' AND Equipped='yes'") or die("Could not get item5");
          if($Item['ItemClass']=="Gloves")
            $Query=mysql_query("Select * from Items where Owner='$Player' AND ItemClass='Gloves' AND Equipped='yes'") or die("Could not get item6");
          if($Item['ItemClass']=="Helmet")
            $Query=mysql_query("Select * from Items where Owner='$Player' AND ItemClass='Helmet' AND Equipped='yes'") or die("Could not get item");*/

          /*$EItem=mysql_fetch_array($Query);*/


          if(isset($EItem))
          {
            $Strength2=$EItem['Strength'];
            $Constitution2=$EItem['Constitution'];
            $Dexterity2=$EItem['Dexterity'];
            $Intelligence2=$EItem['Intelligence'];


            $Query1  = $sql->updateEquipItem($Strength2,$Constitution2,$Dexterity2,$Intelligence2,$User['ID']);
            $Query2  = $sql->updateEquipItem1($EItem['ID']);
          }
       
            $Str=$Item['Strength']."<br>";
            $Con=$Item['Constitution']."<br>";
            $Dex=$Item['Dexterity']."<br>";
            $Int=$Item['Intelligence']."<br>";

            $Query3  = $sql->updateEquipItem2($Str,$Con,$Dex,$Int,$User['ID']);
            $Query4  = $sql->updateEquipItem3($Item['ID']);


          /*$Query3="Update Users set Strength=Strength+'$Strength', Constitution=Constitution+'$Constitution', Dexterity=Dexterity+'$Dexterity', Intelligence=Intelligence+'$Intelligence', Concentration=Concentration+'$Concentration' where ID='$Player'";

          $Query4="Update Items set Equipped='yes' where ID='$Item[ID]'";*/


          echo "<b>Item equipped</b><br />";
}






elseif($Unequip)
{
 /* $Query=mysql_query("Select * from Items where ID='$ID'") or die("Could not get item7");
  $Item=mysql_fetch_array($Query);*/

  $Item = $sql->getEquipItem($ID);

  $Strength2=$Item['Strength'];
  $Constitution2=$Item['Constitution'];
  $Dexterity2=$Item['Dexterity'];
  $Intelligence2=$Item['Intelligence'];

   $Query1  = $sql->updateEquipItem($Strength2,$Constitution2,$Dexterity2,$Intelligence2,$User['ID']);
   $Query2  = $sql->updateEquipItem1($Item['ID']);
/*
  $Query2="Update Users set Strength=Strength-'$Strength2', Constitution=Constitution-'$Constitution2', Dexterity=Dexterity-'$Dexterity2', Intelligence=Intelligence-'$Intelligence2', Concentration=Concentration-'$Concentration2' where ID='$Player'";


  $Query3="Update Items set Equipped='no' where ID='$Item[ID]'";*/

  echo "<b>Item unequipped</b><br />";
}





//equipped
/*$Query=mysql_query("select * from Items where Owner='$Player' AND Equipped='yes' ") or die("Could not get inventory");*/
$ItemsEquip = $sql->getUserEquipItem($User['ID']);
$row = count($ItemsEquip);

echo "Equipped:<br /><table id=\"table\">";
echo "<tr>
<td>Name</td>
<td>Worth</td>
<td>Class</td>
<td>Strength</td>
<td>Dexterity</td>
<td>Constitution</td>
<td>Intelligence</td>
<td>Equip</td>
</tr>";


if($row > 0)
{
      foreach($ItemsEquip as $Item)
      {       

        echo "<tr>";   
        echo "<td>".$Item['Name']."</td>";
        echo "<td>".$Item['Worth']."</td>";
        echo "<td>".$Item['ItemClass']."</td>";
        echo "<td>".+$Item['Strength']."</td>";
        echo "<td>".+$Item['Constitution']."</td>";
        echo "<td>".+$Item['Dexterity']."</td>";
        echo "<td>".+$Item['Intelligence']."</td>";

        echo "<td>
        <form action=\"test.php\" method=\"post\"><input class=\"noborderbutton\" type=\"submit\" name=\"unequip\" value=\"unequip\" />
          <input type=\"hidden\" value=\"$Item[ID]\" name=\"ItemId\" />
        </form>
      </td>   
    </tr>   
    ";
    }
}
echo "</table><br />";






//weapons
/*$Query=mysql_query("select * from Items where Owner='$Player' AND ItemClass='Short weapon' OR Owner='$Player' AND ItemClass='Long weapon'") or die("Could not get inventory");*/
$Weapons  = $sql->getWeapon($User['ID'],$User['ID']);
$row = count($Weapons);

echo "Weapons:<br /><table id=\"table\">";
echo "<tr>
          <td>Name</td>
          <td>Worth</td>
          <td>Class</td>
          <td>Strength</td>
          <td>Constitution</td>
          <td>Dexterity</td>
          <td>Intelligence</td>
          <td>Equip</td>
      </tr>";

if($row > 0)
{
      foreach($Weapons as $Item)
      {       
          if($Item['Equipped']=="yes")
          {
            $Item['Name']="$Item[Name] {Equipped}";
          }
        echo "<tr>";   
                  echo "<td>".$Item['Name']."</td>";
                  echo "<td>".$Item['Worth']."</td>";
                  echo "<td>".$Item['ItemClass']."</td>";
                  echo "<td>".+$Item['Strength']."</td>";
                  echo "<td>".+$Item['Constitution']."</td>";
                  echo "<td>".+$Item['Dexterity']."</td>";
                  echo "<td>".+$Item['Intelligence']."</td>";



                  echo "<td>
                            <form action=\"test.php\" method=\"post\">
                            <input class=\"noborderbutton\" type=\"submit\" name=\"equip\" value=\"equip\" />
                            <input type=\"hidden\" value=\"$Item[ID]\" name=\"ItemId\" />
                            </form>
                       </td>   
              </tr>   
                 ";
    }
}

echo "</table><br />";







if($SpellID)
{
  $DeleteSpell  = $sql->deleteSpell($SpellID);
  echo "<div>Spell deleted</div>";
}




/*$Helm = $sql->getHelm($User['ID']);
$row = count($Helm);
*/
/*$Armor  = $sql->getArmor($User['ID']);
$row = count($Armor);

$Gloves = $sql->getGloves($User['ID']);
$row = count($Gloves);

$Boots = $sql->getBoots($User['ID']);
$row = count($Boots);
*/












$Helm  = $sql->getHelm($User['ID']);
$row = count($Helm);

echo "Equipments:<br /><table id=\"table\">";
echo "<tr>
          <td>Name</td>
          <td>Worth</td>
          <td>Class</td>
          <td>Strength</td>
          <td>Constitution</td>
          <td>Dexterity</td>
          <td>Intelligence</td>
          <td>Equip</td>
      </tr>";

if($row > 0)
{
      foreach($Helm as $Item)
      {       
          if($Item['Equipped']=="yes")
          {
            $Item['Name']="$Item[Name] {Equipped}";
          }
        echo "<tr>";   
                  echo "<td>".$Item['Name']."</td>";
                  echo "<td>".$Item['Worth']."</td>";
                  echo "<td>".$Item['ItemClass']."</td>";
                  echo "<td>".+$Item['Strength']."</td>";
                  echo "<td>".+$Item['Constitution']."</td>";
                  echo "<td>".+$Item['Dexterity']."</td>";
                  echo "<td>".+$Item['Intelligence']."</td>";

                  echo "<td>
                            <form action=\"test.php\" method=\"post\"><input class=\"noborderbutton\" type=\"submit\"  name=\"equip\" value=\"equip\" />
                            <input type=\"hidden\" value=\"$Item[ID]\" name=\"ItemId\" />
                            </form>
                       </td>   
              </tr>   
                 ";
    }
}



$ChestArmor  = $sql->getArmor($User['ID']);
$row = count($ChestArmor);



if($row > 0)
{
      foreach($ChestArmor as $Item)
      {       
          if($Item['Equipped']=="yes")
          {
            $Item['Name']="$Item[Name] {Equipped}";
          }
        echo "<tr>";   
                  echo "<td>".$Item['Name']."</td>";
                  echo "<td>".$Item['Worth']."</td>";
                  echo "<td>".$Item['ItemClass']."</td>";
                  echo "<td>".+$Item['Strength']."</td>";
                  echo "<td>".+$Item['Constitution']."</td>";
                  echo "<td>".+$Item['Dexterity']."</td>";
                  echo "<td>".+$Item['Intelligence']."</td>";

                  echo "<td>
                            <form action=\"test.php\" method=\"post\"><input class=\"noborderbutton\" type=\"submit\"  name=\"equip\" value=\"equip\" />
                            <input type=\"hidden\" value=\"$Item[ID]\" name=\"ItemId\" />
                            </form>
                       </td>   
              </tr>   
                 ";
    }
}




$LegArmor  = $sql->getLegArmor($User['ID']);
$row = count($LegArmor);


if($row > 0)
{
      foreach($LegArmor as $Item)
      {       
          if($Item['Equipped']=="yes")
          {
            $Item['Name']="$Item[Name] {Equipped}";
          }
        echo "<tr>";   
                  echo "<td>".$Item['Name']."</td>";
                  echo "<td>".$Item['Worth']."</td>";
                  echo "<td>".$Item['ItemClass']."</td>";
                  echo "<td>".+$Item['Strength']."</td>";
                  echo "<td>".+$Item['Constitution']."</td>";
                  echo "<td>".+$Item['Dexterity']."</td>";
                  echo "<td>".+$Item['Intelligence']."</td>";

                  echo "<td>
                            <form action=\"test.php\" method=\"post\"><input class=\"noborderbutton\" type=\"submit\"  name=\"equip\" value=\"equip\" />
                            <input type=\"hidden\" value=\"$Item[ID]\" name=\"ItemId\" />
                            </form>
                       </td>   
              </tr>   
                 ";
    }
}





$Gloves = $sql->getGloves($User['ID']);
$row = count($Gloves);


if($row > 0)
{
      foreach($Gloves as $Item)
      {       
          if($Item['Equipped']=="yes")
          {
            $Item['Name']="$Item[Name] {Equipped}";
          }
        echo "<tr>";   
                  echo "<td>".$Item['Name']."</td>";
                  echo "<td>".$Item['Worth']."</td>";
                  echo "<td>".$Item['ItemClass']."</td>";
                  echo "<td>".+$Item['Strength']."</td>";
                  echo "<td>".+$Item['Constitution']."</td>";
                  echo "<td>".+$Item['Dexterity']."</td>";
                  echo "<td>".+$Item['Intelligence']."</td>";

                  echo "<td>
                            <form action=\"test.php\" method=\"post\"><input class=\"noborderbutton\" type=\"submit\"  name=\"equip\" value=\"equip\" />
                            <input type=\"hidden\" value=\"$Item[ID]\" name=\"ItemId\" />
                            </form>
                       </td>   
              </tr>   
                 ";
    }
}








$Boots = $sql->getBoots($User['ID']);
$row = count($Boots);



if($row > 0)
{
      foreach($Boots as $Item)
      {       
          if($Item['Equipped']=="yes")
          {
            $Item['Name']="$Item[Name] {Equipped}";
          }
        echo "<tr>";   
                  echo "<td>".$Item['Name']."</td>";
                  echo "<td>".$Item['Worth']."</td>";
                  echo "<td>".$Item['ItemClass']."</td>";
                  echo "<td>".+$Item['Strength']."</td>";
                  echo "<td>".+$Item['Constitution']."</td>";
                  echo "<td>".+$Item['Dexterity']."</td>";
                  echo "<td>".+$Item['Intelligence']."</td>";

                  echo "<td>
                            <form action=\"test.php\" method=\"post\"><input class=\"noborderbutton\" type=\"submit\"  name=\"equip\" value=\"equip\" />
                            <input type=\"hidden\" value=\"$Item[ID]\" name=\"ItemId\" />
                            </form>
                       </td>   
              </tr>   
                 ";
    }
}



echo "</table><br />";






























$Spell = $sql->getSpell($User['ID']);
$row = count($Spell);


echo "Spells:<br /><table id=\"table\">";
echo "<tr>
          <td>Name</td>
          <td>Power</td>
          <td>Drop?</td>
      </tr>";


if($row > 0)
{
      foreach($Spell as $Item)
      {       
        echo "<tr>";   
        echo "<td>".$Item['Name']."</td>";
        echo "<td>".$Item['Power']."</td>";
       

        echo "<td>
                  <a href=\"test.php?id=".$Item['ID']."\">Drop
              </form>
      </td>   
    </tr>   
    ";
    }
}

echo "</table><br />";



?>