<article class="module width_full">
	<header><h3 class="tabs_involved"><?php echo lang('category.categorys'); ?></h3>
		<ul class="tabs">
			<?php foreach($admin_languages as $code => $admin_language) : ?>
				<li><a href="#<?php echo $code; ?>"><?php echo ucfirst(strtolower($admin_language)); ?></a></li>
			<? endforeach; ?>
		</ul>
	</header>
	<?php $index = 0; ?>
	<?php foreach($admin_languages as $code => $admin_language) : ?>
		<div id="<?php echo $code; ?>" class="tab_content">
			<div class="tab_container">
				<table class="tablesorter" cellspacing="0"> 
				<thead> 
					<tr> 
						<th><?php echo lang('category.name'); ?></th>
						<th><?php echo lang('category.parent'); ?></th>
					</tr> 
				</thead> 
				<tbody id="workflow_list">
					<?php echo element($code, $categories); ?>
				</tbody> 
				</table>
			</div><!-- end of .tab_container -->
		</div>
		<?php $index++; ?>
	<?php endforeach; ?>
</article><!-- end of article -->
