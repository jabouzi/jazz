<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-content">
				<form id="categories_form" method="post" action="<?php echo site_url('category/process'); ?>">
					<fieldset>
						<legend><?php echo lang('category.title'); ?></legend>
						<div id="tabs">
							<ul>
								<?php foreach($languages as $language) : ?>
									<? if (isset($categories[$language->language_id])) :?>
										<li><a href="#<?php echo $language->language_code; ?>"><?php echo ucfirst(strtolower($language->language_name)); ?></a></li>
									<? endif; ?>
								<? endforeach; ?>
							</ul>
							<?php foreach($languages as $language) : ?>
								<? if (isset($categories[$language->language_id])) :?>
									<div id="<?php echo $language->language_code; ?>">
										<table class="table table-striped"> 
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
															<td><span class="<?php echo $status[ord($category->category_active)]; ?>" title="<?php echo lang('category.status'); ?>"></span></td>
															<td>
																<?php echo anchor('category/editcategory/'.$category->category_id, '&nbsp;', array('class' => "fa fa-edit", 'title' => lang('category.edit'))); ?>
																<?php echo anchor('category/deletecategory/'.$category->category_id, '&nbsp;', array('class' => "fa fa-trash-o", 'title' => lang('category.delete'))); ?>
															</td>
														</tr>
													<?php endforeach; ?>
												<?php endif; ?>
											</tbody> 
										</table>
									</div>
								<?php endif; ?>
							<?php endforeach; ?>
						</div>
						<div class="form-group">
							<div class="col-sm-9 col-sm-offset-3">
								<button type="submit" class="btn btn-primary" id="save_category"><?php echo lang('admin.save'); ?></button>
							</div>
							<div class="col-sm-9 col-sm-offset-3">
								<button type="submit" class="btn btn-primary"  id="add_category"><?php echo lang('admin.add'); ?></button>
							</div>
						</div>
					</fieldset>
				</form>	
			</div>
		</div>
	</div>
</div>
