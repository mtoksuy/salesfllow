
			<!-- jQueryプラグイン -->
			<script type="text/javascript" src="<?php echo HTTP; ?>assets/js/library/jquery-1.9.1-min.js"></script>
			<!-- flatpickrプラグイン -->
			<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
			<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ja.js"></script>
			<!-- 日本語の言語ファイル -->
			<script src="//unpkg.com/flatpickr/dist/l10n/ja.js"></script>
			<!-- ジェネラルプラグイン -->
			<script type="text/javascript" src="<?php echo HTTP; ?>assets/js/general.js"></script>
			<!-- 自作プラグイン -->
			<script type="text/javascript" src="<?php echo HTTP; ?>assets/js/salesfllow/common.js"></script>
			<script type="text/javascript" src="<?php echo HTTP; ?>assets/js/salesfllow/sales/common.js"></script>

			<!-- 自作プラグイン -->
			<script type="text/javascript" src="<?php echo HTTP; ?>assets/js/salesfllow/sales/folder.js"></script>

			<?php 
			if($_SERVER["HTTP_HOST"] == "localhost") {
				
			}
				else {?>
					<!-- アナリティクス -->

				<?php 
				} ?>
