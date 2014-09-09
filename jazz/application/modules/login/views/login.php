<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><?php echo lang('login.title'); ?></title>
		<meta name="description" content="description">
		<meta name="author" content="Evgeniya">
		<meta name="keyword" content="keywords">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="/jazz/assets/plugins/bootstrap/bootstrap.css" rel="stylesheet">
		<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>
		<link href="/jazz/assets/css/style.css" rel="stylesheet">
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
				<script src="http://getbootstrap.com/docs-assets/js/html5shiv.js"></script>
				<script src="http://getbootstrap.com/docs-assets/js/respond.min.js"></script>
		<![endif]-->
	</head>
<body>
<div class="container-fluid">
	<div id="page-login" class="row">
		<div class="col-xs-12 col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
			<div class="text-center">
				<p class="bg-danger"><?php echo lang($message); ?></p>
			</div>
			<form method="post" action="<?php echo site_url('login/process'); ?>">
				<div class="box">
					<div class="box-content">
						<div class="text-center">
							<h3 class="page-header"><?php echo lang('login.title'); ?></h3>
						</div>
						<div class="form-group">
							<label class="control-label"><?php echo lang('login.email'); ?></label>
							<input type="text" class="form-control" name="email" value="<?php echo $this->input->post('email'); ?>"/>
						</div>
						<div class="form-group">
							<label class="control-label"><?php echo lang('login.password'); ?></label>
							<input type="password" class="form-control" name="password" value="<?php echo $this->input->post('password'); ?>"/>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="remember_me" id="remember_me" <?php echo $checked; ?> > <?php echo lang('login.remember'); ?>
								<i class="fa fa-square-o"></i>
							</label>
						</div>
						<div class="checkbox">
							<label>
								<?php// echo lang('login.lang'); ?>
								<?php echo form_dropdown('lang', $languages, $lang, $redirect); ?>
							</label>
						</div>
						<div class="text-center">
							<input type="submit" class="btn btn-primary" value="<?php echo lang('login.login'); ?>">
						</div>
					</div>
				</div>
			</form>
		</div>.
	</div>
</div>
</body>
</html>
