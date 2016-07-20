<?php
/**
 *
 * @package arch-builder
 */

wp_enqueue_script( 'arch-toggle' ); ?>

<article <?php hybrid_attr( 'post' ); ?>>

	<?php arch_title(); ?>

	<?php arch_excerpt(); ?>

	<?php $query = new WP_Query(
		array(
			'post_type' => get_post_type(),
			'post_parent' => get_the_ID(),
			'orderby' => 'menu_order',
			'order'   => 'ASC',
		)
	); ?>

<?php while ( $query->have_posts() ) : $query->the_post(); ?>

	<a class="collapse-toggle arch-f-plus arch-px2 arch-py1 arch-1of1 arch-flex arch-flex-justify-between" data-collapse="#toggle<?php the_ID(); ?>" href="#"><?php the_title(); ?> <svg xmlns="http://www.w3.org/2000/svg" class="chevron-toggle" fill="currentcolor" viewBox="0 0 32 32"><path d="M1 12l15 14 15-14-4-4-11 10L5 8z"/></svg>
	</a>

	<div class="collapse arch-p2" id="toggle<?php the_ID(); ?>">
	    	<?php arch_excerpt(); ?>
	</div>

<?php endwhile; ?>

<?php wp_reset_postdata(); ?>

</article>
