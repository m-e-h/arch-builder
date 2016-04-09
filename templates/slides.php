<?php
/**
 * Template for post photo slides.
 *
 * @package arch-builder
 */

wp_enqueue_script( 'flickity' ); ?>


<div <?php hybrid_attr( 'post' ); ?>>
	<div class="gallery js-flickity"
		data-flickity-options='{ "wrapAround": true }'>

<?php $arch_query = new WP_Query( array( 'post_type' => get_post_type(), 'post_parent' => get_the_ID() ) ); ?>

	<?php while ( $arch_query->have_posts() ) : $arch_query->the_post(); ?>

		<div class="gallery-cell arch-1of1 arch-grad-overlay">

			<?php
		        get_the_image(array(
		            'size'         => 'arch-hd',
		            'image_class'  => 'gallery-cell-image arch-1of1',
		            'link_to_post' => false,
		        ));
			?>
			<div class="cta-content arch-ab">
				<?php arch_title(); ?>
				<div class="cta-text arch-f-plus "><?php arch_excerpt(); ?></div>
			</div>
		</div>

	<?php endwhile; ?>
<?php wp_reset_postdata(); ?>

	</div>
</div>
