<article class="module width_full">
	<header><h3><?php echo lang('user.new'); ?></h3></header>
	<form id="user_profile" method="post" action="<?php echo site_url('user/process_newuser'); ?>">
		<div class="module_content">
			<fieldset>
				<label><?php echo lang('user.firstname'); ?></label>
				<input type="text" name="user_firstname" id="user_firstname" value="<?php echo $this->input->post('user_firstname'); ?>" data-validate="required" data-type="text" title="<?php echo lang('user.firstname'); ?>">
			</fieldset>
			<fieldset>
				<label><?php echo lang('user.lastname'); ?></label>
				<input type="text" name="user_lastname" id="user_lastname" value="<?php echo $this->input->post('user_lastname'); ?>" data-validate="required" data-type="text" title="<?php echo lang('user.lastname'); ?>">
			</fieldset>
			<fieldset>
				<label><?php echo lang('user.email'); ?></label>
				<input type="text" name="user_email" id="user_email" value="<?php echo $this->input->post('user_email'); ?>" data-validate="required" data-type="email" title="<?php echo lang('user.email'); ?>">
			</fieldset>
			<fieldset>
				<label><?php echo lang('user.password'); ?></label>
				<input type="password" name="user_password" id="user_password" value="<?php echo $this->input->post('user_password'); ?>" data-validate="required" data-type="text" title="<?php echo lang('user.password'); ?>">
			</fieldset>
			<fieldset style="width:48%; float:left; margin-right: 3%;">
				<label><?php echo lang('user.permissions'); ?></label>
				<?php echo form_dropdown('user_permission', $permissions, $this->input->post('user_permission'), 'style="width:92%;"'); ?>
			</fieldset>
			<fieldset style="width:48%; float:left;">
				<label><?php echo lang('user.status'); ?></label>
				<?php echo form_dropdown('user_status', $status, $this->input->post('user_status')); ?>
			</fieldset>
			<div class="clear"></div>
		</div>
		<footer>
			<div class="submit_link">
				<input type="button" id="save_user_profile" value="<?php echo lang('admin.save'); ?>" class="submit_form alt_btn">
				<input type="hidden" id="admin_error" value="<?php echo lang('admin.error'); ?>">
				<input type="hidden" id="error_message" value="">
				<input type="hidden" id="email_exists_url" value="<?php echo site_url('user/email_exists'); ?>">
			</div>
		</footer>
	</form>
</article><!-- end article -->
