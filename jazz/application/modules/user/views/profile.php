<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-content">
				<form id="defaultForm" method="post" action="<?php echo site_url('user/process_profile'); ?>" class="form-horizontal">
					<fieldset>
						<legend><?php echo lang('user.profile'); ?></legend>
						<div class="form-group">
							<label class="col-sm-3 control-label"><?php echo lang('user.firstname'); ?></label>
							<div class="col-sm-5">
								<input type="text" class="form-control" name="user_firstname" id="user_firstname" value="<?php echo $user->user_firstname; ?>"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label"><?php echo lang('user.lastname'); ?></label>
							<div class="col-sm-5">
								<input type="text" class="form-control" name="user_lastname" id="user_lastname" value="<?php echo $user->user_lastname; ?>"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label"><?php echo lang('user.email'); ?></label>
							<div class="col-sm-5">
								<input type="text" class="form-control" name="user_email" id="user_email"  value="<?php echo $user->user_email; ?>"/>
							</div>
						</div>
					</fieldset>
					<div class="form-group">
						<div class="col-sm-9 col-sm-offset-3">
							<button type="submit" class="btn btn-primary"><?php echo lang('admin.save'); ?></button>
						</div>
					</div>					
				</form>
				<input type="hidden" name="user_id" id="user_id" value="<?php echo $user->user_id; ?>">
				<input type="hidden" id="email_exists_url" value="<?php echo site_url('user/email_exists'); ?>">
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-content">
				<form id="defaultForm" method="post" action="<?php echo site_url('user/process_password'); ?>" class="form-horizontal">
					<fieldset>
						<legend><?php echo lang('user.password'); ?></legend>
						<div class="form-group">
							<label class="col-sm-3 control-label"><?php echo lang('user.oldpassword'); ?></label>
							<div class="col-sm-5">
								<input type="text" class="form-control" name="user_oldpassword" id="user_oldpassword" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label"><?php echo lang('user.newpassword'); ?></label>
							<div class="col-sm-5">
								<input type="text" class="form-control" name="user_newpassword" id="user_newpassword" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label"><?php echo lang('user.newpassword'); ?></label>
							<div class="col-sm-5">
								<input type="text" class="form-control" name="user_confirm_newpassword" id="user_confirm_newpassword" />
							</div>
						</div>
					</fieldset>
					<div class="form-group">
						<div class="col-sm-9 col-sm-offset-3">
							<button type="submit" class="btn btn-primary"><?php echo lang('admin.save'); ?></button>
						</div>
					</div>					
				</form>
				<input type="hidden" name="user_id" id="user_id" value="<?php echo $user->user_id; ?>">
				<input type="hidden" name="user_id" id="user_id" value="<?php echo $user->user_id; ?>">
				<input type="hidden" id="admin_error" value="<?php echo lang('admin.error'); ?>">
				<input type="hidden" id="error_message" value="">
				<input type="hidden" id="good_password_url" value="<?php echo site_url('user/good_password'); ?>">
			</div>
		</div>
	</div>
</div>
