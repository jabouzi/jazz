<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Login Form</title>
<link rel="stylesheet" href="/tonic/assets/css/login.css">
<!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
  <section class="container">
	<div class="login">
		<h1><?php echo lang('login.title'); ?></h1>
		<p><?php echo lang($message); ?></p>
		<form method="post" action="<?php echo site_url('login/process'); ?>">
			<p><input type="text" name="email" value="" placeholder="<?php echo lang('login.email'); ?>"></p>
			<p><input type="password" name="password" value="" placeholder="<?php echo lang('login.password'); ?>"></p>
			<p>
				<?php echo lang('login.lang'); ?>
				<?php echo form_dropdown('lang', $languages, $lang, $redirect); ?>
			</p>
			<p class="remember_me">
				<label>
				<input type="checkbox" name="remember_me" id="remember_me" <?php echo $checked; ?> >
				<?php echo lang('login.remember'); ?>
				</label>
			</p>
		<p class="submit"><input type="submit" name="commit" value="<?php echo lang('login.login'); ?>"></p>
		</form>
	</div>

	<div class="login-help">
		<p><?php echo lang('login.forget'); ?> <a href="index.html"><?php echo lang('login.reset'); ?></a>.</p>
	</div>
  </section>
</body>
</html>
