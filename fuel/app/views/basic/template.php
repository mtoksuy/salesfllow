<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $view_data["title"]; ?></title>
		<!-- meta -->
		<?php echo $view_data["meta"]; ?>
		<!-- icon -->
		<link rel="shortcut icon" href="<?php echo Uri::base(); ?>assets/img/icon/favicon_5.ico" type="image/vnd.microsoft.icon">
		<!-- css -->
		<link rel="stylesheet" href="<?php echo Uri::base(); ?>assets/css/general.css" type="text/css">
		<link rel="stylesheet" href="<?php echo Uri::base(); ?>assets/css/common.css" type="text/css">
		<link rel="stylesheet" href="<?php echo HTTP; ?>assets/css/library/typicons.2.0.7/font/typicons.css" type="text/css">
		<link rel="stylesheet" href="<?php echo Uri::base(); ?>assets/css/library/flickity.1.1.1/flickity.css" type="text/css" media="screen">
		<link rel="stylesheet" href="<?php echo Uri::base(); ?>assets/js/library/flexslider.2/flexslider.css" type="text/css" media="screen">
		<!-- import_css -->
		<?php echo $view_data["import_css"]; ?>
		<!-- icon -->
		<link rel="apple-touch-icon" href="<?php echo Uri::base(); ?>assets/img/icon/apple_touch_icon_1.png" />
		<link rel="apple-touch-icon-precomposed" href="<?php echo Uri::base(); ?>assets/img/icon/apple_touch_icon_1.png" />
	</head>
	<body>
		<!-- wrapper -->
		<div class="wrapper">
			<!-- header -->
			<?php echo $view_data["header"]; ?>
			<!-- drawer -->
			<?php echo $view_data["drawer"]; ?>
			<!-- main -->
			<div class="main clearfix">
				<!-- main_inner -->
				<div class="main_inner clearfix">
					<?php echo $view_data["content"]; ?>
				</div>
				<!-- sidebar -->
				<div class="sidebar">
					<?php echo $view_data["sidebar"]; ?>
				</div>
			</div>
			<!-- footer -->
			<?php echo $view_data["footer"]; ?>
			<?php echo $view_data["script"]; ?>
		</div>
	</body>
</html>
