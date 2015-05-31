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
  function Table($Monster, $User, $Special)
  {
    print "<p>the $Special $Monster[Name] has $Monster[HP] HP left.<br />";
    print "You have $User[hp] HP and $User[mp] MP left</p>";
    print "<form action=\"fight.php\" method=\"post\">";
    print "<table><tr><td>";
    print "<input class=\"button\" type=\"submit\" value=\"Attack\" name=\"Attack\" /></td>";
    /*print "<select class=\"select\" name=\"Skill\" id=\"Skill\">";
    $Query=mysql_query("select * from Skills where Owner='$User[ID]'") or die("No skills");
    while($Skill=mysql_fetch_array($Query))
    {
      echo "<option value=\"$Skill[ID]\">$Skill[Name]</option>";
    }
    print "</select></td>";*/
    $Query=mysql_query("select * from UserSpells where Owner='1'") or die("DIE!");
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
    print "<td><input class=\"button\" type=\"submit\" value=\"Run\" name=\"Run\" /></td></tr></table><table><tr><td>";
    $Query=mysql_query("SELECT * FROM Items where Amount!='0' and Owner='1'") or die("Could not find items.");
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
    $Special=str_replace(" ","%20",$Special);
    print "<input type=\"hidden\" value=\"$Monster[Name]\" name=\"Name\">
           <input type=\"hidden\" value=\"$Special\" name=\"Special\">
           <input type=\"hidden\" value=\"$Monster[HP]\" name=\"HP\">
           <input type=\"hidden\" value=\"$Monster[Level]\" name=\"Level\">
           <input type=\"hidden\" value=\"$Monster[Type]\" name=\"Type\">
           <input type=\"hidden\" value=\"$Monster[Spell]\" name=\"Spell\">
           <input type=\"hidden\" value=\"$Monster[MP]\" name=\"MP\">
           <input type=\"hidden\" value=\"$Monster[MaxHP]\" name=\"MaxHP\">
           <input type=\"hidden\" value=\"$Monster[MaxMP]\" name=\"MaxMP\">
           <input type=\"hidden\" value=\"$Monster[Strength]\" name=\"Strength\">
           <input type=\"hidden\" value=\"$Monster[Constitution]\" name=\"Constitution\">
           <input type=\"hidden\" value=\"$Monster[Dexterity]\" name=\"Dexterity\">
           <input type=\"hidden\" value=\"$Monster[Intelligence]\" name=\"Intelligence\">
           <input type=\"hidden\" value=\"$Monster[Concentration]\" name=\"Concentration\">
           </form>";
  }

  //--------------------------------------------------------------

  function CalcDamage($Att, $Def, $Type)
  {
/*    if($Type == "Magic")
    {
      $Damage=($Def['maxhp']/10)+($Att['intelligence']-$Def['concentration'])*0.5;
      if($Att['Race']=="Orc")
        $Damage*=0.9;
      elseif($Att['Race']=="Mage")
        $Damage*=1.1;
      $Damage=round(rand($Damage*0.9,$Damage*1.1));
    }
    else
    {*/
      $Damage=($Def['MaxHP']/10)+($Att['Strength']-$Def['Constitution'])*0.5;
      /*if($Att['Race']=="Orc")
        $Damage*=1.1;
      elseif($Att['Race']=="Mage")
        $Damage*=0.9;*/
      $Damage=round(rand($Damage*0.9,$Damage*1.1));
/*    }
    return $Damage;*/
  }

  //--------------------------------------------------------------

  function Turn($Monster, $User, $Special)
  {
    if($Monster['Type'] == 0)
    {
      $type = "Melee";
      $hit = "the $Special $Monster[Name] attacks you";
      $miss = "the $Special $Monster[Name] tries to attack you, but you dodge it!";
      $block = "the $Special $Monster[Name] attacks you, but you block its attack!";
    }
    else if($Monster['Type'] == 1)
    {
      $rand=rand(1,2);
      if($rand == 1)
      {
        $type = "Melee";
        $hit = "the $Special $Monster[Name] attacks you";
        $miss = "the $Special $Monster[Name] tries to attack you, but you dodge it!";
        $block = "the $Special $Monster[Name] attacks you, but you block its attack!";
      }
      else
      {
        $type = "Magic";
        $Query="Select * from Spells where ID='$Monster[Spell]'";
        $Query2=mysql_query($Query) or die("Failed to get spells for monster");
        $Spell=mysql_fetch_array($Query2);
        $hit = "the $Special $Monster[Name] blasts you with $Spell[Name]";
        $miss = "the $Special $Monster[Name] blasts you with $Spell[Name], but you dodge it!";
        $block = "the $Special $Monster[Name] blasts you with $Spell[Name], but is unable to hurt you!";
      }
    }
    elseif($Monster['Type']==2)
    {
      $type = "Magic";
      $Query="Select * from Spells where ID='$Monster[Spell]'";
      $Query2=mysql_query($Query) or die("Failed to get spells for monster");
      $Spell=mysql_fetch_array($Query2);
      $hit = "the $Special $Monster[Name] blasts you with $Spell[Name]";
      $miss = "the $Special $Monster[Name] blasts you with $Spell[Name], but you dodge it!";
      $block = "the $Special $Monster[Name] blasts you with $Spell[Name], but is unable to hurt you!";
    }
    $Player = 1;
    $Chance = $User['level']-$Monster['Level'];
    $Rand = rand(1,100);
    echo "<p>";
    if($Rand>=$Chance)
    {
      $Damage=CalcDamage($Monster, $User, $type);
      if($Damage>0)
      {
        echo $hit." for $Damage damage!";
        $User['hp']-=$Damage;
        mysql_query("Update Users set HP='$User[hp]' where ID='$Player'") or die("Could not update player stats");
      }
      else
        echo $miss;
    }
    else
      echo $dodge;
    echo "</p>";
    return $User['hp'];
  }

  //--------------------------------------------------------------

  function Spell($Monster, $User, $Spell)
  {
    $Damage=CalcDamage($User, $Monster, "Magic")*($Spell['Power']/100);
    if($Damage>0)
    {
      mysql_query("Update UserSpells set Exp=Exp+'$Monster[Level]' where ID='$Spell[ID]'");
      $Spell['Exp']+=$Monster['Level'];
      if($Spell['Exp']>=pow($Spell['Level']+5,2+$Spell['Level']/10))
      {
        while($Spell['Exp']>=pow($Spell['Level']+5,2+$Spell['Level']/10))
        {
          $Power = $Spell['Power'] / $Spell['Level'];
          mysql_query("Update UserSpells set Level=Level+'1', Power=Power+'$Power' where ID='$Spell[ID]'");
          echo "$Spell[Name] increased a level!<br />";
          $Spell['Level']++;
        }
      }
    }
    else
      $Damage=0;
    mysql_query("Update Users set MP=MP-'$Spell[Level]' where ID='1'")or die("Could not subtract MP cost");
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

  function win($Monster,$User,$Special)
  {
    $Player=$User['ID'];
    $Query=mysql_query("SELECT * from Guilds where Name='$User[Guild]'") or die("Could not get Guild stats");
    $Guild=mysql_fetch_array($Query);

    if($Special=="enraged")
    {
      $a=90;  //chance to get item
      $b=1.1; //item strength
      $c=1.2; //exp percentage
      $d=1.2; //gold percentage
    }
    elseif($Special=="intelligent")
    {
      $a=90;
      $b=1.1;
      $c=$d=1.2;
    }
    elseif($Special=="extreme")
    {
      $a=75;
      $b=1.25;
      $c=$d=2;
    }
    elseif($Special=="clumsy")
    {
      $a=80;
      $b=1.1;
      $c=$d=0.90;
    }
    else
    {
      $a=92;
      $b=$c=$d=1;
    }
    $a=100-(100-$a)*(1+$Guild['Itemfind']/100);

    $Exp=round($Monster['Level']*rand(80,120)/100*$c*(1+$Guild['Exp']/100));
    $Gold=round($Monster['Level']*rand(80,120)/100*$d*(1+$Guild['Gold']/100));

    $Strength = 0; $Constitution = 0; $Dexterity = 0; $Intelligence = 0; $Concentration = 0;

    $Rand=rand(1,100);
    if($Rand>$a)
    {
      if($Monster['Type']==1)
        $Rand=rand(1,7);
      elseif($Monster['Type']==2)
        $Rand=rand(1,14);
      else
        $Rand=rand(1,6);
      if($Rand==1){$Class="Short weapon"; $Name="Dagger";}
      elseif($Rand==2){$Class="Long weapon"; $Name="Long Sword";}
      elseif($Rand==3){$Class="Chest armour"; $Name="Plate mail";}
      elseif($Rand==4){$Class="Leg armour"; $Name="Iron plated pants";}
      elseif($Rand==5){$Class="Helmet"; $Name="Hat";}
      elseif($Rand==6){$Class="Gloves"; $Name="Mittens";}

      if($Rand<7)
      {
        $x=5;
        $Random=rand(1,$x);
        if($Random>=2&&$Random<=3)
        {
          $Strength=round(rand(1,$Monster['Level']*2*$b)*(1+$Guild['Itemquality']/100));
          $x++;
        }
        $Random=rand(1,$x);
        if($Random>=2&&$Random<=3)
        {
          $Constitution=round(rand(1,$Monster['Level']*2*$b)*(1+$Guild['Itemquality']/100));
          $x++;
        }
        $Random=rand(1,$x);
        if($Random>=2&&$Random<=3)
        {
          $Dexterity=round(rand(1,$Monster['Level']*2*$b)*(1+$Guild['Itemquality']/100));
          $x++;
        }
        $Random=rand(1,$x);
        if($Random>=2&&$Random<=3)
        {
          $Intelligence=round(rand(1,$Monster['Level']*2*$b)*(1+$Guild['Itemquality']/100));
          $x++;
        }
        $Random=rand(1,$x);
        if($Random>=2&&$Random<=3)
        {
          $Concentration=round(rand(1,$Monster['Level']*2*$b)*(1+$Guild['Itemquality']/100));
          $x++;
        }
        $Owner=$User['ID'];
        $Base=round($Strength+$Constitution+$Dexterity+$Intelligence+$Concentration);
        $Worth=round( pow($Base, 1.5) );
        $Item="Name: $Name <br />Worth: $Worth <br />Class: $Class <br />-----<br />";

        echo "<p>";
        if($Strength>0)
          $Str="Strength + $Strength <br />";
        if($Dexterity>0)
          $Dex="Dexterity + $Dexterity <br />";
        if($Constitution>0)
          $Cons="Constitution + $Constitution <br />";
        if($Intelligence>0)
          $Int="Intelligence + $Intelligence <br />";
        if($Concentration>0)
          $Conc="Concentration + $Concentration <br />";
        echo "</p>";
        $Class=str_replace(" ","%20",$Class);
        $Button="<form action=\"Frame1.php\" id=\"form1\" target=\"frame\" method=\"post\">
                 <input class=\"button\" type=\"submit\" value='Take item' onclick='Disable(1)' id=\"Button\">
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
      else
      {
        $Spell=mysql_fetch_array(mysql_query("SELECT * FROM Spells ORDER BY RAND()"));
        $Item="Name: $Spell[Name] $Spell[Type] Spell <br />Power: $Spell[Power] <br />";
        $Button="<form action=\"Frame2.php\" id=\"form1\" target=\"frame\" method=\"post\">
                 <input class=\"button\" type=\"submit\" value='Take spell' onclick='Disable(3)' id=\"Button\">
                 <input type=\"hidden\" value=\"$Spell[Type]\" name=\"Type\">
                 <input type=\"hidden\" value=\"$Spell[Name]\" name=\"Name\">
                 <input type=\"hidden\" value=\"$Spell[Power]\" name=\"Power\">
                 </form>";
      }
    }

    //----------- Number two! -----------

    $Rand=rand(1,100);
    if($Rand>$a)
    {
      if($Monster['Type']==1)
        $Rand=rand(1,7);
      elseif($Monster['Type']==2)
        $Rand=rand(1,14);
      else
        $Rand=rand(1,6);
      if($Rand==1){$Class="Short weapon"; $Name="Dagger";}
      elseif($Rand==2){$Class="Long weapon"; $Name="Long Sword";}
      elseif($Rand==3){$Class="Chest armour"; $Name="Plate mail";}
      elseif($Rand==4){$Class="Leg armour"; $Name="Iron plated pants";}
      elseif($Rand==5){$Class="Helmet"; $Name="Hat";}
      elseif($Rand==6){$Class="Gloves"; $Name="Mittens";}

      if($Rand!=7)
      {
        $x=5;
        $Random=rand(1,$x);
        if($Random>=2&&$Random<=3)
        {
          $Concentration=round(rand(1,$Monster['Level']*2*$b)*(1+$Guild['Itemquality']/100));
          $x+=1;
        }
        $Random=rand(1,$x);
        if($Random>=2&&$Random<=3)
        {
          $Intelligence=round(rand(1,$Monster['Level']*2*$b)*(1+$Guild['Itemquality']/100));
          $x+=1;
        }
        $Random=rand(1,$x);
        if($Random>=2&&$Random<=3)
        {
          $Dexterity=round(rand(1,$Monster['Level']*2*$b)*(1+$Guild['Itemquality']/100));
          $x+=1;
        }
        $Random=rand(1,$x);
        if($Random>=2&&$Random<=3)
        {
          $Constitution=round(rand(1,$Monster['Level']*2*$b)*(1+$Guild['Itemquality']/100));
          $x+=1;
        }
        $Random=rand(1,$x);
        if($Random>=2&&$Random<=3)
        {
          $Strength=round(rand(1,$Monster['Level']*2*$b)*(1+$Guild['Itemquality']/100));
          $x+=1;
        }
        $Owner=$User['ID'];
        $Base=($Strength+$Constitution+$Dexterity+$Intelligence+$Concentration);
        $Worth=round( pow($Base, 1.5) );
        $Item2="Name: $Name <br />Worth: $Worth <br />Class: $Class <br />-----<br />";

        echo "<p>";
        if($Strength>0)
          $Str2="Strength + $Strength <br />";
        if($Dexterity>0)
          $Dex2="Dexterity + $Dexterity <br />";
        if($Constitution>0)
          $Cons2="Constitution + $Constitution <br />";
        if($Intelligence>0)
          $Int2="Intelligence + $Intelligence <br />";
        if($Concentration>0)
          $Conc2="Concentration + $Concentration <br />";
        echo "</p>";
        $Class=str_replace(" ","%20",$Class);
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
      else
      {
        $Spell=mysql_fetch_array(mysql_query("SELECT * FROM Spells ORDER BY RAND()"));
        $Item2="Name: $Spell[Name] $Spell[Type] Spell <br />Power: $Spell[Power] <br />";
        $Button2="<form action=\"Frame2.php\" id=\"form2\" target=\"frame\" method=\"post\">
                 <input class=\"button\" type=\"submit\" value='Take spell' onclick='Disable(4)' id=\"Button2\">
                 <input type=\"hidden\" value=\"$Spell[Type]\" name=\"Type\">
                 <input type=\"hidden\" value=\"$Spell[Name]\" name=\"Name\">
                 <input type=\"hidden\" value=\"$Spell[Power]\" name=\"Power\">
                 </form>";
      }
    }
    echo "<table border=\"0\"><tr>
          <td align=\"center\">$Item $Str $Cons $Int $Conc $Dex $Button</td>
          <td align=\"center\">Congratulations! You killed the $Special $Monster[Name]!<br />
          You gain $Exp experience, and $Gold gold<br />
          <form action=\"fight.php\" method=\"post\">
          <input type=\"hidden\" name=\"Name\" value=\"$Monster[Name]\">
          <input class=\"button\" type='Submit' name='Fight' value='Fight $Monster[Name] again'><br />
          </form></td>
          <td align=\"center\">$Item2 $Str2 $Cons2 $Int2 $Conc2 $Dex2 $Button2</td>
          </tr></table>";
    mysql_query("Update Users set HP='$User[HP]', Experience=Experience+'$Exp', SkillExp=SkillExp+'$Exp', Gold=Gold+'$Gold', Fighting='0' where ID='$Player'") or die("Could not update player stats");
    $User['Experience']+=$Exp;
    include_once "level.php";
    if($Item||$Item2||$Button||$Button2)
      echo "<iframe frameborder=\"0\" id=\"frame\" name=\"frame\" height=\"50\" src=\"blank.php\">ZOMG</iframe>";
    die();
  }

  //--------------------------------------------------------------

  function Special($Monster,$Special)
  {
    if($Special=="enraged")
    {
      $Monster['Strength']*=1.25;
      $Monster['Constitution']*=0.75;
    }
    elseif($Special=="intelligent")
    {
      $Monster['Intelligence']*=1.25;
      $Monster['Concentration']*=0.75;
    }
    elseif($Special=="extreme")
    {
      $Monster['Strength']*=2;
      $Monster['Constitution']*=2;
      $Monster['Intelligence']*=2;
      $Monster['Concentration']*=2;
      $Monster['Dexterity']*=2;
    }
    elseif($Special=="clumsy")
    {
      $Monster['Strength']*=0.75;
      $Monster['Constitution']*=0.75;
      $Monster['Intelligence']*=0.75;
      $Monster['Concentration']*=0.75;
      $Monster['Dexterity']*=0.75;
    }
    return $Monster;
  }
?>