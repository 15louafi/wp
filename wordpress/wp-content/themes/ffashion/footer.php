<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "body-content-wrapper" div and all content after.
 *
 * @subpackage fFashion
 * @author tishonator
 * @since fFashion 1.0.3
 *
 */
?>
			<a href="#" class="scrollup"></a>

			<footer id="footer-main">

				<div id="footer-content-wrapper">

					<div class="clear">
					</div>

					<div id="copyright">

						<p>
						 <?php ffashion_show_copyright_text(); ?> <a href="<?php echo esc_url( 'https://tishonator.com/product/ffashion' ); ?>" title="<?php esc_attr_e( 'ffashion Theme', 'ffashion' ); ?>">
							<?php _e('fFashion Theme', 'ffashion'); ?></a> <?php esc_attr_e( 'powered by', 'ffashion' ); ?> <a href="<?php echo esc_url( 'http://wordpress.org/' ); ?>" title="<?php esc_attr_e( 'WordPress', 'ffashion' ); ?>">
							<?php _e('WordPress', 'ffashion'); ?></a>
						</p>
						
					</div><!-- #copyright -->

				</div><!-- #footer-content-wrapper -->

			</footer><!-- #footer-main -->

		</div><!-- #body-content-wrapper -->
		<?php wp_footer(); ?>
	</body>
</html>