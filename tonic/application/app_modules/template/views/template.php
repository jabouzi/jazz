<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title><?php echo $page_title; ?> Admin Panel</title>
	
	<link rel="stylesheet" href="/tonic/assets/css/admin.css" type="text/css" media="screen" />
	<!--[if lt IE 9]>
	<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script src="/tonic/assets/js/jquery-1.5.2.min.js" type="text/javascript"></script>
	<script src="/tonic/assets/js/hideshow.js" type="text/javascript"></script>
	<script src="/tonic/assets/js/jquery.tablesorter.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="/tonic/assets/js/jquery.equalHeight.js"></script>
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
			<h1 class="site_title"><a href="index.html">Website Admin</a></h1>
			<h2 class="section_title">Dashboard</h2><div class="btn_view_site"><a href="http://www.medialoot.com">View Site</a></div>
		</hgroup>
	</header> <!-- end of header bar -->
	
	<section id="secondary_bar">
		<div class="user">
			<p><?php echo $this->session->userdata('user_firstname'); ?> <?php echo $this->session->userdata('user_lastname'); ?></p>
			<!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
		</div>
		<div class="breadcrumbs_container">
			<article class="breadcrumbs"><a href="index.html">Website Admin</a> <div class="breadcrumb_divider"></div> <a class="current">Dashboard</a></article>
		</div>
	</section><!-- end of secondary bar -->
	
	<aside id="sidebar" class="column">
		<form class="quick_search">
			<input type="text" value="Quick Search" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;">
		</form>
		<hr/>
		<h3>Content</h3>
		<ul class="toggle">
			<li class="icn_new_article"><a href="#">New Article</a></li>
			<li class="icn_edit_article"><a href="#">Edit Articles</a></li>
			<li class="icn_categories"><a href="#">Categories</a></li>
			<li class="icn_tags"><a href="#">Tags</a></li>
		</ul>
		<h3>Users</h3>
		<ul class="toggle">
			<li class="icn_add_user"><a href="#">Add New User</a></li>
			<li class="icn_view_users"><a href="#">View Users</a></li>
			<li class="icn_profile"><a href="#">Your Profile</a></li>
		</ul>
		<h3>Admin</h3>
		<ul class="toggle">
			<li class="icn_settings"><a href="#">Options</a></li>
			<li class="icn_security"><a href="#">Security</a></li>
			<li class="icn_jump_back"><?php echo anchor('login/logout', 'Logout') ?></li>
		</ul>
		
		<footer>
			<hr />
			<p><strong>Copyright &copy; 2011 Website Admin</strong></p>
			<p>Theme by <a href="http://www.medialoot.com">MediaLoot</a></p>
		</footer>
	</aside><!-- end of sidebar -->
	
	<section id="main" class="column">
		
		<h4 class="alert_info">Welcome to the free MediaLoot admin panel template, this could be an informative message.</h4>
		
		<article class="module width_full">
			<header><h3>Stats</h3></header>
			<div class="module_content">
				<article class="stats_graph">
					<img src="http://chart.apis.google.com/chart?chxr=0,0,3000&chxt=y&chs=520x140&cht=lc&chco=76A4FB,80C65A&chd=s:Tdjpsvyvttmiihgmnrst,OTbdcfhhggcTUTTUadfk&chls=2|2&chma=40,20,20,30" width="520" height="140" alt="" />
				</article>
				
				<article class="stats_overview">
					<div class="overview_today">
						<p class="overview_day">Today</p>
						<p class="overview_count">1,876</p>
						<p class="overview_type">Hits</p>
						<p class="overview_count">2,103</p>
						<p class="overview_type">Views</p>
					</div>
					<div class="overview_previous">
						<p class="overview_day">Yesterday</p>
						<p class="overview_count">1,646</p>
						<p class="overview_type">Hits</p>
						<p class="overview_count">2,054</p>
						<p class="overview_type">Views</p>
					</div>
				</article>
				<div class="clear"></div>
			</div>
		</article><!-- end of stats article -->
		
		<article class="module width_full">
		<header><h3 class="tabs_involved">Content Manager</h3>
		</header>

		<div class="tab_container">
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
					   <th></th> 
					<th>Entry Name</th> 
					<th>Category</th> 
					<th>Created On</th> 
					<th>Actions</th> 
				</tr> 
			</thead> 
			<tbody> 
				<tr> 
					   <td><input type="checkbox"></td> 
					<td>Lorem Ipsum Dolor Sit Amet</td> 
					<td>Articles</td> 
					<td>5th April 2011</td> 
					<td><input type="image" src="/tonic/assets/images/icn_edit.png" title="Edit"><input type="image" src="/tonic/assets/images/icn_trash.png" title="Trash"></td> 
				</tr> 
				<tr> 
					   <td><input type="checkbox"></td> 
					<td>Ipsum Lorem Dolor Sit Amet</td> 
					<td>Freebies</td> 
					<td>6th April 2011</td> 
						<td><input type="image" src="/tonic/assets/images/icn_edit.png" title="Edit"><input type="image" src="/tonic/assets/images/icn_trash.png" title="Trash"></td> 
				</tr>
				<tr> 
					   <td><input type="checkbox"></td> 
					<td>Sit Amet Dolor Ipsum</td> 
					<td>Tutorials</td> 
					<td>10th April 2011</td> 
					<td><input type="image" src="/tonic/assets/images/icn_edit.png" title="Edit"><input type="image" src="/tonic/assets/images/icn_trash.png" title="Trash"></td> 
				</tr> 
				<tr> 
					   <td><input type="checkbox"></td> 
					<td>Dolor Lorem Amet</td> 
					<td>Articles</td> 
					<td>16th April 2011</td> 
						<td><input type="image" src="/tonic/assets/images/icn_edit.png" title="Edit"><input type="image" src="/tonic/assets/images/icn_trash.png" title="Trash"></td> 
				</tr>
				<tr> 
					   <td><input type="checkbox"></td> 
					<td>Dolor Lorem Amet</td> 
					<td>Articles</td> 
					<td>16th April 2011</td> 
						<td><input type="image" src="/tonic/assets/images/icn_edit.png" title="Edit"><input type="image" src="/tonic/assets/images/icn_trash.png" title="Trash"></td> 
				</tr>  
			</tbody> 
			</table>			
		</div><!-- end of .tab_container -->
		
		</article><!-- end of content manager article -->
		
		
		
		<div class="clear"></div>
		
		<article class="module width_full">
			<header><h3>Modules</h3></header>
            <div class="module_content">
                    
            </div>			
		</article><!-- end of modules -->
</body>

</html>
