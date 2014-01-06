<article class="module width_full">
	<header><h3 class="tabs_involved"><?php echo lang('category.categorys'); ?></h3></header>
	<div class="tab_container">
		<table class="tablesorter" cellspacing="0"> 
		<thead> 
			<tr> 
				<th><?php echo lang('category.name'); ?></th>
				<th><?php echo lang('category.parent'); ?></th>
				<th><?php echo lang('category.status'); ?></th>
				<th><?php echo lang('admin.action'); ?></th>
			</tr> 
		</thead> 
		<tbody id="workflow_list">
			<?php foreach ($categories->result() as $category) : ?>
				<tr>
					<td><?php echo $category->category_firstname ?></td>
					<td><?php echo $category->category_lastname ?></td>
					<td><?php echo $category->category_email ?></td>
					<td><?php echo lang('category.status'.ord($category->category_status)); ?></td>
					<td>
						<?php echo anchor('category/editcategory/'.$category->category_id, '<input type="image" src="/tonic/assets/images/icn_edit.png" title="'.lang('category.edit').'">'); ?>
						<input type="image" src="/tonic/assets/images/icn_trash.png" title="<?php echo lang('category.delete'); ?>">
					</td>
				</tr>
			<?php endforeach ?>
		</tbody> 
		</table>
	</div><!-- end of .tab_container -->
</article><!-- end of article -->
