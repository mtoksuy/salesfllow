
//----------------
//読み込み後の処理
//----------------
$(function() {
	//--------
	//案件作成
	//--------
	$('.sales_list').on( {
		'click': function() {
			p('dsfsd');
		}
	}, '.sales_submit');



//----------------------------
//案件名インプットエンター挙動
//----------------------------
$('.sales_create').on( {
	'keydown': function(e) {
		if(e.keyCode === 13) {
			return false;
		}
	}
}, '#title');

	//----------------------
	//ステータス表示・非表示
	//----------------------
	$('.sales_create').on( {
		'click' : function(event) {
			// クラス削除
			$('.status').removeClass('o_8');
			// 表示させる
			if($('.status_setting_box').attr('display-data') == 0) {
				$('.status_setting_box').css( {
					'display': 'block',
				});
				$('.status_setting_box').attr('display-data', '1');
			}
				// 非表示にさせる
				else {
					$('.status_setting_box').css( {
						'display': 'none',
					});
					$('.status_setting_box').attr('display-data', '0');
					// クラス追加
					$('.status').addClass('o_8');
				}
			// イベントをここで止める
			event.stopPropagation();
		}
	}, '.status');
	//----------------------
	//ステータスチェック挙動
	//----------------------
	$('.status_setting_box').on( {
		'click' : function(event) {
			/////////////////////////////
			// チェックをクリックして削除
			/////////////////////////////
			if($(this).attr('check-data') == 1) {
				// チェック削除
				$(this).find('.lsf').remove();
				// チェックデータ変更
				$(this).attr('check-data', '0');
				// 削除
				$('.status_setting_block').remove();
				// 削除
				$('.status_hidden').attr('value', '');
			}
				/////////////////////////////////////
				// チェックされていない要素をクリック
				/////////////////////////////////////
				else {
					// チェック追加
					$(this).prepend('<span class="lsf symbol">check</span>');
					// チェックデータ変更
					$(this).attr('check-data', '1');
					// 削除
					$('.status_setting_block').remove();

					// liナンバー取得
					var li_number = $(this).parent('ul').find('li').index(this);
					switch(li_number) {
						case 0:
							// 追加
							$('.status_setting_box').before('<div class="status_setting_block box_color_red">交渉中</div>');
							// 追加
							$('.status_hidden').attr('value', '交渉中');
						break;
						case 1:
							// 追加
							$('.status_setting_box').before('<div class="status_setting_block box_color_limegreen">成約</div>');
							// 追加
							$('.status_hidden').attr('value', '成約');
						break;
						case 2:
							// 追加
							$('.status_setting_box').before('<div class="status_setting_block box_color_grey">破談</div>');
							// 追加
							$('.status_hidden').attr('value', '破談');
						break;
						case 3:
							// 追加
							$('.status_setting_box').before('<div class="status_setting_block box_color_deepskyblue">検討</div>');
							// 追加
							$('.status_hidden').attr('value', '検討');
						break;
					}
					// それ以外を消す
					$(this).parent('ul').find('li').each(function(i) {
					// 同じ要素
					if(li_number == i) {

					}
						// 他の要素
						else {
							// チェック削除
							$(this).find('.lsf').remove();
							// チェックデータ変更
							$(this).attr('check-data', '0');
						}
					});
				}
			// イベントをここで止める
			event.stopPropagation();
		}
	}, 'li');























	//----------------------
	//アプローチ表示・非表示
	//----------------------
	$('.sales_create').on( {
		'click' : function(event) {
			// クラス削除
			$('.approach').removeClass('o_8');
			// 表示させる
			if($('.approach_setting_box').attr('display-data') == 0) {
				$('.approach_setting_box').css( {
					'display': 'block',
				});
				$('.approach_setting_box').attr('display-data', '1');
			}
				// 非表示にさせる
				else {
					$('.approach_setting_box').css( {
						'display': 'none',
					});
					$('.approach_setting_box').attr('display-data', '0');
					// クラス追加
					$('.approach').addClass('o_8');
				}
			// イベントをここで止める
			event.stopPropagation();
		}
	}, '.approach');


	//----------------------
	//アプローチチェック挙動
	//----------------------
	$('.approach_setting_box').on( {
		'click' : function(event) {
			/////////////////////////////
			// チェックをクリックして削除
			/////////////////////////////
			if($(this).attr('check-data') == 1) {
				// チェック削除
				$(this).find('.lsf').remove();
				// チェックデータ変更
				$(this).attr('check-data', '0');
				// 削除
				$('.approach_setting_block').remove();
				// 削除
				$('.approach_hidden').attr('value', '');
			}
				/////////////////////////////////////
				// チェックされていない要素をクリック
				/////////////////////////////////////
				else {
					// チェック追加
					$(this).prepend('<span class="lsf symbol">check</span>');
					// チェックデータ変更
					$(this).attr('check-data', '1');
					// 削除
					$('.approach_setting_block').remove();

					// liナンバー取得
					var li_number = $(this).parent('ul').find('li').index(this);
					switch(li_number) {
						case 0:
							// 追加
							$('.approach_setting_box').before('<div class="approach_setting_block box_color_deepskyblue">メール</div>');
							// 追加
							$('.approach_hidden').attr('value', 'メール');
						break;
						case 1:
							// 追加
							$('.approach_setting_box').before('<div class="approach_setting_block box_color_deepskyblue">電話</div>');
							// 追加
							$('.approach_hidden').attr('value', '電話');
						break;
						case 2:
							// 追加
							$('.approach_setting_box').before('<div class="approach_setting_block box_color_deepskyblue">お問い合わせ</div>');
							// 追加
							$('.approach_hidden').attr('value', 'お問い合わせ');
						break;
						case 3:
							// 追加
							$('.approach_setting_box').before('<div class="approach_setting_block box_color_deepskyblue">紹介</div>');
							// 追加
							$('.approach_hidden').attr('value', '紹介');
						break;
						case 4:
							// 追加
							$('.approach_setting_box').before('<div class="approach_setting_block box_color_deepskyblue">イベント</div>');
							// 追加
							$('.approach_hidden').attr('value', 'イベント');
						break;
						case 5:
							// 追加
							$('.approach_setting_box').before('<div class="approach_setting_block box_color_deepskyblue">SNS</div>');
							// 追加
							$('.approach_hidden').attr('value', 'SNS');
						break;
						case 6:
							// 追加
							$('.approach_setting_box').before('<div class="approach_setting_block box_color_deepskyblue">飛び込み</div>');
							// 追加
							$('.approach_hidden').attr('value', '飛び込み');
						break;
						case 7:
							// 追加
							$('.approach_setting_box').before('<div class="approach_setting_block box_color_deepskyblue">手紙</div>');
							// 追加
							$('.approach_hidden').attr('value', '手紙');
						break;
						case 8:
							// 追加
							$('.approach_setting_box').before('<div class="approach_setting_block box_color_deepskyblue">FAX</div>');
							// 追加
							$('.approach_hidden').attr('value', 'FAX');
						break;









					}
					// それ以外を消す
					$(this).parent('ul').find('li').each(function(i) {
					// 同じ要素
					if(li_number == i) {

					}
						// 他の要素
						else {
							// チェック削除
							$(this).find('.lsf').remove();
							// チェックデータ変更
							$(this).attr('check-data', '0');
						}
					});
				}
			// イベントをここで止める
			event.stopPropagation();
		}
	}, 'li');









	//------------------------
	//クライアント表示・非表示
	//------------------------
	$('.sales_create').on( {
		'click' : function(event) {
			// クラス削除
			$('.client').removeClass('o_8');
			// 表示させる
			if($('.client_setting_box').attr('display-data') == 0) {
				$('.client_setting_box').css( {
					'display': 'block',
				});
				$('.client_setting_box').attr('display-data', '1');
				// 削除
				$('.client_setting_block').remove();
				// 削除
				$('.client_hidden').attr('value', '');
			}
				// 非表示にさせる
				else {
					$('.client_setting_box').css( {
						'display': 'none',
					});
					$('.client_setting_box').attr('display-data', '0');
					// クラス追加
					$('.client').addClass('o_8');
					// 追加
					$('.client_setting_box').before('<div class="client_setting_block box_color_deepskyblue">'+$('#input_client').val()+'</div>');
					// 追加
					$('.client_hidden').attr('value', $('#input_client').val());





				}
			// イベントをここで止める
			event.stopPropagation();
		}
	}, '.client');


	//------------------------
	//クライアントチェック挙動
	//------------------------
	$('.client_setting_box').on( {
		'click' : function(event) {
			// イベントをここで止める
			event.stopPropagation();
		}
	}, 'li');
	//----------------------------------
	//クライアントインプットエンター挙動
	//----------------------------------
	$('.sales_create').on( {
		'keydown': function(e) {
			if(e.keyCode === 13) {
				$('.client_setting_box').css( {
					'display': 'none',
				});
				$('.client_setting_box').attr('display-data', '0');
				// クラス追加
				$('.client').addClass('o_8');
				// 追加
				$('.client_setting_box').before('<div class="client_setting_block box_color_deepskyblue">'+$('#input_client').val()+'</div>');
				// 追加
				$('.client_hidden').attr('value', $('#input_client').val());
				return false;
			}
		}
	}, '#input_client');

















	//----------------------
	//アポイント表示・非表示
	//----------------------
	$('.sales_create').on( {
		'click' : function(event) {
			// クラス削除
			$('.appointment').removeClass('o_8');
			// 表示させる
			if($('.appointment_setting_box').attr('display-data') == 0) {
				$('.appointment_setting_box').css( {
					'display': 'block',
				});
				$('.appointment_setting_box').attr('display-data', '1');
				// 削除
				$('.appointment_setting_block').remove();
				// 削除
//				$('.appointment_hidden').attr('value', '');
			}
				// 非表示にさせる
				else {
					$('.appointment_setting_box').css( {
						'display': 'none',
					});
					$('.appointment_setting_box').attr('display-data', '0');
					// クラス追加
					$('.appointment').addClass('o_8');
					// 追加
					$('.appointment_setting_box').before('<div class="appointment_setting_block box_color_deepskyblue">'+$('.appointment_hidden').attr('value')+'</div>');
				}
			// イベントをここで止める
			event.stopPropagation();
		}
	}, '.appointment');


	//----------------------
	//アポイントボックス挙動
	//----------------------
	$('.appointment_setting_box').on( {
		'click' : function(event) {
			// イベントをここで止める
			event.stopPropagation();
		}
	}, 'li');
	//-----------------------
	//アポイントflatpickr挙動
	//-----------------------
	const config = {
		locale: "ja",              // 日本語を適応
		enableTime: true,          // タイムピッカーを有効
		noCalendar: false,         // カレンダーを非表示
		enableSeconds: false,      // '秒' を無効
		time_24hr: true,           // 24時間表示
		dateFormat: 'Y-m-d H:i:s', // 時間のフォーマット "時:分"
		altFormat: 'Y-m-d H:i:s',
	  // タイムピッカーのデフォルトタイム
	  // 下記の場合はタイムピッカーを開いた時に '9:00'で表示
	//	  defaultHour: 9, // 時
	//	  defaultMinute: 0, // 分
	  // defaultDate: '9:00' // 時間を予めセットする時の設定
		// 変更があった場合 発火
		onChange: function() {

		},
		// カレンダーが閉じた場合 発火
		onClose: function() {
			// Ajaxを走らせる
			$.ajax( {
				type: 'POST', 
				url: http+'ajax/sales/dateformat/',
				data: {
					selectedDates : this.selectedDates[0],
					format        : 'Y-m-d H:i',
				},
				dataType: 'json',
				cache: false,
				// Ajax完了後の挙動
			  success: function(data) {
					// 追加
					$('.appointment_hidden').attr('value', data['format_date']);
					// 追加
					$('.appointment_setting_box').before('<div class="appointment_setting_block box_color_deepskyblue">'+data['format_date']+'</div>');
					// 変更
					$('.appointment_setting_box').attr('display-data', 0);
					// 変更
					$('.appointment_setting_box').css( {
						'display' : 'none',
					});
			  },
			  error: function(data) {

			  },
			  complete: function(data) {

			  }
			}); // $.ajax(
		}, // onClose: function() {
	}
	///////////////////////////////////////////////////
	// flatpickr発火 後からでも変数にして色々取得できる
	///////////////////////////////////////////////////
	let appointment_day_fp = flatpickr('.appointment_day', config);
	//--------------------------------
	//アポイントインプットエンター挙動
	//--------------------------------
	$('.sales_create').on( {
		'keydown': function(e) {
			if(e.keyCode === 13) {
				return false;
			}
		}
	}, '#appointment_day');













	//-------------------
	//重要度表示・非表示
	//-------------------
	$('.sales_create').on( {
		'click' : function(event) {
			// クラス削除
			$('.importance').removeClass('o_8');
			// 表示させる
			if($('.importance_setting_box').attr('display-data') == 0) {
				$('.importance_setting_box').css( {
					'display': 'block',
				});
				$('.importance_setting_box').attr('display-data', '1');
			}
				// 非表示にさせる
				else {
					$('.importance_setting_box').css( {
						'display': 'none',
					});
					$('.importance_setting_box').attr('display-data', '0');
					// クラス追加
					$('.importance').addClass('o_8');
				}
			// イベントをここで止める
			event.stopPropagation();
		}
	}, '.importance');
	//------------------
	//重要度チェック挙動
	//------------------
	$('.importance_setting_box').on( {
		'click' : function(event) {
			/////////////////////////////
			// チェックをクリックして削除
			/////////////////////////////
			if($(this).attr('check-data') == 1) {
				// チェック削除
				$(this).find('.lsf').remove();
				// チェックデータ変更
				$(this).attr('check-data', '0');
				// 削除
				$('.importance_setting_block').remove();
				// 削除
				$('.importance_hidden').attr('value', '');
			}
				/////////////////////////////////////
				// チェックされていない要素をクリック
				/////////////////////////////////////
				else {
					// チェック追加
					$(this).prepend('<span class="lsf symbol">check</span>');
					// チェックデータ変更
					$(this).attr('check-data', '1');
					// 削除
					$('.importance_setting_block').remove();

					// liナンバー取得
					var li_number = $(this).parent('ul').find('li').index(this);
					switch(li_number) {
						case 0:
							// 追加
							$('.importance_setting_box').before('<div class="importance_setting_block"><span class="lsf symbol box_font_color_red">tag</span></div>');
							// 追加
							$('.importance_hidden').attr('value', 'red');
						break;
						case 1:
							// 追加
							$('.importance_setting_box').before('<div class="importance_setting_block"><span class="lsf symbol box_font_color_orange">tag</span></div>');
							// 追加
							$('.importance_hidden').attr('value', 'orange');
						break;
						case 2:
							// 追加
							$('.importance_setting_box').before('<div class="importance_setting_block"><span class="lsf symbol box_font_color_yellow">tag</span></div>');
							// 追加
							$('.importance_hidden').attr('value', 'yellow');
						break;
						case 3:
							// 追加
							$('.importance_setting_box').before('<div class="importance_setting_block"><span class="lsf symbol box_font_color_green">tag</span></div>');
							// 追加
							$('.importance_hidden').attr('value', 'green');
						break;
						case 4:
							// 追加
							$('.importance_setting_box').before('<div class="importance_setting_block"><span class="lsf symbol box_font_color_blue">tag</span></div>');
							// 追加
							$('.importance_hidden').attr('value', 'blue');
						break;
						case 5:
							// 追加
							$('.importance_setting_box').before('<div class="importance_setting_block"><span class="lsf symbol box_font_color_purple">tag</span></div>');
							// 追加
							$('.importance_hidden').attr('value', 'purple');
						break;
						case 6:
							// 追加
							$('.importance_setting_box').before('<div class="importance_setting_block"><span class="lsf symbol box_font_color_grey">tag</span></div>');
							// 追加
							$('.importance_hidden').attr('value', 'grey');
						break;
					}
					// それ以外を消す
					$(this).parent('ul').find('li').each(function(i) {
					// 同じ要素
					if(li_number == i) {

					}
						// 他の要素
						else {
							// チェック削除
							$(this).find('.lsf').remove();
							// チェックデータ変更
							$(this).attr('check-data', '0');
						}
					});
				}
			// イベントをここで止める
			event.stopPropagation();
		}
	}, 'li');










	//----------------
	//予算表示・非表示
	//----------------
	$('.sales_create').on( {
		'click' : function(event) {
			// クラス削除
			$('.budget').removeClass('o_8');
			// 表示させる
			if($('.budget_setting_box').attr('display-data') == 0) {
				$('.budget_setting_box').css( {
					'display': 'block',
				});
				$('.budget_setting_box').attr('display-data', '1');
				// 削除
				$('.budget_setting_block').remove();
				// 削除
				$('.budget_hidden').attr('value', '');
			}
				// 非表示にさせる
				else {
					$('.budget_setting_box').css( {
						'display': 'none',
					});
					$('.budget_setting_box').attr('display-data', '0');
					// クラス追加
					$('.budget').addClass('o_8');
					if($('#input_budget').val() > 1) {
						// 追加
						$('.budget_setting_box').before('<div class="budget_setting_block box_color_deepskyblue">'+$('#input_budget').val().replace(/(\d)(?=(\d\d\d)+$)/g, '$1,')+$('.money_type').attr('moneyType-data')+'</div>');
						// 追加
						$('.budget_hidden').attr('value', $('#input_budget').val());
					}
				}
			// イベントをここで止める
			event.stopPropagation();
		}
	}, '.budget');

	//----------------
	//予算チェック挙動
	//----------------
	$('.budget_setting_box').on( {
		'click' : function(event) {
			// イベントをここで止める
			event.stopPropagation();
		}
	}, 'li');
	//--------------------------
	//予算インプットエンター挙動
	//--------------------------
	$('.sales_create').on( {
		'keydown': function(e) {
			if(e.keyCode === 13) {
				$('.budget_setting_box').css( {
					'display': 'none',
				});
				$('.budget_setting_box').attr('display-data', '0');
				// クラス追加
				$('.budget').addClass('o_8');
				if($('#input_budget').val() > 1) {
					// 追加
					$('.budget_setting_box').before('<div class="budget_setting_block box_color_deepskyblue">'+$('#input_budget').val().replace(/(\d)(?=(\d\d\d)+$)/g, '$1,')+$('.money_type').attr('moneyType-data')+'</div>');
					// 追加
					$('.budget_hidden').attr('value', $('#input_budget').val());
				}
				return false;
			}
		}
	}, '#input_budget');









	//----------------
	//売上表示・非表示
	//----------------
	$('.sales_create').on( {
		'click' : function(event) {
			// クラス削除
			$('.earnings').removeClass('o_8');
			// 表示させる
			if($('.earnings_setting_box').attr('display-data') == 0) {
				$('.earnings_setting_box').css( {
					'display': 'block',
				});
				$('.earnings_setting_box').attr('display-data', '1');
				// 削除
				$('.earnings_setting_block').remove();
				// 削除
				$('.earnings_hidden').attr('value', '');
			}
				// 非表示にさせる
				else {
					$('.earnings_setting_box').css( {
						'display': 'none',
					});
					$('.earnings_setting_box').attr('display-data', '0');
					// クラス追加
					$('.earnings').addClass('o_8');
					if($('#input_earnings').val() > 1) {
						// 追加
						$('.earnings_setting_box').before('<div class="earnings_setting_block box_color_deepskyblue">'+$('#input_earnings').val().replace(/(\d)(?=(\d\d\d)+$)/g, '$1,')+$('.money_type').attr('moneyType-data')+'</div>');
						// 追加
						$('.earnings_hidden').attr('value', $('#input_earnings').val());
					}

				}
			// イベントをここで止める
			event.stopPropagation();
		}
	}, '.earnings');

	//----------------
	//売上チェック挙動
	//----------------
	$('.earnings_setting_box').on( {
		'click' : function(event) {
			// イベントをここで止める
			event.stopPropagation();
		}
	}, 'li');
	//--------------------------
	//売上インプットエンター挙動
	//--------------------------
	$('.sales_create').on( {
		'keydown': function(e) {
			if(e.keyCode === 13) {
				$('.earnings_setting_box').css( {
					'display': 'none',
				});
				$('.earnings_setting_box').attr('display-data', '0');
				// クラス追加
				$('.earnings').addClass('o_8');
				if($('#input_earnings').val() > 1) {
					// 追加
					$('.earnings_setting_box').before('<div class="earnings_setting_block box_color_deepskyblue">'+$('#input_earnings').val().replace(/(\d)(?=(\d\d\d)+$)/g, '$1,')+$('.money_type').attr('moneyType-data')+'</div>');
					// 追加
					$('.earnings_hidden').attr('value', $('#input_earnings').val());
				}
				return false;
			}
		}
	}, '#input_earnings');

























	//--------------------
	//締め切り表示・非表示
	//--------------------
	$('.sales_create').on( {
		'click' : function(event) {
			// クラス削除
			$('.deadline').removeClass('o_8');
			// 表示させる
			if($('.deadline_setting_box').attr('display-data') == 0) {
				$('.deadline_setting_box').css( {
					'display': 'block',
				});
				$('.deadline_setting_box').attr('display-data', '1');
				// 削除
				$('.deadline_setting_block').remove();
				// 削除
//				$('.deadline_hidden').attr('value', '');
			}
				// 非表示にさせる
				else {
					$('.deadline_setting_box').css( {
						'display': 'none',
					});
					$('.deadline_setting_box').attr('display-data', '0');
					// クラス追加
					$('.deadline').addClass('o_8');
					// 追加
					$('.deadline_setting_box').before('<div class="deadline_setting_block box_color_deepskyblue">'+$('.deadline_hidden').attr('value')+'</div>');
				}
			// イベントをここで止める
			event.stopPropagation();
		}
	}, '.deadline');

	//--------------------
	//締め切りボックス挙動
	//---------------------
	$('.deadline_setting_box').on( {
		'click' : function(event) {
			// イベントをここで止める
			event.stopPropagation();
		}
	}, 'li');
	//---------------------
	//締め切りflatpickr挙動
	//---------------------
	const config_1 = {
		locale: "ja",              // 日本語を適応
//		enableTime: true,          // タイムピッカーを有効
//		noCalendar: false,         // カレンダーを非表示
//		enableSeconds: false,      // '秒' を無効
//		time_24hr: true,           // 24時間表示
//		dateFormat: 'Y-m-d H:i:s', // 時間のフォーマット "時:分"
//		altFormat: 'Y-m-d H:i:s',
	  // タイムピッカーのデフォルトタイム
	  // 下記の場合はタイムピッカーを開いた時に '9:00'で表示
	//	  defaultHour: 9, // 時
	//	  defaultMinute: 0, // 分
	  // defaultDate: '9:00' // 時間を予めセットする時の設定
		// 変更があった場合 発火
		onChange: function() {

		},
		// カレンダーが閉じた場合 発火
		onClose: function() {
			// Ajaxを走らせる
			$.ajax( {
				type: 'POST', 
				url: http+'ajax/sales/dateformat/',
				data: {
					selectedDates : this.selectedDates[0],
					format        : 'Y-m-d',
				},
				dataType: 'json',
				cache: false,
				// Ajax完了後の挙動
			  success: function(data) {
					// 追加
					$('.deadline_hidden').attr('value', data['format_date']);
					// 追加
					$('.deadline_setting_box').before('<div class="deadline_setting_block box_color_deepskyblue">'+data['format_date']+'</div>');
					// 変更
					$('.deadline_setting_box').attr('display-data', 0);
					// 変更
					$('.deadline_setting_box').css( {
						'display' : 'none',
					});
			  },
			  error: function(data) {

			  },
			  complete: function(data) {

			  }
			}); // $.ajax(
		}, // onClose: function() {
	}
	///////////////////////////////////////////////////
	// flatpickr発火 後からでも変数にして色々取得できる
	///////////////////////////////////////////////////
	let deadline_day_fp = flatpickr('.deadline_day', config_1);
	//------------------------------
	//締め切りインプットエンター挙動
	//------------------------------
	$('.sales_create').on( {
		'keydown': function(e) {
			if(e.keyCode === 13) {
				return false;
			}
		}
	}, '#deadline_day');









	//------------------
	//ノート表示・非表示
	//------------------
	$('.sales_create').on( {
		'click' : function(event) {
			// クラス削除
			$('.note').removeClass('o_8');
			// 表示させる
			if($('.note_setting_box').attr('display-data') == 0) {
				$('.note_setting_box').css( {
					'display': 'block',
				});
				$('.note_setting_box').attr('display-data', '1');
				// 削除
				$('.note_setting_block').remove();
				// 削除
				$('.note_hidden').attr('value', '');
			}
				// 非表示にさせる
				else {
					$('.note_setting_box').css( {
						'display': 'none',
					});
					$('.note_setting_box').attr('display-data', '0');
					// クラス追加
					$('.note').addClass('o_8');
					// 追加
					$('.note_setting_box').before('<div class="note_setting_block box_color_deepskyblue">'+$('#input_note').val()+'</div>');
					// 追加
					$('.note_hidden').attr('value', $('#input_note').val());
				}
			// イベントをここで止める
			event.stopPropagation();
		}
	}, '.note');


	//------------------
	//ノートチェック挙動
	//------------------
	$('.note_setting_box').on( {
		'click' : function(event) {
			// イベントをここで止める
			event.stopPropagation();
		}
	}, 'li');
//----------------------------
//ノートインプットエンター挙動
//----------------------------
$('.sales_create').on( {
	'keydown': function(e) {
		if(e.keyCode === 13) {
			$('.note_setting_box').css( {
				'display': 'none',
			});
			$('.note_setting_box').attr('display-data', '0');
			// クラス追加
			$('.note').addClass('o_8');
			// 追加
			$('.note_setting_box').before('<div class="note_setting_block box_color_deepskyblue">'+$('#input_note').val()+'</div>');
			// 追加
			$('.note_hidden').attr('value', $('#input_note').val());
			return false;
		}
	}
}, '#input_note');
//----------------------------------------------
//セールスに進捗を追加するhtmlを取得して表示する
//----------------------------------------------
$('.sales').on( {
	'click': function() {
		var sales_url_id_data = $(this).attr('sales-url_id-data');
		$('.sales_create').css( {
			'display' : 'block',
		});
		$('.sales_fllow_add').css( {
			'display' : 'none',
		});



		$.ajax( {
			type: 'POST', 
			url: http+'ajax/sales/salesfllorwcreateget/',
			data: {
				sales_url_id : sales_url_id_data,
			},
			dataType: 'json',
			cache: false,
			// Ajax完了後の挙動
		  success: function(data) {
				$('.sales_fllow_add').after(data['sales_create_html']);
//				$(this).after(data['sales_create_html']);
		  },
		  error: function(data) {

		  },
		  complete: function(data) {

		  }
		}); // $.ajax(


	}
}, '.sales_fllow_add');







	$('.sales_form').on( {
		'click' : function() {
			p('dfsff');
		}
	}, '.approach');



	$('.sales_form').on( {
		'click' : function() {
			p('dfsff');
		}
	}, '.right');




























}); // $(function() {
