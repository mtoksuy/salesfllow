
<!-- sales_list -->
<div class="sales_list">
	<div class="sales_list_inner">
		<ul class="header">
			<li class="no_border"> 
				<nav class="search_window">
					<input placeholder="リストを検索" value="" name="sales" id="sales" type="text">
				</nav>
			</li>
			<li class="float"><div class="sales_submit o_8">案件作成</div></li>
		</ul>
		<?php echo $content_data['sales_list_html']; ?>
	</div>
</div> <!-- sales_list -->



<!-- sales_create -->
<div class="sales_create">
	<div class="sales_create_inner">
		<div class="left">
			<img src="<?php echo HTTP; ?>assets/img/user/icon/default_1.png" alt="松岡 宗谷" title="松岡 宗谷" width="48" height="48">
		</div>
		<div class="right">
			<form method="post" action="<?php echo HTTP; ?>sales/" class="sales_form">
				<input placeholder="案件名" value="" name="title" id="title" type="text">
	
				<div class="sales_settings o_8">
					<span class="parts">ステータス</span>
					<span class="lsf symbol">setting</span>
				</div>
	
				<div class="sales_settings o_8">
					<span class="parts">アプローチ</span>
					<span class="lsf symbol">setting</span>
				</div>
	
	
				<div class="sales_settings o_8">
					<span class="parts">クライアント</span>
					<span class="lsf symbol">setting</span>
				</div>
	
				<div class="sales_settings o_8">
					<span class="parts">アポ</span>
					<span class="lsf symbol">setting</span>
				</div>
	
				<div class="sales_settings o_8">
					<span class="parts">タグ</span>
					<span class="lsf symbol">setting</span>
				</div>
	
				<div class="sales_settings o_8">
					<span class="parts">予算</span>
					<span class="lsf symbol">setting</span>
				</div>
	
				<div class="sales_settings o_8">
					<span class="parts">売上</span>
					<span class="lsf symbol">setting</span>
				</div>
	
				<div class="sales_settings o_8">
					<span class="parts">締切日</span>
					<span class="lsf symbol">setting</span>
				</div>
	
				<textarea name="text" id="text" placeholder="詳細"></textarea>
				<input class="o_8" value="作成" name="submit" type="submit">
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
-->







