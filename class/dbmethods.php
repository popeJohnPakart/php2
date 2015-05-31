<?php

  class UserDB implements DBInterface {
   private $connection;
   private $statement;

   public function __construct($host, $dbname, $port, $user, $pass)
   {
    try {
      $this->connection = new PDO("mysql:host=$host;dbname=$dbname;port=$port",$user,$pass);
    }
    catch (PDOException $e)   
    {
      echo $e->getMessage();
    }
  }

  public function insertData(array $dataset)
  {
    try {
     $this->statement = $this->connection->prepare("INSERT INTO users VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);");
     $this->statement->execute($dataset);
     $result = $this->statement->rowCount();
   } catch (PDOException $e) {
     echo $e->getMessage();
   }  

   return $result;  
 }

 public function searchData($user,$pass)
 {
  try {
    $this->statement = $this->connection->prepare('SELECT * FROM users WHERE username = ? and password = ?;');
    $this->statement->execute(array($user,$pass)); 
    $result = $this->statement->fetch(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}

public function getStats($id)
{
  try {
    $this->statement = $this->connection->prepare('SELECT * FROM users WHERE id = ?;');
    $this->statement->execute(array($id)); 
    $result = $this->statement->fetch(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}





public function getItems($itemclass,$id)
{
  try {
    $this->statement = $this->connection->prepare('SELECT * FROM items WHERE Name = ? and Owner = ?;');
    $this->statement->execute(array($itemclass,$id)); 
    $result = $this->statement->fetch(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}


public function getLearnSpell($spell,$id)
{
  try {
    $this->statement = $this->connection->prepare('SELECT * FROM items WHERE Name = ? and Owner = ?;');
    $this->statement->execute(array($spell,$id)); 
    $result = $this->statement->fetch(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}






public function updateItems($amount,$worth,$id)
{
  try {
    $this->statement = $this->connection->prepare('UPDATE items SET Amount=Amount+?, Worth=Worth+? where ID = ?');
    $this->statement->execute(array($amount,$worth,$id));
    $result = $this->statement->fetch(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}





public function insertItems(array $dataset1)
{
  try {
   $this->statement = $this->connection->prepare("INSERT INTO items (Owner,Name,ItemClass,Strength,Intelligence,Worth,Amount) VALUES (?,?,?,?,?,?,?);");
   $this->statement->execute($dataset1);
   $result = $this->statement->rowCount();
 } catch (PDOException $e) {
   echo $e->getMessage();
 }  

 return $result;  
}


public function insertSpell(array $dataset7)
{
  try {
   $this->statement = $this->connection->prepare("INSERT INTO UserSpells (Owner,Name,Power) VALUES (?,?,?);");
   $this->statement->execute($dataset7);
   $result = $this->statement->rowCount();
 } catch (PDOException $e) {
   echo $e->getMessage();
 }  

 return $result;  
}



public function insertItems1(array $dataset2)
{
  try {
   $this->statement = $this->connection->prepare("INSERT INTO items (Owner,Name,ItemClass,Strength,Constitution,Worth,Amount) VALUES (?,?,?,?,?,?,?);");
   $this->statement->execute($dataset2);
   $result = $this->statement->rowCount();
 } catch (PDOException $e) {
   echo $e->getMessage();
 }  

 return $result;  
}







public function insertItems2(array $dataset3)
{
  try {
   $this->statement = $this->connection->prepare("INSERT INTO items (Owner,Name,ItemClass,Constitution,Dexterity,Worth,Amount) VALUES (?,?,?,?,?,?,?);");
   $this->statement->execute($dataset3);
   $result = $this->statement->rowCount();
 } catch (PDOException $e) {
   echo $e->getMessage();
 }  

 return $result;  
}







public function insertItems3(array $dataset4)
{
  try {
   $this->statement = $this->connection->prepare("INSERT INTO items (Owner,Name,ItemClass,Dexterity,Intelligence,Worth,Amount) VALUES (?,?,?,?,?,?,?);");
   $this->statement->execute($dataset4);
   $result = $this->statement->rowCount();
 } catch (PDOException $e) {
   echo $e->getMessage();
 }  

 return $result;  
}







public function insertItems4(array $dataset5)
{
  try {
   $this->statement = $this->connection->prepare("INSERT INTO items (Owner,Name,ItemClass,Strength,Constitution,Worth,Amount) VALUES (?,?,?,?,?,?,?);");
   $this->statement->execute($dataset5);
   $result = $this->statement->rowCount();
 } catch (PDOException $e) {
   echo $e->getMessage();
 }  

 return $result;  
}








public function updateUserGold($gold,$id)
{
  try {
    $this->statement = $this->connection->prepare('UPDATE users SET gold=gold-? where id = ?');
    $this->statement->execute(array($gold,$id));
    $result = $this->statement->fetch(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}

public function getSell($id)
{
  try {
    $this->statement = $this->connection->prepare('SELECT * FROM items WHERE ID = ?;');
    $this->statement->execute(array($id)); 
    $result = $this->statement->fetch(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}

public function updateSellUser($str,$cons,$dex,$int,$id)
{
  try {
    $this->statement = $this->connection->prepare('UPDATE users set strength=strength-?, constitution=constitution-?, dexterity=dexterity-?, intelligence=intelligence-? where id=?;');
    $this->statement->execute(array($str,$cons,$dex,$int,$id));
    $result = $this->statement->fetch(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}

public function updateSellItem($equip,$id)
{
  try {
    $this->statement = $this->connection->prepare('UPDATE items SET Equipped=? where id = ?');
    $this->statement->execute(array($equip,$id));
    $result = $this->statement->fetch(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}

public function updateSellGold($gold,$items,$id)
{
  try {
    $this->statement = $this->connection->prepare('UPDATE users SET gold=gold+?, items=? where id = ?');
    $this->statement->execute(array($gold,$items,$id));
    $result = $this->statement->fetch(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}

public function deleteSellItem($id)
{
  try {
    $this->statement = $this->connection->prepare('DELETE from items where id = ?');
    $this->statement->execute(array($id));
    $result = $this->statement->fetch(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}

public function updateHPMP($id)
{
  try {
    $this->statement = $this->connection->prepare('UPDATE users SET hp=maxhp, mp=maxmp where id = ?');
    $this->statement->execute(array($id));
    $result = $this->statement->fetch(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}

public function updateMP($id)
{
  try {
    $this->statement = $this->connection->prepare('UPDATE users SET mp=maxmp where id = ?');
    $this->statement->execute(array($id));
    $result = $this->statement->fetch(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}


public function getMonster($name)
{
  try {
    $this->statement = $this->connection->prepare('SELECT * FROM monsters WHERE Name = ?;');
    $this->statement->execute(array($name)); 
    $result = $this->statement->fetch(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}

public function updateFighting($id)
{
  try {
    $this->statement = $this->connection->prepare('UPDATE users SET fighting = 1 where id = ?');
    $this->statement->execute(array($id));
    $result = $this->statement->fetch(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}

public function updateHPMPFighting($userHP,$userMP,$id)
{
  try {
    $this->statement = $this->connection->prepare('UPDATE users SET HP = ?, MP = ? where ID = ?');
    $this->statement->execute(array($userHP,$userMP,$id));
    $result = $this->statement->fetch(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}

public function updateHPif0($userHP,$id)
{
  try {
    $this->statement = $this->connection->prepare('UPDATE users SET fighting = 0, HP = ? where ID = ?');
    $this->statement->execute(array($userHP,$id));
    $result = $this->statement->fetch(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}

public function updateHPAttackbyMonster($userHP,$id)
{
  try {
    $this->statement = $this->connection->prepare('UPDATE users SET HP = ? where id = ?');
    $this->statement->execute(array($userHP,$id));
    $result = $this->statement->fetch(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}


public function updateEndOfFight($userHP,$userGold,$id)
{
  try {
    $this->statement = $this->connection->prepare('UPDATE users SET hp = ?, gold=gold+?, fighting = 0 where id = ?');
    $this->statement->execute(array($userHP,$userGold,$id));
    $result = $this->statement->fetch(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}




public function getUserSpells($id)
{
  try {
    $this->statement = $this->connection->prepare('SELECT * FROM UserSpells WHERE Owner = ?');
    $this->statement->execute(array($id)); 
    $result = $this->statement->fetchAll(PDO::FETCH_ASSOC);


  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}


public function getSellItems($id)
{
  try {
    $this->statement = $this->connection->prepare('SELECT * FROM items WHERE Owner = ?;');
    $this->statement->execute(array($id)); 
    $result = $this->statement->fetchAll(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}


public function getPotion($id)
{
  try {
    $this->statement = $this->connection->prepare('SELECT * FROM Items WHERE Amount != 0 and Owner = ?');
    $this->statement->execute(array($id)); 
    $result = $this->statement->fetchAll(PDO::FETCH_ASSOC);


  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}



public function getCastSpell($id)
{
  try {
    $this->statement = $this->connection->prepare('SELECT * FROM userspells WHERE ID = ?;');
    $this->statement->execute(array($id)); 
    $result = $this->statement->fetch(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}




public function updateSubtractMP($MP,$id)
{
  try {
    $this->statement = $this->connection->prepare('UPDATE users SET MP=MP-? where id = ?');
    $this->statement->execute(array($MP,$id));
    $result = $this->statement->fetch(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}





public function getUserPotion($id)
{
  try {
    $this->statement = $this->connection->prepare('SELECT * FROM Items WHERE ID = ?;');
    $this->statement->execute(array($id)); 
    $result = $this->statement->fetch(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}




public function updateAmount($id)
{
  try {
    $this->statement = $this->connection->prepare('UPDATE items SET Amount=Amount-1 where ID = ?');
    $this->statement->execute(array($id));
    $result = $this->statement->fetch(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}


public function updateCheckHP($hp,$id)
{
  try {
    $this->statement = $this->connection->prepare('UPDATE users SET Fighting = 0, HP = ? where ID = ?');
    $this->statement->execute(array($hp,$id));
    $result = $this->statement->fetch(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}

         


public function getMonsterSpell($id)
{
  try {
    $this->statement = $this->connection->prepare('SELECT * FROM Spells WHERE ID = ?;');
    $this->statement->execute(array($id)); 
    $result = $this->statement->fetch(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}





public function insertLoot(array $dataset6)
{
  try {
   $this->statement = $this->connection->prepare("INSERT into Items(Owner, Name, ItemClass, Strength, Constitution, Dexterity, Intelligence, Worth) VALUES (?,?,?,?,?,?,?,?);");
   $this->statement->execute($dataset6);
   $result = $this->statement->rowCount();
 } catch (PDOException $e) {
   echo $e->getMessage();
 }  

 return $result;  
}




public function updateUserItem($id)
{
  try {
    $this->statement = $this->connection->prepare('UPDATE users SET Items=Items+1 where ID = ?');
    $this->statement->execute(array($id));
    $result = $this->statement->fetch(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}




public function getEquipItem($id)
{
  try {
    $this->statement = $this->connection->prepare('SELECT * FROM items WHERE ID = ?;');
    $this->statement->execute(array($id)); 
    $result = $this->statement->fetch(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}


public function getUserEquipItem($id)
{
  try {
    $this->statement = $this->connection->prepare('SELECT * FROM items WHERE Owner = ? and Equipped="yes";');
    $this->statement->execute(array($id)); 
    $result = $this->statement->fetchAll(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}






public function updateEquipItem($str,$con,$dex,$int,$id)
{
  try {
    $this->statement = $this->connection->prepare('UPDATE users SET Strength=Strength-?, Constitution=Constitution-?, Dexterity=Dexterity-?, Intelligence=Intelligence-?  where ID = ?');
    $this->statement->execute(array($str,$con,$dex,$int,$id));
    $result = $this->statement->fetch(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}



public function updateEquipItem1($id)
{
  try {
    $this->statement = $this->connection->prepare('UPDATE items SET Equipped="no"  where ID = ?');
    $this->statement->execute(array($id));
    $result = $this->statement->fetch(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}






public function updateEquipItem2($str,$con,$dex,$int,$id)
{
  try {
    $this->statement = $this->connection->prepare('UPDATE users SET Strength=Strength+?, Constitution=Constitution+?, Dexterity=Dexterity+?, Intelligence=Intelligence+?  where ID = ?');
    $this->statement->execute(array($str,$con,$dex,$int,$id));
    $result = $this->statement->fetch(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}




public function updateEquipItem3($id)
{
  try {
    $this->statement = $this->connection->prepare('UPDATE items SET Equipped="yes"  where ID = ?');
    $this->statement->execute(array($id));
    $result = $this->statement->fetch(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}





public function getWeapon($id1,$id2)
{
  try {
    $this->statement = $this->connection->prepare('SELECT * from Items where Owner=? AND ItemClass="Primary" OR Owner=? AND ItemClass="Secondary"');
    $this->statement->execute(array($id1,$id2)); 
    $result = $this->statement->fetchAll(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}




public function getHelm($id)
{
  try {
    $this->statement = $this->connection->prepare('SELECT * from Items where Owner=? AND ItemClass="Helm"');
    $this->statement->execute(array($id)); 
    $result = $this->statement->fetchAll(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}




public function getArmor($id)
{
  try {
    $this->statement = $this->connection->prepare('SELECT * from Items where Owner=? AND ItemClass="Chest Armor"');
    $this->statement->execute(array($id)); 
    $result = $this->statement->fetchAll(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}





public function getLegArmor($id)
{
  try {
    $this->statement = $this->connection->prepare('SELECT * from Items where Owner=? AND ItemClass="Leg Armor"');
    $this->statement->execute(array($id)); 
    $result = $this->statement->fetchAll(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}






public function getGloves($id)
{
  try {
    $this->statement = $this->connection->prepare('SELECT * from Items where Owner=? AND ItemClass="Gloves"');
    $this->statement->execute(array($id)); 
    $result = $this->statement->fetchAll(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}





public function getBoots($id)
{
  try {
    $this->statement = $this->connection->prepare('SELECT * from Items where Owner=? AND ItemClass="Boots"');
    $this->statement->execute(array($id)); 
    $result = $this->statement->fetchAll(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}







public function deleteSpell($id)
{
  try {
    $this->statement = $this->connection->prepare('DELETE from UserSpells where id = ?');
    $this->statement->execute(array($id));
    $result = $this->statement->fetch(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}



public function getSpell($id)
{
  try {
    $this->statement = $this->connection->prepare('SELECT * from UserSpells where Owner = ?');
    $this->statement->execute(array($id)); 
    $result = $this->statement->fetchAll(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}





public function updateCheatHP($id)
{
  try {
    $this->statement = $this->connection->prepare('UPDATE users SET HP=300 where ID = ?');
    $this->statement->execute(array($id));
    $result = $this->statement->fetch(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}



public function updateCheatStrength($id)
{
  try {
    $this->statement = $this->connection->prepare('UPDATE users SET Strength=Strength+50  where ID = ?');
    $this->statement->execute(array($id));
    $result = $this->statement->fetch(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}



public function updateCheatConstitution($id)
{
  try {
    $this->statement = $this->connection->prepare('UPDATE users SET Constitution=Constitution+50  where ID = ?');
    $this->statement->execute(array($id));
    $result = $this->statement->fetch(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}





public function updateCheatGold($id)
{
  try {
    $this->statement = $this->connection->prepare('UPDATE users SET Gold=9999  where ID = ?');
    $this->statement->execute(array($id));
    $result = $this->statement->fetch(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}








public function getWeapon1($id)
{
  try {
    $this->statement = $this->connection->prepare('SELECT * from Items where Owner=? AND ItemClass="Primary" AND Equipped="yes"');
    $this->statement->execute(array($id)); 
    $result = $this->statement->fetch(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}




public function getWeapon2($id)
{
  try {
    $this->statement = $this->connection->prepare('SELECT * from Items where Owner=? AND ItemClass="Secondary" AND Equipped="yes"');
    $this->statement->execute(array($id)); 
    $result = $this->statement->fetch(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}




public function getHelm1($id)
{
  try {
    $this->statement = $this->connection->prepare('SELECT * from Items where Owner=? AND ItemClass="Helm" AND Equipped="yes"');
    $this->statement->execute(array($id)); 
    $result = $this->statement->fetch(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}




public function getArmor1($id)
{
  try {
    $this->statement = $this->connection->prepare('SELECT * from Items where Owner=? AND ItemClass="Chest Armor" AND Equipped="yes"');
    $this->statement->execute(array($id)); 
    $result = $this->statement->fetch(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}





public function getLegArmor1($id)
{
  try {
    $this->statement = $this->connection->prepare('SELECT * from Items where Owner=? AND ItemClass="Leg Armor" AND Equipped="yes"');
    $this->statement->execute(array($id)); 
    $result = $this->statement->fetch(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}






public function getGloves1($id)
{
  try {
    $this->statement = $this->connection->prepare('SELECT * from Items where Owner=? AND ItemClass="Gloves" AND Equipped="yes"');
    $this->statement->execute(array($id)); 
    $result = $this->statement->fetch(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}





public function getBoots1($id)
{
  try {
    $this->statement = $this->connection->prepare('SELECT * from Items where Owner=? AND ItemClass="Boots" AND Equipped="yes"');
    $this->statement->execute(array($id)); 
    $result = $this->statement->fetch(PDO::FETCH_ASSOC);

  } catch (PDOException $e){ 
    echo $e->getMessage(); 
  }

  return $result; 
}








































}