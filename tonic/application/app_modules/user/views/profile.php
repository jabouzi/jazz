<article class="module width_full">
	<header><h3><?php echo lang('user.profile'); ?></h3></header>
		<div class="module_content">
				<fieldset>
					<label><?php echo lang('user.firstname'); ?></label>
					<input type="text" name="user_firstname" id="user_firstname" value="" data-validate="required" data-type="text" title="<?php echo lang('user.firstname'); ?>">
				</fieldset>
				<fieldset>
					<label><?php echo lang('user.lastname'); ?></label>
					<input type="text" name="user_lastname" id="user_lastname" value="" data-validate="required" data-type="text" title="<?php echo lang('user.lastname'); ?>">
				</fieldset>
				<fieldset>
					<label><?php echo lang('user.email'); ?></label>
					<input type="text" name="user_email" id="user_email" value="" data-validate="required" data-type="email" title="<?php echo lang('user.email'); ?>">
				</fieldset>
				<div class="clear"></div>
		</div>
	<footer>
		<div class="submit_link">
			<input type="button" value="<?php echo lang('admin.save'); ?>" class="alt_btn">
		</div>
	</footer>
</article><!-- end of post new article -->
<article class="module width_full">
	<header><h3><?php echo lang('user.profile'); ?></h3></header>
		<div class="module_content">
				<fieldset>
					<label>Post Title</label>
					<input type="text">
				</fieldset>
				<fieldset>
					<label>Content</label>
					<textarea rows="12"></textarea>
				</fieldset>
				<fieldset style="width:48%; float:left; margin-right: 3%;"> <!-- to make two field float next to one another, adjust values accordingly -->
					<label>Category</label>
					<select style="width:92%;">
						<option>Articles</option>
						<option>Tutorials</option>
						<option>Freebies</option>
					</select>
				</fieldset>
				<fieldset style="width:48%; float:left;"> <!-- to make two field float next to one another, adjust values accordingly -->
					<label>Tags</label>
					<input type="text" style="width:92%;">
				</fieldset><div class="clear"></div>
		</div>
	<footer>
		<div class="submit_link">
			<select>
				<option>Draft</option>
				<option>Published</option>
			</select>
			<input type="submit" value="Publish" class="alt_btn">
			<input type="submit" value="Reset">
		</div>
	</footer>
</article><!-- end of post new article -->
