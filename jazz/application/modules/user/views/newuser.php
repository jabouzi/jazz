<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-content">
				<form id="defaultForm" method="post" action="validators.html" class="form-horizontal">
					<fieldset>
						<legend>Not Empty validator</legend>
						<div class="form-group">
							<label class="col-sm-3 control-label">Username</label>
							<div class="col-sm-5">
								<input type="text" class="form-control" name="username" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Country</label>
							<div class="col-sm-5">
								<select class="populate placeholder" name="country" id="s2_country">
									<option value="">-- Select a country --</option>
									<option value="fr">France</option>
									<option value="de">Germany</option>
									<option value="it">Italy</option>
									<option value="jp">Japan</option>
									<option value="ru">Russia</option>
									<option value="gb">United Kingdom</option>
									<option value="us">United State</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-9 col-sm-offset-3">
								<div class="checkbox">
									<label>
										<input type="checkbox"  name="acceptTerms" /> Accept the terms and policies
										<i class="fa fa-square-o small"></i>
									</label>
								</div>
							</div>
						</div>
					</fieldset>
					<fieldset>
						<legend>Regular expression based validators</legend>
						<div class="form-group">
							<label class="col-sm-3 control-label">Email address</label>
							<div class="col-sm-5">
								<input type="text" class="form-control" name="email" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Website</label>
							<div class="col-sm-5">
								<input type="text" class="form-control" name="website" placeholder="http://" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Phone number</label>
							<div class="col-sm-5">
								<input type="text" class="form-control" name="phoneNumber" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Hex color</label>
							<div class="col-sm-3">
								<input type="text" class="form-control" name="color" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">US zip code</label>
							<div class="col-sm-3">
								<input type="text" class="form-control" name="zipCode" />
							</div>
						</div>
					</fieldset>
					<fieldset>
						<legend>Identical validator</legend>
						<div class="form-group">
							<label class="col-sm-3 control-label">Password</label>
							<div class="col-sm-5">
								<input type="password" class="form-control" name="password" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Retype password</label>
							<div class="col-sm-5">
								<input type="password" class="form-control" name="confirmPassword" />
							</div>
						</div>
					</fieldset>
					<fieldset>
						<legend>Other validators</legend>
						<div class="form-group">
							<label class="col-sm-3 control-label">Ages</label>
							<div class="col-sm-3">
								<input type="text" class="form-control" name="ages" />
							</div>
						</div>
					</fieldset>
					<div class="form-group">
						<div class="col-sm-9 col-sm-offset-3">
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</div>
				</form>
			</div>
			
			
			
			<form id="user_profile" method="post" action="<?php echo site_url('user/process_newuser'); ?>">
				<div class="box-content">
					<div id="tabs">
						<table>
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
