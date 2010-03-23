<?php

/**
 * Copyright (C) 2010, band-x Media Limited <info@band-x.org>
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy of
 * this software and associated documentation files (the "Software"), to deal in
 * the Software without restriction, including without limitation the rights to
 * use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of
 * the Software, and to permit persons to whom the Software is furnished to do so,
 * subject to the following conditions:
 * 
 * All copyright notices and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
 * FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 * 
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM,
 * DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE,
 * ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
 * DEALINGS IN THE SOFTWARE.
 */

/**
 * @package Links
 * @subpackage Views
 *
 * @author Andrew Waters <andrew@band-x.org>
 * @version 1.0
 * @license http://creativecommons.org/licenses/MIT MIT License
 * @copyright band-x Media Limited, 2010
 */

?>

<script type="text/javascript">
	function changeLayout(sel){ 
		c = confirm('\nYou are about to change the frontend layout of links.\n\nAre you sure you want to do this?\n\n');
		if(c) { sel.form.submit(); } 
	} 
	function changeTarget(sel){ 
		c = confirm('\nYou are about to change the target window that links will open in on the frontend.\n\nAre you sure you want to do this?\n\n');
		if(c) { sel.form.submit(); } 
	} 
</script>

<div class="box">
	<h3>Add a new Link</h3>
	<form action="<?php echo get_url('links/add/link'); ?>" method="POST">
		<p><label>Name</label> <input type="text" class="textbox" name="name"<?php if(count($categories) == 0) echo ' disabled="disabled"'; ?> /></p>
		<p><label>URL</label> <input type="text" class="textbox" name="url"<?php if(count($categories) == 0) echo ' disabled="disabled"'; ?> /></p>
		<?php if(count($categories) != 0) { ?>
		<p><label>Category</label>
		<select name="category">
			<?php foreach($categories as $category) { ?>
			<option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
			<?php } ?>
		</select></p>
		<?php } ?>
		<p><label>&nbsp;</label> <input type="submit" value="Add" <?php if(count($categories) == 0) echo ' disabled="disabled"'; ?> />
			<?php if(count($categories) == 0) { ?><small><strong>Please add a category first</strong></small><?php } ?></p>
	</form>
</div>

<div class="box">
	<h3>Add a new Category</h3>
	<form action="<?php echo get_url('links/add/category'); ?>" method="POST">
		<p><label>Name</label> <input type="text" class="textbox" name="name" /></p>
		<p><label>&nbsp;</label> <input type="submit" value="Add" /></p>
	</form>
</div>

<?php if(count($categories) != 1) { ?>
<div class="box">
	<h3>Categories</h3>
	<?php	foreach($categories as $category) {
				if($category->id != 1) {	?>
		<small><a href="<?php echo get_url('links/delete/category/'.$category->id); ?>" onclick="return confirm('Are you sure you wish to delete the <?php echo $category->name; ?> category?');"><img src="<?php echo URL_PUBLIC . 'admin/images/minus.png'; ?>" alt="delete" /></a></small> <?php echo $category->name; ?><br />
	<?php		}
			}
	?>
</div>
<?php } ?>

<?php if(AuthUser::hasPermission('administrator,developer')) { ?>
<div class="box">
	<h3>Administrator Options</h3>
	<p>
		<label>Layout</label>
		<form action="<?php echo get_url('links/changeLayout'); ?>" method="POST">
			<select name="layout" onchange="return changeLayout(this)">
				<?php foreach($layouts as $layout) { ?>
				<option value="<?php echo $layout->id; ?>"<?php if($layout->id == $settings['layout']) echo ' selected="selected"'; ?>><?php echo $layout->name; ?></option>
				<?php } ?>
			</select>
		</form>
	</p>
	<p>
		<label>Target</label>
		<form action="<?php echo get_url('links/changeTarget'); ?>" method="POST">
			<select name="target" onchange="return changeTarget(this)">
				<option value="_self"<?php if($settings['target'] == '_self') echo ' selected="selected"'; ?>>Same Window</option>
				<option value="_blank"<?php if($settings['target'] == '_blank') echo ' selected="selected"'; ?>>New Window</option>
			</select>
		</form>
	</p>
</div>
<?php } ?>