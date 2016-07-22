<?php
/**
 * Template for post photo slides.
 *
 * @package arch-builder
 */

wp_enqueue_script( 'lory' ); ?>

<div <?php hybrid_attr( 'post' ); ?>>

	<div class="frame js_frame arch-u-1of1">
		<div class="slides js_slides">

		<?php
		if ( get_post_gallery() ) :
			$gallery = get_post_gallery( get_the_ID(), false );

			/* Loop through all the image and output them one by one */
			foreach ( $gallery['src'] as $src ) : ?>
			<div class="js_slide slide-cell arch-u-1of1">
				<img src="<?php echo $src; ?>" class="gallery-cell-image arch-u-1of1" alt="Gallery image" />
			</div>
				<?php
			endforeach;

		else:
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

			<div class="js_slide slide-cell arch-u-1of1 arch-grad-overlay">

				<?php
		        get_the_image(array(
		            'size'         => 'arch-hd',
		            'image_class'  => 'gallery-cell-image arch-u-1of1',
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

	<button class="js_prev prev slide-btn">
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" fill="currentcolor" class="chevron-left v-icon"><path d="M20 1l4 4-10 11 10 11-4 4L6 16z"/></svg>
	</button>

	<button class="js_next next slide-btn">
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" fill="currentcolor" class="chevron-right v-icon"><path d="M12 1l14 15-14 15-4-4 10-11L8 5z"/></svg>
	</button>
</div>
