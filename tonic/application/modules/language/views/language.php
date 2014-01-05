<article class="module width_full">
	<header><h3 class="tabs_involved"><?php echo lang('language.languages'); ?></h3></header>
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
		<tbody id="workflow_list">
			<?php foreach ($languages->result() as $language) : ?>
				<tr>
					<td><input type="text" name="language_name[]" id="language_name_<?php echo $language->language_id; ?>" value="<?php echo $language->language_name; ?>"></td>
					<td><input type="text" name="language_code[]" id="language_code_<?php echo $language->language_id; ?>" value="<?php echo $language->language_code; ?>"></td>
					<td><input type="radio" name="language_default" value="language_default_<?php echo $language->language_id; ?>" <?php if (ord($item->language_default)) echo 'checked'; ?> ></td>
					<td>
						<input type="image" src="/tonic/assets/images/icn_trash.png" title="<?php echo lang('language.delete'); ?>">
					</td>
				</tr>
			<?php endforeach ?>
		</tbody> 
		</table>
	</div><!-- end of .tab_container -->
</article><!-- end of article -->
