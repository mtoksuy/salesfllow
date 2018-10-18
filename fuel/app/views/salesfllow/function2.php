<!--
<div class="function">
	<div class="function_inner">
		<ul>
			<li class="<?php echo $content_data['dash_bord_now']; ?>"><a href="<?php echo HTTP; ?>">ダッシュボード</a></li>
			<li class="<?php echo $content_data['sales_now']; ?>"><a href="<?php echo HTTP; ?>sales/">案件</a></li>
			<li class="<?php echo $content_data['schedule_now']; ?>"><a href="<?php echo HTTP; ?>schedule/">スケジュール</a></li>
			<li class="<?php echo $content_data['client_now']; ?>"><a href="<?php echo HTTP; ?>client/">クライアント</a></li>
			<li class="<?php echo $content_data['analysis_now']; ?>"><a href="<?php echo HTTP; ?>analysis/">分析</a></li>
			<li class="<?php echo $content_data['card_now']; ?>"><a href="<?php echo HTTP; ?>card/">名刺</a></li>
			<li class="<?php echo $content_data['dailyreport_now']; ?>"><a href="<?php echo HTTP; ?>dailyreport">日報</a></li>
	</ul>	
	</div>
</div>
-->

<!--
#### ログイン後
* トップページがトップページ
* ユーザーページ xxx/
* 案件ページ xxx/sales/xxx/
* 会社ページ company/xxx/
* 部署ページ company/xxx/unit/xxx/
* スケジュールページ xxx/schedule/xxx/
* スケジュールページ company/xxx/schedule/xxx/
* スケジュールページ company/xxx/unit/xxx/schedule/xxx/
-->


<div class="function">
	<div class="function_inner">
<?php
//	echo $content_data['function_html'];
?>

<!--
・ul内のliにある primary_id-data を集めてリスト表示
・
参照array
	  ['primary_id' => 1, 'name' => 'ノート_1_1_1', 'path' => '.1.', 'level' => 1, 'parent' => null, 'child' => [2]],
	  ['primary_id' => 2, 'name' => '箱の中', 'path' => '.1.2.', 'level' => 2, 'parent' => 1, 'child' => [3]],
	  ['primary_id' => 3, 'name' => '3段目', 'path' => '.1.2.3.', 'level' => 3, 'parent' => 2, 'child' => []],
-->


		<ul>
			<li primary_id-data="1" path-data=".1.">
				<a href="">ノート</a>
				<ul class="hidden">
					<li primary_id-data="2" path-data=".1.2.">
						<a href="">箱の中</a>
						<ul class="hidden">
							<li primary_id-data="3" path-data=".1.2.3.">
								<a href="">3段目</a>
							</li>
						</ul>
					</li>
				</ul>
			</li>
		</ul>







	</div>
</div>






















<!--
<div class="function">
	<div class="function_inner">
		<ul>
			<li class="<?php echo $content_data['dash_bord_now']; ?>"><a href="">ノート</a>
				<ul>
					<li><a href="">ノートボヨヨーン</a></li>
					<li><a href="">ボヨヨーンです</a>
						<ul>
							<li><a href="">第3ノート</a></li>
						</ul>
					</li>
				</ul>
			</li>
			<li class="<?php echo $content_data['sales_now']; ?>"><a href="">第2ノート</a>
				<ul>
					<li><a href="">第2ノートボヨヨーン</a></li>
				</ul>
			</li>
	</ul>	
	</div>
</div>

-->

















