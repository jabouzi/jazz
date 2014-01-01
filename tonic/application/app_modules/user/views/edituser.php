<article class="module width_full">
	<header><h3><?php echo lang('user.edit'); ?></h3></header>
	<form id="user_profile" method="post" action="<?php echo site_url('user/process_edituser'); ?>">
		<div class="module_content">
			<fieldset>
				<label><?php echo lang('user.firstname'); ?></label>
				<input type="text" name="user_firstname" id="user_firstname" value="<?php echo $user->user_firstname; ?>" data-validate="required" data-type="text" title="<?php echo lang('user.firstname'); ?>">
			</fieldset>
			<fieldset>
				<label><?php echo lang('user.lastname'); ?></label>
				<input type="text" name="user_lastname" id="user_lastname" value="<?php echo $user->user_lastname; ?>" data-validate="required" data-type="text" title="<?php echo lang('user.lastname'); ?>">
			</fieldset>
			<fieldset>
				<label><?php echo lang('user.email'); ?></label>
				<input type="text" name="user_email" id="user_email" value="<?php echo $user->user_email; ?>" data-validate="required" data-type="email" title="<?php echo lang('user.email'); ?>">
			</fieldset>
			<fieldset>
				<label><?php echo lang('user.password'); ?></label>
				<input type="password" name="user_password" id="user_password" value="" data-validate="required" data-type="password" title="<?php echo lang('user.password'); ?>">
			</fieldset>
			<fieldset style="width:48%; float:left; margin-right: 3%;">
				<label><?php echo lang('user.permissions'); ?></label>
				<select style="width:92%;">
					<option>Draft</option>
					<option>Published</option>
				</select>
			</fieldset>
			<fieldset style="width:48%; float:left;">
				<label><?php echo lang('user.status'); ?></label>
				<select>
					<option>Draft</option>
					<option>Published</option>
				</select>
			</fieldset>
			<div class="clear"></div>
		</div>
		<footer>
			<div class="submit_link">
				<input type="button" id="save_user_profile" value="<?php echo lang('admin.save'); ?>" class="alt_btn">
			</div>
		</footer>
	</form>
</article><!-- end of post new article -->
