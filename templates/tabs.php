<?php
/**
 * Tabs Component Template.
 *
 * @package arch-builder
 */

wp_enqueue_script( 'arch-tabs' ); ?>

<?php $query = new WP_Query( array( 'post_type' => get_post_type(), 'post_parent' => get_the_ID() ) ); ?>

<div <?php hybrid_attr( 'post' ); ?>>

	<div data-tabs class="tabs tab-bar u-flex u-flex-wrap">

<?php $counter = -1; ?>

	<?php while ( $query->have_posts() ) : $query->the_post(); ?>

<?php $counter++; ?>

	  <div data-index="<?= $counter ?>" class="tab-header u-p2 u-text-center u-flexed-auto u-f-plus"><?php the_title(); ?></div>

	<?php endwhile; ?>

		<?php $query->rewind_posts(); ?>
	</div>

<?php $counter = -1; ?>

	<?php while ( $query->have_posts() ) : $query->the_post(); ?>

<?php $counter++; ?>

	<div class="tab-content u-p2 tab<?php the_ID(); ?>" data-index="<?= $counter ?>">

	<?php arch_excerpt(); ?>

	</div>

	<?php endwhile; ?>

<?php wp_reset_postdata(); ?>
</div>
