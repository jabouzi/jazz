<div class="row">
	<div class="col-xs-12">
		<div class="box">			
			<form id="languages_form" method="post" action="<?php echo site_url('language/process'); ?>">
				<div class="box-content">
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
								<td><input type="text" name="language_name[<?php echo $language->language_id; ?>]" id="language_name_<?php echo $language->language_id; ?>" value="<?php echo $language->language_name; ?>" data-validate="required" data-type="text" title="<?php echo lang('language.name'); ?>"></td>
								<td><input type="text" name="language_code[<?php echo $language->language_id; ?>]" id="language_code_<?php echo $language->language_id; ?>" value="<?php echo $language->language_code; ?>" data-validate="required" data-type="text" title="<?php echo lang('language.code'); ?>"></td>
								<td class="radio"><label><input type="radio" name="language_default" value="<?php echo $language->language_id; ?>" <?php if (ord($language->language_default)) echo 'checked'; ?> >&nbsp;<i class="fa fa-circle-o"></i></label></td>
								<td>
									<?php echo anchor('language/delete_language/'.$language->language_id, '&nbsp;', array('class' => "fa fa-trash-o", 'title' => lang('language.delete'))); ?>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody> 
					</table>
				</div><!-- end of .tab_container -->
				<footer>
						<div class="submit_link">
							<input type="button" id="save_language" value="<?php echo lang('admin.save'); ?>" class="submit_form alt_btn">
							<input type="button" id="add_language" value="<?php echo lang('admin.add'); ?>">
						</div>
				</footer>
			</form>
				<input type="hidden" id="admin_error" value="<?php echo lang('admin.error'); ?>">
				<input type="hidden" id="error_message" value="">
				<div style="display:none" id="new_language">
					<td><input type="text" name="new[]" value="">
				</div>
			</div>
		</div>
	</div>
</div>
