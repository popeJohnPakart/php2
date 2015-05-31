<?php
if( $User['Experience'] >= $User['Level']*4 )
{
  $Boo = 0;
  do
  {
    $User['Experience']-=$User['Level']*4;
    $User['Level']++;
    $Boo++;
  } while( $User['Experience'] >= $User['Level']*4 );
  $class = mysql_fetch_array(mysql_query("SELECT * FROM Classes Where Name='$User[Class2]'"));
  $istats = explode(",",$class['Increment']);
  $Str = $istats[0]*$Boo; $Cons = $istats[1]*$Boo; $Dex = $istats[2]*$Boo; $Conc = $istats[3]*$Boo; $Int = $istats[4]*$Boo; $HP = $istats[5]*$Boo; $MP = $istats[6]*$Boo; 
  $User['BStrength']+=$Str;
  $User['BConstitution']+=$Cons;
  $User['BDexterity']+=$Dex;
  $User['BConcentration']+=$Conc;
  $User['BIntelligence']+=$Int;
  $Experience=$User['Experience'];
  print "<br /><br />You gained $Boo level(s)!<br />";
  print "+ $Str strength<br />+ $Dex dexterity<br />+ $Cons constitution<br />+ $Conc concentration<br />+ $Int intelligence<br />+ $HP HP<br />+ $MP MP<br />";
  $Update="Update Users set BStrength=BStrength+'$Str', BDexterity=BDexterity+'$Dex', BConstitution=BConstitution+'$Cons', BConcentration=BConcentration+'$Conc', BIntelligence=BIntelligence+'$Int', Level=Level+'$Boo', StatPoint=StatPoint+'$Boo'*'2', Experience='$Experience', HP=HP+'$HP', MaxHP=MaxHP+'$HP', MP=MP+'$MP', MaxMP=MaxMP+'$MP' where ID='$Player'";
  $Query="Select * from Items where Owner='$Player' AND Equipped='yes'";
  $Query2=mysql_query($Query) or die("ZOMG! Couldn't rape/find items :(");
  $Count=mysql_num_rows($Query2);
  $Strength=$User['BStrength'];
  $Constitution=$User['BConstitution'];
  $Dexterity=$User['BDexterity'];
  $Concentration=$User['BConcentration'];
  $Intelligence=$User['BIntelligence'];
  if($Count>0)
  {
    while($Item=mysql_fetch_array($Query2))
    {
      $Strength+=$Item['Strength'];
      $Constitution+=$Item['Constitution'];
      $Dexterity+=$Item['Dexterity'];
      $Concentration+=$Item['Concentration'];
      $Intelligence+=$Item['Intelligence'];
    }
  }
  mysql_query("Update Users set Strength='$Strength', Constitution='$Constitution', Dexterity='$Dexterity', Intelligence='$Intelligence', Concentration='$Concentration' where ID='$Player'") or die("Couldn't set stats.");
  mysql_query($Update) or die("Could not update player stats");
}
?>