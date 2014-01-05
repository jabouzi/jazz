<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title><?php echo $page_title; ?> - <?php echo lang('dashboard.title1'); ?></title>
	
	<link rel="stylesheet" href="/tonic/assets/css/bootstrap-3.0.0.min.css" type="text/css">
	<link rel="stylesheet" href="/tonic/assets/css/bootstrap-multiselect.css" type="text/css">
	<link rel="stylesheet" href="/tonic/assets/css/admin.css" type="text/css" media="screen" />
	<!--[if lt IE 9]>
	<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script src="/tonic/assets/js/jquery.min.js" type="text/javascript"></script>
	<script src="/tonic/assets/js/jquery-ui.min.js" type="text/javascript"></script>
	<script src="/tonic/assets/js/hideshow.js" type="text/javascript"></script>
	<script src="/tonic/assets/js/jquery.tablesorter.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="/tonic/assets/js/jquery.equalHeight.js"></script>
	<script type="text/javascript" src="/tonic/assets/js/bootstrap-3.0.0.min.js"></script>
	<script type="text/javascript" src="/tonic/assets/js/bootstrap-multiselect.js"></script>
	<script type="text/javascript" src="/tonic/assets/js/tonic.js"></script>
	<script type="text/javascript">
	$(document).ready(function() 
		{ 
			$(".tablesorter").tablesorter(); 
		} 
	);
	$(document).ready(function() {

	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});

});
	</script>
	<script type="text/javascript">
	$(function(){
		$('.column').equalHeight();
	});
</script>

</head>


<body>

	<header id="header">
		<hgroup>
			<h1 class="site_title"><?php echo anchor('dashboard', lang('dashboard.title2')); ?></h1>
			<h2 class="section_title"><?php echo lang('dashboard.title3'); ?></h2><div class="btn_view_site"><?php echo anchor('/', lang('dashboard.viewsite')); ?></div>
		</hgroup>
	</header> <!-- end of header bar -->
	
	<section id="secondary_bar">
		<div class="user">
			<p><?php echo $this->session->userdata('user_firstname'); ?> <?php echo $this->session->userdata('user_lastname'); ?>
			&nbsp;&nbsp; <?php echo form_dropdown('lang', $languages, $lang, $redirect); ?></p>
		</div>
		<div class="breadcrumbs_container">
			<article class="breadcrumbs"><?php echo anchor('dashboard', lang('dashboard.title2')); ?><div class="breadcrumb_divider"></div> <a class="current"><?php echo $page_title; ?></a></article>
		</div>
	</section><!-- end of secondary bar -->
	
	<aside id="sidebar" class="column">
		<h3>Content</h3>
		<ul class="toggle">
			<li class="icn_new_article"><a href="#">New Article</a></li>
			<li class="icn_edit_article"><a href="#">All structure</a></li>
			<li class="icn_categories"><?php echo anchor('category', lang('category.title')) ?></li>
			<li class="icn_tags"><?php echo anchor('language', lang('language.title')) ?></li>
		</ul>
		<h3>Users</h3>
		<ul class="toggle">
			<li class="icn_add_user"><?php echo anchor('user/newuser', lang('user.new')) ?></li>
			<li class="icn_view_users"><?php echo anchor('user/users', lang('user.users')) ?></li>
			<li class="icn_profile"><?php echo anchor('user', lang('user.profile')) ?></li>
			<li class="icn_jump_back"><?php echo anchor('login/logout', lang('login.logout')) ?></li>
		</ul>
		<h3>Admin</h3>
		<ul class="toggle">
			<li class="icn_settings"><?php echo anchor('workflow', lang('workflow.title')) ?></li>
			<li class="icn_security"><?php echo anchor('permission', lang('permission.title')) ?></li>
			<li class="icn_folder"><a href="#">User Modules</a></li>
		</ul>
		
		<footer>
			<hr />
			<p><strong>Copyright &copy; 2011 Website Admin</strong></p>
			<p>Theme by <a href="http://www.medialoot.com">MediaLoot</a></p>
		</footer>
	</aside><!-- end of sidebar -->
	
	<section id="main" class="column">
		
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
		foreach($admin_widgets as $widget => $content)
		{
			echo $content;
		}
		?>

		<div class="clear"></div>
		<input type="hidden" id="hide_text" value="<?php echo lang('admin.hide'); ?>">
		<input type="hidden" id="show_text" value="<?php echo lang('admin.show'); ?>">
</body>

</html>
