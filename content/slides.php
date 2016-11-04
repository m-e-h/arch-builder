<?php
/**
 * Template for post photo slides.
 *
 * @package arch-builder
 */

wp_enqueue_script( 'flickity' ); ?>

<div <?php hybrid_attr( 'post' ); ?>>

	<div class="frame js_frame u-1of1">
		<div class="slides js_slides" data-flickity='{ "imagesLoaded": true, "wrapAround": true, "percentPosition": false }'>

		<?php
		if ( get_post_gallery() ) :

			$gallery = get_post_gallery( get_the_ID(), false );
			$columns = isset( $gallery['columns'] ) ? $gallery['columns'] : 3;

			/* Loop through all the image and output them one by one */
			foreach ( $gallery['src'] as $src ) : ?>

				<img src="<?php echo $src ?>" class="carousel-cell-image u-mr1 u-1of<?php echo $columns ?>-md u-of-cover" alt="Gallery image" />

				<?php
			endforeach;

		else :
		?>
			<?php $query = new WP_Query(
				array(
					'post_type' => get_post_type(),
					'post_parent' => get_the_ID(),
					'orderby' => 'menu_order',
					'order'   => 'ASC',
				)
			); ?>

		<?php while ( $query->have_posts() ) : $query->the_post(); ?>

			<div class="js_slide slide-cell u-1of1 arch-grad-overlay">

				<?php
		        get_the_image(array(
		            'size'         => 'arch-hd',
		            'image_class'  => 'gallery-cell-image u-1of1',
		            'link_to_post' => false,
		        ));
				?>
				<div class="cta-content">
					<?php arch_title(); ?>
					<div class="cta-text arch-f-plus "><?php arch_excerpt(); ?></div>
				</div>
			</div>

		<?php endwhile; ?>
<?php wp_reset_postdata(); ?>
<?php endif; ?>
		</div>
	</div>

	<?php edit_post_link( '<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>' ); ?>

</div>
