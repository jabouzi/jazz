<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><?php echo $page_title; ?></title>
		<meta name="description" content="description">
		<meta name="author" content="DevOOPS">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="/jazz/assets/plugins/bootstrap/bootstrap.css" rel="stylesheet">
		<link href="/jazz/assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
		<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>
		<link href="/jazz/assets/plugins/fancybox/jquery.fancybox.css" rel="stylesheet">
		<link href="/jazz/assets/plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
		<link href="/jazz/assets/plugins/xcharts/xcharts.min.css" rel="stylesheet">
		<link href="/jazz/assets/plugins/select2/select2.css" rel="stylesheet">
		<link href="/jazz/assets/css/style.css" rel="stylesheet">
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
				<script src="http://getbootstrap.com/docs-assets/js/html5shiv.js"></script>
				<script src="http://getbootstrap.com/docs-assets/js/respond.min.js"></script>
		<![endif]-->
	</head>
<body>
<!--Start Header-->
<div id="screensaver">
	<canvas id="canvas"></canvas>
	<i class="fa fa-lock" id="screen_unlock"></i>
</div>
<div id="modalbox">
	<div class="devoops-modal">
		<div class="devoops-modal-header">
			<div class="modal-header-name">
				<span>Basic table</span>
			</div>
			<div class="box-icons">
				<a class="close-link">
					<i class="fa fa-times"></i>
				</a>
			</div>
		</div>
		<div class="devoops-modal-inner">
		</div>
		<div class="devoops-modal-bottom">
		</div>
	</div>
</div>
<header class="navbar">
	<div class="container-fluid expanded-panel">
		<div class="row">
			<div id="logo" class="col-xs-12 col-sm-2">
				<a href="index.html"><?php echo $this->session->userdata('user_firstname'); ?> <?php echo $this->session->userdata('user_lastname'); ?></a>
			</div>
			<div id="top-panel" class="col-xs-12 col-sm-10">
				<div class="row">
					<div class="col-xs-8 col-sm-4">
						<a href="#" class="show-sidebar">
						  <i class="fa fa-bars"></i>
						</a>
						<div id="search">
							<input type="text" placeholder="search"/>
							<i class="fa fa-search"></i>
						</div>
					</div>
					<div class="col-xs-4 col-sm-8 top-panel-right">
						<div class="user-mini pull-right">
							<span><?php echo form_dropdown('lang', $languages, $lang, $redirect); ?></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
<!--End Header-->
<!--Start Container-->
<div id="main" class="container-fluid">
	<div class="row">
		<div id="sidebar-left" class="col-xs-2 col-sm-2">
			<ul class="nav main-menu">
				<li>
					<a href="<?php echo site_url('dashboard'); ?>" class="active ajax-link">
						<i class="fa fa-dashboard"></i>
						<span class="hidden-xs"><?php echo lang('dashboard.title3'); ?></span>
					</a>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle">
						<i class="fa fa-bar-chart-o"></i>
						<span class="hidden-xs"><?php echo lang('content.title'); ?></span>
					</a>
					<ul class="dropdown-menu">
						<li><a class="ajax-link" href="ajax/charts_xcharts.html">xCharts</a></li>
						<li><a class="ajax-link" href="ajax/charts_flot.html">Flot Charts</a></li>
						<li><a class="ajax-link" href="ajax/charts_google.html">Google Charts</a></li>
						<li><a class="ajax-link" href="ajax/charts_morris.html">Morris Charts</a></li>
						<li><a class="ajax-link" href="ajax/charts_coindesk.html">CoinDesk realtime</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle">
						<i class="fa fa-table"></i>
						 <span class="hidden-xs"><?php echo lang('user.title'); ?></span>
					</a>
					<ul class="dropdown-menu">
						<li><a class="ajax-link" href="ajax/tables_simple.html">Simple Tables</a></li>
						<li><a class="ajax-link" href="ajax/tables_datatables.html">Data Tables</a></li>
						<li><a class="ajax-link" href="ajax/tables_beauty.html">Beauty Tables</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle">
						<i class="fa fa-pencil-square-o"></i>
						 <span class="hidden-xs"><?php echo lang('admin.title'); ?></span>
					</a>
					<ul class="dropdown-menu">
						<li><a class="ajax-link" href="ajax/forms_elements.html">Elements</a></li>
						<li><a class="ajax-link" href="ajax/forms_layouts.html">Layouts</a></li>
						<li><a class="ajax-link" href="ajax/forms_file_uploader.html">File Uploader</a></li>
					</ul>
				</li>
			</ul>
		</div>
		<!--Start Content-->
		<div id="content" class="col-xs-12 col-sm-10">
			<!--Start Breadcrumb-->
			<div class="row">
				<div id="breadcrumb" class="col-xs-12">
					<ol class="breadcrumb">
						<li><a href="index.html"><?php echo anchor('dashboard', lang('dashboard.title2')); ?></a></li>
						<li><a href="#"><?php echo $page_title; ?></a></li>
					</ol>
				</div>
			</div>
			<!--End Breadcrumb-->
			<?php 
				$display_info = 'style="display:none"';
				$display_warning = 'style="display:none"';
				$display_error = 'style="display:none"';
				$display_success = 'style="display:none"';
				if ($info_message) $display_info = '';
				if ($warning_message) $display_warning = '';
				if ($error_message) $display_error = '';
				if ($success_message) $display_success = ''; 
			?>
	
			<h4 <?php echo $display_info; ?> class="alert_info"><?php echo $info_message; ?></h4>
			<h4 <?php echo $display_warning; ?> class="alert_warning"><?php echo $warning_message; ?></h4>
			<h4 <?php echo $display_error; ?> class="alert_error"><?php echo $error_message; ?></h4>
			<h4 <?php echo $display_success; ?> class="alert_success"><?php echo $success_message; ?></h4>
	
			<?php 
				var_dump($this->session->all_userdata(), $languages, $this->lang->lang());
				foreach($admin_widgets as $widget => $content)
				{
					echo $content;
				}
			?>
		</div>
		<!--End Content-->
	</div>
</div>
<!--End Container-->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!--<script src="http://code.jquery.com/jquery.js"></script>-->
<script src="/jazz/assets/plugins/jquery/jquery-2.1.0.min.js"></script>
<script src="/jazz/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/jazz/assets/plugins/bootstrap/bootstrap.min.js"></script>
<script src="/jazz/assets/plugins/justified-gallery/jquery.justifiedgallery.min.js"></script>
<script src="/jazz/assets/plugins/tinymce/tinymce.min.js"></script>
<script src="/jazz/assets/plugins/tinymce/jquery.tinymce.min.js"></script>
<!-- All functions for this theme + document.ready processing -->
<script src="/jazz/assets/js/devoops.js"></script>
</body>
</html>
