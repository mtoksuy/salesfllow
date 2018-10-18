<?php
class Library_Security_Basis {
	//------------
	//create62Hash
	//------------
	static function create62Hash($id, $base = 0) {
		$shuffleTable = array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61);
		$asciiTable = array(65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,97,98,99,100,101,102,103,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,48,49,50,51,52,53,54,55,56,57);
		$hashTable = array();
		$i = 0;
		do {
			$hashTable[$i] = chr($asciiTable[$shuffleTable[(int)(floor($id / pow(62, $i)) + $i) % 62]]);
			$i = count($hashTable);
		} while(($base > $i) || (pow(62, $i) <= $id));
		return implode("", $hashTable);
	}
	//--------------------------------
	//ポストの中身をエンティティ化する
	//--------------------------------
	public static function post_security() {
		$post = array();
		foreach($_POST as $key => $value) {
			$post[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
		}
		return $post;
	}
	//------------------------
	//変数をエンティティ化する
	//------------------------
	static function variable_security_entity($variable) {
		if(is_array($variable)) {
			foreach($variable as $key => $value) {
				$variable[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
			}
		}
			else {
				$variable = htmlspecialchars($$variable, ENT_QUOTES, 'UTF-8');
			}
		return $variable;
	}
}

