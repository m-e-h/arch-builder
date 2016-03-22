<?php
/**
 * Template for post photo slides.
 *
 * @package arch-builder
 */
?>
<?php $query = new WP_Query( array( 'post_type' => get_post_type(), 'post_parent' => get_the_ID() ) ); ?>

<div <?php hybrid_attr('post'); ?>>
	<div class="gallery js-flickity"
		data-flickity-options='{ "freeScroll": true, "wrapAround": true }'>

	<?php while ($query->have_posts()) : $query->the_post(); ?>

		<div class="gallery-cell u-1of1">

			<?php
		        get_the_image(array(
		            'size'         => 'abe-hd',
		            'image_class'  => 'gallery-image u-1of1',
		            'link_to_post' => false,
		        ));
			?>
			<div class="u-bg-tint-2 u-abs u-top0 u-left0 u-1of1 u-height100 u-flex u-flex-wrap u-flex-center">
				<h2 class="cta-heading u-bg-2-glass-dark u-f-plus u-p2"><?php the_title(); ?></h2>
				<div class="cta-text u-f-plus "><?php arch_excerpt(); ?></div>
			</div>
		</div>

	<?php endwhile; ?>

	</div>
</div>
