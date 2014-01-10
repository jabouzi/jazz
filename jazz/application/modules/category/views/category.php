<article class="module width_full">
	<header><h3 class="tabs_involved"><?php echo lang('category.categorys'); ?></h3>
		<ul class="tabs">
			<?php foreach($languages as $language) : ?>
				<li><a href="#<?php echo $language->language_code; ?>"><?php echo ucfirst(strtolower($language->language_name)); ?></a></li>
			<? endforeach; ?>
		</ul>
	</header>
	<form method="POST" action="<?php echo site_url('category/process'); ?>">
		<?php $index = 0; ?>
		<?php foreach($languages as $language) : ?>
			<? if ($language->language_code == 'en') :?>
			<div id="<?php echo $language->language_code; ?>" class="tab_content">
				<div class="tab_container">
					<table class="tablesorter" cellspacing="0"> 
					<thead> 
						<tr> 
							<th><?php echo lang('category.name'); ?></th>
							<?php if (!$index) : ?> 
								<th><?php echo lang('category.order'); ?></th>
								<th><?php echo lang('category.status'); ?></th>
								<th><?php echo lang('admin.action'); ?></th>
							<?php endif; ?>
						</tr> 
					</thead> 
					<tbody id="workflow_list">
						<?php foreach ($categories[$language->language_id] as $category) : ?>
							<tr>
								<?php if (trim($category->category_name) == '') : ?>
									<td><?php echo str_repeat('<span class="dash_space"><nobr>|—</nobr></span>', $categories['structure'][$category->category_id][0]) ?><input type="text" name="name[<?php echo $category->language_id ; ?>][<?php echo $category->category_id ; ?>]" value=""></td>
								<?php else :?>
									<td><?php echo str_repeat('<span class="dash_space"><nobr>|—</nobr></span>', $categories['structure'][$category->category_id][0]) . $category->category_name ; ?></td>
								<?php endif ?>
								<?php if (!$index) : ?> 
									<td><input type="text" name="order[<?php echo $category->category_id ; ?>]" maxlength="2" size="2" value="<?php echo  $category->category_order ; ?>"></td>
									<td><?php echo lang('admin.status'.ord($category->category_status)) ; ?></td>
									<td>
										<?php echo anchor('category/editcategory/'.$category->category_id, '<input type="image" src="/jazz/assets/images/icn_edit.png" title="'.lang('category.edit').'">'); ?>
										<input type="image" src="/jazz/assets/images/icn_trash.png" title="<?php echo lang('category.delete') ; ?>">
									</td>
								<?php endif ?>
							</tr>
						<?php endforeach; ?>
					</tbody> 
					</table>
				</div><!-- end of .tab_container -->
			</div>
			<?php $index++; ?>
		<?php endif; ?>
		<?php endforeach; ?>
		
	</form>
	
</article><!-- end of article -->
