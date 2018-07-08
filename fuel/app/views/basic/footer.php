
			<!-- footer -->
			<footer class="footer clear">
				<!-- footer_contents -->
				<div class="footer_contents clearfix">


					<!-- Page Plugin -->
<!--
					<div class="facebook_page_plugin">
						<div class="fb-page" data-href="https://www.facebook.com/sharetube.jp/" data-width="500" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"></div>
					</div>
-->


					<!-- like box -->
<!--
					<div class="face_book_plgin_shadow_hidden"> </div>
					<section class="face_book_plgin">
						<div class="fb-like-box" data-href="http://www.facebook.com/pages/Sharetube/621756284545794" data-width="768" data-height="243" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>
						<div class="face_book_plgin_border_top"> </div>
						<div class="face_book_plgin_border_right"> </div>
						<div class="face_book_plgin_border_bottom"> </div>
						<div class="face_book_plgin_border_left"> </div>
					</section>
-->

					<!-- likeボタン -->
<!--
					<div class="fb-like" data-href="https://www.facebook.com/sharetube.jp/" data-layout="button" data-action="like" data-show-faces="false" data-share="false"></div>
-->


					<!--  -->
					<div class="footer_contents_box clearfix">
						<h5>Sharetubeについて</h5>
						<ul>
							<li><a href="<?php echo HTTP; ?>about/">Sharetubeについて</a></li>
							<li><a href="<?php echo HTTP; ?>contact/">お問い合わせ</a></li>
							<li><a href="<?php echo HTTP; ?>rule/rule/">利用規約</a></li>
							<li><a href="<?php echo HTTP; ?>help/">Sharetubeヘルプセンター</a></li>


<!--

							<li><a href="<?php echo HTTP; ?>signup/">まとめ作成</a></li>
							<li><a href="<?php echo HTTP; ?>signup/">Sharetubeアカウント作成</a></li>
							<li><a href="<?php echo HTTP; ?>login/" target="_blank">ログイン</a></li>
							<li><a href="<?php echo HTTP; ?>curatorlist/">キュレーターリスト</a></li>
							<li><a href="<?php echo HTTP; ?>curatorrecruitment/">キュレーター募集</a></li>
							<li><a href="<?php echo HTTP; ?>curatorrecruitment/lp/">業界NO.1のインセンティブ報酬</a></li>
-->



<!--
							<li><a href="<?php echo HTTP; ?>permalink/recruitment_ads.php">広告掲載について</a></li>
-->



							<li><a href="<?php echo HTTP; ?>assets/pdf/sharetube_document_9.pdf" target="_blank">広告掲載について</a></li>



<!--
							<li><a href="<?php echo HTTP; ?>permalink/ch_thread_design_1.php">2ちゃんねるスレッドテキストベースまとめツール Var.1.00</a></li>
-->
						</ul>
					</div> <!--  -->


					<!--  -->
					<div class="footer_contents_box clearfix">
						<h5>新着・殿堂・過去まとめについて</h5>
						<ul>
					  	<li><a href="<?php echo HTTP ?>newarticle/">新着まとめ</a></li>
					  	<li><a href="<?php echo HTTP ?>famearticle/">殿堂まとめ</a></li>
					  	<li><a href="<?php echo HTTP ?>archive/">アーカイブ</a></li>
						</ul>
						<ul>
<!--
							<li>2014年05月</li>
							<li>2014年04月</li>
							<li>2014年03月</li>
							<li>2014年02月</li>
							<li>2014年01月</li>
-->
						<?php echo $footer_data["archive_html"]; ?>

						</ul>
					</div> <!--  -->
					<!--  -->
					<div class="footer_contents_box clearfix">
						<h5>Sharetubeをフォローする</h5>
						<ul>
					  	<li><a href="https://www.facebook.com/sharetube.jp/" target="_blank">Facebook</a></li>
					  	<li><a href="https://twitter.com/Sharetube_jp" target="_blank">Twitter</a></li>
					  	<li><a href="https://plus.google.com/+SharetubeJp0480" target="_blank">Google+</a></li>
					  	<li><a href="<?php echo HTTP ?>feed.xml">RSS配信</a></li>
					  	<li><a target="blank" href="http://cloud.feedly.com/#subscription%2Ffeed%2Fhttp%3A%2F%2Fsharetube.jp%2Ffeed.xml">Feedlyで購読</a></li>
						</ul>
					</div> <!--  -->


				</div> <!-- footer_contents -->
				<!-- footer_bottom -->
				<div class="footer_bottom">
					<div class="footer_bottom_contents">
						<!-- コピーライト -->
						<section id="copy">
							<p class="m_0">&copy; <?php echo date('Y'); ?> <a href="<?php echo Uri::base(); ?>">Sharetube</a></p>
						</section>
						<!--  -->
						<div class="footer_bottom_contents_outer">
								<div class="footer_bottom_contents_logo"></div>
						</div>
					</div>
				</div>
			</footer>  <!-- footer -->
