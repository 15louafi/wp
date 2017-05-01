<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
/**
 * @var string $before_widget
 * @var string $after_widget
 * @var array  $recent_posts
 * @var array  $popular_posts
 */
wp_enqueue_script('velocity');
wp_enqueue_script('tabcollapse');

echo $before_widget
?>
<div class="row" data-saiph="saiph-tabs">
	<div class="col-md-12">
		<div class="row tpl-spacing-bottom">
			<nav>
				<ul class="nav nav-tabs tpl-nav-tabs tpl-animated-tabs" data-direction="horizontal">
					<li role="presentation" class="col-md-6  active">
						<a href="#popular_posts" aria-controls="popular_posts" role="tab" data-toggle="tab"><span
								class="fa fa-calendar"></span> <?php _e( 'Recent', 'saiph-lite' ); ?></a>
					</li>
					<li role="presentation" class="col-md-6">
						<a href="#most_commented" aria-controls="most_commented" role="tab" data-toggle="tab"><span
								class="fa fa-thumbs-up"></span> <?php _e( 'Popular', 'saiph-lite' ); ?></a>
					</li>
				</ul>
			</nav>
		</div>
	</div>
	<div class="tab-content">
		<div role="tabpanel" class="tpl-tab-pane tab-pane fade in active" id="popular_posts">
			<p>
			<ul>
				<?php foreach ( $recent_posts as $post ): ?>
					<li class="tab-list-item">
						<a href="<?php echo $post['post_link']; ?>"><?php echo $post['post_title']; ?></a>
						<span class="post-date"><?php echo date( 'F j,Y', $post['post_date'] ); ?></span>
					</li>
				<?php endforeach; ?>
			</ul>
			</p>
		</div>
		<div role="tabpanel" class="tpl-tab-pane tab-pane fade" id="most_commented">
			<p>
			<ul>
				<?php foreach ( $popular_posts as $post ): ?>
					<li class="tab-list-item">
						<a href="<?php echo $post['post_link']; ?>"><?php echo $post['post_title']; ?></a>
						<span class="post-date"><?php echo date( 'F j,Y', $post['post_date'] ); ?></span>
					</li>
				<?php endforeach; ?>
			</ul>
			</p>
		</div>
	</div>
</div>

<?php echo $after_widget ?>
