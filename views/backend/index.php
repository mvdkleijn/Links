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
	function dropdown(sel){ 
		c = confirm('\nYou are about to change the category of this link.\n\nAre you sure you want to do this?\n\n');
		if(c) { sel.form.submit(); } 
	} 
</script>

<h1>Links</h1>

<table class="index">

	<thead>
		<th>Name</th>
		<th>URL</th>
		<th>Category</th>
		<th></th>
	</thead>

<?php foreach($links as $categoryName => $links) { ?>
<?php foreach($links as $link) { ?>
	<tr>
		<td><?php echo $link->name; ?></td>
		<td><?php echo $link->url; ?></td>
		<td>
			<form action="<?php echo get_url('links/changeCategory'); ?>" method="post">
				<input type="hidden" name="id" value="<?php echo $link->id; ?>" />
				<select name="category" onchange="return dropdown(this)">
					<?php if($link->id == 0) { ?>
					<option value="">-- NONE --</option>
					<?php } ?>
					<?php foreach($categories as $category) { ?>
					<option value="<?php echo $category->id; ?>"<?php if(isset($categoryName) && $categoryName == $category->name) { echo ' selected="selected"'; } ?>><?php echo $category->name; ?></option>
					<?php } ?>
				</select>
			</form>
		</td>
		<td><small><a href="<?php echo get_url('links/delete/link/'.$link->id); ?>" onclick="return confirm('Are you sure you wish to delete this link?');"><img src="<?php echo URL_PUBLIC . 'admin/images/minus.png'; ?>" alt="delete" /></a></small></td>
	</tr>
<?php } ?>
<?php } ?>

</table>