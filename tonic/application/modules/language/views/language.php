<article class="module width_full">
	<header><h3 class="tabs_involved"><?php echo lang('language.title'); ?></h3></header>
	<form id="languages_form" method="post" action="<?php echo site_url('language/process'); ?>">
	<div class="tab_container">
		<table class="tablesorter" cellspacing="0"> 
		<thead> 
			<tr> 
				<th><?php echo lang('language.title'); ?></th>
				<th><?php echo lang('language.code'); ?></th>
				<th><?php echo lang('language.default'); ?></th>
				<th><?php echo lang('language.delete'); ?></th>
			</tr> 
		</thead> 
		<tbody id="language_list">
			<?php foreach ($languages->result() as $language) : ?>
				<tr>
					<td><input type="text" name="language_name[<?php echo $language->language_id; ?>]" id="language_name_<?php echo $language->language_id; ?>" value="<?php echo $language->language_name; ?>" data-validate="required" data-type="text" title="<?php echo lang('language.title'); ?>"></td>
					<td><input type="text" name="language_code[<?php echo $language->language_id; ?>]" id="language_code_<?php echo $language->language_id; ?>" value="<?php echo $language->language_code; ?>" data-validate="required" data-type="text" title="<?php echo lang('language.code'); ?>"></td>
					<td><input type="radio" name="language_default[<?php echo $language->language_id; ?>]" value="<?php echo ord($language->language_default); ?>" <?php if (ord($language->language_default)) echo 'checked'; ?> ></td>
					<td>
						<input type="image" src="/tonic/assets/images/icn_trash.png" title="<?php echo lang('language.delete'); ?>">
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
</article><!-- end of article -->
