<?php
/**
 * Template part for displaying posts.
 *
 *
 * @package Saiph
 */

?>
<!-- Post Contents / Glorified Button-->
<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
	<div class="tpl-blog-box-link">
		<?php the_content() ?>
	</div>
</div>
<!-- .Post Contents -->
