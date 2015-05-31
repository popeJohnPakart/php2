<?php
error_reporting(E_PARSE|| E_ERROR);


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

          $Item = $sql->getEquipItem($ID);


          if($Item['ItemClass']=="Primary")
                $EItem  = $sql->getWeapon1($User['ID']);
          if($Item['ItemClass']=="Secondary")
                $EItem  = $sql->getWeapon2($User['ID']);
          if($Item['ItemClass']=="Helm")
                $EItem  = $sql->getHelm1($User['ID']);
          if($Item['ItemClass']=="Chest Armor")
                $EItem  = $sql->getArmor1($User['ID']);
          if($Item['ItemClass']=="Leg Armor")
                $EItem  = $sql->getLegArmor1($User['ID']);
          if($Item['ItemClass']=="Gloves")
                $EItem  = $sql->getGloves1($User['ID']);
          if($Item['ItemClass']=="Boots")
                $EItem  = $sql->getBoots1($User['ID']);

/*          if($Item['ItemClass']=="Primary")
            $Query=mysql_query("Select * from Items where Owner='$Player' AND ItemClass='Primary' AND Equipped='yes'");
          if($Item['ItemClass']=="Secondary")
            $Query=mysql_query("Select * from Items where Owner='$Player' AND ItemClass='Secondary' AND Equipped='yes'");
          if($Item['ItemClass']=="Chest Armor")
            $Query=mysql_query("Select * from Items where Owner='$Player' AND ItemClass='Chest Armor' AND Equipped='yes'");
          if($Item['ItemClass']=="Leg Armor")
            $Query=mysql_query("Select * from Items where Owner='$Player' AND ItemClass='Leg Armor' AND Equipped='yes'");
          if($Item['ItemClass']=="Gloves")
            $Query=mysql_query("Select * from Items where Owner='$Player' AND ItemClass='Gloves' AND Equipped='yes'");
          if($Item['ItemClass']=="Boots")
            $Query=mysql_query("Select * from Items where Owner='$Player' AND ItemClass='Helmet' AND Equipped='yes'");

          $EItem=mysql_fetch_array($Query);
*/

          if(isset($EItem))
          {
            $Strength2=$EItem['Strength'];
            $Constitution2=$EItem['Constitution'];
            $Dexterity2=$EItem['Dexterity'];
            $Intelligence2=$EItem['Intelligence'];


            $Query1  = $sql->updateEquipItem($Strength2,$Constitution2,$Dexterity2,$Intelligence2,$User['ID']);
            $Query2  = $sql->updateEquipItem1($EItem['ID']);
          }



            $Item = $sql->getEquipItem($ID);

            $Str=$Item['Strength']."<br>";
            $Con=$Item['Constitution']."<br>";
            $Dex=$Item['Dexterity']."<br>";
            $Int=$Item['Intelligence']."<br>";

           $Query3  = $sql->updateEquipItem2($Str,$Con,$Dex,$Int,$User['ID']);
           $Query4  = $sql->updateEquipItem3($Item['ID']);

}


elseif($Unequip)
{

  $Item = $sql->getEquipItem($ID);

  $Strength2=$Item['Strength'];
  $Constitution2=$Item['Constitution'];
  $Dexterity2=$Item['Dexterity'];
  $Intelligence2=$Item['Intelligence'];

   $Query1  = $sql->updateEquipItem($Strength2,$Constitution2,$Dexterity2,$Intelligence2,$User['ID']);
   $Query2  = $sql->updateEquipItem1($Item['ID']);

}


if($SpellID)
{
  $Spell  = $sql->deleteSpell($SpellID);
}



?>

<!DOCTYPE HTML>
<html>
<head>
<title>Blood Rite - The Lost Chapters</title>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-1.11.0.min.js"></script>
<!-- Custom Theme files -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/style1.css" type="text/css">

<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Google Fonts -->
<link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700' rel='stylesheet' type='text/css'>


  <style>


/*
Table Style - This is what you want
------------------------------------------------------------------ */
table a:link {
  color: #666;
  font-weight: bold;
  text-decoration:none;
}
table a:visited {
  color: #999999;
  font-weight:bold;
  text-decoration:none;
}
table a:active,
table a:hover {
  color: #bd5a35;
  text-decoration:underline;
}
table {
  font-family:Arial, Helvetica, sans-serif;
  color:#666;
  font-size:12px;
  text-shadow: 1px 1px 0px #fff;
  background:#eaebec;
  margin:20px;
  border:#ccc 1px solid;

  -moz-border-radius:3px;
  -webkit-border-radius:3px;
  border-radius:3px;

  -moz-box-shadow: 0 1px 2px #d1d1d1;
  -webkit-box-shadow: 0 1px 2px #d1d1d1;
  box-shadow: 0 1px 2px #d1d1d1;
}

table th {
  padding:21px 25px 22px 25px;
  border-top:1px solid #fafafa;
  border-bottom:1px solid #e0e0e0;

  background: #ededed;
  background: -webkit-gradient(linear, left top, left bottom, from(#ededed), to(#ebebeb));
  background: -moz-linear-gradient(top,  #ededed,  #ebebeb);
}
table th:first-child{
  text-align: left;
  padding-left:20px;
}
table tr:first-child th:first-child{
  -moz-border-radius-topleft:3px;
  -webkit-border-top-left-radius:3px;
  border-top-left-radius:3px;
}

table tr:first-child th:last-child{
  -moz-border-radius-topright:3px;
  -webkit-border-top-right-radius:3px;
  border-top-right-radius:3px;
}
table tr{
  text-align: center;
  padding-left:20px;
}
table tr td:first-child{
  text-align: left;
  padding-left:20px;
  border-left: 0;
}
table tr td {
  padding:18px;
  border-top: 1px solid #ffffff;
  border-bottom:1px solid #e0e0e0;
  border-left: 1px solid #e0e0e0;
  
  background: #fafafa;
  background: -webkit-gradient(linear, left top, left bottom, from(#fbfbfb), to(#fafafa));
  background: -moz-linear-gradient(top,  #fbfbfb,  #fafafa);
}
table tr.even td{
  background: #f6f6f6;
  background: -webkit-gradient(linear, left top, left bottom, from(#f8f8f8), to(#f6f6f6));
  background: -moz-linear-gradient(top,  #f8f8f8,  #f6f6f6);
}
table tr:last-child td{
  border-bottom:0;
}
table tr:last-child td:first-child{
  -moz-border-radius-bottomleft:3px;
  -webkit-border-bottom-left-radius:3px;
  border-bottom-left-radius:3px;
}
table tr:last-child td:last-child{
  -moz-border-radius-bottomright:3px;
  -webkit-border-bottom-right-radius:3px;
  border-bottom-right-radius:3px;
}
table tr:hover td{
  background: #f2f2f2;
  background: -webkit-gradient(linear, left top, left bottom, from(#f2f2f2), to(#f0f0f0));
  background: -moz-linear-gradient(top,  #f2f2f2,  #f0f0f0);  
}


</style>
</head>

<body>
<!-- Header Starts Here -->
  <div class="header">
    <div class="container">
      
      <span class="menu"></span>
      <div class="navigation">
        <ul class="navig cl-effect-3" >
          <li><a href="index.html">Home</a></li>
          <li><a href="stats.php">Stats</a></li>
          <li><a href="play.html">Play</a></li>
          <li><a href="shop.html">Shop</a></li>
                <li><a href="inventory.php">Inventory</a></li>
                <li><a href="revive.php">Revive</a></li>
        </ul>
      </div>

    </div>
  </div>




  <div id="body">
    <div>
      <div>
        <div class="media">
          <div>


          </div>
          <div class="article">
            <h3>Inventory</h3>
            <ul>
              <li>
                
                <?php 

                $ItemsEquip = $sql->getUserEquipItem($User['ID']);
                $row = count($ItemsEquip);

                echo "Equipped:<br /><table id=\"table\">";
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
                        <form action=\"inventory.php\" method=\"post\"><input class=\"noborderbutton\" type=\"submit\" name=\"unequip\" value=\"unequip\" />
                          <input type=\"hidden\" value=\"$Item[ID]\" name=\"ItemId\" />
                        </form>
                      </td>   
                    </tr>   
                    ";
                    }
                }
                echo "</table><br />";





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
                                            <form action=\"inventory.php\" method=\"post\"><input class=\"noborderbutton\" type=\"submit\"  name=\"equip\" value=\"equip\" />
                                            <input type=\"hidden\" value=\"$Item[ID]\" name=\"ItemId\" />
                                            </form>
                                       </td>   
                              </tr>   
                                 ";
                    }
                }

                echo "</table><br />";








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
                                            <form action=\"inventory.php\" method=\"post\"><input class=\"noborderbutton\" type=\"submit\"  name=\"equip\" value=\"equip\" />
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
                                            <form action=\"inventory.php\" method=\"post\"><input class=\"noborderbutton\" type=\"submit\"  name=\"equip\" value=\"equip\" />
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
                                            <form action=\"inventory.php\" method=\"post\"><input class=\"noborderbutton\" type=\"submit\"  name=\"equip\" value=\"equip\" />
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
                                            <form action=\"inventory.php\" method=\"post\"><input class=\"noborderbutton\" type=\"submit\"  name=\"equip\" value=\"equip\" />
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
                                            <form action=\"inventory.php\" method=\"post\"><input class=\"noborderbutton\" type=\"submit\"  name=\"equip\" value=\"equip\" />
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
                                  <a href=\"inventory.php?id=".$Item['ID']."\">Drop
                              </form>
                      </td>   
                    </tr>   
                    ";
                    }
                }

                echo "</table><br />";




                 ?>



            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>

<br><br>

<div class="footer">
  <div class="container">
    <ul class="social">
      <li><i class="fa"></i></li>
      <li><i class="fb"></i></li>
      <li><i class="fc"></i></li>
    </ul>
  <p>2014 Design by <a href="">GermZboy23</a></p>
  </div>
  
</div>
<!-- Footer Ends Here -->
</body>
</html>