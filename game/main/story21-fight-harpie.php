<?php
error_reporting(E_PARSE|| E_ERROR);
echo "<br><br><br><center>";

require_once('../../class/dbinterface.php');  
require_once('../../class/dbmethods.php'); 
require_once('../../class/dbinfo.php');

$sql = new UserInfo(new UserDB('localhost','rpg',3306,'root',''));

$id = $_COOKIE['playerID'];


if(isset($_POST['Attack']))
  $Action="attack";
else if(isset($_POST['Cast']))
  $Action="magic";
else if(isset($_POST['Use']))
  $Action="use";
else if(isset($_POST['Fight']))


$Fight=$_POST['Fight'];
$User = $sql->getStats($id);

require_once 'story21-fight-harpie-functions.php';

if($User['HP']<=0)
  die("<p>You are dead, you cannot fight.Go revive.</p>");



if(isset($Fight)&&!isset($Action))
{
  $Name=$_POST['Name'];
  $Monster = $sql->getMonster($Name);
  if (!$Monster)
    echo "There is no monster of that name";
  else
  {
    setcookie('Monstername',$Monster['Name'],time()+60*60*24);
    $Max=50*$Monster['Level'];

    if($Monster['Type']==0)
    {
      $Monster['HP']=500;
      $Monster['MP']=500;
      $Monster['Strength']=rand($Max/5-$Monster['Level'],$Max/5+$Monster['Level']);
      $Monster['Constitution']=rand($Max/5-$Monster['Level'],$Max/5+$Monster['Level']);
      $Monster['Dexterity']=rand($Max/5-$Monster['Level'],$Max/5+$Monster['Level']);
      $Monster['Intelligence']=rand($Max/5-$Monster['Level'],$Max/5+$Monster['Level']);

    }
    elseif($Monster['Type']==1)
    {
      $Monster['HP']=500;
      $Monster['MP']=500;
      $Monster['Strength']=rand($Max/5-$Monster['Level'],$Max/5+$Monster['Level']);
      $Monster['Constitution']=rand($Max/5-$Monster['Level'],$Max/5+$Monster['Level']);
      $Monster['Dexterity']=rand($Max/5-$Monster['Level'],$Max/5+$Monster['Level']);
      $Monster['Intelligence']=rand($Max/5-$Monster['Level'],$Max/5+$Monster['Level']);
    }

    elseif($Monster['Type']==2)
    {
      $Monster['HP']=500;
      $Monster['MP']=500;
      $Monster['Strength']=rand($Max/4-$Monster['Level'],$Max/4+$Monster['Level']);
      $Monster['Constitution']=rand($Max/4-$Monster['Level'],$Max/4+$Monster['Level']);
      $Monster['Dexterity']=rand($Max/4-$Monster['Level'],$Max/4+$Monster['Level']);
      $Monster['Intelligence']=rand($Max/4-$Monster['Level'],$Max/4+$Monster['Level']);
    }

    $updateFighting = $sql->updateFighting($id);
    echo "<p><font color='white'><h1>LET THE BATTLE BEGIN</h1></font></p></center>";
    Table($Monster, $User);
  }
}





elseif(isset($Action) && $User['Fighting'] != 0)
{
    echo '<img src="images/harpie1.jpg" width="500px"><br><br>';
    echo "<font color='white'>";
      $Monster['Name']=$_POST['Name'];
      $Monster['HP']=$_POST['HP'];
      $Monster['Type']=$_POST['Type'];
      $Monster['Level']=$_POST['Level'];
      $Monster['Spell']=$_POST['Spell'];
      $Monster['MP']=$_POST['MP'];
      $Monster['Strength']=$_POST['Strength'];
      $Monster['Constitution']=$_POST['Constitution'];
      $Monster['Dexterity']=$_POST['Dexterity'];
      $Monster['Intelligence']=$_POST['Intelligence'];


      if(isset($_POST['UserSpell']))
        $SpellID = $_POST['UserSpell'];



      if($Action=="attack")
      {
        $type = "Melee";
        $hit = "You attack the $Monster[Name]";
        $miss = "You attack the $Monster[Name], but it dodges your attack!";
        $block = "You attack the $Monster[Name], but you fail to hurt it!";
      }
      elseif($Action=="magic")
      {

        $UserCastSpell = $sql->getCastSpell($SpellID);

        $type = "Magic";
        $hit = "You blast the $Monster[Name] with $UserCastSpell[Name]";
        $miss = "You blast the $Monster[Name] with $UserCastSpell[Name], but it dodges your attack!";
        $block = "You blast the $Monster[Name] with $UserCastSpell[Name], but it has no effect!";
      }
      elseif($Action=="use")
      {
       $ItemUsed=$_POST['UserItem'];
      }




      $RandDexUser=rand($User['Dexterity']-20,$User['Dexterity']+20);
      $RandDexMonster=rand($Monster['Dexterity']-20,$Monster['Dexterity']+20);




//monster attacks


     if($RandDexUser<$RandDexMonster)
     {
              $User['HP'] = Turn($Monster, $User);
              if($User['HP']<=0)
              {
                $updateCheckHP = $sql->updateCheckHP($User['HP'],$id);
                echo "<p>The $Monster[Name] killed you!<br />Please revive</p>";
                die();
              }


              $EvasionChance=rand(1,50);
              $Rand=rand(1,100);
              echo "<p>";
              if($Rand>=$EvasionChance&&$Action!="use")
              {
                  if($type == "Melee")
                    $Damage = CalcDamage($User, $Monster);

                  elseif($type == "Magic")
                  {
/*                    if($User['MP']<$UserCastSpell['ManaCost'])
                      echo "You do not have enough MP to cast the spell";
                    else*/
                      $Damage = Spell($Monster, $User, $UserCastSpell);
                  }
                  
                  $Monster['HP']-=$Damage;

                  if($Monster['HP']<=0)
                    win($Monster,$User);
                  if($Damage == 0)
                    echo $block."<br><br>";
                  else
                    echo $hit." for $Damage damage!<br><br>";
              }

              elseif($Action=="use")
              {
                $User=Potion($User,$ItemUsed);
                $updateAmount = $sql->updateAmount($ItemUsed);
              }

              else
              echo $miss."<br><br>";
              $updateHPMPFighting = $sql->updateHPMPFighting($User['HP'],$User['MP'],$id);
              Table($Monster, $User);
    }



//hero attacks

     else
    {
            $EvasionChance=rand(1,50);
            $Rand=rand(1,100);
            if($Rand>=$EvasionChance&&$Action!="use")
            {
              if($type == "Melee")
                $Damage = CalcDamage($User, $Monster);

              elseif($type == "Magic")
              {
/*                if($User['MP']<$UserCastSpell['ManaCost'])
                  echo "You do not have enough MP to cast the spell";
                else*/
                  $Damage = Spell($Monster, $User, $UserCastSpell);
              }
              $Monster['HP']-=$Damage;

              if($Monster['HP']<=0)
                win($Monster,$User);
              if($Damage == 0)
                echo $block."<br><br>";
              else
                echo $hit." for $Damage damage!<br><br>";
            }
            elseif($Action=="use")
              {
                $User=Potion($User,$ItemUsed);
                $updateAmount = $sql->updateAmount($ItemUsed);
              }

            else
              echo $miss."<br><br>";
              $User['HP'] = Turn($Monster, $User);


            if($User['HP']<=0)
            {
                $updateCheckHP = $sql->updateCheckHP($User['HP'],$id);
                echo "<p>The $Monster[Name] killed you!<br />Please revive</p>";
                die();
            }
            $updateHPMPFighting = $sql->updateHPMPFighting($User['HP'],$User['MP'],$id);
            Table($Monster, $User);
    }


}







else
{
echo"<br><br><br><br><br>";
echo"<center>";
  echo "<form action='story21-fight-harpie.php' method='post'>";


  $Monster = $sql->getMonster('Harpie');

  echo '<img src="images/harpie.jpg" height="450px"><br><br>';
  echo "<input type='hidden' name='Name' value=\"$Monster[Name]\"><font color='white'>$Monster[Name]</font><br>";



  echo "<input class=\"button\" type='submit' name='Fight' value='Fight Now' />
  </form><br />";
echo"</center>";

}

?>
</body>
</html>