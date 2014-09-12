<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<form id="languages_form" method="post" action="<?php echo site_url('language/process'); ?>">
				<div class="box-content">
					<fieldset>
						<legend><?php echo lang('language.title'); ?></legend>
						<div id="tabs">
							<table class="table table-striped"> 
								<thead> 
									<tr> 
										<th><?php echo lang('language.name'); ?></th>
										<th><?php echo lang('language.code'); ?></th>
										<th><?php echo lang('language.default'); ?></th>
										<th><?php echo lang('language.delete'); ?></th>
									</tr> 
								</thead> 
								<tbody>
									<?php foreach ($languages->result() as $language) : ?>
										<tr>
											<td><div class="radio"><input type="text" name="language_name[<?php echo $language->language_id; ?>]" id="language_name_<?php echo $language->language_id; ?>" value="<?php echo $language->language_name; ?>" data-validate="required" data-type="text" title="<?php echo lang('language.name'); ?>"></div></td>
											<td><div class="radio"><input type="text" name="language_code[<?php echo $language->language_id; ?>]" id="language_code_<?php echo $language->language_id; ?>" value="<?php echo $language->language_code; ?>" data-validate="required" data-type="text" title="<?php echo lang('language.code'); ?>"></div></td>
											<td><div class="radio"><label><input type="radio" name="language_default" value="<?php echo $language->language_id; ?>" <?php if (ord($language->language_default)) echo 'checked'; ?> >&nbsp;<i class="fa fa-circle-o"></i></label></div></td>
											<td><div class="radio"><?php echo anchor('language/delete_language/'.$language->language_id, '&nbsp;', array('class' => "fa fa-trash-o", 'title' => lang('language.delete'))); ?></div></td>
										</tr>
									<?php endforeach ?>
								</tbody> 
							</table>
						</div>
						<footer>
						<div class="form-group">
							<div class="col-sm-9">
								<button type="submit" class="btn btn-primary" id="save_language"><?php echo lang('admin.save'); ?></button>
								<button type="submit" class="btn btn-primary" id="add_language"><?php echo lang('admin.add'); ?></button>
							</div>
						</div>
					</fieldset>
				</div>
			</form>
			<input type="hidden" id="admin_error" value="<?php echo lang('admin.error'); ?>">
			<input type="hidden" id="error_message" value="">
			<div style="display:none" id="new_language">
			<input type="text" name="new[]" value="">				
		</div>
	</div>
</div>
