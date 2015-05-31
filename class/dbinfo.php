<?php

class UserInfo {
	
  private $id;
  private $firstname;
  private $lastname;
  private $email;
  private $username;
  private $password;


  private $hp;
  private $maxhp;
  private $maxmp;
  private $mp;

  private $str;
  private $const;
  private $dex;
  private $int;

  private $gold;
  private $item;


  private $name;
  private $owner;
  private $itemclass;
  private $worth;
  private $equip;
  private $amount;
  private $fight;

  private $power;
  private $manacost;

  private $connection;

  public function __construct(UserDB $connection)
  {
   $this->connection = $connection;
 }

 public function getUserInfo($id=null,$fn=null,$ln=null,$em=null,$un=null,$ps=null,$hp=null,$maxhp=null,$mp=null,$maxmp=null,$str=null,$cons=null,$dex=null,$int=null,$gold=null,$items=null,$fight=null)
 {
   $this->id = $id;
   $this->firstname = $fn;
   $this->lastname = $ln;
   $this->email = $em;
   $this->username = $un;
   $this->password = $ps;    

   $this->hp = $hp;
   $this->maxhp = $maxhp;
   $this->mp = $mp; 
   $this->maxmp = $maxmp;

   $this->str = $str;
   $this->cons = $cons;
   $this->dex = $dex;
   $this->int = $int;

   $this->gold = $gold;
   $this->items = $items;
   $this->fight = $fight;
 }

 public function addUser()
 {
   $dataset = array(
    $this->id,
    $this->firstname,
    $this->lastname,
    $this->email,
    $this->username,
    $this->password,
    $this->hp,
    $this->maxhp,
    $this->mp,
    $this->maxmp,
    $this->str,
    $this->cons,
    $this->dex,
    $this->int,
    $this->gold,
    $this->items,
    $this->fight
    );

   $returnID = $this->connection->insertData($dataset);

   return $returnID; 
 }


 public function searchUser($username,$password) 
 {
   $result = $this->connection->searchData($username,$password);
   return $result;
 }

 public function getStats($id) 
 {
   $result = $this->connection->getStats($id);
   return $result;
 }

 public function getItems($itemclass,$id) 
 {
   $result = $this->connection->getItems($itemclass,$id);
   return $result;
 }

 public function updateItems($amount,$worth,$id) 
 {
   $result = $this->connection->updateItems($amount,$worth,$id);
   return $result;
 }
 




 public function getItemInfo($owner=null,$name=null,$itemclass=null,$str=null,$int=null,$worth=null,$amount=null)
 {
  $this->owner = $owner;
  $this->name = $name;
  $this->itemclass= $itemclass;
  $this->str = $str;
  $this->int = $int;
  $this->worth = $worth;
  $this->amount = $amount;    
}

public function addItems()
{
 $dataset1 = array(
  $this->owner,
  $this->name,
  $this->itemclass,
  $this->str,
  $this->int,
  $this->worth,
  $this->amount 
  );
 $returnID = $this->connection->insertItems($dataset1);
 return $returnID; 
}





public function getSpellInfo($owner=null,$name=null,$power=null)
{
  $this->owner = $owner;
  $this->name = $name;
  $this->power = $power;    
}

public function addSpell()
{
  $dataset7 = array(
    $this->owner,
    $this->name,
    $this->power,
    );
  $returnID = $this->connection->insertSpell($dataset7);
  return $returnID; 
}






public function getItemInfo1($owner=null,$name=null,$itemclass=null,$str=null,$const=null,$worth=null,$amount=null)
{
  $this->owner = $owner;
  $this->name = $name;
  $this->itemclass= $itemclass;
  $this->str = $str;
  $this->const = $const;
  $this->worth = $worth;
  $this->amount = $amount;    
}

public function addItems1()
{
 $dataset2 = array(
  $this->owner,
  $this->name,
  $this->itemclass,
  $this->str,
  $this->const,
  $this->worth,
  $this->amount 
  );
 $returnID = $this->connection->insertItems1($dataset2);
 return $returnID; 
}








public function getItemInfo2($owner=null,$name=null,$itemclass=null,$const=null,$dex=null,$worth=null,$amount=null)
{
  $this->owner = $owner;
  $this->name = $name;
  $this->itemclass= $itemclass;
  $this->const = $const;
  $this->dex = $dex;
  $this->worth = $worth;
  $this->amount = $amount;    
}

public function addItems2()
{
 $dataset3 = array(
  $this->owner,
  $this->name,
  $this->itemclass,
  $this->const,
  $this->dex,
  $this->worth,
  $this->amount 
  );
 $returnID = $this->connection->insertItems2($dataset3);
 return $returnID; 
}




public function getItemInfo3($owner=null,$name=null,$itemclass=null,$dex=null,$int=null,$worth=null,$amount=null)
{
 $this->owner = $owner;
 $this->name = $name;
 $this->itemclass= $itemclass;
 $this->dex = $dex;
 $this->int = $int;
 $this->worth = $worth;
 $this->amount = $amount;    
}

public function addItems3()
{
 $dataset4 = array(
  $this->owner,
  $this->name,
  $this->itemclass,
  $this->dex,
  $this->int,
  $this->worth,
  $this->amount 
  );
 $returnID = $this->connection->insertItems3($dataset4);
 return $returnID; 
}


public function getItemInfo4($owner=null,$name=null,$itemclass=null,$str=null,$const=null,$worth=null,$amount=null)
{
  $this->owner = $owner;
  $this->name = $name;
  $this->itemclass= $itemclass;
  $this->str = $str;
  $this->const = $const;
  $this->worth = $worth;
  $this->amount = $amount;    
}

public function addItems4()
{
 $dataset5 = array(
  $this->owner,
  $this->name,
  $this->itemclass,
  $this->str,
  $this->const,
  $this->worth,
  $this->amount 
  );
 $returnID = $this->connection->insertItems4($dataset5);
 return $returnID; 
}


public function updateUserGold($gold,$id) 
{
 $result = $this->connection->updateUserGold($gold,$id);
 return $result;
}

public function getSellItems($id)
{
 $result = $this->connection->getSellItems($id);
 return $result;
}

public function getSell($id)
{
 $result = $this->connection->getSell($id);
 return $result;
}

public function updateSellUser($str,$cons,$dex,$int,$id)
{
 $result = $this->connection->updateSellUser($str,$cons,$dex,$int,$id);
 return $result;
}

public function updateSellItem($equip,$id)
{
 $result = $this->connection->updateSellItem($equip,$id);
 return $result;
}

public function updateSellGold($gold,$items,$id)
{
 $result = $this->connection->updateSellGold($gold,$items,$id);
 return $result;
}

public function deleteSellItem($id)
{
 $result = $this->connection->deleteSellItem($id);
 return $result;
}

public function updateHPMP($id)
{
 $result = $this->connection->updateHPMP($id);
 return $result;
}


public function updateMP($id)
{
 $result = $this->connection->updateMP($id);
 return $result;
}


public function getMonster($name) 
{
 $result = $this->connection->getMonster($name);
 return $result;
}

public function updateFighting($id)
{
 $result = $this->connection->updateFighting($id);
 return $result;
}

public function updateHPMPFighting($userHP,$userMP,$id)
{
  $result = $this->connection->updateHPMPFighting($userHP,$userMP,$id);
  return $result;
}

public function updateHPif0($userHP,$id)
{
  $result = $this->connection->updateHPif0($userHP,$id);
  return $result;
}

public function updateHPAttackbyMonster($userHP,$id)
{
  $result = $this->connection->updateHPAttackbyMonster($userHP,$id);
  return $result;
}

public function updateEndOfFight($userHP,$userGold,$id)
{
  $result = $this->connection->updateEndOfFight($userHP,$userGold,$id);
  return $result;
}


public function getUserSpells($id)
{
 $result = $this->connection->getUserSpells($id);
 return $result;
}


public function getPotion($id)
{
 $result = $this->connection->getPotion($id);
 return $result;
}


public function getCastSpell($id)
{
 $result = $this->connection->getCastSpell($id);
 return $result;
}

public function updateSubtractMP($MP,$id)
{
 $result = $this->connection->updateSubtractMP($MP,$id);
 return $result;
}

public function getUserPotion($id)
{
 $result = $this->connection->getUserPotion($id);
 return $result;
}



public function updateAmount($id)
{
 $result = $this->connection->updateAmount($id);
 return $result;
}



public function updateCheckHP($hp,$id)
{
 $result = $this->connection->updateCheckHP($hp,$id);
 return $result;
}


public function getMonsterSpell($id)
{
 $result = $this->connection->getMonsterSpell($id);
 return $result;
}





public function getItemInfo6($owner=null,$name=null,$itemclass=null,$str=null,$const=null,$dex=null,$int=null,$worth=null)
{
  $this->owner = $owner;
  $this->name = $name;
  $this->itemclass= $itemclass;
  $this->str = $str;
  $this->const = $const;
  $this->dex = $dex;
  $this->int = $int;
  $this->worth = $worth;

}

public function addItems6()
{
 $dataset6 = array(
  $this->owner,
  $this->name,
  $this->itemclass,
  $this->str,
  $this->const,
  $this->dex,
  $this->int,
  $this->worth,
  );
 $returnID = $this->connection->insertLoot($dataset6);
 return $returnID; 
}



public function updateUserItem($id)
{
 $result = $this->connection->updateUserItem($id);
 return $result;
}


public function getEquipItem($id)
{
 $result = $this->connection->getEquipItem($id);
 return $result;
}


public function getUserEquipItem($id)
{
 $result = $this->connection->getUserEquipItem($id);
 return $result;
}




public function updateEquipItem($str,$con,$dex,$int,$id)
{
 $result = $this->connection->updateEquipItem($str,$con,$dex,$int,$id);
 return $result;
}



public function updateEquipItem1($id)
{
 $result = $this->connection->updateEquipItem1($id);
 return $result;
}


public function updateEquipItem2($str,$con,$dex,$int,$id)
{
 $result = $this->connection->updateEquipItem2($str,$con,$dex,$int,$id);
 return $result;
}



public function updateEquipItem3($id)
{
 $result = $this->connection->updateEquipItem3($id);
 return $result;
}


public function getWeapon($id1,$id2)
{
 $result = $this->connection->getWeapon($id1,$id2);
 return $result;
}



public function getArmor($id)
{
 $result = $this->connection->getArmor($id);
 return $result;
}

public function getLegArmor($id)
{
 $result = $this->connection->getLegArmor($id);
 return $result;
}






public function getHelm($id)
{
 $result = $this->connection->getHelm($id);
 return $result;
}

public function getGloves($id)
{
 $result = $this->connection->getGloves($id);
 return $result;
}

public function getBoots($id)
{
 $result = $this->connection->getBoots($id);
 return $result;
}

public function deleteSpell($id)
{
 $result = $this->connection->deleteSpell($id);
 return $result;
}

public function getSpell($id)
{
 $result = $this->connection->getSpell($id);
 return $result;
}

public function getLearnSpell($spell,$id)
{
 $result = $this->connection->getLearnSpell($spell,$id);
 return $result;
}


public function updateCheatHP($id)
{
 $result = $this->connection->updateCheatHP($id);
 return $result;
}

public function updateCheatStrength($id)
{
 $result = $this->connection->updateCheatStrength($id);
 return $result;
}


public function updateCheatConstitution($id)
{
 $result = $this->connection->updateCheatConstitution($id);
 return $result;
}



public function updateCheatGold($id)
{
 $result = $this->connection->updateCheatGold($id);
 return $result;
}



public function getWeapon1($id)
{
 $result = $this->connection->getWeapon1($id);
 return $result;
}




public function getWeapon2($id)
{
 $result = $this->connection->getWeapon2($id);
 return $result;
}





public function getHelm1($id)
{
 $result = $this->connection->getHelm1($id);
 return $result;
}




public function getArmor1($id)
{
 $result = $this->connection->getArmor1($id);
 return $result;
}

public function getLegArmor1($id)
{
 $result = $this->connection->getLegArmor1($id);
 return $result;
}


public function getGloves1($id)
{
 $result = $this->connection->getGloves1($id);
 return $result;
}

public function getBoots1($id)
{
 $result = $this->connection->getBoots1($id);
 return $result;
}












}