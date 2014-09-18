<!doctype html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/bootstrap-responsive.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/plugins/jquery-ui/smoothness/jquery-ui.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/plugins/jquery-ui/smoothness/jquery.ui.theme.css" />
	
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/plugins/icheck/all.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/style.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/themes.css" />
	
	<!-- javascript -->
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/jquery.min.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/plugins/validation/additional-methods.min.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/plugins/nicescroll/jquery.nicescroll.min.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/plugins/jquery-ui/jquery.ui.core.min.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/plugins/jquery-ui/jquery.ui.widget.min.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/plugins/jquery-ui/jquery.ui.mouse.min.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/plugins/jquery-ui/jquery.ui.draggable.min.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/plugins/jquery-ui/jquery.ui.resizable.min.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/plugins/jquery-ui/jquery.ui.sortable.min.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/plugins/jquery-ui/jquery.ui.datepicker.min.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/plugins/touch-punch/jquery.touch-punch.min.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/bootstrap.min.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/plugins/bootbox/jquery.bootbox.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/plugins/imagesLoaded/jquery.imagesloaded.min.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/plugins/pageguide/jquery.pageguide.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/plugins/chosen/chosen.jquery.min.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/plugins/select2/select2.min.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/plugins/icheck/jquery.icheck.min.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/eakroko.min.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/application.min.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/demonstration.min.js"></script>
	
	<title><?php echo CHtml::encode($this->headerTitle); ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	
	<!-- Favicon -->
	<link rel="shortcut icon" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/favicon.ico" />
	<!-- Apple devices Homescreen icon -->
	<link rel="apple-touch-icon-precomposed" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/apple-touch-icon-precomposed.png" />
</head>

<body class='login'>
	<div class="wrapper">
		<h1><a href="index.html"><img src="<?php echo Yii::app()->theme->baseUrl . '/assets/img/logo-big.png';?>" alt="" class='retina-ready' width="59" height="49">
			<?php echo Yii::app()->params['SITE_NAME_CAP'];?>
		</a></h1>
		<div class="login-body" id="login-body">
			<?php echo $content; ?>
		</div>
	</div>
</body>

</html>
