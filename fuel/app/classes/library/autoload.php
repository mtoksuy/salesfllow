<?php 
class Library_Autoload {
	public $url;
	public $file_name;
	public $dir_1;
	public $dir_2;
	public $dir_name;
	public $dir_name_2;
	//++++++++++++++
	//コンストラクタ
	//++++++++++++++
	function __construct() {
/*
		echo Uri::base().'<br>';
		echo Uri::base(false).'<br>';
		echo Uri::current().'<br>';
		echo Uri::create('http://www.example.org/:some', 
			array('some' => 'thing', 'and' => 'more'), 
			array('what' => ':and'), true).'<br>';
		echo Uri::main().'<br>';
		echo Uri::segment(1).'<br>';
		echo Uri::string().'<br>';
*/
		//------------------
		//環境デフォルト設定
		//------------------
		$this->url         = $_SERVER["PHP_SELF"];                    // 現在いるファイル名を取得
		$this->file_name   = basename($this->url);                    // ファイルネーム取得
		$this->dir_1       = dirname($this->url);                     // 一つ前
		$this->dir_2       = dirname($this->dir_1);                   // もう一つ前
		$this->dir_name    = strrchr($this->dir_1,"/");               // 特定の文字列からの文字列を取得
		$this->dir_name    = str_replace("/", "", $this->dir_name);   // 特定の文字列を置換
		$this->dir_name_2  = strrchr($this->dir_2,"/");               // 特定の文字列からの文字列を取得
		$this->dir_name_2  = str_replace("/", "", $this->dir_name_2); // 特定の文字列を置換

		// ローカル環境
		if($_SERVER["HTTP_HOST"] == 'localhost') {
			// デフォルト変数生成
			$this->http = 'http://localhost/programmerbox/';
			$this->path = '/Volumes/Macintosh HD'.$_SERVER["DOCUMENT_ROOT"].'/programmerbox/';
		}
			// 本番環境
			else {
				// デフォルト変数生成
				$this->http = 'http://'.$_SERVER["HTTP_HOST"].'/';
				$this->path = $_SERVER["DOCUMENT_ROOT"].'/';
			}
	}

	// このクラスがロードされた時に実行されます
	public static function _init() {

	}
	public static function test() {
		echo 'test';
	}
}