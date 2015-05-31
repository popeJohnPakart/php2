<script type="text/javascript">
  function Disable(txt)
  {
    if(txt==1)
    {
      document.getElementById("Button").disabled=true
      document.getElementById("Button").value='Item taken'
      document.getElementById("form1").submit()
    }
    if(txt==2)
    {
      document.getElementById("Button2").disabled=true
      document.getElementById("Button2").value='Item taken'
      document.getElementById("form2").submit()
    }
    if(txt==3)
    {
      document.getElementById("Button").disabled=true
      document.getElementById("Button").value='Spell taken'
      document.getElementById("form1").submit()
    }
    if(txt==4)
    {
      document.getElementById("Button2").disabled=true
      document.getElementById("Button2").value='Spell taken'
      document.getElementById("form2").submit()
    }
  }
</script>

<?php


function Table($Monster, $User)
{
  print "<br><h3>$Monster[Name] has $Monster[HP] HP left.</h3>";
  print "<br><h3>You have $User[HP] HP and $User[MP] MP left.</h3></p>";


  print "<form action=\"fight.php\" method=\"post\">";
  print "<table><tr><td>";
  print "<input class=\"button\" type=\"submit\" value=\"Attack\" name=\"Attack\" /></td>";



  $Query=mysql_query("select * from UserSpells where Owner='$User[ID]'") or die("DIE!");
  $Count=mysql_num_rows($Query);
  if($Count!=0)
  {
    print "<td><select class=\"select\" name=\"UserSpell\" id=\"UserSpell\">";
    while($Spell=mysql_fetch_array($Query))
    {
      echo "<option value=\"$Spell[ID]\">$Spell[Name] - $Spell[Level]</option>";
    }
    print "</select></td>";
    print "<td><input class=\"button\" type=\"submit\" value=\"Cast\" name=\"Cast\" /></td>";
  }






  print "</tr></table><table><tr><td>";
  $Query=mysql_query("SELECT * FROM Items where Amount!='0' and Owner='$User[ID]'") or die("Could not find items.");
  $Count=mysql_num_rows($Query);
  if($Count>0)
  {
    print "<td><input class=\"button\" type=\"submit\" value=\"Use\" name=\"Use\" /></td><td>";
    print "<select class=\"select\" name=\"UserItem\" id=\"UserItem\">";
    while($Item=mysql_fetch_array($Query))
    {
      if($Item['Amount'] > 0)
      {
        if($Item['Strength']>0 and $Item['Intelligence']==0)
          echo "<option value=\"$Item[ID]\">$Item[Name] -- $Item[Amount] Left</option>";
        if($Item['Strength']==0 and $Item['Intelligence']>0)
          echo "<option value=\"$Item[ID]\">$Item[Name] -- $Item[Amount] Left</option>";
        if($Item['Strength']>0 and $Item['Intelligence']>0)
          echo "<option value=\"$Item[ID]\">$Item[Name] -- $Item[Amount] Left</option>";
      }
    }
    print "</select></td></tr></table>";
  }

  echo "<input type=\"hidden\" value=\"$Monster[Name]\" name=\"Name\">
  <input type=\"hidden\" value=\"$Monster[HP]\" name=\"HP\">
  <input type=\"hidden\" value=\"$Monster[Level]\" name=\"Level\">
  <input type=\"hidden\" value=\"$Monster[Type]\" name=\"Type\">
  <input type=\"hidden\" value=\"$Monster[Spell]\" name=\"Spell\">
  <input type=\"hidden\" value=\"$Monster[MP]\" name=\"MP\">
  <input type=\"hidden\" value=\"$Monster[Strength]\" name=\"Strength\">
  <input type=\"hidden\" value=\"$Monster[Constitution]\" name=\"Constitution\">
  <input type=\"hidden\" value=\"$Monster[Dexterity]\" name=\"Dexterity\">
  <input type=\"hidden\" value=\"$Monster[Concentration]\" name=\"Concentration\">
  <input type=\"hidden\" value=\"$Monster[Intelligence]\" name=\"Intelligence\">
</form>";
}





  //--------------------------------------------------------------

function CalcDamage($Att, $Def, $Type)
{

    $Damage=($Def['MaxHP']/10)+($Att['Strength']-$Def['Constitution'])*0.5;

    $Damage=rand($Damage*0.9,$Damage*1.1);

     return $Damage;
}

  //--------------------------------------------------------------

function Turn($Monster, $User)
{
  if($Monster['Type'] == 0)
  {
    $type = "Melee";
    $hit = "The $Monster[Name] attacks you";
    $miss = "The $Monster[Name] tries to attack you, but you dodge it!";
    $block = "The $Monster[Name] attacks you, but you block its attack!";
  }


  elseif($Monster['Type']==1)
  {
    $type = "Magic";
    $Query="Select * from Spells where ID='$Monster[Spell]'";
    $Query2=mysql_query($Query) or die("Failed to get spells for monster");
    $Spell=mysql_fetch_array($Query2);
    $hit = "$Monster[Name] blasts you with $Spell[Name]";
    $miss = "$Monster[Name] blasts you with $Spell[Name], but you dodge it!";
    $block = "$Monster[Name] blasts you with $Spell[Name], but is unable to hurt you!";
  }


  else if($Monster['Type'] == 2)
  {
    $rand=rand(1,2);
    if($rand == 1)
    {
      $type = "Melee";
      $hit = "$Monster[Name] attacks you";
      $miss = "$Monster[Name] tries to attack you, but you dodge it!";
      $block = "$Monster[Name] attacks you, but you block its attack!";
    }
    else
    {
      $type = "Magic";
      $Query="Select * from Spells where ID='$Monster[Spell]'";
      $Query2=mysql_query($Query) or die("Failed to get spells for monster");
      $Spell=mysql_fetch_array($Query2);
      $hit = "$Monster[Name] blasts you with $Spell[Name]";
      $miss = "$Monster[Name] blasts you with $Spell[Name], but you dodge it!";
      $block = "$Monster[Name] blasts you with $Spell[Name], but is unable to hurt you!";
    }
  }



  $Player = $User['ID'];

  $Chance = rand(1,50);

  $Rand = rand(1,100);



  if($Rand>=$Chance)
  {
      $Damage=CalcDamage($Monster, $User, $type);
      if($Damage>0)
      {
        echo $hit." for $Damage damage!";
        $User['HP']-=$Damage;
        mysql_query("Update Users set HP='$User[HP]' where ID='$Player'") or die("Could not update player stats");
      }
      else
        echo $miss;
  }
  else
    echo $block;
  echo "</p>";
  return $User['HP'];
}





  //--------------------------------------------------------------

function Spell($Monster, $User, $Spell)
{
  $Damage=CalcDamage($User, $Monster, $Type)+($Spell['Power']);
/*  mysql_query("Update Users set MP=MP-'$Spell[Level]' where ID='$User[ID]'")or die("Could not subtract MP cost");*/
  return $Damage;

}

  //--------------------------------------------------------------

function Potion($User,$PotionID)
{
  $Query="Select * from Items where ID='$PotionID'";
  $Query2=mysql_query($Query) or die("Could not get items for user");
  $Potion=mysql_fetch_array($Query2);
  $MPHeal=$Potion['Intelligence'];
  $HPHeal=$Potion['Strength'];
  if($MPHeal!=0&&$HPHeal!=0)
    echo "<p>You drink the potion, and recover $HPHeal HP and $MPHeal MP<br /></p>";
  elseif($MPHeal==0&&$HPHeal!=0)
    echo "<p>You drink the potion, and recover $HPHeal HP<br /></p>";
  elseif($MPHeal!=0&&$HPHeal==0)
    echo "<p>You drink the potion, and recover $MPHeal MP<br /></p>";
  $User['HP']+=$HPHeal;
  $User['MP']+=$MPHeal;
  if($User['HP']>$User['MaxHP'])
    $User['HP'] = $User['MaxHP'];
  if($User['MP']>$User['MaxMP'])
    $User['MP'] = $User['MaxMP'];
  return $User;
}

  //--------------------------------------------------------------

function win($Monster,$User)
{
  $Player=$User['ID'];


  $a=1;

  $Exp=$Monster['Level']*rand(80,100);
  $Gold=$Monster['Level']*rand(80,100);

  $Strength = 0;
  $Constitution = 0;
  $Dexterity = 0;
  $Concentration = 0;
  $Intelligence = 0;
  
  $Rand=rand(1,6);
  if($Rand>$a)
  {
    $Rand=rand(1,6);
    if($Rand==1){$Class="Short weapon"; $Name="Dagger"; $Worth="100 Gold"; $Strength = "100";}
    elseif($Rand==2){$Class="Long weapon"; $Name="Long Sword"; $Worth="100 Gold"; $Constitution = "100";}
    elseif($Rand==3){$Class="Chest armour"; $Name="Plate mail"; $Worth="100 Gold"; $Dexterity = "100";}
    elseif($Rand==4){$Class="Leg armour"; $Name="Iron plated pants"; $Worth="100 Gold"; $Concentration = "100";}
    elseif($Rand==5){$Class="Helmet"; $Name="Hat"; $Worth="100 Gold"; $Intelligence = "100";}
    elseif($Rand==6){$Class="Gloves"; $Name="Mittens"; $Worth="100 Gold"; $Intelligence = "100";}




    $Item2="Name: $Name <br>
           Worth: $Worth <br>
           Class: $Class <br>
           Strength: $Strength <br>
           Constitution: $Constitution <br>
           Dexterity: $Dexterity <br>
           Concentration: $Concentration <br>
           Intelligence: $Intelligence <br>
           -----<br>";




    $Button2="<form action=\"Frame1.php\" id=\"form2\" target=\"frame\" method=\"post\">
    <input class=\"button\" type=\"submit\" value='Take item' onclick='Disable(2)' id=\"Button2\">
    <input type=\"hidden\" value=\"$Strength\" name=\"Strength\">
    <input type=\"hidden\" value=\"$Constitution\" name=\"Constitution\">
    <input type=\"hidden\" value=\"$Dexterity\" name=\"Dexterity\">
    <input type=\"hidden\" value=\"$Intelligence\" name=\"Intelligence\">
    <input type=\"hidden\" value=\"$Concentration\" name=\"Concentration\">
    <input type=\"hidden\" value=\"$Name\" name=\"Name\">
    <input type=\"hidden\" value=\"$Worth\" name=\"Worth\">
    <input type=\"hidden\" value=\"$Owner\" name=\"Owner\">
    <input type=\"hidden\" value=\"$Class\" name=\"Class\">
  </form>";


}



echo "<table border=\"0\"><tr>


<td align=\"center\">Congratulations! You killed the $Monster[Name]!<br />
  You gain $Exp experience, and $Gold gold<br />
  <form action=\"fight.php\" method=\"post\">
    <input type=\"hidden\" name=\"Name\" value=\"$Monster[Name]\">


    <input class=\"button\" type='Submit' name='Fight' value='Fight $Monster[Name] again'><br />


  </form></td>
  <td align=\"center\">$Item2 $Button2</td>
</tr></table>";




mysql_query("Update Users set HP='$User[HP]', Experience=Experience+'$Exp', SkillExp=SkillExp+'$Exp', Gold=Gold+'$Gold', Fighting='0' where ID='$Player'") or die("Could not update player stats");
$User['Experience']+=$Exp;


die();
}

?>