<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<form id="user_profile" method="post" action="<?php echo site_url('user/process_newuser'); ?>">
				<div class="box-content">
					<div id="tabs">
						<table class="table-bordered">
							<tbody>
								<tr>
									<td><div class="radio"><?php echo lang('user.firstname'); ?></div></td>
									<td><div class="radio"><input type="text" name="user_firstname" id="user_firstname" value="<?php echo $this->input->post('user_firstname'); ?>" data-validate="required" data-type="text" title="<?php echo lang('user.firstname'); ?>"></div></td>
								</tr>
								<tr>
									<td><div class="radio"><?php echo lang('user.lastname'); ?></div></td>
									<td><div class="radio"><input type="text" name="user_lastname" id="user_lastname" value="<?php echo $this->input->post('user_lastname'); ?>" data-validate="required" data-type="text" title="<?php echo lang('user.lastname'); ?>"></div></td>
								</tr>
								<tr>
									<td><div class="radio"><?php echo lang('user.email'); ?></div></td>
									<td><div class="radio"><input type="text" name="user_email" id="user_email" value="<?php echo $this->input->post('user_email'); ?>" data-validate="required" data-type="email" title="<?php echo lang('user.email'); ?>"></div></td>
								</tr>
								<tr>
									<td><div class="radio"><?php echo lang('user.password'); ?></div></td>
									<td><div class="radio"><input type="password" name="user_password" id="user_password" value="<?php echo $this->input->post('user_password'); ?>" data-validate="required" data-type="text" title="<?php echo lang('user.password'); ?>"></div></td>
								</tr>
								<tr>
									<td><div class="radio"><?php echo lang('user.permissions'); ?></div></td>
									<td><div class="radio"><?php echo form_dropdown('user_permission', $permissions, $this->input->post('user_permission'), 'style="width:92%;"'); ?></div></td>
								</tr>
								<tr>
									<td><div class="radio"><?php echo lang('user.status'); ?></div></td>
									<td><div class="radio"><?php echo form_dropdown('user_active', $status, $this->input->post('user_active')); ?></div></td>
								</tr>
							</tbody>
						</table>
						<div class="clear"></div>
					</div>
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
		</div>
	</div>
</div>
