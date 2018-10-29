<?php
/*
* Ajax セールス セールスフロー作成取得 コントローラー
* 
* 
* 
*/
class Controller_Ajax_Sales_Salesfllorwcreateget extends Controller {
	// アクション
	public function action_index() {
		// ポストの中身をエンティティ化する
		$post = Model_Security_Basis::post_security($_POST);


$sales_create_html= 

'<!-- sales_create -->
<div class="sales_create clearfix">
	<div class="sales_create_inner">
		<div class="left">
			<img src="'.HTTP.'assets/img/user/icon/default_1.png" alt="" title="" width="48" height="48">
		</div>
		<div class="right">
			<form method="post" action="'.HTTP.'sales/" class="sales_form">
				<input placeholder="案件名" value="" name="title" id="title" type="text">
				<!-- setting_top -->
				<div class="setting_top">
					<!-- sales_settings -->
					<div class="sales_settings o_8 status">
						<span class="parts">ステータス</span>
						<span class="lsf symbol">setting</span>
						<input class="status_hidden" type="hidden" name="status" value="">
						<!-- status_setting_block -->
<!--
						<div class="status_setting_block status_setting_block_red">交渉中</div>
-->
						<!-- status_setting_box -->
						<div class="status_setting_box" display-data="0">
							<div class="status_setting_box_inner">
								<ul>
									<li check-data="0"><span class="box_color box_color_red"> </span>交渉中</li>
									<li check-data="0"><span class="box_color box_color_limegreen"> </span>成約</li>
									<li check-data="0"><span class="box_color box_color_grey"> </span>破談</li>
									<li check-data="0"><span class="box_color box_color_deepskyblue"> </span>検討</li>
								</ul>
							</div>
						</div> <!-- status_setting_box -->
					</div> <!-- sales_settings -->





					<!-- sales_settings -->
					<div class="sales_settings o_8 approach">
						<span class="parts">アプローチ</span>
						<span class="lsf symbol">setting</span>
						<input class="approach_hidden" type="hidden" name="approach" value="">
						<!-- approach_setting_block -->
<!--
						<div class="approach_setting_block approach_setting_block_red">交渉中</div>
-->
						<!-- approach_setting_box -->
						<div class="approach_setting_box" display-data="0">
							<div class="approach_setting_box_inner">
								<ul>
									<li check-data="0"><span class="box_color box_color_deepskyblue"> </span>メール</li>
									<li check-data="0"><span class="box_color box_color_deepskyblue"> </span>電話</li>
									<li check-data="0"><span class="box_color box_color_deepskyblue"> </span>お問い合わせ</li>
									<li check-data="0"><span class="box_color box_color_deepskyblue"> </span>紹介</li>
									<li check-data="0"><span class="box_color box_color_deepskyblue"> </span>イベント</li>
									<li check-data="0"><span class="box_color box_color_deepskyblue"> </span>SNS</li>
									<li check-data="0"><span class="box_color box_color_deepskyblue"> </span>飛び込み</li>
									<li check-data="0"><span class="box_color box_color_deepskyblue"> </span>手紙</li>
									<li check-data="0"><span class="box_color box_color_deepskyblue"> </span>FAX</li>
								</ul>
							</div>
						</div> <!-- approach_setting_box -->
					</div> <!-- sales_settings -->
		













		





					<div class="sales_settings o_8 appointment">
						<span class="parts">アポ</span>
						<span class="lsf symbol">setting</span>
						<input class="appointment_hidden" type="hidden" name="appointment" value="">
						<!-- appointment_setting_block -->
<!--
						<div class="appointment_setting_block appointment_setting_block_red">交渉中</div>
-->
						<!-- appointment_setting_box -->
						<div class="appointment_setting_box" display-data="0">
							<div class="appointment_setting_box_inner">
								<ul>
									<li><input class="appointment_day" id="appointment_day" type="text" name="appointment_day" placeholder="日付と時間" value=""></li>
								</ul>
							</div>
						</div> <!-- appointment_setting_box -->
					</div>
				</div> <!-- setting_top -->



				<!-- setting_bottom -->
				<div class="setting_bottom">
					<div class="sales_settings o_8 importance">
						<span class="parts">重要度</span>
						<span class="lsf symbol">setting</span>
						<input class="importance_hidden" type="hidden" name="importance" value="">
						<!-- importance_setting_block -->
<!--
						<div class="importance_setting_block importance_setting_block_red">交渉中</div>
-->
						<!-- importance_setting_box -->
						<div class="importance_setting_box" display-data="0">
							<div class="importance_setting_box_inner">
								<ul>
									<li check-data="0"><span class="box_color box_color_red"> </span>レッド</li>
									<li check-data="0"><span class="box_color box_color_orange"> </span>オレンジ</li>
									<li check-data="0"><span class="box_color box_color_yellow"> </span>イエロー</li>
									<li check-data="0"><span class="box_color box_color_green"> </span>グリーン</li>
									<li check-data="0"><span class="box_color box_color_blue"> </span>ブルー</li>
									<li check-data="0"><span class="box_color box_color_purple"> </span>パープル</li>
									<li check-data="0"><span class="box_color box_color_grey"> </span>グレー</li>
								</ul>
							</div>
						</div> <!-- importance_setting_box -->
					</div> <!-- sales_settings -->


















					<div class="sales_settings o_8 budget">
						<span class="parts">予算</span>
						<span class="lsf symbol">setting</span>
						<input class="budget_hidden" type="hidden" name="budget" value="">
						<!-- budget_setting_block -->
<!--
						<div class="budget_setting_block budget_setting_block_red">交渉中</div>
-->
						<!-- budget_setting_box -->
						<div class="budget_setting_box" display-data="0">
							<div class="budget_setting_box_inner">
								<ul>
									<li><input placeholder="予算" value="" name="input_budget" id="input_budget" type="text"><span class="money_type" moneyType-data="円">円</span></li>
								</ul>
							</div>
						</div> <!-- budget_setting_box -->
					</div>
		







					<div class="sales_settings o_8 earnings">
						<span class="parts">売上</span>
						<span class="lsf symbol">setting</span>
						<input class="earnings_hidden" type="hidden" name="earnings" value="">
						<!-- earnings_setting_block -->
<!--
						<div class="earnings_setting_block earnings_setting_block_red">交渉中</div>
-->
						<!-- earnings_setting_box -->
						<div class="earnings_setting_box" display-data="0">
							<div class="earnings_setting_box_inner">
								<ul>
									<li><input placeholder="売上" value="" name="input_earnings" id="input_earnings" type="text"><span class="money_type" moneyType-data="円">円</span></li>
								</ul>
							</div>
						</div> <!-- earnings_setting_box -->





					</div>
		












					<div class="sales_settings o_8 deadline">
						<span class="parts">締切日</span>
						<span class="lsf symbol">setting</span>
						<input class="deadline_hidden" type="hidden" name="deadline" value="">
						<!-- deadline_setting_block -->
<!--
						<div class="deadline_setting_block deadline_setting_block_red">交渉中</div>
-->
						<!-- deadline_setting_box -->
						<div class="deadline_setting_box" display-data="0">
							<div class="deadline_setting_box_inner">
								<ul>
									<li><input class="deadline_day" id="deadline_day" type="text" name="deadline_day" placeholder="日付" value=""></li>
								</ul>
							</div>
						</div> <!-- deadline_setting_box -->
					</div>
				</div>





					<div class="sales_settings o_8 client">
						<span class="parts">クライアント</span>
						<span class="lsf symbol">setting</span>
						<input class="client_hidden" type="hidden" name="client" value="">
						<!-- client_setting_block -->
<!--
						<div class="client_setting_block client_setting_block_red">交渉中</div>
-->
						<!-- client_setting_box -->
						<div class="client_setting_box" display-data="0">
							<div class="client_setting_box_inner">
								<ul>
									<li><input placeholder="クライアント名" value="" name="input_client" id="input_client" type="text"></li>
								</ul>
							</div>
						</div> <!-- client_setting_box -->
					</div>















				<textarea name="text" id="text" placeholder="詳細"></textarea>


		
					<div class="sales_settings o_8 note">
						<span class="parts">ノート</span>
						<span class="lsf symbol">setting</span>
						<input class="note_hidden" type="hidden" name="note" value="">
						<!-- note_setting_block -->
<!--
						<div class="note_setting_block note_setting_block_red">交渉中</div>
-->
						<!-- note_setting_box -->
						<div class="note_setting_box" display-data="0">
							<div class="note_setting_box_inner">
								<ul>
									<li><input placeholder="ノート名  例：株式会社スペースナビ/営業中" value="" name="input_note" id="input_note" type="text"></li>
								</ul>
							</div>
						</div> <!-- note_setting_box -->




					</div>




				<input class="o_8 submit" value="作成" name="submit" type="submit">
			</form>
		</div>
	</div>
</div> <!-- sales_create -->




<!--
status
client
Appointment
tag
budget
proceed
deadline
2. ステータスを付けれる(営業中なのか、案件作成中なのか)
4. タグ付け
3. 締切日登録
名刺カルテ
-->';



		header ("Content-Type: text/javascript; charset=utf-8");
		$json_data = array(
			'POST'              => $post,
			'sales_create_html' => $sales_create_html,
		);
		return json_encode($json_data);
	}
}