<?php
class Library_Dir_Basis {
	//----------------------------------
	//ディレクトリー内のファイルを全削除
	//----------------------------------
	public static function dir_file_all_del($dir) {
		// ディテクトリ内のオブジェクト取得
		if($cache_opendir_object = opendir($dir)) {
			// オブジェクト走査
			while (false !== ($file_name = readdir($cache_opendir_object))) {
				// .と..を外す
				if($file_name != '.'  && $file_name != '..') {
					// ファイル削除
					unlink($dir.$file_name);
				}
			}
			// ディレクトリーを閉じる
			closedir($cache_opendir_object);
		}
	}
}
