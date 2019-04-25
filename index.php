<?php

function getFirstResponse($sql)
{
	try {
    $conn = new PDO("mysql:host=localhost;dbname=league", "public", "project123");

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    
    foreach ($conn->query($sql) as $row) {
		if($row[0] == '0')
			return '1';
        return $row[0];
    }
    $conn = null;

  }
  catch(PDOException $err) {
    echo "ERROR: Unable to connect: " . $err->getMessage();
  }

}

function getTotalColumn($sql)
{
	
}

function getFirstIntResponse($sql)
{
	try {
    $conn = new PDO("mysql:host=localhost;dbname=league", "public", "project123");

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    foreach ($conn->query($sql) as $row) {
        return (int)$row[0];
    }
    $conn = null;

  }
  catch(PDOException $err) {
    echo "ERROR: Unable to connect: " . $err->getMessage();
  }

}

function getFirstDoubleResponse($sql)
{
	try {
    $conn = new PDO("mysql:host=localhost;dbname=league", "public", "project123");

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    
    foreach ($conn->query($sql) as $row) {
        return (double)$row[0];
    }
    $conn = null;

  }
  catch(PDOException $err) {
    echo "ERROR: Unable to connect: " . $err->getMessage();
  }

}


if (isset($_POST['submitButton']))
{
	$champ=$_POST['champ_sel'];
	$gold=$_POST['number19'];
	$level=$_POST['level'];
	$primary_a=$_POST['primary_a_sel'];
	$primary_b=$_POST['primary_b_sel'];
	$primary_c=$_POST['primary_c_sel'];
	$primary_d=$_POST['primary_d_sel'];
	$secondary_a=$_POST['secondary_a_sel'];
	$secondary_b=$_POST['secondary_b_sel'];
	$item_a=$_POST['item_sel_1'];
	$item_b=$_POST['item_sel_2'];
	$item_c=$_POST['item_sel_3'];
	$item_d=$_POST['item_sel_4'];
	$item_e=$_POST['item_sel_5'];
	$item_f=$_POST['item_sel_6'];
	
	if (empty($gold)) {
		$gold = 0;
	}
	
	if(empty($level))
	{
		$level = 1;
	}
	
	echo "Champion Statistical Report <br>";
	echo "<br>";
	echo "Champion: " . $champ . "<br>";
	echo "<br>";
	echo "Gold: " . $gold . "<br>";
	echo "Level: " . $level . "<br>";
	echo "<br>";
	echo "Primary A: " . $primary_a . "<br>";
	echo "Primary B: " . $primary_b . "<br>";
	echo "Primary C: " . $primary_c . "<br>";
	echo "Primary D: " . $primary_d . "<br>";
	echo "Secondary A: " . $secondary_a . "<br>";
	echo "Secondary B: " . $secondary_b . "<br>";
	echo "<br>";
	echo "Champion Information";
	echo "<br>";
	echo "<br>";
	echo "Meta Lane: " . getFirstResponse('select lane from champions where champion=\'' . $champ .'\'') . "<br>";
	echo "Meta Tags: " . getFirstResponse('select tags from champions where champion=\'' . $champ .'\'')  . "<br>";
	echo "Bar Type: " . getFirstResponse('select bar_type from bar where champion=\'' . $champ .'\'') . "<br>";
	echo "<br>";
	$c_movement = getFirstIntResponse('select movement from stats where name=\'' . $champ .'\'');
	$c_attack_damage = getFirstIntResponse('select attack_damage from stats where name=\'' . $champ .'\'');
	$c_ability_power = getFirstIntResponse('select ability_power from stats where name=\'' . $champ .'\'');
	$c_armor = getFirstIntResponse('select armor from stats where name=\'' . $champ .'\'');
	$c_magic_resit = getFirstIntResponse('select magic_resist from stats where name=\'' . $champ .'\'');
	$c_health = getFirstIntResponse('select health from stats where name=\'' . $champ .'\'');
	$c_mana = getFirstIntResponse('select mana from stats where name=\'' . $champ .'\'') ;
	$c_critical_strike_chance = getFirstDoubleResponse('select critical_strike_chance from stats where name=\'' . $champ .'\'');
	$c_cooldown_reduction = getFirstIntResponse('select cooldown_reduction from stats where name=\'' . $champ .'\'');
	$c_attack_speed = getFirstDoubleResponse('select attack_speed from stats where name=\'' . $champ .'\'');
	$c_attack_penetration = getFirstIntResponse('select attack_penetration from stats where name=\'' . $champ .'\'');
	$c_magic_penetration = getFirstIntResponse('select ability_penetration from stats where name=\'' . $champ .'\'');
	$c_total = $c_movement + $c_attack_damage + $c_ability_power + $c_armor + $c_magic_resit + $c_health + $c_mana + $c_critical_strike_chance + $c_attack_speed + $c_attack_penetration + $c_cooldown_reduction + $c_magic_penetration;
	echo "Movement: " . $c_movement . "<br>";
	echo "Attack Damage: " . $c_attack_damage . "<br>";
	echo "Ability Power: " . $c_ability_power . "<br>";
	echo "Armor: " . $c_armor . "<br>";
	echo "Magic Resist: " . $c_magic_resit . "<br>";
	echo "Health: " . $c_health . "<br>";
	echo "Mana: " . $c_mana . "<br>";
	echo "Critical Strike Chance: " . $c_critical_strike_chance . "<br>";
	echo "Cooldown Reduction: " . $c_cooldown_reduction . "<br>";
	echo "Attack Speed: " . $c_attack_speed . "<br>";
	echo "Attack Penetration: " . $c_attack_penetration . "<br>";
	echo "Magic Penetration: " . $c_magic_penetration . "<br>";
	echo "<br>";
	echo "Q Ability: " . getFirstResponse('select ability_name from champion_abilities where champion=\'' . $champ .'\' AND keyboard_key=\'q\'') . "<br>";
	echo "Normalized Effect: " . getFirstResponse('select normalized_effect from champion_abilities where champion=\'' . $champ .'\' AND keyboard_key=\'q\'') . "<br>";
	echo "Area of Effect: " . getFirstResponse('select area_of_effect from champion_abilities where champion=\'' . $champ .'\' AND keyboard_key=\'q\'') . "<br>";
	echo "Crowd Control Effect: " . getFirstResponse('select normalized_crowd_control from champion_abilities where champion=\'' . $champ .'\' AND keyboard_key=\'q\'') . "<br>";
	echo "Cast Cost: " . getFirstResponse('select cast_cost from champion_abilities where champion=\'' . $champ .'\' AND keyboard_key=\'q\'') . "<br>";
	echo "Number of Casts: " . getFirstResponse('select number_of_casts from champion_abilities where champion=\'' . $champ .'\' AND keyboard_key=\'q\'') . "<br>";
	echo "<br>";
	echo "W Ability: " . getFirstResponse('select ability_name from champion_abilities where champion=\'' . $champ .'\' AND keyboard_key=\'w\'') . "<br>";
	echo "Normalized Effect: " . getFirstResponse('select normalized_effect from champion_abilities where champion=\'' . $champ .'\' AND keyboard_key=\'w\'') . "<br>";
	echo "Area of Effect: " . getFirstResponse('select area_of_effect from champion_abilities where champion=\'' . $champ .'\' AND keyboard_key=\'w\'') . "<br>";
	echo "Crowd Control Effect: " . getFirstResponse('select normalized_crowd_control from champion_abilities where champion=\'' . $champ .'\' AND keyboard_key=\'w\'') . "<br>";
	echo "Cast Cost: " . getFirstResponse('select cast_cost from champion_abilities where champion=\'' . $champ .'\' AND keyboard_key=\'w\'') . "<br>";
	echo "Number of Casts: " . getFirstResponse('select number_of_casts from champion_abilities where champion=\'' . $champ .'\' AND keyboard_key=\'w\'') . "<br>";
	echo "<br>";
	echo "E Ability: " . getFirstResponse('select ability_name from champion_abilities where champion=\'' . $champ .'\' AND keyboard_key=\'e\'') . "<br>";
	echo "Normalized Effect: " . getFirstResponse('select normalized_effect from champion_abilities where champion=\'' . $champ .'\' AND keyboard_key=\'e\'') . "<br>";
	echo "Area of Effect: " . getFirstResponse('select area_of_effect from champion_abilities where champion=\'' . $champ .'\' AND keyboard_key=\'e\'') . "<br>";
	echo "Crowd Control Effect: " . getFirstResponse('select normalized_crowd_control from champion_abilities where champion=\'' . $champ .'\' AND keyboard_key=\'e\'') . "<br>";
	echo "Cast Cost: " . getFirstResponse('select cast_cost from champion_abilities where champion=\'' . $champ .'\' AND keyboard_key=\'e\'') . "<br>";
	echo "Number of Casts: " . getFirstResponse('select number_of_casts from champion_abilities where champion=\'' . $champ .'\' AND keyboard_key=\'e\'') . "<br>";
	echo "<br>";
	echo "R Ability: " . getFirstResponse('select ability_name from champion_abilities where champion=\'' . $champ .'\' AND keyboard_key=\'r\'') . "<br>";
	echo "Normalized Effect: " . getFirstResponse('select normalized_effect from champion_abilities where champion=\'' . $champ .'\' AND keyboard_key=\'r\'') . "<br>";
	echo "Area of Effect: " . getFirstResponse('select area_of_effect from champion_abilities where champion=\'' . $champ .'\' AND keyboard_key=\'r\'') . "<br>";
	echo "Crowd Control Effect: " . getFirstResponse('select normalized_crowd_control from champion_abilities where champion=\'' . $champ .'\' AND keyboard_key=\'r\'') . "<br>";
	echo "Cast Cost: " . getFirstResponse('select cast_cost from champion_abilities where champion=\'' . $champ .'\' AND keyboard_key=\'r\'') . "<br>";
	echo "Number of Casts: " . getFirstResponse('select number_of_casts from champion_abilities where champion=\'' . $champ .'\' AND keyboard_key=\'r\'') . "<br>";
	echo "<br>";
	echo "Total Normalized Effect: " . getFirstResponse('select SUM(normalized_effect) from champion_abilities where champion=\'' . $champ .'\'') . "<br>";
	echo "Average Normalized Effect: " . getFirstResponse('select AVG(normalized_effect) from champion_abilities where champion=\'' . $champ .'\'') . "<br>";
	echo "<br>";
	echo "Passive Effect: " . getFirstResponse('select normalized_effect from champion_passive where name=\'' . $champ .'\'') . "<br>";
	echo "Cooldown Seconds: " . getFirstResponse('select cooldown from champion_passive where name=\'' . $champ .'\'') . "<br>";
	echo "<br>";
	echo "Masteries: ";
	echo "<br>";
	echo "<br>";
	echo "Primary A Score: " . getFirstResponse('select normalized_value from masteries where name=\'' . $primary_a .'\'') . "<br>";
	echo "Primary B Score: " . getFirstResponse('select normalized_value from masteries where name=\'' . $primary_b .'\'') . "<br>";
	echo "Primary C Score: " . getFirstResponse('select normalized_value from masteries where name=\'' . $primary_c .'\'') . "<br>";
	echo "Primary D Score: " . getFirstResponse('select normalized_value from masteries where name=\'' . $primary_d .'\'') . "<br>";
	echo "Secondary A Score: " . getFirstResponse('select normalized_value from masteries where name=\'' . $secondary_a .'\'') . "<br>";
	echo "Secondary B Score: " . getFirstResponse('select normalized_value from masteries where name=\'' . $secondary_b .'\'') . "<br>";
	echo "<br>";
	echo "Weakest Mastery: " . getFirstResponse('select name, normalized_value from masteries where name="'. $primary_a .'" or name="'. $primary_b .'" or name="' . $primary_c . '" or name="'. $primary_d .'" or name="'. $secondary_a .'" or name="'. $secondary_b .'" order by normalized_value asc;') . "<br>";
	echo "Strongest Mastery: " . getFirstResponse('select name, normalized_value from masteries where name="'. $primary_a .'" or name="'. $primary_b .'" or name="' . $primary_c . '" or name="'. $primary_d .'" or name="'. $secondary_a .'" or name="'. $secondary_b .'" order by normalized_value desc;') . "<br>";
	echo "Total Mastery: " . getFirstResponse('select SUM(normalized_value) from masteries where name="'. $primary_a .'" or name="'. $primary_b .'" or name="' . $primary_c . '" or name="'. $primary_d .'" or name="'. $secondary_a .'" or name="'. $secondary_b .'";') . "<br>";
	echo "Average Mastery: " . getFirstResponse('select AVG(normalized_value) from masteries where name="'. $primary_a .'" or name="'. $primary_b .'" or name="' . $primary_c . '" or name="'. $primary_d .'" or name="'. $secondary_a .'" or name="'. $secondary_b .'";') . "<br>";
	echo "<br>";
	echo "Item Statistics <br>";
	echo "<br>";
	echo "Can buy item build: ";
	
	$budget = $gold;
	$budget = $budget - getFirstIntResponse('select cost from item where name=\'' . $item_a .'\'');
	$budget = $budget - getFirstIntResponse('select cost from item where name=\'' . $item_b .'\'');
	$budget = $budget - getFirstIntResponse('select cost from item where name=\'' . $item_c .'\'');
	$budget = $budget - getFirstIntResponse('select cost from item where name=\'' . $item_d .'\'');
	$budget = $budget - getFirstIntResponse('select cost from item where name=\'' . $item_e .'\'');
	$budget = $budget - getFirstIntResponse('select cost from item where name=\'' . $item_f .'\'');
	if($budget < 0)
		echo "No";
	else
		echo "Yes";
	echo ".<br>";
	
	echo "<br>";
	echo "Item 1: " . $item_a . "<br>";
	echo "Movement: " . getFirstIntResponse('select movement from item where name=\'' . $item_a .'\'') . "<br>";
	echo "Attack Damage: " . getFirstIntResponse('select attack_damage from item where name=\'' . $item_a .'\'') . "<br>";
	echo "Ability Power: " . getFirstIntResponse('select ability_power from item where name=\'' . $item_a .'\'') . "<br>";
	echo "Armor: " . getFirstIntResponse('select armor from item where name=\'' . $item_a .'\'') . "<br>";
	echo "Magic Resist: " . getFirstIntResponse('select magic_resist from item where name=\'' . $item_a .'\'') . "<br>";
	echo "Health: " . getFirstIntResponse('select health from item where name=\'' . $item_a .'\'') . "<br>";
	echo "Mana: " . getFirstIntResponse('select Mana from item where name=\'' . $item_a .'\'') . "<br>";
	echo "Critical Strike Chance: " . getFirstDoubleResponse('select critical_strike_chance from item where name=\'' . $item_a .'\''). "<br>";
	echo "Cooldown Reduction: " . getFirstDoubleResponse('select cooldown_reduction from item where name=\'' . $item_a .'\''). "<br>";
	echo "Attack Speed: " . getFirstDoubleResponse('select attack_speed from item where name=\'' . $item_a .'\'') . "<br>";
	echo "Attack Penetration: " . getFirstIntResponse('select attack_penetration from item where name=\'' . $item_a .'\''). "<br>";
	echo "Magic Penetration: " . getFirstIntResponse('select ability_penetration from item where name=\'' . $item_a .'\''). "<br>";
	echo "Life Steal: " . getFirstDoubleResponse('select life_steal from item where name=\'' . $item_a .'\'') . "<br>";
	echo "Mana Regen: " . getFirstIntResponse('select mana_regen from item where name=\'' . $item_a .'\'') . "<br>";
	echo "Health Regen: " . getFirstIntResponse('select health_regen from item where name=\'' . $item_a .'\'') . "<br>";
	echo "Gold Regen: " . getFirstIntResponse('select gold_regen from item where name=\'' . $item_a .'\'') . "<br>";
	echo "Cost: " . getFirstIntResponse('select cost from item where name=\'' . $item_a .'\'') . "<br>";
	if(!empty(getFirstResponse('select item_name from item_has_passive where item_name=\'' . $item_a .'\'')))
	{
		try {
   
				
				//echo $query . "<br>";

					$t = getFirstResponse('select active_name from item_has_passive where item_name=\'' . $item_a .'\'');
					echo "<br>";
					echo "Passive: " . $t . "<br>";
					echo "Normalized Effect: " . getFirstResponse('select normalized_effect from item_passive where name=\'' . $t .'\''). "<br>";
					echo "Cooldown: " . getFirstResponse('select cooldown from item_passive where name=\'' . $t .'\''). "<br>";
					echo "Unique: " . getFirstResponse('select is_unique from item_passive where name=\'' . $t .'\''). "<br>";
					echo "<br>";
				
				}
				catch(PDOException $err) {
					echo "ERROR: Unable to connect: " . $err->getMessage();
				}
	}
	if(!empty(getFirstResponse('select item_name from item_has_active where item_name=\'' . $item_a .'\'')))
	{
		try {
					$t = getFirstResponse('select active_name from item_has_active where item_name=\'' . $item_a .'\'');
					echo "<br>";
					echo "Active: " . $t . "<br>";
					echo "Normalized Effect: " . getFirstResponse('select normalized_effect from item_active where name=\'' . $t .'\''). "<br>";
					echo "Cooldown: " . getFirstResponse('select cooldown from item_active where name=\'' . $t .'\''). "<br>";
					echo "<br>";
				}
				catch(PDOException $err) {
					echo "ERROR: Unable to connect: " . $err->getMessage();
				}
	}
	
	echo "<br>";
	echo "Item 2: " . $item_b . "<br>";
	echo "Movement: " . getFirstIntResponse('select movement from item where name=\'' . $item_b .'\'') . "<br>";
	echo "Attack Damage: " . getFirstIntResponse('select attack_damage from item where name=\'' . $item_b .'\'') . "<br>";
	echo "Ability Power: " . getFirstIntResponse('select ability_power from item where name=\'' . $item_b .'\'') . "<br>";
	echo "Armor: " . getFirstIntResponse('select armor from item where name=\'' . $item_b .'\'') . "<br>";
	echo "Magic Resist: " . getFirstIntResponse('select magic_resist from item where name=\'' . $item_b .'\'') . "<br>";
	echo "Health: " . getFirstIntResponse('select health from item where name=\'' . $item_b .'\'') . "<br>";
	echo "Mana: " . getFirstIntResponse('select Mana from item where name=\'' . $item_b .'\'') . "<br>";
	echo "Critical Strike Chance: " . getFirstDoubleResponse('select critical_strike_chance from item where name=\'' . $item_b .'\''). "<br>";
	echo "Cooldown Reduction: " . getFirstDoubleResponse('select cooldown_reduction from item where name=\'' . $item_b .'\''). "<br>";
	echo "Attack Speed: " . getFirstDoubleResponse('select attack_speed from item where name=\'' . $item_b .'\'') . "<br>";
	echo "Attack Penetration: " . getFirstIntResponse('select attack_penetration from item where name=\'' . $item_b .'\''). "<br>";
	echo "Magic Penetration: " . getFirstIntResponse('select ability_penetration from item where name=\'' . $item_b .'\''). "<br>";
	echo "Life Steal: " . getFirstDoubleResponse('select life_steal from item where name=\'' . $item_b .'\'') . "<br>";
	echo "Mana Regen: " . getFirstIntResponse('select mana_regen from item where name=\'' . $item_b .'\'') . "<br>";
	echo "Health Regen: " . getFirstIntResponse('select health_regen from item where name=\'' . $item_b .'\'') . "<br>";
	echo "Gold Regen: " . getFirstIntResponse('select gold_regen from item where name=\'' . $item_b .'\'') . "<br>";
	echo "Cost: " . getFirstIntResponse('select cost from item where name=\'' . $item_b .'\'') . "<br>";
	if(!empty(getFirstResponse('select item_name from item_has_passive where item_name=\'' . $item_b .'\'')))
	{
		try {
   
				
				//echo $query . "<br>";

					$t = getFirstResponse('select active_name from item_has_passive where item_name=\'' . $item_b .'\'');
					echo "<br>";
					echo "Passive: " . $t . "<br>";
					echo "Normalized Effect: " . getFirstResponse('select normalized_effect from item_passive where name=\'' . $t .'\''). "<br>";
					echo "Cooldown: " . getFirstResponse('select cooldown from item_passive where name=\'' . $t .'\''). "<br>";
					echo "Unique: " . getFirstResponse('select is_unique from item_passive where name=\'' . $t .'\''). "<br>";
					echo "<br>";
				
				}
				catch(PDOException $err) {
					echo "ERROR: Unable to connect: " . $err->getMessage();
				}
	}
	if(!empty(getFirstResponse('select item_name from item_has_active where item_name=\'' . $item_b .'\'')))
	{
		try {
					$t = getFirstResponse('select active_name from item_has_active where item_name=\'' . $item_b .'\'');
					echo "<br>";
					echo "Active: " . $t . "<br>";
					echo "Normalized Effect: " . getFirstResponse('select normalized_effect from item_active where name=\'' . $t .'\''). "<br>";
					echo "Cooldown: " . getFirstResponse('select cooldown from item_active where name=\'' . $t .'\''). "<br>";
					echo "<br>";
				}
				catch(PDOException $err) {
					echo "ERROR: Unable to connect: " . $err->getMessage();
				}
	}
	echo "<br>";
	echo "Item 3: " . $item_c . "<br>";
	echo "Movement: " . getFirstIntResponse('select movement from item where name=\'' . $item_c .'\'') . "<br>";
	echo "Attack Damage: " . getFirstIntResponse('select attack_damage from item where name=\'' . $item_c .'\'') . "<br>";
	echo "Ability Power: " . getFirstIntResponse('select ability_power from item where name=\'' . $item_c .'\'') . "<br>";
	echo "Armor: " . getFirstIntResponse('select armor from item where name=\'' . $item_c .'\'') . "<br>";
	echo "Magic Resist: " . getFirstIntResponse('select magic_resist from item where name=\'' . $item_c .'\'') . "<br>";
	echo "Health: " . getFirstIntResponse('select health from item where name=\'' . $item_c .'\'') . "<br>";
	echo "Mana: " . getFirstIntResponse('select Mana from item where name=\'' . $item_c .'\'') . "<br>";
	echo "Critical Strike Chance: " . getFirstDoubleResponse('select critical_strike_chance from item where name=\'' . $item_c .'\''). "<br>";
	echo "Cooldown Reduction: " . getFirstDoubleResponse('select cooldown_reduction from item where name=\'' . $item_c .'\''). "<br>";
	echo "Attack Speed: " . getFirstDoubleResponse('select attack_speed from item where name=\'' . $item_c .'\'') . "<br>";
	echo "Attack Penetration: " . getFirstIntResponse('select attack_penetration from item where name=\'' . $item_c .'\''). "<br>";
	echo "Magic Penetration: " . getFirstIntResponse('select ability_penetration from item where name=\'' . $item_c .'\''). "<br>";
	echo "Life Steal: " . getFirstDoubleResponse('select life_steal from item where name=\'' . $item_c .'\'') . "<br>";
	echo "Mana Regen: " . getFirstIntResponse('select mana_regen from item where name=\'' . $item_c .'\'') . "<br>";
	echo "Health Regen: " . getFirstIntResponse('select health_regen from item where name=\'' . $item_c .'\'') . "<br>";
	echo "Gold Regen: " . getFirstIntResponse('select gold_regen from item where name=\'' . $item_c .'\'') . "<br>";
	echo "Cost: " . getFirstIntResponse('select cost from item where name=\'' . $item_c .'\'') . "<br>";
	if(!empty(getFirstResponse('select item_name from item_has_passive where item_name=\'' . $item_c .'\'')))
	{
		try {
   
				
				//echo $query . "<br>";

					$t = getFirstResponse('select active_name from item_has_passive where item_name=\'' . $item_c .'\'');
					echo "<br>";
					echo "Passive: " . $t . "<br>";
					echo "Normalized Effect: " . getFirstResponse('select normalized_effect from item_passive where name=\'' . $t .'\''). "<br>";
					echo "Cooldown: " . getFirstResponse('select cooldown from item_passive where name=\'' . $t .'\''). "<br>";
					echo "Unique: " . getFirstResponse('select is_unique from item_passive where name=\'' . $t .'\''). "<br>";
					echo "<br>";
				
				}
				catch(PDOException $err) {
					echo "ERROR: Unable to connect: " . $err->getMessage();
				}
	}
	if(!empty(getFirstResponse('select item_name from item_has_active where item_name=\'' . $item_c .'\'')))
	{
		try {
					$t = getFirstResponse('select active_name from item_has_active where item_name=\'' . $item_c .'\'');
					echo "<br>";
					echo "Active: " . $t . "<br>";
					echo "Normalized Effect: " . getFirstResponse('select normalized_effect from item_active where name=\'' . $t .'\''). "<br>";
					echo "Cooldown: " . getFirstResponse('select cooldown from item_active where name=\'' . $t .'\''). "<br>";
					echo "<br>";
				}
				catch(PDOException $err) {
					echo "ERROR: Unable to connect: " . $err->getMessage();
				}
	}
	echo "<br>";
	echo "Item 4: " . $item_d . "<br>";
	echo "Movement: " . getFirstIntResponse('select movement from item where name=\'' . $item_d .'\'') . "<br>";
	echo "Attack Damage: " . getFirstIntResponse('select attack_damage from item where name=\'' . $item_d .'\'') . "<br>";
	echo "Ability Power: " . getFirstIntResponse('select ability_power from item where name=\'' . $item_d .'\'') . "<br>";
	echo "Armor: " . getFirstIntResponse('select armor from item where name=\'' . $item_d .'\'') . "<br>";
	echo "Magic Resist: " . getFirstIntResponse('select magic_resist from item where name=\'' . $item_d .'\'') . "<br>";
	echo "Health: " . getFirstIntResponse('select health from item where name=\'' . $item_d .'\'') . "<br>";
	echo "Mana: " . getFirstIntResponse('select Mana from item where name=\'' . $item_d .'\'') . "<br>";
	echo "Critical Strike Chance: " . getFirstDoubleResponse('select critical_strike_chance from item where name=\'' . $item_d .'\''). "<br>";
	echo "Cooldown Reduction: " . getFirstDoubleResponse('select cooldown_reduction from item where name=\'' . $item_d .'\''). "<br>";
	echo "Attack Speed: " . getFirstDoubleResponse('select attack_speed from item where name=\'' . $item_d .'\'') . "<br>";
	echo "Attack Penetration: " . getFirstIntResponse('select attack_penetration from item where name=\'' . $item_d .'\''). "<br>";
	echo "Magic Penetration: " . getFirstIntResponse('select ability_penetration from item where name=\'' . $item_d .'\''). "<br>";
	echo "Life Steal: " . getFirstDoubleResponse('select life_steal from item where name=\'' . $item_d .'\'') . "<br>";
	echo "Mana Regen: " . getFirstIntResponse('select mana_regen from item where name=\'' . $item_d .'\'') . "<br>";
	echo "Health Regen: " . getFirstIntResponse('select health_regen from item where name=\'' . $item_d .'\'') . "<br>";
	echo "Gold Regen: " . getFirstIntResponse('select gold_regen from item where name=\'' . $item_d .'\'') . "<br>";
	echo "Cost: " . getFirstIntResponse('select cost from item where name=\'' . $item_d .'\'') . "<br>";
	if(!empty(getFirstResponse('select item_name from item_has_passive where item_name=\'' . $item_d .'\'')))
	{
		try {
   
				
				//echo $query . "<br>";

					$t = getFirstResponse('select active_name from item_has_passive where item_name=\'' . $item_d .'\'');
					echo "<br>";
					echo "Passive: " . $t . "<br>";
					echo "Normalized Effect: " . getFirstResponse('select normalized_effect from item_passive where name=\'' . $t .'\''). "<br>";
					echo "Cooldown: " . getFirstResponse('select cooldown from item_passive where name=\'' . $t .'\''). "<br>";
					echo "Unique: " . getFirstResponse('select is_unique from item_passive where name=\'' . $t .'\''). "<br>";
					echo "<br>";
				
				}
				catch(PDOException $err) {
					echo "ERROR: Unable to connect: " . $err->getMessage();
				}
	}
	if(!empty(getFirstResponse('select item_name from item_has_active where item_name=\'' . $item_d .'\'')))
	{
		try {
					$t = getFirstResponse('select active_name from item_has_active where item_name=\'' . $item_d .'\'');
					echo "<br>";
					echo "Active: " . $t . "<br>";
					echo "Normalized Effect: " . getFirstResponse('select normalized_effect from item_active where name=\'' . $t .'\''). "<br>";
					echo "Cooldown: " . getFirstResponse('select cooldown from item_active where name=\'' . $t .'\''). "<br>";
					echo "<br>";
				}
				catch(PDOException $err) {
					echo "ERROR: Unable to connect: " . $err->getMessage();
				}
	}
	echo "<br>";
	echo "Item 5: " . $item_e . "<br>";
	echo "Movement: " . getFirstIntResponse('select movement from item where name=\'' . $item_e .'\'') . "<br>";
	echo "Attack Damage: " . getFirstIntResponse('select attack_damage from item where name=\'' . $item_e .'\'') . "<br>";
	echo "Ability Power: " . getFirstIntResponse('select ability_power from item where name=\'' . $item_e .'\'') . "<br>";
	echo "Armor: " . getFirstIntResponse('select armor from item where name=\'' . $item_e .'\'') . "<br>";
	echo "Magic Resist: " . getFirstIntResponse('select magic_resist from item where name=\'' . $item_e .'\'') . "<br>";
	echo "Health: " . getFirstIntResponse('select health from item where name=\'' . $item_e .'\'') . "<br>";
	echo "Mana: " . getFirstIntResponse('select Mana from item where name=\'' . $item_e .'\'') . "<br>";
	echo "Critical Strike Chance: " . getFirstDoubleResponse('select critical_strike_chance from item where name=\'' . $item_e .'\''). "<br>";
	echo "Cooldown Reduction: " . getFirstDoubleResponse('select cooldown_reduction from item where name=\'' . $item_e .'\''). "<br>";
	echo "Attack Speed: " . getFirstDoubleResponse('select attack_speed from item where name=\'' . $item_e .'\'') . "<br>";
	echo "Attack Penetration: " . getFirstIntResponse('select attack_penetration from item where name=\'' . $item_e .'\''). "<br>";
	echo "Magic Penetration: " . getFirstIntResponse('select ability_penetration from item where name=\'' . $item_e .'\''). "<br>";
	echo "Life Steal: " . getFirstDoubleResponse('select life_steal from item where name=\'' . $item_e .'\'') . "<br>";
	echo "Mana Regen: " . getFirstIntResponse('select mana_regen from item where name=\'' . $item_e .'\'') . "<br>";
	echo "Health Regen: " . getFirstIntResponse('select health_regen from item where name=\'' . $item_e .'\'') . "<br>";
	echo "Gold Regen: " . getFirstIntResponse('select gold_regen from item where name=\'' . $item_e .'\'') . "<br>";
	echo "Cost: " . getFirstIntResponse('select cost from item where name=\'' . $item_e .'\'') . "<br>";
	if(!empty(getFirstResponse('select item_name from item_has_passive where item_name=\'' . $item_e .'\'')))
	{
		try {
   
				
				//echo $query . "<br>";

					$t = getFirstResponse('select active_name from item_has_passive where item_name=\'' . $item_e .'\'');
					echo "<br>";
					echo "Passive: " . $t . "<br>";
					echo "Normalized Effect: " . getFirstResponse('select normalized_effect from item_passive where name=\'' . $t .'\''). "<br>";
					echo "Cooldown: " . getFirstResponse('select cooldown from item_passive where name=\'' . $t .'\''). "<br>";
					echo "Unique: " . getFirstResponse('select is_unique from item_passive where name=\'' . $t .'\''). "<br>";
					echo "<br>";
				
				}
				catch(PDOException $err) {
					echo "ERROR: Unable to connect: " . $err->getMessage();
				}
	}
	if(!empty(getFirstResponse('select item_name from item_has_active where item_name=\'' . $item_e .'\'')))
	{
		try {
					$t = getFirstResponse('select active_name from item_has_active where item_name=\'' . $item_e .'\'');
					echo "<br>";
					echo "Active: " . $t . "<br>";
					echo "Normalized Effect: " . getFirstResponse('select normalized_effect from item_active where name=\'' . $t .'\''). "<br>";
					echo "Cooldown: " . getFirstResponse('select cooldown from item_active where name=\'' . $t .'\''). "<br>";
					echo "<br>";
				}
				catch(PDOException $err) {
					echo "ERROR: Unable to connect: " . $err->getMessage();
				}
	}
	echo "<br>";
	echo "Item 6: " . $item_f . "<br>";
	echo "Movement: " . getFirstIntResponse('select movement from item where name=\'' . $item_f .'\'') . "<br>";
	echo "Attack Damage: " . getFirstIntResponse('select attack_damage from item where name=\'' . $item_f .'\'') . "<br>";
	echo "Ability Power: " . getFirstIntResponse('select ability_power from item where name=\'' . $item_f .'\'') . "<br>";
	echo "Armor: " . getFirstIntResponse('select armor from item where name=\'' . $item_f .'\'') . "<br>";
	echo "Magic Resist: " . getFirstIntResponse('select magic_resist from item where name=\'' . $item_f .'\'') . "<br>";
	echo "Health: " . getFirstIntResponse('select health from item where name=\'' . $item_f .'\'') . "<br>";
	echo "Mana: " . getFirstIntResponse('select Mana from item where name=\'' . $item_f .'\'') . "<br>";
	echo "Critical Strike Chance: " . getFirstDoubleResponse('select critical_strike_chance from item where name=\'' . $item_f .'\''). "<br>";
	echo "Cooldown Reduction: " . getFirstDoubleResponse('select cooldown_reduction from item where name=\'' . $item_f .'\''). "<br>";
	echo "Attack Speed: " . getFirstDoubleResponse('select attack_speed from item where name=\'' . $item_f .'\'') . "<br>";
	echo "Attack Penetration: " . getFirstIntResponse('select attack_penetration from item where name=\'' . $item_f .'\''). "<br>";
	echo "Magic Penetration: " . getFirstIntResponse('select ability_penetration from item where name=\'' . $item_f .'\''). "<br>";
	echo "Life Steal: " . getFirstDoubleResponse('select life_steal from item where name=\'' . $item_f .'\'') . "<br>";
	echo "Mana Regen: " . getFirstIntResponse('select mana_regen from item where name=\'' . $item_f .'\'') . "<br>";
	echo "Health Regen: " . getFirstIntResponse('select health_regen from item where name=\'' . $item_f .'\'') . "<br>";
	echo "Gold Regen: " . getFirstIntResponse('select gold_regen from item where name=\'' . $item_f .'\'') . "<br>";
	echo "Cost: " . getFirstIntResponse('select cost from item where name=\'' . $item_f .'\'') . "<br>";
	if(!empty(getFirstResponse('select item_name from item_has_passive where item_name=\'' . $item_f .'\'')))
	{
		try {
   
				
				//echo $query . "<br>";

					$t = getFirstResponse('select active_name from item_has_passive where item_name=\'' . $item_f .'\'');
					echo "<br>";
					echo "Passive: " . $t . "<br>";
					echo "Normalized Effect: " . getFirstResponse('select normalized_effect from item_passive where name=\'' . $t .'\''). "<br>";
					echo "Cooldown: " . getFirstResponse('select cooldown from item_passive where name=\'' . $t .'\''). "<br>";
					echo "Unique: " . getFirstResponse('select is_unique from item_passive where name=\'' . $t .'\''). "<br>";
					echo "<br>";
				
				}
				catch(PDOException $err) {
					echo "ERROR: Unable to connect: " . $err->getMessage();
				}
	}
	if(!empty(getFirstResponse('select item_name from item_has_active where item_name=\'' . $item_f .'\'')))
	{
		try {
					$t = getFirstResponse('select active_name from item_has_active where item_name=\'' . $item_f .'\'');
					echo "<br>";
					echo "Active: " . $t . "<br>";
					echo "Normalized Effect: " . getFirstResponse('select normalized_effect from item_active where name=\'' . $t .'\''). "<br>";
					echo "Cooldown: " . getFirstResponse('select cooldown from item_active where name=\'' . $t .'\''). "<br>";
					echo "<br>";
				}
				catch(PDOException $err) {
					echo "ERROR: Unable to connect: " . $err->getMessage();
				}
	}
	
	$t_movement =  (getFirstIntResponse('select movement from item where name=\'' . $item_a .'\'')+getFirstIntResponse('select movement from item where name=\'' . $item_b .'\'')+getFirstIntResponse('select movement from item where name=\'' . $item_c .'\'')+getFirstIntResponse('select movement from item where name=\'' . $item_d .'\'')+getFirstIntResponse('select movement from item where name=\'' . $item_e .'\'')+getFirstIntResponse('select movement from item where name=\'' . $item_f .'\''));
	$t_attack_damage =  (getFirstIntResponse('select attack_damage from item where name=\'' . $item_a .'\'')+getFirstIntResponse('select attack_damage from item where name=\'' . $item_b .'\'')+getFirstIntResponse('select attack_damage from item where name=\'' . $item_c .'\'')+getFirstIntResponse('select attack_damage from item where name=\'' . $item_d .'\'')+getFirstIntResponse('select attack_damage from item where name=\'' . $item_e .'\'')+getFirstIntResponse('select attack_damage from item where name=\'' . $item_f .'\''));
	$t_ability_power =  (getFirstIntResponse('select ability_power from item where name=\'' . $item_a .'\'')+getFirstIntResponse('select ability_power from item where name=\'' . $item_b .'\'')+getFirstIntResponse('select ability_power from item where name=\'' . $item_c .'\'')+getFirstIntResponse('select ability_power from item where name=\'' . $item_d .'\'')+getFirstIntResponse('select ability_power from item where name=\'' . $item_e .'\'')+getFirstIntResponse('select ability_power from item where name=\'' . $item_f .'\''));
	$t_armor =  (getFirstIntResponse('select armor from item where name=\'' . $item_a .'\'')+getFirstIntResponse('select armor from item where name=\'' . $item_b .'\'')+getFirstIntResponse('select armor from item where name=\'' . $item_c .'\'')+getFirstIntResponse('select armor from item where name=\'' . $item_d .'\'')+getFirstIntResponse('select armor from item where name=\'' . $item_e .'\'')+getFirstIntResponse('select armor from item where name=\'' . $item_f .'\''));
	$t_magic_resist =  (getFirstIntResponse('select magic_resist from item where name=\'' . $item_a .'\'')+getFirstIntResponse('select magic_resist from item where name=\'' . $item_b .'\'')+getFirstIntResponse('select magic_resist from item where name=\'' . $item_c .'\'')+getFirstIntResponse('select magic_resist from item where name=\'' . $item_d .'\'')+getFirstIntResponse('select magic_resist from item where name=\'' . $item_e .'\'')+getFirstIntResponse('select magic_resist from item where name=\'' . $item_f .'\''));
	$t_health =  (getFirstIntResponse('select health from item where name=\'' . $item_a .'\'')+getFirstIntResponse('select health from item where name=\'' . $item_b .'\'')+getFirstIntResponse('select health from item where name=\'' . $item_c .'\'')+getFirstIntResponse('select health from item where name=\'' . $item_d .'\'')+getFirstIntResponse('select health from item where name=\'' . $item_e .'\'')+getFirstIntResponse('select health from item where name=\'' . $item_f .'\''));
	$t_mana =  (getFirstIntResponse('select mana from item where name=\'' . $item_a .'\'')+getFirstIntResponse('select mana from item where name=\'' . $item_b .'\'')+getFirstIntResponse('select mana from item where name=\'' . $item_c .'\'')+getFirstIntResponse('select mana from item where name=\'' . $item_d .'\'')+getFirstIntResponse('select mana from item where name=\'' . $item_e .'\'')+getFirstIntResponse('select mana from item where name=\'' . $item_f .'\''));
	$t_critical_strike_chance =  (getFirstDoubleResponse('select critical_strike_chance from item where name=\'' . $item_a .'\'')+getFirstDoubleResponse('select critical_strike_chance from item where name=\'' . $item_b .'\'')+getFirstDoubleResponse('select critical_strike_chance from item where name=\'' . $item_c .'\'')+getFirstDoubleResponse('select critical_strike_chance from item where name=\'' . $item_d .'\'')+getFirstDoubleResponse('select critical_strike_chance from item where name=\'' . $item_e .'\'')+getFirstDoubleResponse('select critical_strike_chance from item where name=\'' . $item_f .'\''));
	$t_cooldown_reduction =  (getFirstIntResponse('select cooldown_reduction from item where name=\'' . $item_a .'\'')+getFirstIntResponse('select cooldown_reduction from item where name=\'' . $item_b .'\'')+getFirstIntResponse('select cooldown_reduction from item where name=\'' . $item_c .'\'')+getFirstIntResponse('select cooldown_reduction from item where name=\'' . $item_d .'\'')+getFirstIntResponse('select cooldown_reduction from item where name=\'' . $item_e .'\'')+getFirstIntResponse('select cooldown_reduction from item where name=\'' . $item_f .'\''));
	$t_attack_speed =  (getFirstDoubleResponse('select attack_speed from item where name=\'' . $item_a .'\'')+getFirstDoubleResponse('select attack_speed from item where name=\'' . $item_b .'\'')+getFirstDoubleResponse('select attack_speed from item where name=\'' . $item_c .'\'')+getFirstDoubleResponse('select attack_speed from item where name=\'' . $item_d .'\'')+getFirstDoubleResponse('select attack_speed from item where name=\'' . $item_e .'\'')+getFirstDoubleResponse('select attack_speed from item where name=\'' . $item_f .'\''));
	$t_attack_penetration =  (getFirstIntResponse('select attack_penetration from item where name=\'' . $item_a .'\'')+getFirstIntResponse('select attack_penetration from item where name=\'' . $item_b .'\'')+getFirstIntResponse('select attack_penetration from item where name=\'' . $item_c .'\'')+getFirstIntResponse('select attack_penetration from item where name=\'' . $item_d .'\'')+getFirstIntResponse('select attack_penetration from item where name=\'' . $item_e .'\'')+getFirstIntResponse('select attack_penetration from item where name=\'' . $item_f .'\''));
	$t_magic_penetration =  (getFirstIntResponse('select ability_penetration from item where name=\'' . $item_a .'\'')+getFirstIntResponse('select ability_penetration from item where name=\'' . $item_b .'\'')+getFirstIntResponse('select ability_penetration from item where name=\'' . $item_c .'\'')+getFirstIntResponse('select ability_penetration from item where name=\'' . $item_d .'\'')+getFirstIntResponse('select ability_penetration from item where name=\'' . $item_e .'\'')+getFirstIntResponse('select ability_penetration from item where name=\'' . $item_f .'\''));
	$t_life_steal =  (getFirstDoubleResponse('select life_steal from item where name=\'' . $item_a .'\'')+getFirstDoubleResponse('select life_steal from item where name=\'' . $item_b .'\'')+getFirstDoubleResponse('select life_steal from item where name=\'' . $item_c .'\'')+getFirstDoubleResponse('select life_steal from item where name=\'' . $item_d .'\'')+getFirstDoubleResponse('select life_steal from item where name=\'' . $item_e .'\'')+getFirstDoubleResponse('select life_steal from item where name=\'' . $item_f .'\''));
	$t_mana_regen =  (getFirstIntResponse('select mana_regen from item where name=\'' . $item_a .'\'')+getFirstIntResponse('select mana_regen from item where name=\'' . $item_b .'\'')+getFirstIntResponse('select mana_regen from item where name=\'' . $item_c .'\'')+getFirstIntResponse('select mana_regen from item where name=\'' . $item_d .'\'')+getFirstIntResponse('select mana_regen from item where name=\'' . $item_e .'\'')+getFirstIntResponse('select mana_regen from item where name=\'' . $item_f .'\''));
	$t_health_regen =  (getFirstIntResponse('select health_regen from item where name=\'' . $item_a .'\'')+getFirstIntResponse('select health_regen from item where name=\'' . $item_b .'\'')+getFirstIntResponse('select health_regen from item where name=\'' . $item_c .'\'')+getFirstIntResponse('select health_regen from item where name=\'' . $item_d .'\'')+getFirstIntResponse('select health_regen from item where name=\'' . $item_e .'\'')+getFirstIntResponse('select health_regen from item where name=\'' . $item_f .'\''));
	$t_gold_regen =  (getFirstIntResponse('select gold_regen from item where name=\'' . $item_a .'\'')+getFirstIntResponse('select gold_regen from item where name=\'' . $item_b .'\'')+getFirstIntResponse('select gold_regen from item where name=\'' . $item_c .'\'')+getFirstIntResponse('select gold_regen from item where name=\'' . $item_d .'\'')+getFirstIntResponse('select gold_regen from item where name=\'' . $item_e .'\'')+getFirstIntResponse('select gold_regen from item where name=\'' . $item_f .'\''));
	$t_cost =  (getFirstIntResponse('select cost from item where name=\'' . $item_a .'\'')+getFirstIntResponse('select cost from item where name=\'' . $item_b .'\'')+getFirstIntResponse('select cost from item where name=\'' . $item_c .'\'')+getFirstIntResponse('select cost from item where name=\'' . $item_d .'\'')+getFirstIntResponse('select cost from item where name=\'' . $item_e .'\'')+getFirstIntResponse('select cost from item where name=\'' . $item_f .'\''));
	
	echo "<br>";
	echo "Totals: <br>";
	echo "Movement: " . $t_movement . "<br>";
	echo "Attack Damage: " . $t_attack_damage . "<br>";
	echo "Ability Power: " . $t_ability_power . "<br>";
	echo "Armor: " . $t_armor . "<br>";
	echo "Magic Resist: " . $t_magic_resist . "<br>";
	echo "Health: " . $t_health . "<br>";
	echo "Mana: " . $t_mana . "<br>";
	echo "Critical Strike Chance: " . $critical_strike_chance . "<br>";
	echo "Cooldown Reduction: " . $t_cooldown_reduction . "<br>";
	echo "Attack Speed: " . $t_attack_speed . "<br>";
	echo "Attack Penetration: " . $t_attack_penetration . "<br>";
	echo "Magic Penetration: " . $t_magic_penetration . "<br>";
	echo "Life Steal: " . $t_life_steal . "<br>";
	echo "Mana Regen: " . $t_mana_regen . "<br>";
	echo "Health Regen: " . $t_health_regen . "<br>";
	echo "Gold Regen: " . $t_gold_regen . "<br>";
	echo "Cost: " . $t_cost . "<br>";
	$t_mastery=getFirstIntResponse('select SUM(normalized_value) from masteries where name="'. $primary_a .'" or name="'. $primary_b .'" or name="' . $primary_c . '" or name="'. $primary_d .'" or name="'. $secondary_a .'" or name="'. $secondary_b .'";');
	$t_effective=$t_movement+$t_attack_damage+$t_ability_power+$t_armor+$t_magic_resist+$t_health+$t_mana+$t_critical_strike_chance+$t_attack_speed+$t_attack_penetration+$t_magic_penetration+$t_life_steal+$t_mana_regen+$t_health_regen+$t_gold_regen+$t_mastery;
	$t_effective = $t_effective + $c_total;
	echo "<br>";
	echo "Build Effectiveness: " . $t_effective . "<br>";

	
	
	
	$result=$_POST['number19'];
}
else
{
	echo "<center>";
	echo "Did you know? <br>";
	$num = (int)rand(1,5);
	//What is the Mean for Health of champions?
	//How many items give attack damage bonus?
	//How many items have passives or actives?
	//What is the most expensive build to have on a champion?
	//How many items are currently usable in Summoner's Rift?
	
	if($num == 1)
	{
		echo $num . ". The mean health of champions is: " . getFirstResponse('select AVG(health) from stats where health > 0');
	}
	else if($num == 2)
	{
		echo $num . ". There are " . getFirstResponse('select COUNT(name) from item where ability_power > 0') . " items that give ability power bonus.";
	}
	else if($num == 3)
	{
		echo $num . ". There are " . getFirstResponse('select COUNT(name) from item join item_has_active on item.name = item_has_active.item_name join item_has_passive on item.name = item_has_active.item_name where item_has_passive.active_name is not null or item_has_active.active_name is not null;
') . " items that have at least one active or passive.";
	}
	else if($num == 4)
	{
		echo $num . ". The most expensive build for a champion is to buy six " . getFirstResponse('select name from item order by cost desc;') . ".<br>";
	}
	else
	{
		echo $num . ". There are currently a total of " . getFirstResponse('select COUNT(champion) from champions;') . " champions in League of Legends." . ".<br>";
	}
	
	echo "</center>";
	
}
?>
  
  <head>
  	<style>
  	/* Reset styles of the form */
#docContainer div, #docContainer span, #docContainer applet, #docContainer object, #docContainer iframe, #docContainer
h1, #docContainer h2, #docContainer h3, #docContainer h4, #docContainer h5, #docContainer h6, #docContainer p, #docContainer blockquote, #docContainer pre, #docContainer
a, #docContainer abbr, #docContainer acronym, #docContainer address, #docContainer big, #docContainer cite, #docContainer code, #docContainer
del, #docContainer dfn, #docContainer em, #docContainer img, #docContainer ins, #docContainer kbd, #docContainer q, #docContainer s, #docContainer samp, #docContainer
small, #docContainer strike, #docContainer strong, #docContainer sub, #docContainer sup, #docContainer tt, #docContainer var, #docContainer
b, #docContainer u, #docContainer i, #docContainer center, #docContainer
dl, #docContainer dt, #docContainer dd, #docContainer ol, #docContainer ul, #docContainer li, #docContainer
fieldset, #docContainer form, #docContainer label, #docContainer legend, #docContainer
table, #docContainer caption, #docContainer tbody, #docContainer tfoot, #docContainer thead, #docContainer tr, #docContainer th, #docContainer td, #docContainer
article, #docContainer aside, #docContainer canvas, #docContainer details, #docContainer embed, #docContainer 
figure, #docContainer figcaption, #docContainer footer, #docContainer header, #docContainer hgroup, #docContainer 
menu, #docContainer nav, #docContainer output, #docContainer ruby, #docContainer section, #docContainer summary, #docContainer
time, #docContainer mark, #docContainer audio, #docContainer video {
	margin: 0;
	padding: 0;
	border: 0;
	vertical-align: top;
}

/* HTML5 display-role reset for older browsers */
#docContainer article, #docContainer aside, #docContainer details, #docContainer figcaption, #docContainer figure, #docContainer 
footer, #docContainer header, #docContainer hgroup, #docContainer menu, #docContainer nav, #docContainer section {
	display: block;
}

#docContainer ol, #docContainer ul {
	list-style: none;
}

#docContainer blockquote, #docContainer q {
	quotes: none;
}
#docContainer blockquote:before, #docContainer blockquote:after, #docContainer
q:before, #docContainer q:after {
	content: '';
	content: none;
}
#docContainer table {
	border-collapse: collapse;
	border-spacing: 0;
}


/*Hiding/showing hints.*/
.hidden_hint {
	display:none !important;
}

input:focus + .fb-hint, select:focus + .fb-hint,
textarea:focus + .fb-hint {
	display:inline-block !important;
}


/* Hiddes the spinning buttons in webkit*/
input[type="date"]::-webkit-outer-spin-button,
input[type="date"]::-webkit-inner-spin-button {
    display: none;
}

/* Placeholder colors */
.placeholder {
	color:#BEBEBE !important;
}

#docContainer ::-webkit-input-placeholder {
    color:#BEBEBE !important;
}
#docContainer :-moz-placeholder {
    color:#BEBEBE !important;
}


/* Style to force the submit button to not be standard */
.non-standard{
	-webkit-appearance: none;
	font-size:17px;
	padding:0px;
	color: rgb(0,0,0);
	background-color: rgb(192,192,192);
	border: 2px solid rgb(50,50,50);	
}

/* Container for the scripts error reporting */
#fb_error_report {
	border: 1px solid #BF0000 !important; 
	padding: 10px !important; 
	margin: 10px !important;
	background-color: #fff;
	display:inline-block;
	width:90%;
}

/* Heading for the scripts error reporting */
#fb_error_report h4 {
	color:#BF0000;
	font-size: 16px;
}

/* Container for the scripts error elements */
#fb_error_report ul {
	list-style-type: disc;
	padding:20px;
}

/* Scripts error elements */
#fb_error_report ul li {
	color: #888;
}

/* Theme CSS */
/* This rule will applied to the form container */
#docContainer {
margin: 40px auto;
   padding:0px 0px 0px 0px;
   width: 600px;
   font-family: Helvetica, Arial, Sans-serif;
   font-size:13px;
   color: #333;
   background-color: rgb(246,246,246);
   border: 1px solid rgb(193,193,193);
   -webkit-box-shadow: 0 0 10px 0 rgba(0,0,0,0.28);
   -moz-box-shadow: 0 0 10px 0 rgba(0,0,0,0.28);
   box-shadow: 0 0 10px 0 rgba(0,0,0,0.28);
   -webkit-border-radius: 6px;
   -moz-border-radius: 6px;
   border-radius: 6px;
}

#docContainer #fb-form-header1 {
	height:5px;	
	padding-left:10px;
	padding-top:10px;
}

#docContainer .fb-link-logo {
	display:inline-block;
}

/* Special rule to modify the selector by a new one that can be used in both for Mac and Windows. Must be used with !important*/
#docContainer .selected-object {
   
}

	/* Column properties. This applies to a common style inside the form  in fb-large mode*/
#docContainer.fb-large .column {
	margin: 0px;
	padding: 0 7% 0 7%;
}

	/* Column properties. This applies to a common style inside the form */
#docContainer .column {
	margin: 0px;
	padding: 0 5% 0 5%;
}

	/* Column properties. This applies to a common style inside the form  in fb-small mode*/
#docContainer.fb-small .column {
	margin: 0px;
	padding: 0 8% 0 8%;
}


/* Common rule for the items (label and control)*/
#docContainer .fb-item {
	width: 100%;
	display:inline-block;
    zoom:1;
    *display:inline;
}


/* Common rules for the items padding*/

#docContainer.fb-large .fb-item {   
   padding:6px 4px 15px 4px;
}
#docContainer .fb-item {   
   padding:5px 4px 10px 4px;
}
#docContainer.fb-small .fb-item {   
   padding:4px 2px 5px 2px;
}


/* Common rules for the submit button container padding*/

#docContainer.fb-large #fb-submit-button-div {   
   padding: 6px 5px 20px 5px;
}
#docContainer #fb-submit-button-div {   
   padding: 5px 5px 15px 5px;
}
#docContainer.fb-small #fb-submit-button-div {   
   padding: 4px 3px 10px 3px;
}

/*Rules for the width of the item depending on the current mode used for width */

/*fb-large mode classes*/

#docContainer.fb-large .fb-item.fb-100-item-column{ width:100%; }
#docContainer.fb-large .fb-item.fb-75-item-column{ 	width:73%; }
#docContainer.fb-large .fb-item.fb-66-item-column{ 	width:64%; }
#docContainer.fb-large .fb-item.fb-50-item-column{	width:48%; }
#docContainer.fb-large .fb-item.fb-33-item-column{	width:31%; }
#docContainer.fb-large .fb-item.fb-25-item-column{	width:22%; }
#docContainer.fb-large .fb-item.fb-20-item-column{	width:18%; }

/*Normal mode classes*/
#docContainer .fb-item.fb-100-item-column{ 	width:99%; }
#docContainer .fb-item.fb-75-item-column{ 	width:72%; }
#docContainer .fb-item.fb-66-item-column{ 	width:63%; }
#docContainer .fb-item.fb-50-item-column{	width:47%; }
#docContainer .fb-item.fb-33-item-column{	width:30%; }
#docContainer .fb-item.fb-25-item-column{	width:21%; }
#docContainer .fb-item.fb-20-item-column{	width:16%; }

/*fb-small mode classes*/

#docContainer.fb-small .fb-item.fb-100-item-column{	width:98%; }
#docContainer.fb-small .fb-item.fb-75-item-column{ 	width:70%; }
#docContainer.fb-small .fb-item.fb-66-item-column{ 	width:61%; }
#docContainer.fb-small .fb-item.fb-50-item-column{	width:45%; }
#docContainer.fb-small .fb-item.fb-33-item-column{	width:28%; }
#docContainer.fb-small .fb-item.fb-25-item-column{	width:21%; }
#docContainer.fb-small .fb-item.fb-20-item-column{	width:15%; }


/*Form Elements. This rule is common to all elements (inputs/selects) in fb-large Mode*/
#docContainer.fb-large  input[type=text], #docContainer.fb-large  input[type=password], 
#docContainer.fb-large  input[type=email], #docContainer.fb-large  input[type=number],
#docContainer.fb-large  input[type=date], #docContainer.fb-large  input[type=url], 
#docContainer.fb-large  textarea, #docContainer.fb-large  input[type=file],
#docContainer.fb-large  input[type=tel]{
	color: #666;
	font: normal 12px Helvetica, Arial, Sans-serif;
	border: 1px solid rgb(220,223,231);
	border-top-color: rgb(170,173,178);
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
	width:99%;
	max-width:100%;
}

#docContainer select {width:99%;
max-width:100%;}

	/*Form Elements. This rule is common to all elements (inputs/selects)*/
#docContainer input[type=text], #docContainer input[type=password], 
#docContainer input[type=email], #docContainer input[type=number],
#docContainer input[type=date], #docContainer input[type=url], 
#docContainer textarea, #docContainer input[type=file],
#docContainer input[type=tel] {
	color: #666;
	font: normal 12px Helvetica, Arial, Sans-serif;
	border: 1px solid rgb(220,223,231);
	border-top-color: rgb(170,173,178);
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
	width:98%;
	max-width:100%;
}

/*Form Elements. This rule is common to all elements (inputs/selects) in fb-small Mode*/
#docContainer.fb-small input[type=text], #docContainer.fb-small input[type=password], 
#docContainer.fb-small input[type=email], #docContainer.fb-small input[type=number],
#docContainer.fb-small input[type=date], #docContainer.fb-small input[type=url], 
#docContainer.fb-small textarea, #docContainer.fb-small input[type=file],
#docContainer.fb-small input[type=tel] {
	color: #666;
	font: normal 11px Helvetica, Arial, Sans-serif;
	border: 1px solid rgb(220,223,231);
	border-top-color: rgb(170,173,178);
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
	width:92%;
	max-width:100%;
}

#docContainer input[type=file]  {
   border:none;
}
#docContainer.fb-small input[type=file] {
	border:none;
}
#docContainer.fb-large input[type=file] {
	border:none;
}

	/*Form Elements. This rule is common to all inputs boxes in fb-large Mode*/
#docContainer.fb-large input[type=text], #docContainer.fb-large input[type=password], 
#docContainer.fb-large input[type=email], #docContainer.fb-large input[type=number],
#docContainer.fb-large input[type=date], #docContainer.fb-large input[type=url],
#docContainer.fb-large textarea, #docContainer.fb-large input[type=tel] {
	padding: 9px 6px 9px 6px;
}
	
	/*Form Elements. This rule is common to all inputs boxes*/
#docContainer input[type=text], #docContainer input[type=password], 
#docContainer input[type=email], #docContainer input[type=number],
#docContainer input[type=date], #docContainer input[type=url],
#docContainer input[type=tel], #docContainer textarea {
	padding: 7px 4px 7px 4px;
}

	/*Form Elements. This rule is common to all inputs boxes in fb-small Mode*/
#docContainer.fb-small input[type=text], #docContainer.fb-small input[type=password], 
#docContainer.fb-small input[type=email], #docContainer.fb-small input[type=number],
#docContainer.fb-small input[type=date], #docContainer.fb-small input[type=url],
#docContainer.fb-small textarea, #docContainer.fb-small input[type=tel] {
	padding: 4px 1px 4px 1px;
}



#docContainer .fb-input-number {}


#docContainer .fb-input-number input {color: rgb(69,69,69);
			font: normal 12px Helvetica, arial;
			border: 1px solid rgb(220,223,231);
			border-top-color: rgb(170,173,178);
			-webkit-border-radius: 3px;
			-moz-border-radius: 3px;
			border-radius: 3px;}

/* Rule for the title container */
	#docContainer .fb-header { 
	margin: 0px 0px 0px 0px;
	padding: 0px 0px 0px 0px;
	color:#000;
	text-align:left;
}

/* Rule for the title */
#docContainer .fb-header h2 {font-family: Helvetica, Arial; font-size: 20px; font-weight: bold; padding-top: 0px; color: #333; text-shadow: 0 1px 0 rgba(0,0,0,0.1);}
#docContainer.fb-small .fb-header h2 {font-size: 16px; font-weight: bold; padding-top: 0px; color: #333; text-shadow: 0 1px 0 rgba(0,0,0,0.1);}

/* Rule for the static text container*/
#docContainer .fb-static-text { font-family: Helvetica, Arial; margin: 0px; color: #999;}

/* Rule for the static text */
#docContainer .fb-static-text p { font-family: Helvetica, Arial; font-size: 14px; line-height: 1.6em; padding-bottom: 15px;}
#docContainer.fb-small .fb-static-text p { font-family: Helvetica, Arial; font-size: 13px; line-height: 1.6em; padding-bottom: 15px;}

/*  Rule for Submit button container */
#docContainer #fb-submit-button-div {height: 65px; padding: 10px 0 0 0;}

/*  Rule for Submit button */
#fb-submit-button {
	color: #fff;
	font-family: Helvetica, Arial;
	font-weight: bolder;
	font-size:15px;
	border: none;
	margin-right: 6%;
	margin-left: 6%;
	width: 102px; height: 31px;
	text-shadow: 0 1px 0 rgba(0,0,0,0.3);
	cursor: pointer;
	background: url('../images/btn_submit.png') no-repeat;
	padding:0;
}

#fb-submit-button:hover {
	background: url('../images/btn_submit_hov.png') no-repeat;

}

/*  Rule for captcha container */
#docContainer #fb-captcha_control { 
	padding: 30px 0 30px 0; 
}

/* Rule to be able to control the position of the captcha when generated */
#fb-captcha_control > div { display:inline-block; }

/*  Rule for captcha input */
#fb-captcha_control input { padding: 2px 0 !important; }

/*  Rule for captcha internal */
#recaptcha_table { background-color: rgb(255,255,255); }

/* Rule for the hints */
#docContainer .fb-hint {
	display:inline-block;
	font-size: 11px;
	color: #888;
	margin: 5px 0px 1px 0px;
}


/* Rule for the text area container */
#docContainer .fb-textarea {}

/* Rule for the text area box */
#docContainer .fb-textarea textarea { height: 140px; color: rgb(69,69,69);
			font: normal 12px Helvetica, Arial, Sans-serif;
			border: 1px solid rgb(220,223,231);
			border-top-color: rgb(170,173,178);
			-webkit-border-radius: 3px;
			-moz-border-radius: 3px;
			border-radius: 3px;}

/* Rule for the checkbox container */
#docContainer .fb-checkbox { padding: 0 0 0 2px; color: #444; }

/* Rule for the checkbox inputs */
#docContainer .fb-checkbox input { padding: 0 0 0 2px; display:inline-block;}

/* Rule for the radio buttons container */
#docContainer .fb-radio { padding: 0 0 0 2px; color: #444; }

/* Rule for the radio buttons inputs */
#docContainer .fb-radio input { padding: 0 0 0 2px; display:inline-block;}

/* Rule for the labels of checkboxes and radios */
#docContainer .fb-fieldlabel {
   display: inline;
   margin-top: 10px;
   margin-left: 5px;
   font-size: 0.9em; 
}

#docContainer .fb-radio label, #docContainer .fb-checkbox label {
  margin-bottom:5px;
  margin-top: 11px;
}

/* Rule for the input-boxes container */
#docContainer .fb-input-box {margin-bottom: 5px;}

/* Rule for the input-boxes */
#docContainer .fb-input-box input {color: rgb(69,69,69);
			font: normal 12px Helvetica, Arial, Sans-serif;
			border: 1px solid rgb(220,223,231);
			border-top-color: rgb(170,173,178);
			-webkit-border-radius: 3px;
			-moz-border-radius: 3px;
			border-radius: 3px;}
		
/* Rule for the dropdown container */
#docContainer .fb-dropdown {}

/* Rule for the dropdown select */
#docContainer .fb-dropdown select { padding: 0px; background: white;
	font: normal 12px Helvetica, Arial, Sans-serif;
	width:92%;
	max-width:100%;
}
/* Rule for the listbox container */
#docContainer .fb-listbox {}

/* Rule for the listbox select */
#docContainer .fb-listbox select {color: rgb(69,69,69);
			font: normal 12px Helvetica, Arial, Sans-serif;
			border: 1px solid rgb(220,223,231);
			border-top-color: rgb(170,173,178);
			-webkit-border-radius: 3px;
			-moz-border-radius: 3px;
			border-radius: 3px;
padding: 3px;
}

/* Rule for the listbox select option (selected element) */
#docContainer .fb-listbox select option { padding: 3px 0px; }
		
/* Rule for the file upload container */
#docContainer .fb-button { margin: 0 0 5px 0;}
 
/* Rule for the file upload input */
#docContainer .fb-button input { color: #777; font-family: Helvetica, Arial, Sans-serif;}

/* Rule for the date container */
#docContainer .fb-input-date { margin: 0 0 5px 0; }

/* Rule for the date input */
#docContainer .fb-input-date input {color: rgb(69,69,69);
			font: normal 12px Helvetica, Arial, Sans-serif;
			border: 1px solid rgb(220,223,231);
			border-top-color: rgb(170,173,178);
			-webkit-border-radius: 3px;
			-moz-border-radius: 3px;
			border-radius: 3px;
}


/* Rule for the phone input */
#docContainer .fb-phone input {color: rgb(69,69,69);
			font: normal 12px Helvetica, Arial, Sans-serif;
			border: 1px solid rgb(220,223,231);
			border-top-color: rgb(170,173,178);
			-webkit-border-radius: 3px;
			-moz-border-radius: 3px;
			border-radius: 3px;
}

/* Rule for the regex input */
#docContainer .fb-regex input {color: rgb(69,69,69);
			font: normal 12px Helvetica, Arial, Sans-serif;
			border: 1px solid rgb(220,223,231);
			border-top-color: rgb(170,173,178);
			-webkit-border-radius: 3px;
			-moz-border-radius: 3px;
			border-radius: 3px;
}

/* Rule for the section break container */


/* Rule for the section break hr */
#docContainer .fb-sectionbreak hr { margin: 0 auto; padding: 0 auto; border:none; border-top: 1px solid #9e9e9e; width: 100%;}

/* Rule for the labels */

 #docContainer .fb-grouplabel {
 margin-bottom: 5px;
 margin-top: 5px;
 padding-right:5px;
 clear:both;

}

#docContainer .fb-grouplabel label{
	font-weight: bold;
	margin-bottom: 0px;
	padding-top: 4px;
}



/* Rule for labels aligned right */
.fb-rightlabel .fb-grouplabel {
	float:left;
	text-align:right;
	width:30%;
}
.fb-rightlabel .fb-input-box,
.fb-rightlabel .fb-dropdown,
.fb-rightlabel .fb-listbox,
.fb-rightlabel .fb-button,
.fb-rightlabel .fb-textarea,
.fb-rightlabel .fb-radio,
.fb-rightlabel .fb-input-number,
.fb-rightlabel .fb-checkbox,
.fb-rightlabel .fb-input-date,
.fb-rightlabel .fb-phone,
.fb-rightlabel .fb-regex,
.fb-rightlabel  label.error,
.fb-rightlabel .fb-hint {
	float:left;
	width:65%;
}

/* General rule for hints */
 #docContainer.fb-rightlabel .fb-hint { margin-left: 30%; }

 /* Specific rule for input elements */
 #docContainer.fb-rightlabel .fb-input-box .fb-hint,
 #docContainer.fb-rightlabel .fb-button .fb-hint,
 #docContainer.fb-rightlabel .fb-textarea .fb-hint,
 #docContainer.fb-rightlabel .fb-input-number .fb-hint,
 #docContainer.fb-rightlabel .fb-input-date .fb-hint,
 #docContainer.fb-rightlabel .fb-phone .fb-hint,
 #docContainer.fb-rightlabel .fb-regex .fb-hint {
        margin-left: 0px;
        width:100%;

 }



/* Rule for labels aligned on the left */
.fb-leftlabel .fb-grouplabel {
	float:left;
	width:30%;
	text-align:left;
}
.fb-leftlabel .fb-input-box,
.fb-leftlabel .fb-dropdown,
.fb-leftlabel .fb-listbox,
.fb-leftlabel .fb-button,
.fb-leftlabel .fb-textarea,
.fb-leftlabel .fb-input-number,
.fb-leftlabel .fb-radio,
.fb-leftlabel .fb-checkbox,
.fb-leftlabel .fb-input-date,
.fb-leftlabel .fb-phone,
.fb-leftlabel .fb-regex,
.fb-leftlabel  label.error,
.fb-leftlabel .fb-hint {
	float:left;
	width:60%;
}

/* General rule for hints */
 #docContainer.fb-leftlabel .fb-hint { margin-left: 30%; }

 /* Specific rule for input elements */
 #docContainer.fb-leftlabel .fb-input-box .fb-hint,
 #docContainer.fb-leftlabel .fb-button .fb-hint,
 #docContainer.fb-leftlabel .fb-textarea .fb-hint,
 #docContainer.fb-leftlabel .fb-input-number .fb-hint,
 #docContainer.fb-leftlabel .fb-input-date .fb-hint,
 #docContainer.fb-leftlabel .fb-phone .fb-hint,
 #docContainer.fb-leftlabel .fb-regex .fb-hint {
        margin-left: 0px;
        width:100%;

 }



/* Rule for labels aligned on top */
.fb-toplabel .fb-grouplabel {width: 95%; }
.fb-toplabel .fb-input-box,
.fb-toplabel .fb-dropdown,
.fb-toplabel .fb-listbox,
.fb-toplabel .fb-button,
.fb-toplabel .fb-input-number,
.fb-toplabel .fb-textarea,
.fb-toplabel .fb-radio,
.fb-toplabel .fb-checkbox,
.fb-toplabel .fb-input-date,
.fb-toplabel .fb-phone,
.fb-toplabel .fb-regex,
.fb-toplabel .fb-hint,
.fb-toplabel  label.error {
	margin: 9px 0 0 0;
	float:none;
	width:95%;
}
#docContainer.fb-toplabel .fb-hint {margin-left: 2px}


/* Rules checkboxes/radios columns */
.fb-one-column .fb-radio label, .fb-one-column .fb-checkbox label {
	display:inline-block;
	width:100%;
}
.fb-two-column .fb-radio label, .fb-two-column .fb-checkbox label {
	display:inline-block;
	float:left;
	width:47%;
} 
.fb-three-column .fb-radio label, .fb-three-column .fb-checkbox label {
	display:inline;
	float:left;
	width:33%;
}
 
#docContainer .fb-side-by-side .fb-radio label .fb-fieldlabel,#docContainer .fb-side-by-side .fb-checkbox label .fb-fieldlabel{
	margin-left: 1px;
	margin-right: 10px;
}

.fb-side-by-side .fb-radio label, .fb-side-by-side .fb-checkbox label {
display:inline-block;
float:left;
}


/*  General rules for submit button, static text, and header alignments */
#docContainer .fb-item-alignment-left {
   padding-left:0px;
   text-align:left;
}
#docContainer .fb-item-alignment-center {
   text-align:center;
}
#docContainer .fb-item-alignment-right {
	padding-right:0px;
	text-align:right;
}
#docContainer .fb-item-alignment-justify {
	padding-left:0px;
	padding-right:0px;
	text-align:justify;
}

/*  Rules for container header alignments */
#docContainer .fb-header.fb-item-alignment-left {}
#docContainer .fb-header.fb-item-alignment-center {}
#docContainer .fb-header.fb-item-alignment-right {}

/*  Rules for element header alignments */
#docContainer .fb-header.fb-item-alignment-left h2 {}
#docContainer .fb-header.fb-item-alignment-center h2 {}
#docContainer .fb-header.fb-item-alignment-right h2 {}

/*  Rules for container static text alignments */
#docContainer .fb-static-text.fb-item-alignment-left {}
#docContainer .fb-static-text.fb-item-alignment-center {}
#docContainer .fb-static-text.fb-item-alignment-right {}

/*  Rules for element static text alignments */
#docContainer .fb-static-text.fb-item-alignment-left p {}
#docContainer .fb-static-text.fb-item-alignment-center p {}
#docContainer .fb-static-text.fb-item-alignment-right p {}


/*  Rules for container submit alignments */
#docContainer #fb-submit-button-div.fb-item-alignment-left {}
#docContainer #fb-submit-button-div.fb-item-alignment-center {}
#docContainer #fb-submit-button-div.fb-item-alignment-right {}

/*  Rules for element submit alignments */
#docContainer #fb-submit-button-div.fb-item-alignment-left input {}
#docContainer #fb-submit-button-div.fb-item-alignment-center input {}
#docContainer #fb-submit-button-div.fb-item-alignment-right input {}

/* Rules for Validation styles */
#docContainer label.error {
    background-color:transparent;
	font-weight: normal;
    padding: 5px;
	display:block;
	clear:both;
	color: #BF0000;
	font: italic 12px Helvetica,sans-serif;
	margin: 1px 0 0 0;
}
#docContainer input[type=text].error, #docContainer input[type=password].error, 
#docContainer input[type=email].error, #docContainer input[type=number].error,
#docContainer input[type=date].error, #docContainer input[type=url].error,
#docContainer input[type=tel].error, #docContainer textarea.error, 
#docContainer select.error {
}
#docContainer .fb-fieldlabel {
  float: left;
  width: 80%;
  margin-top: 0px;
}
#docContainer input[type="radio"], #docContainer input[type="checkbox"] {
  float: left;
}
#docContainer .fb-side-by-side .fb-radio label .fb-fieldlabel,#docContainer .fb-side-by-side .fb-checkbox label .fb-fieldlabel {
  width: 100%;
  float: none;
}
.fb-side-by-side .fb-radio input[type="radio"], .fb-side-by-side .fb-checkbox input[type="checkbox"] {float: none;margin-right:3px;}
		#docContainer .fb-html a { color:#0066D6; text-decoration:underline; }
		#docContainer .fb-html a:hover { color:#CC3300 !important; text-decoration:underline; }
		#docContainer .fb-html a:focus { outline:thin dotted; outline:5px auto -webkit-focus-ring-color; outline-offset:-2px; }
		#docContainer .fb-html a:hover, #docContainer .fb-html a:active { outline:0; }
		#docContainer .fb-html a:visited { color:#5575A0; }
		#docContainer .fb-html ul, #docContainer .fb-html ol { padding:0; margin:15px 0 15px 25px; text-align:left; }
		#docContainer .fb-html ul { list-style:disc; }
		#docContainer .fb-html ol { list-style:decimal; }
		#docContainer .fb-html li { line-height:15px; padding:5px 0; vertical-align:middle;}
		#docContainer .fb-html blockquote { border-left:5px solid #ddd; margin:15px 0; padding:0 0 0 15px; text-align:left; }
		#docContainer .fb-html blockquote, #docContainer .fb-html blockquote p { font-size:14px; font-weight:300; line-height:20px; }
		#docContainer .fb-html blockquote small { display:block; font-size:12px; line-height:22px; color:#999; }
		#docContainer .fb-html blockquote small:before { content:'\2014 \00A0'; }
		#docContainer .fb-html blockquote:before, #docContainer .fb-html blockquote:after { content:""; }
		#docContainer .fb-html table { max-width:100%; border-collapse:collapse; border-spacing:0; }
		#docContainer .fb-html table { border:1px solid #ddd; margin:15px 0; width:100%; }
		#docContainer .fb-html table th, #docContainer .fb-html table td { border-top:1px solid #ddd; line-height:18px; padding:8px; text-align:left; }
		#docContainer .fb-html table th { font-weight:bold; vertical-align:bottom; }
		#docContainer .fb-html table td { vertical-align:top; }
		#docContainer .fb-html table thead:first-child tr th, #docContainer .fb-html table thead:first-child tr td { border-top:0; }
		#docContainer .fb-html table tbody tr:nth-child(odd) th, #docContainer .fb-html table tbody tr:nth-child(odd) td { background-color:#fbfbfb; }/**
 * Additions for making themes responsive: From here to the end
 */

/*Responsive Addition*/
@media screen and (max-width: 768px) {
   #docContainer.fb-large .fb-item.fb-25-item-column,
   #docContainer.fb-large .fb-item.fb-20-item-column {
      width: 47%;
   }
   #docContainer .fb-item.fb-25-item-column,
   #docContainer .fb-item.fb-20-item-column {
      width: 47%;
   }
   #docContainer.fb-small .fb-item.fb-25-item-column,
   #docContainer.fb-small .fb-item.fb-20-item-column {
      width:45%;
   }
}

/*Responsive Addition*/
@media screen and (max-width:480px) {
   #docContainer.fb-large .fb-item.fb-75-item-column,
   #docContainer.fb-large .fb-item.fb-66-item-column,
   #docContainer.fb-large .fb-item.fb-50-item-column,
   #docContainer.fb-large .fb-item.fb-33-item-column,
   #docContainer.fb-large .fb-item.fb-25-item-column,
   #docContainer.fb-large .fb-item.fb-20-item-column,

   #docContainer .fb-item.fb-75-item-column,
   #docContainer .fb-item.fb-66-item-column,
   #docContainer .fb-item.fb-50-item-column,
   #docContainer .fb-item.fb-33-item-column,
   #docContainer .fb-item.fb-25-item-column,
   #docContainer .fb-item.fb-20-item-column,

   #docContainer.fb-small .fb-item.fb-75-item-column,
   #docContainer.fb-small .fb-item.fb-66-item-column,
   #docContainer.fb-small .fb-item.fb-50-item-column,
   #docContainer.fb-small .fb-item.fb-33-item-column,
   #docContainer.fb-small .fb-item.fb-25-item-column,
   #docContainer.fb-small .fb-item.fb-20-item-column {
      width: 100%;
   }
}

/*Responsive Addition*/
@media screen and (max-width: 768px) {
   .fb-rightlabel .fb-grouplabel {
      float:none;
      text-align:left;
      width:100%;
   } 
   .fb-rightlabel .fb-input-box,
   .fb-rightlabel .fb-dropdown,
   .fb-rightlabel .fb-listbox,
   .fb-rightlabel .fb-button,
   .fb-rightlabel .fb-textarea,
   .fb-rightlabel .fb-radio,
   .fb-rightlabel .fb-input-number,
   .fb-rightlabel .fb-checkbox,
   .fb-rightlabel .fb-input-date,
   .fb-rightlabel  label.error,
   .fb-rightlabel .fb-hint, 
   .fb-rightlabel .fb-phone,
   .fb-rightlabel .fb-regex{
      float:none;
      width:100%;
   }

   .fb-leftlabel .fb-grouplabel {
      float:none;
      width:100%;
      text-align:left;
   }
   .fb-leftlabel .fb-input-box,
   .fb-leftlabel .fb-dropdown,
   .fb-leftlabel .fb-listbox,
   .fb-leftlabel .fb-button,
   .fb-leftlabel .fb-textarea,
   .fb-leftlabel .fb-input-number,
   .fb-leftlabel .fb-radio,
   .fb-leftlabel .fb-checkbox,
   .fb-leftlabel .fb-input-date,
   .fb-leftlabel  label.error,
   .fb-leftlabel .fb-hint,
   .fb-leftlabel .fb-phone,
   .fb-leftlabel .fb-regex{
      float:none;
      width:100%;
   }
}

/*Responsive Addition*/
@media screen and (max-width: 768px) {
   .fb-three-column .fb-radio label, .fb-three-column .fb-checkbox label {
      width: 47%;
   }
}

@media screen and (max-width: 480px){
   .fb-two-column .fb-radio label, .fb-two-column .fb-checkbox label,
   .fb-three-column .fb-radio label, .fb-three-column .fb-checkbox label {
      width:100%;
   }
}
#docContainer {
   width: 90%;
   max-width: 800px;
   -moz-box-sizing: border-box;
   -webkit-box-sizing: border-box;
   box-sizing: border-box;
}
  	</style>
    <title>
      Champion Stats and Items Sheet
    </title>
  </head>
  
<form class="fb-toplabel fb-100-item-column selected-object" id="docContainer"
action="" enctype="multipart/form-data" method="POST" novalidate="novalidate"
data-form="preview">
  <div class="fb-form-header" id="fb-form-header1">
    <a class="fb-link-logo" id="fb-link-logo1" style="max-width: 104px;" target="_blank"><img title="Alternative text" class="fb-logo" id="fb-logo1" style="width: 100%; display: none;" alt="Alternative text" src="common/images/image_default.png"/></a>
  </div>
  <div class="section" id="section1">
    <div class="column ui-sortable" id="column1">
      <div class="fb-item fb-100-item-column" id="item1">
        <div class="fb-header">
        
        <!--HEADING TITLE-->
          <h2>
            Champion Calculator
          </h2>
        </div>
      </div>
      <div class="fb-item fb-100-item-column" id="item2">
        <div class="fb-grouplabel">
          <label id="item2_label_0" style="display: inline;">Champion</label>
        </div>
        
        <!-- Champion drop down select menu -->
        <div class="fb-dropdown">
          
			<?php
				try {
					$conn = new PDO("mysql:host=localhost;dbname=league", "public", "project123");

					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

					$sql = 'SELECT champion FROM champions';
    
    
    

  
				$query = 'SELECT champion FROM champions';

				$res = mysql_query($query);
				echo "<select name = 'champ_sel'>";
				foreach ($conn->query($sql) as $row) {
					echo "<option value = '{$row['champion']}'";
					if ($selected_champ_id == $row['champion'])
						echo "selected = 'selected'";
					echo ">{$row['champion']}</option>";
				}
				echo "</select>";
				$conn = null;
				}
				catch(PDOException $err) {
					echo "ERROR: Unable to connect: " . $err->getMessage();
				}
			?>
        </div>
      </div>
	  
      
      <!--- Gold input -->
      <div class="fb-item fb-100-item-column" id="item19" style="opacity: 1;">
        <div class="fb-grouplabel">
          <label id="item19_label_0" style="display: inline;">Gold</label>
        </div>
        <div class="fb-input-number">
          <input name="number19" id="item19_number_1" type="number" min="0" max="30000"
          step="1" data-hint="" autocomplete="off" />
        </div>
      </div>
	  
	  <!--- level input -->
      <div class="fb-item fb-100-item-column" id="item999" style="opacity: 1;">
        <div class="fb-grouplabel">
          <label id="item999_label_0" style="display: inline;">Level</label>
        </div>
        <div class="fb-input-number">
          <input name="level" id="level_number_1" type="number" min="1" max="18"
          step="1" data-hint="" autocomplete="off" />
        </div>
      </div>
      
      <!-- Input for Primary Mastery A -->
      <div class="fb-item fb-three-column fb-100-item-column" id="item8">
        <div class="fb-grouplabel">
          <label id="item2_label_0" style="display: inline;">Primary Mastery A</label>
        </div>
        
        <div class="fb-dropdown">
          
			<?php
				$primaryList = array('Press The Attack', 'Conqueror', 'Aftershock', 'Guardian');
				echo "<select name = 'primary_a_sel'>";
				foreach ($primaryList as $row) {
					echo "<option value = '{$row}'";
					if ($selected_primary_a_id == $row)
						echo "selected = 'selected'";
					echo ">{$row}</option>";
				}
				echo "</select>";
			?>
        </div>
      </div>
      
       <!-- Input for Primary Mastery B -->
      <div class="fb-item fb-three-column fb-100-item-column" id="item10">
	  <div class="fb-grouplabel">
          <label id="itembm_label_0" style="display: inline;">Primary Mastery B</label>
        </div>
        
        <div class="fb-dropdown">
          
			<?php
				try {
				
				$primaryList = array('Triumph', 'Overheal', 'Demolish', 'Shield Bash');
				echo "<select name = 'primary_b_sel'>";
				foreach ($primaryList as $row) {
					echo "<option value = '{$row}'";
					if ($selected_primary_b_id == $row)
						echo "selected = 'selected'";
					echo ">{$row}</option>";
				}
				echo "</select>";
				}
				catch(PDOException $err) {
					echo "ERROR: Unable to connect: " . $err->getMessage();
				}
			?>
        </div>
      </div>
      
       <!-- Input for Primary Mastery C -->
      <div class="fb-item fb-three-column fb-100-item-column" id="item6">
	  <div class="fb-grouplabel">
          <label id="itembc_label_0" style="display: inline;">Primary Mastery C</label>
        </div>
        
        <div class="fb-dropdown">
          
			<?php
				try {
				
				$primaryList = array('Legend: Alacrity', 'Legend: Tenacity', 'Second Wind', 'Conditioning');
				echo "<select name = 'primary_c_sel'>";
				foreach ($primaryList as $row) {
					echo "<option value = '{$row}'";
					if ($selected_primary_c_id == $row)
						echo "selected = 'selected'";
					echo ">{$row}</option>";
				}
				echo "</select>";
				}
				catch(PDOException $err) {
					echo "ERROR: Unable to connect: " . $err->getMessage();
				}
			?>
        </div>
      </div>
      
       <!-- Input for Primary Mastery D -->
      <div class="fb-item fb-three-column fb-100-item-column" id="item5" style="opacity: 1;">
	  <div class="fb-grouplabel">
          <label id="itempd_label_0" style="display: inline;">Primary Mastery D</label>
        </div>
        
        <div class="fb-dropdown">
          
			<?php
				try {
				
				$primaryList = array('Coup De Grace', 'Cut Down', 'Overgrowth', 'Revitalize');
				echo "<select name = 'primary_d_sel'>";
				foreach ($primaryList as $row) {
					echo "<option value = '{$row}'";
					if ($selected_primary_d_id == $row)
						echo "selected = 'selected'";
					echo ">{$row}</option>";
				}
				echo "</select>";
				}
				catch(PDOException $err) {
					echo "ERROR: Unable to connect: " . $err->getMessage();
				}
			?>
        </div>
      </div>
      
       <!-- Input for Secondary Mastery A -->
      <div class="fb-item fb-three-column fb-100-item-column" id="item3">
	  <div class="fb-grouplabel">
          <label id="itemsa_label_0" style="display: inline;">Secondary Mastery A</label>
        </div>
        
        <div class="fb-dropdown">
          
			<?php
				try {
				
				$primaryList = array('Nullifying Orb', 'Nimbus Cloak', 'Sudden Impact', 'Cheap Shot');
				echo "<select name = 'secondary_a_sel'>";
				foreach ($primaryList as $row) {
					echo "<option value = '{$row}'";
					if ($selected_secondary_a_id == $row)
						echo "selected = 'selected'";
					echo ">{$row}</option>";
				}
				echo "</select>";
				}
				catch(PDOException $err) {
					echo "ERROR: Unable to connect: " . $err->getMessage();
				}
			?>
        </div>
      </div>
      
      <!-- Input for Secondary Mastery B -->
      <div class="fb-item fb-three-column fb-100-item-column" id="item9" style="opacity: 1;">
	  <div class="fb-grouplabel">
          <label id="itemsb_label_0" style="display: inline;">Secondary Mastery B</label>
        </div>
        
        <div class="fb-dropdown">
          
			<?php
				try {
				
				$primaryList = array('Scorch', 'Waterwalking', 'Zombie Ward', 'Eyeball Collection');
				echo "<select name = 'secondary_b_sel'>";
				foreach ($primaryList as $row) {
					echo "<option value = '{$row}'";
					if ($selected_secondary_b_id == $row)
						echo "selected = 'selected'";
					echo ">{$row}</option>";
				}
				echo "</select>";
				}
				catch(PDOException $err) {
					echo "ERROR: Unable to connect: " . $err->getMessage();
				}
			?>
        </div>
      </div>
      
      <!-- Select Item 1 -->
      <div class="fb-item fb-100-item-column" id="item16" style="opacity: 1;">
        <div class="fb-grouplabel">
          <label id="item16_label_0" style="display: inline;">Item 1</label>
        </div>
        <div class="fb-dropdown">
          <?php
				try {
					$conn = new PDO("mysql:host=localhost;dbname=league", "public", "project123");

					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

					$sql = 'SELECT name FROM item';
    
    
    

  
				$query = 'SELECT name FROM item';

				$res = mysql_query($query);
				echo "<select name = 'item_sel_1'>";
				foreach ($conn->query($sql) as $row) {
					echo "<option value = '{$row['name']}'";
					if ($selected_venue_id == $row['name'])
						echo "selected = 'selected'";
					echo ">{$row['name']}</option>";
				}
				echo "</select>";
				$conn = null;
				}
				catch(PDOException $err) {
					echo "ERROR: Unable to connect: " . $err->getMessage();
				}
			?>
        </div>
      </div>
      
      <!-- Select Item 2 -->
      <div class="fb-item fb-100-item-column" id="item15" style="opacity: 1;">
        <div class="fb-grouplabel">
          <label id="item15_label_0" style="display: inline;">Item 2</label>
        </div>
        <div class="fb-dropdown">
          <?php
				try {
					$conn = new PDO("mysql:host=localhost;dbname=league", "public", "project123");

					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

					$sql = 'SELECT name FROM item';
    
    
    

  
				$query = 'SELECT name FROM item';

				$res = mysql_query($query);
				echo "<select name = 'item_sel_2'>";
				foreach ($conn->query($sql) as $row) {
					echo "<option value = '{$row['name']}'";
					if ($selected_venue_id == $row['name'])
						echo "selected = 'selected'";
					echo ">{$row['name']}</option>";
				}
				echo "</select>";
				$conn = null;
				}
				catch(PDOException $err) {
					echo "ERROR: Unable to connect: " . $err->getMessage();
				}
			?>
        </div>
      </div>
      
      <!-- Select Item 3 -->
      <div class="fb-item fb-100-item-column" id="item11">
        <div class="fb-grouplabel">
          <label id="item11_label_0" style="display: inline;">Item 3</label>
        </div>
        <div class="fb-dropdown">
          <?php
				try {
					$conn = new PDO("mysql:host=localhost;dbname=league", "public", "project123");

					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

					$sql = 'SELECT name FROM item';
    
    
    

  
				$query = 'SELECT name FROM item';

				$res = mysql_query($query);
				echo "<select name = 'item_sel_3'>";
				foreach ($conn->query($sql) as $row) {
					echo "<option value = '{$row['name']}'";
					if ($selected_venue_id == $row['name'])
						echo "selected = 'selected'";
					echo ">{$row['name']}</option>";
				}
				echo "</select>";
				$conn = null;
				}
				catch(PDOException $err) {
					echo "ERROR: Unable to connect: " . $err->getMessage();
				}
			?>
        </div>
      </div>
      
      <!-- Select Item 4 -->
      <div class="fb-item fb-100-item-column" id="item14">
        <div class="fb-grouplabel">
          <label id="item14_label_0" style="display: inline;">Item 4</label>
        </div>
        <div class="fb-dropdown">
          <?php
				try {
					$conn = new PDO("mysql:host=localhost;dbname=league", "public", "project123");

					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

					$sql = 'SELECT name FROM item';
    
    
    

  
				$query = 'SELECT name FROM item';

				$res = mysql_query($query);
				echo "<select name = 'item_sel_4'>";
				foreach ($conn->query($sql) as $row) {
					echo "<option value = '{$row['name']}'";
					if ($selected_venue_id == $row['name'])
						echo "selected = 'selected'";
					echo ">{$row['name']}</option>";
				}
				echo "</select>";
				$conn = null;
				}
				catch(PDOException $err) {
					echo "ERROR: Unable to connect: " . $err->getMessage();
				}
			?>
        </div>
      </div>
      
      <!-- Select Item 5 -->
      <div class="fb-item fb-100-item-column" id="item12">
        <div class="fb-grouplabel">
          <label id="item12_label_0" style="display: inline;">Item 5</label>
        </div>
        <div class="fb-dropdown">
          <?php
				try {
					$conn = new PDO("mysql:host=localhost;dbname=league", "public", "project123");

					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

					$sql = 'SELECT name FROM item';
    
    
    

  
				$query = 'SELECT name FROM item';

				$res = mysql_query($query);
				echo "<select name = 'item_sel_5'>";
				foreach ($conn->query($sql) as $row) {
					echo "<option value = '{$row['name']}'";
					if ($selected_venue_id == $row['name'])
						echo "selected = 'selected'";
					echo ">{$row['name']}</option>";
				}
				echo "</select>";
				$conn = null;
				}
				catch(PDOException $err) {
					echo "ERROR: Unable to connect: " . $err->getMessage();
				}
			?>
        </div>
      </div>
      
      <!-- Select Item 6 -->
      <div class="fb-item fb-100-item-column" id="item13" style="opacity: 1;">
        <div class="fb-grouplabel">
          <label id="item13_label_0" style="display: inline;">Item 6</label>
        </div>
        <div class="fb-dropdown">
          <?php
				try {
					$conn = new PDO("mysql:host=localhost;dbname=league", "public", "project123");

					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

					$sql = 'SELECT name FROM item';
    
    
    

  
				$query = 'SELECT name FROM item';

				$res = mysql_query($query);
				echo "<select name = 'item_sel_6'>";
				foreach ($conn->query($sql) as $row) {
					echo "<option value = '{$row['name']}'";
					if ($selected_venue_id == $row['name'])
						echo "selected = 'selected'";
					echo ">{$row['name']}</option>";
				}
				echo "</select>";
				$conn = null;
				}
				catch(PDOException $err) {
					echo "ERROR: Unable to connect: " . $err->getMessage();
				}
			?>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Submit Button -->
  <div class="fb-item-alignment-left fb-footer" id="fb-submit-button-div"
  style="min-height: 1px;">
  <center><button type="submit" name="submitButton" id="submitButton" value="Submit">Submit</button></center>
    <!--<input class="fb-button-special" id="fb-submit-button" type="submit"
    value="Submit" />-->
  </div>
  
  <div>
  </div>
</form>