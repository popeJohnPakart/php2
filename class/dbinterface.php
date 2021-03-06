<?php

interface DBInterface {
	public function insertData(array $dataset);
	public function searchData($user,$pass);
	public function getStats($id);
 	public function getItems($itemclass,$id);
 	public function updateItems($amount,$worth,$id);
 	public function insertItems(array $dataset1);
 	public function updateUserGold($gold,$id);
	public function getSellItems($id);
	public function getSell($id);
	public function updateSellUser($str,$cons,$dex,$int,$id);
	public function updateSellItem($equip,$id);
	public function updateSellGold($gold,$items,$id);
	public function deleteSellItem($id);
	public function updateHPMP($id);
	public function updateMP($id);
	public function insertItems1(array $dataset2);
	public function insertItems2(array $dataset3);
	public function insertItems3(array $dataset4);
	public function insertItems4(array $dataset5);
	public function getMonster($name);
	public function updateFighting($id);
	public function updateHPMPFighting($userHP,$userMP,$id);
	public function updateHPif0($userHP,$id);
	public function updateHPAttackbyMonster($userHP,$id);
	public function updateEndOfFight($userHP,$userGold,$id);
	public function getUserSpells($id);
	public function getPotion($id);
	public function getCastSpell($id);
	public function updateSubtractMP($MP,$id);
	public function getUserPotion($id);
	public function updateAmount($id);
	public function updateCheckHP($hp,$id);
	public function getMonsterSpell($id);
	public function insertLoot(array $dataset6);
	public function updateUserItem($id);
	public function getEquipItem($id);
	public function getUserEquipItem($id);
	public function updateEquipItem($str,$con,$dex,$int,$id);
	public function updateEquipItem1($id);
	public function updateEquipItem2($str,$con,$dex,$int,$id);
	public function updateEquipItem3($id);
	public function getWeapon($id1,$id2);
	public function getArmor($id);
	public function getHelm($id);
	public function getGloves($id);
	public function getBoots($id);
	public function deleteSpell($id);
	public function getSpell($id);
	public function getLearnSpell($spell,$id);
	public function insertSpell(array $dataset7);
	public function getLegArmor($id);
	public function updateCheatHP($id);
	public function updateCheatStrength($id);
	public function updateCheatConstitution($id);
	public function updateCheatGold($id);
	public function getWeapon1($id);
	public function getWeapon2($id);

	public function getHelm1($id);
	public function getArmor1($id);
	public function getLegArmor1($id);
	public function getGloves1($id);
	public function getBoots1($id);
}