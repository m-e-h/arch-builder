<?php
/**
 * Tabs Component Template.
 *
 * @package arch-builder
 */

wp_enqueue_script( 'arch-tabs' ); ?>

<div <?php hybrid_attr( 'post' ); ?>>

<?php $query = new WP_Query( array( 'post_type' => get_post_type(), 'post_parent' => get_the_ID() ) ); ?>

	<div data-tabs class="tabs tab-bar arch-flex arch-flex-wrap">

<?php $counter = -1; ?>

	<?php while ( $query->have_posts() ) : $query->the_post(); ?>

<?php $counter++; ?>

	  <div data-index="<?php echo $counter ?>" class="tab-header arch-p2 arch-text-center arch-flexed-1 arch-f-plus"><?php the_title(); ?></div>

	<?php endwhile; ?>

		<?php $query->rewind_posts(); ?>
	</div>

<?php $counter = -1; ?>

	<?php while ( $query->have_posts() ) : $query->the_post(); ?>

<?php $counter++; ?>

	<div class="tab-content arch-p2 tab<?php the_ID(); ?>" data-index="<?php echo $counter ?>">

	<?php arch_excerpt(); ?>

	</div>

	<?php endwhile; ?>

<?php wp_reset_postdata(); ?>
</div>
