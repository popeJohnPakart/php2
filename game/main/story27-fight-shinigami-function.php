<script type="text/javascript">
  function Disable(txt)
  {
    if(txt==1)
    {
      document.getElementById("Button2").disabled=true
      document.getElementById("Button2").value='Item taken'
      document.getElementById("form2").submit()
    }
  }
</script>


<?php 

function Table($Monster, $User)
{
  $sql = new UserInfo(new UserDB('localhost','rpg',3306,'root',''));

  $id = $_COOKIE['playerID'];

  $User = $sql->getStats($id);
  echo "<font color='white'>";
  echo"<br><br>";
  echo"<center>";
  echo "<br><h3>$Monster[Name] has $Monster[HP] HP left.</h3>";
  echo "<br><h3>You have $User[HP] HP.</h3>";


  echo "<form action=\"story27-fight-shinigami.php\" method=\"post\">";
  echo "<table>
  <tr>
    <td>";
      echo "<input class=\"button\" type=\"submit\" value=\"Attack\" name=\"Attack\" />
    </td>";



    $UserSpells = $sql->getUserSpells($User['ID']);
    $row = count($UserSpells);


    echo "
    <td>
      <select class=\"select\" name=\"UserSpell\" id=\"UserSpell\">";

        if($row > 0)
        {
          foreach($UserSpells as $test)
          {          
            echo "<option value=\"$test[ID]\">$test[Name]</option>";
          }
        }

        echo "</select>

      </td>";




  echo "<td>
  <input class=\"button\" type=\"submit\" value=\"Cast\" name=\"Cast\" />
</td>";



$Potion = $sql->getPotion($User['ID']);
$row = count($Potion);


  if($row > 0)
  {
    echo "<td>
    <input class=\"button\" type=\"submit\" value=\"Use\" name=\"Use\" /></td>
    <td>";


      echo "<select class=\"select\" name=\"UserItem\" id=\"UserItem\">";

      foreach($Potion as $Item)
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
      echo "</select>
    </td>
  </tr>
</table>";
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
<input type=\"hidden\" value=\"$Monster[Intelligence]\" name=\"Intelligence\">
</form>";

echo"</center>";
}







function CalcDamage($Att, $Def)
{

  $Damage=(600/10)+($Att['Strength']-$Def['Constitution'])*0.5;

  $Damage=rand($Damage*0.9,$Damage*1.1);

  return $Damage;
}



function Turn($Monster, $User)
{

  $sql = new UserInfo(new UserDB('localhost','rpg',3306,'root',''));
  $id = $_COOKIE['playerID'];
  $User = $sql->getStats($id);


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
    $MonsterSpell = $sql->getMonsterSpell(2);


    $hit = "$Monster[Name] blasts you with $MonsterSpell[Name]";
    $miss = "$Monster[Name] blasts you with $MonsterSpell[Name], but you dodge it!";
    $block = "$Monster[Name] blasts you with $MonsterSpell[Name], but is unable to hurt you!";
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
      $MonsterSpell = $sql->getMonsterSpell($Monster['Spell']);

      $hit = "$Monster[Name] blasts you with $MonsterSpell[Name]";
      $miss = "$Monster[Name] blasts you with $MonsterSpell[Name], but you dodge it!";
      $block = "$Monster[Name] blasts you with $MonsterSpell[Name], but is unable to hurt you!";
    }
  }



  $EvasionChance = rand(1,50);
  $Rand = rand(1,100);


  if($Rand>=$EvaionChance)
  {

    $Damage=CalcDamage($Monster, $User);

    if($Damage>0)
    {
      echo $hit." for $Damage damage!<br>";
      $User['HP']-=$Damage;
      $updateHPAttackbyMonster = $sql->updateHPAttackbyMonster($User['HP'],$id);
    }
    else
      echo $miss."<br>";
  }
  else
    echo $block."<br>";
  return $User['HP'];
}





function Spell($Monster, $User, $Spell)
{
  $sql = new UserInfo(new UserDB('localhost','rpg',3306,'root',''));
  $id = $_COOKIE['playerID'];
  $User = $sql->getStats($id);

  $Damage=CalcDamage($User, $Monster)+($Spell['Power']);

/*  $UserCastSpell = $sql->updateSubtractMP($Spell['ManaCost'],$User['ID']);*/

  return $Damage;

}



function Potion($User,$PotionID)
{
  $sql = new UserInfo(new UserDB('localhost','rpg',3306,'root',''));
  $id = $_COOKIE['playerID'];
  $User = $sql->getStats($id);

  $Potion = $sql->getUserPotion($PotionID);

  $HPHeal=$Potion['Strength'];
  $MPHeal=$Potion['Intelligence'];


  if($MPHeal!=0&&$HPHeal!=0)
  {
    echo "You drink the potion, and recover $HPHeal HP and $MPHeal MP<br><br>";
  }
  elseif($MPHeal==0&&$HPHeal!=0)
  {
    echo "You drink the HP potion, and recover $HPHeal HP<br><br>";
    $User['HP']+=$HPHeal;
  }
  elseif($MPHeal!=0&&$HPHeal==0)
  {
    echo "You drink the MP potion, and recover $MPHeal MP<br><br>";
    $User['MP']+=$MPHeal;
  }


  
  
  if($User['HP']>$User['MaxHP'])
    $User['HP'] = $User['MaxHP'];
  if($User['MP']>$User['MaxMP'])
    $User['MP'] = $User['MaxMP'];


  return $User;
}



function win($Monster,$User)
{
  $sql = new UserInfo(new UserDB('localhost','rpg',3306,'root',''));

  $id = $_COOKIE['playerID'];

  $User = $sql->getStats($id);



  $Gold=$Monster['Level']*rand(80,100);



echo "<table border=\"0\"><tr>
 <font color='white'>

<td align=\"center\"> <font color='white'>Congratulations! You killed the $Monster[Name]!<br />
  You gain $Gold gold<br />

  <form action=\"story27-fight-shinigami.php\" method=\"post\">
    <input type=\"hidden\" name=\"Name\" value=\"$Monster[Name]\"><br>

      ----------<br>   
  
  </form></td>
</tr></table>";

 echo "<a href='story28.html'><input class=\"button\" type='Submit' value='Continue Story'><br /></a>";

$updateEndOfFight = $sql->updateEndOfFight($User['HP'],$Gold,$id);

die();
}

?>
