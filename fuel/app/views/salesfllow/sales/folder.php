
<div class="folder">
	<div class="folder_inner">
<?php
// 本番はこっち
//	echo $content_data['folder_html'];
?>

<!--
・ul内のliにある primary_id-data を集めてリスト表示
・
参照array
	  ['primary_id' => 1, 'name' => 'ノート_1_1_1', 'path' => '.1.', 'level' => 1, 'parent' => null, 'child' => [2]],
	  ['primary_id' => 2, 'name' => '箱の中', 'path' => '.1.2.', 'level' => 2, 'parent' => 1, 'child' => [3]],
	  ['primary_id' => 3, 'name' => '3段目', 'path' => '.1.2.3.', 'level' => 3, 'parent' => 2, 'child' => []],
-->


		<ul level-data="1">
			<li primary_id-data="1" path-data=".1.">
				<a href=""><img class="allow" src="http://localhost/salesfllow/assets/img/common/function_alow_side_1.png">ノート</a>
				<ul class="hidden" level-data="2">
					<li primary_id-data="2" path-data=".1.2.">
						<a href=""><img class="allow" src="http://localhost/salesfllow/assets/img/common/function_alow_side_1.png">箱の中</a>
						<ul class="hidden" level-data="3">
							<li primary_id-data="3" path-data=".1.2.3.">
								<a href="">3段目</a>
							</li>
						</ul>
					</li>
				</ul>
			</li>
		</ul>
		<ul level-data="1">
			<li primary_id-data="4" path-data=".4.">
				<a href=""><img class="allow" src="http://localhost/salesfllow/assets/img/common/function_alow_side_1.png">下のノート</a>
				<ul class="hidden" level-data="2">
					<li primary_id-data="5" path-data=".4.5.">
						<a href=""><img class="allow" src="http://localhost/salesfllow/assets/img/common/function_alow_side_1.png">下の箱の中</a>
						<ul class="hidden" level-data="3">
							<li primary_id-data="6" path-data=".4.5.6.">
								<a href="">下の3段目</a>
							</li>
						</ul>
					</li>
				</ul>
			</li>
		</ul>






	</div>
</div>
