<?php foreach($languages as $language) : ?>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-content">
				<table class="table">
					<thead>
						<tr>
							<th><?php echo lang('category.name'); ?></th>
							<th><?php echo lang('category.order'); ?></th>
							<th><?php echo lang('category.status'); ?></th>
							<th><?php echo lang('admin.action'); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php if (element($language->language_id, $structures) ): ?>
							<?php foreach ($structures[$language->language_id] as $category_id => $structure) : ?>
								<?php $category = $categories[$language->language_id][$category_id]; ?>
								<tr>
									<?php if (trim($category->category_name) == '') : ?>
										<td><?php echo str_repeat('<span class="dash_space"><nobr>|—</nobr></span>', $structure) ?><input type="text" name="name[<?php echo $category->language_id ; ?>][<?php echo $category->category_id ; ?>]" value=""></td>
									<?php else :?>
										<td><?php echo str_repeat('<span class="dash_space"><nobr>|—</nobr></span>', $structure) . $category->category_name ; ?></td>
									<?php endif ?>
									<td><input type="text" name="order[<?php echo $category->category_id ; ?>]" maxlength="2" size="2" value="<?php echo  $category->category_order ; ?>"></td>
									<td><img src="/jazz/assets/images/<?php echo $status[ord($category->category_active)]; ?>" title="<?php echo lang('category.status'); ?>"></td>
									<td>
										<?php echo anchor('category/editcategory/'.$category->category_id, '<img src="/jazz/assets/images/icn_edit.png" title="'.lang('category.edit').'">'); ?>
										<?php echo anchor('category/deletecategory/'.$category->category_id, '<img src="/jazz/assets/images/icn_trash.png" title="'.lang('category.delete').'">'); ?>
									</td>
								</tr>
							<?php endforeach; ?>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php endforeach; ?>
