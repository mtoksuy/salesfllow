/*************************
デバッグ変数コンストラクタ
*************************/
/*
var p        = console.log;
var print    = console.log;
var var_dump = console.dir;
var trace    = console.trace;
var time     = console.time;
var count    = console.count;
*/
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
	var http = 'http://localhost/sharetube/';
}
	else if (location.host == 'sharetube.jp') {
		var http = 'http://sharetube.jp/';
	}
		else if (location.host == 'www.sharetube.jp') {
			var http = 'http://sharetube.jp/';
		}
//----------------------------------------------------------------------
//文字列の先頭および末尾の連続する「半角空白・タブ文字・全角空白」を削除
//----------------------------------------------------------------------
function tab_space_delete(word) {
	return word.replace(/^[\s　]+|[\s　]+$/g, "");
}
	//----------------
	//読み込み後の処理
	//----------------
	$(function() {
		//
		//
		//
		var drawer_flg     = true;
		var main_touch_flg = false;
		//--------------------
		//ドロワーメニュー実装
		//--------------------
		$('.nav a').click( function() {
			// 大体このアルゴリズムで移動する
			master_px = (185 - (($(window).width() - $('.main').width()) / 2));
			left_px = master_px;
			if(left_px < 0) {
				left_px = 0;
			}
			// ブラウザのサイズによって調整していく
				if($(window).width() <= 768) {

				}
					else if($(window).width() <= 800) {

					}
						else if($(window).width() <= 1000) {

						}
							else if($(window).width() <= 1200) {

							}
								else if($(window).width() <= 1400) {

								}
			// ドロワー開く
			if(drawer_flg == true) {
				$('.drawer_nav').css( {
					visibility: 'visible',
				});
				$('.main').css( {
					left: left_px,
				});
				$('.header_contents').css( {
					left: left_px,
				});
				$('.scroll_top').css( {
					display: "none",
				});
				$('.shuffle_button').css( {
					display: "none",
				});
				$('.mobile_ad').css( {
					left: left_px,
				});
				$('.footer').css( {
					left: left_px,
				});
				drawer_flg = false;
				main_touch_flg = true;
			}
			// ドロワー閉じる
				else if(drawer_flg == false) {
					$('.drawer_nav').css( {
						visibility: 'hidden',
					});
					$('.main').css( {
						left: 0,
					});
					$('.header_contents').css( {
						left: 0,
					});
					$('.scroll_top').css( {
						display: "block",
					});
					$('.shuffle_button').css( {
						display: "none",
					});
					$('.mobile_ad').css( {
						left: 0,
					});
					$('.footer').css( {
						left: 0,
					});
					drawer_flg = true;
					main_touch_flg = false;
				}
		}); // ドロワーメニュー実装
		//------------------------------------------------
		//メインでクリックされたらドロワーメニューを閉じる
		//------------------------------------------------
		$('.main').click(function() {
			if(main_touch_flg == true) {
//				alert('tesu');
				$('.drawer_nav').css( {
					visibility: 'hidden',
				});
				$('.main').css( {
					left: 0,
				});
				$('.header_contents').css( {
					left: 0,
				});
				$('.mobile_ad').css( {
					left: 0,
				});
				$('.footer').css( {
					left: 0,
				});
				drawer_flg = true;
				main_touch_flg = false;
			}
		});
		//------------
		//人気記事機能
		//------------
		$('.article_access_popular_button').click(function() {
			// 取り敢えずpush消す
			$('.article_access_popular').children('.push').attr('class', 'article_access_popular_button');
			// 押したボタンをpushにする
			this.className = 'article_access_popular_button push';
				var ul_class     = this.getAttribute("data-article_access_popular_class");
			// 一旦消す
			$('.article_access_popular_today, .article_access_popular_week, .article_access_popular_month').css( {
				display: 'none'
			});
			// 押されたclassだけ表示する
			$('.'+ul_class).css( {
				display: 'block'				
			});
		});
	//----------------------
	//カテゴリー 表示 非表示
	//----------------------
	var trigger_category_flg         = true;
	var trigger_category_wrapper_flg = false;
	$('.trigger_category').click(function(event) {
		if(trigger_category_flg == true) {
			$('.trigger_category').css( {
				 background: 'url("'+ http +'assets/img/common/sprite_arrow_bottom_2.gif") no-repeat scroll 0 -7px rgba(0, 0, 0, 0)'
			});
			$('.category_nav').css( {
				display: 'block'
			});
			trigger_category_flg = false;
		}
			else {
				$('.trigger_category').css( {
					 background: 'url("'+ http +'assets/img/common/sprite_arrow_bottom_2.gif") no-repeat scroll 0 10px rgba(0, 0, 0, 0)'
				});
				$('.category_nav').css( {
					display: 'none'
				});
				trigger_category_flg = true;
			}
		event.stopPropagation();
	});
	$('.category_nav').click(function(event) {
		event.stopPropagation();
	});

	//ウインドウクリック時
	$(window).click(function() {
		$('.trigger_category').css( {
			 background: 'url("'+ http +'assets/img/common/sprite_arrow_bottom_2.gif") no-repeat scroll 0 10px rgba(0, 0, 0, 0)'
		});
		$('.category_nav').css( {
			display: 'none'
		});
		trigger_category_flg = true;
	});
	//-------------------------------------------------------
	//全ページトップでトップにスクロールするボタン表示 非表示
	//-------------------------------------------------------
 $(window).scroll(function() {
	 if($(window).width() > 319 && $(this).scrollTop() > 700) {
			$('.scroll_top').fadeIn();
	 }
	 		else {
				$('.scroll_top').fadeOut();
	 		}
 });
	//----------------------------------------------------
	//全ページトップでトップにスクロールするボタンクリック
	//----------------------------------------------------
	$('.scroll_top').click(function() {
		$('html, body').animate({
			scrollTop: 0
		}, 1000);
	});
	//----------------------------
	//オールヘッダーアド削除ボタン
	//----------------------------
	$('#wrapper').on( {
		'click' : function() {
			swal({
			  title: '広告を削除致しますか？',
			  text: '削除すると1カ月間 表示されません',
			//  type: "warning",
			  showCancelButton: true,
			//  confirmButtonColor: "#DD6B55",
			  confirmButtonText: '削除する',
				cancelButtonText: 'キャンセル',
//			  closeOnConfirm: false
			},
				function() {
					$('.all_header_ad').remove();
						// 時間設定
						var expire = new Date();
						expire.setTime( expire.getTime() + (1000 * 3600 * 24)*30 );
						// クッキー書き込み
						document.cookie = 'all_header_ad_delete=false; path=/; expires=' + expire.toUTCString();
		//				swal("Deleted!", "Your imaginary file has been deleted.", "success");
				});
		}
	}, '.all_header_ad_delete');
	/***********************
	目次から見出しにジャンプ
	***********************/
	$('html').on( {
		'click': function() {
			// 768以下の場合
			if($(window).width() <= 768) {
				header_height = 59;
			}
				// pcの場合
				else {
					header_height = 0;
				}
			this_wording = $(this).html();
			$('.h2_heading_1, .h3_heading_1, .h4_heading_1').each(function(i, e) {
				if(this_wording == $(this).html()) {
//					cotents_offset_top = $(this).parents('.matome_content_block').offset().top;
					cotents_offset_top = $(this).offset().top;

					$('html,body').animate({scrollTop: ((cotents_offset_top - 10) - header_height)  },500);
				}
			});
		}
	}, '.matome_content_block_contents_chapter');
	//----------
	//目次へ移動
	//----------
	$('.contents_button').click(function() {
		cotents_offset_top = $('.matome_content_block_contents').offset().top;
		$('html, body').animate({
			scrollTop: cotents_offset_top -15
		}, 500);
	});































//p('は？');
//p($('.twitter-tweet'));
//var twitter_tweet_object        = $('.twitter-tweet');
//var iframe_twitter_tweet_object = $('iframe');

/*
$('.customisable-border').css( {
	borderwidth: '0px 0 0 !important'
	});
$('.footer').css( {
	borderwidth: '0px 0 0 !important'
	});
*/
//$('iframe').contents().find('.expanded .footer').css('borde-rwidth', '0px 0 0 !important');
//p($('iframe').contents().find('.expanded .footer'));
//$('iframe').contents().find('.expanded .footer').css('borde-rwidth', '0px 0 0 !important');
//p(twitter_tweet_object.length);
//twitter_tweet_object.length;


/*
for(i = 0; i < twitter_tweet_object.length; i++) {
//	p(i);
//	p(twitter_tweet_object[i]);
	//p(twitter_tweet_object[i].children(".footer"));
}
for(i = 0; i < iframe_twitter_tweet_object.length; i++) {
//	p(i);
//	p(iframe_twitter_tweet_object[i]);
//	p(twitter_tweet_object[i].children(".footer"));
}
*/









//for(key in twitter_tweet_object) {
//  p(key + "さんの番号は、" + twitter_tweet_object[key] + "です。") ;
//}

//$('iframe').contents().find('#area').css('width', '100px');







/*

//グローバルナビ（メインメニュー）クリック時
	$(".user_nav").click(function(event) {
		if ($('ul:first',this).css('visibility') == "hidden") {
			$('ul:first',this).css('visibility', 'visible');
			$(this).addClass("dropdown_focus");
		}
		else {
			$('ul:first',this).css('visibility', 'hidden');
			$(this).removeClass("dropdown_focus");
		}
		event.stopPropagation();
	});
	//サブメニュークリック時
	$(".user_nav ul li").click(function(event) {
		event.stopPropagation();
	});	
	//ウインドウクリック時
	$(window).click(function() {
		$('.user_nav').each(function() {
			$(this).removeClass("dropdown_focus");
		});
		$(".user_nav ul").each(function() {
			if ($(this).css('visibility') == 'visible') {
				$(this).css('visibility','hidden');
			}
		});
	});
*/






































	//----------------------
	//アプリで試している関数
	//----------------------
	function window_open(this_html) {
		window.open(this_html, 
		'window', 
		'width=400, height=300, menubar=no, toolbar=no, scrollbars=yes');
		return false;
	}



	}); // $(function() {


/*******************
HTML読み込み後に処理
*******************/
$(window).load(function(){
	//----------------------------
	//関連記事の段落を合わせて表示
	//----------------------------
	var array = [];
	var html = $('.article_inside_related_article .article_inside_related_article_content ul').children();
	$(html).each(function(i, elem) {
		var delete_number = parseInt($(this).css('padding-top'), 10) + parseInt($(this).css('padding-bottom'), 10);
		array.push(elem.clientHeight - delete_number - 9); // innerのpadding10pxを取り除いた 1少ないのは段落つけなくするため
	});
	// 配列の中の最大値を求める
	var max = Math.max.apply(null, array);
	$('.article_inside_related_article .article_inside_related_article_content ul li article a .inner').css( {
		height: max + 'px'
	});
});
/*******************
HTML読み込み後に処理
*******************/
$(window).load(function(){
//	p($('.curator_recruitment').height() +'と'+ $('.curator_recruitment').offset().top);
// 265と5784.299987792969
	//--------------------------
	//まとめ記事作成するひと募集
	//--------------------------
/*
ひとまず、コメントアウト
2016.01.10 松岡

	// ウィンドウの横サイズが1024以上で動く
	if($(window).width() >= 1024) {
		// .curator_recruitmentがあれば動く
		if($('.curator_recruitment').offset()) {
			// 追従ブレークポイント
			var fixed_point = ($('.curator_recruitment').offset().top -31);
			// 最終調整
			setTimeout(function() {
				fixed_point = ($('.curator_recruitment').offset().top -31);
			}, 2000);
			///////////////////
			// スクロールしたら
			///////////////////
			$(window).scroll(function() {
				if($(window).scrollTop() > fixed_point) {
					// 追従開始
					$('.curator_recruitment').css( {
						'position' : 'fixed'
					});
				}
					// 追従停止
					else {
						fixed_point = ($('.curator_recruitment').offset().top -31);
						$('.curator_recruitment').css( {
							'position' : 'static'
						});
					}
			}); // $(window).scroll(function() {
		} // if($('.curator_recruitment').offset()) {
	}
*/
});



//----------------
//アプリ関数テスト
//----------------
function app_test() {
	var text = 'テキスト';
	return text;
}
//------------------
//リサイズの時の参考
//------------------
/*
	$(window).resize(function() {
	    //ボックスサイズ
	    $("#modalbox").css({
	        top: ($(window).height() - $("#modalbox").outerHeight()) / 2,
	        left: ($(window).width() - $("#modalbox").outerWidth()) / 2
	    });
	});
*/























$(function() {
	//----------------------------------
	//slideshareスライドレスポンシブ表示
	//----------------------------------
	if($('.slideshare')) {
		if($(window).width() <= 320) {
			var w              = $('.detail_press').width();
			var y_w            = $('.slideshare iframe').attr('width');
			var y_h            = $('.slideshare iframe').attr('height');
			var ratio          = (y_h / y_w);
			var responsive_y_h = (ratio * w);
			$('.slideshare iframe').attr( {
				width: '100%',
				height: '234'});
		}
	}
	//-----------------------
	//youtubeレスポンシブ表示
	//-----------------------
	if($('.youtube')) {
		if($(window).width() <= 560) {			
			var w              = $('.detail_press').width();
			var y_w            = $('.youtube iframe').attr('width');
			var y_h            = $('.youtube iframe').attr('height');
			var ratio          = (y_h / y_w);
			var responsive_y_h = (ratio * w);
			// 変更
			$('.youtube iframe').attr( {
				width: '100%',
				height: responsive_y_h});
			// ウインドウがリサイズされたら
			$( window ).resize(function() {
				var w_r              = $('.detail_press').width();
				var responsive_y_h_r = (ratio * w_r);
				$('.youtube iframe').attr( {
					width: '100%',
					height: responsive_y_h_r});
			});
		}
	}
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