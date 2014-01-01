<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title><?php echo $page_title; ?> - <?php echo lang('dashboard.title1'); ?></title>
	
	<link rel="stylesheet" href="/tonic/assets/css/admin.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="/tonic/assets/css/bootstrap-3.0.0.min.css" type="text/css">
<!--
    <link rel="stylesheet" href="/tonic/assets/css/bootstrap-multiselect.css" type="text/css">
-->
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
			-- <?php echo form_dropdown('lang', $languages, $lang, $redirect); ?></p>
			<!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
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
			<li class="icn_categories"><a href="#">Categories</a></li>
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
		
		<h4 style="display:none" class="alert_info">Welcome to the free MediaLoot admin panel template, this could be an informative message.</h4>
        <h4 style="display:none" class="alert_warning"></h4>		
		<h4 style="display:none" class="alert_error"></h4>		
		<h4 style="display:none" class="alert_success"></h4>
		
		<?php 
		foreach($admin_widgets as $widget => $content)
		{
			echo $content;
		}
		?>

		<div class="clear"></div>
		
</body>

</html>
