<?php

/**
 *   このコードは https://gist.github.com/inflammable/2929362に、
 *  投稿されている javascriptコードを PHPで書き直しました。

http://co.bsnws.net/article/256
 */


class Library_Shorturl_Basis {
//--------------
//数字を圧縮する
//--------------
public static function shot_url_encode($num) {
	//base58に準拠する場合
	$baseString = "123456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ";
	// 大文字削除
	$baseString = '123456789abcdefghijkmnopqrstuvwxyz'; //34
	// Salesfllowオリジナル
	$baseString = '123456789abcdefghikmnpqrstuvwxyz'; //32

	$baseLength = strlen($baseString);

	while ($num) {
		// 余りの数値
		$remainder = $num % $baseLength;
		$num       = floor($num / $baseLength);
		$encode   .= $baseString[$remainder];
	}
	return $encode;
}

    /**
     * @return Integer
     */
     public static function decode($str)
    {
        if (!is_string($str)) {
            throw new Exception('not string');
        }

        $decode = 0;

        while ($str) {
            $position = strrpos($baseString, $str[0]);

            if ($position < 0) {
                throw new Exception('"decode" can\'t find "' + $str[0] + '" in the alphabet: "' + $baseString + '"');
            }

            $power = strlen($str) - 1;
            $decode += $position * pow($baseLength, $power);
            $str = substr($str, 1);
        }

        return $decode;
    }



/*
よくわからんが、すごい
*/
public static function scramble($seed) {
  $hash_keys = array(
    0x12345678, 0x87654321
  );
  $value = $seed;
  foreach($hash_keys as $hash) {
    $hash = ($hash & 0x7fffffff | 0x1);
    $value = ($value * $hash) & 0x7fffffff;
  }
  return $value;
}











}





































/*

class ShortURL
{
    function __construct()
    {
        //base58に準拠する場合
        $this->baseString = "123456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ";
        
        // 文字列の並びを変えると発行される文字列も変わります
        // $this->baseString = 'hwqAQ4JfZTLvU79xX5YEdrHRMe3NjPyuioGKmpFbDkcSntBzgVW621a8Cs';
        
        // 圧縮URLとして限定するなら 'O', 'l', 'I', '-', '_'を追加した 計63文字でも問題ありません
　　　　 // $this->baseString = "123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNPOQRSTUVWXYZ-_";

        $this->baseLength = strlen($this->baseString);
    }

    /**
     * @return String
     */

/*
     function encode($num)
    {
        if (!is_numeric($num)) {
            throw new Exception('TypeError : $num of value must be integer.');
        }

        $encode = "";

        while ($num) {
            $remainder = $num % $this->baseLength;
            $num = floor($num / $this->baseLength);
            $encode .= $this->baseString[$remainder];
        }

        return strrev($encode);
    }

    /**
     * @return Integer
     */

/*
     function decode($str)
    {
        if (!is_string($str)) {
            throw new Exception('not string');
        }

        $decode = 0;

        while ($str) {
            $position = strrpos($this->baseString, $str[0]);

            if ($position < 0) {
                throw new Exception('"decode" can\'t find "' + $str[0] + '" in the alphabet: "' + $this->baseString + '"');
            }

            $power = strlen($str) - 1;
            $decode += $position * pow($this->baseLength, $power);
            $str = substr($str, 1);
        }

        return $decode;
    }
}

*/