<?php
/*
* 
* セキュリティーBasis関連クラス
* 
* 
* 
*/

class Model_Security_Basis {
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
	//--------------------------------
	//ゲットの中身をエンティティ化する
	//--------------------------------
	public static function get_security() {
		$get = array();
		foreach($_GET as $key => $value) {
			$get[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
		}
		return $get;
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

