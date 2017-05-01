<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Saiph
 */

$additional = '';
if (substr(get_the_content(), 0, 8) !== '[section' && substr(get_the_content(), -8) !== 'section]' ){
	$additional = 'container tpl-spacing-tb-x2';
}
?>

<!-- Entry Content -->
<div class="page content <?php echo $additional ?>">
	<?php
	if ($additional !== ''){
		echo '<div class="row">';
	}
	the_content();
	wp_link_pages( array(
		               'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'saiph-lite' ),
		               'after'  => '</div>',
	               ) );
	if ($additional !== ''){
		echo '</div>';
	}
	?>
</div>
<!-- .Entry Content -->
