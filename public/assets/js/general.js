/*************************
デバッグ変数コンストラクタ
*************************/

var p        = console.log;
var print    = console.log;
var var_dump = console.dir;
var trace    = console.trace;
var time     = console.time;
var count    = console.count;


/*****************
ブラウザ・機種判別
*****************/
var UA_tool = function(){
    var os = 'other';
    var browser = 'other';
    var version = 1;
    var mobile = '';
    var ua = window.navigator.userAgent.toLowerCase();
    if(ua.indexOf('win')!=-1){
        this.os = 'win';
    }else if(ua.indexOf('mac')!=-1){
        this.os = 'mac';
    }
    if(ua.indexOf('msie')!=-1){
        this.browser = 'ie';
        var av = window.navigator.appVersion.toLowerCase();
        if(av.indexOf('msie 6.')!=-1){
            this.version = 6;
        }else if(av.indexOf('msie 7.')!=-1){
            this.version = 7;
        }else if(av.indexOf('msie 8.')!=-1){
            this.version = 8;
        }else if(av.indexOf('msie 9.')!=-1){
            this.version = 9;
        }else{
            this.version = 999;
        }
    }else if(ua.indexOf('chrome')!=-1){
        this.browser = 'chrome';
    }else if(ua.indexOf('safari')!=-1){
        this.browser = 'safari';
    }else if(ua.indexOf('firefox')!=-1){
        this.browser = 'firefox';
    }
    if(ua.indexOf('iphone')!=-1){
        this.mobile = 'iphone';
    }else if(ua.indexOf('ipad')!=-1){
        this.mobile = 'ipad';
    }else if(ua.indexOf('android')!=-1){
        this.mobile = 'android';
    }
};
var ua = new UA_tool();
var uaa = window.navigator.userAgent.toLowerCase();

/*************
グローバル変数
*************/
	if(navigator.userAgent.indexOf("Opera") != -1) { // 文字列に「Opera」が含まれている場合
		var user_browser = 'Opera';
	}
		else if(navigator.userAgent.indexOf("MSIE") != -1) { // 文字列に「MSIE」が含まれている場合
			var user_browser = 'MSIE';
	;	}
			else if(navigator.userAgent.indexOf("Firefox") != -1) { // 文字列に「Firefox」が含まれている場合
				var user_browser = 'Firefox';
			}
				else if (navigator.userAgent.indexOf('Chrome') != -1) { // 文字列に「Chrome」が含まれている場合
					var user_browser = 'Chrome';
				}
					else if(navigator.userAgent.indexOf("Netscape") != -1) { // 文字列に「Netscape」が含まれている場合
						var user_browser = 'Natscape';
					}
						else if(navigator.userAgent.indexOf("Safari") != -1) { // 文字列に「Safari」が含まれている場合
							var user_browser = 'Safari';
						}
							else {
								var user_browser = '';
							}
/***********
http切り替え
***********/
if (location.host == 'localhost') {
	var http = 'http://localhost/salesfllow/';
}
	else if (location.host == 'salesfllow.cloud') {
		var http = 'http://salesfllow.cloud/';
	}
		else if (location.host == 'www.salesfllow.cloud') {
			var http = 'http://sharetube.cloud/';
		}


//----------------------------------------------------------------------
//文字列の先頭および末尾の連続する「半角空白・タブ文字・全角空白」を削除
//----------------------------------------------------------------------
function tab_space_delete(word) {
	return word.replace(/^[\s　]+|[\s　]+$/g, "");
}

/*******************
HTML読み込み後に処理
*******************/
$(window).load(function(){

});


/*
//----------------
//ブラウザの大きさ
//----------------
$(window).width();
$(window).height();
//----------------------
//スクロールしている数値
//----------------------
$(window).scrollTop();
//------------
//一番底の数値
//------------
$('html').height()
*/